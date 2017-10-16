<?php
    include'config/db_connect.php';
	$output = '';
	$sql = "SELECT * FROM product where code = '".$_POST["accNo"]."'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);	
        $output .= "<div class = 'form-group col-xs-6'>";
        $output .= "<label for = ''>Product:</label>";
        $output .= "<select class = 'form-control' name = 'product'>";
        $output .= '<option value="'.$row["pro_id"].'">'.$row["name_en"]." ".$row["name_kh"].'</option>';
        $output .= "</select>";
        $output .= "</div>";	
      
        $output .= "<div class = 'form-group col-xs-6'>";
        $output .= "<label for = ''>Price:</label>";
        $output .= "<input type = 'text' class = 'form-control price' autocompleted='off' name = 'price' value = ".$row["price_riel"].">";
        $output .= "</div>";
	
		echo $output;
?>