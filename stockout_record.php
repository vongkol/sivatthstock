<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
  $sql = "SELECT * FROM stockout_report A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id"; 
  $result = $connect->query($sql);
 if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM stockout_report WHERE stockin_id = '$id'";
		$result = mysqli_query($connect, $sql);
		header("location:stockout_record.php?message=delete");	
}
?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock</li>
        <li class="active">Stock Minus </li>
      </ol>
          <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                <a href="dashboard.php" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Date</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Old qty</th>
                                            <th>Minus</th>
                                            <th>Packet</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Pay Amount</th>
                                            <th>Rest</th>
                                            <th>Expire Date</th>
                                            <th>Note</th>
                                            <th>Vender</th>
                                            <th>Employee</th>
                                            <th>Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$row["date_in"];
                                              $v2=$row["code_in"];
                                              $v3=$row["name_en"];
                                              $v4=$row["qty_in"];
                                              $v14=$row["qty_minus"];
                                              $v13=$row["paket"];
                                              $v5=$row["price"];
                                              $v6=$row["amount"];
                                              $v7=$row["payamount"];
                                              $v8=$row["rest_amount"];
                                              $v9=$row["expire_date"];
                                              $v10=$row["note_reportin"];
                                              $v11=$row["vendername_en"];
                                              $v12=$row["name_khmer"];
                                          ?>
                                          <tr>
                                            <td><?php echo $v1;?></td> 
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v14;?></td>
                                            <td><?php echo $v13;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <td><?php echo $v9;?></td>
                                            <td><?php echo $v10;?></td>
                                            <td><?php echo $v11;?></td>
                                            <td><?php echo $v12;?></td>
                                             <td>
                                                   
                                            <?php
                                             if ($show['position_id'] == 1) {
                                            ?>
                                                <a onclick = "return confirm('Are you sure to delete ?');" href="stockout_record.php?id=<?php echo $row['stockin_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <?php
                                             } else {
                                            ?>
                                            <a onclick = "return confirm('Are you sure to delete ?');" href="stockout_record.php?id=<?php echo $row['stockin_id']; ?>" class="btn btn-danger disabled"><i class="fa fa-trash"></i></a>
                                            <?php
                                            }
                                            ?>

                                            </td>
                                          </tr> 
                                          <?php
                                            }  
                                          ?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            
          <?php include 'footer.php';?>