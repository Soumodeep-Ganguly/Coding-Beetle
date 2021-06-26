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
?>
<div class="main-wrapper">
	<div class="container-fluid mt-3">
		<!-- <ul class="navbar-nav flex-column text-left" style="height:200px; min-width:100%;overflow:hidden; overflow-y:scroll;"></ul> -->
		<?php
		if (@$subjects) {
			echo "<div class='row ml-0 mr-0'>";
			foreach ($subjects as $row) {
				?>
				<div class="card col-md-11 mb-4">
				        <div class="card-body">
				            <h2 class="card-title">
				            	<a href="<?=base_url().'programming/'.$row['topic_id'].'/'.str_replace(' ', '-',$row['subject']).'/'.str_replace(' ', '-',$row['topic']);?>"><?=$row['topic'];?></a> · 
				            	<small class="card-subtitle mb-2 text-muted"><?=$row['subject'];?></small>
				            </h2>
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
			echo "</div>";
		}
		else if (@$topics) {
			echo "<div class='row ml-0 mr-0'>";
			foreach ($topics as $row) {
				?>
				<div class="col-md-10">
					<h1><?=$row['topic'];?></h1>
					<p><?=$row['description'];?></p>
				</div>
				<div class="col-md-10">
					<a href="javascript:history.go(-1)" class="btn btn-secondary">Back</a>
				</div>
				<?php
			}
			echo "</div>";
		}else if (@$programs){
			echo "<div class='row justify-content-center'>";
			foreach ($programs as $subject) {
				?>
				<div class="col-5 col-md-3 list-group mt-3 ml-3">
					<a href="<?= base_url(); ?>programming/<?= $subject->subject_name; ?>" class="list-group-item list-group-item-action active">
					    <?= $subject->subject_name; ?>
					</a>
				</div>
				<?php
			}
			echo "</div>";
		}else{
			$this->session->set_flashdata('error', 'That destination is not available');
        	redirect('programming');
		}
		?>
	</div>
</div>

<?php $this->load->view('includes/footer.php'); ?>