App.controller('StudentAttendanceReportController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		//GENERAL SCOPE
		$scope.currentPage = 1; 
		$scope.pageSize = 5;
		$scope.perSection = true;
		$scope.DailyReport =  true;
		
		//PER SECTION SCOPE
		$scope.types = [{id:1,name:"Daily Report"},{id:2,name:"Monthly Report"},{id:3,name:'DepEd Report'}];
	
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
		$scope.DailyReport =  true;	
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
	//DOC TYPE
	$scope.changedType = function(type){
		if(type['id'] == 1){
			$scope.DailyReport =  true;
			$scope.ReportURL =  '/DTR/rfid_studattendances/daily_report/';
		}else if(type['id'] == 2){
			$scope.DailyReport =  false;
			$scope.ReportURL =  '/DTR/rfid_studattendances/monthly_report/';
		}else{
			$scope.DailyReport =  false;
			$scope.ReportURL =  '/DTR/rfid_studattendances/deped_report/';
		}
	}     
	
	//PER SECTION INTENT TO ADJUST EVENT HANDLER 
	$scope.perSectionDailyReportAdjustButton =  function(secId,secName,date){	
		var get = '/DTR/admin/rfid_studattendances/per_section_adjustment/'+secId+'/'+secName+'/'+date;
		if(secId && secName && date) {
			return $('iframe')[0].src=get;
		}
	}
	
	//PRINT ICON EVENT HANDLER
	$scope.printReport = function(section_id,section_name,date){
		var get = $scope.ReportURL+section_id+'/'+section_name+'/'+date;
		if(section_id && section_name && date) {
			return $('iframe')[0].src=get;
		}
	}

/****************************PER STUDENT ******************************************/	

	//PER STUDENT INTENT TO ADJUST EVENT HANDLER 
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
