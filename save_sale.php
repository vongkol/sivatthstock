<?php

session_start();
include 'config/db_connect.php';
 function createRandomPassword() {
  	$chars = "003232303232023232023456789";
  	srand((double)microtime()*1000000);
  	$i = 0;
  	$pass = '' ;
  	while ($i <= 7) {

  		$num = rand() % 33;

  		$tmp = substr($chars, $num, 1);

  		$pass = $pass . $tmp;

  		$i++;

  	}
  	return $pass;
  }

$finalcode='RS-'.createRandomPassword();
$cash = $_GET['cash'];
$invoice = $_GET['invoice'];
$cashier = $_GET['cashier'];
$date = $_GET['date'];
$total = $_GET['total'];
$vat = $_GET['vat'];
$cus = $_GET['cus'];
$pay  = $_GET['pay'];

// echo $cash;
// echo "</br>";

// echo $invoice;
// echo "</br>";

// echo $cus;
// echo "</br>";

// echo $date;
// echo "</br>";

// echo $total;
// echo "</br>";

// echo $vat;
// echo "</br>";
  
// echo $pay;
// echo "</br>";

// echo $cashier;
// echo "</br>";
  $select = "select * from invoice";
  $resultselect = mysqli_query($connect , $select);
  while($row = $resultselect->fetch_assoc()){
    $inv = $row['inv_no'];
  } 


if ($total == 0 ){

  echo "<script>alert('Please Choose Product Befor Total  !');
       window.location.href='inv.php?cus=$cus&cash=$cash&invoice=$invoice&pay=$pay';
       </script>";

} 
else if ( $invoice == $inv ){
    $update = "UPDATE invoice SET amount = '$total',
                                  vat = '$vat' ,
                                  pay = '$pay'
                                    WHERE 
                               inv_no = '$invoice'";
      mysqli_query($connect, $update);
      header("location:preview.php?invoice=$invoice");
      }
else{

    $insert = "INSERT INTO invoice (inv_no, cashier_name , cus , date_sell , amount , vat ) 
    VALUES ( '$invoice' , '$cashier' , 'General' , '$date' , '$total' , '$vat' )";
    $resultinsert = mysqli_query($connect, $insert); 
    header("location:preview.php?invoice=$invoice");

}

?>