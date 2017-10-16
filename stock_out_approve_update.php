


<?php
include_once('config/db_connect.php');

            $No = $_GET['id'];
             $conn = "UPDATE stock_out_form SET approve='1' WHERE sto_out_id=$No";
            $result = mysqli_query($connect, $conn);
            header("location:stock_out_approve.php");

?>