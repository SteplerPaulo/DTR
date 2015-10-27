App.controller('ReportController',function($scope,$rootScope,$http){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 5;
		
		//GET ALL CATEGORIES
		$http.get("/DTR/attendances/employees").success(function(response) {
			$scope.data = response;
			
		});
	}
	
	//PRINT ICON EVENT HANDLER
	$scope.DateFilterModal = function(empname,empno){
		$('#DateFilterModal').modal();
		$('#DateFilterModal .modal-title').text(empname);
		$('#DateFilterModal .modal-title').attr('empno',empno);
		$('#DateFilterModal .modal-title').attr('empname',empname);
	}
	
	$scope.AdjustButton = function(empname,empno){
		var myDate = new Date();
		var year = myDate.getFullYear();
		var month = myDate.getMonth() + 1;
		if(month <= 9) month = '0'+month;
		var date = year +'-'+ month;
	

		var get = '/DTR/admin/attendances/adjust/'+empno+'/'+empname+'/'+date;

		if(empno && empname && date) {
			return $('iframe')[0].src=get;
		}
	}
	

});

$(document).ready(function(){
	
	$('#GenerateReport').click(function(){
		var date = $('#Month').val();
		var empno = $('#DateFilterModal .modal-title').attr('empno');
		var empname = $('#DateFilterModal .modal-title').attr('empname');
			
		var get = '/DTR/attendances/doc_report/'+empno+'/'+empname+'/'+date;
		
		if(empno && empname && date) {
			$('#DateFilterModal').modal('hide');
			return $('iframe')[0].src=get;
		}
		
	})
	
});