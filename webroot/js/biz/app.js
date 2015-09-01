var app = angular.module('app', []);
 
 
app.controller('PageController', ['$scope', function($scope) {
	$scope.page = test;
	$scope.current_step_index = 0;
	$scope.previous_step_index = 0;
	$scope.previous_step = null;
	$scope.current_step = $scope.page.steps[$scope.current_step_index];
	$scope.summary ={};
	$scope.summary.net_total = 0;
	$scope.summary.payment_scheme={'gross_amount':0};
	$scope.summary.adjustments={'amount':0};
	$scope.isCurrent =  function(step){
		return $scope.current_step_index === step;
	}
	$scope.advanceStep = function(index) {
		var field = $scope.current_step.step.field;
		var value = $scope.current_step.step.selections[index]['value'];
		$scope.summary[field]= value;
		if(field=='payment_scheme'||field=='adjustments'){
			$scope.summary.net_total = $scope.summary.payment_scheme.gross_amount + $scope.summary.adjustments.amount;
		}
		$scope.current_step_index ++;
		$scope.current_step = $scope.page.steps[$scope.current_step_index];
		$scope.previous_step_index = $scope.current_step_index-1;
		$scope.previous_step = $scope.page.steps[$scope.previous_step_index];
	}
  $scope.backStep = function() {
	var field = $scope.page.steps[$scope.current_step_index-1].step.field;
	$scope.summary[field]=null;
	if(field=='payment_scheme'||field=='adjustments'){
		if(field=="payment_scheme")  $scope.summary.payment_scheme= {'gross_amount':0};
		if(field=="adjustments")  $scope.summary.adjustments={'amount':0};
		$scope.summary.net_total = $scope.summary.payment_scheme.gross_amount + $scope.summary.adjustments.amount;
	}
	$scope.current_step_index --;
	$scope.current_step = $scope.page.steps[$scope.current_step_index];}
}]);