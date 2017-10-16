<?php
include 'config/db_connect.php';
if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM user A INNER JOIN position B ON A.position_id = B.position_id WHERE id = $user_id";
  $query = $connect->query($sql);
  $show = $query->fetch_array();
}
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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="stylesheet" href="prints/paper.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->

  
  <!--<link href="plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
  <link href="plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
  <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.3/css/buttons.dataTables.min.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>TK</b>GH</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>TK</b>GoodHealth</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
        
      
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="img/logo.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $show['username'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="img/logo.png" class="img-circle" alt="User Image">

                <p>
                  
                  <small>Takmao Good Health</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                <?php
            //      if ($show ['position_id'] == 1){
                ?>
                  <div class="col-xs-6">
                    <a href="user.php" class="btn btn-default"> <i class="fa fa-user-plus" aria-hidden="true"> </i>User</a>
                  </div>  
                  <div class="col-xs-6">
                    <a href="profile.php" class="btn btn-default pull-right"><i class="fa fa-info-circle" aria-hidden="true"></i>Profile</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <?php
               // }
                ?>
                <div class="pull-right">
                  <!--<a href="logout.php" class="btn btn-default btn-flat"> <i class="fa fa-power-off" aria-hidden="true"> </i>  Log out</a>-->
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $show['username'] ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">LIST</li>
        <!-- Optionally, you can add icons to the links -->
		<li><a href="index.php"><i class="fa fa-dashboard" aria-hidden="true"></i><span>Home (ទំព័រដេីម)</span></a></li>
      <li><a href="product.php"><i class="fa fa-cubes" aria-hidden="true"></i><span>Items List(តារាងមុខទំនិញ)</span></a></li>
    <!-- <li><a href="table.php"><i class="fa fa-circle"></i> <span>Table List​ (តុភ្ញៀវ)</span></a></li> -->
        <!--<li class="treeview">
      <a href="">
        <i class="fa fa-cubes"></i> <span></span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="invoices.php"><i class="fa fa-print" aria-hidden="true"></i>Invoice_list​​ (បញ្ជីរួម) </a></li>
        <li><a href="inv_datesearch.php"><i class="fa fa-print" aria-hidden="true"></i>Invoice By Date (តាមថ្ងៃ)</a></li>
      </ul>
    </li>-->
    <li><a href="stockin.php"><i class="fa fa-arrow-right"></i> <span>Stock In​ (ទំនិញចូល)</span></a></li>
   
		<li><a href="stock_out_list.php"><i class="fa fa-arrow-left"></i> <span>Stock Out (ទំនិញចេញ) <i class="fa fa-check" aria-hidden="true"></i></span></a></li>
    <li><a href="stock_out_approve.php"><i class="fa fa-arrow-left"></i> <span>Stock Out Approve <i class="fa fa-times" aria-hidden="true"></i></span></a></li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-edit" aria-hidden="true"></i><span>Stock Adjustment (កែតំរូវ)</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
         <li><a href="stock_minus.php"><i class="fa fa-minus" aria-hidden="true"></i>Stock Minus (ដកចំនួន)</a></li>
         <li><a href="stock_plus.php"><i class="fa fa-plus" aria-hidden="true"></i>Stock Plus (បន្ថែមចំនួន)</a></li>
      </ul>
    </li>
    <li><a href="stock_balance.php"><i class="fa fa-arrows" aria-hidden="true"></i><span>Stock Balance (ទំនិញក្នុងឃ្លាំង)</span></a></li>
    <li><a href="branch.php"><i class="fa fa-university" aria-hidden="true"></i><span>Branch (សាខាទទួលទំនិញ)</span></a></li>
    <li><a href="vender.php"><i class="fa fa-cart-plus" aria-hidden="true"></i><span>Supplier (អ្នកផ្គត់ផ្គង់ទំនិញ)</span></a></li>
    <li><a href="employee.php"><i class="fa fa-user" aria-hidden="true"></i><span>Employee_List​​(បុគ្គលិក) </span></a></li> 
      <li class="treeview">
      <a href="#">
        <i class="fa fa-wrench" aria-hidden="true"></i> <span>Setting (ការកំណត់)</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
         <li><a href="position.php"><i class="fa fa-user" aria-hidden="true"></i>Position (មុខងារ)</a></li>
         <li><a href="category.php"><i class="fa fa-bars" aria-hidden="true"></i>Category (ក្រុមទំនិញ)</a></li>
         <li><a href="branch_type.php"><i class="fa fa-bars" aria-hidden="true"></i>Branch Type​</a></li>
         <li><a href="supplier_type.php"><i class="fa fa-bars" aria-hidden="true"></i>Supplier Type</a></li>
        <li><a href="unit.php"><i class="fa fa-cube" aria-hidden="true"></i>Unit Type</a></li>
      </ul>
      
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-edit"></i> <span>Stock Adjust Report</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="stockin_record.php"><i class="fa fa-check" aria-hidden="true"></i>Adjustment + (បន្ថែម)</a></li>
        <li><a href="stockout_record.php"><i class="fa fa-check" aria-hidden="true"></i>Adjustment - (ដក)</a></li>
      </ul>
    </li> 
           <!--<li><a href="vat.php"><i class="fa fa-tag" aria-hidden="true"></i><span>VAT</span></a></li>
           <li><a href="exchange.php"><i class="fa fa-recycle" aria-hidden="true"></i><span>Exchange (អត្រាប្តូរប្រាក់)</span></a></li>-->
          <li><a href="stockin.php">Monthly Stockin</a></li>
          <li><a href="stockout.php">Monthly Stockout</a></li>
          <li><a href="stockout.php">Branch Stockout</a></li>
          <li><a href="stock_balance.php">Stock Balance</a></li>
          <li><a href="stockin.php">Alert Date Expired</a></li>
          <li><a href="stockin.php">Monthly Payment</a></li>
          <li><a href="stockin.php">Monthly AP</a></li>
           <li><a href="about.php"><i class="fa fa-info-circle" aria-hidden="true"></i><span>About System </span></a></li>
		      <li><a  onclick = "return confirm('Are you sure to logout ?');" href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i><span>Logout (ចាកចេញ)</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">