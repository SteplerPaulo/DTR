var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
$(document).ready(function(){
	$('#Student201SectionCode option').addClass('hide');
	$('#Student201SectionCode').find('option:first').removeClass('hide');
		
	$('#Student201LevelId').change(function(){
		var selected = $(this).val();
		var level =$('#Student201LevelId').find('[value="'+selected+'"]').attr('level')
		$('#Student201SectionCode option').addClass('hide');
		$('#Student201SectionCode').find('option:first').removeClass('hide');
		$('#Student201SectionCode').find('[level="'+level+'"]').removeClass('hide');
	});
});

