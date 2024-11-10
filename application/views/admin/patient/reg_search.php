<?php
$this->load->helper('menu_helper');
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$genderList = $this->customlib->getGender();
?>
<?php echo $pagination; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.5.1/jspdf.plugin.autotable.min.js"></script>  

<style type="text/css">

    #easySelectable {/*display: flex; flex-wrap: wrap;*/}
    #easySelectable li {}
    #easySelectable li.es-selected {background: #2196F3; color: #fff;}
    .easySelectable {-webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;}
    .dis{display: none;}
    .table3 tr td:nth-child(2) input {
    font-size: 18px !important;
    font-family: Consolas, Monaco, Courier New, Courier, monospace;
}


/* Ensure pagination is RTL */
.pagination {
    direction: rtl;
    display: flex;
    justify-content: flex-start; /* Start pagination from the right */
}

.pagination li {
    margin: 0 3px;
}

.pagination li a, .pagination li span {
    display: inline-block;
    padding: 2px 4px;
    text-decoration: none;
    background-color: #f8f9fa;
}

.pagination li.active span {
    background-color: #007bff;
    color: #fff;
}

.record-pagination-container {
    display: flex;
    justify-content: space-between; /* Distribute space between the two elements */
    align-items: center; /* Align vertically centered */
    color: #007bff
}

.record-pagination-container-one {
    display: flex;
    justify-content: space-between; /* Distribute space between the two elements */
    align-items: center; /* Align vertically centered */
    margin-left: 19px;
}

.content-wrapper{
    margin-top: -80px;
}
.custom-thead th {
        background-color: lightblue !important; /* Dark background */
        font-weight: bold;         /* Bold text */
        padding: 8px 12px;         /* Padding for spacing */
        text-align: center;        /* Center the text */
        border: 1px solid #dee2e6; /* Border for cell separation */
        white-space: nowrap;       /* Prevent text wrapping */
        overflow: hidden ;          /* Hide overflow if text is too long */
        text-overflow: ellipsis;   /* Add ellipsis for long text */
    }
    .custom-tbody tr {
    padding: 8px 12px;         /* Padding for spacing */
    text-align: center;        /* Center the text */
    border: 1px solid #dee2e6; /* Border for cell separation */
    white-space: nowrap;       /* Prevent text wrapping */
    overflow: hidden !important;          /* Hide overflow if text is too long */
    text-overflow: hidden;   /* Add ellipsis for long text */
}
.address-td{
    width: 150px;
    overflow-x: scroll !important;

}
</style> 
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class=" box box-primary">
                    <div class="box-header with-border ">
                        <?php if ($title == 'old_patient') { ?>
                                <h3 class="box-title titlefix"><?php echo $this->lang->line('opd') . " " . $this->lang->line('old') . " " . $this->lang->line('patient') ?></h3>
                        <?php } else { ?>
                                <h3 class="box-title titlefix">لیست داکتران مراجعه کننده</h3>

                        <?php } ?>
                           
                    </div><!-- /.box-header -->

                    
                    <?php
                    if (isset($resultlist)) {
                        ?>
                        <div class="box-body table-responsive">
                        <div class="buttons" style="margin: 10px">
                        <!-- <a  href="<?php echo base_url('admin/patient/getAllDoctors') ?>" class="btn btn-success btn-sm"><i class="fa fa-list">&nbsp; </i>لیست مجموعی داکتران </a>  -->
                       
                            <?php if ($this->rbac->hasPrivilege($title, 'can_add')) { ?>  
                                    <a  id="add" href="<?php echo base_url('admin/patient/createPatient') ?>" class="btn btn-primary btn-md" style="margin-bottom: 10px; border-radius: 8px;"><i class="fa fa-plus"></i>  <?php echo $this->lang->line('add') . " داکتر" ?></a> 
                                    <a  href="<?php echo base_url('admin/patient/opd_report') ?>" class="btn btn-success btn-md" style="margin-bottom: 10px; border-radius: 8px;"><i class="fa fa-list">&nbsp; </i> عواید</a> 
                                    <a  href="<?php echo base_url('admin/patient/teethlist') ?>" class="btn btn-warning btn-md" style="margin-bottom: 10px; border-radius: 8px;"><i class="fa fa-list">&nbsp; </i> مصارف</a> 
                                    <button type="button" class="btn btn-success btn-md" style="margin-bottom: 10px; border-radius: 8px; margin-right: 10px" onclick="exportToExcel(this)">
                                    <i class="fa fa-list">&nbsp; </i>دانلود به اکسل
                                </button>
                            <?php } ?> 
                        </div> 
                                <table class="table table-bordered border-primary table-hover custom-table">
                                    <thead class="custom-thead">
                                        <tr>
                                            <th>آی دی</th>
                                            <th>نام و تخلص</th>
                                            <th>سن</th>
                                            <th>حالت جنسی</th>
                                            <th>آدرس</th>
                                            <th> تاریخ مراجعه</th>
                                            <!-- <th>OPD</th> -->
                                            <th>  آخرین رسید</th>
                                            <th>دوره ها</th>
                                            <th>باقیات</th>
                                            <th >ملاحظات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="custom-tbody">
                                        <?php
                                        // print_r($resultlist); die();
                                        if (!empty($resultlist)) {
                                            $count = 1;
                                            foreach ($resultlist as $student) {
                                                $should_pay = get_total_should_pay($student['id']);
                                                $paid = get_last_amount($student['id']);
                                                $alarm = $paid;
                                                ?>
                                                <tr>
                                                    <td><?php echo $student["hmis_no"] ?></td>
                                                    <td>
                                                        <a  href="<?php echo base_url(); ?>admin/patient/profile/<?php echo $student['id']; ?>"><?php echo $student['patient_name']; ?>             <?php echo $student['guardian_name']; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $student['age']; ?> سال </td> 
                                                    <td><?php echo $student['gender']; ?></td> 
                                                    <td><div class="address-td"><?php echo $student['province']; ?>، <?php echo $student['district']; ?>، <?php echo $student['address']; ?></div> </td> 
                                                    <td><?php echo $student['day']; ?>-<?php echo $student['month']; ?>-<?php echo $student['dob']; ?> </td>
                                                    <td><?php echo get_last_amount($student['id']); ?></td>
                                                    <td align="center" ><?php echo $student['total_visit'] - 1; ?> 
                                                    </td>   
                                                    <td align="center"><?php
                                                    if (($should_pay - $paid) >= 20000) {
                                                        echo '<span class="label label-danger"> اخطاریه</span>';
                                                    } else if (($should_pay - $paid) == 0) {
                                                        echo '<span class="label label-success">تصفیه شده</span>';
                                                    } else if (($should_pay - $paid) < 0) {
                                                        echo '<span class="label label-default">طلبکار</span>';
                                                    } else {
                                                        echo '<span class="label label-warning">' . ($should_pay - $paid) . '</span>';
                                                    } ?> </td> 
                                                    <td>
                                                    <?php if ($this->rbac->hasPrivilege('revisit', 'can_add')) { ?>
                                                            <!-- <a  target="_blank" href="<?php echo base_url(); ?>admin/patient/print_bill/<?php echo $student['id'] ?>" class="btn btn-sucess btn-primary btn-sm" data-toggle="tooltip" title="Print Registered Bill" ><i class="fas fa-print"></i></a> -->
                                                            <a href="#" onclick="edit_patient('<?php echo $student['id'] ?>')" class="btn btn-dollar btn-sm"  data-toggle="tooltip" title="اضافه کردن رسید">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            <a href="#" onclick="getExamination('<?php echo $student['id'] ?>');" class="btn <?php if ($student['is_examined'] == 1)
                                                                   echo 'btn-primary btn-sm';
                                                               else
                                                                   echo 'btn-default'; ?>" data-toggle="tooltip" title="اضافه کردن  نوع ساخت دندان" >
                                                                <i class="fa fa-flask"></i>
                                                            </a>
                                                    <?php } ?> 
                                                    <?php if ($this->rbac->hasPrivilege($title, 'can_view')) { ?>
                                                            <a href="<?php echo base_url(); ?>admin/patient/profile/<?php echo $student['id'] ?>" class="btn btn-default"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                                <i class="fa fa-reorder"></i>
                                                            </a>

                                                        <!-- <a target="_blank" href="<?php echo base_url(); ?>admin/patient/print/<?php echo $student['id'] ?>/<?php echo $student['total_visit']; ?>" class="btn <?php if ($student['is_printed'] == 1)
                                                                     echo 'btn-success btn-sm';
                                                                 else
                                                                     echo 'btn-default'; ?>" data-toggle="tooltip" title="Print Examination">
                                                <i class="fas fa-print"></i>
                                            </a>   -->
                                                <?php } ?>

                                                    </td>
                                                </tr>
                                                        <?php
                                                        $count++;
                                            } //end of foreach
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                 <!-- Pagination Links -->
                                <!-- Display record count -->
                                <div class="record-pagination-container-one">
                                    <div>
                                        <?php echo $pagination; ?>
                                    </div>
                                    <div>
                                        <?php echo "ثبت {$start_record} الی {$end_record} از مجموع {$total_records} داکتران"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>  
            </div>
        </div> 
    </section>
</div>
<!-- myModal -->
<!-- Edit Patient -->
<div class="modal fade" id="edi_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="margin-top: -11px" >
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 aa class="box-title"> <?php echo $this->lang->line('patient') . " " . $this->lang->line('information'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <form id="formrevisit"   accept-charset="utf-8"   enctype="multipart/form-data" method="post" >
                            <div class="row row-eq">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="row ptt10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>آی دی مراجعه کننده</label> 
                                                <input id="revisit_id" disabled name="patient_id" placeholder="" type="text" class="form-control"  value="<?php echo set_value('roll_no'); ?>" />
                                                <span class="text-danger"><?php echo form_error('patient_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>نمبر مسلسل</label> 
                                                <input id="id_number"  name="id_number" placeholder="" type="number" class="form-control"  value="<?php echo set_value('roll_no'); ?>" />
                                                <span class="text-danger"><?php echo form_error('patient_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small> 
                                                <input id="revisit_name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                                <input type="hidden" name="id" id="pid">
                                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>تخلص</label>
                                                <input type="text" name="guardian_name" value="<?php echo set_value('guardian_name'); ?>" class="form-control" id="guardian_id">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label> <?php echo $this->lang->line('gender'); ?></label>
                                                <select class="form-control" name="gender" id="revisit_gender">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <option vallue="مذکر"> مذکر</option>
                                                    <option vallue="مونثت"> مونث</option>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="text" name="age" value="<?php echo set_value('age'); ?>" class="form-control" id="age">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>نوعیت ساخت</label>
                                                 <input type="text" name="type" value="<?php echo set_value('test_name'); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label> <?php echo $this->lang->line('address'); ?></label>
                                                <input type="text" id="revisit_address" name="address" value="<?php echo set_value('address'); ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div><!--./row--> 
                                </div><!--./col-md-8--> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-eq ptt10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>روز</label>
                                            <div class="form-group">
                                            <select name="day" class="form-control" required>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> </option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>ماه</label>
                                            <div class="form-group">
                                            <select name="month" class="form-control" required>
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
                                        <div class="col-md-4">
                                            <label>سال</label>
                                            <div class="form-group">
                                            <select name="year" class="form-control" required>
                                            <?php
                                            for ($i = 1395; $i <= 1405; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> </option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile">
                                                        <?php echo $this->lang->line('consultant'); ?> گیرنده</label>
                                                <div><select class="form-control" name='consultant_doctor' id="revisit_doctor">
                                                        <option readonly  value=""><?php echo $this->lang->line('select') ?></option>
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
                                                <label for="pwd">مبلغ رسید به عدد <?php echo '(' . $currency_symbol . ')'; ?></label> 
                                                <input name="amount" type="number" value="0" class="form-control" id="revisit_amount" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="pwd">مبلغ رسید به حروف<?php echo '(' . $currency_symbol . ')'; ?></label>             
                                                 <input type="text" name="payment_mode" id="revisit_payment" class="form-control" >
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
<!-- dd -->
<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="margin-top: -11px" >
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">  <?php echo $this->lang->line('patient') . " " . $this->lang->line('information'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form id="formedit" accept-charset="utf-8"  enctype="multipart/form-data" method="post"  class="ptt10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small> 
                                        <input id="patient_name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                        <input type="hidden" id="updateid" name="updateid">
                                        <input type="hidden" id="opdid" name="opdid">
                                        <span class="text-danger"><?php echo form_error('name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('guardian_name'); ?></label>
                                        <input type="text" id="guardian_name" name="guardian_name" value="<?php echo set_value('guardian_name'); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('gender'); ?></label><small class="req"> *</small> 
                                        <select class="form-control" id="gender" name="gender">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
<?php
foreach ($genderList as $key => $value) {
    ?>
                                                    <option value="<?php echo $key; ?>" <?php if (set_value('gender') == $key)
                                                           echo "selected"; ?>><?php echo $value; ?></option>
        <?php
}
?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('gender'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('marital_status'); ?></label>
                                        <select name="marital_status" id="marital_status" class="form-control">
                                            <option value=""><?php echo $this->lang->line('select') ?></option>
<?php foreach ($marital_status as $mkey => $mvalue) {
    ?>
                                                    <option value="<?php echo $mkey ?>"><?php echo $mvalue ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">
<?php echo $this->lang->line('patient') . " " . $this->lang->line('photo'); ?></label>
                                        <div><input class="filestyle form-control" type='file' name='file' id="file" size='20' />
                                            <input type="hidden" name="patient_photo" id="patient_photo">
                                        </div>
                                        <span class="text-danger"><?php echo form_error('file'); ?></span>
                                    </div>
                                </div>  
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('email'); ?></label>
                                        <input type="text" id="email" value="<?php echo set_value('email'); ?>" name="email" class="form-control">
                                    </div>
                                </div> 
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('phone'); ?></label>
                                        <input id="contact" autocomplete="off" name="contact" placeholder="" type="text" class="form-control"  value="<?php echo set_value('contact'); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> <?php echo $this->lang->line('blood_group'); ?></label><small class="req"> *</small> 
                                        <select class="form-control" id="blood_group" name="blood_group">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
<?php
foreach ($bloodgroup as $key => $value) {
    ?>
                                                    <option value="<?php echo $value; ?>" <?php if (set_value('blood_group') == $key)
                                                           echo "selected"; ?>><?php echo $value; ?></option>
        <?php
}
?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('blood_group'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('age'); ?></label>
                                        <div style="clear: both;overflow: hidden;">
                                            <input type="text" placeholder="Age" id="age" name="age" value="<?php echo set_value('age'); ?>" class="form-control" style="width: 40%; float: left;">
                                            <input type="text" placeholder="Month" id="month" name="month" value="<?php echo set_value('month'); ?>" class="form-control" style="width: 56%;float: left; margin-left: 5px;">
                                        </div>
                                    </div>
                                </div> 

                            </div><!--./row-->   
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </form>                       
                    </div><!--./col-md-12-->       
                </div><!--./row--> 
            </div>
            <div class="box-footer">
                <div class="pull-right paddA10">

                       <!--  <a  onclick="saveEnquiry()" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></a> -->
                </div>
            </div>
        </div>
    </div>    
</div>


<!-- examinationModal -->
<div class="modal fade" id="examinationModal"  role="dialog" aria-labelledby="examinationModal">
    <div class="modal-dialog modal-lg" role="document" style="margin-top: -11px" >
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">اضافه کردن نوع ساخت دندان</h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form  accept-charset="utf-8" action="<?php echo base_url() . "admin/patient/addExamination" ?>" enctype="multipart/form-data" method="post">
                            <input id="ex_id" name="ex_id" type="hidden" />
                            <input id="round" name="round" type="hidden" />
                            <div class="row row-eq">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row ptt10">
                                        <!-- <div class="col-md-1">
                                            <div class="form-group">
                                                <label>آی دی نمبر</label><small class="req"> *</small> 
                                                <input id="ex_no" name="no" type="text" class="form-control" disabled="disabled" />
                                                <span class="text-danger"><?php echo form_error('no'); ?></span>
                                            </div>
                                        </div> -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>نام داکتر</label><small class="req"> *</small> 
                                                <input id="ex_name" name="patient_name" type="text" class="form-control" disabled="disabled" />
                                                <span class="text-danger"><?php echo form_error('patient_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>قمت پورسیلین<label>
                                                <input id="test_price_id" name="test_price" type="text" class="form-control" disabled="disabled" />
                                                <span class="text-danger"><?php echo form_error('test_price'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>روز</label>
                                            <div class="form-group">
                                            <select name="day" class="form-control" required>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> </option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>ماه</label>
                                            <div class="form-group">
                                            <select name="month" class="form-control" required>
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
                                        <div class="col-md-2">
                                            <label>سال</label>
                                            <div class="form-group">
                                            <select name="year" class="form-control" required>
                                            <?php
                                            for ($i = 1395; $i <= 1405; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> </option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                            <div class="form-group">
                                                <label>شماره مسلسل</label><small class="req"> *</small> 
                                                <input name="patient_unique_id" type="text" class="form-control" placeholder="30001" required />
                                                <span class="text-danger"><?php echo form_error('patient_name'); ?></span>
                                            </div>
                                        </div>
 
                                        <!-- end of textboxes -->
                                        <div class="col-md-12" style="margin-bottom: 44px;">
                                                <div class="col-md-3">
                                                <td>
                                                    <label>نوعیت ساخت  </label>
                                                    <select  name="allowance_type1" class="form-control" id="allowance_type1" onchange="bringLabconf('1');" style="font-size: 20px;">
                                                        <option  value="">انتخاب</option>
                                                        <?php
                                                        foreach ($labconf as $std) {
                                                            echo '<option value="' . $std['id'] . '">' . $std['test_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                </div>
                                                <div class="col-md-2">
                                                    <td>
                                                        <label>فی-افغانی</label>
                                                        <input class="form-control" type="number" id="allowance_amount1" name="allowance_amount1"  value="0" onkeyup="totalDue();" style="color: green; font-weight: bold; font-size: 24px;">
                                                    </td>
                                                </div>
                                                <div class="col-md-2">
                                                    <td>
                                                        <label>تعداد </label>
                                                        <input class="form-control" type="number" name="numbers" id="numbers"  value="0" onkeyup = totalDue(); style="color: green; font-weight: bold; font-size: 24px;">
                                                    </td>
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <label>تخفیف-افغانی </label>
                                                    <td>
                                                        <input class="form-control" type="number" name="discount1" id="discount_id"  value="0" onkeyup = totalDue(); style="color: red; font-weight: bold; font-size: 24px;">
                                                    </td>
                                                </div>
                                                <div class="col-md-3">
                                                    <td>
                                                        <label>مجموع-افغانی </label>
                                                        <input class="form-control"  type="number" name="amount_all" id="amount_all" value="0" style="color: green; font-weight: bold; font-size: 24px;">
                                                    </td>
                                                </div>
                                            </div>
                                        <div class="col-md-12" style="margin-bottom: 40px; font-size: 20px; color: black;">
                                             <!-- <button type="button" onclick="add_more('1');" id="addmore1"  ><i class="fa fa-plus"></i></button>
                                             <button type="button" class="btn btn-success" onclick="calculateamount();">جمع</button> -->
                                             <input type="hidden" name="ex_number" id="ex_number" readonly value="1">
                                            
                                             <div style="text-align: center;">
                                                <div class="col-md-4">چپ</div>
                                                <div class="col-md-4">موقعیت</div>
                                                <div class="col-md-4">راست</div>
                                            </div>
                                           <div class="sameheight">
                                                <div class="feebox">
                                                    <table class="table3" id="tableID">
                                                        <tr id="row1" style="text-align: center; font-size: 20px; font-weight: bold;  border-bottom-color: blue; border-bottom-style: solid !important ">
                                                            <td>
                                                                <input type="checkbox" name="checkbox8" id="checkbox8" value="1">8
                                                            </td>
                                                            <td>
                                                               <input type="checkbox" name="checkbox7" id="checkbox7" value="1">7
                                                             </td>
                                                             <td>
                                                                <input type="checkbox" name="checkbox6" id="checkbox6" value="1">6
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox5" id="checkbox5" value="1">5
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox4" id="checkbox4" value="1">4
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox3" id="checkbox3" value="1">3
                                                            </td>
                                                            
                                                            <td>
                                                                <input type="checkbox" name="checkbox2" id="checkbox2" value="1">2
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox1" id="checkbox1" value="1">1
                                                            </td>
                                                            
                                                            <td >
                                                                <div style=" hieght: 90px; -webkit-border-vertical-spacing: initial; height: 59px; padding-bottom: 69px; background-color: black; width: 4px;">|</div>
                                                             </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox9" id="checkbox9" value="1">1
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox10" id="checkbox10" value="1">2
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox11" id="checkbox11" value="1">3
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox12" id="checkbox12" value="1">4
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox13" id="checkbox13" value="1">5
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox14" id="checkbox14" value="1">6
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox15" id="checkbox15" value="1">7
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox16" id="checkbox16" value="1">8
                                                            </td>
                                                        </tr>

                                                        <tr id="row1"  style="text-align: center; font-size: 20px; font-weight: bold;">
                                                            <td>
                                                                <input type="checkbox" name="checkbox24" id="checkbox24" value="1">8
                                                            </td>
                                                            <td>
                                                               <input type="checkbox" name="checkbox23" id="checkbox23" value="1">7
                                                             </td>
                                                             <td>
                                                                <input type="checkbox" name="checkbox22" id="checkbox22" value="1">6
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox21" id="checkbox21" value="1">5
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox20" id="checkbox20" value="1">4
                                                            </td>
                                                             <td>
                                                                <input type="checkbox" name="checkbox19" id="checkbox19" value="1">3
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox18" id="checkbox18" value="1">2
                                                            </td>
                                                           <td>
                                                                <input type="checkbox" name="checkbox17" id="checkbox17" value="1">1
                                                            </td>
                                                            <td ><div style=" hieght: 90px; -webkit-border-vertical-spacing: initial; height: 59px; padding-bottom: 69px; background-color: black; width: 4px; margin-top: -15px">|</div>
                                                             </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox25" id="checkbox25" value="1">1
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox26" id="checkbox26" value="1">2
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox27" id="checkbox27" value="1">3
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox28" id="checkbox28" value="1">4
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox29" id="checkbox29" value="1">5
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox30" id="checkbox30" value="1">6
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox31" id="checkbox31" value="1">7
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="checkbox32" id="checkbox32" value="1">8
                                                            </td>
                                                        </tr> 
                                                    </table>  
                                                </div>
                                            </div>
                                    </div><!--./row--> 
                                </div>
                                <div style="margin-top: -12px; margin-bottom: -12px;" class="col-md-12">
                                <th>یاداداشت </th>
                                <td>
                                    <textarea style="width: 100%;"  type="text" value="یادداشت..." name="notes"></textarea>
                                </td>
                              </div>
                               </div> 
                                </div><!--./col-md-8-->
                                <div class="row">            
                                <div class="box-footer">
                                    <div class="pull-right">
                                       <!--  <button style="color: white;" type="submit" class="btn btn-info pull-right"><a href="<?php echo base_url(); ?>admin/patient/print/<?php echo $student['id'] ?>">Submit and Print</a></button> -->
                                       <button style="color: white; font-size: 25px;" type="submit" class="btn btn-info pull-right">ذخیره   </button>
                                       <button style="color: white; margin-left:20px; font-size: 20px;" type="button" class="btn btn-danger pull-right" data-dismiss="modal">برگشت </button>
                                    </div>
                                </div>
                            </div><!--./row-->  
                        </form> 
                </div><!--./row-->  
                </form>
                </div>  
            </div><!--./col-md-4-->
                                                  
                    </div><!--./col-md-12-->       
                </div><!--./row--> 
            </div>
        </div>
    </div>    
</div>
<!-- examintaionModal -->

<script type="text/javascript">

    $('#myModal').on('hidden.bs.modal', function (e) {
        $(this).find('#formadd')[0].reset();
    });

    $(function () {
        $('#easySelectable').easySelectable();
        $('.select2').select2()
//stopPropagation();
    })
// $('#easySelectable').bind('click', function (e) { e.stopPropagation() })
</script>


<script type="text/javascript">
            /*
             Author: kh.rasikh542@gmail.com
             */
                    (function ($) {
                        //selectable html elements
                        $.fn.easySelectable = function (options) {
                            var el = $(this);
                            var options = $.extend({
                                'item': 'li',
                                'state': true,
                                onSelecting: function (el) {

                                },
                                onSelected: function (el) {

                                },
                                onUnSelected: function (el) {

                                }
                            }, options);
                            el.on('dragstart', function (event) {
                                event.preventDefault();
                            });
                            el.off('mouseover');
                            el.addClass('easySelectable');
                            if (options.state) {
                                el.find(options.item).addClass('es-selectable');
                                el.on('mousedown', options.item, function (e) {
                                    $(this).trigger('start_select');
                                    var offset = $(this).offset();
                                    var hasClass = $(this).hasClass('es-selected');
                                    var prev_el = false;
                                    el.on('mouseover', options.item, function (e) {
                                        if (prev_el == $(this).index())
                                            return true;
                                        prev_el = $(this).index();
                                        var hasClass2 = $(this).hasClass('es-selected');
                                        if (!hasClass2) {
                                            $(this).addClass('es-selected').trigger('selected');
                                            el.trigger('selected');
                                            options.onSelecting($(this));
                                            options.onSelected($(this));
                                        } else {
                                            $(this).removeClass('es-selected').trigger('unselected');
                                            el.trigger('unselected');
                                            options.onSelecting($(this))
                                            options.onUnSelected($(this));
                                        }
                                    });
                                    if (!hasClass) {
                                        $(this).addClass('es-selected').trigger('selected');
                                        el.trigger('selected');
                                        options.onSelecting($(this));
                                        options.onSelected($(this));
                                    } else {
                                        $(this).removeClass('es-selected').trigger('unselected');
                                        el.trigger('unselected');
                                        options.onSelecting($(this));
                                        options.onUnSelected($(this));
                                    }
                                    var relativeX = (e.pageX - offset.left);
                                    var relativeY = (e.pageY - offset.top);
                                });
                                $(document).on('mouseup', function () {
                                    el.off('mouseover');
                                });
                            } else {
                                el.off('mousedown');
                            }
                        };
                    })(jQuery);

</script>

<script type="text/javascript">
            $(document).ready(function (e) {
                $("#formadd").on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/patient',
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
                        error: function (error) {
                              alert(error);
                        }
                    });
                }));
            });


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
                            console.log('sucess')
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
                            console.log('fail');
                        }
                    });


                }));
            });
            /**/

            $(document).ready(function (e) {
                $("#formedit").on('submit', (function (e) {
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

                $("#allowance_amount1").on('onchangeval', (function (e) {
                    $val = $('#allowance_amount1').val();
                    $total = $('#totalamount').val();
                    $('#totalamount').val($total+$val);
                
                }));

                $("#allowance_amount2").on('onchange', (function (e) {
                    $val = $('#allowance_amount2').val();
                    $total = $('#totalamount').val();
                    $('#totalamount').val($total+$val);
                
                }));
            });

            function getRecord(id) {

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/getDetails',
                    type: "POST",
                    data: {recordid: id},
//
                    dataType: 'json',
                    success: function (data) {

                        $("#patientid").val(data.patient_unique_id);
                        $("#patient_name").val(data.patient_name);
                        $("#contact").val(data.mobileno);
                        $("#email").val(data.email);
                        $("#age").val(data.age);
                        $("#bp").val(data.bp);
                        $("#month").val(data.month);
                        $("#guardian_name").val(data.guardian_name);
                        $("#appointment_date").val(data.appointment_date);
                        $("#case").val(data.case_type);
                        $("#symptoms").val(data.symptoms);
                        $("#known_allergies").val(data.known_allergies);
                        $("#refference").val(data.refference);
                        $("#amount").val(data.amount);
                        $("#tax").val(data.tax);
                        $("#opdid").val(data.opdid);
                        $("#address").val(data.address);
                        $("#note").val(data.note);
                        $("#height").val(data.height);
                        $("#weight").val(data.weight);
                        $("#updateid").val(id);
                        $('select[id="blood_group"] option[value="' + data.blood_group + '"]').attr("selected", "selected");
                        $('select[id="gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                        $('select[id="marital_status"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                        $('select[id="consultant_doctor"] option[value="' + data.cons_doctor + '"]').attr("selected", "selected");
                        $('select[id="payment_mode"] option[value="' + data.payment_mode + '"]').attr("selected", "selected");
                        $('select[id="casualty"] option[value="' + data.casualty + '"]').attr("selected", "selected");
                    },

                })



            }


            function edit_patient(id) {

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/getDetails',
                    type: "POST",
                    data: {patient_id: id},
                    dataType: 'json',
                    success: function (data) {
                        $("#revisit_id").val(data.patient_unique_id);
                        $("#revisit_name").val(data.patient_name);
                        $('#guardian_id').val(data.guardian_name);
                        $('#age').val(data.age);
                        $('#revisit_address').val(data.address);
                        $('#id_number').val(data.hmis_no);
                        $("#pid").val(id);
                        $("#revisit_allergies").val(data.known_allergies);
                        $('select[id="revisit_old_patient"] option[value="' + data.old_patient + '"]').attr("selected", "selected");
                        $('select[id="revisit_doctor"] option[value="' + data.cons_doctor + '"]').attr("selected", "selected");
                        $('select[id="revisit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                        $('select[id="revisit_marital_status"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                        holdModal('edi_model');
                    },

                })

            }
            function holdModal(modalId) {
               
                $('#'+modalId).modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
            }

            function bringOPD() {
                var id = $('#opd').val();
                
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/getOPD',
                    type: "POST",
                    data: {patient_id: id},
                    success: function (data) {
                        $('#opdval').html(data);
                        holdModal('myModal');
                    },

                })
            }

            function bringOPD2() {
                var id = $('#opd2').val();
                
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/getOPD',
                    type: "POST",
                    data: {patient_id: id},
                    success: function (data) {
                        $('#opdval2').html(data);
                        holdModal('edi_model');
                    },

                })
            }

            function getExamination(id) {
                $('#ex_id').val(id);
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/getPatientNo',
                    type: "POST",
                    dataType: 'json',
                    data: {patient_id: id},
                    success: function (data) {
                        $('#ex_no').val(data.patient_unique_id);
                        $('#ex_name').val(data.patient_name);
                        $('#referred_of_id').val(data.referred_of);
                        $('#referred_to_id').val(data.referred_to);
                        $('#test_price_id').val(data.test_price);
                        $('#id_number_ex').val(data.hmis_no);
                        $('#ex_date_id').val(data.ex_date);
                        $('#round').val(data.round);
                    },
                });
                holdModal('examinationModal');
            }

            function getPatientNursing(id) {
                $('#patient_id_nurse').val(id);
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/getPatientNo',
                    type: "POST",
                    dataType: 'json',
                    data: {patient_id: id},
                    success: function (data) {
                        $('#patient_id_nurse').val(id);
                        $('#patient_name_nurse').val(data.patient_name);
                        $('#entry_date_id').val(data.admission_date);
                    },

                });
                holdModal('patientNursingModal');
            }

            function bringLabconf(id=0) {
                if(id == 1)
                    $id = $('#allowance_type1').val();
                else if(id == 2)
                    $id = $('#allowance_type2').val();
                else if(id == 3)
                    $id = $('#allowance_type3').val();
                else if(id == 4)
                    $id = $('#allowance_type4').val();
                else if(id == 5)
                    $id = $('#allowance_type5').val();
                else if(id == 6)
                    $id = $('#allowance_type6').val();
                else if(id == 7)
                    $id = $('#allowance_type7').val();
                else if(id == 8)
                    $id = $('#allowance_type8').val();
                else if(id == 9)
                    $id = $('#allowance_type9').val();
                else if(id == 10)
                    $id = $('#allowance_type10').val();


                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/bringLabconf',
                    type: "POST",
                    data: {patient_id: $id},
                    success: function (data) {
                        if(id == 1){
                            $('#allowance_amount1').val(data);
                        }
                        else if(id == 2){
                            $('#allowance_amount2').val(data);
                        }
                        else if(id == 3){
                            $('#allowance_amount3').val(data);
                        }
                        else if(id == 4){
                            $('#allowance_amount4').val(data);
                        }
                        else if(id == 5){
                            $('#allowance_amount5').val(data);
                        }
                        else if(id == 6){
                            $('#allowance_amount6').val(data);
                        }
                        else if(id == 7){
                            $('#allowance_amount7').val(data);
                        }
                        else if(id == 8){
                            $('#allowance_amount8').val(data);
                        }
                        else if(id == 9){
                            $('#allowance_amount9').val(data);
                        }
                        else if(id == 10){
                            $('#allowance_amount10').val(data);
                        }
                        
                    },

                })
            }

            function totalDue(){
               var number = parseInt($('#numbers').val());
               var eachcost = parseInt($('#allowance_amount1').val());
               var discount = parseInt($('#discount_id').val());
               var total = (number*eachcost) - discount; 
               $('#amount_all').val(total);
            //    console.log("hello Dear Rasikh");
            }

  function exportToExcel(button) {
    button.disabled = true
    button.innerHTML = "درحال جستجو...";  
    $.ajax({
        url: '<?php echo base_url("admin/patient/get_reg_search_all"); ?>',  // Your server-side method URL
        type: 'POST',  // Changed to POST since we are sending data
        dataType: 'json',
        success: function(data) {
            if (data) {
                generateExcel(data);
            } else {
                console.error('No data received from the server');
            } 
            button.disabled = false;
            button.innerHTML = "دانلود به اکسل";  // Reset button text
        },
        error: function(xhr, status, error) {
            console.error('AJAX request failed:', status, error);
            console.error('Response:', xhr.responseText); 
            button.disabled = false;
            button.innerHTML = "دانلود به اکسل";  // Reset button text
        } 
    });
}

function generateExcel(data) {
    if (!data || !Array.isArray(data)) {
        console.error('Data is undefined, null, or not in the correct format.');
        return;
    }

    const propertyMapping = { 
        'id': 'آی دی',
        'full_name': 'نام و تخلص',
        'age': 'سن',
        'gender': 'حالت جنسی',
        'address': 'آدرس',
        'visit_date': 'تاریخ مراجعه',
        'last_receipt': 'آخرین رسید',
        'sessions': 'دوره ها',
        'balance': 'باقیات-افغانی',
        'mobileno': 'شماره تماس',
        'notes': 'ملاحظات',
    };
    const transformedData = data.map(student => {
        const shouldPay = student['total_amount'];
        const paid = student['last_amount_test'];
        const balanceAmount = shouldPay - paid;
        
        const notes = (() => {
        switch (true) {
            case balanceAmount >= 20000:
                return `باقی-اخطاریه`;  
            case balanceAmount === 0:
                return 'تصفیه شده';
            case balanceAmount < 0:
                return `طلبکار`;  
            default:
                return 'باقی'
        }
       })();

        return {
            [propertyMapping['id']]: student['hmis_no'] || '',
            [propertyMapping['full_name']]: `${student['patient_name']} ${student['guardian_name']}`.trim(),
            [propertyMapping['age']]: `${student['age']} سال`,
            [propertyMapping['gender']]: student['gender'] || '',
            [propertyMapping['address']]: `${student['province']}، ${student['district']}، ${student['address']}`.trim(),
            [propertyMapping['visit_date']]: `${student['day']}-${student['month']}-${student['dob']}`,
            [propertyMapping['last_receipt']]: paid,
            [propertyMapping['sessions']]: student['total_visit'] - 1,
            [propertyMapping['balance']]:  balanceAmount,
            [propertyMapping['mobileno']]: student['mobileno'],
            [propertyMapping['notes']]: notes
        };
    });

    // Create the Excel file
    const filename = 'لیست مراجعین داکتران.xlsx';
    const headers = Object.values(propertyMapping);

    const worksheet = XLSX.utils.json_to_sheet(transformedData, { header: headers });
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, 'لیست مراجعین داکتران');

    // Write the file
    XLSX.writeFile(workbook, filename);
}


</script>

