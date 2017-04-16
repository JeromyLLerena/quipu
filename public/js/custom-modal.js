$(document).ready(function(){
	var prev_icon_selected = null;
	$('.img-icon').click(function(){
		if (prev_icon_selected) {
			prev_icon_selected.removeClass('img-icon-bg');
		}
		$(this).addClass('img-icon-bg');
		prev_icon_selected = $(this);
		$('#icon-input').val($(this).attr('src'));
		$('.icon-selected').attr('src', $('#icon-input').val());
	});
});