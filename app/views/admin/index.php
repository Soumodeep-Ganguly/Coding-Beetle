<?php 
$this->load->view('includes/header.php');
$this->load->view('admin/admin-sidenav.php');
?>
<style type="text/css">
	@media only screen and (max-width: 600px) {
		input#search{
			margin-top: -15px;
		}
	}
</style>
<div class="main-wrapper">
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

<div class="container-fluid">
	<form class="form-inline row justify-content-center mt-3" method="GET" action="<?= base_url().'admin/search' ?>">
		<div class="form-group col-9 col-md-9">
		    <input type="text" class="form-control" name="search_input" id="search_input" placeholder="Search for..." style="min-width: 100%;">
		</div>
		<input type="submit" class="btn btn-default col-3 col-md-3" name="search" id="search" value="Search">
	</form>
	<div class="row justify-content-center">
		<?php
		foreach ($subjects as $subject) {
			?>
			<div class="col-5 col-md-3 list-group mt-3 ml-3">
				<a href="<?= base_url(); ?>admin/view/<?= str_replace(' ', '-',$subject->subject_name); ?>" class="list-group-item list-group-item-action active">
				    <?= $subject->subject_name; ?>
				</a>
			</div>
			<?php
		}
		?>
	</div>
</div>

</div>
<?php $this->load->view('includes/footer.php'); ?>