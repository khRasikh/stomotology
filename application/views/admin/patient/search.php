<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$genderList = $this->customlib->getGender();
?>
<style type="text/css">

    #easySelectable {/*display: flex; flex-wrap: wrap;*/}
    #easySelectable li {}
    #easySelectable li.es-selected {background: #2196F3; color: #fff;}
    .easySelectable {-webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;}
    .dis{display: none;}
</style>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <?php if ($title == 'old_patient') { ?>
                            <h3 class="box-title titlefix"><?php echo $this->lang->line('opd') . " " . $this->lang->line('old') . " " . $this->lang->line('patient') ?></h3>
                        <?php } else { ?>
                            <h3 class="box-title titlefix"><?php echo $this->lang->line('opd') . " " . $this->lang->line('patient') ?></h3>

                        <?php } ?>
                        <div class="box-tools pull-right">
                            <!-- <?php if ($this->rbac->hasPrivilege($title, 'can_add')) { ?>                
                                <a data-toggle="modal" id="add" onclick="holdModal('add_info')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>  <?php echo $this->lang->line('add') . " " . $this->lang->line('patient') ?></a> 

                            <?php } ?>  -->
                            
                            <?php if ($title !== 'old_patient') { ?>
                                <?php if ($this->rbac->hasPrivilege('old_patient', 'can_view')) { ?>
                                    <a href="<?php echo base_url('admin/staff/'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i>  <?php echo $this->lang->line('profile') ?></a> 
                                <?php }
                            }
                            ?>
                            <?php if ($title !== 'old_patient') { ?>
                                <?php if ($this->rbac->hasPrivilege('old_patient', 'can_view')) { ?>
                                    <a href="<?php echo base_url('admin/patient/getoldpatient'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reorder"></i>  <?php echo $this->lang->line('old') . " " . $this->lang->line('patient') ?></a> 
                                <?php }
                            }
                            ?>
                            <a href="<?php echo base_url('admin/patient/getoldpatient'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reorder"></i>  Dashboard</a> 

                        </div>    
                    </div><!-- /.box-header -->

                    <?php
                    if (isset($resultlist)) {
                        ?>
                        <div class="box-body">
                            <div class="download_label"><?php if ($title == 'old_patient') {
                            echo $this->lang->line('opd') . " " . $this->lang->line('old') . " " . $this->lang->line('patient')
                            ?>
                                <?php } else {
                                    echo $this->lang->line('opd') . " " . $this->lang->line('patient')
                                    ?>

    <?php } ?></div>
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Reg NO</th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th>F/Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <!-- <th>Address</th> -->
                                        <!-- <th>Date</th> -->
                                        <th>New/Old</th>
                                        <th>Refer In</th>
                                        <th>Diagnose</th>
                                        <th>Theraphy</th>
                                        <th>HMIS NO</th>
                                        <th>Refer Out</th>
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
                                        foreach ($resultlist as $student) {
                                            ?>
                                            <tr class=""> 
                                                <td><?php echo $student["id"] ?></td>
                                                <td><?php echo $student["patient_unique_id"] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>admin/patient/profile/<?php echo $student['id']; ?>"><?php echo $student['patient_name']; ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $student['guardian_name'];?></td>
                                                <td><?php echo $student['gender'];?></td>
                                                <td><?php echo $student['age'];?></td>
                                                <!-- <td><?php echo $student['address'];?></td> -->
                                                <!-- <td><?php echo $student['created_at'];?></td> -->
                                                <td><?php echo $student['old_patient'];?></td>
                                                <td><?php echo $student['referred_of']; ?></td>
                                                <td><?php echo $student['diagnostic']; ?></td>
                                                <td><?php echo $student['therapy']; ?></td>
                                                <td><?php echo $student['hmis_no'];?></td>
                                                <td><?php echo $student['referred_to']; ?></td>
                                                <td>
                                                      <?php if ($this->rbac->hasPrivilege('revisit', 'can_add')) { ?>
                                                        <a href="#" onclick="getPatientNursing('<?php echo $student['id'] ?>');" class="btn <?php if($student['is_warded'] == 1) echo 'btn-success btn-sm'; else echo 'btn-default'; ?>"  title="Admit"  ><i class="fas fa-procedures"></i>
                                                        </a>
                                                        <a href="#" onclick="getRevisitRecord('<?php echo $student['id'] ?>')" class="btn <?php if($student['is_warded'] == 1) echo 'btn-danger btn-sm'; else echo 'btn-default'; ?>"  data-toggle="tooltip" title="Add information"><i class="fas fa-plus"></i>
                                                        </a>
                                                    <?php } ?> 
                                                        <?php if ($this->rbac->hasPrivilege($title, 'can_view')) { ?>
                                                        <a href="<?php echo base_url(); ?>admin/patient/profile/<?php echo $student['id'] ?>" class="btn btn-default"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                            <i class="fa fa-reorder"></i>
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
<!-- myModal -->

<!-- end myModal -->
<!-- revisit -->
<div class="modal fade" id="add_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"> <?php echo $this->lang->line('patient') . " " . $this->lang->line('information'); ?></h4> 
            </div>

            <div class="modal-body pt-20 pb-20">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <form id="formrevisit"   accept-charset="utf-8"   enctype="multipart/form-data" method="post" >
                            <div class="row row-eq">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row ptt10">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('patient') . " " . $this->lang->line('id'); ?></label> 
                                                <input id="revisit_id" disabled name="patient_id" placeholder="" type="text" class="form-control"  value="<?php echo set_value('roll_no'); ?>" />
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
                                                <label><?php echo $this->lang->line('guardian_name'); ?></label>
                                                <input type="text" name="guardian_name" value="<?php echo set_value('guardian_name'); ?>" class="form-control" id="revisit_guardian">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
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
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Age (Year)</label>
                                                <input type="number" name="age" value="<?php echo set_value('age'); ?>" class="form-control required" id="age">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" value="<?php echo set_value('address'); ?>" class="form-control" id="address_id">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <span class="req">*</span>
                                                <input type="text" required="required" name="opd_date" value="<?php echo set_value('ex_date'); ?>" class="form-control datetime" id="ex_date_id" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                             <label>New/Old:</label>
                                             <span class="req">*</span>
                                             <select name="new_old" id="new_old_id" required="required" class="form-control">
                                                    <option value="New">New</option>
                                                    <option value="Old">Old</option>
                                                </select>
                                            </div>
                                        </div>
                                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Refer In</label>
                                                <span class="req">*</span>
                                                <input type="text" name="referred_off" value="<?php echo set_value('referred_off'); ?>" class="form-control" id="referred_off_id"> 
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Diagnose</label>
                                                <textarea type="text" name="diagnose" value="<?php echo set_value('diagnose'); ?>" class="form-control" id="diagnose_id"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Therapy</label>
                                                <textarea type="text" name="therapy" value="<?php echo set_value('therapy'); ?>" class="form-control" id="therapy_id"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>HMIS NO</label>
                                                <input type="text" name="hmis_no" class="form-control" id="hmis_no_id">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Refer On</label>
                                                <input type="text" name="referred_to" value="<?php echo set_value('referred_to'); ?>" class="form-control" id="referred_to_id">
                                            </div>
                                        </div>

                                    </div><!--./row--> 
                                </div><!--./col-md-8--> 
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
    <div class="modal-dialog modal-lg" role="document">
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
                                                <option value="<?php echo $key; ?>" <?php if (set_value('gender') == $key) echo "selected"; ?>><?php echo $value; ?></option>
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
                                                <option value="<?php echo $value; ?>" <?php if (set_value('blood_group') == $key) echo "selected"; ?>><?php echo $value; ?></option>
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
<!-- patientNursingModal -->
<div class="modal fade" id="patientNursingModal"  role="dialog" aria-labelledby="patientNursingModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title">Add Patient To Nursing</h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form id="formadd2" accept-charset="utf-8" action="<?php echo base_url() . 'admin/patient/addPatienttoWard' ?>" enctype="multipart/form-data" method="post">
                            <input id="patient_id" name="patient_id" type="hidden" />
                            <input id="is_warded" name="is_warded" value="1" type="hidden" />
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Patient ID</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="patient_id" id="patient_id_nurse" readonly class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('entry_date'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Patient Name</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="patient_name" id="patient_name_nurse" readonly class="form-control" required>
                                        <span class="text-danger"><?php echo form_error('patient_name_nurse'); ?></span>
                                    </div>
                                     <div class="form-group">
                                        <label>Entrance Date</label>
                                        <input type="text" name="admission_date" id="entry_date_id"  class="form-control" readonly="readonly">
                                        <span class="text-danger"><?php echo form_error('admission_date'); ?></span>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Current Date</label>
                                        <small class="req"> *</small> 
                                        <input type="text" name="current_date" class="form-control datetime" required="required">
                                        <span class="text-danger"><?php echo form_error('entry_date'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Additional Description</label>
                                        <textarea type="text" name="add_description" class="form-control" rows="5"></textarea>
                                        <span class="text-danger"><?php echo form_error('add_description'); ?></span>
                                    </div>
                                </div>

                            </div> 
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
<!-- patientNursingModal -->



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
                        $("#pid").val(id);
                        $("#revisit_refference").val(data.refference);
                        $("#age").val(data.age);
                        $("#opd_id").val(data.opd);
                        $("#revisit_blood_group").val(data.blood_group);
                        $("#revisi_tax").val(data.tax);
                        $("#address_id").val(data.address);
                        $("#new_old_id").val(data.old_patient);
                        $("#referred_off_id").val(data.referred_of);
                        //new
                        $("#diagnose_id").val(data.diagnostic);
                        $("#therapy_id").val(data.therapy);
                        $("#referred_to_id").val(data.referred_to);
                        $("#ex_date_id").val(data.ex_date);
                        $("#hmis_no_id").val(data.hmis_no);

                        $('select[id="revisit_old_patient"] option[value="' + data.old_patient + '"]').attr("selected", "selected");
                        $('select[id="revisit_doctor"] option[value="' + data.cons_doctor + '"]').attr("selected", "selected");
                        // $('select[id="revisit_payment"] option[value="' + data.payment_mode + '"]').attr("selected", "selected");
                        $('select[id="revisit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                        $('select[id="revisit_marital_status"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                        holdModal('add_info');
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
                        holdModal('add_info');
                    },

                })
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
                        $('#entry_date_id').val(data.created_at);
                    },

                });
                holdModal('patientNursingModal');
            }

 
</script>