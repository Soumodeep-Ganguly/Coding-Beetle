$(document).ready(function(){
	$('#subject_select').on('change',function(){
		var option = $(this).val();
		if (option == '0') {
			$(this).addClass('is-invalid');
			$('#subject_error').removeAttr('hidden');
		}else if(option == '1'){
			$('#subject_form').removeAttr('hidden');
		}else{
			$('#subject').val(option);
			$('#subject_form').attr('hidden',true);
		}
	});

	$("#enter_subject").on("input", function(){
      var regexp = /[^a-zA-Z0-9 ]/g;
      if($(this).val().match(regexp)){
        $(this).val( $(this).val().replace(regexp,'') );
      }
    });

	$('#subject_form').submit(function(e){
		e.preventDefault();
		var subject = $('#enter_subject').val();
		var submit = $('#submit').val();

		$.ajax({
           url: '/admin/add_subject',
           type: 'POST',
           data: {subject: subject, submit: submit},
           error: function() {
              swal("Sorry!", "An unexpected error have occured!", "error");
           },
           success: function(data) {
           		if(data == "success"){
           			$('#subject').val(subject);
           			swal("Done!", "Subject Successfully Added!", "success");
           		}else{
           			swal("Oops!", "Subject already exists!", "error");
           		}
           }
        });
	});
});