<!DOCTYPE html>
<html>
<head>
	<title>Print Bill</title>

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
</head>
<body> 
<center>
<table class="border-top"  class="printablea4" width="100%">
	<br><h4 style="margin-bottom: -30px; text-align: center; margin-left: -60px;" >Shuhada Organization<br> Shuhada Hospital Jaghori<br>Payment Slip<br></h4>
	<img style="margin-left: 80%;
    margin-top: -34px;
    height: 58px;
    margin-bottom: -18px;" src="http://localhost/rasikhhms/uploads/hospital_content/logo/0.JPG">
</table>
<table class="border"  class="printablea4" width="100%">
	<tr>
		<td class="right"><label>Full Name: </label><?php echo $operations_lists['patient_name'] ;?> &nbsp; <label>Father Name:</label><?php echo $operations_lists['guardian_name'] ;?></td>
		<td><label>ID: </label><?php echo $operations_lists['patient_unique_id'] ;?></td>
	</tr>
	<tr>
		<td colspan="12" style="border-top: 1px black solid; padding: 5px 5px;">
			<br>
			<label style="padding-right: 46%">Register No:    </label> <?php echo $operations_lists['patient_unique_id'];?>  <br><br>
			<label style="padding-right: 45%">Operation Type:     </label> <?php echo $operations_lists['operation_name'];?><br><br>
			<label style="padding-right: 46%">Operation Fee:     </label><?php echo $operations_lists['appointment_date'];?><br><br>
			<label style="padding-right: 46%">Discount:     </label><?php echo $operations_lists['appointment_date'];?><br><br>
			<label style="padding-right: 46%">Total:      </label><?php echo $operations_lists['appointment_date'];?><br><br>
		</td>
	</tr>

	<br><br>

</table>
<p><b>Signature: </b>____________________&nbsp; &nbsp; &nbsp; Date:  2019-9-28</p>

	<table class="border-top"  class="printablea4" width="100%">
	<br><h4 style="margin-bottom: -30px; text-align: center; margin-left: -60px;" >Shuhada Organization<br> Shuhada Hospital Jaghori<br>Register Payment Slip<br></h4>
	<img style="margin-left: 80%;
    margin-top: -34px;
    height: 58px;
    margin-bottom: -18px;" src="http://localhost/rasikhhms/uploads/hospital_content/logo/0.JPG">
</table>
<table class="border"  class="printablea4" width="100%">
	<tr>
		<td class="right"><label>Name: </label><?php echo $operations_lists['patient_name'] ;?> &nbsp; <label>Father Name:</label><?php echo $operations_lists['guardian_name'] ;?></td>
		<td><label>ID: </label><?php echo $operations_lists['patient_unique_id'] ;?></td>
	</tr>
	<tr>
		<td colspan="4" style="border-top: 1px black solid;padding: 1px 5px;">
			<br>
			<label style="padding-right: 46%">Register No:    </label> <?php echo $operations_lists['patient_unique_id'];?>  <br><br>
			<label style="padding-right: 45%">Operation Type:     </label> <?php echo $operations_lists['appointment_date'];?><br><br>
			<label style="padding-right: 46%">Operation Fee:     </label> <?php echo $operations_lists['appointment_date'];?><br><br>
			<label style="padding-right: 46%">Discount:     </label> <?php echo $operations_lists['appointment_date'];?><br><br>
			<label style="padding-right: 46%">Total:     </label> <?php echo $operations_lists['appointment_date'];?><br><br>
		</td>
	</tr>

	<br><br>

</table>
<p><b>Signature: </b>____________________&nbsp; &nbsp; &nbsp; Date:  2019-9-28</p>
</center>
</div>
</body>
</html>
