App.controller('StudentAttendanceReportController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		
		//GENERAL SCOPE
		$scope.currentPage = 1; 
		$scope.pageSize = 5;
		$scope.perStudent = true;
		
		//PER SECTION SCOPE
		$scope.types = [{id:1,name:"Daily Report"},{id:2,name:"Monthly Report"}];
		$scope.DailyReport =  true;
		$scope.ReportURL =  '/DTR/rfid_studattendances/daily_report/';
		$scope.Daily =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		$scope.Monthly = $filter("date")(Date.now(), 'yyyy-MM');
		$http.get("/DTR/sections/all").success(function(response) {//SECTIONS
			$scope.sections = response;
		});
		
		//PER STUDENT SCOPE
		$scope.fromDate =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		$scope.toDate = $filter("date")(Date.now(), 'yyyy-MM-dd');
		$http.get("/DTR/rfid_students/all_student").success(function(response) {
			$scope.students = response;
			//console.log(response);
		});
	}
	
	$scope.perWhat = function(per){
		switch(per){
			case 'Student': 
					$scope.perStudent = true;
					$scope.perSection = false;
					break;
			case 'Section': 
					$scope.perStudent = false;
					$scope.perSection = true;	
					break;
		}
	}  
	
	
/****************************PER SECTION ******************************************/
	$scope.changedType = function(type){
		if(type['id'] == 1){
			$scope.DailyReport =  true;
			$scope.ReportURL =  '/DTR/rfid_studattendances/daily_report/';
		}else{
			$scope.DailyReport =  false;
			$scope.ReportURL =  '/DTR/rfid_studattendances/monthly_report/';
		}
	}     
	
	$scope.perSectionDailyReportAdjustButton =  function(secId,secName,date){
		//console.log(secId);
		//console.log(secName);
		//console.log(date);
		
		var get = '/DTR/admin/rfid_studattendances/per_section_adjustment/'+secId+'/'+secName+'/'+date;
		if(secId && secName && date) {
			return $('iframe')[0].src=get;
		}
		
	}
	
	
	//PRINT ICON EVENT HANDLER
	$scope.printReport = function(section_id,section_name,date){
		var get = $scope.ReportURL+section_id+'/'+section_name+'/'+date;
		console.log(get);
		if(section_id && section_name && date) {
			return $('iframe')[0].src=get;
		}
	}

/****************************PER STUDENT ******************************************/	

	//INTENT TO ADJUST EVENT HANDLER 
	$scope.AdjustButton = function(fromDate,toDate,sname,sno){
		var get = '/DTR/admin/rfid_studattendances/adjust/'+fromDate+'/'+toDate+'/'+sno+'/'+sname;
		if(sno && sname && fromDate && toDate) {
			return $('iframe')[0].src=get;
		}
	}
	
	//PRINT ICON EVENT HANDLER
	$scope.DateFilterModal = function(fromDate,toDate,sname,sno){
		var get = '/DTR/rfid_studattendances/doc_report/'+fromDate+'/'+toDate+'/'+sno+'/'+sname;
		if(sno && sname && fromDate && toDate) {
			return $('iframe')[0].src=get;
		}
	}
	
});

