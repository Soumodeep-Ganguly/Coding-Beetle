<?php 
$this->load->view('includes/header.php');
?>

<div class="container mt-3">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<?php 
			echo form_open('registration',array('id'=>'register_form')); 
			echo form_fieldset('Registration');
			?>
			<div class="form-group has-danger">
			    <?php
			    echo form_label('Username', 'username',array('class'=>'form-control-label')); 
			    if (@$username_error) {
			   		echo form_input(array('class'=>'form-control is-invalid','id'=>'username','placeholder'=>'Username','name'=>'username')); 
			   		echo "<div class='invalid-feedback'>".$username_error."</div>";
			    }else{
			   		echo form_input(array('class'=>'form-control','id'=>'username','placeholder'=>'Username','name'=>'username','value'=>set_value('username'))); 
			    }
			    ?>
			</div>
			<div class="form-group">
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
			   		echo form_password(array('class'=>'form-control','id'=>'password','placeholder'=>'Password','name'=>'password','value'=>set_value('password'))); 
			    }
			    ?>
			</div>
			<div class="form-group">
				<?php
			    echo form_label('Confirm Password', 'confirm-password',array('class'=>'form-control-label'));
			    if (@$confirm_error) {
			   		echo form_password(array('class'=>'form-control is-invalid','id'=>'confirm-password','placeholder'=>'Confirm Password','name'=>'confirm-password')); 
			   		echo "<div class='invalid-feedback'>".$confirm_error."</div>";
			    }else{
			   		echo form_password(array('class'=>'form-control','id'=>'confirm-password','placeholder'=>'Confirm Password','name'=>'confirm-password','value'=>set_value('confirm-password'))); 
			    }
			    ?>
			</div>
			<div class="row justify-content-center">
				<?= form_submit('register', 'Register',array('class'=>'btn btn-primary mr-3','id'=>'register','name'=>'register')); ?>
			</div>
			<div class="row justify-content-center">
				<div class="mt-2">
					<?= 'Already Registered?&nbsp&nbsp'.anchor(base_url().'login','Log In'); ?>
				</div>
			</div>

			<?php
			echo form_fieldset_close();
			echo form_close(); 
			?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#username").on("input", function(){
          var regexp = /[^a-zA-Z ]/g;
          if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
          }
        });
	});
</script>

<?php 
$this->load->view('includes/footer.php'); 
?>