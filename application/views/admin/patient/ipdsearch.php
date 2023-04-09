<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$genderList = $this->customlib->getGender();
?>
<style type="text/css">

    #easySelectable {/*display: flex; flex-wrap: wrap;*/}
    #easySelectable li {}
    #easySelectable li.es-selected {background: #2196F3; color: #fff;}
    .easySelectable {-webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;}
</style>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('ipd') . " " . $this->lang->line('patient'); ?></h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('discharged patients', 'can_view')) { ?>
                                <a  href="<?php echo base_url() ?>admin/admin/Dashboard" class="btn btn-primary btn-sm"><i class="fa fa-reorder"></i>Dashboard</a> 
                               <!--  <a  href="#" data-toggle="modal" data-target="#bed" class="btn btn-primary btn-sm"><i class="fas fa-bed"></i> Bed Status</a> -->

                            <?php } ?>

                        </div>    
                    </div><!-- /.box-header -->

                    <?php
                    if (isset($resultlist)) {
                        ?>
                        <div class="box-body">




                            <div class="download_label"><?php echo $this->lang->line('ipd') . " " . $this->lang->line('patient'); ?></div>

                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>

                                        <th>S.NO</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <!-- <th>F/Name</th> -->
                                        <!-- <th>Gender</th> -->
                                        <!-- <th>Age</th> -->
                                        <!-- <th>Address</th> -->
                                        <th>Entrance Date</th>
                                        <th>Diagnose</th>
                                        <th>Therapy</th>
                                        <th>Refer In</th>
                                        <th>Refer Out</th>
                                        <th>Discharge Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($resultlist)) {
                                        ?>
                                        <?php
                                    } else {
                                        $count = 1;
                                        $class = "";
                                        foreach ($resultlist as $student) {

                                            $payment = $student["payment"];
                                            $credit_limit = $student["credit_limit"];
                                            $charge = $student["charges"];
                                            $bill = $student['charges'] - $student['payment'];
                                            if ($bill >= $credit_limit) {
                                                $color = "alert alert-danger";
                                            }
                                            ?>

                                            <tr class="<?php echo $class; ?>">
                                                <td><?php echo $student["id"] ?></td>
                                                <td><?php echo $student["patient_unique_id"] ?></td>
                                                <td>
                                              <a href="<?php echo base_url(); ?>admin/patient/ipdprofile/<?php echo $student['id']; ?>"><?php echo $student['patient_name']; ?></a>
                                                </td>
                                                <!-- <td><?php echo $student['guardian_name']; ?></td> -->
                                                <!-- <td><?php echo $student['gender']; ?></td> -->
                                                <!-- <td><?php echo $student['age']; ?> Year</td> -->
                                                <!-- <td><?php echo $student['address']; ?></td> -->
                                                <td><?php echo $student['ex_date']; ?></td>
                                                <td><?php echo limit_text($student['diagnostic'], 3); ?></td>
                                                <td><?php echo limit_text($student['therapy'], 3); ?></td>
                                                <td><?php echo $student['referred_of']; ?></td>
                                                <td><?php echo $student['referred_to']; ?></td>
                                                <td><?php echo $student['created_at']; ?></td>
                                                <td>
                                                    <?php if ($this->rbac->hasPrivilege('consultant register', 'can_add')) { ?>
                                                           <a href="<?php echo base_url(); ?>admin/patient/print_bill_ipd/<?php echo $student['id'] ?>" class="btn <?php if($student['is_printed'] == 1) echo 'btn-success btn-sm'; else echo 'btn-default'; ?>" data-toggle="tooltip" title="Print Bill">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                            <a onclick="getPatientRecord('<?php echo $student['id'] ?>')" class="btn btn-success btn-sm"  data-toggle="tooltip" title="Add IPD Enterance Fee" >
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                            <a onclick="holdModal2('addWard','<?php echo $student['id'] ?>')"
                                                                class="btn <?php if($data['patient_ward']['1'] == 1) echo 'btn-primary btn-sm'; else echo 'btn-default'; ?>"  data-toggle="tooltip" title="Add Last Result" >
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                           <a href="<?php echo base_url(); ?>admin/patient/printDischarge/<?php echo $student['id'] ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Discharge Patient">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                                                               
                                                        <?php } ?>
                                                       
                                                </td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>  
            </div>
        </div> 
    </section>
</div>

<!-- dd -->


<div class="modal fade" id="add_ipd_fee" role="dialog" aria-labelledby="add_ipd_fee">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">Add Enterance Fee</h4> 
            </div>
            <div 
                class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <!-- <form  id="add_ipd_form" accept-charset="utf-8"  method="post" class="ptt10"> -->
                        <form accept-charset="utf-8" action="<?php echo base_url() . "admin/patient/addEntranceFee" ?>" method="post" class="ptt10">
                            <input type="hidden" name="id" id="patient_id">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Patient ID</label>
                                        <span class="req">*</span>
                                        <input type="text"  required="required" readonly name="patient_unique_id" id="edit_patient_id" class="form-control" value="<?php echo set_value('patient_name'); ?>">
                                        <span class="text-danger"><?php echo form_error('patient_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Patient Name</label>
                                        <span class="req">*</span>
                                        <input type="text"  required="required" readonly name="patient_name" id="edit_patient_name" class="form-control" value="<?php echo set_value('patient_name'); ?>">
                                        <span class="text-danger"><?php echo form_error('patient_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Patient Father Name</label>
                                        <span class="req">*</span>
                                        <input type="text"  required="required" readonly name="patient_fname" id="edit_patient_fname" class="form-control" value="<?php echo set_value('patient_fname'); ?>">
                                        <span class="text-danger"><?php echo form_error('patient_fname'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <span class="req">*</span>
                                        <input type="text" name="ipd_date" readonly  required="required" id="ipd_date_id" class="form-control">
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>   
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Diagnostic</label>
                                        <span class="req">*</span>
                                        <input type="text" name="ipd_diagnostic" readonly  required="required" id="ipd_diagnostic_id" class="form-control">
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>  
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Therapy</label>
                                        <span class="req">*</span>
                                        <input type="text" name="ipd_therapy" readonly  required="required" id="ipd_therapy_id" class="form-control">
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>  
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Refer In</label>
                                        <span class="req">*</span>
                                        <input type="text" name="ipd_diagnostic" readonly  required="required" id="ipd_refer_id" class="form-control">
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>  
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Refer On</label>
                                        <span class="req">*</span>
                                        <input type="text" name="ipd_diagnostic" readonly  required="required" id="ipd_refer_on_id" class="form-control">
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>  
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Age(Only Year)</label>
                                        <span class="req">*</span>
                                        <input type="text" name="age"  required="required" id="edit_age" class="form-control" value="<?php echo set_value('age'); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Age(Only Month)</label>
                                        <input type="text" name="age_month"  id="edit_age_month" class="form-control" value="<?php echo set_value('age_month'); ?>">
                                    </div>
                                </div><div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Age(Only Day)</label>
                                        <input type="text" name="age_day"   id="edit_age_day" class="form-control" value="<?php echo set_value('age_day'); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Enterance Fee (AFN)</label>
                                        <span class="req">*</span>
                                        <input type="number" name="entrance_fee" required="required" id="edit_ipd_fee" class="form-control" value="<?php echo set_value('ipd_fee'); ?>">
                                    </div>
                                </div>
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Current Date</label>
                                        <span class="req">*</span>
                                        <input type="date" required="required" name="current_date" id="current_date_id" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Additional Description</label>
                                        <textarea type="text" name="add_desc"   id="edit_add_desc" class="form-control" value="<?php echo set_value('add_desc'); ?>"></textarea>
                                    </div>
                                </div>


                            </div><!--./row-->   

                    </div><!--./col-md-12-->       
                </div><!--./row--> 
            </div>
            <div class="box-footer">
                <div class="pull-right ">
                    <button type="submit" class="btn btn-info pull-right" ><?php echo $this->lang->line('save') ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>
<!-- start add ward -->
<div class="modal fade" id="addWard" role="dialog" aria-labelledby="addWard">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">Add Last Result of Patient</h4> 
            </div>
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form accept-charset="utf-8"  method="post" class="ptt10" action="<?php echo base_url() . "admin/patient/addWard" ?>">
                            <input type="hidden" name="patient_id" id="ward_patient_id">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Discharge Date</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="exit_date" class="form-control datetime" required>
                                        <span class="text-danger"><?php echo form_error('exit_date'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Operation</label>
                                        <small class="req"> *</small> 
                                        <select type="text" name="operation"  class="form-control" required>
                                            <option value="NO">NO</option>
                                            <option value="Yes">YES</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('operation'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Died</label>
                                        <small class="req"> *</small> 
                                        <select type="text" name="died" value="NO" class="form-control" required>
                                            <option value="NO">NO</option>
                                            <option value="YES">Yes</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('died'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Escape</label>
                                        <small class="req"> *</small> 
                                        <select type="text" name="escape" value="NO" class="form-control" required>
                                        <option value="NO">NO</option>
                                        <option value="YES">Yes</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('escape'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Reference</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="reference" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('reference'); ?></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Blood Issue</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="blood_group" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('blood_group'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Infant</label>
                                        <small class="req"> *</small> 
                                         <select type="text" name="escape" value="NO" class="form-control" required>
                                        <option value="NO">NO</option>
                                        <option value="YES">Yes</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('birth'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>M.I</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="mi" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('mi'); ?></span>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="description" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('description'); ?></span>
                                    </div>
                                </div>

                            </div>

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
<!-- end add ward -->
<!-- start edit award -->
<script type="text/javascript">
    /**/
    function holdModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function holdModal2(modalId,id) {
        $('#ward_patient_id').val(id);
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('a').find('.fee_detail_popover').html();
            }
        });
    });

    function getPatientRecord(id) {

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/getIPDPatientRecord',
                    type: "POST",
                    data: {patient_id: id},
                    dataType: 'json',
                    success: function (data) {
                        $("#edit_patient_id").val(data.id);
                        $("#edit_patient_name").val(data.patient_name);
                        $("#edit_patient_fname").val(data.guardian_name);
                        $("#ipd_date_id").val(data.created_at);
                        $("#edit_age").val(data.age);
                        $("#edit_age_month").val(data.month);
                        $("#edit_age_day").val(data.day);
                        $("#add_desc_id").val(data.add_description);
                        $("#patient_id").val(data.id);
                        $("#ipd_diagnostic_id").val(data.diagnostic);
                        $("#ipd_therapy_id").val(data.therapy);
                        $("#ipd_refer_id").val(data.referred_of);
                        $("#ipd_refer_on_id").val(data.referred_to);
                        $('select[id="edit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                        holdModal('add_ipd_fee');
                    },

                })

            }
    function getWard(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/radio/getWard',
            type: "POST",
            data: {patient_id: id},
            dataType: 'json', 
            success: function (data) {
            $("#edit_ward_duration").val(data.ward_duration);
            $("#edit_exit_date").val(data.exit_date);
            $("#edit_entrance_fee").val(data.entrance_fee);
            $("#edit_total_fees").val(data.total_fees);
            $("#edit_night").val(data.night);
            $("#edit_operation").val(data.operation);
            $("#edit_died").val(data.died);
            $("#edit_escape").val(data.escape);
            $("#edit_leave").val(data.leave);
            $("#edit_reference").val(data.reference);
            $("#edit_blood_group").val(data.blood_group);
            $("#edit_birth").val(data.birth);
            $("#edit_mi").val(data.mi);
            $("#edit_description").val(data.description);
            $("#patient_id").val(id);
            //$('select[id="edit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
            holdModal('editAward');
            },

        })
    }

    $(document).ready(function (e) {
                $("#add_ipd_form").on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/patient/addEntranceFee',
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
                             // alert("Fail");
                        }
                    });
                }));
            });

</script>
