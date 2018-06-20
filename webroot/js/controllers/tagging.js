App.controller('ImageTaggingController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 15;
		$scope.fullimgpath = '../img/defaultstep.jpg';
		$scope.selected = null;
		$scope.intent = 'Save';
		$scope.studname = null;
		
		//IMAGE WITHOUT RFID
		$http.get("/DTR/images/notag").success(function(response) {
			$scope.notagimage = response;
			//console.log(response);
		});
		
		//IMAGE WITH SOURCE RFID
		$http.get("/DTR/images/withtag").success(function(response) {
			$scope.withtagimage = response;
			//console.log(response);
		});
		
		//STUDENT LIST FROM RFID STUDENT TABLE -  USE FOR STUDENT NAME TYPEAHEAD
		$http.get("/DTR/images/student_list").success(function(response) {
			$input.typeahead({
					source: response,
					autoSelect: true
				});
		});
	}
	
	$scope.tagImg =  function(d){
		$scope.fullimgpath = '../img/fortagging/'+d.Image.img_path;
		$scope.imgpath = d.Image.img_path;
		$scope.selected = $scope.imgid = d.Image.id;
		$scope.intent = 'Save';
		$scope.wtfilter = $scope.studname = null;
	}
	
	$scope.changeTag =  function(d){
		$scope.fullimgpath = '../img/fortagging/'+d.Image.img_path;
		$scope.imgpath = d.Image.img_path;
		$scope.selected = $scope.imgid = d.Image.id;
		$scope.intent = 'Change';
		$scope.studname = d.Image.name;
		console.log(d);
	}
	
	
	
	
	$scope.intentTo = function(){
		if($scope.intent == "Save"){
		
			if($scope.imgid){
				var student = $input.typeahead("getActive");
				student['id'] = $scope.imgid;
				$http({
					method: 'POST',
					url: '/DTR/images/savetag',
					data: $.param({data:student}),
					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).then(function(response) {
					$scope.initializeController();
					$scope.selected = response.data.id;
					$scope.wtfilter = $scope.imgpath;
					
					console.log(response);
				});
			}		
			
			
	
		}else{
			$scope.intent = "Save";
			$scope.studname = '';
			console.log($scope.intent);
		}
		
	}
	
	
	
	
	//TYPE AHEAD
	var $input = $("#name");
	var $student;
	$input.change(function() { //inaabangan ang event na change
		var current = $input.typeahead("getActive"); //kinukuha yung current active item
		if (current) { //if may laman
			if (current.name == $input.val()) {
				student = current;
				$scope.intent = 'Save';
			}
		}
	});
	
	
	



	
	
});