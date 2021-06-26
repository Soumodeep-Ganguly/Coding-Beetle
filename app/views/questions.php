<?php 
$this->load->view('includes/header.php');
$this->load->view('includes/sidenav.php');
?>
<?php
if ($this->session->flashdata('error')){
	?>
	<script>swal("Sorry!", "<?=$this->session->flashdata('error');?>", "error");</script>
	<?php
}
if ($this->session->flashdata('success')){
	?>
	<script>swal("Success!", "<?=$this->session->flashdata('success');?>", "success");</script>
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
		if (@$questions) {
			echo "<div class='row ml-2 mr-2'>";
			foreach ($questions as $row) {
				?>
				<div class="card col-md-12 mt-2">
			        <div class="card-body">
			            <h4 class="card-title">
			            	Tags: <small>
	                        <?php
	                        $string = $row['tags'];
	                        $tags = explode(",",$string);
	                        foreach ($tags as $tag) {
	                            echo "<span class='badge badge-primary ml-2 p-1'>".$tag."</span>";
	                        }
	                        ?></small>
			            </h4>
			            <p class="card-text">
			            	<?php
							    $string = (strlen($row['question']) > 100) ? substr($row['question'],0,100).'...' : $row['question'];
							    echo $string;
						    ?>	
					    </p>
			            <a href="<?=base_url().'questions/view/'.$row['question_id'];?>" class="btn btn-primary">View Question →</a>
			        </div>
		        </div>
				<?php
			}echo "</div>";
			?>
			<div class="row justify-content-center mt-2">
				<?=$this->pagination->create_links();?>
			</div>
			<?php
		}
		?>
		<div class="row ml-2 mr-2">
		<?php
		if (@$question) {
			?>
			<div class="card col-md-12 mt-2">
		        <div class="card-body">
		            <h4 class="card-title">
		            	Tags: <small class="card-subtitle mb-2 text-muted"><?=$question['tags'];?></small>
		            </h4>
		            <p class="card-text">
		            	<?=$question['question'];?>
				    </p>
		        </div>
		        <div class="card-footer text-muted">
		            Questioned on <?php 
		            $date = $question['created_on']; 
		            echo date("d-m-Y H:i",strtotime($date));
		            ?>
		            <?php
					if ($this->am->getUserId($this->session->userdata('email')) == $this->ques->questionUser($question['question_id'])) {
						?>
		            	<span class="float-right"><a href="<?=base_url();?>delete-question/<?=$question['question_id'];?>" class="btn btn-danger btn-sm">Delete</a></span>
		            <?php
		        	}
		            ?>
		        </div>
	        </div>
	        <div class="col-md-12">
	        	<h3>Answers</h3>
	        </div>
	        <?php
	        if (@$answers) {
	        	foreach ($answers as $row) {
	        		?>
	        		<div class="card col-md-12 mt-2" id="answer<?=$row['answer_id'];?>">
				        <div class="card-body">
				            <p class="card-text">
				            	<?=$row['answer'];?>
						    </p>
				        </div>
				        <div class="card-footer text-muted">
				            Answered on <?php 
				            $date = $row['created_on']; 
				            echo date("d-m-Y H:i",strtotime($date));
				            ?>
				            <?php
								if ($this->am->getUserId($this->session->userdata('email')) == $this->ans->answerUser($row['answer_id'])) {
									?>
					            	<span class="float-right"><a href="<?=base_url();?>delete-answer/<?=$row['answer_id'];?>" class="btn btn-danger btn-sm">Delete</a></span>
					            <?php
					        	}
					            ?>
				        </div>
			        </div>
	        		<?php
	        	}
	        }
	        ?>
	        <div class="col-md-12">
        	<?php
			echo form_open('answer',array('id'=>'question_form')); 
			?>
				<input type="hidden" name="question" value="<?=$question['question_id'];?>">
				<div class="form-group row">
					<?php
				    echo form_label('Your Answer : (Login Required) ', 'answer',array('class'=>'form-control-label col-4 col-md-4 mt-2')); 
			   		echo form_textarea(array('type'=>'text','class'=>'form-control col-md-8 col-8','id'=>'answer','placeholder'=>'Your Question','name'=>'answer')); 
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
			<?php
			}
			?>
		</div>
		
		<?php
		if(@$my_answers){
			foreach ($my_answers as $row) {
				$question = $this->ques->getQuestion($row['question_id']);
				?>
				<div class="row ml-2 mr-2">
					<div class="card col-md-12 mt-2">
				        <div class="card-body">
				            <h4 class="card-title">
				            	Tags: <small>
		                        <?php
		                        $string = $question['tags'];
		                        $tags = explode(",",$string);
		                        foreach ($tags as $tag) {
		                            echo "<span class='badge badge-primary ml-2 p-1'>".$tag."</span>";
		                        }
		                        ?></small>
				            </h4>
				            <p class="card-text">
				            	<?php
								    $string = (strlen($question['question']) > 120) ? substr($question['question'],0,100).'...' : $question['question'];
								    echo $string;
							    ?>	
							    <hr class="my-4">
							    <strong>Your Answer:</strong> <?php
								    echo $row['answer'];
							    ?>	
						    </p>
				        </div>
				        <div class="card-footer text-muted">
				            <a href="<?=base_url().'questions/view/'.$row['question_id'];?>#answer<?=$row['answer_id'];?>" class="btn btn-primary">View Question →</a>
				        </div>
			        </div>
		        </div>
				<?php
			}
			?>
			<div class="row justify-content-center mt-2">
				<?=$this->pagination->create_links();?>
			</div>
			<?php
		}
		?>
		
	</div>
</div>
<?php $this->load->view('includes/footer.php'); ?>