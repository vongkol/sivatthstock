
<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from product where pro_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$code = $_POST["code"];
		    $paket = $_POST["paket"];
		    $category = $_POST["category"];
		    $en = $_POST["en"];
		    $kh = $_POST["kh"];
		    $priced = $_POST["priced"];
		    $pricek = $_POST["pricek"];	 
		    $image = "no_photo.png";
		    $note = $_POST["note"];

		    if(!empty($_FILES['image']['size'])){
   			$image = $_FILES['image']['name'];
    		move_uploaded_file($_FILES['image']['tmp_name'],"img/product/$image");
			$sql = "UPDATE product SET code ='$code'
									, paket 	  = '$paket' 
									, name_en  	  = '$en'
									, name_kh 	  = '$kh'
									, price_dolla = '$priced'
									, price_riel  = '$pricek'
									, photo 	  = '$image'
									, note_pro    = '$note'
									, cate_id     = '$category'
												WHERE
										   pro_id = '$id'";
			mysqli_query($connect, $sql);
			header("location:product.php?message=update");
		}
		else{
			$sql = "UPDATE product SET code ='$code'
									, paket 	  = '$paket' 
									, name_en  	  = '$en'
									, name_kh 	  = '$kh'
									, price_dolla = '$priced'
									, price_riel  = '$pricek'
									, note_pro    = '$note'
									, cate_id     = '$category'
												WHERE
										   pro_id = '$id'";
			mysqli_query($connect, $sql);
			header("location:product.php?message=update");
		}
}
?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="stock.php"><class="">Stock</a></li>
        <li><a href="product.php"><class="">Item List</a></li>
        <li class="active">Edit product</li>
      </ol>
      <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<a href="product.php" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                </div>

                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Code:</label>                                          
									<input class="form-control" required name="code" type="text" placeholder="Name(kh)" value = "<?php echo $row["code"]?>">    
								</div>
								<div class="form-group col-xs-6">
		                            <label for ="">Paket:</label>                                          
		                            <select class = "form-control" name = "paket">
		                              <option value="<?php echo $row['paket']; ?>">
							  			<?php 
									  			$code = $row['paket'];
									  			$viewcate = mysqli_query($connect,"SELECT * FROM unit WHERE u_name = '$code'");
									  			$display = mysqli_fetch_assoc($viewcate);
									  			echo $display['u_name'];
							  			 ?>
							  			</option>
		                              <option value="">Select Unit</option>
		                                  <?php
		                                    $position = mysqli_query($connect,"SELECT * FROM unit");
		                                    while ($row1 = mysqli_fetch_assoc($position)) { ?>
		                                    <option value="<?php echo $row1['u_name']; ?>"><?php echo $row1['u_name']; ?></option>
		                                  <?php 
		                                  }
		                                   ?>   
		                            </select>          
		                        </div>
		                        <div class = "form-group col-xs-6">
		                            <label for = "">Category:</label>
		                            <select class = "form-control" name = "category">
		                              <option value="<?php echo $row['cate_id']; ?>">
							  			<?php 
									  			$code = $row['cate_id'];
									  			$viewcate = mysqli_query($connect,"SELECT * FROM Category WHERE cate_id = '$code'");
									  			$display = mysqli_fetch_assoc($viewcate);
									  			echo $display['category_name'];
							  			 ?>
							  			</option>
		                              <option value="">Select Catetegory</option>
		                                  <?php
		                                    $position = mysqli_query($connect,"SELECT * FROM Category");
		                                    while ($row1 = mysqli_fetch_assoc($position)) { ?>
		                                    <option value="<?php echo $row1['cate_id']; ?>"><?php echo $row1['category_name']; ?></option>
		                                  <?php 
		                                  }
		                                   ?>   
		                            </select>
		                        </div>
		                       	<div class="form-group col-xs-6">
		                            <label for ="">Name:(En):</label>                                          
		                            <input class="form-control"   required name="en" type="text" placeholder="English" value = "<?php echo $row["name_en"]?>">          
		                        </div>
		                        <div class="form-group col-xs-6">
		                            <label for ="">Name(Kh):</label>                                          
		                            <input class="form-control"   required name="kh" type="text" placeholder="Khmer" value = "<?php echo $row["name_kh"]?>">          
		                        </div>
		                        <div class="form-group col-xs-6">
		                            <label for ="">Price Retial
                                            </label>                                          
		                            <input class="form-control"   required name="priced" type="text" placeholder="$" value = "<?php echo $row["price_dolla"]?>">          
		                        </div>
		                        <div class="form-group col-xs-6">
		                            <label for ="">Price Wholesale:</label>                                          
		                            <input class="form-control"   required name="pricek" type="text" placeholder="៛" value = "<?php echo $row["price_riel"]?>" >          
		                        </div>
		                        <div class = "form-group col-xs-12">
		                        	<div class = "col-xs-3">
			                            <label for = "">photo:</label>                                     
			                            <input type="file"   id = "phot" name="image" />
			                        </div>
			                        <div class = "col-xs-6">
		                            <img src = "img/product/<?php echo $row["photo"]?>" width = "200px">
		                            </div>
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                             <textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["note_pro"]?></textarea>
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