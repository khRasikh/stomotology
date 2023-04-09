<?php
$this->load->helper('functions_helper');
?>
<html>
	<head>
		<title>پرنت بل</title>
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
			    padding-left: 20px;
			    padding-top: 20px;
			}
			table{
				width: 100%;
			}
		</style>
		<script> window.onload= function (e) { window.print();} </script>
	</head>
	<body>
			<table>
				<tr><br><br>
					<td colspan="2" style="text-align: center;">
					<h2>وزارت صحت عامه</h2>
					<h3>لابراتوار دندانسازی برادران شیرزاد</h3>
					</td>
				</tr>
			</table>
			<table style="border:1px black solid; direction: rtl; background-color: #dbd7d7;">
				<tr>
					<td>
						تاریخ &nbsp;&nbsp; :
						<?php echo $result['day'];?>-<?php echo $result['month'];?>-<?php echo $result['dob'];?>
					</td>
					<td></td>
					
					<td>
						شماره مسلسل: <?php echo $result['hmis_no']; ?>
					</td>
				</tr>
			</table>
			<table style="border:1px black solid; direction: rtl;">
				<tr >
					<td class="border-right twenty">
						نام داکتر: <?php echo $result['patient_name']; ?>
					</td>
					<td class="border-right twenty">
						نام پدر: <?php echo $result['guardian_name']; ?>
					</td>
					<td class="twenty">
						آدرس: <?php echo $result['address']; ?>
					</td>
					<td class="twenty">
						شماره تلفن: <?php echo $result['mobileno']; ?>
					</td>
				</tr>
			</table>
			
			<table class="table table-primary" style="border:1px gray solid; direction: rtl; background-color: #dbd7d7;">
			<thead>
				<th style="text-align: right">شماره</th>
				<th style="text-align: right">نام تست</th>
				<th style="text-align: right">تعداد ساخت</th>
				<th style="text-align: right">فی ساخت-افغـ</th>
				<th style="text-align: right">مبلغ-افغـ</th>
			</thead>
			<?php
				$last_round = show_last_round('opd_details',$result['id']);
				$count_each_lab = get_count_each_lab('lab_lab', $result['id'], 1);
				// print_r($count_each_lab); print_r($result['test_price']); die();
				$count=0; 
					foreach ($count_each_lab as $kye => $value) {
						$count++; 
						?>
						<tr>
							<td><?php echo $count; ?></td>
							<td><?php echo $value["test_name"]; ?></td>
							<td><?php echo $value['countset'];  ?></label> عدد</td>
							<td><?php echo $value['fee']/$value['countset'];  ?></label></td>
							<td><?php echo $value['fee'];?></td>
						</tr>
						<?php
					}
				?>
			</table>

			<table  style="border:1px black solid; direction: rtl;">
			<thead>
				<th style="text-align: right"># - شماره کتاب - نام تست</th>
				<th style="text-align: right">تعداد ساخت</th>
				<th style="text-align: right">مبلغ </th>
				<th style="text-align: right">تاریخ </th>
			</thead>
						<?php $count=0;
						if(isset($lab_lab))
						{
					     	foreach($lab_lab as $std)
							{ $count++; 
							?>   
							<tr>
								<td><?php echo $count; ?>- &nbsp; <?php echo $std['unique_id'];?>&nbsp; &nbsp; &nbsp; <?php echo $std['test_name'];?>
								</td>
								<td>
								 <?php  if($std['duplicate']==0){ echo "باقی قبلی";} else{echo $std['duplicate']."  "."     ساخت ";} ?> &nbsp; 
								</td>
								<td>
								 <?php echo $std['fees']; $sum += $std['fees']; ?> افغـ
								</td>
								<td>
								 <?php echo $std['day']; ?>-<?php echo $std['month']; ?>-<?php echo $std['year']; ?>
								</td>
							</tr>
							<?php 
							}

				    	}  ?>
				<?php 
						if(isset($opd_details))
						{
					     	foreach($opd_details as $std)
							{
							?>  
							<tr>
								<td>
								 رسید به    &nbsp; <?php echo $std['name'];?>&nbsp; <?php echo $std['surname'];?>
								</td>
								<td>
								  
								</td>
								
								<td>
								 <?php echo $std['amount']; $paid += $std['amount']; ?>  افغـ
								</td>
								<td>
								 <?php echo $std['bp']; ?>-<?php echo $std['symptoms']; ?>-<?php echo $std['casualty']; ?>
								</td>
							</tr>
							<?php 
							}
							
				    	}  ?>
				<tr >
					<td style="padding-left:15px;"><strong>مجموع  بدهکاری</strong></td>
					<td></td>
					<td><b><?php echo $sum;?> افغـ</b></td>
				</tr>

				<tr >
					<td style="padding-left:15px;"><strong>مجموع رسید ها</strong></td>
					<td></td>
					<td><b><?php echo $paid;?> افغـ</b></td>
				</tr>
				<tr >
					<td style="padding-left:15px;"><strong>مجموع باقیات</strong></td>
					<td></td>
					<td><b><?php echo $sum-$paid;?> افغـ</></td>
				</tr>

				<tr >
					<td style="padding-left:15px;">توضیحات اضافی: ____________________________<br><br></td>
					<td> </td>
				</tr>
				

			</table>

			<?php
				
				echo '<br>'."امضاء";
			?>
		</body>

</html>