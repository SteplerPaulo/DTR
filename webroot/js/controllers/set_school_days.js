App.controller('SetSchoolDaysController',function($scope,$rootScope,$http,$filter,$timeout){
	
	$scope.initializeController = function(){
		$scope.preventDoubleClick = false;
		$scope.semMonth =  new Array();
		$scope.data = new Array();
		$scope.calendarObject = new Array();
		$scope.calendarDate = new Array();
		$scope.dayStatus = new Array();
		$scope.dayRemark = new Array();
		$scope.class = new Array();
		
		$scope.statuses = [
					{"id":"1","name":"Regular Day","alias":"RD","act_as":"RD"},
					{"id":"2","name":"No Class","alias":"NC","act_as":"NC"},
				]
		
		//$scope.tdClass="clickable noClassToday"
		
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
				var StartDate = parseInt(sc['SchoolCalendar']['date_from'].split('-')[2]);
				var LastDay = parseInt(sc['SchoolCalendar']['date_to'].split('-')[2]);
				
				var FromYear = parseInt(sc['SchoolCalendar']['date_from'].split('-')[0]);
				var FromMonth = parseInt(sc['SchoolCalendar']['date_from'].split('-')[1])-1;
				var ToYear = parseInt(sc['SchoolCalendar']['date_to'].split('-')[0]);
				var ToMonth = parseInt(sc['SchoolCalendar']['date_to'].split('-')[1])-1;
				
				var FromDate = Date(sc['SchoolCalendar']['date_from']);
				var ToDate = new Date(ToYear,ToMonth, 1);
				
				
				
				var monthCtr =  0;
				do{	
					if($scope.dayStatus[monthCtr] == undefined){
						$scope.dayStatus[monthCtr] == '';
					}
					
					var date = new Date(FromYear,FromMonth, 1);// SET 1ST DATE OF THE MONTH
					//SET DATA 
					$scope.data[monthCtr]={
						'count':new Date(FromYear, FromMonth+1, 0).getDate(),//month last day
						'month':month[date.getMonth()],
						'year':date.getFullYear(),
						'days':new Array(),
					}
					
					//GET DAYS OF THE MONTH
					var d = date.getDay();
					var daysofmonth = false;
					var monthdayscount = $scope.data[monthCtr].count;
					var daysCtr = 1;
					
					
					for($i=0;$i<42;$i++){
						if(weekday[d] == 'Mon' && !daysofmonth){
							daysofmonth = true;
							$scope.data[monthCtr].days[$i++] = {"isDummy":true};
						}else if(weekday[d] == 'Tue' && !daysofmonth){
							daysofmonth = true;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
						}else if(weekday[d] == 'Wed' && !daysofmonth){
							daysofmonth = true;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
						}else if(weekday[d] == 'Thu' && !daysofmonth){
							daysofmonth = true;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
						}else if(weekday[d] == 'Fri' && !daysofmonth){
							daysofmonth = true;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
						}else if(weekday[d] == 'Sat' && !daysofmonth){
							daysofmonth = true;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
							$scope.data[monthCtr].days[$i++] = null;
						}else{daysofmonth = true}
						
						
						
						if(daysofmonth){
							if(daysCtr <= monthdayscount){
								
								tdClass = "grey";
								if(weekday[d] == 'Sun' || weekday[d] == 'Sat'){
									tdClass+= ' clickable noclass';
								}else{
									tdClass+= ' clickable';
								}
								
								//ADD CLASS TO FIRST MONTH EXLUDED DAYS
								if((monthCtr==0 && daysCtr < StartDate)){
									tdClass += ' notIncluded ';
								}
								//ADD CLASS TO LAST MONTH EXCLUDED DAYS
								if(date.getTime() === ToDate.getTime() && daysCtr > LastDay){
									tdClass += ' notIncluded ';
								}
								
								$scope.data[monthCtr].days[$i] = {
									//"full_date":Date(year, month, daysCtr),
									"date":daysCtr,
									"day":weekday[d],
									"year":date.getFullYear(),
									'month':((date.getMonth()+1) < 10) ? ("0" + (date.getMonth()+1)) : date.getMonth()+1,
									"status":(weekday[d] == 'Sun' || weekday[d] == 'Sat')?'No Class':'Regular Day',
									"remarks":(weekday[d] == 'Sun' || weekday[d] == 'Sat')?'Weekend':'',
									"included":((monthCtr==0 && daysCtr < StartDate) || (date.getTime() === ToDate.getTime() && daysCtr > LastDay))?false:true,
									"tdClass":tdClass,
								}
								daysCtr++;
							}
						}
						d++;
						if(d == 7){d = 0;}
					}//END LOOP
					monthCtr++;//increment month counter 
					FromDate = new Date(FromYear,FromMonth++, 1);// ADD 1 MONTH EVERY LOOP	
				}while(FromDate < ToDate);
			});
			
			console.log($scope.data);
		}
	}
	
	$scope.setDate = function(i,o){
		if($scope.data[i].days[o]){
			if($scope.data[i].days[o].included){
				var d = $scope.data[i].days[o];
				var date = (d.date < 10)?"0"+d.date:d.date;
				
				$scope.calendarDate[i] = d.year+'-'+d.month+'-'+date;
				$scope.calendarObject[i] = o;
				$scope.dayStatus[i] = '';
				
				$scope.class[i] = "focus";
				$timeout(function(e){$scope.class[i] = null;}, 500);
			}
		}
	}
	
	$scope.add = function(i,o){
		if($scope.dayStatus[i].name == 'No Class') $scope.data[i].days[o].tdClass ="grey clickable noclass"
		else $scope.data[i].days[o].tdClass ="grey clickable"
		
		$scope.data[i].days[o].status = $scope.dayStatus[i].name;
		$scope.data[i].days[o].remarks = $scope.dayRemark[i];
		
		$scope.calendarDate[i] = '';
		$scope.calendarObject[i] = '';
		$scope.dayStatus[i] = '';
		$scope.dayRemark[i] = '';
	}
	
	$scope.save = function(){
		//$scope.preventDoubleClick =  true;
		console.log($scope.data);
		
		
		var i = 0;
		var FormData = {};
			FormData[i] = {};
			
		$.each($scope.data,function(monthCtr,month){
			//console.log(month);
			//return;
			
			$.each(month.days,function(dayCtr,day){
				if(day){
					var date = (day.date < 10)?"0"+day.date:day.date;
					
					FormData[i] = {'SchoolDay':{
										'school_calendar_id':$scope.school_calendar_id,
										'date':day.year+'-'+day.month+'-'+date,
										'status':day.status,
										'remarks':day.remarks,
									}};
					
					i++;
				}
			});
		});
		
	
		console.log(FormData);
	}
	
});