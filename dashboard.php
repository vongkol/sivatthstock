<?php 
include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
$sql1 = "SELECT * FROM stockin";
$result1 = $connect->query($sql1);
$countlow1 = $result1->num_rows;

$sql2 = "SELECT * FROM stock_out_form WHERE approve = 1";
$result2 = $connect->query($sql2);
$countlow2 = $result2->num_rows;

$sql3 = "SELECT * FROM branch";
$result3 = $connect->query($sql3);
$countlow3 = $result3->num_rows;

$sql4 = "SELECT * FROM vender";
$result4 = $connect->query($sql4);
$countlow4 = $result4->num_rows;

$out = "SELECT sum(sum_total) FROM stock_out_form WHERE approve = 1";
$resout = $connect->query($out);
		for($i=0; $row2 = $resout->fetch_assoc(); $i++){
		$subtotal2=$row2['sum(sum_total)'];
	}

// $orderSql = "SELECT * FROM  WHERE order_status = 1";
// $orderQuery = $connect->query($orderSql);
// $countOrder = $orderQuery->num_rows;

// $totalRevenue = "";
// while ($orderResult = $orderQuery->fetch_assoc()) {
// 	$totalRevenue += $orderResult['paid'];
// }

$sql = "SELECT * FROM stockin WHERE qty_in - qty_left <= 3 ";
$result = $connect->query($sql);
$countlow = $result->num_rows;

$connect->close();
  

?>
<?php include 'header.php';?>
	 <!-- Content Header (Page header) -->
    <section class="content-header">
     <img src = "img/3.PNG" class = "img-responsive" style = "margin-left:-5%">
      <center><h3><b>
     ប្រព័ន្ធគ្រប់គ្រងឃ្លាំងទំនិញ 
        </b></h3></center>
      <center><h3><b>
      Stock Managerment System 
        </b></h3></center>
        </br>
    </section>
    <div class = "row">
      <div class = "col-xs-12 col-md-8 col-lg-8">
          <div class = "col-xs-12 col-md-6 col-lg-6">
          <div class="info-box">
             <a href = "stock_balance.php"><span class="info-box-icon bg-red"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i></span></a>
            <div class="info-box-content">
              <span class="info-box-text">ទំនិញជិតអស់ពីឃ្លាំង</span>
              <span class="info-box-number" style="color:red";>មាន​ : <?php echo $countlow; ?> <small>Item(S) </small></span>
            </div>
          </div>
          </div>
          <div class = "col-xs-12 col-md-6 col-lg-6">
             <div class="info-box">
                 <a href = "stockin.php"><span class="info-box-icon bg-green"><i class="fa fa-cube" aria-hidden="true"></i></i></span></a>
                <div class="info-box-content">
                  <span class="info-box-text">សរុបមុខទំនិញក្នុងឃ្លាំង</span>
                     <span class="info-box-number" style="color:red";>មាន​ : <?php echo $countlow1; ?> <small>Item(S) </small></span>
                </div>
              </div>
          </div>
          <div class = "col-xs-12 col-md-6 col-lg-6">
          <div class="info-box">
            <a href = "stockout.php"> <span class="info-box-icon bg-yellow"><i class="fa fa-reply-all" aria-hidden="true"></i></i></span></a>
            <div class="info-box-content">
              <span class="info-box-text">សរុបតំលៃទំនិញចេញពីឃ្លាំង</span>
               <span class="info-box-number">$ 
                <?php 
                if($subtotal2 == ""){
                  echo '0';
                }
                else{
                    echo $subtotal2;
                }
                ?>
              </span>
            </div>
          </div>
          </div>
          <div class = "col-xs-12 col-md-6 col-lg-6">
             <div class="info-box">
                <a href = "stockout_approve.php"> <span class="info-box-icon bg-black"><i class="fa fa-question-circle" aria-hidden="true"></i></span></a>
                <div class="info-box-content">
                  <span class="info-box-text">ទំនិញចេញមិនទាន់អនុញ្ញាត្តី</span>
                    <span class="info-box-number" style="color:red";>មាន​ : <?php echo $countlow2; ?> <small>Item(S) </small></span>
                </div>
              </div>
          </div>
          <div class = "col-xs-12 col-md-6 col-lg-6">
          <div class="info-box">
             <a href = "branch.php"><span class="info-box-icon bg-green"><i class="fa fa-building" aria-hidden="true"></i></span></a>
            <div class="info-box-content">
              <span class="info-box-text">សាខាទទូលទំនិញ</span>
               <span class="info-box-number" style="color:red";>មាន​ : <?php echo $countlow3; ?> <small>កន្លែង </small></span>
            </div>
          </div>
          </div>
          <div class = "col-xs-12 col-md-6 col-lg-6">
             <div class="info-box">
                <a href = "vender.php"> <span class="info-box-icon bg-blue"><i class="fa fa-truck" aria-hidden="true"></i></span></a>
                <div class="info-box-content">
                  <span class="info-box-text">អ្នកផ្គត់ផ្គត់ទំនិញ</span>
                  <span class="info-box-number" style="color:red";>មាន​ : <?php echo $countlow4; ?> <small>កន្លែង </small></span>
                </div>
              </div>
          </div>
      </div>
      <div class = "col-xs-12 col-md-4 col-lg-4">
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-calendar"></i>
                  <h3 class="box-title">Calendar</h3>
                    <div class="pull-right box-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                          <!--<ul class="dropdown-menu pull-right" role="menu">-->
                        <!--<li><a href="#">Add new event</a></li>
                        <li><a href="#">Clear events</a></li>-->
                            <!--<li class="divider"></li>
                          <li><a href="#">View calendar</a></li>
                          </ul>-->
                      </div>
                      <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                      </button>
                  </div>
              </div>
          <div class="box-body no-padding">
              <div id="calendar" style="width: 100%"></div>
          </div>
        </div>
        </div>
    </div>
<?php include 'footer.php';?>
