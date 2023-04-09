<?php
$currency_symbol = "افغـ";
$genderList = $this->customlib->getGender();
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<style type="text/css">
span{  text-transform: capitalize; }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="row"> 
            <div class="panel panel-primary">
            <div class="panel-heading">مشخصات داکتر</div>
            <div class="panel-body">
            <div class="box box-primary" <?php
                // if ($result["is_active"] == 0) {
                //     echo "style='background-color:#f0dddd;'";
                // }
                ?>>
                <div class="col-md-12" style="list-style-type:none; margin-top:35px;">
                   
                    <div class="col-md-2">
                         <li><b>آی دی</b>:</li> 
                         <li><b>شماره کتاب</b>:</li> 
                         <li><b>نام داکتر</b>:</li> 
                         <li><b>نام پدر</b>:</li> 
                         <li><b>جنسیت</b>:</li> 
                    </div>
                    <div class="col-md-3" style="margin-right: -70px; ">
                            <li ><?php echo $result['patient_unique_id']; ?></li>
                            <li> <?php echo $result['hmis_no']; ?> </li>
                            <li ><?php echo $result['patient_name']; ?></li>
                            <li ><?php echo $result['guardian_name']; ?></li>
                            <li ><?php echo $result['gender']; ?></li>
                    </div>
                    <div class="col-md-2">
                               <li><b>سن</b>:</li> 
                               <li><b>آدرس</b>:</li> 
                               <li><b>شماره تماس</b>:</li> 
                               <li><b>قمت پورسلین</b>:</li> 
                    </div>
                    <div class="col-md-3" style="margin-right: -70px; ">
                            <li> <?php echo $result['age']; ?> سال</li>
                            <li ><?php echo $result['address']."،".$result['province']."،".$result['district']; ?></li>
                            <li ><?php echo $result['mobileno']; ?></li>
                            <li ><label class="label label-success"><?php echo $result['test_price']; ?>  <?= $currency_symbol?></label></li>
                    </div>
                    
                    <div class="col-md-2">
                    <div class="box-body box-profile">
                        <?php

                        $image = $result['image'];
                        if (!empty($image)) {

                            $file = $result['image'];
                        } else {

                            $file = "uploads/patient_images/no_image.png";
                        }
                        ?>        
                        
                        <img class="profile-user-img img-responsive" src="<?php echo base_url() . $file ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $result['patient_name']." ".$result['guardian_name']; ?></h3> 
                        <div class="editviewdelete-icon text-center">
                        <!-- class="btn <?php if($result['is_printed'] == 1) echo 'btn-success btn-sm'; else echo 'btn-default'; ?>" -->
                        <?php if ($this->rbac->hasPrivilege('opd_patient', 'can_edit')) { ?>
                                <!-- <a class="" href="#" onclick="getRoundForPrint('<?php echo $result['id'] ?>')"   data-toggle="tooltip" title="پرنت دوره ای"> -->
                                <a class=""  target="_blank" href="<?php echo base_url(); ?>admin/patient/print_each/<?php echo $result['id'] ?>"  data-toggle="tooltip" title="تایید از پرنت آخرین دوره">
                                    <i class="fa fa-print"></i> 
                                </a>
                                <a class="" target="_blank" href="<?php echo base_url(); ?>admin/patient/print_confirm/<?php echo $result['id'] ?>"  data-toggle="tooltip" title="تایید از پرنت آخرین دوره">
                                    <i class="fa fa-user" style="color: green;"></i> 
                                </a>
                            <?php } ?>
                            <?php if ($this->rbac->hasPrivilege('opd_patient', 'can_edit')) { ?>
                                
                                <a class="" target="_blank"  href="<?php echo base_url(); ?>admin/patient/print/<?php echo $result['id'] ?>"  data-toggle="tooltip" title="پرنت حسابی داکتر">
                                    <i class="fa fa-print"></i>
                                </a> 
                            <?php } ?>
                            
                            <?php if ($this->rbac->hasPrivilege('opd_patient', 'can_edit')) { ?>
                                <a class="" href="#" onclick="getEditRecord('<?php echo $result['id'] ?>')"   data-toggle="tooltip" title="ویرایش مشخصات داکتر">
                                    <i class="fa fa-pencil"></i> 
                                </a>
                            <?php } ?>
                            <?php if ($this->rbac->hasPrivilege('opd_patient', 'can_delete')) { ?>
                                <a class="" href="#" onclick="delete_patient('<?php echo $result['id'] ?>')"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete') . " " . $this->lang->line('patient') ?>">
                                    <i class="fa fa-trash"></i>
                                </a>
                            <?php } ?>
                            
                        </div>
                    </div>
                    </div>
                </div> 
            </div>
            </div> 
            
             
                <div class="nav-tabs-custom">
                
                    <ul class="nav nav-tabs">
                        <?php if ($this->rbac->hasPrivilege('revisit', 'can_view')) { ?>
                            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"><i class="far fa-caret-square-down"></i>&nbsp; <b>رسید</b></a></li>
                        <?php } ?>
                        <?php if ($this->rbac->hasPrivilege('opd timeline', 'can_view')) { ?>
                            <li><a href="#timeline" data-toggle="tab" aria-expanded="true"><i class="far fa-calendar-check"></i>  <b>نوع ساخت</b></a></li>
                        <?php } ?>
                        <!-- Note that count_each_test tab is newly added by Rasikh -->
                        <?php if ($this->rbac->hasPrivilege('revisit', 'can_view')) { ?>
                            <li class="counting_each_test"><a href="#counting_each_test" data-toggle="tab" aria-expanded="true"><i class="far fa-caret-square-down"></i>&nbsp; <b>مجموع هر ساخت</b></a></li>
                        <?php } ?>
                    </ul>
            <div class="tab-content">
                            <?php if ($this->rbac->hasPrivilege('opd_patient', 'can_view')) { ?>
            <div class="tab-pane active" id="activity">
                                <div class="download_label"><?php echo $result['patient_name'] . " " . $this->lang->line('opd') . " " . $this->lang->line('details'); ?></div>
                                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                    <thead>
                    <th>شماره</th>
                    <th>آی دی</th>
                    <th>گیرنده</th>
                    <th>تاریخ</th>
                    <th>مبلغ رسید-به عدد</th>
                    <th>مبلغ رسید-به حروف</th>
                    <th>پرنت</th>
                    <th>دوره</th>
                    <th>یادداشت</th>
                   
                    <th class="text-right"><?php echo $this->lang->line('action') ?></th>         
                    </thead>
                    <tbody> 
                        <?php
                        //print_r($opd_details);
                        $total=0;
                        if (!empty($opd_details)) {
                            foreach ($opd_details as $key => $value) {
                                $total += $value['amount'];
                                ?>  
                                <tr> 
                                   
                                    <td><?php echo $value["id"] ; ?></td>
                                    <td><?php echo $value["patient_id"];?></td>
                                    <td><?php echo $value["name"] . " " . $value["surname"];  ?></td>
                                    <td><?php echo $value["symptoms"];?>-<?php echo $value["bp"];?>-<?php echo $value["casualty"];?></td>
                                    <td><?php echo $value["amount"]; ?></td>
                                    <td><?php echo $value["payment_mode"]; ?></td>
                                    <td><?php if($value["is_printed"]==1){?><label class="label label-success">چاپ شده</label><?php } ?>
                                        <?php if($value["is_printed"]==0){?><label class="label label-danger">چاپ نشده</label><?php } ?>
                                    </td>
                                    <td><?php echo $value["round"]; ?></td>
                                    <td><?php echo $value["note_remark"]; ?></td>
                                    <td class="pull-right">
                                        <?php
                                        if ($this->rbac->hasPrivilege('prescription', 'can_add')) {
                                            if ($value["prescription"] == 'no') {
                                                ?>
                                                <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('add_prescription'); ?>" onclick="getRecord_id('<?php echo $value["id"]; ?>')"><i class="fas fa-prescription"></i></a>
                                            <?php }
                                        }
                                        ?>
                                        <?php if ($value["prescription"] == 'yes') { ?>
                                            <a href="#" class="btn btn-default btn-xs" onclick="view_prescription('<?php echo $value["id"];?>', '<?php echo $value["id"] ?>')"   data-toggle="tooltip" title="<?php echo $this->lang->line('view') . " " . $this->lang->line('prescription'); ?>">
                                                <i class="fas fa-file-prescription"></i>
                                            </a>
                                            <?php } ?>
                                        <a href="#"  class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" onclick="getRecord('<?php echo $result["id"]; ?>', '<?php echo $value["id"]; ?>')" >
                                            <i class="fa fa-reorder"></i>
                                        </a>

                                    </td>

                                   
                                </tr>
                                <?php }
                                }
                                ?> 
                    </tbody>
                    <tr class="box box-solid total-bg"  style="font-size: 23px; color: green; ">
                                        <td class="text-right" colspan='14'>مجموعه رسید 
                                        <label style="margin-right: 65%;"><?php echo $total." ".$currency_symbol?></label>
                                        </td>
                     </tr>
                </table>
                                </div> 
                            </div>
                                <?php } ?>
                        <!-- Start of timeline tab -->
                        <div class="tab-pane" id="timeline">
                            <div class="timeline-header no-border">
                                <div id="timeline_list">
                                    <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                        <thead>
                                        <th>آی دی</th>
                                        <th>نوعیت ساخت</th>
                                        <th>تاریخ ساخت</th>     
                                        <!-- <th>روند </th> -->
                                        <!-- <th>گذارش روند </th> -->
                                        <th>تعداد دندان</th>
                                        <th>موقعیت-چب </th>
                                        <th >موقعیت-راست </th>
                                        <th >بل</th>
                                        <th >دوره</th>
                                        <th >یادداشت</th>
                                        <th style="text-align: right; width: 50px !important;">قمت-<?= $currency_symbol?></th>
                                        </thead>
                                        <tbody>
<!-- lab lab -->                    
                                    <?php
                                    $last_round = show_last_round('opd_details',$result['id']);
                                    $records = get_the_examination('lab_lab',$result['id']);
                                    $count_each_lab = get_count_each_lab('lab_lab', $result['id']);
                                    // print_r($count_each_lab); die();
                                        foreach ($records as $kye => $value) {
                                           
                                            ?>
                                            <tr class="">
                                                <td><?php echo $value["unique_id"]; ?></td>
                                                <td><?php echo $value["test_name"]; ?></td>
                                                <td><?php echo $value['day'];  ?>-<?php echo $value['month'];  ?>-<?php echo $value['year'];  ?></td>
                                                <!-- <td><label><?php echo $value['round'];  ?></label></td> -->
                                                <!-- <td><?php echo $value['lab_round'];  ?></label></td> -->
                                                <td><?php echo $value['duplicate'];  ?></label></td>
                                                <td>
                                                <label style="color: green; font-size: 16px;">بالا:
                                                <?php   
                                                            if ($value['lh']==1){ echo "8"; } else { echo "-"; }
                                                            if ($value['lg']==1){ echo "7"; } else echo "-";
                                                            if ($value['lf']==1){ echo "6"; } else echo "-";
                                                            if ($value['le']==1){ echo "5"; } else echo "-";
                                                            if ($value['ld']==1){ echo "4"; } else echo "-";
                                                            if ($value['lc']==1){ echo "3"; } else echo "-";
                                                            if ($value['lb']==1){ echo "2"; } else echo "-";
                                                            if ($value['la']==1){ echo "1"; } else echo "-";
                                                     ?>
                                                <label>
                                                <label style="color: green; font-size: 16px;">پایین:
                                                <?php   
                                                            if ($value['ldh']==1){ echo "8"; } else { echo "-"; }
                                                            if ($value['ldg']==1){ echo "7"; } else echo "-";
                                                            if ($value['ldf']==1){ echo "6"; } else echo "-";
                                                            if ($value['lde']==1){ echo "5"; } else echo "-";
                                                            if ($value['ldd']==1){ echo "4"; } else echo "-";
                                                            if ($value['ldc']==1){ echo "3"; } else echo "-";
                                                            if ($value['ldb']==1){ echo "2"; } else echo "-";
                                                            if ($value['lda']==1){ echo "1"; } else echo "-";
                                                     ?>
                                                <label>
                                                </td>
                                                <td>
                                                <label style="color: green; font-size: 16px;">بالا:
                                                <?php   
                                                            if ($value['rh']==1){ echo "8"; } else { echo "-"; }
                                                            if ($value['rg']==1){ echo "7"; } else echo "-";
                                                            if ($value['rf']==1){ echo "6"; } else echo "-";
                                                            if ($value['re']==1){ echo "5"; } else echo "-";
                                                            if ($value['rd']==1){ echo "4"; } else echo "-";
                                                            if ($value['rc']==1){ echo "3"; } else echo "-";
                                                            if ($value['rb']==1){ echo "2"; } else echo "-";
                                                            if ($value['ra']==1){ echo "1"; } else echo "-";
                                                     ?>
                                                </label>
                                                <label style="color: green; font-size: 16px;">پایین:
                                                <?php   
                                                            if ($value['rdh']==1){ echo "8"; } else { echo "-"; }
                                                            if ($value['rdg']==1){ echo "7"; } else echo "-";
                                                            if ($value['rdf']==1){ echo "6"; } else echo "-";
                                                            if ($value['rde']==1){ echo "5"; } else echo "-";
                                                            if ($value['rdd']==1){ echo "4"; } else echo "-";
                                                            if ($value['rdc']==1){ echo "3"; } else echo "-";
                                                            if ($value['rdb']==1){ echo "2"; } else echo "-";
                                                            if ($value['rda']==1){ echo "1"; } else echo "-";
                                                     ?>
                                                </label>
                                                </td>
                                                <td><?php if($value["is_printed"]==1){?><label class="label label-success">چاپ شده</label><?php } ?>
                                                <?php if($value["is_printed"]==0){?><label class="label label-danger">چاپ نشده</label><?php } ?>
                                                </td>
                                                <td><?php echo $value['lab_round'];  ?></label></td>
                                                <td><?php echo $value['add_description'];  ?></label></td>

                                                <td><?php echo $value['fees'];  ?></td>
                                                    <?php $totalfees += $value['fees']; ?>

                                            </tr>
                                            <?php
                                        }
                                    ?>
                             </tbody>
                                <tr class="box box-solid total-bg" style="font-size: 23px; color: green;">
                                <td class="text-right" colspan='18'>مجموعه بدهکار <label style="margin-right: 60%;"><?php echo $totalfees;?> <?= $currency_symbol?></label> 
                                </td>
                            </tr>
                            <tr class="box box-solid total-bg" style="font-size: 23px; color: red; ">
                                <td class="text-right" colspan='18'>مجموعه باقی <label style="color: red; margin-right: 60%;" id="total_remaining"><?php echo $totalfees-$total;?> <?= $currency_symbol?></label>
                                </td>
                            </tr>
                            </table>
                        </div> 
                        </div>
                        </div>
                        </div>  
                        
                        <!-- start of  -->
                        <div class="tab-pane" id="counting_each_test">
                            <div class="timeline-header no-border">
                                <div id="counting_each_test">
                                    <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                        <thead>
                                        <th>آی دی</th>
                                        <th>نوعیت ساخت</th>
                                        <th>تاریخ ساخت</th>     
                                        <th>تعداد دندان</th>
                                        <th >یادداشت</th>
                                        </thead>
                                        <tbody>
<!-- lab lab -->                    
                                    <?php
                                    $last_round = show_last_round('opd_details',$result['id']);
                                    $count_each_lab = get_count_each_lab('lab_lab', $result['id']);
                                    // print_r($count_each_lab); die();
                                    $count=0; 
                                        foreach ($count_each_lab as $kye => $value) {
                                           $count++; 
                                            ?>
                                            <tr class="">
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $value["test_name"]; ?></td>
                                                <td><?php echo $value['day'];  ?>-<?php echo $value['month'];  ?>-<?php echo $value['year'];  ?></td>
                                                <td><?php echo $value['SUM(duplicate)'];  ?></label> ساخت</td>
                                                <td><?php echo $value['add_description'];  ?></label></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                             </tbody>
                            </table>
                        </div> 
                        </div>




                            </div>

                        </div>  
                        <!-- Start prescription -->
                        <div class="tab-pane" id="prescription">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover example">                       
                                    <thead>
                                    <th><?php echo $this->lang->line('opd') . " " . $this->lang->line('id'); ?></th>
                                    <th><?php echo $this->lang->line('appointment') . " " . $this->lang->line('date'); ?></th>
                                    <th><?php echo $this->lang->line('note'); ?></th>
                                    <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($prescription_detail)) {
                                            foreach ($prescription_detail as $prescription_key => $prescription_value) {

                                                //print_r($value);
                                                ?>  
                                                <tr>
                                                    <td><?php echo $prescription_value["opd_id"] ?></td>
                                                    <td><?php echo $prescription_value["appointment_date"] ?></td>
                                                    <td><?php echo $prescription_value["note"] ?></td>
                                                    <th class="pull-right"><a href="#" data-toggle='tooltip' title="<?php echo $this->lang->line('test_report_detail'); ?>" onclick="view_prescription('<?php echo $prescription_value["id"] ?>', '<?php echo $prescription_value["opd_id"] ?>')"><i class="fa fa-reorder"></i></a></th>
                                                </tr>
                                            <?php }
                                        }
                                        ?> 

                                    </tbody>
                                </table>
                            </div> 
                        </div>           

                        <!-- end of prescription -->
                    </div>

                </div>


            </div>
    </section>
</div>  

<!--  -->

<div class="modal fade" id="editModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="box-title"> <?php echo $this->lang->line('edit') . " " . $this->lang->line('visit') . " " . $this->lang->line('information'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form id="formedit"  accept-charset="utf-8"  enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>
                                            <?php echo $this->lang->line('appointment') . " " . $this->lang->line('date'); ?></label><small class="req"> *</small> 
                                        <input type="text" name="appointment_date" class="form-control datetime" id="appointmentdate" />
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>یادداشت</label> 
                                        <textarea style="height: 42px; width: 135%;" class="form-control" id="edit_note_remark" name="note_remark"></textarea>
                                        <input type="hidden" name="opdid" id="edit_opdid">
                                    </div> 
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('consultant') . " " . $this->lang->line('doctor'); ?></label><small class="req"> *</small> 
                                        <select name="consultant_doctor" style="width:100%" class="form-control select2" id="edit_consdoctor">
                                            <option value=""><?php echo $this->lang->line('select') ?></option>

                                            <?php foreach ($doctors as $dkey => $dvalue) {
                                                ?>
                                           <option value="<?php echo $dvalue["id"] ?>"><?php echo $dvalue["name"] . " " . $dvalue["surname"] ?></option>
                                            <?php } ?>
                                        </select>    


                                    </div> 
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?></label> 
                                        <input type="text" name="amount" class="form-control" id="edit_amount" />
                                        <input type="hidden" name="patientid" class="form-control" id="patientid" />
                                    </div> 
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('payment') . " " . $this->lang->line('mode'); ?></label> 
                                        <input type="text" name="payment_mode" class="form-control" id="edit_paymentmode">
                                    </div> 
                                </div>
                            </div>


                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>

                        </form>
                    </div>
                </div>
            </div>    

        </div></div> </div>


<!-- Add Diagnosis -->
<div class="modal fade" id="add_diagnosis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"> <?php echo $this->lang->line('add') . " " . $this->lang->line('diagnosis'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form id="form_diagnosis"   accept-charset="utf-8"  enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="row">


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>
<?php echo $this->lang->line('report') . " " . $this->lang->line('type'); ?></label><small class="req"> *</small> 
                                        <input type="text" name="report_type" class="form-control" id="report_type" />
                                        <input type="hidden" value="<?php echo $id ?>" name="patient" class="form-control" id="patient" />    


                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>
<?php echo $this->lang->line('report') . " " . $this->lang->line('date'); ?></label> 
                                        <input type="text" name="report_date" class="form-control date" id="report_date"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('document'); ?></label> <input type="file" class="form-control filestyle" name="report_document" id="report_document" />
                                    </div> 
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('description'); ?></label> 
                                        <textarea name="description" class="form-control" id="description"></textarea>

                                    </div> 
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>    

        </div></div> </div>

<!-- -->
<!-- Timeline -->
<div class="modal fade" id="myTimelineModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"> <?php echo $this->lang->line('add') . " " . $this->lang->line('timeline'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form id="add_timeline"   accept-charset="utf-8"  enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="row">


                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label><small class="req"> *</small>
                                        <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $id ?>">
                                        <input id="timeline_title" name="timeline_title" placeholder="" type="text" class="form-control"  />
                                        <span class="text-danger"><?php echo form_error('timeline_title'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input id="timeline_date" name="timeline_date" value="<?php echo set_value('timeline_date', date($this->customlib->getSchoolDateFormat())); ?>" placeholder="" type="text" class="form-control date"  />
                                        <span class="text-danger"><?php echo form_error('timeline_date'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                        <textarea id="timeline_desc" name="timeline_desc" placeholder=""  class="form-control"></textarea>
                                        <span class="text-danger"><?php echo form_error('description'); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <div class="" style="margin-top:-5px; border:0; outline:none;"><input id="timeline_doc_id" name="timeline_doc" placeholder="" type="file"  class="filestyle form-control" data-height="40"  value="<?php echo set_value('timeline_doc'); ?>" />
                                            <span class="text-danger"><?php echo form_error('timeline_doc'); ?></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('visible'); ?></label>
                                        <input id="visible_check" checked="checked" name="visible_check" value="yes" placeholder="" type="checkbox"   />

                                    </div>
                                </div>


                            </div>


                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>    

        </div></div> </div>

<!-- -->

<div class="modal fade" id="edit_prescription"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"> <?php echo $this->lang->line('edit') . " " . $this->lang->line('prescription'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0" id="editdetails_prescription">
            </div>    

        </div></div> </div>

<!-- -->
<!-- Add Prescription -->
<div class="modal fade" id="add_prescription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"> <?php echo $this->lang->line('add') . " " . $this->lang->line('prescription'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form id="form_prescription" accept-charset="utf-8"  enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('header_note'); ?></label> 
                                        <textarea style="height:50px"  name="header_note" class="form-control" id="compose-textarea" ></textarea>
                                    </div> 
                                    <hr/>
                                </div>

                                <table style="width: 100%" id="tableID">
                                    <tr id="row0">
                                        <td>                                
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>
<?php echo $this->lang->line('medicine'); ?></label> <small class="req"> *</small>
                                                    <input type="text" name="medicine[]" class="form-control" id="report_type" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('dosage'); ?></label> 
                                                    <input type="text" class="form-control" name="dosage[]" id="report_document" />
                                                </div> 
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('instruction'); ?></label> 
                                                    <textarea name="instruction[]" style="height: 28px;" class="form-control" ></textarea>



                                                </div> 
                                            </div>
                                        </td>
                                        <td><button type="button" onclick="add_more()" style="color: #2196f3" class="modaltableclosebtn"><i class="fa fa-plus"></i></button></a></td>
                                    </tr>
                                </table>
                                <div class="add_row">

                                </div>
                                <!--div class="col-sm-12">
                                   <a href="#" class="pull-right" onclick="add_more()"><?php //echo $this->lang->line('add_more');  ?></a>
                                </div-->




                                <input type="hidden" id="prescription_id" name="opd_no">


                                <hr/>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('footer_note'); ?></label> 
                                        <textarea style="height:50px" rows="1" name="footer_note" class="form-control" id="compose-textareas"></textarea>
                                    </div> 
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>    

        </div></div> </div>

<!-- -->
<div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog modal-dialog2 modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">

                <button type="button" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('close'); ?>" class="close" data-dismiss="modal">&times;</button>
                <div class="modalicon"> 
                    <div id='edit_delete'>
<?php if ($this->rbac->hasPrivilege('revisit', 'can_edit')) { ?>

                        <a href="#" onclick="editRecord('<?php echo $value["patient_id"] ?>', '<?php echo $value["id"] ?>')" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>" ><i class="fa fa-pencil"></i></a>
<?php
}
if ($this->rbac->hasPrivilege('revisit', 'can_delete')) {
    ?>
                            <a href="#" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash"></i></a>
<?php } ?>
                    </div>
                </div>
                <h4 class="box-title"> <?php echo $this->lang->line('visit') . " " . $this->lang->line('information'); ?></h4> 
            </div>

            <div class="modal-body">
                <div class="row">

                    <form id="" accept-charset="utf-8"  enctype="multipart/form-data" method="post" >
                        <div class="col-lg-12 col-md-12 col-sm-12 table-responsive">
                            <table class="table mb0 table-striped table-bordered examples">
                                <tr>
                                    <th width="15%"><?php echo $this->lang->line('patient') . " " . $this->lang->line('name'); ?></th>
                                    <td width="35%"><span id="patient_name"></span>
                                    </td>
                                    <th width="15%"><?php echo $this->lang->line('patient') . " " . $this->lang->line('id'); ?></th>
                                    <td width="35%"><span id='patients_id'></span></td>
                                </tr>
                                <tr>
                                    <th width="15%">نام پدر</th>
                                    <td width="35%"><span id='guardian_name'></span></td>
                                    <th width="15%"><?php echo $this->lang->line('gender'); ?></th>
                                    <td width="35%"><span id='gen'></span></td>
                                </tr>
                                 
                                <tr>
                                    <th width="15%"><?php echo $this->lang->line('age'); ?></th>
                                    <td width="35%"><span id='email' style="text-transform: none"></span></td>
                                    <th width="15%"><?php echo $this->lang->line('address'); ?></th>
                                    <td width="35%"><span id='patient_address'></span></td>
                                </tr>
                                <tr>
                                    <th width="15%">داکتر گیرنده</th>
                                    <td width="35%"><span id='doc'></span></td>
                                </tr>

                                <tr>
                                    <th width="15%"><?php echo $this->lang->line('amount'); ?></th>
                                    <td width="35%"><?php echo $currency_symbol ?><span id='amount'></span></td>

                                    <th width="15%"><?php echo $this->lang->line('payment') . " " . $this->lang->line('mode'); ?></th>
                                    <td width="35%"><span id='payment_mode' style="text-transform: capitalize;"></span></td>

                                </tr>
                                <tr>
                                    <th width="15%"><?php echo $this->lang->line('note'); ?></th>
                                    <td width="35%"><span id='note'></span></td>


                                </tr>

                            </table>

                        </div>
                    </form>
                </div>
            </div>    

        </div></div> </div>
<!-- -->
<div class="modal fade" id="prescriptionview" tabindex="-1" role="dialog" aria-labelledby="follow_up">   
    <div class="modal-dialog modal-mid modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close"  data-dismiss="modal">&times;</button>
                <div class="modalicon"> 
                    <div id='edit_deleteprescription'>
                        <a href="#" data-target="#edit_prescription" data-toggle="modal" ><i class="fa fa-pencil"></i></a>

                        <a href="#" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
                <h4 class="box-title"><?php echo $this->lang->line('prescription'); ?></h4>
            </div>
            <div class="modal-body pt0 pb0" id="getdetails_prescription">

            </div>
        </div>
    </div>
</div>

<!--start print each round  -->
<div class="modal fade" id="print_for_each_round" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"> پرنت بطور ماهوار</h4> 
            </div>
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form id="printforeachid" enctype="multipart/form-data" accept-charset="utf-8" method="post"  class="ptt10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small> 
                                        <input id="patient_names" readonly name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                        <input type="hidden" id="updateids" name="updateid">
                                        <span class="text-danger"><?php echo form_error('name'); ?></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>تخلص</label>
                                        <input type="text" readonly id="guardian_names" name="guardian_name" value="<?php echo set_value('guardian_name'); ?>" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>شماره مسلمسل</label>
                                        <input type="unique_id" id="unique_id" readonly name="unique_id" value="<?php echo set_value('unique_id'); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>سال</label>
                                        <select name="start_year" class="form-control" required>
                                            <?php
                                                for($i=1390; $i<=1405; $i++)
                                                { ?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?> </option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>ماه</label>
                                        <select name="start_month" class="form-control" required>
                                                <option value="حمل">حمل </option>
                                                <option value="ثور">ثور </option>
                                                <option value="جوزا">جوزا </option>
                                                <option value="سرطان">سرطان </option>
                                                <option value="اسد">اسد </option>
                                                <option value="سنبله">سنبله </option>
                                                <option value="میزان">میزان </option>
                                                <option value="عقرب">عقرب </option>
                                                <option value="قوس">قوس </option>
                                                <option value="جدی">جدی </option>
                                                <option value="دلو">دلو </option>
                                                <option value="حوت">حوت </option>
                                            </select>
                                    </div>
                                </div>
                            </div><!--./row-->   

                    </div><!--./col-md-12-->       
                </div><!--./row--> 
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <!-- <button targe="_blank" type="" class="btn btn-info pull-right"><a href="<?php echo base_url(); ?>admin/patient/print_each/<?php echo $value["patient_id"];?>">sdfsdfds</a></button> -->
                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                    </form>    
                </div>
            </div>
        </div>
    </div>    
</div>

<!-- end of print each round  -->
<!-- -->
<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">تغیر در جزییات داکتر</h4> 
            </div>
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form id="formeditrecord" accept-charset="utf-8" enctype="multipart/form-data" method="post"  class="ptt10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small> 
                                        <input id="pname_id" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                        <input type="hidden" id="myupdated_id" name="updateid">
                                        <input type="hidden" id="opdid" name="opdid">
                                        <span class="text-danger"><?php echo form_error('name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>تخلص</label>
                                        <input type="text" id="gname_id" name="guardian_name" value="<?php echo set_value('guardian_name'); ?>" class="form-control">
                                    </div>
                                </div>
                                 
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>قمت پورسیلین (<?= $currency_symbol?>)</label>
                                        <input type="text" id="test_price_id" value="<?php echo set_value('test_price'); ?>" name="test_price" class="form-control">
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pwd">شماره تماس</label>
                                        <input id="phone_id"   name="contact" placeholder="" type="text" class="form-control"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="pwd"> بازاریاب <small class="req"> *</small></label> 
                                        <select class="form-control select2" style="width:100%" name='marketer' require="required" >
                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                            <?php foreach ($marketer as $dkey => $dvalue) {
                                                ?>
                                                <option value="<?php echo $dvalue["id"]; ?>"><?php echo $dvalue["name"] . " " . $dvalue["surname"] ?></option>   
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('age'); ?></label>
                                        <div style="clear: both;overflow: hidden;">
                                            <input type="text" placeholder="<?php echo $this->lang->line('age'); ?>" id="ages" name="age" value="<?php echo set_value('age'); ?>" class="form-control" style="width: 40%; float: left;">
                                            <input type="text" placeholder="<?php echo $this->lang->line('month'); ?>" id="months" name="month" value="<?php echo set_value('month'); ?>" class="form-control" style="width: 56%;float: left; margin-left: 5px;">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('address'); ?></label>
                                        <textarea class="form-control" name="address" id="address"></textarea>

                                    </div>
                                </div> 
                            </div><!--./row-->   

                    </div><!--./col-md-12-->       
                </div><!--./row--> 
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                    </form>    
                </div>
            </div>
        </div>
    </div>    
</div>

<div class="modal fade" id="revisitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"> <?php echo $this->lang->line('patient') . " " . $this->lang->line('information'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <form id="formrevisit"   accept-charset="utf-8"  enctype="multipart/form-data" method="post" >
                            <div class="row row-eq">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="row ptt10">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('patient') . " " . $this->lang->line('id'); ?></label> 
                                                <input id="revisit_id" disabled name="patient_id" placeholder="" type="text" class="form-control"  value="<?php echo set_value('roll_no'); ?>" />
                                                <span class="text-danger"><?php echo form_error('patient_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small> 
                                                <input id="revisit_name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                                <input type="hidden" name="id" id="pid">
                                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('guardian_name'); ?></label>
                                                <input type="text" name="guardian_name" value="<?php echo set_value('guardian_name'); ?>" class="form-control" id="revisit_guardian">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label> <?php echo $this->lang->line('gender'); ?></label>
                                                <select class="form-control" name="gender" id="revisit_gender">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
<?php
foreach ($genderList as $key => $value) {
    ?>
                                                        <option value="<?php echo $key; ?>" <?php if (set_value('gender') == $key) echo "selected"; ?>><?php echo $value; ?></option>
    <?php
}
?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('marital_status'); ?></label>
                                                <select name="marital_status" class="form-control" id="revisit_marital_status">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
<?php foreach ($marital_status as $mkey => $mvalue) {
    ?>
                                                        <option value="<?php echo $mkey ?>"><?php echo $mvalue; ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('phone'); ?></label>
                                                <input id="revisit_contact" autocomplete="off" name="contact" placeholder="" type="text" class="form-control"  value="<?php echo set_value('contact'); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('email'); ?></label>
                                                <input type="text" id="revisit_email" value="<?php echo set_value('email'); ?>" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="email"><?php echo $this->lang->line('address'); ?></label> 
                                                <input type="text" id="revisit_address" value="<?php echo set_value('address'); ?>" name="address" class="form-control">
                                            </div> 
                                        </div> 
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('age'); ?></label>
                                                <div style="clear: both;overflow: hidden;">
                                                    <input type="text" placeholder="Year" name="age" value="<?php echo set_value('age'); ?>" 
                                                           id="revisit_age" class="form-control" style="width: 43%; float: left;">
                                                    <input type="text" placeholder="Month" name="month" id="revisit_month" value="<?php echo set_value('month'); ?>" class="form-control" style="width: 53%;float: left; margin-left: 4px;">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('blood_group'); ?></label>
                                                <select name="blood_group" id="revisit_blood_group" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
<?php
foreach ($bloodgroup as $key => $value) {
    ?>
                                                        <option value="<?php echo $value; ?>" <?php if (set_value('blood_group') == $key) echo "selected"; ?>><?php echo $value; ?></option>
    <?php
}
?>
                                                </select>   
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('height'); ?></label> 
                                                <input name="height" id="revisit_height" type="text" class="form-control"  value="<?php echo set_value('height'); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('weight'); ?></label> 
                                                <input name="weight" id="revisit_weight" type="text" class="form-control"  value="<?php echo set_value('weight'); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-4">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('bp'); ?></label> 
                                                <input name="bp" type="text" id="revisit_bp" class="form-control"  value="<?php echo set_value('bp'); ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email"><?php echo $this->lang->line('symptoms'); ?></label> 
                                                <textarea name="symptoms" id="revisit_symptoms" class="form-control" ><?php echo set_value('address'); ?></textarea>
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email"><?php echo $this->lang->line('any_known_allergies'); ?></label> <textarea name="known_allergies" id="revisit_allergies" class="form-control" ><?php echo set_value('address'); ?></textarea>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('note'); ?></label> 
                                                <textarea name="note_remark" id="revisit_note" class="form-control" ><?php echo set_value('note_remark'); ?></textarea>
                                            </div>
                                        </div>   
                                    </div><!--./row--> 
                                </div><!--./col-md-8--> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-eq ptt10">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('appointment') . " " . $this->lang->line('date'); ?></label>
                                                <small class="req">*</small>
                                                <input id="revisit_date" name="appointment_date" placeholder="" type="text" class="form-control datetime"   />
                                                <span class="text-danger"><?php echo form_error('appointment_date'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile">
                                                    <?php echo $this->lang->line('case'); ?></label>
                                                <div><input class="form-control" type='text' id="revisit_case" name='revisit_case' />
                                                </div>
                                                <span class="text-danger"><?php echo form_error('case'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">
<?php echo $this->lang->line('casualty'); ?></label>
                                                <div>
                                                    <select name="casualty" id="revisit_casualty" class="form-control">
                                                        <option value="<?php echo $this->lang->line('yes') ?>"><?php echo $this->lang->line('yes') ?></option>
                                                        <option value="<?php echo $this->lang->line('no') ?>" selected><?php echo $this->lang->line('no') ?></option>
                                                    </select>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('casualty'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">
<?php echo $this->lang->line('old') . " " . $this->lang->line('patient'); ?></label>
                                                <div>
                                                    <select name="old_patient" id="revisit_old_patient" class="form-control">
                                                        <option value="<?php echo $this->lang->line('yes') ?>"><?php echo $this->lang->line('yes') ?></option>
                                                        <option value="<?php echo $this->lang->line('no') ?>" selected><?php echo $this->lang->line('no') ?></option>
                                                    </select>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('old_patient'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">
<?php echo $this->lang->line('organisation'); ?></label>
                                                <div><select class="form-control" name='organisation_name' id="revisit_organisation" >
                                                        <option value=""><?php echo $this->lang->line('select') ?></option>
<?php foreach ($organisation as $orgkey => $orgvalue) {
    ?>
                                                            <option value="<?php echo $orgvalue["id"]; ?>"><?php echo $orgvalue["organisation_name"] ?></option>   
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('organisation_name'); ?></span>
                                            </div>
                                        </div> 
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">
                                                    <?php echo $this->lang->line('refference'); ?></label>
                                                <div><input class="form-control" id="revisit_refference" type='text' name='refference' />
                                                </div>
                                                <span class="text-danger"><?php echo form_error('refference'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile">
<?php echo $this->lang->line('consultant') . " " . $this->lang->line('doctor'); ?></label>
                                                <div><select class="form-control" name='consultant_doctor' id="revisit_doctor">
                                                        <option value=""><?php echo $this->lang->line('select') ?></option>
<?php foreach ($doctors as $dkey => $dvalue) {
    ?>
                                                            <option value="<?php echo $dvalue["id"]; ?>"><?php echo $dvalue["name"] . " " . $dvalue["surname"] ?></option>   
<?php } ?>
                                                    </select>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('refference'); ?></span>
                                            </div>
                                        </div> 
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('amount'); ?> <?php echo '(' . $currency_symbol . ')'; ?></label> 
                                                <input name="amount" type="text" class="form-control" id="revisit_amount" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('payment') . " " . $this->lang->line('mode'); ?></label> 
                                                <select name="payment_mode" id="revisit_payment" class="form-control">

<?php foreach ($payment_mode as $payment_key => $payment_value) {
    ?>
                                                        <option value="<?php echo $payment_key ?>" <?php
    if ($payment_key == 'cash') {
        echo "selected";
    }
    ?> ><?php echo $payment_value ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div><!--./row-->   
                            <div class="row">            
                                <div class="box-footer">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                                    </div>
                                </div>
                            </div><!--./row-->  
                        </form>                       
                    </div><!--./col-md-12-->       

                </div><!--./row--> 

            </div>

        </div>
    </div>    
</div>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        $(function () {
            var hash = window.location.hash;
            hash && $('ul.nav-tabs a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });
        });

    });
    $(function () {
        $("#compose-textarea,#compose-textareas").wysihtml5();
    });
    function edit_prescription(id, opdid) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/prescription/editPrescription/' + id + '/' + opdid,
            success: function (res) {
                $('#prescriptionview').modal('hide');
                $("#editdetails_prescription").html(res);
            },
            error: function () {
                alert("Fail")
            }
        });
    }

    function getRecord(id, opdid) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getDetails',
            type: "POST",
            data: {patient_id: id, opd_id: opdid},
            dataType: 'json',
            success: function (data) {
                $("#patient_name").html(data.patient_name);
                $("#patients_id").html(data.patient_unique_id);
                $("#guardian_name").html(data.guardian_name);
                $("#gen").html(data.gender);
                $("#marital_status").html(data.marital_status);
                $("#contact").html(data.mobileno);
                $("#email").html(data.email);
                $("#patient_address").html(data.address);
                var age = '';
                var month = '';
                if (data.age != '') {
                    age = data.age + ' Year ';
                }

                if (data.month != '') {
                    month = data.month + ' Month ';
                }
                $("#age").html(age + month);
                $("#blood_group").html(data.blood_group);
                $("#height").html(data.height);
                $("#weight").html(data.weight);
                $('#patient_bp').html(data.bp);
                $("#symptoms").html(data.symptoms);
                $("#known_allergies").html(data.known_allergies);
                $("#appointment_date").html(data.appointment_date);
                $("#case").html(data.case_type);
                $("#casualty").html(data.casualty);
                $("#old_patient").html(data.old_patient);
                $("#doc").html(data.name + " " + data.surname);
                $("#organisation").html(data.organisation_name);
                $("#refference").html(data.refference);
                $("#amount").html(data.amount);
                $("#payment_mode").html(data.payment_mode);
                $("#opdid").val(data.opdid);
                $("#opd_no").html(data.opd_no);
                $("#note").html(data.note);
                var patient_id = "<?php echo $result["id"] ?>";
                $('#edit_delete').html("<?php if ($this->rbac->hasPrivilege('revisit', 'can_edit')) { ?><a href='#'' onclick='editRecord(" + id + "," + opdid + ")' data-target='#editModal' data-toggle='tooltip'  data-original-title='<?php echo $this->lang->line('edit'); ?>'><i class='fa fa-pencil'></i></a><?php } ?><?php if ($this->rbac->hasPrivilege('revisit', 'can_delete')) { ?><a href='#' data-toggle='tooltip'  onclick='delete_record(" + opdid + ")' data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a><?php } ?>");
                holdModal('viewModal');

            },
        });
    }

    function delete_record(opdid) {
        if (confirm(<?php echo "'" . $this->lang->line('delete_conform') . "'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deleteOPD',
                type: "POST",
                data: {opdid: opdid},
                dataType: 'json',
                success: function (data) {
                    successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                    window.location.reload(true);
                }
            })
        }
    }

    function delete_patient(id) {
        if (confirm(<?php echo "'" . $this->lang->line('delete_conform') . "'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deleteOPDPatient',
                type: "POST",
                data: {id: id},
                dataType: 'json',
                success: function (data) {
                    successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                    window.location.href = '<?php echo base_url() ?>admin/patient/reg_search';
                }
            })
        }
    }
    function getEditRecord(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getDetails',
            type: "POST",
            data: {patient_id: id},
            dataType: 'json',
            success: function (data) {
                //alert('Hiiii');
				 console.log(data);
                $("#patientids").val(data.patient_unique_id);
                $("#pname_id").val(data.patient_name);
				$("#gname_id").val(data.guardian_name);
                $("#phone_id").val(data.mobileno);
                $("#test_price_id").val(data.test_price);
                $("#ages").val(data.age);
                $("#address").text(data.address);
                $("#months").val(data.month);
                $("#amounts").val(data.amount);
                $("#myupdated_id").val(data.id);
                $('select[id="blood_groups"] option[value="' + data.blood_group + '"]').attr("selected", "selected");
                $('select[id="genders"] option[value="' + data.gender + '"]').attr("selected", "selected");
                $('select[id="marital_statuss"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                $('select[id="consultant_doctors"] option[value="' + data.cons_doctor + '"]').attr("selected", "selected");
                holdModal('myModaledit');

            },
        });
    }

    function getRoundForPrint(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getDetails',
            type: "POST",
            data: {patient_id: id},
            dataType: 'json',
            success: function (data) {
                //alert('Hiiii');

                $("#unique_id").val(data.patient_unique_id);
                $("#patient_names").val(data.patient_name);
                $("#contacts").val(data.mobileno);
                $("#emails").val(data.email);
                $("#ages").val(data.age);
                $("#address").text(data.address);
                $("#months").val(data.month);
                $("#guardian_names").val(data.guardian_name);
                $("#amounts").val(data.amount);
                $("#updateids").val(id);
                $('select[id="blood_groups"] option[value="' + data.blood_group + '"]').attr("selected", "selected");
                $('select[id="genders"] option[value="' + data.gender + '"]').attr("selected", "selected");
                $('select[id="marital_statuss"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                $('select[id="consultant_doctors"] option[value="' + data.cons_doctor + '"]').attr("selected", "selected");
                holdModal('print_for_each_round');

            },
        });
    }

    $(document).ready(function (e) {
        $("#printforeachid").on('submit', (function (e) {
        // var $round=$("#updateids").val();
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/print_each',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                },
                error: function () {
                    //  alert("Faild")
                    console.log("Faild!!!, please try again!!!");
                }
            });
        }));
    });

    $(document).ready(function (e) {
        $("#formeditrecord").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/update',
                type: "POST",
                data: new FormData(this), 
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                },
                error: function () {
                    //  alert("Fail")
                }
            });
        }));
    });
    function getRecord_id(id) {
        $('#prescription_id').val(id);
        $('#pres_patient_id').val(id);
        holdModal('add_prescription');
    }
    function editRecord(id, opdid) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/opd_details',
            type: "POST",
            data: {recordid: id, opdid: opdid},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $("#patientid").val(data.patient_id);
                $("#patientname").val(data.patient_name);
                $("#appointmentdate").val(data.appointment_date);
                $("#edit_case").val(data.case_type);
                $("#edit_symptoms").val(data.symptoms);
                $("#edit_casualty").val(data.casualty);
                $("#edit_knownallergies").val(data.known_allergies);
                $("#edit_refference").val(data.refference);
                $("#edit_consdoctor").val(data.cons_doctor);
                $("#edit_amount").val(data.amount);
                $("#edit_oldpatient").val(data.old_patient);
                $("#edit_organisation").val(data.organisation);
                $("#edit_height").val(data.height);
                $("#edit_weight").val(data.weight);
                $("#edit_bp").val(data.bp);
                $("#edit_paymentmode").val(data.payment_mode);
                $("#edit_opdid").val(opdid);
                $("#viewModal").modal('hide');

                $(".select2").select2().select2('val', data.cons_doctor);
                holdModal('editModal');
            },
        });
    }
    $(document).ready(function (e) {
        $("#formedit").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/opd_detail_update',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                },
                error: function () {
                    //  alert("Fail")
                }
            });
        }));
    });
    $(document).ready(function (e) {
        $("#form_prescription").on('submit', (function (e) {
            //var student_id = $("#student_id").val();
            //alert("hii");
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/add_prescription',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                },
                error: function () {
                    //alert("Fail")
                }
            });
        }));
    });

    $(document).ready(function (e) {
        $("#form_diagnosis").on('submit', (function (e) {
            //var student_id = $("#student_id").val();
            //alert("hii");
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/add_diagnosis',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        //toastr.error(message);
                        //toastr.info('Page Loaded!');
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                },
                error: function () {
                    //  alert("Fail")
                }
            });
        }));
    });
    function add_more() {
        var div = "<div id=row1><div class=col-sm-4><div class=form-group><input type=text name='medicine[]' class=form-control id=report_type /></div></div><div class=col-sm-4><div class=form-group><input type=text class=form-control name='dosage[]' id=report_document /></div></div><div class=col-sm-4><div class=form-group><textarea style='height:28px' name='instruction[]' class=form-control id=description></textarea></div></div></div>";

        var table = document.getElementById("tableID");
        var table_len = (table.rows.length);
        var id = parseInt(table_len);
        var row = table.insertRow(table_len).outerHTML = "<tr id='row" + id + "'><td>" + div + "</td><td><button type='button' onclick='delete_row(" + id + ")' class='modaltableclosebtn sss'><i class='fa fa-remove'></i></button></td></tr>";
    }
    function delete_row(id) {
        var table = document.getElementById("tableID");
        var rowCount = table.rows.length;
        $("#row" + id).html("");
        //table.deleteRow(id);
    }
    $(document).ready(function (e) {
        $("#add_timeline").on('submit', (function (e) {
            var patient_id = $("#patient_id").val();
            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("admin/timeline/add_patient_timeline") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        $.ajax({
                            url: '<?php echo base_url(); ?>admin/timeline/patient_timeline/' + patient_id,
                            success: function (res) {
                                $('#timeline_list').html(res);
                                $('#myTimelineModal').modal('toggle');
                            },
                            error: function () {
                                alert("Fail")
                            }
                        });
                        //window.location.reload(true);
                    }
                },
                error: function (e) {
                    alert("Fail");
                    console.log(e);
                }
            });
        }));
    });
    function delete_timeline(id) {
        var patient_id = $("#patient_id").val();
        if (confirm('<?php echo $this->lang->line("delete_conform") ?>')) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/timeline/delete_patient_timeline/' + id,
                success: function (res) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/timeline/patient_timeline/' + patient_id,
                        success: function (res) {

                            $('#timeline_list').html(res);
                            successMsg('<?php echo $this->lang->line('delete_message') ?>');
                        },
                        error: function () {
                            alert("Fail")
                        }
                    });
                },
                error: function () {
                    alert("Fail")
                }
            });
        }
    }

    function view_prescription(id, opdid) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/prescription/getPrescription/' + id + '/' + opdid,
            success: function (res) {
                $("#getdetails_prescription").html(res);
            },
            error: function () {
                alert("Fail")
            }
        });
        $('#edit_deleteprescription').html("<?php if ($this->rbac->hasPrivilege('prescription', 'can_view')) { ?><a href='#'' onclick='printprescription(" + id + "," + opdid + ")'   data-original-title='<?php echo $this->lang->line('print'); ?>'><i class='fa fa-print'></i></a><?php } ?><?php if ($this->rbac->hasPrivilege('prescription', 'can_edit')) { ?><a href='#'' onclick='edit_prescription(" + id + "," + opdid + ")' data-target='#edit_prescription' data-toggle='modal'  data-original-title='<?php echo $this->lang->line('edit'); ?>'><i class='fa fa-pencil'></i></a><?php } if ($this->rbac->hasPrivilege('prescription', 'can_delete')) { ?><a onclick='delete_prescription(" + id + "," + opdid + ")'  href='#'  data-toggle='tooltip'  data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a><?php } ?>");
        holdModal('prescriptionview');
    }
</script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#formrevisit").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/add_revisit',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    if (data.status == "fail") {

                        var message = "";
                        $.each(data.error, function (index, value) {

                            message += value;
                        });
                        errorMsg(message);
                    } else {

                        successMsg(data.message);
                        window.location.reload(true);
                    }

                },
                error: function () {
                    //  alert("Fail")
                }
            });


        }));
    });


    function getRevisitRecord(id) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getDetails',
            type: "POST",
            data: {patient_id: id},
            dataType: 'json',
            success: function (data) {
                $("#revisit_id").val(data.patient_unique_id);
                $("#revisit_name").val(data.patient_name);
                $('#revisit_guardian').val(data.guardian_name);
                $("#revisit_contact").val(data.mobileno);
                // $("#revisit_date").val(data.appointment_date);
                $("#revisit_case").val(data.case_type);
                $("#revisit_organisation").val(data.orgid);
                $("#pid").val(id);
                $("#revisit_allergies").val(data.known_allergies);
                $("#revisit_refference").val(data.refference);
                $("#revisit_email").val(data.email);
                // $("#revisit_amount").val(data.amount);
                $("#revisit_symptoms").val(data.symptoms);
                $("#revisit_age").val(data.age);
                $("#revisit_month").val(data.month);
                $("#revisit_height").val(data.height);
                // $("#revisit_weight").val(data.weight);
                // $("#revisit_bp").val(data.bp);
                $("#revisit_blood_group").val(data.blood_group);
                $("#revisi_tax").val(data.tax);
                $("#revisit_address").val(data.address);
                $("#revisit_note").val(data.note_remark);
                // $("#revisit_casualty").val(data.casualty);
                $('select[id="revisit_old_patient"] option[value="' + data.old_patient + '"]').attr("selected", "selected");
                $('select[id="revisit_doctor"] option[value="' + data.cons_doctor + '"]').attr("selected", "selected");
                // $('select[id="revisit_payment"] option[value="' + data.payment_mode + '"]').attr("selected", "selected");
                $('select[id="revisit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                $('select[id="revisit_marital_status"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                holdModal('revisitModal');
            },

        })

    }
    function printprescription(id, opdid) {
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            url: base_url + 'admin/prescription/getPrescription/' + id + '/' + opdid,
            type: 'POST',
            data: {payslipid: id, print: 'yes'},
            //dataType: "json",
            success: function (result) {
                $("#testdata").html(result);
                popup(result);
            }
        });
    }
    function popup(data) {
        var base_url = '<?php echo base_url() ?>';
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
        return true;
    }
    function holdModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }


    function deleteOpdPatientDiagnosis(patient_id, id) {
        if (confirm(<?php echo "'" . $this->lang->line('delete_conform') . "'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deleteOpdPatientDiagnosis/' + patient_id + '/' + id,
                success: function (res) {
                    successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                    window.location.reload(true);
                }
            })
        }
    }

    function deleteOpdPatientDiagnosis1(url, Msg) {
        if (confirm(<?php echo "'" . $this->lang->line('delete_conform') . "'"; ?>)) {
            $.ajax({
                url: url,
                success: function (res) {
                    successMsg(Msg);
                    window.location.reload(true);
                }
            })
        }
    }
    function printedBill(patientid, ipdid) {
        var total_amount = $("#total_amount").val();
        var discount = $("#discount").val();
        var other_charge = $("#other_charge").val();
        var gross_total = $("#gross_total").val();
        var tax = $("#tax").val();
        var net_amount = $("#net_amount").val();
        var status = $("#status").val();
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            url: base_url + 'admin/payment/getBill/',
            type: 'POST',
            data: {patient_id: patientid, ipdid: ipdid, total_amount: total_amount, discount: discount, other_charge: other_charge, gross_total: gross_total, tax: tax, net_amount: net_amount, status: status},
            success: function (result) {
                $("#testdata").html(result);
                popup(result);
            }
        });
    }
//newly added by Rasikh Jan in Sep 11 2021
   
</script>