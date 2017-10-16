<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
$errors = "";
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from user where id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$user = $_POST["user"];
			$pass = $_POST["pass"];
			$cpass = $_POST["cpass"];
			$pos = $_POST["pos"];

			if( $pass == $cpass ){
			 $sql = "UPDATE  user SET 
			 						username = '$user', 
			 						password = md5('$pass'),
			 						position_id = '$pos'
			 								WHERE
			 							id = '$id'"; 
			 					
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

?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#"><class="">User</a></li>
        <li class="active">Edit User</li>
      </ol>
      <div class="row">
        <div class="col-lg-12">
        	<div class = "row">
                		<div class = "col-xs-12">
                		<?php echo $errors;?>
                		</div>
                	</div>
            <div class="panel panel-default">
                <div class="panel-heading">
                	<a href="user.php" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Username:</label>                                          
									<input class="form-control" required name="user" type="text" placeholder="Username" value = "<?php echo $row["username"]?>">    
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Password:</label>                                          
									<input class="form-control" required name="pass" type="password" placeholder="Password" value = "<?php echo $row["password"]?>">    
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Confrim Password:</label>                                          
									<input class="form-control" required name="cpass" type="password" placeholder="Confirm Password" value = "<?php echo $row["password"]?>">    
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
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>
