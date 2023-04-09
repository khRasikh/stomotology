<!DOCTYPE html>
<html>
<head>
	<title>Patient Discharge</title>
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
			table{
				width: 800px;
			}
			.chart{
				border: 1px black solid;
			}
			
			.td1{
				width: 170px;
				border-right: 1px black solid;
				border-bottom: 1px black solid;
			}
			.td2{
				width: 200px;
				border-right: 1px black solid;
				border-bottom: 1px black solid;
			}
			.imagelogo{
				    height: 125px;
			}
			.item{
				text-align: left;
			}
			.headerclass{
				border-bottom: 1px black solid; 
				border-right: 1px black solid;

			}
	</style>
		<script> window.onload= function (e) { window.print();} </script>
</head>
<body>

	<table>
		<tr>
			<td>
				<img class="imagelogo" src="<?php echo base_url() . 'uploads/hospital_content/logo/so1.png';?>">
			</td>
			<td style="text-align: center;">
				<h2>Shuhada Organization<br>
			 Working For A Better Tomorrow<br>
				 Shuhada Hospital-Jaghori<br>
				Discharge Slip</h2>
			</td>
			<br>
			<td>
				<img class="imagelogo" src="<?php echo base_url() . 'uploads/hospital_content/logo/so1.png';?>">
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>IPD No: <?php echo $patient['patient_unique_id']; ?></td>
			<td>Date: <?php echo date('Y-m-d'); ?></td>
		</tr>
	</table>

	<table class="chart">
		<tr>
			<td class="td1" style="border-bottom: 1px black solid;">Patient Full Name</td>
			<td colspan="2" style="border-bottom: 1px black solid;" ><?php echo $patient['patient_name']; ?></td>
			<td colspan="2" style="border-bottom: 1px black solid; border-left: 1px black solid;">Father Name: <?php echo $patient['guardian_name']; ?></td>
			<td colspan="2" style="border-bottom: 1px black solid; border-left: 1px black solid;">Age: <?php echo $patient['age']; ?> Year, <?php echo $patient['month']; ?> Month, <?php echo $patient['day']; ?> Day  </td>
		</tr>
		<tr>
			<td class="headerclass">Address: </td>
			<td class="headerclass"><?php echo $patient['province']; ?>, <?php echo $patient['district']; ?>, <?php echo $patient['address']; ?></td>
		</tr>
		<tr>
			<td class="td1">Admission Date</td>
			<td class="td2">
				<?php echo $patient['entry_date']; ?>
			</td>
			<td rowspan="6
			">
			</td>
		</tr>
		<tr>
			<td class="td1">Discharge Date</td>
			<td class="td2">
				<?php   show_discharged_date($patient['id'],$patient_round); ?>
			</td>
		</tr>
		<tr>
			<td class="td1">Diagnosis</td>
			<td class="td2">
				<?php echo $opd_details['diagnoses']; ?>
			</td>
		</tr>
		<tr>
			<td class="td1">Reference</td>
			<td class="td2">
				<?php echo $patient_ward['reference']; ?>
			</td>
		</tr>
	</table>
<br>
	<h4 class="fontheader">Enterance Payment:</h4>
	<table style="border: 1px black solid;">
				<th class="item">Item</th>
				<th class="item">Charges (AFN)</th>
				<th class="item">Enterance Date</th>
				<tr>
					<td>Entrance Charge</td>
					<td><?php echo $patient_ward['entrance_fee'];?> </td>
					<td><?php echo $patient_ward['date'];?></td>
				</tr>
	</table>
	<table class="table table-striped table-bordered table-hover example" style="border: 1px solid;">
            <thead>
               </thead>
            <tbody>
            	<h4 class="fontheader">Operation Charges:</h4>
            	<th style="text-align: left;">Items(Type: Name)</th>
    			<th style="text-align: left;"> Discount(AFN)</th>
    			<th style="text-align: left;"> Charges(AFN)</th>
    			<th style="text-align: left;"> Date</th>
                <?php
                if (!empty($operation)) {
                    foreach ($operation as $consultant_key => $value) {
                    	$sum += $value['apply_charge'];
                        ?>  
                        <tr>
                            <td> <?php echo $value["operation_type"]; ?>:  <?php echo $value["operation_name"];?></td>
                            <td><?php echo $value["discount"]; ?></td>
                            <td><?php echo $value["apply_charge"]; ?></td>
                            <td><?php echo $value["date"]; ?></td>
                        </tr>
			        <?php }
    				}
    			?> 
            </tbody>
        </table>
        <table class="table table-striped table-bordered table-hover example" style="border: 1px solid;">
            <thead>
               </thead>
            <tbody>
            	<h4>Nursing Charges:</h4>
            	<th style="text-align: left;">Items(Bed Duration)</th>
    			<th style="text-align: left;">Discount(AFN)</th>
    			<th style="text-align: left;">Charges(AFN)</th>
    			<th style="text-align: left;">Date</th>
                <?php
                if (!empty($nursing_last)) {
                    foreach ($nursing_last as $consultant_key => $value) {
                    	$sum += $value['total_fees']; 
                        ?>  
                        <tr>
                            <td>Bed Duration: <?php echo $value["bed_time"]; ?>Nights</td>
                            <td> <?php echo $value["discount"]; ?></td>
                            <td> <?php echo $value["total_fees"]; ?></td>
                            <td> <?php echo $value["date"]; ?></td>
                        </tr>
			        <?php }
    				}
    			?> 
				<tr style="margin-top: 12px;">
					<td>Payable Amount:</td>
					<td></td>
					<td><br><?php echo $sum+$patient_ward['entrance_fee'];?> AFN </td>
				</tr>
					
            </tbody>
					<td><b>Total</b> </td>
					<td></td>
					<td><br><b><?php echo $sum+$patient_ward['entrance_fee'];;?> AFN </b></td>
					<td></td>
					<tr>
					<td>Payment Status: </td>
					<td></td>
					<td><label style="background-color: green; border-radius: 5px; color: white; padding: 3px;">Paid</label></td>
				</tr>
        </table>
		<br>
		<br>
	<p><b>Signature:</b>____________________________________ &nbsp; &nbsp; <b>Date: <?php echo date('Y-m-d'); ?></b></p> 
</body>
</html>