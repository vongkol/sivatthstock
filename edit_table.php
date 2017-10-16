<?php include'config/db_connect.php';
ob_start();
session_start();

if(empty($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}
if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from table_list where t_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
		$t3 = $row['status'];	
	}
if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$st = $_POST["st"];
			$table = $_POST['table'];

			$update = "UPDATE table_list SET t_name = '$table',
												 status = '$st'
													WHERE 
												t_id = '$id' ";
			mysqli_query($connect, $update);
			header("location:table.php");

}
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Edit Table List</li>
      </ol>
   		<div class="panel panel-primary">
		    <div class="panel-heading">
		    	<a href="table.php" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
		    </div>

		    <div class="panel-body">
		    	<form method = "POST" action="">
		    	<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
		    	Now :
		    	<?php
                                if ( $t3 == 0){
                                    echo '<span class="label label-danger">Busy</span>';
                                }
                                else if ( $t3 == 1 ) {
                                   echo '<span class="label label-info">Free</span>';
                                }
                                else if ( $t3 == 2 ) {
                                     echo '<span class="label label-success">Cleaning</span>';
                                }

                                ?>
				                </br>
				<label for ="">Name</label>                                          
				<input class="form-control" required name="table" type="text" placeholder="Number" value = "<?php echo $row["t_name"]?>"> 
								<label><input type="radio" name="st" value="0" >Busy</label></br>
								<label><input type="radio" name="st" value="1"> Free</label></br>
								<label> <input type="radio" name="st" value="2"> Cleaning</label>
								</br>
				<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
				</form>
		   </div>
		    <div class="panel-footer">Panel Footer</div>
	  </div>
<?php include 'footer.php';?>