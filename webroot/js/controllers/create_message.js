App.controller('SendingMessageController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){

		$scope.MessageTo = '09175683891';
		$scope.MessageFrom = '09171234567';
		$scope.SendingStatus = false; 
		
		$scope.Send = function(){	
			var data = {};
			data['MessageOut'] = {};
			data['MessageOut']['MessageTo'] = $scope.MessageTo;
			data['MessageOut']['MessageText'] = $scope.MessageText;
			data['MessageOut']['MessageFrom'] = $scope.MessageFrom;
			
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
		
		$scope.CreateNewMessage = function (){
			$scope.SendingStatus = false; 
		};
		
	
	}
});