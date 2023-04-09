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
                        <h3 class="box-title titlefix">All Nursing Forceps List</h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('nursing_forcep test', 'can_add')) { ?> 
                                <a data-toggle="modal" onclick="holdModal('nursing_forcep');" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Forcep</a>  
                            <?php } ?>
                              <?php if ($this->rbac->hasPrivilege('add_patient_test_reprt', 'can_view')) { ?>  
                                <a href="<?php echo base_url(); ?>admin/radio/getTestReportBatch" class="btn btn-primary btn-sm"><i class="fa fa-reorder"></i> <?php echo $this->lang->line('test') . " " . $this->lang->line('report'); ?></a> 
                            <?php } ?> 
                        </div>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- <div class="download_label">ECG Patient></div> -->
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Date of Birth</th>
                                    <th>Before Birth Protection</th>
                                    <th>Giving Birth</th>
                                    <th>After Birth</th>
                                    <th>Family Arrangement</th>
                                    <th>Birth Leaving</th>
                                    <th>Others</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($resultlist)) {
                                    ?>
                                    <tr>
                                        <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found');   ?></td>
                                    </tr> 
                                    <?php
                                } else {
                                    $count = 1;
                                    foreach ($resultlist as $student) {
                                        ?>
                                        <tr class="">
                                            <?php //$patient = getPatientDetail($student['id']);?>
                                            <td><?php echo $student['laboratory']; ?>
                                                <div class="rowoptionview">
                                                        <a href="#" onclick="getPatientRecord('<?php echo $student['id'] ?>');" class="btn btn-default btn-xs"  data-toggle="tooltip" title="edit">
                                                            <i class="fas fa-exchange-alt" aria-hidden="true"></i>
                                                        </a>
                                                    <?php if ($this->rbac->hasPrivilege('nursing_forcep test', 'can_view')) { ?> 
                                                    <?php } ?>
                                                </div>  
                                            </td>
                                            <td><?php echo $student['id']; ?></td>
                                            <td><?php echo $student['test_name']; ?></td>
                                            <td><?php echo $student['result']; ?></td>
                                            <td><?php echo $student['unit']; ?></td>
                                            <td><?php echo $student['appearance']; ?></td>
                                            <td><?php echo $student['test_type']; ?></td>
                                            <td><?php echo $student['test_type']; ?></td>
                                            <td><?php echo $student['price']; ?></td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
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


<div class="modal fade" id="editUltraModal" role="dialog" aria-labelledby="editUltraModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">Edit Test Settings</h4> 
            </div>

            <div 
                class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form  id="formedit" accept-charset="utf-8"  method="post" class="ptt10">
                            <input type="hidden" name="id" id="patient_id">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Laboratory</label>
                                        <input type="text" name="laboratory" id="edit_laboratory" class="form-control" value="<?php echo set_value('laboratory'); ?>">
                                        <span class="text-danger"><?php echo form_error('laboratory'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Test Name</label>
                                        <input type="text" name="test_name" id="edit_test_name" class="form-control" value="<?php echo set_value('test_name'); ?>">
                                        <span class="text-danger"><?php echo form_error('test_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Result</label>
                                        <input type="text" name="result" id="edit_result" class="form-control" value="<?php echo set_value('result'); ?>">
                                        <span class="text-danger"><?php echo form_error('result'); ?></span>
                                    </div>
                                </div>   

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <input type="text" name="unit" id="edit_unit" class="form-control" value="<?php echo set_value('unit'); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Appearance</label>
                                        <input type="text" name="appearance" id="edit_appearance" class="form-control" value="<?php echo set_value('appearance'); ?>">
                                        <span class="text-danger"><?php echo form_error('appearance'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Test Type</label>
                                        <input type="text" name="test_type" id="edit_test_type" class="form-control" value="<?php echo set_value('test_type'); ?>">
                                        <span class="text-danger"><?php echo form_error('test_type'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" name="price" id="edit_price" class="form-control" value="<?php echo set_value('price'); ?>">
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

<!-- Start Add Ultra -->
<div class="modal fade" id="nursing_forcep" role="dialog" aria-labelledby="nursing_forcep">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">Add New Nursing Forcep</h4> 
            </div>
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form accept-charset="utf-8"  method="post" class="ptt10" action="<?php echo base_url() . "admin/radio/add_nursing_forcep" ?>">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Forcep Name</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="forcep_name" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('forcep_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <small class="req"> *</small> 
                                        <input type="date" name="date_of_birth" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('date_of_birth'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Before Birth</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="before_birth" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('before_birth'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Giving Birth</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="giving_birth" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('giving_birth'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>After Giving Birth</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="after_birth" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('after_birth'); ?></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Family Arrangement</label>
                                        <input type="number" name="family_arrangement" class="form-control">
                                        <span class="text-danger"><?php echo form_error('family_arrangement'); ?></span>
                                    </div>
                                </div> 

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Birth Leaving</label>
                                        <input type="text" name="birth_leaving" class="form-control">
                                        <span class="text-danger"><?php echo form_error('birth_leaving'); ?></span>
                                    </div>
                                </div> 
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Other Descriptions</label>
                                        <input type="text" name="other_description" class="form-control">
                                        <span class="text-danger"><?php echo form_error('other_description'); ?></span>
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

<!-- end add Ultra -->
<script type="text/javascript">
    $(function () {
        $('#easySelectable').easySelectable();
//stopPropagation();
    })



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
            $(document).ready(function (e) {
                $("#formadd").on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/radio/add',
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

            function getPatientRecord(id) {

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/radio/getLabConfRecord',
                    type: "POST",
                    data: {patient_id: id},
                    dataType: 'json',
                    success: function (data) {
                        $("#edit_laboratory").val(data.laboratory);
                        $("#edit_test_name").val(data.test_name);
                        $("#edit_result").val(data.result);
                        $("#edit_unit").val(data.normal);
                        $("#edit_test_type").val(data.test_type);
                        $("#edit_price").val(data.price);
                        $("#edit_appearance").val(data.appearance);
                        $('#patient_id').val(id);
                        holdModal('editUltraModal');
                    },

                })

            }

            $(document).ready(function (e) {
                $("#formedit").on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/radio/updateLabConf',
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
</script>

