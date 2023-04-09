<?php
// $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$currency_symbol = "افغـ";
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
		<div class="row">
            <div class="col-md-12">  
            	<div class="box box-primary">
            		<div class="box-header with-border">
            			<h3 class="box-title titlefix">راجسترنمودن مراجعین</h3>
            		</div>
            		<div class="box-body">
            			<form accept-charset="utf-8" action="<?php echo base_url() . "admin/patient/reg_patient" ?>" enctype="multipart/form-data" method="post">
                            <div class="row row-eq">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="row ptt10">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>نمبر کتابجه</label><small class="req"> *</small> 
                                                <input id="id_number" name="id_number" required="required" placeholder="12" type="text" class="form-control"  value="<?php echo set_value('id_number'); ?>" />
                                                <span class="text-danger"><?php echo form_error('id_number'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>اسم داکتر</label><small class="req"> *</small> 
                                                <input id="name" name="name" required="required" placeholder="راسخ" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>نام پدر داکتر</label><small class="req"> *</small> 
                                                <input type="text" name="guardian_name" required="required" placeholder="خادم" value="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label> <?php echo $this->lang->line('gender'); ?></label><small class="req"> *</small> 
                                                <select class="form-control" name="gender" required="required">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <option value="مونث">مونث</option>
                                                    <option value="مذکر">مذکر</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label> عمر - سال</label><small class="req"> *</small> 
                                                <div><input type="number"  value="20" required="required" name="age_year" value="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                       <!--  <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>ماه</label> 
                                                <div><input type="number"  name="age_month" value="01" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                                <label>روز </label>
                                            <div class="form-group">
                                                <div><input type="number"  name="age_day" value="01" class="form-control">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label> ولایت</label>
                                                <input type="text" placeholder="کابل" name="province" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>ناحیه/ولسوالی</label>
                                                <input type="text" placeholder="حوزه سوم" name="district" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> قریه</label>
                                                <input type="text" placeholder="کارته جهار" name="address" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                                <label>شماره تماس</label>
                                                <small class="req">*</small>
                                            <div class="form-group">
                                                <div><input type="text"  name="phone_number" placeholder="0700077100" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                          
                                        <div class="col-md-2">
                                            <label>روز</label>
                                            <div class="form-group">
                                            <select name="day" class="form-control" required>
                                            <?php
                                                for($i=1; $i<=31; $i++)
                                                { ?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?> </option>
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
                                            <select name="year" value="1400" class="form-control" require="required">
                                            <?php
                                                for($i=1390; $i<=1405; $i++)
                                                { ?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?> </option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12"  style="height: 60px;">
                                                <label>یادداشت</label>
                                            <div class="form-group">
                                                <div><textarea type="text"  name="note" placeholder="یادداشت" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--./row--> 
                                </div><!--./col-md-8--> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-eq ptt10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">
                                                       مراجعه به داکتر</label><small class="req"> *</small>
                                                <div>
                                                    <select class="form-control select2" style="width:100%" name='consultant_doctor' >
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
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="pwd"> نوعیت مراجعه کننده<small class="req"> *</small></label> 
                                                <select class="form-control select2" style="width:100%" name='patient_type' >
                                                    <option value="permanent">دایمی</option>   
                                                    <option value="new">متفرقه</option>   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="pwd"> مقدار پیش پرداخت- به عدد  <?php echo '(' . $currency_symbol . ')'; ?> <small class="req"> *</small></label> 
                                                <input name="amount" required="required" value="0" type="number" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="pwd"> مقدار پیش پرداخت - به حروف  <?php echo '(' . $currency_symbol . ')'; ?> <small class="req"> *</small></label> 
                                                <input name="payment_mode" value="صفر" required="required" type="text" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pwd">پرسلین  <?php echo '(' . $currency_symbol . ')'; ?> <small class="req"> *</small></label> 
                                                <input name="porcelen_price" required="required" type="text" class="form-control" value="300"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label for="pwd">نوعیت <small class="req"> *</small></label> 
                                            <select name="payment_modeaa" class="form-control" required="required">
                                                <option value="نقد">نقد</option>
                                                <option value="بانک">بانک</option>
                                                
                                            </select>
                                            </div>
                                        </div> 
                                        <div class="col-sm-4">
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
                                    </div><!--./row-->    
                                </div><!--./col-md-4-->
                            </div><!--./row-->   
                            <div class="row">            
                                <div class="box-footer">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary">اضافه نمودن در سیستم</button>
                                    </div>
                                </div>
                            </div><!--./row-->  
                        </form>     

            		</div>
            	</div>
            </div>
        </div>
	</section>

</div>


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
            });

            /**/


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
                        //new
                        $("#revesit_province").val(data.province);
                        $("#revesit_district").val(data.district);
                        $("#revesit_village").val(data.village);
                        $("#revesit_operation").val(data.operation);
                        $("#revesit_children_medical").val(data.children_medical);
                        $("#revesit_medical").val(data.medical);
                        $("#revesit_giving_births").val(data.giving_births);
                        $("#revisit_date").val(data.appointment_date);

                        //$("#revisit_casualty").val(data.casualty);
                        $('select[id="revisit_old_patient"] option[value="' + data.old_patient + '"]').attr("selected", "selected");
                        $('select[id="revisit_doctor"] option[value="' + data.cons_doctor + '"]').attr("selected", "selected");
                        // $('select[id="revisit_payment"] option[value="' + data.payment_mode + '"]').attr("selected", "selected");
                        $('select[id="revisit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                        $('select[id="revisit_marital_status"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                        holdModal('revisitModal');
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

            function getExamination(id) {
                $('#ex_id').val(id);
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/getPatientNo',
                    type: "POST",
                    data: {patient_id: id},
                    success: function (data) {
                        $('#ex_no').val(data);
                    },

                });
                holdModal('examinationModal');
            }
</script>