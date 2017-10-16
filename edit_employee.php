<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from employee where emp_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$kname = $_POST["name_khmer"];
			$ename = $_POST["name_english"];
			$start = $_POST["starton"];
			$phone = $_POST["phone"];
			$position = $_POST["position"];
			$note = $_POST["note"];
		
				$sql = "UPDATE employee SET name_khmer ='$kname'
									, name_english 	= '$ename' 
									, start_on 		= '$start'
									, position_id 	= '$position'
									, phone 		= '$phone'
									, emp_note		= '$note'
										WHERE emp_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:employee.php?message=update");
	}
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Employee List</li>
        <li class="active">Edit Employee</li>
      </ol>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Employee</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Employee Name(kh):</label>                                          
									<input class="form-control" required name="name_khmer" type="text" placeholder="Name(kh)" value = "<?php echo $row["name_khmer"]?>">    
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Employee Name(en):</label>                                          
									<input class="form-control" required name="name_english" type="text" placeholder="Name(en)" value = "<?php echo $row["name_english"]?>">
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Start On:</label>                                          
									<input class="form-control" required readonly name="starton" type="text" placeholder="starton" id="datepicker"
									value = "<?php echo $row["start_on"]?>">                                   
								</div>
								<div class = "from-group col-xs-6">
									<label for = "">Position:</label>
									<select class = "form-control" name = "position">
										<option value="">Select here</option>
								  			<?php
								  				$position = mysqli_query($connect,"SELECT * FROM position");
								  				while ($rows = mysqli_fetch_assoc($position)) { ?>
								  				<option value="<?php echo $rows['position_id']; ?>"><?php echo $rows['position']; ?></option>
								  			<?php	
								  				}
								  			?>	
									</select>
								</div>
								<div class="form-group col-xs-12">
									<label for ="">phone:</label>                                          
									<input class="form-control" required  name="phone" type="text" placeholder="Phone" value = "<?php echo $row["phone"]?>">      
								</div>
								<div class="form-group col-xs-12">
									<label for="note">Note:</label>
									<textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["emp_note"]?></textarea>
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