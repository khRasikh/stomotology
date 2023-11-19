<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


<div class="content-wrapper" style="min-height: 946px;">  
 
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12"> 
                <div class="box box-primary" id="tachelist">
                <h3 class="box-title titlefix margin-12" style="font-size: 20px; margin: 12px;">لیست تمام ساخت دندان ها</h3>
                    <div class="box-header">
                        <div class="col-md-6">
                        <select name="teeth_id" class="form-control" id="teeth_id" onchange="bringTeethList(this.value);" style="font-size: 20px;">
                            <option value="">انتخاب</option>
                            <?php foreach ($getyears as $std) {
                            echo '<option value="' . $std['year'] . '">' . $std['year'] . '</option>';
                            } ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <input type="text" id="custom-search-input" class="form-control" placeholder="جستجو...">
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                        <table class="table table-striped table-bordered table-hover" id="table_id">
                                <thead style="background-color: #f2f2f2;">
                                    <tr>
                                        <th style="vertical-align: middle;">آی دی</th>
                                        <th style="vertical-align: middle;">نام</th>
                                        <th style="vertical-align: middle;">نام پدر</th>
                                        <th style="vertical-align: middle;">نوعیت ساخت</th>
                                        <th style="vertical-align: middle;">تاریخ ساخت</th>
                                        <th style="vertical-align: middle;">تعداد دندان</th>
                                        <th style="vertical-align: middle;">موقعیت-چب</th>
                                        <th style="vertical-align: middle;">موقعیت-راست</th>
                                        <th style="vertical-align: middle; text-align: right;">مجموع-افغانی</th>
                                        <th style="vertical-align: middle; text-align: right;">عمل</th>
                                    </tr>
                                </thead>
                                <tbody id="charge_table_body">
                                </tbody>

                                <!-- Add this row at the bottom of your table body -->
                                <tr class="box box-solid total-bg" style="font-size: 23px; color: green;">
                                    <td class="text-right" colspan="14">مجموعه ساخت دندان: 
                                        <label id="totalFeesLabel" style="font-size: 24px; color: blue;">0 افغانی</label>، به تعداد
                                        <label id="totalAmountLabel" style="font-size: 24px; color: blue;">0 ساخت</label>. تاریخ فعلی امروز:
                                        <label id="currentDateLabel"  style="font-size: 18px; color: blue;"><?php echo date(' H:i:s Y-m-d'); ?></label>
                                    </td>
                                </tr>
                                <button id="export_button_container">فایل اکسل</button>
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
<style>
    /* Hide default DataTables search box */
    .dataTables_wrapper .dataTables_filter {
        display: none;
    }
</style>
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

function bringTeethList(year = 1400) {
    $.ajax({
        "processing": true,
        "serverSide": true,
        url: '<?php echo base_url(); ?>admin/patient/bringTeeths/' + year,
        type: "GET",
        success: function (response) {
            var data = JSON.parse(response);
            // Create a new HTML string containing the returned data
            var html = '';
            var totalFees = 0;
            var totalAmount = 0;
            for (var i = 0; i < data.length; i++) {
                totalFees += parseInt(data[i].fees);
                totalAmount += 1;
                html += '<tr>';
                html += '<td>' + data[i].unique_id + '</td>';
                html += '<td>' + data[i].patient_name + '</td>';
                html += '<td>' + data[i].patient_fname + '</td>';
                html += '<td>' + data[i].test_name + '</td>';
                html += '<td>' + data[i].day + '-' + data[i].month + '-' + data[i].year + '</td>';
                html += '<td>' + data[i].duplicate + '</td>';
                html += '<td>';
                html += (data[i].lh == 1 ? '8' : '-') + (data[i].lg == 1 ? '7' : '-') + (data[i].lf == 1 ? '6' : '-') + (data[i].le == 1 ? '5' : '-') + (data[i].ld == 1 ? '4' : '-') + (data[i].lc == 1 ? '3' : '-') + (data[i].lb == 1 ? '2' : '-') + (data[i].la == 1 ? '1' : '-');
                html += (data[i].ldh == 1 ? '8' : '-') + (data[i].ldg == 1 ? '7' : '-') + (data[i].ldf == 1 ? '6' : '-') + (data[i].lde == 1 ? '5' : '-') + (data[i].ldd == 1 ? '4' : '-') + (data[i].ldc == 1 ? '3' : '-') + (data[i].ldb == 1 ? '2' : '-') + (data[i].lda == 1 ? '1' : '-');
                html += '</td>';
                html += '<td>';
                html += (data[i].rh == 1 ? '8' : '-') + (data[i].rg == 1 ? '7' : '-') + (data[i].rf == 1 ? '6' : '-') + (data[i].re == 1 ? '5' : '-') + (data[i].rd == 1 ? '4' : '-') + (data[i].rc == 1 ? '3' : '-') + (data[i].rb == 1 ? '2' : '-') + (data[i].ra == 1 ? '1' : '-');
                html += (data[i].rdh == 1 ? '8' : '-') + (data[i].rdg == 1 ? '7' : '-') + (data[i].rdf == 1 ? '6' : '-') + (data[i].rde == 1 ? '5' : '-') + (data[i].rdd == 1 ? '4' : '-') + (data[i].rdc == 1 ? '3' : '-') + (data[i].rdb == 1 ? '2' : '-') + (data[i].rda == 1 ? '1' : '-');
                html += '</td>';
                html += '<td>' + (data[i].fees) + '</td>';
                html += '<td class="text-right">';
                html += '<?php if ($this->rbac->hasPrivilege('student_count_widget', 'can_view')) { ?>';
                html += '<a onclick="get(' + data[i].id + ')" data-target="#editmyModal" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><span class="label label-success"><i class="fa fa-pencil"></i></span></a>';
                html += '<?php } ?>';
                html += '<?php if ($this->rbac->hasPrivilege('student_count_widget', 'can_delete')) { ?>';
                html += '<a class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="delete_recordById(\'<?php echo base_url(); ?>admin/chargecategory/delete/' + data[i].id + '\', \'<?php echo $this->lang->line('delete_message'); ?>\')"><span class="label label-danger"><i class="fa fa-trash"></i></span></a>';
                html += '<?php } ?>';
                html += '</td>';
            }
            // console.log("test", totalAmount, totalFees)
            $('#totalFeesLabel').text(totalFees.toFixed(2) + ' افغانی');
            $('#totalAmountLabel').text(totalAmount + ' ساخت');

            html += '</tr>';
            $('#charge_table_body').html(html);

           

            // Initialize DataTable
            $('#custom-search-input').on('keyup', function () {
                $('#table_id').DataTable().search($(this).val()).draw();
            });

            $('#table_id').DataTable({
                "searching": true, // Disable default search
                "language": {
                    "searchPlaceholder": "درحال جستجو...", // Customize search input placeholder
                }
            });

           // Create Export to Excel button
            var exportButton = $('<button class="btn btn-primary">دانلود فایل اکسل</button>');
            exportButton.on('click', function() {
                exportToExcel(data);
            });

            $('#export_button_container').html(exportButton);
        },
        error: function (erro) {
            console.log("test/erro", erro);
        },
    });
}

function exportToExcel(data) {
    console.log(data)
    if (!data || !Array.isArray(data)) {
        console.error('Data is undefined, null, or not in the correct format.'); 
        return;
    }

    // Define a mapping object to match the existing properties with the desired headers
    const propertyMapping = {
        'unique_id': 'شماره مسلسل',
        'patient_name': 'اسم',
        'patient_fname': 'اسم پدر',
        'test_name': 'تست',
        'duplicate': 'تعداد',
        'day': undefined, // Exclude day, month, year from headers
        'month': undefined,
        'year': undefined,
    };

    // Transform each object's properties to match the desired headers
    const transformedData = data.map(item => {
        const transformedItem = {};
        Object.keys(item).forEach(key => {
            if (key === 'day' || key === 'month' || key === 'year') {
                return; // Skip day, month, year properties
            }
            const newKey = propertyMapping[key];
            if (newKey) {
                transformedItem[newKey] = item[key]; // Rename the property
            }
        });
        // Concatenate day, month, and year into a single property 'تاریخ' (Date)
        transformedItem["موقعیت چپ"] = (item.lh == 1 ? '8' : '-') + (item.lg == 1 ? '7' : '-') + (item.lf == 1 ? '6' : '-') + (item.le == 1 ? '5' : '-') + (item.ld == 1 ? '4' : '-') + (item.lc == 1 ? '3' : '-') + (item.lb == 1 ? '2' : '-') + (item.la == 1 ? '1' : '-')
        transformedItem["موقعیت راست"] = (item.rdh == 1 ? '8' : '-') + (item.rdg == 1 ? '7' : '-') + (item.rdf == 1 ? '6' : '-') + (item.rde == 1 ? '5' : '-') + (item.rdd == 1 ? '4' : '-') + (item.rdc == 1 ? '3' : '-') + (item.rdb == 1 ? '2' : '-') + (item.rda == 1 ? '1' : '-');
        transformedItem['تاریخ'] = item.day + '-' + item.month + '-' + item.year;
        transformedItem['قمت مجموعی'] = item.fees;
        return transformedItem;
    });

    const filename = 'گذارش کلی ساخت دندانها.xlsx';
    const headers = Object.values(propertyMapping).filter(header => header); // Exclude undefined headers

    const worksheet = XLSX.utils.json_to_sheet(transformedData, { header: headers });

    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, 'گذارش ساخت دندانها');

    XLSX.writeFile(workbook, filename);
}

</script>
 
