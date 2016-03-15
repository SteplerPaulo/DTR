App.controller('StudentAttendanceReportController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		$scope.types = [{id:1,name:"Daily Report"},{id:2,name:"Monthly Report"}];
		$scope.DailyReport =  true;
		$scope.ReportURL =  '/DTR/rfid_studattendances/daily_report/';
		$scope.Daily =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		$scope.Monthly = $filter("date")(Date.now(), 'yyyy-MM');
		
		
		//SECTIONS
		$http.get("/DTR/sections/all").success(function(response) {
			$scope.data = response;
		});
	}
	
	
	$scope.changedType = function(type){
		if(type['id'] == 1){
			$scope.DailyReport =  true;
			$scope.ReportURL =  '/DTR/rfid_studattendances/daily_report/';
		}else{
			$scope.DailyReport =  false;
			$scope.ReportURL =  '/DTR/rfid_studattendances/monthly_report/';
		}
	}     
	
	
	//PRINT ICON EVENT HANDLER
	$scope.printReport = function(section_id,section_name,date){
		
		var get = $scope.ReportURL+section_id+'/'+section_name+'/'+date;
		if(section_id && section_name && date) {
			return $('iframe')[0].src=get;
		}
	}
});

