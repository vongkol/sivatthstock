<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
if(!isset($_GET['getStartdate']) && !isset($_GET['getEnddate']) && !isset($_GET['getItem'])){
    echo "We are protected it!";
    exit();
}
$startdate = $_GET['getStartdate'];
$enddate = $_GET["getEnddate"];
$item = $_GET["getItem"];
$query = "";

if($startdate!="" && $enddate !=""){//if keyword set goes here
   $query = "SELECT in_id, date_in, code_in, name_kh, qty_in, paket, price, amount, payamount, rest_amount, expire_date, note_in, vendername_en, name_khmer  FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id WHERE (date_in BETWEEN '".$startdate."' AND '".$enddate."') ";
   if($item !=""){
     $query .= "AND name_kh LIKE '".$item."'";
   }
}else if ($item =="" && $startdate!="" && $enddate !=""){ //if keyword not set but category set then goes here
  $query = "SELECT in_id, date_in, code_in, name_kh, qty_in, paket, price, amount, payamount, rest_amount, expire_date, note_in, vendername_en, name_khmer  FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id WHERE (date_in BETWEEN '".$startdate."' AND '".$enddate."') ";
}else if($item !="" && $startdate=="" && $enddate ==""){//if only country set goes here
  $query = "SELECT in_id, date_in, code_in, name_kh, qty_in, paket, price, amount, payamount, rest_amount, expire_date, note_in, vendername_en, name_khmer  FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id WHERE name_kh LIKE '".$item."'";
}else if(($startdate!="" && $enddate =="") or ($startdate=="" && $enddate !="")){
	// $query = "SELECT in_id, date_in, code_in, name_kh, qty_in, paket, price, amount, payamount, rest_amount, expire_date, note_in, vendername_en, name_khmer  FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id";
}
else{
	 $query = "SELECT in_id, date_in, code_in, name_kh, qty_in, paket, price, amount, payamount, rest_amount, expire_date, note_in, vendername_en, name_khmer  FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id";
}


  $result = $connect->query($query);
  // var_dump($result->fetch_array());
//   echo "I am here!" ;
// exit();

while($fetch = $result->fetch_array())
{
		$output[] = array($fetch[0],$fetch[1],$fetch[2],$fetch[3],$fetch[4],$fetch[5],$fetch[6],$fetch[7],$fetch[8],$fetch[9],$fetch[10],$fetch[11],$fetch[12],$fetch[13]);
}
if (isset($output)) {
	echo json_encode($output);
}
?>