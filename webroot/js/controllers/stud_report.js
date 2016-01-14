App.controller('StudentAttendanceReportController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		$scope.fromDate =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		$scope.toDate = $filter("date")(Date.now(), 'yyyy-MM-dd');
		
		//GET ALL CATEGORIES
		$http.get("/DTR/rfid_studattendances/students").success(function(response) {
			$scope.data = response;
		});
	}
	
	//INTENT TO ADJUST EVENT HANDLER 
	$scope.AdjustButton = function(fromDate,toDate,sname,sno){
		var get = '/DTR/admin/rfid_studattendances/adjust/'+fromDate+'/'+toDate+'/'+sno+'/'+sname;
		if(sno && sname && fromDate && toDate) {
			return $('iframe')[0].src=get;
		}
	}
	
	//PRINT ICON EVENT HANDLER
	$scope.DateFilterModal = function(fromDate,toDate,sname,dec_rfid){
		var get = '/DTR/rfid_studattendances/doc_report/'+fromDate+'/'+toDate+'/'+dec_rfid+'/'+sname;
		if(dec_rfid && sname && fromDate && toDate) {
			return $('iframe')[0].src=get;
		}
	}
});

