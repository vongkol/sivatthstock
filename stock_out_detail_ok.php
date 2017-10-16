<?php include'config/db_connect.php';
    ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * FROM stock_out_detail WHERE sto_out_id = '$id'";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	$qty=$row['qty'];
    $in_id=$row['in_id'];
    
		  $sql3 = "UPDATE stockin SET  qty_left=qty_left+'$qty' WHERE in_id='$in_id' ";
          $result3 = mysqli_query($connect, $sql3);


          $sql = "UPDATE stock_out_detail SET status  ='1'
										WHERE 
										ind_no = '$id'" ;
      //    echo $sql3;
			mysqli_query($connect, $sql);
			header("location:stock_out_approve_detail.php?in_no=$id");
	
?>
