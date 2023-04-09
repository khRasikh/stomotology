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
	<section class="content">
        <?php
            $this->db->where("id",$data["id"]);
            $lab = $this->db->get("lab_lab")->result();
        ?>
		<div class="row">
            <div class="col-md-12">
            	<div class="box box-primary">
            		<div class="box-header with-border">
            			<h3 class="box-title titlefix">Register New Patient</h3>
            		</div>
            		<div class="box-body">
            			 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <?php
                            foreach ($lab as $row) {
                        ?>
                        <form  id="formedit" accept-charset="utf-8"  method="post" class="ptt10">
                            <input type="hidden" name="id" id="patient_id">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Patient Name</label>
                                        <span style="color: red;">*</span>
                                        <input type="text" name="patient_name" value="<?=$row->patient_name?>" class="form-control" readonly >
                                        <span class="text-danger"><?php echo form_error('patient_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <span style="color: red;">*</span>
                                        <input type="text" name="patient_fname" readonly="readonly" value="<?=$row->patient_fname?>" class="form-control"  value="<?php echo set_value('patient_fname'); ?>">
                                        <span class="text-danger"><?php echo form_error('patient_fname'); ?></span>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Admission Date</label>
                                        <span style="color: red;">*</span>
                                        <input type="date" name="date" value="<?=$row->date?>"  readonly="readonly"  class="form-control  readonlydatetime" value="<?php echo set_value('date'); ?>" >
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>   
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Test Name</label>
                                        <span style="color: red;">*</span>
                                        <input type="text" name="operation_type" id="edit_test_name" class="form-control" value="<?php echo set_value('operation_type'); ?>" readonly >
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Duplicate</label>
                                        <input type="text" name="duplicate" id="edit_duplicate" class="form-control" value="<?php echo set_value('duplicate'); ?>" >
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Result (+/-)</label>
                                        <input style="font-size: 20px;" type="text" name="result" id="edit_result" class="form-control" value=" <?php echo "( ".set_value('result')." )"; ?>">
                                    </div>
                                </div>
                            </div><!--./row-->  
                            <div class="box-footer">
                <div class="pull-right ">
                    <button type="submit" class="btn btn-info pull-right" ><?php echo $this->lang->line('save') ?></button>
                    </form>
                <?php }?>
                </div>
            </div>  

            		</div>
            	</div>
            </div>
        </div>
	</section>

</div>



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

            function bringLab(id) {

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/radio/bringLab',
                    type: "POST",
                    data: {patient_id: id},
                    dataType: 'json',
                    success: function (data) {
                        
                        $("#patient_id").val(id);
                        $("#edit_patient_name").val(data.patient_name);
                        $("#edit_gaurdian_name").val(data.patient_fname);
                        $("#edit_age").val(data.age);
                        $("#edit_date").val(data.date);
                        $("#edit_gender").val(data.gender);
                        $("#edit_test_name").val(data.operation_type);
                        $("#edit_duplicate").val(data.duplicate);
                        $("#edit_result").val(data.result);
                        $("#edit_consultant_doctor").val(data.consultant_doctor);
                        $("#edit_refer_of").val(data.refer_of);
                        $("#edit_result_desc").val(data.result_desc);
                        $("#edit_updated_at").val(data.updated_at);
                        $('select[id="edit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                        holdModal('edit_lab');
                    },

                })

            }

            $(document).ready(function (e) {
                $("#formedit").on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/radio/updateLab',
                        type: "POST",
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            if (data.status == "fail") {
                                // alert(data);
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

