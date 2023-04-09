<?php $url = $this->uri->segment(6); ?>
<html>

	<head>
		<title>Print Reciept</title>
		<style type="text/css">
			.border-right{
				border-right: 1px black solid;
			}
			.twenty{
				width: 25%;
			}
			.rx{
				width: 100%;
				vertical-align: top;
				height: 500px;
			}
			.rx1{
				height: 500px;
				vertical-align: top;
				text-align: center;
			}
			table{
				width: 800px;
			}
		</style>
		<script> window.onload= function (e) { window.print();} </script>
	</head>
	<body>
			<table>
				<tr>
					<td style="text-align:left">
						<h2>Shuhada Organization<br>
						Working For A Better Tomorrow<br>
						Shuhada Hospital - Jaghori</h2>
					</td>
					<td>
						<img style="width:100px;text-align:right;margin-right:-100px;" src="<?php echo base_url() . 'uploads/hospital_content/logo/so1.png';?>">
					</td>
				</tr>
				<tr>
					<td colspan="3" style="text-align: center;"><h3>Laboratory Test Result</h3></td>
				</tr>
				<tr>
					<td>
						Date &nbsp;&nbsp; <?php echo date('m'); ?> / <?php echo date('d'); ?> / <?php echo date('Y'); ?> 
					</td>
					<td></td>
					<td>
						OPD No: <?php echo $result[0]['unique_id']; ?>
					</td>
				</tr>
			</table>
			<table style="border:1px black solid;">
				<tr >
					<td class="border-right twenty">
						Name: <?php echo $result[0]['patient_name']; ?>
					</td>
					<td class="border-right twenty">
						
						F/Name: <?php
						// print_r($result);
						echo $result[0]['patient_fname']; ?>
					</td>
					<td class="border-right twenty">
						Age: <?php echo $result[0]['age'];  ?>
					</td>
					<td class="twenty">
						Address: <?php echo $result[0]['address']; ?>
					</td>
				</tr>
			</table>
			<table style="border: 1px black solid;">
			   <tr>
					<td><br>&nbsp;&nbsp;&nbsp;<b><u>Test Name</td>
					<td><br><b><u>Result</td>
					<!-- <td><br><b><u>Test Fees</td> -->
					<?php if($url == 'lab_lab') { ?>
					<td> <br><b><u>Normal Range</td>
					<?php } ?>
				</tr>
				 
				<?php  foreach ($result as $std) {
					$sum += $std['fees']; 
					 ?>
				  <tr>
				  	  <td><br>&nbsp;&nbsp;&nbsp;<?php  echo $std['operation_type']; ?>: <?php  echo $std['test_name']; ?></td>
					  <td><br><?php  echo $std['result']; ?> <?php if(!empty($std['description'])){ echo $std['description']; } ?></td>
					  <!-- <td><br><?php  echo $std['fees']; ?></td> -->
					  <?php if($url == 'lab_lab') { ?>
						   <td><br><?php echo $std['duplicate']; ?></td>
					 <?php } ?>
					 
				  </tr>
				  
				 <?php } ?>
				 <tr style="backgrond:#ddd !important;padding:10px;">
				    <td><br>&nbsp;&nbsp;&nbsp;<b>Additional Description : </b><br><br></td>
				    <td colspan="3"><br><?php  echo $result[0]['add_description']; ?><b></b><br><br></td>
					<?php if($url == 'lab_lab') { ?>  <td></td> <?php } ?>
				  </tr>
		
			</table>

			<table>
			   <tr>
				    <td><br>&nbsp;&nbsp;&nbsp;<b>Lab Technician : ______________________ </b><br><br></td>
				    <!-- <td><br>&nbsp;&nbsp;&nbsp;<b></b></td> -->
					<!-- <td><br><?php echo $sum;?> AFN </td> -->
					<td>Dr : __________________ </td>
					<?php if($url == 'lab_lab') { ?>  <td></td> <?php } ?>
				  </tr>
			</table>
			
		

			
	</body>
</html>