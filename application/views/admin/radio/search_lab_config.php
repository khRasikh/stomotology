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
                        <h3 class="box-title titlefix">تنظیمات ساخت دندان</h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('radiology test', 'can_add')) { ?> 
                                <a data-toggle="modal" onclick="holdModal('radiology');" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> اضافه معاینه</a>  
                                <a data-toggle="modal" onclick="holdModal('myModal')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add') . " " . $this->lang->line('radiology') . " " . $this->lang->line('test'); ?></a> 
                            <?php } ?>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>آی دی</th>
                                    <th>نام کیس</th>
                                    <th>یادادشت </th>
                                    <th>قمت کیس </th>
                                    <th>تاریخ </th>
                                    <th>تغیرات</th>
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
                                    foreach ($resultlist as $test) {
                                        ?>
                                        <tr class="">
                                            <td>00<?php echo $test['id']; ?></td>
                                            <td><?php echo $test['test_name']; ?></td>
                                            <td><?php echo $test['description']; ?></td>
                                            <td><?php echo $test['price']; ?></td>
                                            <td><?php echo $test['created_at']; ?></td>
                                            <td>
                                            <?php if ($this->rbac->hasPrivilege('opd_patient', 'can_add')) { ?> 
                                             <a data-toggle="modal" onclick="getPatientRecord('<?=$test['id']?>');"  class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> </a>  
                                            <a data-toggle="modal" onclick="#" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i> </a>  
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
                </div>                                                    
            </div>                                                                                                                                          
        </div>  
    </section>
</div>


<div class="modal fade" id="edit_test" role="dialog" aria-labelledby="edit_test">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">ویرایش تنظیمات</h4> 
            </div>

            <div 
                class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form  id="formedit" accept-charset="utf-8"  method="post" class="ptt10">
                            <input type="hidden" name="id" id="patient_id">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>نام تست</label>
                                        <input type="text" name="name" id="test_name_id" class="form-control">
                                        <span class="text-danger"><?php echo form_error('normal'); ?></span>
                                    </div>
                                </div>
                               
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>قمت </label>
                                        <input type="number" name="price" id="edit_price_id" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>تاریخ </label>
                                        <input type="date" name="date" id="edit_date_id" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>یادداشت</label>
                                        <textarea type="text" name="desc" id="edit_desc" class="form-control" >
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
<div class="modal fade" id="radiology" role="dialog" aria-labelledby="radiology">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">اضافه معاینه جدید</h4> 
            </div>
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form accept-charset="utf-8"  method="post" class="ptt10" action="<?php echo base_url() . "admin/radio/addLabConf" ?>">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>نام معاینه</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="test_name" class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('test_name'); ?></span>
                                    </div>
                                </div>
                                
                                

                                <!-- <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>حالت نارمل</label>
                                        <input type="text" name="normal" class="form-control">
                                        <span class="text-danger"><?php echo form_error('normal'); ?></span>
                                    </div>
                                </div>  -->

                                <!-- <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="unit" class="form-control" required="required">
                                        <span class="text-danger"><?php echo form_error('unit'); ?></span>
                                    </div>
                                </div> -->
                               <!--  <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Test Type</label>
                                        <small class="req"> *</small> 
                                        <select type="text" name="test_type" class="form-control" required="required">
                                            <option>Select</option>
                                            <option>Laboratory</option>
                                            <option>Ultrasound</option>
                                            <option>X-Ray</option>
                                            <option>ECG</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('test_type'); ?></span>
                                    </div>
                                </div>  -->
                                <!-- <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Test_section</label>
                                        <select type="text" name="test_section" class="form-control" required="required">
                                            <option>انتخاب</option>
                                            <option>Hematology</option>
                                            <option>Serology</option>
                                            <option>Blood Chemistry</option>
                                            <option>Urine Microscopiy</option>
                                            <option>Urine Chemistry ( Urin Dr)</option>
                                            <option>Urine Macroscopic</option>
                                            <option>Hormones</option>
                                        </select>4
                                        <span class="text-danger"><?php echo form_error('test_section'); ?></span>
                                    </div>
                                </div>  -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>تاریخ ثبت</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="entry_date" class="form-control datetime" required="required">
                                        <span class="text-danger"><?php echo form_error('entry_date'); ?></span>
                                    </div>
                                </div> 
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>قمت به افغانی</label>
                                        <input type="number" name="price" class="form-control" required="required">
                                        <span class="text-danger"><?php echo form_error('price'); ?></span>
                                    </div>
                                </div> 
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>یادداشت</label>
                                        <!-- <input type="text" name="description" class="form-control"> -->
                                        <textarea type="text" name="description" class="form-control"></textarea>
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

<script type="text/javascript">
    $(function () {
        $('#easySelectable').easySelectable();
//stopPropagation();
    })



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
                        // $("#normal").val(data.laboratory);
                        // console.log(data);
                        $("#test_name_id").val(data.test_name);
                        $("#edit_result_id").val(data.normal);
                        $("#edit_unit_id").val(data.unit);
                        $("#edit_type_id").val(data.test_type);
                        $("#edit_price_id").val(data.price);
                        $("#edit_appearance_id").val(data.appearance);
                        $("#edit_desc").val(data.description);
                        $('#patient_id').val(id);
                        holdModal('edit_test');
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

