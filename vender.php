<?php include 'config/db_connect.php';
// check if user is not logged in 
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
	$sql = "SELECT * FROM vender A INNER JOIN sup_type B ON A.sup_type_id = B.sup_type_id";	
	$result = $connect->query($sql);
	
	if(isset($_POST["btnadd"])){
		$kname = $_POST["name_khmer"];
		$ename = $_POST["name_english"];
		$contact = $_POST["contact"];
		$phone = $_POST["phone"];
		$addr = $_POST["addr"];
		$type = $_POST["type"];
		$note = $_POST["note"];

		 $sql = "INSERT INTO vender 
		 						(vendername_kh,vendername_en,contact_name,phone,address,sup_type_id,note) 
		 					VALUES 
		 						('$kname', '$ename' ,'$contact', '$phone' , '$addr','$type','$note')";
		 $result = mysqli_query($connect, $sql);
		 header('location:vender.php?message=success');
 }
    if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM vender WHERE vender_id = '$id'" ;
		$result = mysqli_query($connect, $sql);
		header("location:vender.php?message=delete");	
}	
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Supplier List</li>
      </ol>
	<div class="row">
		<div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add vender</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update vender</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete vender</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Supplier</button>
							  <!-- Modal -->
							  <div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Supplier</h4>
									</div>
									<div class="modal-body">
										<div class="col-md-12">
												<form method="post" enctype="multipart/form-data" action="">                     
													<div class="form-group col-xs-6">
														<label for ="">Sup Name(kh):</label>                                          
														<input class="form-control" required name="name_khmer" type="text" placeholder="Name(kh)">    
													</div>
													<div class="form-group col-xs-6">
														<label for ="">Sup Name(en):</label>                                          
														<input class="form-control" required name="name_english" type="text" placeholder="Name(en)">
													</div>
													<div class="form-group col-xs-6">
														<label for ="">Contace Name:</label>                                          
														<input class="form-control" required name="contact" type="text" placeholder="Contace Name">     
													</div>
													<div class="form-group col-xs-6">
														<label for ="">Phone:</label>                                          
														<input class="form-control" required name="phone" type="text" placeholder="Phone">     
													</div>
													<div class="form-group col-xs-6">
														<label for ="">Address:</label>                                          
														<input class="form-control" required  name="addr" type="text" placeholder="Address">          
													</div>
													<div class = "from-group col-xs-6">
													<label for = "">Supplier Type:</label>
														<select class = "form-control" name = "type">
															<option value="">Select Type</option>
																<?php
																	$Type = mysqli_query($connect,"SELECT * FROM sup_type");
																		while ($row3 = mysqli_fetch_assoc($Type)) { ?>
																	<option value="<?php echo $row3['sup_type_id']; ?>"><?php echo $row3['sup_type_name'];?></option>
																<?php  
																}
																?>   
													</select>
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
                                            <!-- <th>ID</th> -->
                                            <th>No</th>
                                            <th>Sup Name(Kh)</th>
                                            <th>Sup Name(En)</th>
																						<th>Contact Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
																						<th>Supplier Type</th>
																						<th>Note</th>
																						<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											while($row = $result->fetch_assoc()) 
											{			
												// $v1=$row["vender_id"];
												$v2=$row["vender_id"];
												$v3=$row["vendername_kh"];
												$v4=$row["vendername_en"];
												$v5=$row["contact_name"];
												$v6=$row["phone"];
												$v7=$row["address"];
												$v8=$row["sup_type_name"];
												$v9=$row["note"];
										?>
										<tr>
											<!-- <td><?php //echo $v1;?></td> -->
											<td><?php echo $v2;?></td>
											<td><?php echo $v3;?></td>
											<td><?php echo $v4;?></td>
											<td><?php echo $v5;?></td>
											<td><?php echo $v6;?></td>
											<td><?php echo $v7;?></td>
											<td><?php echo $v8;?></td>
											<td><?php echo $v9;?></td>
											<td align = "center">
											<a href="edit_vender.php?id=<?php echo $row['vender_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a onclick = "return confirm('Are you sure to delete ?');" href="vender.php?id=<?php echo $row['vender_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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