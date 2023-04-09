<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">

    .printablea4{width: 100%;}
    .printablea4>tbody>tr>th,
    .printablea4>tbody>tr>td{padding:2px 0; line-height: 1.42857143;vertical-align: top; font-size: 12px;}
</style>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $this->lang->line('bill'); ?></title>
    </head>
    <div id="html-2-pdfwrapper">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="">
                    <div class="pprinta4">
                        <?php if (!empty($print_details[0]['print_header'])) { ?>
                            <img style="height:100px" class="img-responsive" src="<?php echo base_url() . $print_details[0]["print_header"] ?>">
                        <?php } ?>
                        <div style="height: 10px; clear: both;"></div>
                    </div>
                    <table class="border-top"  class="printablea4" width="90%">
                        <br><h4 style="margin-bottom: -30px; text-align: center; margin-left: -60px;" >Shuhada Organization<br> Shuhada Hospital Jaghori<br> Payment Slip<br></h4>
                        <img style="margin-left: 80%;
                        margin-top: -34px;
                        height: 58px;
                        margin-bottom: -18px;" src="http://localhost/rasikhhms/uploads/hospital_content/logo/0.JPG">
                    </table><br><br>
                    <table width="100%" class="printablea4">
                        <tr>
                           <br> <td align="text-left"><h5><?php echo $this->lang->line('bill') . " #" ?><?php echo $result["patient_unique_id"] ?></h5></td>
                            <td align="right"><h5><?php echo $this->lang->line('date') . " : " ?><?php
                                    if (!empty($result['date'])) {
                                        echo date('Y-m-d');
                                    }
                                    echo date('Y-m-d');
                                    ?></h5></td>
                        </tr>
                    </table>
                    <hr style="height: 1px; clear: both;margin-bottom: 10px; margin-top: 10px">
                    <table class="printablea4" cellspacing="0" width="100%">
                        <tr>
                            <th width="25%"><?php echo $this->lang->line('name'); ?></th>
                            <td width="25%"><?php echo $result["patient_name"]; ?></td>
                             <th width="25%"><?php echo $this->lang->line('guardian_name'); ?></th>
                            <td width="25%"><?php echo $result["guardian_name"]; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo $this->lang->line('ipd') . " " . $this->lang->line('no'); ?></th>
                            <td><?php echo $result['patient_unique_id']; ?></td> 
                            <th width="25%"><?php echo $this->lang->line('age'); ?></th>
                            <td width="25%"><?php echo $result["age"]; ?> Year, 0<?php echo $result["age_month"]; ?>Month, <?php echo $result["age_day"]; ?>0Day</td>
                        </tr> 
                    </table>
                    <hr style="height: 1px; clear: both;margin-bottom: 10px; margin-top: 10px">
                    <hr style="height: 1px; clear: both;margin-bottom: 10px; margin-top: 10px">
                    <?php $total_paid = 0;?>
                    <table class="printablea4" width="100%">
                        <tr>
                             <th>Payment Type</th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('paid') . " " . $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?></th>
                        </tr>
                         <?php
                                            
                                                if(!empty($op_li_last)){
                                                    
                                                    foreach ($op_li_last as $payment) {
                                                        if(!empty($payment['apply_charge'])){
                                                            $total_paid += $payment['apply_charge'];
                                                            $total_discount += $payment['discount'];
                                                        }
                                            ?>

                                                <tr>
                                                <td>Operation ( <?php echo $payment['operation_name']; ?> )</td>
                                                <td><?php echo $payment['date']; ?></td>
                                                <td class="text-right"><?php echo $payment['apply_charge']; ?></td>
                                                </tr>
                                            <?php
                                                    }
                                                }

                                            ?>


                                            <?php
                                                if(!empty($nursing_last)){
                                                    
                                                    foreach ($nursing_last as $payment) {
                                                        if(!empty($payment['total_fees'])){
                                                            $total_paid += $payment['total_fees'];
                                                            $total_discount += $payment['discount'];
                                                        }
                                            ?>

                                                <tr>
                                                    <td>Duration (<?php echo $payment['bed_time']; ?> Night)</td>
                                                    <td><?php echo $payment['date']; ?></td>
                                                    <td class="text-right"><?php echo $payment['total_fees']; ?></td>
                                                </tr>
                                            <?php
                                                    }
                                                }

                                            ?>

                                            
                                            <?php
                                            if (!empty($payment_details)) {
                                                    $total = 0;
                                                    foreach ($payment_details as $payment) {
                                                        if (!empty($payment['paid_amount'])) {
                                                            $paid_total += $payment['paid_amount'];
                                                        }
                                                        ?>
                                                <tr>
                                                    <td class="text-left"><?php echo $payment["note"] ?></td>
                                                    <td class="text-left"><?php echo $payment["date"] ?></td>
                                                    <td></td>
                                                    <td class="text-right">-<?php echo $payment["paid_amount"] ?></td>
                                                    <!-- <td><?php echo $payment["balance_amount"] ?></td> -->
                                                    <td class="text-right">
                                             
                                                    </td> 
                                                </tr>
                                            <?php
                                                    }
                                                }

                                            ?>

                            <?php
                        
                        if ($result['status'] != 'paid') {
                            $status = $this->lang->line('unpaid');
                        } else {
                            $status = $this->lang->line('paid');
                        }


                        foreach ($payment_details as $key => $payment) {
                            ?>
                            <tr>
                                <td width="25%"><?php echo $payment["payment_mode"]; ?></td>
                                <td width="25%"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($payment['date'])); ?></td>
                                <td width="50%" align="right"><?php echo $payment["paid_amount"]; ?></td>
                            </tr>
                            <?php
                            $total_paid += $payment["paid_amount"];
                        }
                        ?>
                        <tr>
                            <td  width="25%"></td>
                            <td  width="25%"></td>
                            <td  width="50%" align="right"><?php echo $this->lang->line('total') . " : " ?> <?php echo $currency_symbol . $total_paid ?></td>
                        </tr>
                    </table>


                    <hr style="height: 1px; clear: both;margin-bottom: 10px; margin-top: 10px">  
                    <table class="printablea4" width="100%">
                        <!-- <tr>
                            <th width="20%"><?php echo $this->lang->line('total') . " " . $this->lang->line('charges') . " (" . $currency_symbol . ")" ?> </th> 
                            <td align="right"><?php echo $total; ?></td>
                        </tr> -->

                        <tr>
                            <th width="20%"><?php echo $this->lang->line('total') . " " . $this->lang->line('payment') . " (" . $currency_symbol . ")" ?> </th> 
                            <td align="right" width=""><?php
                                
                                    echo $total_paid;
                                
                                ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr style="height: 1px; clear: both;margin-bottom: 10px; margin-top: 10px">
                            </td>
                        </tr>
                        <tr>
                            <th width="20%"><?php echo $this->lang->line('gross') . " " . $this->lang->line('total') . " (" . $currency_symbol . ")" ?> </th> 
                            <td align="right" width=""><?php
                                
                                    echo $gross_total;;
                                
                                ?></td>
                        </tr>
                        <tr>
                            <th width="20%"><?php echo $this->lang->line('discount') . " (" . $currency_symbol . ")"; ?></th> 
                            <td align="right">
                                <input type="hidden" name="patient_id" value="<?php echo $result["id"] ?>">
                                <?php
                                    echo  $total_discount; 
                                ?></td>
                        </tr> 

                        <tr>
                            <th width="30%"><?php echo $this->lang->line('any_other_charges') . " (" . $currency_symbol . ")"; ?></th> 
                            <td align="right"><?php
                                
                                    echo $other_charge;
                                
                                ?></td>
                        </tr>
                        <!-- <tr>
                            <th width="20%"><?php echo $this->lang->line('tax') . " (" . $currency_symbol . ")" ?></th> 
                            <td align="right"><?php
                               
                                    echo $tax;
                                
                                ?></td>
                        </tr> -->
                        <tr>
                            <td colspan="2">
                                <hr style="height: 1px; clear: both;margin-bottom: 10px; margin-top: 10px">
                            </td>
                        </tr>  
                        <tr>
                             <!--                            <th width="50%"><?php echo $this->lang->line('net_payable') . " " . $this->lang->line('amount') . " (" . $status . ")" ?></th>  -->
                             <th width="50%"><?php echo $this->lang->line('net_payable') . " " . $this->lang->line('amount') . " (Paid) " ?></th> 
                            <td align="right"><?php
                                echo $net_amount;
                                ?></td>
                        </tr>

                    </table>
                    <hr style="height: 1px; clear: both;margin-bottom: 10px; margin-top: 10px">
<?php if (!empty($print_details[0]['print_footer'])) { ?>    
                        <p class="ptt10"><?php echo $print_details[0]['print_footer']; ?></p>
<?php } ?>
                </div>
            </div>
        </div>
    </div>

</html>