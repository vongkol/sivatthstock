<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
	$sql = "SELECT * FROM employee INNER JOIN position ON employee.position_id = position.position_id";	
	$result = $connect->query($sql);
	
	if(isset($_POST["btnadd"])){
		$kname = $_POST["name_khmer"];
		$ename = $_POST["name_english"];
		$start = $_POST["starton"];
		$position = $_POST["position"];
		$phone = $_POST["phone"];
		$note = $_POST["note"];

	 
		 $sql = "INSERT INTO employee (name_khmer,name_english,start_on,position_id,phone,emp_note) 
		 					VALUES ('$kname', '$ename' , '$start', '$position', '$phone' , '$note')";
		 $result = mysqli_query($connect, $sql);
		 header('location:employee.php?message=success');
 }
 	if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM employee WHERE emp_id = '$id'" ;
		$result = mysqli_query($connect, $sql);
		header("location:employee.php?message=delete");	
}	
	
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employee List</li>
      </ol>
	<div class="row">
		<div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add employee</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update employee</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete employee</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Employee</button>
							  <!-- Modal -->
							  <div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Employee</h4>
									</div>
									<div class="modal-body">
										<div class="col-md-12">
												<form method="post" enctype="multipart/form-data" action="">                      
													<div class="form-group col-xs-6">
														<label for ="">Name(kh):</label>                                          
														<input class="form-control" required name="name_khmer" type="text" placeholder="Name(kh)">                                   
													</div>
													<div class="form-group col-xs-6">
														<label for ="">Name(en):</label>                                          
														<input class="form-control" required name="name_english" type="text" placeholder="Name(en)">                                                                  
													</div>
													<div class="form-group col-xs-6">
														<label for ="">Start On:</label>                                          
														<input class="form-control" required readonly name="starton" type="text" placeholder="starton" id="datepicker">
													</div>
													<div class = "from-group col-xs-6">
														<label for = "">Position:</label>
														<select class = "form-control" name = "position">
															<option value="">Select here</option>
													  			<?php
													  				$position = mysqli_query($connect,"SELECT * FROM position");
													  				while ($row = mysqli_fetch_assoc($position)) { ?>
													  				<option value="<?php echo $row['position_id']; ?>"><?php echo $row['position']; ?></option>
													  			<?php	
													  			}
													  			 ?>		
														</select>
													</div>
													<div class="form-group col-xs-12">
														<label for ="">Phone:</label>                                          
														<input class="form-control" required name="phone" type="text" placeholder="Phone">                                   
													</div>
													<div class="form-group col-xs-12">
														<label for="note">Note:</label>
														 <textarea class="form-control" rows="4" id="note" name = "note"></textarea>
													</div>
													<div class="form-group col-xs-6">
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
                                            <th>#</th>
                                            <th>Name(Kh)</th>
                                            <th>Name(En)</th>
                                            <th>Start On</th>
                                            <th>Position</th>
											<th>Phone</th>
											<th>Note</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											while($row = $result->fetch_assoc()) 
											{			
												$v1=$row["emp_id"];
												$v2=$row["name_khmer"];
												$v3=$row["name_english"];
												$v4=$row["start_on"];
												$v5=$row["position"];
												$v6=$row["phone"];
												$v7=$row["emp_note"];
										?>
										<tr>
											<td><?php echo $v1;?></td>
											<td><?php echo $v2;?></td>
											<td><?php echo $v3;?></td>
											<td><?php echo $v4;?></td>
											<td><?php echo $v5;?></td>
											<td><?php echo $v6;?></td>
											<td><?php echo $v7;?></td>
											<td align = "center">
											<a href="edit_employee.php?id=<?php echo $row['emp_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a onclick = "return confirm('Are you sure to delete ?');" href="employee.php?id=<?php echo $row['emp_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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