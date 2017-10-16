<?php
include_once('config/db_connect.php');

            $No = $_GET['id'];
            
            $conn = "DELETE FROM stock_out_form WHERE sto_out_id = '$No'";
            $result = mysqli_query($connect, $conn);
            header("location:stock_out_list.php");

?>