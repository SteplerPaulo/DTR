App.directive('inputFocus', function () {
	var FOCUS_CLASS = 'input-focused';
	return {
		restrict: 'A',
		priority: 1,
		require: 'ngModel',
		link: function (scope, element, attrs, ctrl) {
			element.bind('focus',function () {
				element.parent().addClass(FOCUS_CLASS);    
			}).bind('blur', function () {
				element.parent().removeClass(FOCUS_CLASS);
			});
		}
		};
});