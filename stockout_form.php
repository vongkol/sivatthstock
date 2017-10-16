<?php
require_once('config/db_connect.php');
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
$conn = "SELECT * FROM stockout";
$result = $connect->query($conn);
$id = $result->num_rows;
if($id < 0 )
{
    $id = 1;
}else
{
    $id += 1;
}
if(isset($_POST['btn-save'])) {
    
    $sql = "SELECT SUM(amount) FROM tb_invoice_detail WHERE in_no = '$id'";
    $result = $connect->query($sql);
    for($i=0; $r = $result->fetch_assoc();$i++)
            {
              $total_amount = $r['SUM(amount)'];
              $vat = $total_amount * 0.1;
              $sub_amount = $total_amount + $vat;
              $remain_amount = $sub_amount;
            }
    
    $home_number = $_POST['home_number'];
    $street_kh = $_POST['street_kh'];
    $sangkat_kh = $_POST['sangkat_kh'];
    $address_no = $_POST['address_no'];
    $street = $_POST['street'];
    $sangkat = $_POST['sangkat'];
    $town_kh = $_POST['town_kh'];
    $province_kh = $_POST['province_kh'];
    $town = $_POST['town'];
    $province = $_POST['province'];
    $customer = $_POST['customer'];
    $company_kh = $_POST['company_kh'];
    $company = $_POST['company'];
    $phone_number = $_POST['phone_number'];
    $number_kh = $_POST['number_kh'];
    $number = $_POST['number'];
    $date_kh = $_POST['date_kh'];
    $date = $_POST['date'];
    $card = $_POST['card'];
    $due_date = $_POST['due_date'];
    
    $conn = "INSERT INTO tb_invoice(home_number,street_kh,sangkat_kh,address_no,street,sangkat,town_kh,province_kh,town,province,customer,company_kh,company,phone_number,number_kh,number,date_kh,date,card,due_date,total_amount,vat,sub_amount,remain_amount)
                    VALUES('$home_number','$street_kh','$sangkat_kh','$address_no','$street','$sangkat','$town_kh','$province_kh','$town','$province','$customer','$company_kh','$company','$phone_number','$number_kh','$number','$date_kh','$date','$card','$due_date','$total_amount','$vat','$sub_amount','$remain_amount')";
    $result = mysqli_query($connect, $conn);
    header('location:invoice_list.php');
}
date_default_timezone_set('Asia/Phnom_Penh');
$day = Date('d/M/Y');
if(isset($_POST['btn-add']))
{
    $service = $_POST['service'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $amount = $qty * $price;
    
    $sql = "SELECT * FROM tb_invoice_detail WHERE description = '$service' AND in_no = $id";
    $result2 = $connect->query($sql);
    $row3 = $result2->fetch_assoc();
    $ser = $row3['description'];
    $no = $row3['in_no'];

    if($ser == $service && $no == $no) {
        $sql = "UPDATE tb_invoice_detail SET unit = unit + '$qty',amount = amount+'$amount' WHERE description = '$service' AND in_no = '$no'";
        $result = mysqli_query($connect, $sql);
        header("location:invoice.php?in_no=$no");
    }else
    {
        $conn1 = "INSERT INTO tb_invoice_detail(description,unit,unit_price,amount,in_no)
                          VALUES('$service','$qty','$price','$amount','$id')";
        $result1 = mysqli_query($connect, $conn1);
        header("location:invoice.php?in_no=$id");
    }
}


?>
    <?php require_once('header.php')?>
    <div id="page-wrapper">
       
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-12">
                        <h2 style="text-align: center;">Stock Out</h2>
                    </div>
                    <form method="post" class="form-horizontal" action="invoice.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">លេខកូដទំនិញ/Item 
                                code:</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select name="item_no" id="item" class="form-control">
                                        <option value="">Please Select Product Code</option>
                                        <?php
                                        $con = "SELECT * FROM product";
                                        $result1 = $connect->query($con);
                                        while($row2 = mysqli_fetch_assoc($result1)):
                                            echo "<option value='" . $row2['pro_id'] . "'>" . $row2['code'] . "</option>";
                                            ?>
                                        <?php endwhile; ?>
                                    </select>

                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">ចំនួន/Qty:</label>
                                        <div class="input-group col-sm-3">
                                            <span class="input-group-addon"></span>
                                            <input name="qty" value="" class="form-control" type="text" >
                                        </div>
                                    </div>
                    <div id="item_select">
                                <label class="col-sm-2 control-label">តម្លៃរាយ/Unit Price:</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input name="unit_price" value="" class="form-control" type="text" >
                                    </div>
                                </div>  
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">ខ្នាត/Unit:</label>
                                        <div class="input-group col-sm-3">
                                            <span class="input-group-addon"></span>
                                            <input name="unit" value="" class="form-control" type="text" >
                                        </div>
                                    </div>
                    </div>
                                <label class="col-sm-2 control-label">ចុះក្នុងគណនីលេខ/Account tobe Change:</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input name="account_change" value="" class="form-control" type="text" >
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-2 control-label">តម្លៃសរុប/Total Price:</label>
                                        <div class="input-group col-sm-3">
                                            <span class="input-group-addon"></span>
                                            <input name="total_price" value="" class="form-control" type="text" >
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <label class="col-sm-2 control-label">បរិយាយ/Description:</label>
                                        <div class="input-group col-sm-3">
                                            <span class="input-group-addon"></span>
                                            <textarea name="description" class="form-control" rows="5" id="comment"></textarea>
                                        </div>
                                    </div>     
                                  </div>      
                                <button type="submit" name="btn-add" class="btn btn-primary" style="margin-bottom: 10px">Add</button>
                            </div>
                       
                       
                        <style rel="stylesheet">
                            th {
                                text-align: center;
                            }
                        </style>
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>លេខកូដទំនិញ/Item 
                                code<br>Item No</th>
                                    <th>បរិយាយសេវាកម្ម<br>Description</th>
                                    <th>បរិមាណ <br>Quantity</th>
                                    <th>ថ្លៃឯកតា <br>Unit Price</th>
                                    <th>ថ្លៃទំនិញ <br>Amount</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="details">
                                <?php
                            $i = 1;
                            $sql2 = "SELECT * FROM stock_out_detail A INNER JOIN product B ON A.item_no = B.pro_id WHERE A.ind_no = '$id'";
                            $result2 = $connect->query($sql2);
                            while($row2 = $result2->fetch_assoc()):
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $i++;?>
                                        </td>
                                        <td>
                                            <?php echo $row2['product_service'];?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo $row2['unit'];?>
                                        </td>
                                        <td style="text-align: center;">$
                                            <?php echo $row2['unit_price'];?>
                                        </td>
                                        <td style="text-align: center;">$
                                            <?php echo $row2['amount'];?>
                                        </td>
                                        <td><a onclick="return confirm('Are you sure to delete ?');" href="invoice_detail_delete_table.php?ind_no=<?php echo $row2['ind_no']; ?>&in_no=<?php echo $id;?>" class="btn btn-danger">Remove</a></td>
                                    </tr>
                                    <?php endwhile;?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                $sql = "SELECT SUM(total_price) FROM stock_out_detail WHERE ind_no = '$id'";
                                $result = $connect->query($sql);
                                for($i=0; $r = $result->fetch_assoc();$i++)
                                {
                                    $sub_total = $r['SUM(total_price)'];
                                   
                                }
                                ?>
                                        <td>
                                            <label>សរុប/Total:</label>
                                            <input type="text" name="total" class="form-control" value="<?php echo $sub_total;?>">
                                           
                                        </td>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Request From</button>
                        <!-- Start Modal Section for Add New Customer Type -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Add Request From</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-lg-12">
                                                
                                                <u><h3 style="text-align: center;font-style: oblique;font-weight: bold;">Request From</h3></u>
                                            </div>
                                           
                                            
                                           
                                            <div class="row">
                                                <div class="col-sm-6">
                                                   
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ថ្ងៃខែឆ្នាំស្នើសុំ/Request Date:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="request_date" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ថ្ងៃខែឆ្នាំតម្រូវការ/Need Date::</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="need_date" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ផ្នែក/Dept:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="dept" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ស្នើរសុំដោយ/Request By:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="request_by" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ពិនិត្យដោយ/Checked By:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="check_by" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                     <div class="form-group">
                                                        <label class="col-sm-5 control-label">លេខសម្គាល់/Ref-No:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="ref_no" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <div class="form-group">
                                                        <label class="col-sm-5 control-label">ស្នើរសុំថ្នី/New Request:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="new_request" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-sm-5 control-label">យកពីឃ្លាំង/From Where:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="new_request" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-sm-5 control-label">លេខកាត/ID Card:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="new_request" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="btn-save" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Modal Section -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php')?>