<?php include 'config/db_connect.php';
// check if user is not logged in
$errors = ""; 
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
	$sql = "SELECT * FROM user A INNER join position B ON A.position_id = B.position_id";	
	$result = $connect->query($sql);
	
	if(isset($_POST["btnadd"])){
		$user = $_POST["user"];
		$pass = $_POST["pass"];
		$cpass = $_POST["cpass"];
		$pos = $_POST["pos"];

		if( $pass == $cpass ){
		 $sql = "INSERT INTO user 
		 						(username, password ,position_id) 
		 					VALUES 
		 						('$user', md5('$pass'), '$pos')";
		 $result = mysqli_query($connect, $sql);
		 header('location:user.php?message=success');
		 }
		 else{
		  $errors = "<div class = 'alert alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						<h6>password confirm is not match</h6><h6>លេខសំងាត់ទាំងពីឬមិនត្រូវគ្នា</h6></div>
		";
		 }
 }
    if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM user WHERE id = '$id'";
		$result = mysqli_query($connect, $sql);
		header("location:user.php?message=delete");	
}	
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vender List</li>
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
                	<div class = "row">
                		<div class = "col-xs-12">
                		<?php echo $errors;?>
                		</div>
                	</div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-user" aria-hidden="true"></i> Add New user</button>
																	
											<!-- Modal -->
											<div class="modal fade" id="myModal" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title"><i class="fa fa-user" aria-hidden="true"></i> Add New User</h4>
												</div>
												<div class="modal-body">
													<div class="col-md-12">
															<form method="post" enctype="multipart/form-data" action="">     
																<div class="form-group col-xs-6">
																	<label for ="">username:</label>                                          
																		<input class="form-control" required name="user" type="text" placeholder="username">  
																</div>                
																<div class="form-group col-xs-6">
																	<label for ="">Password:</label>                                          
																	<input class="form-control" required name="pass" type="password" placeholder="password">    
																</div>
																<div class="form-group col-xs-6">
																	<label for ="">Confirm Password:</label>                                          
																	<input class="form-control" required name="cpass" type="password" placeholder="password">    
																</div>
																<div class="form-group col-xs-6">
																	<label for ="">Position:</label>                                          
																	<select class = "form-control" name = "pos">
																									<option value="">Select Positon</option>
																											<?php
																										if ($show['position_id'] == 1) {
																												$position = mysqli_query($connect,"SELECT * FROM position");
																												while ($row1 = mysqli_fetch_assoc($position)) { ?>
																												<option value="<?php echo $row1['position_id']; ?>"><?php echo $row1['position']; ?></option>
																											<?php 
																											}
																											}
																											else{
																												$position = mysqli_query($connect,"SELECT * FROM position where position_id != 1 ");
																												while ($row1 = mysqli_fetch_assoc($position)) { ?>
																												<option value="<?php echo $row1['position_id']; ?>"><?php echo $row1['position']; ?></option>
																										
																											<?php
																												}
																													}
																											?>
																											

																											
																		</select>
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
                                            <!-- <th>ID</th> -->
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Position</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											while($row = $result->fetch_assoc()) 
											{			
												$v2=$row["username"];
												$v3=$row["password"];
												$v4=$row["position"];
												
										?>
										<tr>
											<!-- <td><?php //echo $v1;?></td> -->
											<td><?php echo $v2;?></td>
											<td><?php echo $v3;?></td>
											<td><?php echo $v4;?></td>
											<td align = "center">
											<a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a onclick = "return confirm('Are you sure to delete ?');" href="user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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