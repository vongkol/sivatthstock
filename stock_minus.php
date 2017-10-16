<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
  $sql = "SELECT * FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id"; 
  $result = $connect->query($sql);
  
?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock</li>
        <li class="active">Stock minus</li>
      </ol>
          <div class="row">
                <div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add To Stock</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update To Stock</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success delete from Stock</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
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
                                            <th>Quantity</th>
                                            <th>Packet</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Pay Amount</th>
                                            <th>Rest</th>
                                            <th>Expire Date</th>
                                            <th>Note</th>
                                            <th>Supplier</th>
                                            <th>Employee</th>
                                            <th>Minus(-)</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$row["date_in"];
                                              $v2=$row["code_in"];
                                              $v3=$row["name_kh"];
                                              $v4=$row["qty_in"];
											  $v14 = $row["qty_left"];
                                              $v13=$row["paket"];
                                              $v5=$row["price"];
                                              $v6=$row["amount"];
                                              $v7=$row["payamount"];
                                              $v8=$row["rest_amount"];
                                              $v9=$row["expire_date"];
                                              $v10=$row["note_in"];
                                              $v11=$row["vendername_en"];
                                              $v12=$row["name_khmer"];
											  $bal = $v4 - $v14;
                                          ?>
                                          <tr>
                                            <td><?php echo $v1;?></td> 
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $bal;?></td>
                                            <td><?php echo $v13;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <td><?php echo $v9;?></td>
                                            <td><?php echo $v10;?></td>
                                            <td><?php echo $v11;?></td>
                                            <td><?php echo $v12;?></td>
                                            <td align = "center">
                                            <a href="minus_stockin.php?id=<?php echo $row['in_id']; ?>" class="btn btn-primary"><i class="fa fa-minus-square-o"></i></a>
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