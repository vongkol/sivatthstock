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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#btnupload').on('click', function() {
            if(confirm("Are you sure to chagne the current sign?")){
                var file_data = $('#sign_image').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);

                $.ajax({
                        url         : 'process_upload_sign.php',     // point to server-side PHP script 
                        dataType    : 'text',           // what to expect back from the PHP script, if anything
                        cache       : false,
                        contentType : false,
                        processData : false,
                        data        : form_data,                         
                        type        : 'post',
                        success     : function(output){
                            alert(output);              // display response from the PHP 
                            location.reload();
                        }
                 });
                 $('#sign_image').val('');                     /* Clear the file container */
            }

        });
    })
</script>
<div class="col-sm-6"> 
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="text-primary">Current Using Sign</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <img src="img/sign/sign.png" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-sm-6"> 
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <span class="text-danger"> Change Sign</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-gourp">
                                <!-- <form> -->
                                    <input type="file" name="sign_image" id="sign_image" required><br> 
                                    <button class="btn btn-primary btn-sm" id="btnupload">Change sign</button>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<?php require_once('footer.php')?>
