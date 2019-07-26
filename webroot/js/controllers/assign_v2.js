App.controller('StudentListController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;

		$http.get("/DTR/rfid_students/sy").success(function(response) {
			$scope.sy = response;
		});
		
		$http.get("/DTR/rfid_students/sections").success(function(response) {
			$scope.sections = response;
		});
		
		$http.get("/DTR/rfid_students/stud_201").success(function(response) {
			$scope.students = response;
		});
		
	}
	
	$scope.save = function (stud) {
	
		var data = JSON.parse(angular.toJson(stud))
		console.log(stud);
		//return;
		
		$http({
			method: 'POST',
			url: '/DTR/rfid_students/save_rfid',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			//console.log(response);
		});
	
		
    }

});

App.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13 && element.val().length) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
				element.closest('tr').next('tr').find('input').focus();
            }
        });
    };
})



