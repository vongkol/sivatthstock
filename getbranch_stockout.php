<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
if(!isset($_GET['branchId'])){
    echo "We are protected it!";
    exit();
}
$startdate = $_GET['getStartdate'];
$enddate = $_GET["getEnddate"];
$branchId = $_GET['branchId'];

// if($branchId!="")
  $query = "";

if($startdate!="" && $enddate !=""){//if keyword set goes here
   $query = "SELECT branch_name, code_in, qty, unit, description, account_change, unit_price, total_price FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id inner join stock_out_form C on C.sto_out_id = A.sto_out_id inner join branch D on D.branch_id= C.dept WHERE C.approve = 1 AND (need_date BETWEEN '".$startdate."' AND '".$enddate."') ";
   if($branchId !=""){
     $query .= "AND D.branch_id={$branchId}";
   }
}else if ($branchId =="" && $startdate!="" && $enddate !=""){ //if keyword not set but category set then goes here
  $query = "SELECT branch_name, code_in, qty, unit, description, account_change, unit_price, total_price FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id inner join stock_out_form C on C.sto_out_id = A.sto_out_id inner join branch D on D.branch_id= C.dept WHERE C.approve = 1 AND (need_date BETWEEN '".$startdate."' AND '".$enddate."') ";
}else if($branchId !="" && $startdate=="" && $enddate ==""){//if only country set goes here
  $query = "SELECT branch_name, code_in, qty, unit, description, account_change, unit_price, total_price FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id inner join stock_out_form C on C.sto_out_id = A.sto_out_id inner join branch D on D.branch_id= C.dept WHERE C.approve = 1 AND D.branch_id={$branchId} ";
}else if(($startdate!="" && $enddate =="") or ($startdate=="" && $enddate !="")){
  // $query = "SELECT in_id, date_in, code_in, name_kh, qty_in, paket, price, amount, payamount, rest_amount, expire_date, note_in, vendername_en, name_khmer  FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id";
}
else{
   $query = "SELECT branch_name, code_in, qty, unit, description, account_change, unit_price, total_price FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id inner join stock_out_form C on C.sto_out_id = A.sto_out_id inner join branch D on D.branch_id= C.dept WHERE C.approve = 1";
}


  $result = $connect->query($query);
  // var_dump($result->fetch_array());
//   echo "I am here!" ;
// exit();

while($fetch = $result->fetch_array())
{
		$output[] = array($fetch[0],$fetch[1],$fetch[2],$fetch[3],$fetch[4],$fetch[5],$fetch[6],$fetch[7]);
}
if (isset($output)) {
	echo json_encode($output);
}
?>