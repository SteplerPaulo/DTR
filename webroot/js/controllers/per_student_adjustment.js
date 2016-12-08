App.controller('StudentAttendanceAdjustmentController',function($scope,$rootScope,$http,$uibModal, $log, $document){
	
	
	$rootScope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 15;
		
		//TRANSLATE DATA FROM MAIN PAGE
		$rootScope.fromDate = $('#AdjustmetTable caption h3').attr('fromdate');
		$rootScope.toDate = $('#AdjustmetTable caption h3').attr('todate');
		$rootScope.sno = $('#AdjustmetTable caption h3').attr('sno');
		$rootScope.sname =  $('#AdjustmetTable caption h3 #StudentName').text();
		
		$http.get('/DTR/rfid_studattendances/data/'+$scope.fromDate+'/'+$scope.toDate+'/'+$scope.sno+'/'+$scope.sname).success(function(response) {	
			$scope.data = response;
		});	
		
		$http.get('/DTR/rfid_studattendances/remarks/').success(function(response) {	
			$rootScope.remarks = response;
			console.log(response);
		});	
		
	}
	
	
	$rootScope.open = function (data,size, parentSelector) {
		var parentElem = parentSelector ? 
			angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
		var modalInstance = $uibModal.open({
			animation: true,
			ariaLabelledBy: 'modal-title',
			ariaDescribedBy: 'modal-body',
			templateUrl: 'myModalContent.html',
			controller: 'ModalInstanceCtrl',
			controllerAs: '$ctrl',
			size: size,
			appendTo: parentElem,
			resolve: {
				StudentData: function () {
					return data;
				}
			}
		});

	};
	
	//DELETE BUTTON EVENT HANDLER
	$scope.Delete = function(data){		
		$http({
			method: 'POST',
			url: '/DTR/admin/rfid_studattendances/delete/'+$scope.fromDate+'/'+$scope.toDate,
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			$scope.data = response.data;
			$scope.editingData = [];
			$.each($scope.data,function(i,o){
				 $scope.editingData[$scope.data[i].rfid_studattendance.id] = false;
			});
		});
    };
	
	
	/*
	//ADD NEW ENTRY EVENT HANDLER
	$scope.AddNewEntry = function(data){		
		console.log($scope);
		$('#AddNewEntryModal').modal();
		$('#AddNewEntryModal .modal-title').attr('sno',$scope.sno);
		$('#AddNewEntryModal .modal-title').text($scope.sname);
		$('#NewEntryDate').attr('min',$scope.fromDate);
		$('#NewEntryDate').attr('max',$scope.toDate);
		
		//SET MODAL TO DEFAULT MODE
		$('#Notification').html('');
		$('#SaveNewEntry').removeAttr('disabled');
		$('#NewEntryDate').val('').parents('.form-group:first').removeClass('has-error');
		$('#NewEntryTimeIn').val('').parents('.form-group:first').removeClass('has-error');
		$('#NewEntryTimeOut').val('').parents('.form-group:first').removeClass('has-error');
    }
	
	
	$('#SaveNewEntry').click(function(){
		var _from = $('#NewEntryDate').attr('min');
		var to = $('#NewEntryDate').attr('max');
		var sno = $('#AddNewEntryModal .modal-title').attr('sno');
		var date = $('#NewEntryDate').val();
		var timein = $('#NewEntryTimeIn').val();
		var timeout = $('#NewEntryTimeOut').val();
		
		if(date.length && timein.length && timeout.length){
			$.ajax({
				url: '/DTR/admin/rfid_studattendances/add/'+_from+'/'+to,
				dataType:'json',
				data:{'data':{'RfidStudattendance':{'student_number':sno,'date':date,'time_in':timein,'time_out':timeout}}},
				type:'post',
			}).done(function( response ) {
				$rootScope.$broadcast('RefreshAttendance',response);
			});		
		}else{
			//VALIDATE MODAL INPUTS
			if(!date.length) $('#NewEntryDate').parents('.form-group:first').addClass('has-error');
			if(!timein.length) $('#NewEntryTimeIn').parents('.form-group:first').addClass('has-error');
			if(!timeout.length) $('#NewEntryTimeOut').parents('.form-group:first').addClass('has-error');
			$('#SaveNewEntry').attr('disabled','disabled');
		}
	});
	
	//VALIDATE MODAL INPUTS
	$('#NewEntryDate,#NewEntryTimeIn,#NewEntryTimeOut').blur(function(){
		$(this).parents('.form-group:first').removeClass('has-error');
		$('#SaveNewEntry').removeAttr('disabled');
	});
	
	
	//REFRESH ATTENDANCE TABLE
	$scope.$on('RefreshAttendance',function(evt,args){
		$scope.data = args;
		$scope.editingData = [];
		$.each($scope.data,function(i,o){
			 $scope.editingData[$scope.data[i].rfid_studattendance.id] = false;
		});
	});

	//POST BUTTON EVENT HANDLER
	$scope.Post = function(data){
		console.log(data);
		$http({
			method: 'POST',
			url: '/DTR/admin/rfid_studattendances/posting/'+$scope.fromDate+'/'+$scope.toDate,
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			$scope.data = response.data;
			$scope.editingData = [];
			$.each($scope.data,function(i,o){
				 $scope.editingData[$scope.data[i].rfid_studattendance.id] = false;
			});
		});
	}
	*/
});

App.directive('ngConfirmClick', [
	function(){
		return {
			link: function (scope, element, attr) {
				var msg = attr.ngConfirmClick || "Are you sure?";
				var clickAction = attr.confirmedClick;
				element.bind('click',function (event) {
					if ( window.confirm(msg) ) {
						scope.$eval(clickAction)
					}
				});
			}
		};
}]);


App.controller('ModalInstanceCtrl', function ($rootScope,$uibModalInstance, StudentData,$filter) {

	var $ctrl = this;
	$ctrl.active = false;
	$ctrl.o = StudentData;
	$ctrl.TimeInDate = new Date(StudentData.rfid_studattendance.date +' '+StudentData.rfid_studattendance.time_in);
	$ctrl.TimeOutDate = new Date(StudentData.rfid_studattendance.date +' '+StudentData.rfid_studattendance.time_out);
	$ctrl.RFIDStudAttendanceId = StudentData.rfid_studattendance.id;
	$ctrl.StudentNumber = StudentData.rfid_studattendance.student_number;
	$ctrl.SelectedRemark = StudentData.rfid_studattendance.remarks;


	$ctrl.on = function() { 
		 $ctrl.active = true;
	}
	
	$ctrl.off = function() { 
		$ctrl.AttendanceForm.$valid = $ctrl.active = false;
	}
	
	
	$ctrl.save = function () {
		var data = {'rfid_studattendance':{
						'id':$ctrl.RFIDStudAttendanceId,
						'student_number':$ctrl.StudentNumber,
						'time_in': $filter('date')($ctrl.TimeInDate, "HH:mm a"),
						'time_out':$filter('date')($ctrl.TimeOutDate, "HH:mm a"),
						'remarks':$ctrl.SelectedRemark,
				}};
		
		$.ajax({
			method: 'POST',
			url: '/DTR/admin/rfid_studattendances/update/'+$rootScope.fromDate+'/'+$rootScope.toDate,
			dataType:'json',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			$rootScope.initializeController();
			$uibModalInstance.close('');
		});
	};
	
	
	$ctrl.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};
});





//REFERNCE FOR UPDATING TABLE DATA
//http://plnkr.co/edit/Z0zNB1Dm04T4OnaouJYx?p=preview
//DIALOG CONFIRMATION REFERENCE SITE
//http://plnkr.co/edit/YWr6o2?p=preview