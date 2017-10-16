<?php
session_start();
require_once('config/db_connect.php');
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
$conn = "SELECT * FROM stock_out_form";
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
    
    $sql = "SELECT SUM(total_price) FROM stock_out_detail WHERE sto_out_id = '$id'";
    $result = $connect->query($sql);
    for($i=0; $r = $result->fetch_assoc();$i++)
            {
              $sum_total = $r['SUM(total_price)'];
              
            }
    
    $request_date = $_POST['request_date'];
    $need_date = $_POST['need_date'];
    $dept = $_POST['dept'];
    $request_by = $_POST['request_by'];
    $check_by = $_POST['check_by'];
    $ref_no = $_POST['ref_no'];
    $new_request = $_POST['new_request'];
    $from_where = $_POST['from_where'];
    $id_card = $_POST['id_card'];
    
    $conn = "INSERT INTO stock_out_form(request_date,need_date,dept,request_by,check_by,ref_no,new_request,from_where,id_card,sum_total)
                    VALUES('$request_date','$need_date','$dept','$request_by','$check_by','$ref_no','$new_request','$from_where','$id_card','$sum_total')";
    //echo $conn;
    $result = mysqli_query($connect, $conn);
    $rid = mysqli_insert_id($connect);
    for($i=0;$i<count($_SESSION['outs']);$i++)
    {
        $n = $_SESSION['outs'][$i];
        $str = "update stock_out_detail set sto_out_id={$rid} where ind_no={$n}";
        mysqli_query($connect, $str);
    }
    unset($_SESSION["outs"]);
    header('location:stock_out_list.php');
}
date_default_timezone_set('Asia/Phnom_Penh');
$day = Date('d/M/Y');
if(isset($_POST['btn-add']))
{
    $item_no = $_POST['item_no'];
    $qty = $_POST['qty'];
    $unit_price = $_POST['unit_price'];
    $unit = $_POST['unit'];
    $item = $_POST['item'];
    $account_change=$_POST['account_change'];
    $description=$_POST['description'];
    $total_price=$_POST['total_price'];
    $in_id=$_POST['in_id'];

    $sql = "SELECT * FROM stock_out_detail WHERE sto_out_id = $id";
    $result2 = $connect->query($sql);
    $row3 = $result2->fetch_assoc();
    $ser = $row3['item_no'];
    $no = $row3['sto_out_id'];


    if($ser == $item_no && $no == $no) {
        $sql = "UPDATE stock_out_detail SET unit_price = unit_price+'$unit_price', qty=qty+'$qty', total_price=total_price+'$total_price' WHERE item_no='$item_no' AND sto_out_id = '$no'";
        $result = mysqli_query($connect, $sql);
        header("location:stock_out_form.php?ind_no=$no");
    }else
    {
         $conn1 = "INSERT INTO stock_out_detail(item_no,qty,unit_price,item,unit,account_change,description,total_price,sto_out_id,in_id, status)
                          VALUES('$item_no','$qty','$unit_price','$item','$unit','$account_change','$description','$total_price','$id','$in_id',0)";

       // echo $conn1;
        $result1 = mysqli_query($connect, $conn1);
        $rowid = mysqli_insert_id($connect);
        $_SESSION['outs'][] = $rowid;
        header("location:stock_out_form.php?ind_no=$id");
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
                    <form method="post" class="form-horizontal" action="stock_out_form.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">លេខកូដទំនិញ/Item 
                                code(<a href="stockin.php" class="btn btn-link"> Add New </a>):</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select name="item_no" id="proMy" class="form-control">
                                        <option value="">Please Select Product Code</option>
                                        <?php
                                        $con = "SELECT * FROM stockin";
                                        $result1 = $connect->query($con);
                                        while($row2 = mysqli_fetch_assoc($result1)):
                                            echo "<option value='" . $row2['in_id'] . "'>" . $row2['code_in'] . "</option>";
                                            ?>
                                        <?php endwhile; ?>
                                    </select>

                                    </div>
                                    <br>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ចំនួន/Qty:</label>
                                    <div class="input-group col-sm-3">
                                        <span class="input-group-addon"></span>

                                        <input type="text" id="idQty" onchange="calPrice()" onkeypress="return isNumberKey(event); this.onchange()" oninput="this.onchange()" onpaste="this.onchange()" class="form-control" name="qty">

                                    </div>
                                </div>
                                <div id="test1My">
                                    <label class="col-sm-2 control-label">តម្លៃរាយ/Unit Price:</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span>
                                            <input name="unit_price" value="" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">មុខទំនិញ/Item(En):</label>
                                        <div class="input-group col-sm-3">
                                            <span class="input-group-addon"></span>
                                            <input name="unit" value="" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label">ចុះក្នុងគណនីលេខ/Account to be Charged:</label>
                                <div class="col-md-3 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select name="account_change"   class="form-control">
                                        <option value="">Please Select Product Code</option>
                                        <?php
                                        $con = "SELECT * FROM branch";
                                        $result1 = $connect->query($con);
                                        while($row2 = mysqli_fetch_assoc($result1)):
                                            echo "<option value='" . $row2['branch_id'] . "'>" . $row2['branch_name'] . "</option>";
                                            ?>
                                        <?php endwhile; ?>
                                    </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">តម្លៃសរុប/Total Price:</label>
                                    <div class="input-group col-sm-3">
                                        <span class="input-group-addon"></span>
                                        <input name="total_price" value="" class="form-control" type="text" id="result">
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
                                    <th>No</th>
                                    <th>លេខកូដទំនិញ<br>Item code
                                        </th>
                                    <th>មុខទំនិញ/Item(En)</th>
                                    <th>ចំនួន <br>Qty</th>
                                    <th>ខ្នាត/Unit</th>
                                    <th>បរិយាយសេវាកម្ម<br>Description</th>
                                    <th>ចុះក្នុងគណនីលេខ<br>Account to be charged</th>
                                    <th>តម្លៃរាយ <br>Unit Price</th>
                                    <th>តម្លៃសរុប <br>Total Price</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="details">
                                <?php
                            $i = 1;
                            $sql2 = "SELECT * FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id INNER JOIN branch C ON A.account_change=C.branch_id WHERE A.sto_out_id = '$id'";
                            $result2 = $connect->query($sql2);
                            while($row2 = $result2->fetch_assoc()):
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $i++;?>
                                        </td>
                                        <td>
                                            <?php echo $row2['code_in'];?>
                                        </td>
                                        <td>
                                            <?php echo $row2["item"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row2['qty'];?>
                                        </td>
                                        <td>
                                            <?php echo $row2['unit'];?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo $row2['description'];?>
                                        </td>
                                        
                                        <td style="text-align: center;">
                                            <?php echo $row2['branch_name'];?>
                                        </td>
                                        <td style="text-align: center;">$
                                            <?php echo $row2['unit_price'];?>
                                        </td>
                                         <td style="text-align: center;">$
                                            <?php echo $row2['total_price'];?>
                                        </td>
                                        <td><a onclick="return confirm('Are you sure to delete ?');" href="stock_out_form_delete.php?ind_no=<?php echo $row2['ind_no']; ?>&in_no=<?php echo $id;?>" class="btn btn-danger">Remove</a></td>
                                    </tr>
                                    <?php endwhile;?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                     <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                $sql = "SELECT SUM(total_price) FROM stock_out_detail WHERE sto_out_id = '$id'";
                                $result = $connect->query($sql);
                                for($i=0; $r = $result->fetch_assoc();$i++)
                                {
                                    $sub_total = $r['SUM(total_price)'];
                                   
                                }
                                ?>
                                        <td>
                                            <label>សរុបទាំងអស់/Sum Total:</label>
                                            <input type="text" name="total" class="form-control" value="$<?php echo $sub_total;?>">

                                        </td>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Request Form</button>
                        <!-- Start Modal Section for Add New Customer Type -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Add Request Form</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-lg-12">

                                                <u><h3 style="text-align: center;font-style: oblique;font-weight: bold;">Request Form</h3></u>
                                            </div>



                                          <div class="row">
                                        <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ថ្ងៃខែឆ្នាំស្នើសុំ/Request Date:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="request_date" class="form-control" type="text" id="datepicker" readonly placeholder="Choose date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ថ្ងៃខែឆ្នាំតម្រូវការ/Need Date::</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="need_date" class="form-control" type="text" id="datepicker1" readonly placeholder="Choose date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ផ្នែក/Dept:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <select name="dept" class="form-control">
                                        <option value="">Please Select </option>
                                        <?php
                                        $con = "SELECT * FROM branch";
                                        $result1 = $connect->query($con);
                                        while($row2 = mysqli_fetch_assoc($result1)):
                                            echo "<option value='" . $row2['branch_id'] . "'>" . $row2['branch_name'] . "</option>";
                                            ?>
                                        <?php endwhile; ?>
                                    </select>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ស្នើរសុំដោយ/Request By:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
<!--                                         <select name="request_by" class="form-control">-->
<!--                                        <option value="">Please Select </option>-->
<!--                                        --><?php
//                                        $con = "SELECT * FROM employee";
//                                        $result1 = $connect->query($con);
//                                        while($row2 = mysqli_fetch_assoc($result1)):
//                                            echo "<option value='" . $row2['emp_id'] . "'>" . $row2['name_english'] . "</option>";
//                                            ?>
<!--                                        --><?php //endwhile; ?>
<!--                                    </select>-->
                                                                <input type="text" class="form-control" name="request_by">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">ពិនិត្យដោយ/Checked By:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
<!--                                                                <input type="text" class="form-control" name="check_by">-->
                                                                <select name="check_by" id="check_by"
                                                                        class="form-control">
                                                                    <option value="">Please Select </option>-->
                                                                        <?php
                                                                        $con = "SELECT * FROM employee";
                                                                        $result1 = $connect->query($con);
                                                                        while($row2 = mysqli_fetch_assoc($result1)):
                                                                            echo "<option value='" . $row2['emp_id'] . "'>" . $row2['name_english'] . "</option>";
                                                                            ?>
                                                                        <?php endwhile; ?>
                                                                </select>
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
                                                                <input name="from_where" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">លេខកាត/ID Card:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input name="id_card" class="form-control" type="text">
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