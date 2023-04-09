<!DOCTYPE html>
<html>
<head>
	<title>پرنت بل</title>

	<style type="text/css">
		.center{
			text-align: center;
		}
		.right{
			border-right: 1px black solid;
		}
		.border{
			border: 1px black solid;
		}

	</style>
	<script> window.onload= function (e) { window.print();} </script>
</head>
<body> 
<center>
<table class="border-top"  class="printablea4" width="100%">
<img style="
    height: 58px;" src="<?php echo base_url(); ?>uploads/hospital_content/logo/so1.png">
	<h4 style="margin-top: 10px;margin-bottom: -30px;text-align: center;" >شفاخانه ستوماتولوژی<br> دندانسازی ایمل<br>دریافت پول<br></h4>

</table>
<table class="border"  class="printablea4" width="100%">
	<tr>
	<td class="right"><label>  آی دی: </label><?php echo $patient['patient_unique_id'] ;?></td>
	<td class="right"><label>نام مکمل: </label><?php echo $patient['patient_name'] ;?></td>
	<td class="right"><label>نام پدر:</label><?php echo $patient['guardian_name'] ;?></td>
	</tr>
	<tr>
		<td colspan="12" style="border-top: 1px black solid; padding: 5px 5px;">
			<br>
			<label style="padding-right: 46%">Register No:    </label> <?php echo $patient['patient_unique_id'];?>  <br><br>
			<label style="padding-right: 45%">Register Date:    </label> <?php echo $patient_opd['appointment_date'];?><br><br>
			<label style="padding-right: 46%">Register Fee:     </label> <?php echo $patient_opd['amount'];?><br><br>
		</td>
	</tr>

	<br><br>

</table>
<p><b>Signature: </b>____________________&nbsp; &nbsp; &nbsp; Date:  2019-9-28</p>
</center>
</div>
</body>
</html>