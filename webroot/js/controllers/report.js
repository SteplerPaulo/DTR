App.controller('ReportController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		$scope.fromDate =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		$scope.toDate = $filter("date")(Date.now(), 'yyyy-MM-dd');
		
		//GET ALL CATEGORIES
		$http.get("/DTR/attendances/employees").success(function(response) {
			$scope.data = response;
		});
	}
	
	//INTENT TO ADJUST EVENT HANDLER 
	$scope.AdjustButton = function(fromDate,toDate,empname,empno){
		var get = '/DTR/admin/attendances/adjust/'+fromDate+'/'+toDate+'/'+empno+'/'+empname;
		if(empno && empname && fromDate && toDate) {
			return $('iframe')[0].src=get;
		}
	}
	
	//PRINT ICON EVENT HANDLER
	$scope.DateFilterModal = function(fromDate,toDate,empname,empno){
		var get = '/DTR/attendances/doc_report/'+fromDate+'/'+toDate+'/'+empno+'/'+empname;
		if(empno && empname && fromDate && toDate) {
			return $('iframe')[0].src=get;
		}
	}
});

