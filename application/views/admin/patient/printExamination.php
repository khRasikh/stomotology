<!DOCTYPE html>
<html>
<head>
	<title>Print Examination</title>
</head>
<body>
	<div class="row">
		<div class="col-md-12" align="center">
			<img src="<?php echo base_url() . 'uploads/hospital_content/logo/login_logo1.JPG';?>">
		</div>
		<div class="col-md-12">
			<h2>Ministry of Public Health</h2>
			<h2>Shohada Hospital</h2>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<table>
						<tr>
							<td>S.No: </td>
							<td><?php echo $patient_unique_id; ?></td>
						</tr>
						<tr>
							<td>Ultra Sound: </td>
							<td><?php echo $examination['ultra_sound']; ?></td>
						</tr>
						<tr>
							<td>Dressing: </td>
							<td><?php echo $examination['dressing']; ?></td>
						</tr>
						<tr>
							<td>ECG: </td>
							<td><?php echo $examination['ecg']; ?></td>
						</tr>
						<tr>
							<td>Lab: </td>
							<td><?php echo $examination['lab']; ?></td>
						</tr>
						<tr>
							<td>X-Ray: </td>
							<td><?php echo $examination['x_ray']; ?></td>
						</tr>
						<tr>
							<td>Date: </td>
							<td><?php echo $examination['date']; ?></td>
						</tr>
						<tr>
							<td>Examination Type: </td>
							<td><?php echo $examination['examination_type']; ?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-6">
					<table>
						<tr>
							<td>Payment Fee: </td>
							<td><?php echo $examination['price']; ?></td>
						</tr>
						<tr>
							<td>Unit: </td>
							<td><?php echo $examination['description']; ?></td>
						</tr>
						<tr>
							<td>Total Payment: </td>
							<td><?php echo $examination['person']; ?></td>
						</tr>
						<tr>
							<td>Received Payment: </td>
							<td><?php echo $examination['price']; ?></td>
						</tr>
						<tr>
							<td>Submitted to: </td>
							<td><?php echo $examination['reciever']; ?> نقدا</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<hr>
		<div class="col-md-12">
			<h5>Address:          Jaghori, Shohada Hospital</h5>
			<h5>Email Address:          info@shuhadad.af</h5>
			<h5><b>Phone Numbers:</b>          0700077100 & 0766412424</h5>
		</div>
	</div>
</body>
</html>