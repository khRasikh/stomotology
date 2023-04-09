<div class="content-wrapper" style="min-height: 946px;">  
 
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12"> 
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">لیست تمام ساخت دندان ها</h3>
                        <p><label class="label label-warning">لیست داکتران در سال 1400</label></p>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('charge_category', 'can_add')) { ?> 
                                <!-- <a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add') . " " . $this->lang->line('charge_category'); ?></a>   -->
                            <?php } ?>   
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('charge_category') . " " . $this->lang->line('details'); ?></div>
                            <table class="table table-striped table-bordered table-hover example" >
                            <thead>
                                <th>آی دی</th>
                                <th>نام</th>
                                <th>نام پدر</th>
                                <th>تست</th>
                                <th>نوعیت ساخت</th>
                                <th>تاریخ ساخت</th>     
                                <th>تعداد دندان</th>
                                <th>موقعیت-چب </th>
                                <th >موقعیت-راست </th>
                                <th style="text-align: right;">قمت-افغانی</th>
                                <th style="text-align: right;">عمل</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($chargeCategory as $category) {
                                        ?>
                                        <tr>
                                            <td><?php echo $category['unique_id']; ?></td>
                                            <td><?php echo $category['patient_name']; ?></td>
                                            <td><?php echo $category['patient_fname']; ?></td>
                                            <td><?php echo $category["test_name"]; ?></td>
                                            <td><?php echo $category["fees"]; ?></td>
                                            <td><?php echo $category['day'];  ?>-<?php echo $category['month'];  ?>-<?php echo $category['year'];  ?></td>
                                            <!-- <td><label><?php echo $category['round'];  ?></label></td> -->
                                            <!-- <td><?php echo $category['lab_round'];  ?></label></td> -->
                                            <td><?php echo $category['duplicate'];  ?></label></td>
                                            <td>
                                            <label style="color: green; font-size: 16px;">بالا:
                                            <?php   
                                                        if ($category['lh']==1){ echo "8"; } else { echo "-"; }
                                                        if ($category['lg']==1){ echo "7"; } else echo "-";
                                                        if ($category['lf']==1){ echo "6"; } else echo "-";
                                                        if ($category['le']==1){ echo "5"; } else echo "-";
                                                        if ($category['ld']==1){ echo "4"; } else echo "-";
                                                        if ($category['lc']==1){ echo "3"; } else echo "-";
                                                        if ($category['lb']==1){ echo "2"; } else echo "-";
                                                        if ($category['la']==1){ echo "1"; } else echo "-";
                                                    ?>
                                            <label>
                                            <label style="color: green; font-size: 16px;">پایین:
                                            <?php   
                                                        if ($category['ldh']==1){ echo "8"; } else { echo "-"; }
                                                        if ($category['ldg']==1){ echo "7"; } else echo "-";
                                                        if ($category['ldf']==1){ echo "6"; } else echo "-";
                                                        if ($category['lde']==1){ echo "5"; } else echo "-";
                                                        if ($category['ldd']==1){ echo "4"; } else echo "-";
                                                        if ($category['ldc']==1){ echo "3"; } else echo "-";
                                                        if ($category['ldb']==1){ echo "2"; } else echo "-";
                                                        if ($category['lda']==1){ echo "1"; } else echo "-";
                                                    ?>
                                            <label>
                                            </td>
                                            <td>
                                            <label style="color: green; font-size: 16px;">بالا:
                                            <?php   
                                                        if ($category['rh']==1){ echo "8"; } else { echo "-"; }
                                                        if ($category['rg']==1){ echo "7"; } else echo "-";
                                                        if ($category['rf']==1){ echo "6"; } else echo "-";
                                                        if ($category['re']==1){ echo "5"; } else echo "-";
                                                        if ($category['rd']==1){ echo "4"; } else echo "-";
                                                        if ($category['rc']==1){ echo "3"; } else echo "-";
                                                        if ($category['rb']==1){ echo "2"; } else echo "-";
                                                        if ($category['ra']==1){ echo "1"; } else echo "-";
                                                    ?>
                                            </label>
                                            <label style="color: green; font-size: 16px;">پایین:
                                            <?php   
                                                        if ($category['rdh']==1){ echo "8"; } else { echo "-"; }
                                                        if ($category['rdg']==1){ echo "7"; } else echo "-";
                                                        if ($category['rdf']==1){ echo "6"; } else echo "-";
                                                        if ($category['rde']==1){ echo "5"; } else echo "-";
                                                        if ($category['rdd']==1){ echo "4"; } else echo "-";
                                                        if ($category['rdc']==1){ echo "3"; } else echo "-";
                                                        if ($category['rdb']==1){ echo "2"; } else echo "-";
                                                        if ($category['rda']==1){ echo "1"; } else echo "-";
                                                    ?>
                                            </label>
                                            </td>
                                            <td><?php echo $category['fees'];  ?></td>
                                                <?php 
                                                $totalfees += $category['fees'];
                                                $totalamount += $category['duplicate'];
                                                     ?>
                                            <td class="text-right">
                                                <?php if ($this->rbac->hasPrivilege('student_count_widget', 'can_view')) { ?> 
                                                    <a onclick="get(<?php echo $category['id']; ?>)" data-target="#editmyModal"  class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <span class="label label-success"><i class="fa fa-pencil"></i></span>
                                                    </a>
                                                <?php } if ($this->rbac->hasPrivilege('student_count_widget', 'can_delete')) { ?> 
                                                    <a  class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="delete_recordById('<?php echo base_url(); ?>admin/chargecategory/delete/<?php echo $category['id'] ?>', '<?php echo $this->lang->line('delete_message'); ?>')";>
                                                    <span class="label label-danger"><i class="fa fa-trash"></i></span>
                                                    </a> 
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                    
                                </tbody>
                                <tr class="box box-solid total-bg"  style="font-size: 23px; color: green; ">
                                        <td class="text-right" colspan="14">مجموعه ساخت دندان: 
                                        <label><?php echo $totalfees."  افغانی"; ?></label>، به تعداد
                                        <label><?php echo $totalamount."  ساخت"; ?></label>. تاریخ فعلی امروز:                                </td>
                            </tr>
                            </table>
                        </div>
                    </div>

                    <div class="">
                        <div class="mailbox-controls">
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"> <?php echo $this->lang->line('add') . " " . $this->lang->line('charge_category') ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">

                <form id="formadd" action="<?php echo site_url('admin/chargecategory/add') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                            <input autofocus="" id="type"  name="name"  type="text" class="form-control" value="<?php
                            if (isset($result)) {
                                echo $result["name"];
                            }
                            ?>" />
                            <span class="text-danger"><?php echo form_error('name'); ?></span> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label><small class="req"> *</small>
                            <textarea name="description" class="form-control"><?php
                                if (isset($result)) {
                                    echo $result["description"];
                                }
                                ?></textarea>
                            <span class="text-danger"><?php echo form_error('description'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pwd"><?php echo $this->lang->line('charge_type'); ?></label>
                            <small class="req"> *</small>  
                            <select name="charge_type" class="form-control">
                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                <?php foreach ($charge_type as $charge_key => $charge_value) {
                                    ?>
                                    <option value="<?php echo $charge_key; ?>" <?php if ((isset($result['charge_type']) ) && ($result['charge_type'] == $charge_key)) echo "selected"; ?>><?php echo $charge_value; ?></option>
<?php } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('charge_type'); ?></span>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                    </div>
                </form>

            </div><!--./col-md-12-->       
        </div><!--./row--> 
    </div>
</div>


<div class="modal fade" id="editmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"><?php echo $this->lang->line('edit') . " " . $this->lang->line('charge_category'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <form id="editformadd" action="<?php echo site_url('admin/chargecategory/update')?>" name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                            <div class="row row-eq">
                                <div class="col-lg-12 col-md-12 col-sm-12"> 
                                    <div class="row ptt10">
                                        <div class="col-md-3">
                                        <input type="hidden" name="id_id" id="id_id" class="form-control">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم مکمل</label><small class="req"> *</small>
                                            <input  id="name_id"  name="name" readonly  type="text" class="form-control" value="<?php
                                            if (isset($result)) {
                                                echo $result["name"];
                                            }
                                            ?>" />
                                            <span class="text-danger"><?php echo form_error('name'); ?></span> 
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>ID</label><small class="req"> *</small> 
                                                <input name="unique_id" id="ex_id_two_id" type="text" class="form-control" />
                                                <span class="text-danger"><?php echo form_error('ex_id'); ?></span>
                                            </div>
                                        </div>
                                         
                                        <div class="col-md-2">
                                            <label>روز</label>
                                            <div class="form-group">
                                            <select name="day" id="day" class="form-control" required>
                                            <?php
                                                for($i=1; $i<=30; $i++)
                                                { ?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?> </option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>ماه</label>
                                            <div class="form-group">
                                            <select name="month" id="month" class="form-control" required>
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
                                            <select name="year" id="year" class="form-control" required>
                                            <?php
                                                for($i=1395; $i<=1405; $i++)
                                                { ?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?> </option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12" style="margin-bottom: 40px; font-size: 20px; color: black;">
                                             <!-- <button type="button" onclick="add_more('1');" id="addmore1"  ><i class="fa fa-plus"></i></button>
                                             <button type="button" class="btn btn-success" onclick="calculateamount();">جمع</button> -->
                                             <input type="hidden" name="ex_number" id="ex_number" readonly value="1">
                                             
                                           <div class="sameheight">
                                                <div class="feebox">
                                                    <div> 
                                                        <p style="color: black; font-size: 16px;">نوعیت ساخت"
                                                         <b style="margin-right: 60px; margin-left: 220px; color: green;"> </b> 
                                                         <label>چپ--<label><b style="margin-right: 10px; margin-left: 10px;">  موقعیت </b><label>--راست <label>
                                                           </p>
                                                    </div>
                                                    

                                                    <table class="table3" id="tableID">
                                                        <tr id="row1">
                                                            <td>
                                                                <select style="width: 155px;" name="allowance_type1" class="form-control" id="allowance_type1" onchange="bringLabconf('1');">
 
                                                                    <?php 
                                                                        foreach ($labconf as $std) {
                                                                            echo '<option value="'.$std['test_name'].'">'.$std['test_name'].'</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td></td>
                                                            
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox8" id="checkbox8" value="1">8
                                                            </td>
                                                            <td>
                                                               <input style="font-size: 10px;" type="checkbox" name="checkbox7" id="checkbox7" value="1">7
                                                             </td>
                                                             <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox6" id="checkbox6" value="1">6
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox5" id="checkbox5" value="1">5
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox4" id="checkbox4" value="1">4
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox3" id="checkbox3" value="1">3
                                                            </td>
                                                            
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox2" id="checkbox2" value="1">2
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox1" id="checkbox1" value="1">1
                                                            </td>
                                                            
                                                            <td ><h1 style="hieght: 90px;">|</h1>
                                                             </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox9" id="checkbox9" value="1">1
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox10" id="checkbox10" value="1">2
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox11" id="checkbox11" value="1">3
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox12" id="checkbox12" value="1">4
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox13" id="checkbox13" value="1">5
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox14" id="checkbox14" value="1">6
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox15" id="checkbox15" value="1">7
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox16" id="checkbox16" value="1">8
                                                            </td>
                                                        </tr>
                                                        <tr id="row1">
                                                            <td>
                                                                
                                                            </td><td>
                                                                
                                                                </td>
                                                            
                                                            
                                                            
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox24" id="checkbox24" value="1">8
                                                            </td>
                                                            <td>
                                                               <input style="font-size: 10px;" type="checkbox" name="checkbox23" id="checkbox23" value="1">7
                                                             </td>
                                                             <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox22" id="checkbox22" value="1">6
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox21" id="checkbox21" value="1">5
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox20" id="checkbox20" value="1">4
                                                            </td>
                                                             <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox19" id="checkbox19" value="1">3
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox18" id="checkbox18" value="1">2
                                                            </td>
                                                           <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox17" id="checkbox17" value="1">1
                                                            </td>
                                                            <td ><h1 style="hieght: 90px;">|</h1>
                                                             </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox25" id="checkbox25" value="1">1
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox26" id="checkbox26" value="1">2
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox27" id="checkbox27" value="1">3
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox28" id="checkbox28" value="1">4
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox29" id="checkbox29" value="1">5
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox30" id="checkbox30" value="1">6
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox31" id="checkbox31" value="1">7
                                                            </td>
                                                            <td>
                                                                <input style="font-size: 10px;" type="checkbox" name="checkbox32" id="checkbox32" value="1">8
                                                            </td>
                                                            <td></td> 
                                                        </tr> 
                                                    </table>  

                                                    
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                            <td><br>
                                                                <label>قمت فی واحد-افغانی </label>
                                                                <input type="number" id="allowance_amount1" name="allowance_amount1"  value="0">
                                                            </td>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <td><br>
                                                                <label>تعداد </label>
                                                                <input type="number" name="numbers" id="numbers"  value="0">
                                                            </td>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <td><br>
                                                                <label>مجموع مبلغ-افغانی </label>
                                                                <input type="number" name="amount_all" id="amount_all" onclick = totalDue(); value="0">
                                                            </td>
                                                        </div>
                                                        <div class="col-md-3"><br>
                                                        <label>تخفیف- افغانی </label>
                                                            <td>
                                                                <input type="number" name="discount1" id="discount_id"  value="0">
                                                            </td>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div><!--./row--> 
                                </div>
                                <div class="col-md-12"><br>
                                <th>یاداداشت </th>
                                    <td>
                                        <textarea style="width: 100%;  " type="text" value="یادداشت..." name="notes" id="note"></textarea>
                                    </td>
                              </div>
                               </div> 
                                </div><!--./col-md-8-->
                                <div class="row">            
                                <div class="box-footer">
                                    <div class="pull-right">
                                       <!--  <button style="color: white;" type="submit" class="btn btn-info pull-right"><a href="<?php echo base_url(); ?>admin/patient/print/<?php echo $student['id'] ?>">Submit and Print</a></button> -->
                                       <button style="color: white;" type="submit" class="btn btn-info pull-right">ذخیره   </button>
                                       <button style="color: white; margin-left:20px; font-size: 10px;" type="button" class="btn btn-danger pull-right" data-dismiss="modal">برگشت </button>
                                    </div>
                                </div>
                            </div><!--./row-->  
                        </form> 
            </div><!--./col-md-12-->       
        </div><!--./row--> 
    </div>
</div>

<script>
    $(document).ready(function (e) {
        $('#formadd').on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
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

                }
            });


        }));

    });


    function get(id) {
        console.log(id);
        $.ajax({

            dataType: 'json',

            url: '<?php echo base_url(); ?>admin/chargecategory/get_data/' + id,

            success: function (result) {
                $('#chargecategory_id').val(result.id);
                $('#id_id').val(result.id);
                $('#name_id').val(result.patient_name); 
                $('#father_name_id').val(result.patient_fname); 
                $('#ex_id_two_id').val(result.unique_id); 
                $('#ex_gaurd').val(result.patient_fname);  
                $('#day').val(result.day); 
                $('#month').val(result.month); 
                $('#year').val(result.year);  
                $('#note').val(result.add_description);  
            } 
        });
        $('#editmyModal').modal('show');
    }


    $(document).ready(function (e) {

        $('#editformadd').on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
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

                }
            });


        }));

    });
    
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

</script>