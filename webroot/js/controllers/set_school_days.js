App.controller('SetSchoolDaysController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.semMonth =  new Array();
		$scope.data = new Array();
		
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
		
		if(window.location.pathname.split('/')[4]){
			$scope.school_calendar_id = window.location.pathname.split('/')[4].split(':')[1];		
			
			$http({
				method: 'POST',
				url: '/DTR/school_days/calendar',
				data: $.param({data:$scope.school_calendar_id}),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function(sc) {
				
				var sc = sc.data;
				var dateFromYear = parseInt(sc['SchoolCalendar']['date_from'].split('-')[0]);
				var dateFromMonth = parseInt(sc['SchoolCalendar']['date_from'].split('-')[1])-1;
				var startDate = parseInt(sc['SchoolCalendar']['date_from'].split('-')[2]);
				var dateToYear = parseInt(sc['SchoolCalendar']['date_to'].split('-')[0]);
				var dateToMonth = parseInt(sc['SchoolCalendar']['date_to'].split('-')[1])-1;
				var endDate = parseInt(sc['SchoolCalendar']['date_to'].split('-')[2]);
				
				var FromDate = new Date(dateFromYear,dateFromMonth, 1);
				var ToDate = new Date(dateToYear,dateToMonth, 1);
				
				var ctr =  0;
				
				do{	
					var date = new Date(dateFromYear,dateFromMonth, 1);// SET DATE
					console.log(date);
					console.log(new Date(dateFromYear, dateFromMonth+1, 0).getDate());
					//SET DATA 
					$scope.data[ctr]={
						'count':new Date(dateFromYear, dateFromMonth+1, 0).getDate(),
						'month':month[date.getMonth()],
						'year':date.getFullYear(),
						'days':new Array(),
					}
					
					//GET DAYS OF THE MONTH
					var d = date.getDay();
					var daysofmonth = false;
					var monthdayscount = $scope.data[ctr].count;
					var daysctr = 1;
					
					for($i=0;$i<42;$i++){
						if(weekday[d] == 'Mon' && !daysofmonth){
							daysofmonth = true;
							$scope.data[ctr].days[$i++] = {"isDummy":true};
						}else if(weekday[d] == 'Tue' && !daysofmonth){
							daysofmonth = true;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
						}else if(weekday[d] == 'Wed' && !daysofmonth){
							daysofmonth = true;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
						}else if(weekday[d] == 'Thu' && !daysofmonth){
							daysofmonth = true;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
						}else if(weekday[d] == 'Fri' && !daysofmonth){
							daysofmonth = true;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
						}else if(weekday[d] == 'Sat' && !daysofmonth){
							daysofmonth = true;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
							$scope.data[ctr].days[$i++] = null;
						}else{
							daysofmonth = true;
						}
						//console.log(daysctr+' = '+monthdayscount);
						
						if(daysofmonth){
							if(daysctr <= monthdayscount){
								$scope.data[ctr].days[$i] = {
								"date":daysctr++,
								"day":weekday[d],
								"year":dateFromYear,
								}
							}
						}
						d++;
						if(d == 7){d = 0;}
					}
					//END
					
	
					ctr++;
					FromDate = new Date(dateFromYear,dateFromMonth++, 1);// ADD 1 MONTH EVERY LOOP	
				}while(FromDate < ToDate);
				
				console.log($scope.data);
			});
			
		}
	}
});