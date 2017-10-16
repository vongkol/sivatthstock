<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from vender where vender_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$kname = $_POST["name_khmer"];
			$ename = $_POST["name_english"];
			$contact = $_POST["contact"];
			$phone = $_POST["phone"];
			$addr = $_POST["addr"];
			$type = $_POST["type"];
			$note = $_POST["note"];
		
				$sql = "UPDATE vender SET vendername_kh = '$kname' 
									, vendername_en = '$ename'
									, contact_name = '$contact'
									, phone 		= '$phone'
									, address  		= '$addr'
									, sup_type_id 	= '$type'
									, note 			= '$note'
									WHERE vender_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:vender.php?message=update");
	}
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Supplier List</li>
        <li class="active">Edit Supplier</li>
      </ol>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Supplier</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                    
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Supplier Name(kh):</label>                                          
									<input class="form-control" required name="name_khmer" type="text" placeholder="Name(kh)" value = "<?php echo $row["vendername_kh"]?>">    
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Supplier Name(en):</label>                                          
									<input class="form-control" required name="name_english" type="text" placeholder="Name(en)" value = "<?php echo $row["vendername_en"]?>">
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Contact Name:</label>                                          
									<input class="form-control" required name="contact" type="text" placeholder="Contact name" value = "<?php echo $row["contact_name"]?>">
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Phone:</label>                                          
									<input class="form-control" required name="phone" type="text" placeholder="Phone" value = "<?php echo $row["phone"]?>">   
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Address:</label>                                          
									<input class="form-control" required  name="addr" type="text" placeholder="Address" value = "<?php echo $row["address"]?>">      
								</div>
								  <div class = "from-group col-xs-6">
		                            <label for = "">Supplier Type:</label>
		                            <select class = "form-control" name = "type">
		                              <option value="<?php echo $row['sup_type_id']; ?>">
							  			<?php 
									  			$code = $row['sup_type_id'];
									  			$viewcate = mysqli_query($connect,"SELECT * FROM sup_type WHERE sup_type_id = '$code'");
									  			$display = mysqli_fetch_assoc($viewcate);
									  			echo $display['sup_type_name'];
							  			 ?>
							  			</option>
		                              <option value="">Select Type</option>
		                                  <?php
		                                    $type = mysqli_query($connect,"SELECT * FROM sup_type");
		                                    while ($row1 = mysqli_fetch_assoc($type)) { ?>
		                                    <option value="<?php echo $row1['sup_type_id']; ?>"><?php echo $row1['sup_type_name']; ?></option>
		                                  <?php 
		                                  }
		                                   ?>   
		                            </select>
		                        </div>
								<div class="form-group col-xs-12">
									<label for="note">Note:</label>
									<textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["note"]?></textarea>
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