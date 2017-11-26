App.controller('SetSchoolDaysController',function($scope,$rootScope,$http,$filter,$timeout){
	
	$scope.initializeController = function(){
		$scope.preventDoubleClick = false;
		$scope.semMonth =  new Array();
		$scope.data = new Array();
		$scope.calendarObject = new Array();
		$scope.calendarDate = new Array();
		$scope.dayStatus = new Array();
		$scope.dayRemark = new Array();
		$scope.dayStartTime = new Array();
		$scope.class = new Array();
		
		$scope.statuses = [
					{id:"1",name:"School Day",alias:"SD",act_as:"SD"},
					{id:"2",name:"No Class",alias:"NC",act_as:"NC"},
					{id:"3",name:"Adjusted Period",alias:"SP",act_as:"SD"},
				];	
		
		var weekday = new Array(7);
		weekday[0] =  "Sun";weekday[1] = "Mon";weekday[2] = "Tue";weekday[3] = "Wed";weekday[4] = "Thu";weekday[5] = "Fri";weekday[6] = "Sat";
		
		var month = new Array();
		month[0] = "January";month[1] = "February";month[2] = "March";month[3] = "April";
		month[4] = "May";month[5] = "June";month[6] = "July";month[7] = "August";month[8] = "September";
		month[9] = "October";month[10] = "November";month[11] = "December";
		
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
						$scope.dayStatus[monthCtr] = {};
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
								
								var pDate= (daysCtr<10)?'0'+daysCtr:daysCtr;
								var pMonth = ((date.getMonth()+1) < 10) ? ("0" + (date.getMonth()+1)) : date.getMonth()+1;
								var pYear = date.getFullYear();
								var pFullDate = pYear+'-'+pMonth+'-'+pDate;
								
								
								$scope.data[monthCtr].days[$i] = {
									"date":daysCtr,
									"day":weekday[d],
									"year":pYear,
									'month':pMonth,
									"status":(weekday[d] == 'Sun' || weekday[d] == 'Sat')?'No Class':'School Day',
									"remarks":(weekday[d] == 'Sun' || weekday[d] == 'Sat')?'Weekend':'Regular Class',
									"isWeekend":(weekday[d] == 'Sun' || weekday[d] == 'Sat')?true:false,
									"included":((monthCtr==0 && daysCtr < StartDate) || (date.getTime() === ToDate.getTime() && daysCtr > LastDay))?false:true,
									"tdClass":tdClass,
									"full_date":pFullDate,
									"start_time":null,
								}
								
								$.each(sc.SchoolDay,function(ctr,obj){//insert school days value
									if(obj.date == pFullDate){
										$scope.data[monthCtr].days[$i].id = obj.id;
										$scope.data[monthCtr].days[$i].status = obj.status;
										$scope.data[monthCtr].days[$i].remarks = obj.remarks;
										$scope.data[monthCtr].days[$i].start_time = obj.start_time;
										
										switch(obj.status){
											case "School Day":$scope.data[monthCtr].days[$i].tdClass ="grey clickable";break;
											case "No Class":$scope.data[monthCtr].days[$i].tdClass  ="grey clickable noclass";break;
											case "Adjusted Period":$scope.data[monthCtr].days[$i].tdClass ="grey clickable adjustedPeriod";break;
										}
										return;
									}
									
								});
								
								
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
		if($scope.data[i].days[o]){// Check if object td is a month's day
			if($scope.data[i].days[o].included){// Check if the month's day is included within the school calendar
				
				//Populate day value
				$scope.calendarObject[i] = o;
				$scope.calendarDate[i] = $scope.data[i].days[o].full_date;
				$scope.dayRemark[i] = $scope.data[i].days[o].remarks;
				$scope.dayStartTime[i] = $scope.data[i].days[o].start_time;
				
				//Select day status value
				switch($scope.data[i].days[o].status){
					case "School Day":$scope.dayStatus[i] = $scope.statuses[0];break;
					case "No Class":$scope.dayStatus[i] = $scope.statuses[1];break;
					case "Adjusted Period":$scope.dayStatus[i] = $scope.statuses[2];break;
				}
					
				//Focus & blur on month's date input
				$scope.class[i] = "focus";	
				$timeout(function(e){$scope.class[i] = null;}, 500);
			}
		}
	}
	

	$scope.changeStatus = function(i){
		
		
		$scope.dayRemark[i] = '';	//Remove remark value when status change
		$scope.dayStartTime[i] = null;	//Remove remark value when status change
	}
	
	$scope.add = function(i,o){
		//console.log($scope.dayStartTime[i]);
		
		//Switch Classes
		switch($scope.dayStatus[i].name){
			case "School Day":$scope.data[i].days[o].tdClass="grey clickable";break;
			case "No Class":$scope.data[i].days[o].tdClass ="grey clickable noclass";break;
			case "Adjusted Period":$scope.data[i].days[o].tdClass ="grey clickable adjustedPeriod";
			
				break;
		}
		
		//Update Data Value
		$scope.data[i].days[o].status = $scope.dayStatus[i].name;
		$scope.data[i].days[o].remarks = ($scope.dayRemark[i] != undefined)?$scope.dayRemark[i]:'';
		$scope.data[i].days[o].start_time = $scope.dayStartTime[i];
	
		//Reset Add Event Input Value
		$scope.calendarDate[i] = '';
		$scope.calendarObject[i] = '';
		$scope.dayStatus[i] = '';
		$scope.dayRemark[i] = '';
		$scope.dayStartTime[i] = null;
	}
	
	$scope.save = function(){
		//$scope.preventDoubleClick =  true;
		
		var i = 0;
		var FormData = {};
			FormData[i] = {};
			
		$.each($scope.data,function(monthCtr,month){
			$.each(month.days,function(dayCtr,day){
				if((day && day.included && !day.isWeekend && day.status != "School Day") || (day && day.included && day.isWeekend && (day.status=="School Day"))){
				
					
					FormData[i] = {'SchoolDay':{
										'school_calendar_id':$scope.school_calendar_id,
										'id':(day.id)?day.id:'',
										'date':day.full_date,
										'status':day.status,
										'remarks':day.remarks,
										'start_time':day.start_time,
									}};
					
					i++;
				}else if(day){//resched no class to regular class
					if(day.id){
						FormData[i] = {'SchoolDay':{
										'school_calendar_id':$scope.school_calendar_id,
										'id':day.id,
										'date':day.full_date,
										'status':day.status,
										'remarks':day.remarks,
										'start_time':day.start_time,
									}};
					
						i++;
					}
					
				}
			});
		});
		console.log(FormData);
		//return;
		$http({
			method: 'POST',
			url: '/DTR/school_days/add',
			data: $.param({data:FormData}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			window.location.href = "/DTR/school_calendars/";
		});
		
	}
	
});