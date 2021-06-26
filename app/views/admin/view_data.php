<?php 
$this->load->view('includes/header.php');
$this->load->view('admin/admin-sidenav.php');
?>

<div class="main-wrapper">
	<div class="container-fluid">
		<div class="row ml-0 mr-0">

		<?php
		if (@$subjects) {
			foreach ($subjects as $row) {
				?>
				<div class="card col-md-11 mb-4">
			        <div class="card-body">
			            <h2 class="card-title">
			            	<a href="<?=base_url().'admin/view/'.$row['topic_id'].'/'.str_replace(' ', '-',$row['subject']).'/'.str_replace(' ', '-',$row['topic']);?>"><?=$row['topic'];?></a> · 
				            	<small class="card-subtitle mb-2 text-muted"><?=$row['subject'];?></small>
			            </h2>
			            <p class="card-text">
			            	<?php
							    $string = (strlen($row['description']) > 100) ? substr($row['description'],0,100).'...' : $row['description'];
							    echo $string;
						    ?>
							    	
					    </p>
			            <a href="<?=base_url().'admin/view/'.$row['topic_id'].'/'.str_replace(' ', '-',$row['subject']).'/'.str_replace(' ', '-',$row['topic']);?>" class="btn btn-primary">Read More →</a>
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
		}
		else if (@$topics) {
			foreach ($topics as $row) {
				?>
				<div class="col-md-10">
					<h1><?=$row['topic'];?></h1>
					<p><?=$row['description'];?></p>
				</div>
				<div class="col-md-10">
					<a href="javascript:history.go(-1)" class="btn btn-secondary">Back</a>
				<?php
				if ($this->am->getUserId($this->session->userdata('email')) == $this->topic->topicUser($row['topic_id'])) {
					?>
						<a href="<?=base_url().'admin/delete/'.$row['topic_id']; ?>" class="btn btn-danger">Delete</a>
						<a href="<?=base_url().'admin/edit/'.$row['topic_id']; ?>" class="btn btn-info">Edit</a>
					
					<?php
				}
				?>
				</div>
				<?php
			}
		}else{
			$this->session->set_flashdata('error', 'That destination is not available');
        	redirect('admin');
		}
		?>

		</div>
	</div>
</div>


<?php $this->load->view('includes/footer.php'); ?>