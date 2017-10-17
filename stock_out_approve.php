<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
 $conn = "SELECT * FROM stock_out_form";
$result = $connect->query($conn);
$id = $result->num_rows;
if($id < 0 )
{
    $id = 1;
}else
{
    $id += 1;
} 
  
  //delete
  if(isset($_GET["id"])){
		$id = $_GET["id"];	
        	
		$sql = "DELETE FROM stockout WHERE transaction_id = '$id'";
		$result = mysqli_query($connect, $sql);
		header("location:stockout.php?message=delete");	
}	
?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock</li>
        <li class="active">Items stock Out</li>
      </ol>
<h3>Stock Out Approve List</h3>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th> 
                                            <th>ថ្ងៃខែឆ្នាំស្នើរសុំ<br>Request Date</th>
                                            <th>ថ្ងៃខែឆ្នាំតម្រូវការ<br>Need Date</th>
                                            <th>ផ្នែក/Dept</th>
                                            <th>ស្នើរសុំដោយ/Request By</th>
                                            <th>ពិនិត្យដោយ/Check By</th>
                                            <th>លេខសម្គាល់<br>Re-No</th>
                                            <th>ស្នើរសុំថ្មីNew Request</th>
                                            <th>យកពីឃ្លាំង<br>Form Where</th>
                                            <th>លេខកាត/ID Card</th>
                                            <th>Detail</th>
                                            <th>Print</th>
                                            <th>Status</th>
                                           
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $conn = "SELECT * FROM stock_out_form A INNER JOIN branch B ON A.dept=B.branch_id INNER JOIN employee C ON A.check_by=C.emp_id WHERE A.approve=0 ";
                                          $result = $connect->query($conn);
                                           $i=1;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$row["request_date"];
                                              $v2=$row["need_date"];
                                              $v3=$row["branch_name"];
                                              $v4=$row["name_english"];
                                              $v5=$row["check_by"];
                                              $v13=$row["ref_no"];
                                              $v6=$row["new_request"];
                                              $v7=$row["from_where"];
                                              $v8=$row["id_card"];
                                              
                                          ?>
                                          <tr>
                                            <td><?php echo $i;?></td> 
                                             <td><?php echo $v1;?></td>
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v13;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <th><?php echo "<a class='btn btn-info colorbox' href='stock_out_approve_detail.php?in_no=".$row['sto_out_id']."'>Detail</a>"?></th>
                                            <th><?php echo "<a class='btn btn-primary colorbox' href='print_invoice.php?in_no=".$row['sto_out_id']."'><span class='glyphicon glyphicon-print'></span></a>"?></th>
                                             <?php
                                             if ($show['position_id'] == 1) {
                                            ?>
                                               <td> <a href="stock_out_approve_update.php?id=<?php echo $row['sto_out_id']; ?>" class="btn btn-danger">Approve</a>
                                            	<a onclick = "return confirm('Are you sure to delete ?');" href="stock_out_approve_delete.php?id=<?php echo $row['sto_out_id']; ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i></a> </td>
                                            <?php
                                             } else {
                                            ?>
                                             <td><a href = "#" class ="btn btn-danger disabled" > Approve <i class="fa fa-check-square" aria-hidden="true"></i></a>
                                             	<a onclick = "return confirm('Are you sure to delete ?');" href="stock_out_approve_delete.php?id=<?php echo $row['sto_out_id']; ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i></a> </td>
                                            <?php
                                            }
                                            ?>
                                           
                                              
                                          </tr> 
                                          <?php
                                         $i++;
                                            }  
                                          ?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    
          <?php include 'footer.php';?>