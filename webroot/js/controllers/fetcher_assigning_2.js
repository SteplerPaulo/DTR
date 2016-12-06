App.controller('FetcherAssigningController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 11;
		$scope.FetcherIsChecked = {}; 
		$scope.Checkbox = false; 
		$scope.SelectedFetchers = [];
		$scope.SelectedStudents = [];
		$rootScope.FINALFETCHERS = [];
		$rootScope.FINALSTUDENTS = [];
		$rootScope.isSelected=[];
		$rootScope.isRemoved=[];
		
		$http.get("/DTR/fetchers/all").success(function(response) {
			$scope.fetchers = response;
		});
		
		$http.get("/DTR/rfid_students/students").success(function(response) {
			$scope.students = response;
		});
	}
	

	
	$scope.fetcherSelected = function(d) {
		var indx = d.Fetcher.id;
		$scope.SelectedFetchers[indx] = d;
		$rootScope.FINALFETCHERS = [];
		$.each($scope.SelectedFetchers,function(i,o){
			if(o){//FILTER UNDEFINED VALUE
				$rootScope.FINALFETCHERS.push(o);
			}
		});
	
		$rootScope.isSelected[d.Fetcher.slug] = true;
		$rootScope.isRemoved[d.Fetcher.slug] = false;
		
	};
	
	$scope.removeFetcher = function(d) {
		$rootScope.isSelected[d.Fetcher.slug] = false;
		$rootScope.isRemoved[d.Fetcher.slug] = true;
	}
	
	
	
	$scope.studentSelected = function(d) {
		var indx = d.RfidStudent.id;
		$scope.SelectedStudents[indx] = d;
		$rootScope.FINALSTUDENTS = [];
		$.each($scope.SelectedStudents,function(i,o){
			if(o){
				$rootScope.FINALSTUDENTS.push(o);
			}
		});
		
		$rootScope.isSelected[d.RfidStudent.slug] = true;
		$rootScope.isRemoved[d.RfidStudent.slug] = false;
	};
	
	$scope.removeStudent = function(d) {
		$rootScope.isSelected[d.RfidStudent.slug] = false;
		$rootScope.isRemoved[d.RfidStudent.slug] = true;
	}
});