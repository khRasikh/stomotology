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
                        <h3 class="box-title titlefix">Ultrasound Test</h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('add_patient_test_reprt', 'can_view')) { ?>  
                                <a href="<?php echo base_url(); ?>admin/radio/search_lab_config" class="btn btn-primary btn-sm"><i class="fa fa-reorder"></i>  View All Tests</a> 
                            <?php } ?>
                        </div>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label">ECG Patient></div>
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Patient ID</th>
                                    <th>Name</th>
                                    <th>F/Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Date</th>
                                    <th>Test Name</th>
                                    <th>ULT Description</th>
                                    <th>Result</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($resultlist as $student) {
                                          // my code
                                        $patient_id = $student['patient_id'];
                                        $last_opd_details_round = show_last_round('opd_details',$patient_id);
                                        $last_lab_round = show_last_round('lab_ultra_sound',$patient_id);
                                        if($last_opd_details_round==$last_lab_round)
                                        { ?>
                                        <tr class="">
                                            <td><?php echo $student['patient_id']; ?></td>
                                            <td><?php echo $student['unique_id']; ?></td>
                                            <td><?php echo $student['patient_name']; ?></td>
                                            <td><?php echo $student['patient_fname']; ?></td>
                                            <td><?php echo $student['gender']; ?></td>
                                            <td><?php echo $student['age']; ?></td>
                                            <td><?php echo $student['date']; ?></td>
                                            <td><?php echo $student['test_name']; ?></td>
                                            <td><?php echo $student['duplicate']; ?></td>
                                            <td><?php echo $student['result']; ?>
                                                <label style="padding: 2px; border-radius: 5px;" class="btn-danger pull-right">
                                                <?php   $updated = is_new_or_updated('lab_ultra_sound',$student['patient_id'],$last_lab_round);
                                                if($updated == 0){ echo "New";} else echo ""; ?>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>admin/patient/print_lab/<?php echo $student['unique_id'] ?>/<?php echo  $last_lab_round; ?>/lab_ultra_sound" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></a>

                                                <a class="btn btn-primary btn-sm" title="Add Examination Result" data-toggle="modal" data-target="#myModal<?php echo $student['id']; ?>">
                                                <i class="fa fa-pencil"></i> </a>
                                                <?php if ($this->rbac->hasPrivilege($title, 'can_view')) { ?>

                                    <!-- modal -->
                                    <div class="modal fade" id="myModal<?php echo $student['id']; ?>" role="dialog" aria-labelledby="edit_ultrasound">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content modal-media-content">
                                                <div class="modal-header modal-media-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="box-title">Edit in Ultrasound Test</h4> 
                                                </div>

                                                <div 
                                                    class="modal-body pt0 pb0">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                                                            <form  accept-charset="utf-8"  method="post" action="<?php echo base_url() . "admin/radio/updateLabUlt" ?>">
                                                                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                                                <div class="row">
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>Patient Name</label>
                                                                            <span style="color: red;">*</span>
                                                                            <input type="text" name="patient_name" value="<?php echo $student['patient_name']; ?>" class="form-control" readonly >
                                                                            <span class="text-danger"><?php echo form_error('patient_name'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>Father Name</label>
                                                                            <span style="color: red;">*</span>
                                                                            <input type="text" name="patient_fname"  value="<?php echo $student['patient_fname']; ?>"  class="form-control" readonly>
                                                                            <span class="text-danger"><?php echo form_error('patient_fname'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>Age (Year)</label>
                                                                            <span style="color: red;">*</span>
                                                                            <input type="text" name="age" readonly  class="form-control"  value="<?php echo $student['age']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label>Gender</label>
                                                                            <span style="color: red;">*</span>
                                                                            <input type="text" name="gender" readonly="readonly" 
                                                                            value="<?php echo $student['gender']; ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Registered Date</label>
                                                                            <span style="color: red;">*</span>
                                                                            <input type="text" name="reg_date" readonly="readonly"  class="form-control" value="<?php echo $student['date']; ?>">
                                                                            <span class="text-danger"><?php echo form_error('created_at'); ?></span>
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                                    <?php 
                                                                    $lab_ultra = show_examination_result('lab_ultra_sound',$student['unique_id'],$last_opd_details_round);
                                                                    foreach($lab_ultra as $key => $value)
                                                                    { ?>

                                                                        <div class="row">
                                                                            <div class="col-sm-2">
                                                                            <div class="form-group">
                                                                                <label>Test Name</label>
                                                                                <span style="color: red;">*</span>
                                                                                <input type="text" name="test_name"  class="form-control"
                                                                                value="<?php echo $value['test_name']; ?>" readonly >
                                                                                <input type='hidden' id='lab_id<?php echo $value['id']; ?>' value="<?php echo $value['id']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>Examination Result</label>
                                                                                <input type="text" name="exam_type"  id="exam_type<?php echo $value['id']; ?>" value="<?php echo $value['exam_type']; ?>" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <div class="form-group">
                                                                                <label>Description </label>
                                                                                <input type="text" name="description" id="description<?php echo $value['id']; ?>" value="<?php echo $value['description']; ?>" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <div class="form-group">
                                                                                <label></label>
                                                                                <?php if(empty($value['exam_type']) OR empty($value['description'])) { ?>
                                                                                    <br id="br<?php echo $value['id']; ?>" style="diplay:none;">
                                                                                    <button  type="button" class='btn btn-success'
                                                                                    onclick="add_ult_result(<?php echo $value['id']; ?>);"  class="form-control" >
                                                                                    <span id='btnSave<?php echo $value['id']; ?>'>Save</span> 
                                                                                <i class="fa fa-check" id="btnCheck<?php echo $value['id']; ?>" style="display:none;margin-top:10px;"></i>
                                                                                </button>
                                                                                    <?php } else { ?>  
                                                                                        <br>
                                                                                        <button  type="button" class='btn btn-success'  class="form-control" >
                                                                                        <i class="fa fa-check"  style=""></i>
                                                                                    </button>
                                                                                <?php } ?>                                              
                                                                            </div>
                                                                        </div>
                                                                    </div><!--./row--> 
                                                                    <?php  } ?>
                                                                    <div class="row">
                                                                    <div class="col-sm-4">
                                                                    <?php $extra_information = show_lab_lab_ex_information('lab_ultra_sound',$student['patient_id'],$last_lab_round); ?>
                                                                        <div class="form-group">
                                                                            <label>Consultant Dr.</label>
                                                                            <input type="text" name="consultant_doctor"  class="form-control" value="<?php echo $extra_information[0]['consultant_doctor']; ?>">
                                                                            <input type="hidden" name="round" value="<?php echo $last_lab_round; ?>">
                                                                            <input type="hidden" name="patient_id" value="<?php echo $student['patient_id']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>OPD/IPD</label>
                                                                            <select class="form-control"   name="refer_of">
                                                                            <option value="<?php echo $extra_information[0]['refer_of']; ?>"><?php echo $extra_information[0]['refer_of']; ?></option>
                                                                                <option value="OPD" >OPD</option>
                                                                                <option value="IPD">IPD</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label>Current Date</label>
                                                                            <small class="req">*</small>
                                                                            <input type="text" name="updated_at" class="form-control datetime" value="<?php echo $extra_information[0]['updated_at']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>Additional Description</label>
                                                                            <textarea type="text" name="add_description"  class="form-control"><?php echo $extra_information[0]['add_description']; ?></textarea> 
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="box-footer">
                                                        <div class="pull-right ">
                                                        <input type="submit" class="btn btn-info pull-right" name="submit" value="submit">
                                                        </form>
                                                    </div>
                                                </div> 

                                                        </div><!--./col-md-12-->       
                                                    </div><!--./row--> 
                                                </div>
                                                
                                            </div>
                                        </div>    
                                    </div>
                                    <!-- / modal -->

                                                
                                                <a href="<?php echo base_url(); ?>admin/patient/profile/<?php echo $student['id'] ?>" class="btn btn-success btn-sm"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                <i class="fa fa-reorder"></i>
                                            </a>
                                          <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } else { }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>                                                    
            </div>                                                                                                                                          
        </div>  
    </section>
</div>




<!-- end add Ultra -->
<script type="text/javascript">
    $(function () {
        $('#easySelectable').easySelectable();
//stopPropagation();
    })
</script>

<script type="text/javascript">
// My code
function add_ult_result(id)
{
    var lab_id = document.getElementById('lab_id'+id).value;
    var exam_type =document.getElementById('exam_type'+id).value;
    var description =document.getElementById('description'+id).value;
    $.ajax({
    type:'POST',
    data:{lab_id:lab_id,exam_type:exam_type,description:description},
    url: '<?php echo base_url(); ?>admin/radio/update_Lab_ult',
    success: function(result)
    {
        document.getElementById('btnSave'+id).style.display='none';
        document.getElementById('br'+id).style.display="block";
        document.getElementById('btnCheck'+id).style.display="block";
    }
    });
}
</script>

<script type="text/javascript">
            /*
             Author: mee4dy@gmail.com
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
            
            function getchargeDetails(id) {

                $('#standard_charge').val("");
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/charges/getDetails',
                    type: "POST",
                    data: {charges_id: id},
                    dataType: 'json',
                    success: function (res)
                    {
                        $('#standard_charge').val(res.standard_charge);
                    }
                })
            }
            function getPatientIdName(opd_ipd_no) {
                $('#patient_id').val("");
                $('#patient_name').val("");
                var opd_ipd_patient_type = $("#customer_type").val();
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/getPatientType',
                    type: "POST",
                    data: {opd_ipd_patient_type: opd_ipd_patient_type, opd_ipd_no: opd_ipd_no},
                    dataType: 'json',
                    success: function (data) {
                        $('#patient_id').val(data.patient_id);
                        $('#patient_name').val(data.patient_name);
                        //$('#consultant_doctor').val(data.doctorname + ' ' +data.surname);
                    }
                });
            }

            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2();
            });


            
            function holdModal(modalId) {
                $('#' + modalId).modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
            }

            function bring_ultrasound(id) {

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/radio/bring_ultrasound',
                    type: "POST",
                    data: {patient_id: id},
                    dataType: 'json',
                    success: function (data) {
                        
                        $("#patient_id").val(id);
                        $("#edit_patient_name").val(data.patient_name);
                        $("#edit_gaurdian_name").val(data.patient_fname);
                        $("#edit_age").val(data.age);
                        $("#edit_date").val(data.created_at);
                        $("#edit_test_name").val(data.test_name);
                        $("#edit_consultant_doctor").val(data.consultant_doctor);
                        $("#edit_refer_of").val(data.refer_of);
                        $("#edit_result_desc").val(data.result_desc);
                        $("#edit_duplicate").val(data.duplicate);
                        $("#edit_opd_ipd").val(data.opd_ipd);
                        $("#edit_updated_at").val(data.updated_at);

                        $('select[id="edit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                        holdModal('edit_ultrasound');
                    },

                })

            }

            $(document).ready(function (e) {
                $("#formedit").on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/radio/updateLabUlt',
                        type: "POST",
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            if (data.status == "fail") {
                                alert(data);
                                errorMsg(message);
                            } else {
                                successMsg(data.message);
                                // alert(data);
                               window.location.reload(true);
                            }
                        },
                        error: function () {
                             alert("Fail")
                        }
                    });
                }));
            });
</script>

