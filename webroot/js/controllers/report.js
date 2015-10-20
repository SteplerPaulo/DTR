App.controller('ReportController',function($scope,$rootScope,$http){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 5;
		
		//GET ALL CATEGORIES
		$http.get("/DTR/attendances/employees").success(function(response) {
			$scope.data = response;
			//console.log(response);
			
		});
	}
	
	//PRINT ICON EVENT HANDLER
	$scope.DateFilterModal = function(empname,empno){
		$('#DateFilterModal').modal();
		$('#DateFilterModal .modal-title').text(empname);
		$('#DateFilterModal .modal-title').attr('empno',empno);
		$('#DateFilterModal .modal-title').attr('empname',empname);
	}
	

});

$(document).ready(function(){
	
	
	$('#PrintReport').click(function(){
		var date = $('#Month').val();
		var empno = $('#DateFilterModal .modal-title').attr('empno');
		var empname = $('#DateFilterModal .modal-title').attr('empname');
			
		var get = '/DTR/attendances/doc_report/'+empno+'/'+empname+'/'+date;
		console.log(get);
		
		if(empno && empname && date) {
			$('#DateFilterModal').modal('hide');
			return $('iframe')[0].src=get;
		}
		
	})
	
});