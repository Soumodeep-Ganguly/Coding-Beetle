<header class="header text-center">     
    <h1 class="blog-name pt-lg-4 mb-0"><a href="<?= base_url(); ?>index">Coding Beetle</a></h1>
    
    <nav class="navbar navbar-expand-lg navbar-dark" >
       
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navigation" class="collapse navbar-collapse flex-column" >
            <div class="profile-section pt-3 pt-lg-0">
                <img class="profile-image mb-3 rounded-circle mx-auto" src="<?= base_url(); ?>assets/images/profile.jpg" alt="image" >     
                <hr> 
            </div><!--//profile-section-->
            
            <ul class="navbar-nav flex-column text-left">
                <li class="nav-item" id="home">
                    <a class="nav-link" href="<?= base_url(); ?>admin"><i class="fas fa-home fa-fw mr-2"></i>Home</a>
                </li>
                <li class="nav-item" id="add">
                    <a class="nav-link" href="<?= base_url(); ?>admin/add"><i class="fas fa-plus fa-fw mr-2"></i>Add Content</a>
                </li>
                <li class="nav-item" id="view">
                    <a class="nav-link" href="<?= base_url(); ?>admin/my"><i class="fas fa-plus-circle fa-fw mr-2"></i>My Content</a>
                </li>
                <li class="nav-item" id="view">
                    <a class="nav-link" href="<?= base_url(); ?>"><i class="fas fa-user-circle fa-fw mr-2"></i>GOD Mode</a>
                </li>
            </ul>
            
            <div class="my-2 my-md-3">
                <a class="btn btn-primary" href="<?=base_url();?>logout">Log Out</a>
            </div>
        </div>
    </nav>
</header>
<script>
    $(document).ready(function(){
        if(window.location.href.indexOf("admin") > -1) 
            {
                 $('#home').addClass('active');
            }
        if(window.location.href.indexOf("add") > -1) 
            {
                 $('#add').addClass('active');
            }
        if(window.location.href.indexOf("view") > -1) 
            {
                 $('#view').addClass('active');
            }
     });

</script>