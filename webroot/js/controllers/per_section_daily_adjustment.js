App.controller('PerSectionDailyAdjustmentController',function($scope,$rootScope,$http,$uibModal, $log, $document){
	var $ctrl = this;
	
	$rootScope.initializeController = function(){
		$rootScope.currentPage = 1; 
		$rootScope.pageSize = null;
		
		//TRANSLATE DATA FROM MAIN PAGE
		$rootScope.secId = $('#PerSectionDailyAdjustmentTable caption h3').attr('secId');
		$rootScope.date = $('#PerSectionDailyAdjustmentTable caption h3').attr('date');
		$rootScope.secName =  $('#PerSectionDailyAdjustmentTable caption h3 #SectionName').text();
		$http.get('/DTR/rfid_studattendances/per_sec_data_adjustment/'+$rootScope.secId+'/'+$rootScope.secName+'/'+$rootScope.date).success(function(response) {
			$rootScope.Students = response;
			console.log(response);
		});	
	}
	
	$ctrl.open = function (data,size, parentSelector) {
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
}).filter('cmdate', [
    '$filter', function($filter) {
        return function(input, format) {
            return $filter('date')(new Date(input), format);
        };
    }
]);
App.controller('ModalInstanceCtrl', function ($rootScope,$uibModalInstance, StudentData,$filter) {
		
	var $ctrl = this;
	$ctrl.active = false;

	if(StudentData.Attendance){
		$.each(StudentData.Attendance,function(i,o){
			StudentData.Attendance[i]['TimeInDate'] =  new Date(o.Date +' '+o.TimeIn);
			StudentData.Attendance[i]['TimeOutDate'] =  new Date(o.Date +' '+o.TimeOut);
		});
	}
	
	$ctrl.StudentData = StudentData;
	
	
	$ctrl.copyTimeIn = function(o){
		$ctrl.TimeIn =  o.TimeInDate;
	}

	$ctrl.copyTimeOut = function(o){
		$ctrl.TimeOut =  o.TimeOutDate;
	}
	
	$ctrl.on = function() { 
		$ctrl.active = true;	
	}
	
	$ctrl.off = function() { 
		$ctrl.AttendanceForm.$valid = $ctrl.active = false;
	}
	
	$ctrl.save = function () {
		var TimeIn = $filter('date')($ctrl.TimeIn, "HH:mm a");
		var TimeOut = $filter('date')($ctrl.TimeOut, "HH:mm a");
		
		$.ajax({
			url: '/DTR/admin/rfid_studattendances/per_section_saving',
			dataType:'json',
			data:{'data':{'TimeIn':TimeIn,'TimeOut':TimeOut,'date':$rootScope.date,'sno':StudentData.StudentNo,'rfid':StudentData.StudentRFID,'remarks':$ctrl.Remarks}},
			type:'post',
		}).done(function( response ) {
			$rootScope.initializeController();
			$uibModalInstance.close('');
		});
		
	};

	$ctrl.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};
	

});


