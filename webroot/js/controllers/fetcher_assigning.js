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
		$rootScope.RFIDENTRY = true;
		$rootScope.ASSIGNING = false;
		
		$http.get("/DTR/fetchers/all").success(function(response) {
			$scope.fetchers = response;
		});
		
		$http.get("/DTR/rfid_students/students").success(function(response) {
			$scope.students = response;
		});
	}
	
	$scope.GoButton = function(RFID) {
		$scope.RFID = RFID;
		if(RFID){
			$rootScope.RFIDENTRY = false;
			$rootScope.ASSIGNING = true;
			
			$http.get("/DTR/fetchers/populate/"+RFID).success(function(response) {
				
				
				$.each(response,function(i,d){
					$.each($scope.fetchers,function(i,f){
						if(d.Fetcher.id ==  f.Fetcher.id){
							$scope.SelectedFetchers[f.Fetcher.id] = f;
							$rootScope.isSelected[f.Fetcher.slug] = true;
						}
					});
					
					
					$.each($scope.students,function(i,f){
						if(d.RfidStudent.id ==  f.RfidStudent.id){
							$scope.SelectedStudents[f.RfidStudent.id] = f;
							$rootScope.isSelected[f.RfidStudent.slug] = true;
							
						}
					});
				});
			
				
				
				$rootScope.FINALFETCHERS = [];
				$.each($scope.SelectedFetchers,function(i,o){
					if(o){//FILTER UNDEFINED VALUE
						$rootScope.FINALFETCHERS.push(o);
					}
				});


				
				$rootScope.FINALSTUDENTS = [];
				$.each($scope.SelectedStudents,function(i,o){
					if(o){
						$rootScope.FINALSTUDENTS.push(o);
					}
				});
					
				
				
				
				
				
				
				
				
			});
			
		}
		
	}
	

	
	$scope.fetcherSelected = function(d) {
		
		
		$scope.SelectedFetchers[d.Fetcher.id] = d;
		
		$rootScope.FINALFETCHERS = [];
		$.each($scope.SelectedFetchers,function(i,o){
			if(o){//FILTER UNDEFINED VALUE
				$rootScope.FINALFETCHERS.push(o);
			}
		});
		console.log($rootScope.FINALFETCHERS);
		$rootScope.isSelected[d.Fetcher.slug] = true;//REMOVE FETCHER FROM OPTION LIST
	};
	
	$scope.removeFetcher = function(d) {
		$rootScope.isSelected[d.Fetcher.slug] = false;
	}
	
	
	
	$scope.studentSelected = function(d) {
		$scope.SelectedStudents[d.RfidStudent.id] = d;
		$rootScope.FINALSTUDENTS = [];
		$.each($scope.SelectedStudents,function(i,o){
			if(o){
				$rootScope.FINALSTUDENTS.push(o);
			}
		});
		
		$rootScope.isSelected[d.RfidStudent.slug] = true;
	};
	
	$scope.removeStudent = function(d) {
		$rootScope.isSelected[d.RfidStudent.slug] = false;
	}
});