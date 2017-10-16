<?php include'config/db_connect.php';
    ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from stockin where in_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$date      = $_POST["date"];
		    $code      = $_POST["code"];
		    $product   = $_POST["product"];
		    $qauntity  = $_POST["qauntity"];
		    $price     = $_POST["price"];
		    $amount    = $_POST["amount"];
		    $payamount = $_POST["payamount"];
		    $rest      = $_POST["rest"];
		    $expire    = $_POST["expire"];
		    $vender    = $_POST["vender"];
		    $employee  = $_POST["employee"];
		    $note      = $_POST["note"];
		
				$sql = "UPDATE stockin SET date_in  ='$date'
									, code_in 		= '$code' 
									, pro_id 		= '$product'
									, qty_in 		= '$qauntity'
									, price 		= '$price'
									, amount		= '$amount'
									, payamount		=	'$payamount'
									, rest_amount	=	'$rest'
									, expire_date	=	'$expire'
									, note_in 		=	'$note'
									, vender_id		=	'$vender'
									, emp_id		=	'$employee'
										WHERE 
										in_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:stockin.php?message=update");
	}
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Stock In List</li>
        <li class="active">Edit stockin</li>
      </ol>
	<div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Stock In</div>
                   	<div class = "panel-body">
						<div class="col-md-12 details">
						<form method="post" enctype="multipart/form-data" action="">     
                          <div class="form-group col-xs-6">
                          	<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                            <label for ="">Date:</label>                                          
                            <input class="form-control"  readonly required name="date" type="text" placeholder="Date add to Stock" id="datepicker" value = "<?php echo $row["date_in"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">code:</label>                                          
                            <input class="form-control"   required name="code" type="text" placeholder="code" value = "<?php echo $row["code_in"]?>">  
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">Product:</label>
                            <select class = "form-control" name = "product">
                            <option value="<?php echo $row['pro_id']; ?>">
							  			<?php 
									  		$code = $row['pro_id'];
									  		$viewcate = mysqli_query($connect,"SELECT * FROM product WHERE pro_id = '$code'");
									  		$display = mysqli_fetch_assoc($viewcate);
									  		echo $display['name_en']." :: ".$display['name_kh'];
							  			 ?>
							</option>
                              
                            </select>
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qauntity</label>                                          
                            <input class="form-control quantity"   required name="qauntity" type="number" placeholder="Qauntity" value = "<?php echo $row["qty_in"]?>">       
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Price:</label>                                          
                            <input class="form-control price"   required name="price" type="text" placeholder="Price" value = "<?php echo $row["price"]?>">         
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Amount:</label>                                          
                            <input class="form-control amount"   required  name="amount" type="number" placeholder="Amount" value = "<?php echo $row["amount"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Pay Amount:</label>                                          
                            <input class="form-control pay"   required name="payamount" type="number" placeholder="Pay Amount" value = "<?php echo $row["payamount"]?>">           
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">Rest:</label>                                     
                            <input class="form-control rest"   required  name="rest" type="number" placeholder="Rest" value = "<?php echo $row["rest_amount"]?>">       
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">Expire Date:</label>                                     
                             <input class="form-control"   required name="expire" type="text" placeholder="Expire Date" id="datepicker1" value = "<?php echo $row["expire_date"]?>"> 
                          </div>
                          <div class = "form-group col-xs-6">
                              <label for = "">Vender:</label>
                              <select class = "form-control" name = "vender">
                              	<option value="<?php echo $row['vender_id']; ?>">
                                <?php 
                                  $code = $row['vender_id'];
                                  $viewcate = mysqli_query($connect,"SELECT * FROM vender WHERE vender_id = '$code'");
                                  $display = mysqli_fetch_assoc($viewcate);
                                  echo $display['vendername_en']." :: ".$display['vendername_kh'];
                                ?>
                          </option>
                                <option value="">Select Product</option>
                                    <?php
                                      $vender = mysqli_query($connect,"SELECT * FROM vender");
                                      while ($row2 = mysqli_fetch_assoc($vender)) { ?>
                                      <option value="<?php echo $row2['vender_id']; ?>"><?php echo $row2['vendername_en'];?> :: <?php echo $row2['vendername_kh'];?></option>
                                    <?php 
                                    }
                                     ?>   
                              </select>
                          </div>
                          <div class = "form-group col-xs-6">
                              <label for = "">Employee:</label>
                                <select class = "form-control" name = "employee">
                                <option value="<?php echo $row['emp_id']; ?>">
							  			<?php 
									  		$code = $row['emp_id'];
									  		$viewcate = mysqli_query($connect,"SELECT * FROM employee WHERE emp_id = '$code'");
									  		$display = mysqli_fetch_assoc($viewcate);
									  		echo $display['name_khmer']." :: ".$display['name_english'];
							  			 ?>
								</option>
                                   <option value="">Select Employee</option>
                                    <?php
                                       $employee = mysqli_query($connect,"SELECT * FROM employee");
                                        while ($row3 = mysqli_fetch_assoc($employee)) { ?>
                                       <option value="<?php echo $row3['emp_id']; ?>"><?php echo $row3['name_khmer'];?> :: <?php echo $row3['name_english'];?></option>
                                    <?php 
                                    }
                                     ?>   
                               </select>
                          </div>
                          <div class="form-group col-xs-12">
                            <label for="note">Note:</label>
                             <textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["note_in"]?></textarea>
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