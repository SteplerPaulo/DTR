
$(document).ready(function() {
	
    function update() {
		//CALCULATE REMAINING SECONDS UNTIL 12 MIDNIGHT  
		var now = new Date(); // Now
		var day_ahead = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
		var day_tommorow = day_ahead.getDate();
		var month_tommorow = day_ahead.getMonth();
		var year_tommorow = day_ahead.getFullYear();
		var then = new Date(year_tommorow, month_tommorow, day_tommorow, 0, 0, 0, 0); // DATE TOMMOROW WITH 0 LEADING TIME
		var milliseconds = (then-now); // difference in milliseconds 
		//REFERENCE:
		//http://stackoverflow.com/questions/1968167/difference-between-dates-in-javascript //CALCULATE DIFFERENCE BETWEEN DATES 
		//http://stackoverflow.com/questions/9444745/javascript-how-to-get-tomorrows-date-in-format-dd-mm-yy //GET TOMMOROW'S DATE
		//http://www.timeanddate.com/date/durationresult.html?d1=9&m1=10&y1=2015&d2=10&m2=10&y2=2015&h1=19&i1=29&s1=9&h2=0&i2=0&s2=0 //DATE DIFFERENCE CALCULATOR
		//END OF CALCULATION
	
		$.ajax({
			type: 'POST',
			url: '/DTR/attendances/datetime',
			timeout: 1000,
			success: function(data) {
					$("#timer").html(data); 
					window.setTimeout(update, milliseconds);
				}
			});
     }
     update();
	 

});