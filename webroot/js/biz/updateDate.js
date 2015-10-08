
$(document).ready(function() {
	
    function update() {
		$.ajax({
		type: 'POST',
		url: '/DTR/attendances/datetime',
		timeout: 1000,
		success: function(data) {
				$("#timer").html(data); 
				window.setTimeout(update, 1000 * 60 * 60);
			}
		});
     }
     update();
});