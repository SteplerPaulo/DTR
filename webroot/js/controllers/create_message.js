App.controller('SendingMessageController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1;
		$scope.MessageFrom = '09171234567';
		$scope.SendingStatus = false; 
		$scope.isChecked = {}; 
		$scope.Checkbox = false; 
		$scope.selectedContacts = [];
		
		$http.get("/DTR/contacts/all").success(function (response) {
			$scope.contacts = response;
			
		});
	}
	
	//SEND MESSAGE EVENT HANDLER
	$scope.Send = function(){	
		var data = {};
		data['MessageOut'] = {};
		data['MessageOut']['MessageFrom'] = $scope.MessageFrom;
		data['MessageOut']['MessageText'] = $scope.MessageText;
		data['MessageOut']['MessageTo'] = $scope.selectedContacts;
		
		$http({
			method: 'POST',
			url: '/DTR/message_outs/send_message',
		
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			$scope.MessageText = "";
			$scope.SendingStatus = true; 
		});
	};
	
	//CREATE NEW MESSAGE EVENT HANDLER
	$scope.CreateNewMessage = function (){
		$scope.SendingStatus = false;
	};
	
	
	// ADD A CONTACT EVENT HANDLER
	$scope.addContact = function(indx) {
		if(!$scope.isChecked[indx]){
			$scope.contacts[indx].Contact.is_selected = true;
			$scope.isChecked[indx] = true;
			$scope.selectedContacts[indx] = $scope.contacts[indx].Contact.mobile_no; 

		}else{
			$scope.contacts[indx].Contact.is_selected = false;
			$scope.isChecked[indx] = false;
		}
	};
	
	$scope.checkAllContacts = function(){
		if(!$scope.Checkbox){
			$.each($scope.contacts,function(i,o){
				$scope.contacts[i].Contact.is_selected = true; 
				$scope.isChecked[i] = true;
			});
			$scope.Checkbox = true;
		}else{
			$.each($scope.contacts,function(i,o){
				$scope.contacts[i].Contact.is_selected = false; 
				$scope.isChecked[i] = false;
			});	
			$scope.Checkbox = false;
		}
	}

	
	
		
});