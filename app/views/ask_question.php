<?php 
$this->load->view('includes/header.php');
$this->load->view('includes/sidenav.php');
?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'table emoticons template paste help'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | link image | print preview media fullpage | ' +
      'forecolor backcolor emoticons | help',
    menu: {
      favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'css/content.css'
});</script>
<div class="main-wrapper">
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row justify-content-center">
				<h3 class="text-primary"><u>Ask Your Question</u></h3>
			</div>
		</div>
		<div class="col-md-12 mt-2">
			<?php
			echo form_open('ask-question',array('id'=>'question_form')); 
			?>
				<div class="form-group row">
					<?php
				    echo form_label('Tags : (Required)', 'tags',array('class'=>'form-control-label col-4 col-md-4 mt-2')); 
				    if (@$tags) {
				    	echo "<div class='col-8 col-md-8'>";
				   		echo form_input(array('type'=>'text','class'=>'form-control is-invalid','id'=>'tags','placeholder'=>'Example: tag1,tag2','name'=>'tags')); 
				   		echo "<div class='invalid-feedback'>".$tags."</div></div>";
				    }else{
				   		echo form_input(array('type'=>'text','class'=>'form-control col-md-8 col-8','id'=>'tags','placeholder'=>'Example: tag1,tag2','name'=>'tags','value'=>set_value('tags'))); 
				    }
				    ?>
				</div>
				<div class="form-group row">
					<?php
				    echo form_label('Your Question :', 'question',array('class'=>'form-control-label col-4 col-md-4 mt-2')); 
				    if (@$question) {
				    	echo "<div class='col-8 col-md-8'>";
				   		echo form_textarea(array('type'=>'text','class'=>'form-control is-invalid','id'=>'question','placeholder'=>'Your Question','name'=>'question')); 
				   		echo "<div class='invalid-feedback'>".$question."</div></div>";
				    }else{
				   		echo form_textarea(array('type'=>'text','class'=>'form-control col-md-8 col-8','id'=>'question','placeholder'=>'Your Question','name'=>'question')); 
				    }
				    ?>
				</div>
				<div class="row justify-content-center mb-5">
					<?= form_submit('save', 'Save',array('class'=>'btn btn-primary mr-3','id'=>'save','name'=>'save')); ?>
					<a href="javascript:history.go(-1)" class="btn btn-secondary">Cancel</a>
				</div>
			<?php
			echo form_close(); 
			?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#tags").on("input", function(){
          var regexp = /[^a-zA-Z,]/g;
          if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
          }
        });
	});
</script>
<?php $this->load->view('includes/footer.php'); ?>