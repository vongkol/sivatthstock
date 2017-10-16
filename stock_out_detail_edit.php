<?php include'config/db_connect.php';
    ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id WHERE A.sto_out_id = '$id'";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$item_no = $_POST['item_no'];
            $qty = $_POST['qty'];
            $unit_price = $_POST['unit_price'];
            $unit = $_POST['unit'];
            $account_change=$_POST['account_change'];
            $description=$_POST['description'];
            $total_price=$_POST['total_price'];
    
		
				$sql = "UPDATE stock_out_detail SET item_no  ='$item_no'
									, qty		= '$qty' 
									, unit_price		= '$unit_price'
									, unit 		= '$unit'
									, account_change 		= '$account_change'
									, description		= '$description'
									, total_price		=	'$total_price'
									
										WHERE 
										ind_no = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:stock_out_approve_detail.php?in_no=$id");
	}
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Stock out detail List</li>
        <li class="active">Edit stock out detail </li>
      </ol>
	<div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Stock out detail</div>
                   	<div class = "panel-body">
						<div class="col-md-12 details">
						 <form method="post" class="form-horizontal" action="stock_out_detail_edit.php" enctype="multipart/form-data">
                        <div class="row">
                           <input type="hidden" name="id" value="<?php echo $row['ind_no'] ?>">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">លេខកូដទំនិញ/Item 
                                code:</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select name="item_no" id="proMy" class="form-control" required>
                                        <option value="">Please Select Product Code</option>
                                       <?php 
                                                  $generate = $row['in_id'];
                                                  $sql1 = "SELECT * FROM stockin ORDER BY in_id ASC";
                                                  $result1 = mysqli_query($connect,$sql1);
                                                  while($row1 = mysqli_fetch_assoc($result1)):
                                                     $select=($generate==$row1['in_id'])?"selected":"";
                                                echo "<option $select value='".$row1['in_id']."'>".$row1['code_in']."</option>";
                                                ?>
                                                <?php endwhile; ?>
                                       
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ចំនួន/Qty:</label>
                                    <div class="input-group col-sm-4">
                                        <span class="input-group-addon"></span>

                                        <input type="text" id="idQty" onchange="calPrice()" onkeypress="return isNumberKey(event); this.onchange()" oninput="this.onchange()" onpaste="this.onchange()" class="form-control" name="qty" value="<?php echo $row['qty'] ?>">

                                    </div>
                                </div>
                                <div id="test1My">
                                    <label class="col-sm-2 control-label">តម្លៃរាយ/Unit Price:</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span>
                                            <input name="unit_price"  class="form-control" type="text" readonly value="<?php echo $row['unit_price'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">ខ្នាត/Unit:</label>
                                        <div class="input-group col-sm-3">
                                            <span class="input-group-addon"></span>
                                            <input name="unit"  class="form-control" type="text" readonly value="<?php echo $row['unit'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label">ចុះក្នុងគណនីលេខ<br>Account to be Charged:</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input name="account_change" value="<?php echo $row['account_change'] ?>" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">តម្លៃសរុប/Total Price:</label>
                                    <div class="input-group col-sm-3">
                                        <span class="input-group-addon"></span>
                                        <input name="total_price" value="<?php echo $row['total_price'] ?>" class="form-control" type="text" id="result">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">បរិយាយ/Description:</label>
                                    <div class="input-group col-sm-3">
                                        <span class="input-group-addon"></span>
                                        <textarea name="description" class="form-control" rows="5" id="comment"><?php echo $row['description'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btn-add" class="btn btn-primary" style="margin-bottom: 10px">Updated</button>
                        </div>

                              
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>