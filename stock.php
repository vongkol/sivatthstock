<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

 //    if(isset($_GET["id"])){
	// 	$id = $_GET["id"];
	// 	$sql = "SELECT * from employee where id = $id";
	// 	$result = mysqli_query($connect, $sql);
	// 	$row = mysqli_fetch_array($result);	
	// }	
	// if(!empty($_POST["id"])){
	// 		$id = $_POST["id"];
	// 		$kname = $_POST["name_khmer"];
	// 		$ename = $_POST["name_english"];
	// 		$start = $_POST["starton"];
	// 		$phone = $_POST["phone"];
	// 		$position = $_POST["position"];
	// 		$note = $_POST["note"];
		
	// 			$sql = "UPDATE employee SET name_khmer ='$kname'
	// 								, name_english 	= '$ename' 
	// 								, start_on 		= '$start'
	// 								, position_id 	= '$position'
	// 								, phone 		= '$phone'
	// 								, emp_note		= '$note'
	// 									WHERE id = '$id'" ;
	// 		mysqli_query($connect, $sql);
	// 		header("location:employee.php");
	// }
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Stock List</li>
      </ol>
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Stock List</div>
                <div class = "panel-body">
                	<div class = "col-md-12" style="margin-bottom:30px; ">
                		<div class = "col-sm-6 col-sm-offset-1">
                			<a href="product.php"><img src = "img/product.png" class = "img-responsive"></a>
                		</div>
                		<div class = "col-sm-5">
                			<a href="category.php"><img src = "img/category.png" class = "img-responsive"></a> 
                		</div>
                		<div class = "col-sm-6 col-sm-offset-1" style="margin-top:30px;">
                			<a href="stockin.php"><img src = "img/stockin.png" class = "img-responsive"></a>   
                		</div>
                        <div class = "col-sm-5" style="margin-top:30px;">
                            <a href="stockout.php"><img src = "img/stockout.png" class = "img-responsive"></a>  
                        </div>
                        <div class = "col-sm-6 col-sm-offset-4" style="margin-top:30px;">
                            <a href="stock_balance.php"><img src = "img/balance.png" class = "img-responsive"></a>
                        </div>
                	</div>
                </div>
               
            </div>
    	</div>
    </div>
<?php include 'footer.php';?>