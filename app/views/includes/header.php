<!DOCTYPE html>
<html lang="en"> 
<head>
    <?php
    if (@$title) {
        echo "<title>".$title."</title>";
    }else{
        echo "<title>Coding Beetle</title>";
    }
    ?>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Coding Beetle Youtube Channel">
    <meta name="author" content="Soumodeep Ganguly">    
    <!-- <link rel="shortcut icon" href="favicon.ico">  -->
    
    <!-- FontAwesome JS-->
	<script defer src="<?= base_url(); ?>assets/fontawesome/js/all.min.js"></script>
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="<?= base_url(); ?>assets/css/theme-3.css">
    <link id="theme-style" rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">

    <!-- Javascript -->          
    <script src="<?= base_url(); ?>assets/plugins/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/popper.min.js"></script> 
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <script src="<?= base_url(); ?>assets/plugins/sweetalert.js"></script> 
    <script src="<?= base_url(); ?>assets/js/main.js"></script> 

<style>
/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: rgba(0,48,100,0.8); 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>

</head> 
<body>