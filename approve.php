<?php include'config/db_connect.php';
if(isset($_GET["app"])){
		$id = $_GET["app"];
		$sql = "SELECT * from stockout where transaction_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
        $app = $row['approve'];	
        $code = $row['code_out'];
        $qty = $row['qty_out'];
        //Update not approve to approve 
        $approve = "UPDATE stockout SET approve = '2' where transaction_id = '$id'";
        $result = mysqli_query($connect, $approve);
        if($result){
            //update Quantity when approve 
            $update_qty = "UPDATE stockin SET qty_left = qty_left + '$qty' WHERE code_in = '$code'";
            $result = mysqli_query($connect, $update_qty);
             header("location:stockout.php?message=update");  
        }
        else {
            echo "error";
        }        
	}

?>