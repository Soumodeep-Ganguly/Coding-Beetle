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
	<div class="container-fluid">
		<form class="form-inline row justify-content-center mt-3" method="GET" action="<?= base_url().'admin/search' ?>">
			<div class="form-group col-9 col-md-9">
			    <input type="text" class="form-control" name="search_input" id="search_input" placeholder="Search here" style="min-width: 100%;">
			</div>
			<input type="submit" class="btn btn-default col-3 col-md-3" name="search" id="search" value="Search">
		</form>
		<?php
			if (@$searched) {
				echo "<div class='row ml-0 mt-3 mr-0'>";
				foreach ($searched as $row) {
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
				echo "</div>";
			}else{
				$this->session->set_flashdata('error', "No Result Found!");
            	redirect('admin');
			}
		?>
	</div>
</div>
<?php $this->load->view('includes/footer.php'); ?>