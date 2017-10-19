<?php include'config/db_connect.php';
ob_start();
session_start();
if(empty($_SESSION['user_id'])) {
  header('location:index.php');
  exit();
}
  $sql = "SELECT * FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id"; 
  $result = $connect->query($sql);

?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock</li>
        <li class="active">Items stock in</li>
      </ol>
          <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <p>Monthly Stock In</p>
           
                        <!-- <a href="dashboard.php" class="btn btn-sm btn-danger btn-flat pull-right"><i class="fa fa-undo"></i> Back</a> -->
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-sm-12">
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
                                <label for="endDate">Item Name</label>
                                  <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Input item name" />
                              </div>
                              <button type="button" class="btn btn-primary" id="btnfind"><span class="glyphicon glyphicon-search"></span>  Find</button>
                            </form>
                            <br>
                          </div>
                        </div>  
                        <div class="table-responsive">
                            <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Qauntity</th>
                                        <th>Packet</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                        <th>Pay Amount</th>
                                        <th>Rest</th>
                                        <th>Expire Date</th>
                                        <th>Note</th>
                                        <th>Supplier</th>
                                        <th>Employee</th>                               
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
             $("#startDate").datepicker();
            // order date picker
            $("#endDate").datepicker();


            // Find proccess
            var oTable = $('#example').dataTable();

            $('#btnfind').click(function(){
              var getStartdate = $('#startDate').val();
              var getEnddate = $('#endDate').val();
              var getItem = $('#itemname').val();
              oTable.fnClearTable();
              $.ajax({
                url: 'getmonthly_stockin_report.php',
                data: {
                  'getStartdate': getStartdate,
                  'getEnddate' : getEnddate,
                  'getItem' : getItem
                },
                dataType: 'json',
                type: 'get',
                success: function(s){
                console.log(s);   
                        for(var i = 0; i < s.length; i++) {
                                    
                                   oTable.fnAddData([
                                              s[i][0],
                                              s[i][1],
                                              s[i][2],
                                              s[i][3],
                                              s[i][4],
                                              s[i][5],
                                              s[i][6],
                                              s[i][7],
                                              s[i][8],
                                              s[i][9],
                                              s[i][10],
                                              s[i][11],
                                              s[i][12],
                                              s[i][13]]);               
                                    oTable.addClass('new');                                    
                              } // End For
                }
              });
            });
          })
        </script>
          
        <?php include 'footer.php';?>