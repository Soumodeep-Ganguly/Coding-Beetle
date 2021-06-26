<?php 
$this->load->view('includes/header.php');
$this->load->view('admin/admin-sidenav.php');
?>

<div class="main-wrapper">
	<div class="container-fluid">
		<div class="row ml-3 mt-3 mr-0">
			<div class="col-md-10">			
			<?php
				foreach ($topics as $row) {
				?>
				<div class="card mb-4">
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
			?>

			</div>
		</div>
		<div class="row justify-content-center">
			<?=$this->pagination->create_links();?>
		</div>
	</div>
</div>


<?php $this->load->view('includes/footer.php'); ?>