var intVal, myclock;
$(window).resize(function(){
	window.location.reload()
});

$(document).ready(function(){
	var audioElement = new Audio("");
	//clock plugin constructor
	$('#myclock').thooClock({
		size:$(document).height()/3,
		onAlarm:function(){
			//all that happens onAlarm
			$('#alarm1').show();
			alarmBackground(0);
			//audio element just for alarm sound
			document.body.appendChild(audioElement);
			var canPlayType = audioElement.canPlayType("audio/ogg");
			if(canPlayType.match(/maybe|probably/i)) {
				audioElement.src = 'alarm.ogg';
			} else {
				audioElement.src = 'alarm.mp3';
			}
			// erst abspielen wenn genug vom mp3 geladen wurde
			audioElement.addEventListener('canplay', function() {
				audioElement.loop = true;
				audioElement.play();
			}, false);
		},
		showNumerals:true,
		brandText:'JSM',
		brandText2:'CLOCK',
		onEverySecond:function(){
			//callback that should be fired every second
		},
		//alarmTime:'15:10',
		offAlarm:function(){
			$('#alarm1').hide();
			audioElement.pause();
			clearTimeout(intVal);
			$('body').css('background-color','#FCFCFC');
		}
	});

});



$('#turnOffAlarm').click(function(){
	$.fn.thooClock.clearAlarm();
});


$('#set').click(function(){
	var inp = $('#altime').val();
	$.fn.thooClock.setAlarm(inp);
});

	
function alarmBackground(y){
		var color;
		if(y===1){
			color = '#CC0000';
			y=0;
		}
		else{
			color = '#FCFCFC';
			y+=1;
		}
		$('body').css('background-color',color);
		intVal = setTimeout(function(){alarmBackground(y);},100);
}