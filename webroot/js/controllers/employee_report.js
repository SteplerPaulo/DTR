App.controller('ReportController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.summary = true; 
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		$scope.fromDate =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		$scope.toDate = $filter("date")(Date.now(), 'yyyy-MM-dd');
		
		//GET ALL CATEGORIES
		$http.get("/DTR/attendances/employees").success(function(response) {
			$scope.data = response;
		});
	}
	
	
	$scope.toggle = function(data){
		$scope.summary = data; 
	}
	
	
	//INTENT TO ADJUST EVENT HANDLER 
	$scope.AdjustButton = function(fromDate,toDate,empname,empno){

	
		$.ajax({
			url: '/DTR/attendances/init_remarks/'+fromDate+'/'+toDate+'/'+empno+'/'+empname,
			dataType:'json',
			type:'post',
		}).done(function( response ) {
			var get = '/DTR/admin/attendances/adjust/'+fromDate+'/'+toDate+'/'+empno+'/'+empname;
			if(empno && empname && fromDate && toDate) {
				return $('iframe')[0].src=get;
			}
		});
	}
	
	//PRINT ICON EVENT HANDLER
	$scope.DateFilterModal = function(fromDate,toDate,empname,empno){
		var get = '/DTR/attendances/doc_report/'+fromDate+'/'+toDate+'/'+empno+'/'+empname;
		if(empno && empname && fromDate && toDate) {
			return $('iframe')[0].src=get;
		}
	}

	//
	$scope.printSummary = function(fromDate,toDate){
		console.log(fromDate);
		console.log(toDate);
		
		var get = '/DTR/attendances/summary_report/'+fromDate+'/'+toDate;
		if(fromDate && toDate) {
			return $('iframe')[0].src=get;
		}
	
		
	}
	
});

