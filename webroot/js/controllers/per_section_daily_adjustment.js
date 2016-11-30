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
		});	
	}
	
	
	
	//VALIDATE MODAL INPUTS
	$('#TimeIn,#TimeOut,#UpdatedRemarks').blur(function(){
		console.log('wew');
		$(this).parents('td:first').removeClass('has-error');
		$('#SaveButton').removeAttr('disabled');
	});
	

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

		modalInstance.result.then(function (selectedItem) {
		  //$ctrl.selected = selectedItem;
		}, function () {
		 // $log.info('Modal dismissed at: ' + new Date());
		});
	};
	
	
}).controller('ModalInstanceCtrl', function ($rootScope,$uibModalInstance, StudentData) {
	//console.log(StudentData);
	//console.log($rootScope);
	
	var $ctrl = this;
	$ctrl.StudentData = StudentData;
	
	$ctrl.remove = function(index) { 
		console.log(index);
		console.log($ctrl.StudentData.Attendance);
		
		$ctrl.StudentData.Attendance.splice(index, 0);     
	}
	
	//
	$ctrl.save = function () {
		
		if($('#StudentAttendanceTable tbody').find('tr').length > 1){
			$('#SaveButton').attr('disabled','disabled');
			
		}else{
			var TimeIn = $('#TimeIn').val();
			var TimeOut = $('#TimeOut').val();
			var Remarks = $('#UpdatedRemarks').find(":selected").val();
			
			if(TimeIn.length && TimeOut.length && Remarks.length){
				$('#SaveButton').removeAttr('disabled');
				$.ajax({
					url: '/DTR/admin/rfid_studattendances/per_section_saving',
					dataType:'json',
					data:{'data':{'TimeIn':TimeIn,'TimeOut':TimeOut,'date':$rootScope.date,'sno':StudentData.StudentNo,'rfid':StudentData.StudentRFID,'remarks':Remarks}},
					type:'post',
				}).done(function( response ) {
					$rootScope.initializeController();
					$uibModalInstance.close('Data Here');
				});		
			}else{
				if(!TimeIn.length) $('#TimeIn').parents('td:first').addClass('has-error');
				if(!TimeOut.length) $('#TimeOut').parents('td:first').addClass('has-error');
				if(!Remarks.length) $('#UpdatedRemarks').parents('td:first').addClass('has-error');
				$('#SaveButton').attr('disabled','disabled');
				
			}	
		}
	};

	$ctrl.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};
	

});

/*
// Please note that the close and dismiss bindings are from $uibModalInstance.
angular.module('App').component('modalComponent', {
  templateUrl: 'myModalContent.html',
  bindings: {
    resolve: '<',
    close: '&',
    dismiss: '&'
  },
  controller: function () {
    var $ctrl = this;

    $ctrl.$onInit = function () {
      $ctrl.items = $ctrl.resolve.items;
      $ctrl.selected = {
        item: $ctrl.items[0]
      };
    };

    $ctrl.ok = function () {
      $ctrl.close({$value: $ctrl.selected.item});
    };

    $ctrl.cancel = function () {
      $ctrl.dismiss({$value: 'cancel'});
    };
  }
});
*/



