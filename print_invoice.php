<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
	table thead tr td{
		/*color: #037; font-weight: bold;*/
	}
	table{
		/*border: 1px #abcdfc; font-size: 9px;*/
	}

	body {
	  /*background: rgb(204,204,204); */
	}
	page {
	  background: white;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	  
	}
/*	.header{
		line-height: 1em;
	}*/
	page[size="A4"] {  
	  width: 21cm;
	  height: 105cm; 
	}
	@media print {
	  body, page {
	    margin: 0 -20px 0 5px;
	    box-shadow: 0;
	  }
	  table thead tr td{
		/*color: #037; font-weight: bold;*/
		}
		table{
			/*border: 1px #abcdfc; font-size: 8px;*/
		}

		body {
		  /*background: rgb(204,204,204); */
		}
	  footer{
	  	display: none !important;
	  }
	  .print{display: none !important;}
/*	  .whistory{
	  	margin-top: 50px !important;
	  }*/
	}
	span{
		/*border-bottom: 0.5px dotted #ccc;*/
	}

	/*table.ui-jqgrid-btable tbody tr td,table.ui-jqgrid-btable thead tr th,table.ui-jqgrid-htable tbody tr td,table.ui-jqgrid-htable thead tr th{
		border: 1px solid !important;
		border-collapse: collapse;
	}*/
</style>
    <script type="text/javascript">
        $(document).ready(function(e) {
           // $('a#print_btn').on('click', function(e)  {
              //  $('#printout').printThis({title: 'jQuery printThis Basic Demo'});
              window.print();
              window.history.back();
           // });
        });
    </script>
    <script type="text/javascript">
	    jQuery(document).ready(function($) {
	        $("a.word-export").click(function(event) {
	            $("#printout").wordExport();
	        });
	    });
    </script>

    <!-- php script -->
    <?php include'config/db_connect.php';
 $conn = "SELECT * FROM stock_out_form A INNER JOIN branch B ON A.dept=B.branch_id INNER JOIN employee C ON A.check_by=C.emp_id WHERE A.approve=0 ";
  $result = $connect->query($conn);
   $v1='';$v2='';$v3='';$v4='';$v5='';$v6='';$v7='';$v8='';$v13='';    
	while($row = $result->fetch_assoc()) 
    {         
      $v1=$row["request_date"];
      $v2=$row["need_date"];
      $v3=$row["branch_name"];
      $v4=$row["name_english"];
      $v5=$row["check_by"];
      $v13=$row["ref_no"];
      $v6=$row["new_request"];
      $v7=$row["from_where"];
      $v8=$row["id_card"];
    }	

    $id = $_GET['in_no'];
// $conn = "SELECT * FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id WHERE A.sto_out_id = '$id'";
// $result = $connect->query($conn);	     
 ?>




    <!-- <a class="word-export" href="javascript:void(0)"> Export as .doc </a>  -->
	<!-- <a href="" id="print_btn" class="btn btn-success btn-sm print">បោះពុម្ពប្រត្តិរូប</a> -->
<page id="printout" size="A4" style="">
	<div style="">
		<table  width="100%"  style="">
			<tr>
				<td colspan="4"><img src="img/print_header.png" width="100%" class="img-responsive"></td>
			</tr>
			<tr>
				<td>ថ្ងៃខែឆ្នាំស្នើសុំ/Request Date:</td>
				<td><?php  echo $v1; ?></td>
				<td>លេខសម្គាល់/Ref No:</td>
				<td><?php echo $v13;?></td>
			</tr>
			<tr>
				<td>ថ្ងៃខែឆ្នាំតម្រូវការ/Need Date:</td>
				<td><?php  echo $v2; ?></td> 
				<td>ស្នើសុំថ្មី/Request New:</td>
				<td><?php  echo $v6; ?></td>
			</tr>
			<tr>
				<td>ផ្នែក/Dept:</td>
				<td><?php echo $v3;?></td>
				<td>យកពីឃ្លាំង/From WH:</td>
				<td><?php  echo $v7; ?></td>
			</tr>
			<tr>
				<td>ស្នើសុំដោយ/Request By:</td>
				<td><?php echo $v4;?></td>
				<td>លេខកាត/ID No:</td>
				<td><?php  echo $v8; ?></td>
			</tr>
			<tr>
				<td>ពិនិត្យដោយ/Checked By:</td>
				<td><?php echo $v5;?></td>
				<td>ប្រធានផ្នែក​/Dept Head:</td>
				<td>..............................</td>
			</tr>

		</table>
		<br>
		<table width="100%" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>លេខកូដទំនិញ<br>Item code
                                        </th>
                                    <th>លេខសម្គាល់<br>Ref-NO</th>
                                    <th>ចំនួន <br>Qty</th>
                                    <th>ខ្នាត<br>Unit</th>
                                    <th>បរិយាយសេវាកម្ម<br>Description</th>
                                    <th>ចុះក្នុងគណនីលេខ<br>Account to be charged</th>
                                    <th>តម្លៃរាយ <br>Unit Price</th>
                                    <th>តម្លៃសរុប <br>Total Price</th>
                                </tr>
                            </thead>
                            <tbody class="details">
                                <?php
                            $i = 1;
                            $sql2 = "SELECT * FROM stock_out_detail A INNER JOIN stockin B ON A.item_no = B.in_id WHERE A.sto_out_id = '$id' AND status=0 ";
                            $out_id = $_GET['in_no'];
                            $str = "select ref_no from stock_out_form where sto_out_id={$out_id}";
                            $re =mysqli_query($connect, $str);
                            $ref_no ="";
                            while ($r = mysqli_fetch_array($re))
                            {
                                $ref_no = $r['ref_no'];
                            }

//                            echo $sql2;
//                            die();
                            $result2 = $connect->query($sql2);
                            while($row2 = $result2->fetch_assoc()):
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $i++;?>
                                        </td>

                                        <td>
                                            <?php echo $row2['code_in'];?>
                                        </td>
                                        <td><?php echo $ref_no; ?></td>
                                        <td>
                                            <?php echo $row2['qty'];?>
                                        </td>
                                        <td>
                                            <?php echo $row2['unit'];?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php echo $row2['description'];?>
                                        </td>
                                        
                                        <td style="text-align: center;">
                                            <?php echo $row2['account_change'];?>
                                        </td>
                                        <td style="text-align: center;">$
                                            <?php echo $row2['unit_price'];?>
                                        </td>
                                         <td style="text-align: center;">$
                                            <?php echo $row2['total_price'];?>
                                        </td>
                                    </tr>
                                    <?php endwhile;?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" align="right"> សរុបទាំងអស់/Sum Total:</td>
                                    <?php
                                $sql = "SELECT SUM(total_price) FROM stock_out_detail WHERE sto_out_id = '$id' AND status=0 ";
                                $result = $connect->query($sql);
                                for($i=0; $r = $result->fetch_assoc();$i++)
                                {
                                    $sub_total = $r['SUM(total_price)'];
                                   
                                }
                                ?>
	                                <td>
	                                    <input type="text" name="total" class="form-control" value="<?php echo $sub_total;?>">

	                                </td>
                                </tr>
                            </tfoot>
                        </table>
		<br>
		<div class="col-xs-6">
			<table width="100%">
				<tr>
					<td width="60%">ត្រូវទិញពីអ្នកផ្គត់ផ្គង់ឈ្មោះ/ To be Purchased from:</td>
					<td>.............................</td>
				</tr>
				<tr>
					<td>ត្រូវបញ្ចូនទំនិញទៅ​/ To be Delivered to:</td>
					<td>.............................</td>
				</tr>
				<tr>
					<td>ផ្នែកទិញ/ Purchased By:</td>
					<td>.............................</td>
				</tr>
				<tr>
					<td>ទទួលដោយ/ Received By:</td>
					<td>.............................</td>
					<!-- <td>បញ្ចេញដោយ/ Issued By: </td>
					<td></td> -->
				</tr>
			</table>
		</div>
		<div class="col-xs-6">
			<table width="100%">
				<tr>
					<td colspan="2" align="center">អនុម័តដោយ/Approved By:</td>
				</tr>
				<tr>
					<td colspan="2" height="50px" align="center">
						<img src="img/sign/sign.png" class="img-responsive">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">Finance Department <br><br></td>
				</tr>
				<tr>
					<td>បញ្ចេញដោយ/ Issued By: </td>
					<td>.................................</td>
				</tr>
			</table>
		</div>
	</div>
</page>

<!-- <p class="btn btn-info" id='btn' onclick='printDiv();'>Print</p>
<p class="btn btn-success" id="saving_leave">ស្នើសុំ</p> -->

<!-- javascript alert while successful -->

