<?php
include('config/db_connect.php');
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
$id = $_GET['in_no'];
$conn = "SELECT * FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id WHERE A.sto_out_id = '$id'";
$result = $connect->query($conn);
?>
<?php require_once('header.php');?>
<style rel="stylesheet">
    th{
        text-align: center;
    }
    .text
    {
        float: right;
    }
    .form-group
    {
        width:100%;
        margin-top: 5px;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <i class="fa fa-font-awesome fa-3x" id="font-icon"></i>
            <h1 class="page-header">Stock Out Detail</h1>
        </div>
    </div>
    <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="stock_out_list.php" class="btn btn-info">Back <i class="fa fa-undo"></i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <!--++++++++++++Table+++++++++++++-->
                        <div class="col-sm-12">
                            
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
                            $sql2 = "SELECT * FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id WHERE A.sto_out_id = '$id'";
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
                                            <?php echo $row2['qty'];?>
                                        </td>
                                        <td>
                                            <?php echo $row2['unit'];?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo $row2['description'];?>
                                        </td>
                                        
                                        <td style="text-align: center;">
                                            <?php echo $row2['account_change'];?>
                                        </td>
                                        <td style="text-align: center;">$
                                            <?php echo $row2['unit_price'];?>
                                        </td>
                                         <td style="text-align: center;">$
                                            <?php echo $row2['total_price'];?>
                                        </td>
                                        <td><a onclick="return confirm('Are you sure to delete ?');" href="stock_out_detail_delete.php?ind_no=<?php echo $row2['ind_no']; ?>&in_no=<?php echo $id;?>" class="btn btn-danger">Remove</a></td>
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
                                            <input type="text" name="total" class="form-control" value="<?php echo $sub_total;?>">

                                        </td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php require_once('footer.php')?>
