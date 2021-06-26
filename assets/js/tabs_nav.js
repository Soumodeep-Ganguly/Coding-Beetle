$(document).ready(function(){
	var loca = window.location.hash.substr(1);
	if (loca == 'question_tab') {
		$('.nav-link').removeClass('active');
		$('#question').addClass('active');
		$('.row.ml-3.mr-3').addClass('d-none');
		$('.row#question_tab').removeClass('d-none');
	}else if(loca == 'topics_tab'){
		$('.nav-link').removeClass('active');
		$('#topics').addClass('active');
		$('.row.ml-3.mr-3').addClass('d-none');
		$('.row#topics_tab').removeClass('d-none');
	}else if(loca == 'recent_tab'){
		$('.nav-link').removeClass('active');
		$('#recent').addClass('active');
		$('.row.ml-3.mr-3').addClass('d-none');
		$('.row#recent_tab').removeClass('d-none');
	}
	$('.nav-link').on('click',function(){
		var get_id = '#' + $(this).get(0).id + '_tab'
		var url = window.location.href;
		window.location.href = url.split('#')[0] + get_id;
		location.reload();
	});
});