<?php 
$this->load->view('includes/header.php');
$this->load->view('admin/admin-sidenav.php');
?>

<style type="text/css">
	.wrapper select{
		padding: 10px 0px 10px 10px;
		width: 200px;
	}
</style>

<?php
if ($this->session->flashdata('success')) {
	?>
	<script>swal("Success!", "<?=$this->session->flashdata('success');?>", "success");</script>
	<?php
}if ($this->session->flashdata('error')){
	?>
	<script>swal("Sorry!", "<?=$this->session->flashdata('error');?>", "error");</script>
	<?php
}
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
		<?php
		$form = 'admin/edit/'.$topic['topic_id'];
		echo form_open($form,array('id'=>'register_form')); 
		?>
		<div class="col-md-12">
			<div class="row justify-content-center">
				<h3 class="text-primary"><u>Edit <?=$topic['topic'];?></u></h3>
			</div>
		</div>
		<div class="col-md-12 mt-3">
			<div class="wrapper mt-3 row">
				<?= form_label('Subject :', 'subject',array('class'=>'form-control-label col-4 col-md-4 mt-2')); ?>
				<select name="subject" id="subject" class="form-control col-8 col-md-8" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
				    <?php
				    foreach ($subjects as $row) {
				    	?>
				    	<option value='<?=$row->subject_name;?>' <?= ($topic['subject'] == $row->subject_name)?"selected='selected'":""; ?> > <?=$row->subject_name;?> </option>
				    	<?php
				    }
				    ?>
				</select>
			</div>
			<div class="form-group row mt-3">
				<?= form_label('Topic :', 'topic',array('class'=>'form-control-label col-4 col-md-4 mt-2')); ?>
				<?= form_input(array('type'=>'text','class'=>'form-control col-md-8 col-8','id'=>'topic','placeholder'=>'Topic','name'=>'topic','value'=>$topic['topic'])); ?>
			</div>
			<div class="form-group row mt-3">
				<?= form_label('Description :', 'description',array('class'=>'form-control-label col-4 col-md-4 mt-2')); ?>
				<?= form_textarea(array('type'=>'text','class'=>'form-control col-md-8 col-8','id'=>'description','placeholder'=>'Description','name'=>'description','value'=>$topic['description']));  ?>
			</div>
			<div class="row justify-content-center mb-5">
				<?= form_submit('save', 'Save',array('class'=>'btn btn-primary mr-3','id'=>'save','name'=>'save')); ?>
				<a href="javascript:history.go(-1)" class="btn btn-secondary">Cancel</a>
			</div>
		</div>

		<?php
		echo form_close();
		?>
	</div>
</div>

<?php $this->load->view('includes/footer.php'); ?>