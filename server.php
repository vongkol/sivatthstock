<?php
    include'config/db_connect.php';
	$output = '';
	$sql = "SELECT * FROM stockin A INNER JOIN product B ON A.pro_id = B.pro_id where code_in = '".$_POST["accNo"]."'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);	
        $output .= "<div class = 'form-group col-xs-6'>";
        $output .= "<label for = ''>Product(EN):</label>";
        $output .= "<input type = 'text' class = 'form-control' readonly name = 'en' value = ".$row["name_en"].">";
        $output .= "</div>";
        $output .= "<div class = 'form-group col-xs-6'>";
        $output .= "<label for = ''>Product(KH):</label>";
        $output .= "<input type = 'text' class = 'form-control' readonly name = 'kh' value = ".$row["name_kh"].">";
        $output .= "</div>";
        $output .= "<div class = 'form-group col-xs-6'>";
        $output .= "<label for = ''>Price:</label>";
        $output .= "<input type = 'text' class = 'form-control price' readonly name = 'price' value = ".$row["price_riel"].">";
        $output .= "</div>";
            $cate = $row['cate_id'];
            $gory = "SELECT * From category where cate_id = '".$cate."'";
            $regory = mysqli_query($connect, $gory);
        $row1 = mysqli_fetch_array($regory);
        $output .= "<div class = 'form-group col-xs-6'>";
        $output .= "<label for = ''>Category:</label>";
        $output .= "<select class = 'form-control' name = 'category'>";
        $output .= '<option value="'.$row1["cate_id"].'">'.$row1["category_name"].'</option>';
        $output .= "</select>";
        $output .= "</div>";	
		echo $output;
?>