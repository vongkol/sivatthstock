<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
  $sql = "SELECT * FROM stockout A INNER JOIN category B ON A.cate_id = B.cate_id INNER JOIN branch C ON A.branch_id = C.branch_id INNER JOIN employee D ON A.emp_id = D.emp_id WHERE approve = 1";
  $result = $connect->query($sql);
  $i = 1;

  if(isset($_POST['btnadd'])){
      $out_date = $_POST['date'];
      $code_out = $_POST['code'];
      $pro_nameen = $_POST['en'];
      $pro_namekh = $_POST['kh'];
      $cate_id = $_POST['category'];
      $qty_out = $_POST['qauntity'];
      $price = $_POST['price'];
      $amount = $_POST['amount'];
      $branch_id = $_POST['branch'];
      $emp_id = $_POST['employee'];
      $approve = $_POST['app']; 
      $out_note = $_POST['note'];
      if( $approve == 2 ){
         $sql = "INSERT INTO stockout  (out_date,code_out,pro_nameen,pro_namekh,cate_id,qty_out,price,amount,branch_id,emp_id,approve,out_note)
          VALUES 
           ('$out_date','$code_out','$pro_nameen','$pro_namekh','$cate_id','$qty_out','$price','$amount','$branch_id','$emp_id','$approve','$out_note')";
          $result = mysqli_query($connect, $sql);
        if ($result){
            $sql = "UPDATE stockin SET 
                                qty_out = qty_out + '$qty_out'
                                    WHERE 
                                code_out = '$code_out'" ;
            mysqli_query($connect, $sql);
            header("location:stockout.php?message=update");
        }
        echo "this product is approve";
      }
      else{
         $sql = "INSERT INTO stockout  (out_date,code_out,pro_nameen,pro_namekh,cate_id,qty_out,price,amount,branch_id,emp_id,approve,out_note)
          VALUES 
           ('$out_date','$code_out','$pro_nameen','$pro_namekh','$cate_id','$qty_out','$price','$amount','$branch_id','$emp_id','$approve','$out_note')";
            $result = mysqli_query($connect, $sql);
             header("location:stockout_approve.php?message=update");                
      } 
  }
  //delete
  if(isset($_GET["id"])){
		$id = $_GET["id"];	
        	
		$sql = "DELETE FROM stockout WHERE transaction_id = '$id'";
		$result = mysqli_query($connect, $sql);
		header("location:stockout_approve.php?message=delete");	
}	
?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock</li>
        <li class="active">Items stock Out</li>
      </ol>
          <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                               <div class="panel-heading">
                                <a href="dashboard.php" class="btn btn-sm btn-danger btn-flat "><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th> 
                                            <th>Date</th>
                                            <th>Code</th>
                                            <th>Name(EN)</th>
                                            <th>Name(KH)</th>
                                            <th>Category</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Branch</th>
                                            <th>Employee</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$row["transaction_id"];
                                              $v2=$row["out_date"];
                                              $v3=$row["code_out"];
                                              $v4=$row["pro_nameen"];
                                              $v5=$row["pro_nameen"];
                                              $v13=$row["category_name"];
                                              $v6=$row["qty_out"];
                                              $v7=$row["price"];
                                              $v8=$row["amount"];
                                              $v9=$row["branch_name"];
                                              $v10=$row["name_khmer"];
                                              $v11=$row["approve"];
                                              $v12=$row["out_note"];
                                          ?>
                                          <tr>
                                            <td><?php echo $i; ?></td> 
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v13;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <td><?php echo $v9;?></td>
                                            <td><?php echo $v10;?></td>
                                            <td><?php echo $v12;?></td>
                                            <?php
                                             if ($show['position_id'] == 1) {
                                            ?>
                                               <td> <a href = "approve.php?app=<?php echo $v1?>" class ="btn btn-danger" > Approve <i class="fa fa-check-square" aria-hidden="true"></i> </a>
                                            	<a onclick = "return confirm('Are you sure to delete ?');" href="stockout_approve.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i></a> </td>
                                            <?php
                                             } else {
                                            ?>
                                             <td><a href = "#" class ="btn btn-danger disabled" > Approve <i class="fa fa-check-square" aria-hidden="true"></i></a>
                                             	<a onclick = "return confirm('Are you sure to delete ?');" href="stockout_approve.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i></a> </td>
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
                    </div>
                </div>
            </div>
        <!--<script>
			$(document).ready(function(){
				$('#pro').change(function(){
					var acc = $(this).val();
					$.ajax({
						url:"server.php",
						method:"POST",
						data:{accNo:acc},
						dataType:"text",
						success:function(data)
						{
							$('#test1').html(data);
						}
					});
				});
			});
		</script>-->
          <?php include 'footer.php';?>