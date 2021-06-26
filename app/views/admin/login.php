<?php 
$this->load->view('includes/header.php');
?>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<?php 
			echo form_open('login',array('id'=>'register_form')); 
			echo form_fieldset('Log In Here');
			?>
			<div class="form-group mt-3">
				<?php
			    echo form_label('Email', 'email',array('class'=>'form-control-label')); 
			    if (@$email_error) {
			   		echo form_input(array('type'=>'email','class'=>'form-control is-invalid','id'=>'email','placeholder'=>'example@email.com','name'=>'email')); 
			   		echo "<div class='invalid-feedback'>".$email_error."</div>";
			    }else{
			   		echo form_input(array('type'=>'email','class'=>'form-control','id'=>'email','placeholder'=>'example@email.com','name'=>'email','value'=>set_value('email'))); 
			    }
			    ?>
			</div>
			<div class="form-group">
				<?php
			    echo form_label('Password', 'password',array('class'=>'form-control-label')); 
			    if (@$password_error) {
			   		echo form_password(array('class'=>'form-control is-invalid','id'=>'password','placeholder'=>'Password','name'=>'password')); 
			   		echo "<div class='invalid-feedback'>".$password_error."</div>";
			    }else{
			   		echo form_password(array('class'=>'form-control','id'=>'password','placeholder'=>'Password','name'=>'password')); 
			    }
			    ?>
			</div>
			<?php
			if ($this->session->flashdata('invalid')) {
				?>
				<script>swal("Oops!", "<?=$this->session->flashdata('invalid');?>", "error");</script>
				<?php
			}
			?>
			<div class="row justify-content-center">
				<?= form_submit('login', 'Log In',array('class'=>'btn btn-primary mr-3','id'=>'login','name'=>'login')); ?>
			</div>
			<div class="row justify-content-center">
				<div class="mt-2">
					<?= "Don't have an account?&nbsp&nbsp".anchor(base_url().'registration','Register'); ?>
				</div>
			</div>
			<?php
			echo form_fieldset_close();
			echo form_close(); 
			?>
		</div>
	</div>
</div>

<?php 
$this->load->view('includes/footer.php'); 
?>