<?php 
$this->load->view('includes/header.php');
$this->load->view('includes/sidenav.php');
?>
<style type="text/css">
	.heading{
		font-size: 2.2em !important;
	}
	.nav-tabs > li > a
	{
	    /* adjust padding for height*/
	    padding: 7px;
	}
	.nav-tabs > li.active > a:focus, .nav-tabs > li.active > a
	{
	    margin-top: 1px;
	}
	.nav-tabs > li {
	    margin-bottom: 0px; 
	}
	.nav-tabs > li.active {
	    margin-bottom: -1px;    
	}
	@media only screen and (max-width: 600px) {
		.heading{
			font-size: 1.5em !important;
		}
	}
</style>
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
<div class="main-wrapper">
	<section class="cta-section theme-bg-light py-5">
	    <div class="container text-center">
		    <h3 class="heading">Coding Beetle - A place to learn</h3>
		    <div class="intro">Welcome to Coding Beetle. Let's Begin our journey of gaining knowledge and having some fun.</div>
	    </div><!--//container-->
    </section>
	<div class="container-fluid mt-3">
		<ul class="nav nav-tabs">
		  	<li class="nav-item">
		   		<a class="nav-link active" href="<?=site_url();?>#post_tab" id="post">Posts</a>
		  	</li>
		  	<!-- <li class="nav-item dropdown">
		    	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
			    <div class="dropdown-menu">
				    <a class="dropdown-item" href="#">Action</a>
				    <a class="dropdown-item" href="#">Another action</a>
				    <a class="dropdown-item" href="#">Something else here</a>
				    <div class="dropdown-divider"></div>
				    <a class="dropdown-item" href="#">Separated link</a>
			    </div>
		  	</li> -->
		  	<li class="nav-item">
		    	<a class="nav-link" href="<?=site_url();?>#question_tab" id="question">Questions</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="<?=site_url();?>#topics_tab" id="topics">Topics</a>
		  	</li>
		</ul>
	    <div class="row ml-3 mr-3 mt-2" id="post_tab">
	    <?php
	    // echo "<h4>Recent Posts</h4>";
	    foreach ($top as $row) {
	    	?>
	    	<div class="card col-md-11 mb-4">
		        <div class="card-body">
		            <h4 class="card-title">
		            	<a href="<?=base_url().'programming/'.$row['topic_id'].'/'.str_replace(' ', '-',$row['subject']).'/'.str_replace(' ', '-',$row['topic']);?>"><?=$row['topic'];?></a> · 
		            	<small class="card-subtitle mb-2 text-muted"><?=$row['subject'];?></small>
		            </h4>
		            <p class="card-text">
		            	<?php
						    $string = (strlen($row['description']) > 100) ? substr($row['description'],0,100).'...' : $row['description'];
						    echo $string;
					    ?>						    	
				    </p>
		            <a href="<?=base_url().'programming/'.$row['topic_id'].'/'.str_replace(' ', '-',$row['subject']).'/'.str_replace(' ', '-',$row['topic']);?>" class="btn btn-primary">Read More →</a>
		        </div>
		        <div class="card-footer text-muted">
		            Created on <?php 
		            $date = $row['created_on']; 
		            echo date("d-m-Y H:i",strtotime($date));
		            ?>
		        </div>
	        </div>
	    	<?php
	    }
	    ?>
	    </div>
	    <div class="row ml-3 mr-3 d-none" id="question_tab">
    		<div class="col-md-12">
    			<a href="<?= base_url(); ?>ask-question/" class="btn btn-primary float-right mt-1">Ask Question</a>
    		</div>
    		<?php
			if (@$questions) {
				foreach ($questions as $row) {
					?>
					<div class="card col-md-11 mt-2">
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
				}
			}
			?>
	    </div>
	    <div class="row justify-content-center ml-3 mr-3 mb-3 d-none" id="topics_tab">
	    	<div class="col-12 col-md-9 list-group mt-3 ml-3">
				<a href="<?= base_url(); ?>programming/" class="list-group-item list-group-item-action active">
				    <i class="fas fa-code fa-fw mr-2"></i>Programming
				</a>
			</div>
			<div class="col-12 col-md-9 list-group mt-3 ml-3">
				<a href="<?= base_url(); ?>questions/" class="list-group-item list-group-item-action active">
				    <i class="fas fa-question-circle fa-fw mr-2"></i>Questions
				</a>
			</div>
			<div class="col-12 col-md-9 list-group mt-3 ml-3">
				<a href="<?= base_url(); ?>ask-question/" class="list-group-item list-group-item-action active">
				    <i class="fas fa-question fa-fw mr-2"></i>Ask Questions (Login Required)
				</a>
			</div>
			<div class="col-12 col-md-9 list-group mt-3 ml-3">
				<a href="<?= base_url(); ?>my-questions/" class="list-group-item list-group-item-action active">
				    <i class="fab fa-quora fa-fw mr-2"></i>My Questions (Login Required)
				</a>
			</div>
			<div class="col-12 col-md-9 list-group mt-3 ml-3">
				<a href="<?= base_url(); ?>my-answers/" class="list-group-item list-group-item-action active">
				    <i class="fas fa-font fa-fw mr-2"></i>My Answers (Login Required)
				</a>
			</div>
	    </div>
    </div>
    <footer class="footer text-center py-2 theme-bg-dark">
        <small class="copyright">&copy Coding Beetle by Soumodeep Ganguly</small>	   
    </footer>

</div><!--//main-wrapper-->
<script src="<?=base_url();?>assets/js/tabs_nav.js"></script>
<?php $this->load->view('includes/footer.php'); ?>