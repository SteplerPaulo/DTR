$(document).ready(function(){
	$('a').click(function(){
		var theme = $(this).attr('theme');
		console.log(theme);
		$('body').attr('id',theme)
	});
});