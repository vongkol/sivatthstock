<?php
    if ( $_FILES['file']['error'] > 0 ){
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
    	// $filename = preg_replace('"\.(bmp|gif)$"', '.jpg', $filename);
        if(move_uploaded_file($_FILES['file']['tmp_name'], 'img/sign/' . preg_replace('"\.(bmp|gif|jpg|jpeg|)$"', '.png', 'sign.png')))
        {
            echo "File Uploaded Successfully";
        }
    }

?>