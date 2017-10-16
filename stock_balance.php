<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
  $sql = "SELECT * FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id ";
  $result = $connect->query($sql);  
?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock</li>
        <li class="active">Items stock Balance</li>
      </ol>
          <div class="row">
               
                <div class="col-lg-12">
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
                                            <th>Code</th>
                                            <th>Name(En)</th>
                                            <th>Name(Kh)</th>
                                            <th>Amount In</th>
                                            <th>Amount Out</th>
                                            <th>Balance</th>
											 <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                             
                                              $v2=$row["code_in"];
                                              $v3=$row["name_en"];
                                              $v4=$row["name_kh"];
                                              $v5=$row["qty_in"];
                                              $v6=$row["qty_left"];
                                              $v7 = $v5 - $v6;
											  $v8 = $row["price"];
											  $balan = $v7 * $v8;
                                             
                                          ?>
                                          <tr>
                                    
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v5;?></td>   
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>
											<td>$ <?php echo $balan;?></td>
                                            <td>
                                            <?php
                                                if($v7 <= 5 & $v7 > 0){
                                                 echo '<span class="label label-warning">Low Stock</span>';
                                                }
                                                elseif ($v7 == 0 ){
                                                   echo '<span class="label label-danger">Out Of Stock</span>';
                                                }
                                                else{
                                                   echo '<span class="label label-success">Available</span>';
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