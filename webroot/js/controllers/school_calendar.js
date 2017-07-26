App.controller('SchoolCalendarController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		
		
	}
	
	$scope.changeCurri = function (curriculum) {
	
		if(curriculum == 'PS' ){
			$scope.levels = {'JK':'Jr. Kinder','SK':'Sr. Kinder'};
		}else if(curriculum == 'GS'){
			$scope.levels = {'GS1':'Grade 1','GS2':'Grade 2','GS3':'Grade 3','GS4':'Grade 4','GS5':'Grade 5','GS6':'Grade 6'};
		}else if(curriculum == 'HS'){
			$scope.levels = {'GS7':'Grade 7','GS8':'Grade 8','GS9':'Grade 9','GS10':'Grade 10'};
		}else if(curriculum == 'SH'){
			$scope.levels = {'GS11':'Grade 11','GS12':'Grade 12'};
		}
		
	}

});