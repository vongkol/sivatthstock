<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
  $sql = "SELECT * FROM product INNER JOIN category ON product.cate_id = category.cate_id";  
  $result = $connect->query($sql);
  
  if(isset($_POST["btnadd"])){
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
       $sql = "INSERT INTO product 
                 (code,paket,name_en,name_kh,price_dolla,price_riel,photo,note_pro,cate_id) 
                VALUES 
                 ('$code','$paket', '$en','$kh','$priced','$pricek','$image','$note','$category')";
       $result = mysqli_query($connect, $sql);
       header('location:product.php?message=success');
    } 
}
if(isset($_GET["id"])){
    $id = $_GET["id"];

    $sql1 = "SELECT * from product where pro_id = $id";
    $result = mysqli_query($connect, $sql1);
    $row1 = mysqli_fetch_array($result); 

    if(file_exists('img/product/'.$row1['photo']) )
                unlink('img/product/'.$row1['photo']);
      
     $sql = "DELETE FROM product WHERE pro_id = '$id'";
     $result = mysqli_query($connect, $sql);
     header("location:product.php?message=delete");



      
} 

?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock</li>
        <li class="active">Items List</li>
      </ol>
          <div class="row">
                <div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Product</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update product</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete product</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New Product</button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Product</h4>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="">     
                          <div class="form-group col-xs-6">
                            <label for ="">Code:</label>                                          
                            <input class="form-control"   required name="code" type="text" placeholder="Code">          
                          </div>
                          
                          <div class="form-group col-xs-6">
                            <label for ="">Paket:</label>                                          
                            <select class = "form-control" name = "paket">
                              <option value="">Select Paket</option>
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
                              <option value="">Select Catetegory</option>
                                  <?php
                                    $position = mysqli_query($connect,"SELECT * FROM category");
                                    while ($row1 = mysqli_fetch_assoc($position)) { ?>
                                    <option value="<?php echo $row1['cate_id']; ?>"><?php echo $row1['category_name']; ?></option>
                                  <?php 
                                  }
                                   ?>   
                            </select>
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Name:(En):</label>                                          
                            <input class="form-control"   required name="en" type="text" placeholder="English">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Name(Kh):</label>                                          
                            <input class="form-control"   required name="kh" type="text" placeholder="Khmer">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Price:</label>                                          
                            <input class="form-control"   required name="priced" type="text" placeholder="$">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Price:</label>                                          
                            <input class="form-control"   required name="pricek" type="text" placeholder="៛">          
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">photo:</label>                                     
                            <input type="file"   id = "phot" name="image" />
                          </div>
                          <div class="form-group col-xs-12">
                            <label for="note">Note:</label>
                             <textarea class="form-control" rows="4" id="note" name = "note"></textarea>
                          </div>
                          <div class="form-group col-xs-6">
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
                <a href="dashboard.php" class="btn btn-sm btn-danger btn-flat pull-right"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>#</th>
                                            <th>Code</th>
                                      
                                            <th>Photo</th>
                                            <th>Paket</th>
                                            <th>Name(En)</th>
                                            <th>Name(Kh)</th>
                                            <th>Price Retial</th>
                                            <th>Price Wholesale</th>    
                                            <th>Note</th>
                                            <th>Category</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$row["pro_id"];
                                              $v2=$row["code"];
                                        
                                              $v3=$row["paket"];
                                              $v4=$row["name_en"];
                                              $v5=$row["name_kh"];
                                              $v6=$row["price_dolla"];
                                              $v7=$row["price_riel"];
                                              $v9=$row["photo"];
                                              $v10=$row["note_pro"];
                                              $v11=$row["category_name"];
                                          ?>
                                          <tr>
                                            <td><?php echo $v1;?></td> 
                                            <td><?php echo $v2;?></td>
                                      
                                            <td><?php echo '<img src="img/product/' . $v9 . '" style="width: 50px;" alt="Logo">';?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>  
                                            <td><?php echo $v10;?></td>
                                            <td><?php echo $v11;?></td>
                                            <td align = "center">
                                            <a href="edit_product.php?id=<?php echo $row['pro_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick = "return confirm('Are you sure to delete ?');" href="product.php?id=<?php echo $row['pro_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
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