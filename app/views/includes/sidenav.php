<header class="header text-center">	    
    <h1 class="blog-name pt-lg-4 mb-0"><a href="<?= base_url(); ?>index">Coding Beetle</a></h1>
    
    <nav class="navbar navbar-expand-lg navbar-dark" >
       
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div id="navigation" class="collapse navbar-collapse flex-column" >
			<form class="row justify-content-center mt-3" method="GET" action="<?= base_url().'search' ?>">
				<div class="form-group" style="min-width: 80%;">
				    <input type="text" class="form-control" name="search_input" id="search_input" placeholder="Search for...">
				</div>
				<input type="submit" class="btn btn-primary" style="min-width: 50%; max-width: 80%;" name="search" id="search" value="Search">
			</form>
			<hr style="border: 1px solid white; min-width: 100%;">
            		
			<ul class="navbar-nav flex-column text-left">
				<li class="nav-item active">
				    <a class="nav-link" href="<?= base_url(); ?>"><i class="fas fa-home fa-fw mr-2"></i>Home</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link" href="<?= base_url(); ?>about"><i class="fas fa-user fa-fw mr-2"></i>About Me</a>
				</li>
				<?php
				if ($this->session->userdata('email')) {
					if ($this->am->getUserType($this->session->userdata('email')) == '1') {
						?>
						<li class="nav-item">
						    <a class="nav-link" href="<?= base_url(); ?>admin"><i class="fas fa-user-secret fa-fw mr-2"></i>Admin Panel</a>
						</li>
						<?php
					}
					?>
					<li class="nav-item">
					    <a class="nav-link" href="<?= base_url(); ?>ulogout"><i class="fas fa-toggle-on fa-fw mr-2"></i>Logout</a>
					</li>
					<?php
				}else{
					?>
					<li class="nav-item">
					    <a class="nav-link" href="<?= base_url(); ?>login"><i class="fa fa-toggle-off fa-fw mr-2"></i>Log In</a>
					</li>
					<li class="nav-item">
					    <a class="nav-link" href="<?= base_url(); ?>registration"><i class="fas fa-user-plus fa-fw mr-2"></i>Register</a>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
	</nav>
</header>