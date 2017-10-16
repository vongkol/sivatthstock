<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from branch where branch_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$date = $_POST["date"];
			$name = $_POST["name"];
            $phone = $_POST['phone'];
			$addr = $_POST["addr"];
			$type = $_POST["type"];
			$emp = $_POST["emp"];
			$note = $_POST["note"];
		
				$sql = "UPDATE branch SET date_recode = '$date' 
									, branch_name   = '$name'
									, branch_phone  = '$phone'
									, address  = '$addr'
									, branch_type_id 	= '$type'
									, emp_id 	= '$emp'
									, branch_note 	= '$note'
									WHERE branch_id = '$id'" ;
                echo $sql;
			mysqli_query($connect, $sql);
			header("location:branch.php?message=update");
	}
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Branch List</li>
        <li class="active">Edit Branch</li>
      </ol>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Branch</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                    
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Date:</label>                                          
									<input class="form-control" required readonly name="date" id = "datepicker" type="text" value = "<?php echo $row["date_recode"]?>">    
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Branch Name:</label>                                          
									<input class="form-control" required name="name" type="text" placeholder="Branch Name" value = "<?php echo $row["branch_name"]?>">
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Phone:</label>                                          
									<input class="form-control" required name="phone" type="text" placeholder="phone" value = "<?php echo $row["branch_phone"]?>">
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Address:</label>                                          
									<input class="form-control" required  name="addr" type="text" placeholder="Address" value = "<?php echo $row["address"]?>">      
								</div>
								  <div class = "from-group col-xs-6">
		                            <label for = "">Branch Type:</label>
		                            <select class = "form-control" name = "type">
		                              <option value="<?php echo $row['branch_type_id']; ?>">
							  			<?php 
									  			$code = $row['branch_type_id'];
									  			$viewcate = mysqli_query($connect,"SELECT * FROM branch_type WHERE branch_type_id = '$code'");
									  			$display = mysqli_fetch_assoc($viewcate);
									  			echo $display['branch_type_name'];
							  			 ?>
							  			</option>
		                              <option value="">Select Type</option>
		                                  <?php
		                                    $type = mysqli_query($connect,"SELECT * FROM branch_type");
		                                    while ($row1 = mysqli_fetch_assoc($type)) { ?>
		                                    <option value="<?php echo $row1['branch_type_id']; ?>"><?php echo $row1['branch_type_name']; ?></option>
		                                  <?php 
		                                  }
		                                   ?>   
		                            </select>
		                        </div>
                                <div class = "from-group col-xs-6">
		                            <label for = "">Employee:</label>
		                            <select class = "form-control" name = "emp">
		                              <option value="<?php echo $row['emp_id']; ?>">
							  			<?php 
									  			$code = $row['emp_id'];
									  			$viewcate = mysqli_query($connect,"SELECT * FROM employee WHERE emp_id = '$code'");
									  			$display = mysqli_fetch_assoc($viewcate);
									  			echo $display['name_english'];
							  			 ?>
							  			</option>
		                              <option value="">Select Employee</option>
		                                  <?php
		                                    $type = mysqli_query($connect,"SELECT * FROM employee");
		                                    while ($row1 = mysqli_fetch_assoc($type)) { ?>
		                                    <option value="<?php echo $row1['emp_id']; ?>"><?php echo $row1['name_english']; ?></option>
		                                  <?php 
		                                  }
		                                   ?>   
		                            </select>
		                        </div>
								<div class="form-group col-xs-12">
									<label for="note">Note:</label>
									<textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["branch_note"]?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>