<?php
include_once('config/db_connect.php');
$output ='';
$sql = "SELECT * FROM stockin A INNER JOIN product B ON A.pro_id=B.pro_id where A.in_id = '".$_POST["accNo"]."'";
$result = $connect->query($sql);
$row = mysqli_fetch_array($result);
?>
   
    <input type="hidden" name="in_id" value="<?php echo $row['in_id'] ?>">
    <label class="col-sm-2 control-label">តម្លៃរាយ/Unit Price:</label>
    <div class="col-md-3 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"></span>
            <input name="unit_price" value="<?php echo $row['price'] ?>" class="form-control" type="text" readonly id="idUnit">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">មុខទំនិញ/Item(En):</label>
        <div class="input-group col-sm-3">
            <span class="input-group-addon"></span>
            <input name="item" value="<?php echo $row['name_en'] ?>" class="form-control" type="text" readonly>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">ខ្នាត/Unit:</label>
        <div class="input-group col-sm-3">
            <span class="input-group-addon"></span>
            <input name="unit" value="<?php echo $row['paket']; ?>" class="form-control" type="text" id="unit" readonly>
        </div>
    </div>