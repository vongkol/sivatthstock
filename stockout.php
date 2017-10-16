<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
  $sql = "SELECT * FROM stockout A INNER JOIN category B ON A.cate_id = B.cate_id INNER JOIN branch C ON A.branch_id = C.branch_id INNER JOIN employee D ON A.emp_id = D.emp_id WHERE approve = 2";
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
      //aprove
      if( $approve == 2 ){
         $sql = "INSERT INTO stockout  (out_date,code_out,pro_nameen,pro_namekh,cate_id,qty_out,price,amount,branch_id,emp_id,approve,out_note)
          VALUES 
           ('$out_date','$code_out','$pro_nameen','$pro_namekh','$cate_id','$qty_out','$price','$amount','$branch_id','$emp_id','$approve','$out_note')";
          $result = mysqli_query($connect, $sql);
        if ($result){
            $sql = "UPDATE stockin SET 
                                qty_left = qty_left + '$qty_out'
                                    WHERE 
                                code_in = '$code_out'" ;
            mysqli_query($connect, $sql);
            header("location:stockout.php?message=update");
        }
        echo "this product is approve";
      }
      //not approve
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
		header("location:stockout.php?message=delete");	
}	
?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock</li>
        <li class="active">Items stock Out</li>
      </ol>
          <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                               <div class="panel-heading">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Stock Out</button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add To Stock out</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12 details">
                                        <form method="post" enctype="multipart/form-data" action="">     
                                        <div class="form-group col-xs-6">
                                            <label for ="">Date:</label>                                          
                                            <input class="form-control" required  name="date" type="text" placeholder="Date add to Stock" id="datepicker">          
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for ="">code:</label>                                          
                                            <select class = "form-control"  required name = "code" id = "pro">
                                            <option value="">Select Product</option>
                                                <?php
                                                    $product = mysqli_query($connect,"SELECT * FROM stockin");
                                                    while ($row1 = mysqli_fetch_assoc($product)) { ?>
                                                    <option value="<?php echo $row1['code_in']; ?>"><?php echo $row1['code_in'];?></option>
                                                <?php 
                                                }
                                                ?>   
                                            </select>          
                                        </div>
                                        <div id = "test1">
                                            <div class = "form-group col-xs-6">
                                            <label for ="">Product(KH):</label>                                          
                                                <input class="form-control"   required name="" type="text" placeholder="Product Name">
                                            </div>  
                                            <div class = "form-group col-xs-6">
                                            <label for ="">Product(KH):</label>                                          
                                                <input class="form-control"   required name="" type="text" placeholder="Product Name(KH)">
                                            </div> 
                                            <div class="form-group col-xs-6">
                                                <label for ="">Price:</label>                                          
                                                <input class="form-control price"   required name="" type="text" placeholder="Price">          
                                            </div>
                                             <div class="form-group col-xs-6">
                                                <label for ="">Category:</label>                                          
                                                <input class="form-control"   required name="" type="text" placeholder="category">          
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for ="">Qauntity</label>                                          
                                            <input class="form-control quantity"   required name="qauntity" type="number" placeholder="Qauntity">          
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for ="">Amount:</label>                                          
                                            <input class="form-control amount"   required readonly name="amount" type="number" placeholder="Amount">          
                                        </div>
                                        <div class = "form-group col-xs-6">
                                            <label for = "">Branch:</label>
                                            <select class = "form-control" name = "branch" required>
                                                <option value="">Select Branch</option>
                                                    <?php
                                                    $vender = mysqli_query($connect,"SELECT * FROM branch");
                                                    while ($row2 = mysqli_fetch_assoc($vender)) { ?>
                                                    <option value="<?php echo $row2['branch_id']; ?>"><?php echo $row2['branch_name'];?></option>
                                                    <?php 
                                                    }
                                                    ?>   
                                            </select>
                                        </div>
                                        <div class = "form-group col-xs-6">
                                            <label for = "">Employee:</label>
                                                <select class = "form-control" name = "employee">
                                                <option value="">Select Employee</option>
                                                    <?php
                                                    $employee = mysqli_query($connect,"SELECT * FROM employee");
                                                        while ($row3 = mysqli_fetch_assoc($employee)) { ?>
                                                    <option value="<?php echo $row3['emp_id']; ?>"><?php echo $row3['name_khmer'];?> :: <?php echo $row3['name_english'];?></option>
                                                    <?php 
                                                    }
                                                    ?>   
                                                 </select>
                                        </div>
                                        
                                       <?php
                                      if ($show['position_id'] == 1) {
                                       ?> 
                                          <div class = "form-group col-xs-6">
                                            <label for = "">Approve:</label>
                                            <select class = "form-control" name = "app">
                                                <option value="1">Not Approve</option>
                                                <option value="2">Approve</option>
                                               </option>
                                                    
                                            </select>
                                        </div>
                                        <?php
                                        }
                                        else {        
                                        ?>
                                        <div class = "form-group col-xs-6">
                                            <label for = "">Approve:</label>
                                            <select class = "form-control" name = "app">
                                                <option value="1">Not Approve</option>
                                                <!--<option value="2">Approve</option>-->
                                               </option>
                                                    
                                            </select>
                                        </div>
                                        <?php
                                         }
                                        ?>
                                        <div class="form-group col-xs-12">
                                            <label for="note">Note:</label>
                                            <textarea class="form-control" rows="4" id="note" name = "note"></textarea>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <button type="submit" name = "btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Save changes</button>
                                            
                                        </div> 
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">  
                                    
                                </div>
                                </div>
                                </div>
                                </div>
                                <a href="dashboard.php" class="btn btn-sm btn-danger btn-flat pull-right"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
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
                                            <th>Delete</th>
                                            
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
                                            <td><?php echo $i;?></td> 
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
                                            <td><span class="label label-success">Approved <i class="fa fa-check-square" aria-hidden="true"></span></i></td>
                                            <td>
                                            <?php
                                             if ($show['position_id'] == 1) {
                                            ?>
                                           
                                            	<a onclick = "return confirm('Are you sure to delete ?');" href="stockout_approve.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a> </td>
                                            <?php
                                             } else {
                                            ?>
                                             	<a onclick = "return confirm('Are you sure to delete ?');" href="stockout_approve.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a> </td>
                                            <?php
                                            
                                            }
                                            ?>
                                            </td>
                                              
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