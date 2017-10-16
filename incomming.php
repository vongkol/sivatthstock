<?php
	include 'config/db_connect.php';
	ob_start();
	session_start();

	if(empty($_SESSION['user_id'])) {
	    header('location:index.php');
	    exit();
	}
	$ex = "SELECT * FROM vat";
	$reex = $connect->query($ex);
	$row = $reex->fetch_assoc();
	$do_luy = $row['vat'];



	$invoice = $_POST['invoice'];
	$pro = $_POST['product'];
	$q2 = $_POST['qty'];
	$cash = $_POST['cash'];
	$date = $_POST['date'];
	$discount = $_POST['discount'];
	// $cus = $_POST['cus'];
	// $pay = $_POST['pay'];
	

	$code="";
	$name_en='';
	
	$name_kh='';
          
    $price='';
    $amount ='';
    $q1 = '';
    $cate = '';
    $c = "";
    $in = "";

   if (!empty($discount)){
   $same = "SELECT * FROM stockout WHERE code_out = '$pro' and invoice = '$invoice'";
    $resame = $connect->query($same);
    while ($row1 = $resame->fetch_assoc()) {
    	$c = $row1['code_out'];
    	$in = $row1['invoice'];
	}
	
    if( $pro == ''){
    	 echo "<script>alert('Please Choose Product Befor Click Add !');
    	 window.location.href='inv.php?cash=$cash&invoice=$invoice';
    	 </script>"; 	
    }
    else if ( $c == $pro && $in == $invoice ) {
    		$product = "SELECT * FROM stockin s INNER JOIN product p ON s.pro_id = p.pro_id WHERE code_in = '$pro'";
			 $repro = $connect->query($product); 
		  	while($row = $repro->fetch_assoc())
			  { 
		          $cate = $row['cate_id'];
			}
    		$up = "UPDATE stockin SET qty_left = qty_left + '$q2' WHERE code_in = '$pro'";
    		mysqli_query($connect, $up);
    	
    	$upout = "UPDATE stockout SET qty_out = qty_out + '$q2' , amount = qty_out * price , vat = amount * '$do_luy' WHERE code_out = '$pro' AND invoice = '$invoice'";
    	mysqli_query($connect, $upout);
    	header("location:inv.php?cash=$cash&invoice=$invoice");
    	
    }
    else {
		$product = "SELECT * FROM stockin s INNER JOIN product p ON s.pro_id = p.pro_id WHERE code_in = '$pro'";
			 $repro = $connect->query($product);
	       
		  		while($row = $repro->fetch_assoc()) 
		                                            {     
		            $code=$row["code_in"];
		            $name_en=$row["name_en"];
		            $name_kh=$row["name_kh"];
		            $q1=$row["qty_in"];
		            $price=$row["price"];
		            $amount = $price * $q2;
		            $cate = $row['cate_id'];

			}
			$vat = $q2 * $do_luy ;
			$discount1 = $discount / 100;
			$dis = $price * $discount1 * $q2;
			$price2 = $price - $dis;
			$amount2 = $price * $q2 - $dis;
	
				$balance = "UPDATE stockin SET qty_left = qty_left + '$q2' WHERE code_in = '$pro'";
				mysqli_query($connect, $balance);

				$stockout = "INSERT INTO stockout ( invoice , code_out , pro_nameen, pro_namekh, qty_out, price , amount ,discount, vat, date_out)
			 	VALUES ( '$invoice', '$code', '$name_en', '$name_kh', '$q2', '$price', '$amount2', '$dis', '$vat', '$date')";
			 	$restockout = mysqli_query($connect, $stockout);
			 	if ($restockout){
			 		echo 'sucess';
			 	}
			 	else{
			 		echo 'fail';
			 	}
			 	header("location:inv.php?cash=$cash&invoice=$invoice");
		  
	}
	//if no discount
   }
   else{
   	 $same = "SELECT * FROM stockout WHERE code_out = '$pro' and invoice = '$invoice'";
    $resame = $connect->query($same);
    while ($row1 = $resame->fetch_assoc()) {
    	$c = $row1['code_out'];
    	$in = $row1['invoice'];
	}
	
    if( $pro == ''){
    	 echo "<script>alert('Please Choose Product Befor Click Add !');
    	 window.location.href='inv.php?cash=$cash&invoice=$invoice';
    	 </script>"; 	
    }
    else if ( $c == $pro && $in == $invoice ) {
    		$product = "SELECT * FROM stockin s INNER JOIN product p ON s.pro_id = p.pro_id WHERE code_in = '$pro'";
			 $repro = $connect->query($product); 
		  	while($row = $repro->fetch_assoc())
			  { 
		          $cate = $row['cate_id'];
			}	
    		$up = "UPDATE stockin SET qty_left = qty_left + '$q2' WHERE code_in = '$pro'";
    		mysqli_query($connect, $up);
    	
    	$upout = "UPDATE stockout SET qty_out = qty_out + '$q2' , amount = qty_out * price , vat = amount * '$do_luy' WHERE code_out = '$pro' AND invoice = '$invoice'";
    	mysqli_query($connect, $upout);
    	header("location:inv.php?cash=$cash&invoice=$invoice");
    }
    else {
		$product = "SELECT * FROM stockin s INNER JOIN product p ON s.pro_id = p.pro_id WHERE code_in = '$pro'";
			 $repro = $connect->query($product);
	       
		  		while($row = $repro->fetch_assoc()) 
		                                            {     
		            $code=$row["code_in"];
		            $name_en=$row["name_en"];
		            $name_kh=$row["name_kh"];
		            $q1=$row["qty_in"];
		            $price=$row["price"];
		            $amount = $price * $q2;
		            $cate = $row['cate_id'];

			}
			$vat = $q2 * $do_luy ;
				$balance = "UPDATE stockin SET qty_left = qty_left + '$q2' WHERE code_in = '$pro'";
				mysqli_query($connect, $balance);

				$stockout = "INSERT INTO stockout ( invoice , code_out , pro_nameen, pro_namekh, qty_out, price , amount ,discount, vat, date_out)
			 	VALUES ( '$invoice', '$code', '$name_en', '$name_kh', '$q2', '$price', '$amount', '0', '$vat', '$date')";
			 	$restockout = mysqli_query($connect, $stockout);
			 	if ($restockout){
			 		echo 'sucess';
			 	}
			 	else{
			 		echo 'fail';
			 	}
			 	header("location:inv.php?cash=$cash&invoice=$invoice");
		  
	}
 }
?>