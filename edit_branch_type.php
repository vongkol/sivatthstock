<?php
	include'config/db_connect.php';
	ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from branch_type where branch_type_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$type = $_POST["type"];
   		    $note = $_POST["note"];

			$sql = "UPDATE branch_type SET branch_type_name = '$type', branch_type_note = '$note' WHERE branch_type_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:branch_type.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Edit Branch Type</li>
      </ol>
      <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Branch Type</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-12">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
		                            <label for ="">Branch Type:</label>                                          
		                       		<input class="form-control" required  name="type" type="text" placeholder="Branch Type" value = "<?php echo $row["branch_type_name"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["branch_type_note"]?></textarea>
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