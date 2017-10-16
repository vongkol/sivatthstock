<?php
include_once('config/db_connect.php');

            $No = $_GET['ind_no'];
            $id = $_GET['in_no'];
            $conn = "DELETE FROM tb_invoice_detail WHERE ind_no = '$No'";
            $result = mysqli_query($connect, $conn);
            header("location:.php?in_no=$id");

?>