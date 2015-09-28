AmigoApp.directive('default',function($parse){
  return {
    priority : 1,
    link : function(scope,element,attrs){
      var getter = $parse(attrs.ngBind);
      var setter = getter.assign;
      var content = element.text();
      setter(scope,content);
    }
  };
});
AmigoApp.directive('match',function($parse){
  return {
        require: "ngModel",
        scope: {
            otherModelValue: "=match"
        },
        link: function(scope, element, attributes, ngModel) {
             
            ngModel.$validators.match = function(modelValue) {
                return modelValue == scope.otherModelValue;
            };
 
            scope.$watch("otherModelValue", function() {
                ngModel.$validate();
            });
        }
    };
});
AmigoApp.directive('numericOnly', function(){
    return {
        restrict: 'A',
        require: '?ngModel',
		 link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(input) {
				var text =  input + '';
                if (text) {
                    var transformedInput = text.replace(/[^0-9\.]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }            
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});
AmigoApp.directive('datepicker', function ($parse) {
	return {
        restrict: 'A',
        require: 'ngModel',
		scope: {
            datepickerFormat: "@"
        },
        link: function(scope, element, attrs,ngModel) {
			var __format = scope.datepickerFormat || 'mm.dd.yy';
		   $(element).datepicker({
			   inline: true,
			   dateFormat:__format,
			   yearRange: '1900:c',
			   constrainInput :true,
			   changeMonth: true,
			   changeYear: true,
			   onSelect: function(dateText) {
				 scope.$apply(function () {
					ngModel.$setViewValue(dateText);
				});
			   }
		   });
		}
   };
});