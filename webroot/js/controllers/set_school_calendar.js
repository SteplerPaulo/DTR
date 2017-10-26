App.controller('SetSchoolCalendarController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.preventDoubleClick = false;
		
		
		$http.get("/DTR/school_calendars/set_init_data").success(function(o) {
			$scope.school_years = o.school_years;
			$scope.curriculums = o.curriculums;
			$scope.periods = o.periods;
			$scope.levels = o.levels;
			$scope.selected = {levels: []};
		});
	}
	
	//LEVEL CHECKBOX
	$scope.checkAll = function() {
		$scope.selected.levels = $scope.levels.map(function(item) { return item.id; });
	};
	
	$scope.uncheckAll = function() {
		$scope.selected.levels = [];
	};
	
	$scope.checkFirst = function() {
		$scope.selected.levels.splice(0, $scope.selected.levels.length); 
		$scope.selected.levels.push(1);
	};

	
	
	$scope.Save = function () {
		$scope.preventDoubleClick = true;
		
		var data = {'SchoolCalendar':{
						'school_year_id':$scope.sy.SchoolYear.id,
						'curriculum_id':$scope.curri.Curriculum.id,
						'period_id':$scope.prd.Period.id,
						'date_from':$scope.date_from,
						'date_to':$scope.date_to,
						'levels':$scope.selected.levels,
					}};
					
		$http({
			method: 'POST',
			url: '/DTR/school_calendars/add',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			window.location.href = "/DTR/school_calendars/";
		});
	}

});