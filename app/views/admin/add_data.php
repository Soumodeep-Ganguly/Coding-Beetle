<?php 
$this->load->view('includes/header.php');
$this->load->view('admin/admin-sidenav.php');
?>
<style type="text/css">
	.wrapper select{
		padding: 10px 0px 10px 10px;
	}
</style>
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
				<h3 class="text-primary"><u>Add Data</u></h3>
			</div>
		</div>
		<div class="col-md-12 mt-3">
			<div class="row">
				<div class="col-md-4">
					<div class="wrapper mt-3">
						<select name="subject_select" id="subject_select" class="form-control" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
						    <option value="0">Select Subject</option>
						    <?php
						    foreach ($results as $row) {
						    	echo "<option value='".$row->subject_name."''>".$row->subject_name."</option>";
						    }
						    ?>
						    <option value="1">Other</option>
						</select>
						<div class="invalid-feedback" id="subject_error" hidden>Subject selection is required.</div>
					</div>
				</div>
				<form class="col-md-8" id="subject_form" method="POST" hidden>
					<div class="row mt-3">
						<div class="form-group col-md-8">
						  <div class="row">
						  	<label class="col-form-label col-4 col-md-6" for="inputDefault">Enter Subject</label>
						  	<input type="text" class="form-control col-8 col-md-6" placeholder="Subject" name="enter_subject" id="enter_subject">
						  </div>
						</div>
						<div class="form-group col-md-4">
						  <button class="btn btn-primary" id="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
			<hr class="my-4" />
			<?php
			echo form_open('admin/add',array('id'=>'register_form')); 
			?>
				<div class="form-group row">
					<input type="text" name="subject" id="subject" hidden>
					<?php
					if (@$subject_error) {
						?>
						<script>
							alert("Please select a subject");
						</script>
						<?php
					}
					?>
				</div>
				<div class="form-group row">
					<?php
				    echo form_label('Topic :', 'topic',array('class'=>'form-control-label col-4 col-md-4 mt-2')); 
				    if (@$topic_error) {
				    	echo "<div class='col-8 col-md-8'>";
				   		echo form_input(array('type'=>'text','class'=>'form-control is-invalid','id'=>'topic','placeholder'=>'Topic','name'=>'topic')); 
				   		echo "<div class='invalid-feedback'>".$topic_error."</div></div>";
				    }else{
				   		echo form_input(array('type'=>'text','class'=>'form-control col-md-8 col-8','id'=>'topic','placeholder'=>'Topic','name'=>'topic','value'=>set_value('topic'))); 
				    }
				    ?>
				</div>
				<div class="form-group row">
					<?php
				    echo form_label('Description :', 'description',array('class'=>'form-control-label col-4 col-md-4 mt-2')); 
				    if (@$description_error) {
				    	echo "<div class='col-8 col-md-8'>";
				   		echo form_textarea(array('type'=>'text','class'=>'form-control is-invalid','id'=>'description','placeholder'=>'Description','name'=>'description')); 
				   		echo "<div class='invalid-feedback'>".$description_error."</div></div>";
				    }else{
				   		echo form_textarea(array('type'=>'text','class'=>'form-control col-md-8 col-8','id'=>'description','placeholder'=>'Description','name'=>'description','value'=>set_value('description'))); 
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
<script src="<?= base_url(); ?>assets/js/add_data.js"></script>
<script>
	$(document).ready(function(){
		$("#topic").on("input", function(){
          var regexp = /[^a-zA-Z ]/g;
          if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
          }
        });
	});
</script>
<?php $this->load->view('includes/footer.php'); ?>