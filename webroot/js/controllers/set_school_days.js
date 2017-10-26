App.controller('SetSchoolDaysController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		
		var weekday = new Array(7);
		weekday[0] =  "Sun";
		weekday[1] = "Mon";
		weekday[2] = "Tue";
		weekday[3] = "Wed";
		weekday[4] = "Thu";
		weekday[5] = "Fri";
		weekday[6] = "Sat";
		
		var month = new Array();
		month[0] = "January";
		month[1] = "February";
		month[2] = "March";
		month[3] = "April";
		month[4] = "May";
		month[5] = "June";
		month[6] = "July";
		month[7] = "August";
		month[8] = "September";
		month[9] = "October";
		month[10] = "November";
		month[11] = "December";
		
		
		
		
		
		var semMonth = new Array();
		semMonth[0] = {'year':2017,'month':8};
		semMonth[1] = {'year':2017,'month':9};
		semMonth[2] = {'year':2017,'month':10};
		semMonth[3] = {'year':2017,'month':11};
		semMonth[4] = {'year':2018,'month':0};
		console.log(semMonth);
		
		$scope.data = new Array();
		$.each(semMonth,function(ctr,obj){
			var date = new Date(obj['year'],obj['month'], 1);
			
			
			$scope.data[ctr]={
				'count':new Date(obj['year'], obj['month'] + 1, 0).getDate(),
				'month':month[date.getMonth()],
				'year':date.getFullYear(),
				'days':new Array(),
				
			}
			
			

			
			var d = date.getDay();
			for($i=0;$i<$scope.data[ctr].count;$i++){
				weekday[d]
				$scope.data[ctr].days[$i] = {
					"date":$i+1,
					"day":weekday[d],
					"year":obj['year'],
					"isWeekend":(weekday[d] == 'Sat' || weekday[d] == 'Sun' )?true:false,
				}
				d++;
				if(d == 7){
					d = 0;
				}
			}
			
		});
		console.log($scope.data);
		
		/*
		var date = new Date(semMonth[0]['year'],semMonth[0]['month'], 1);
		
		
		$scope.count = new Date(2017, 8 + 1, 0).getDate();
		$scope.month = month[date.getMonth()];
		$scope.year = date.getFullYear();
		

		
		$scope.days = new Array();
		var d = date.getDay();
		for($i=0;$i<$scope.count;$i++){
			$scope.weekday[d]
			$scope.days[$i] = {
				"date":$i+1,
				"day":$scope.weekday[d],
				"year":$scope.year,
				"isWeekend":($scope.weekday[d] == 'Sat' || $scope.weekday[d] == 'Sun' )?true:false,
			}
			d++;
			if(d == 7){
				d = 0;
			}
		}
		*/
	}
	
	
});