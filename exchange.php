<?php include 'config/db_connect.php';
// check if user is not logged in
$errors = ""; 
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
	$sql = "SELECT * FROM exchange";	
	$result = $connect->query($sql);
	

	if(isset($_POST["btnadd"])){
		$ex = $_POST["ex"];
		$note = $_POST['note'];
	
		$sql = "UPDATE exchange SET exchange = '$ex' ,
								note = '$note'
								WHERE
								exchange_id = 1
								";
			$result = mysqli_query($connect, $sql);
			header('location:exchange.php?message=success');


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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> ផ្លាស់ប្តូរ Exchange</button>
							  <!-- Modal -->
							  <div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i>ផ្លាស់ប្តូរ Exchange</h4>
									</div>
									<div class="modal-body">
										<div class="col-md-12">
												<form method="post" enctype="multipart/form-data" action="">     
													<div class="form-group col-xs-6">
														<label for ="">Exchange:</label>                                          
													  	<input class="form-control" required name="ex" type="text" placeholder="Ex:4100 or 4000">  
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
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>exchange</th>
											<th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											while($row = $result->fetch_assoc()) 
											{	
												$v3=$row["exchange_id"];	
												$v1=$row["exchange"];
												$v2=$row["note"];			
										?>
										<tr>
											<td><?php echo $v3;?></td>
											<td><?php echo $v1;?></td>
											<td><?php echo $v2;?></td>
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