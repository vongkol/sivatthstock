<?php
include('config/db_connect.php');
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
// $id = $_GET['in_no'];
// $conn = "SELECT * FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id WHERE A.sto_out_id = '$id'";
// $result = $connect->query($conn);
?>
<?php require_once('header.php');?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <i class="fa fa-font-awesome fa-3x" id="font-icon"></i>
            <h1 class="page-header">Branch Stock Out</h1>
        </div>
    </div>
    <div class="container-fluid">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <div class="row">
                        <form class="form-inline">
                          <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
                          </div>
                          <div class="form-group">
                            <label for="endDate">End Date</label>
                              <input type="text" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
                          </div>
                          <div class="form-group">
                            <label for="endDate">Branch</label>
                              <select class="form-control" id="branch_id_filter" style="margin-left: 15px;">
                                <option value="">Please Select Branch</option>
                                <?php
                                $con = "SELECT * FROM branch";
                                $result1 = $connect->query($con);
                                while($row2 = mysqli_fetch_assoc($result1)):
                                    echo "<option value='" . $row2['branch_id'] . "'>" . $row2['branch_name'] . "</option>";
                                    ?>
                                <?php endwhile; ?>
                            </select>
                          </div>
                          <button type="button" class="btn btn-primary" id="btnfind"><span class="glyphicon glyphicon-search"></span> Show</button>
                        </form>
                        <div class="col-sm-4">
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <!--++++++++++++Table+++++++++++++-->
                        <div class="col-sm-12">
                        <table class="table table-bordered " id="branch_stockout">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Branch Name</th>
                                    <th>លេខកូដទំនិញ<br>Item code
                                        </th>
                                    <th>ចំនួន <br>Qty</th>
                                    <th>ខ្នាត/Unit</th>
                                    <th>បរិយាយសេវាកម្ម<br>Description</th>
                                    <th>ចុះក្នុងគណនីលេខ<br>Account to be charged</th>
                                    <th>តម្លៃរាយ <br>Unit Price</th>
                                    <th>តម្លៃសរុប <br>Total Price</th>
                                </tr>
                            </thead> 
                            <tbody>
                        
                            </tbody>
   <!--                          <tfoot>
                                
                            </tfoot> -->
                        </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
 <script type="text/javascript">
          $(document).ready(function(){
             $("#startDate").datepicker();
            // order date picker
            $("#endDate").datepicker();
            // alert(" Test");

            // Find proccess
            var oTable = $('#branch_stockout').dataTable({
                "orderable": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            // var mytable = $("#branch_stockout").dataTable();

            $('#btnfind').click(function(){
              var getStartdate = $('#startDate').val();
              var getEnddate = $('#endDate').val();
              var getBranch_id = $('#branch_id_filter').val();
              var test = 0;
              oTable.fnClearTable();
              $.ajax({
                url: 'getbranch_stockout.php',
                data: {
                    'getStartdate': getStartdate,
                    'getEnddate' : getEnddate,
                    'branchId': getBranch_id
                },
                dataType: 'json',
                type: 'get',
                success: function(s){
                  // alert(s);
                console.log(s);   
                        for(var i = 0; i < s.length; i++) {
                                test += parseFloat(s[i][7]);
                                   oTable.fnAddData([
                                         i+1,  
                                        s[i][0],
                                        s[i][1],
                                        s[i][2],
                                        s[i][3],
                                        s[i][4],
                                        s[i][5],
                                        s[i][6],
                                        s[i][7]]);               
                                    oTable.addClass('new');                                    
                              } // End For
                             oTable.fnAddData(["x","x", "x","x","x","x","x","Total",test]);
                             $( "tr:last" ).css({ backgroundColor: "yellow", fontWeight: "bolder" });

                              // $("#total").val(test);
                              // $('#branch_stockout tr:last').after('<tr><td></td><td></td><td></td><td></td><td></td><td></td> <td align="right">សរុប:</td><td id="total">'+test+'</td></tr>');
                              // $("#total").val(test);
                              // var newRow = "<tr><td>row 3, cell 1</td><td>row 3, cell 2</td></tr>";
                              //   // var table = $('.new').DataTable();
                              //   oTable.row.add($(newRow )).draw();
                           
                }
              });

            });
          })
        </script>


<?php require_once('footer.php')?>
