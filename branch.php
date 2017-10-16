<?php include 'config/db_connect.php';
// check if user is not logged in
$errors = ""; 
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
	$sql = "SELECT * FROM branch A INNER JOIN branch_type B ON A.branch_type_id = B.branch_type_id INNER JOIN employee C ON A.emp_id = C.emp_id";	
	$result = $connect->query($sql);
	

	if(isset($_POST["btnadd"])){
		$date = $_POST["date"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $addr = $_POST["addr"];
        $type = $_POST["type"];
        $employee = $_POST["employee"];
		$note = $_POST['note'];
	
		$sql = "INSERT INTO branch (date_recode,branch_name,branch_phone,address,branch_type_id,emp_id,branch_note) 
            VALUES ('$date','$name','$phone','$addr','$type','$employee','$note')";
			$result = mysqli_query($connect, $sql);
			header('location:branch.php?message=success');


}
 
    if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM branch WHERE branch_id = '$id'";
		$result = mysqli_query($connect, $sql);
		header("location:branch.php?message=delete");	
}	
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">branch List</li>
      </ol>
	<div class="row">
		<div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add user</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update user</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete user</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12">
                	
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Branch</button>
							  <!-- Modal -->
							  <div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add Branch</h4>
									</div>
									<div class="modal-body">
										<div class="col-md-12">
												<form method="post" enctype="multipart/form-data" action="">     
													<div class="form-group col-xs-6">
														<label for ="">Date:</label>                                          
													  	<input class="form-control" required readonly name="date" id = "datepicker"type="text">  
													</div>  
                                                    <div class="form-group col-xs-6">
														<label for ="">Name:</label>                                          
													  	<input class="form-control" required name="name" type="text" placeholder="Branch Name">  
													</div>  
                                                    <div class="form-group col-xs-6">
														<label for ="">Phone:</label>                                          
													  	<input class="form-control" required name="phone" type="text" placeholder="Phone">  
													</div>  
                                                    <div class="form-group col-xs-6">
														<label for ="">Address:</label>                                          
													  	<input class="form-control" required name="addr" type="text" placeholder="Address">  
													</div>  
                                                    <div class="form-group col-xs-6">
														<label for ="">Branch Type:</label>                                          
													  	<select class = "form-control" name = "type">
                                                            <option value="">Select Type</option>
                                                                <?php
                                                                    $product = mysqli_query($connect,"SELECT * FROM branch_type");
                                                                    while ($row1 = mysqli_fetch_assoc($product)) { ?>
                                                                    <option value="<?php echo $row1['branch_type_id']; ?>"><?php echo $row1['branch_type_name'];?></option>
                                                                <?php 
                                                                }
                                                                ?>   
                                                        </select>       
													</div>  
                                                    <div class="form-group col-xs-6">
														<label for ="">Employee:</label>                                          
													  	<select class = "form-control" name = "employee">
                                                            <option value="">Select Type</option>
                                                                <?php
                                                                    $product = mysqli_query($connect,"SELECT * FROM employee");
                                                                    while ($row1 = mysqli_fetch_assoc($product)) { ?>
                                                                    <option value="<?php echo $row1['emp_id']; ?>"><?php echo $row1['name_english'];?></option>
                                                                <?php 
                                                                }
                                                                ?>   
                                                        </select>       
													</div>   
													<div class="form-group col-xs-12">
														<label for="note">Note:</label>
														 <textarea class="form-control" rows="4" id="note" name = "note"></textarea>
													</div>             
													<div class="form-group col-xs-12">
														<button type="submit" name = "btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Save changes</button>
														<button type="reset" class="btn btn-default">Reset</button>
													</div> 
												</form>
										</div>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                                            <th>ID</th>
                                            <th>Date</th>
											<th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Branch Type</th>
                                            <th>Employee</th>
                                            <th>Note</th> 
                                            <th><i class="fa fa-cog" aria-hidden="true"></i></th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											while($row = $result->fetch_assoc()) 
											{		
												$v1=$row["branch_id"];	
												$v2=$row["date_recode"];
												$v3=$row["branch_name"];
                                                $v4=$row["branch_phone"];
                                                $v5=$row["address"];
                                                $v6=$row["branch_type_name"];
                                                $v7=$row["name_english"];
                                                $v8=$row["branch_note"];			
										?>
										<tr>
											<td><?php echo $v1;?></td>
											<td><?php echo $v2;?></td>
											<td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <td align = "center">
                                                <a href="edit_branch.php?id=<?php echo $row['branch_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                <a onclick = "return confirm('Are you sure to delete ?');" href="branch.php?id=<?php echo $row['branch_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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