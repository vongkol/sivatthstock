<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">About System</li>
      </ol>
	<div class="container">  
		<div class = "col-xs-12 col-xs-offset-1">        
		  <img src="img/about.jpg"  class = "img-responsive"> 
		</div>
	</div>	
<?php include 'footer.php';?>
