<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">           
            <div class="col-md-12">
                <div class="box box-primary">                  
                    <div class="box-header with-border">
                        <h3 class="box-title titlefix"></h3>
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('income', 'can_add')) { ?>
                               <!--  <a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>  <?php echo $this->lang->line('add_income'); ?></a> -->
                            <?php } ?> 
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-3">Searh IPD Income by Month</div>
                          <div class="col-md-4 col-sm-4 col-xs-6">
                          <?php $month = $this->uri->segment(4); ?>
                           <select name="q" class="form-control select_month">
                                <option value="<?php echo $month; ?>">
                                 <?php if($month==1) echo "January"; elseif($month==2) echo "Febrauary";
                                   elseif($month==3) echo "March"; elseif($month==4) echo "April";
                                   elseif($month==5) echo "May"; elseif($month==6) echo "June";
                                   elseif($month==7) echo "July"; elseif($month==8) echo "August"; 
                                   elseif($month==9) echo "September"; elseif($month==10) echo "October";
                                   elseif($month==11) echo "November"; elseif($month==12) echo "December";?></option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/1">January</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/2">Febrauary</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/3">March</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/4">April</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/5">May</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/6">June</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/7">July</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/8">August</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/9">September</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/10">October</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/11">November</option>
                                   <option value="<?php echo base_url(); ?>admin/income/patient_income2/12">December</option>
                           </select>
                           </div>
                    </div>
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('income_list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Internal </th>
                                        <th>Nursing Charges</th>
                                        <th>Operation</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                        for ($i=1; $i <=31; $i++) {
                                            $d = $i;
                                            if($i < 10){
                                              $d = "0".$i;
                                            } 
                                            $total = 0;
                                            $ipdentranceincome = get_ipdEntranceIncome(date('Y-'.$month.'-'.$d));
                                            $ipdnursingcharge = get_nursingCharges(date('Y-'.$month.'-'.$d));
                                            $ipdoperationincome = get_operationIncome(date('Y-'.$month.'-'.$d));

                                            $total += $ipdentranceincome;
                                            $total += $ipdnursingcharge;
                                            $total += $ipdoperationincome;
                                            $final = $final + $total;
                                            echo "<tr>";
                                            echo "<td>".$i.'</td>';
                                            echo "<td>".date('Y-'.$month.'-'.$d).'</td>';
                                            echo "<td>".$ipdentranceincome."</td>";
                                            echo "<td>".$ipdnursingcharge."</td>";
                                            echo "<td>".$ipdoperationincome."</td>";
                                            echo "<td>".$total."</td>";
                                            echo "</tr>";
                                          }
                                    ?>
                                      <tr style="background-color:#ddd;">
                                         <td></td><td></td><td></td><td></td><td>Total</td><td><?php echo $final; ?></td>
                                      </tr>
                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"><?php echo $this->lang->line('add_income'); ?></h4> 
            </div>


            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <form id="add_income" class="ptt10" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="row">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('income_head'); ?> <small class="req"> *</small></label>
                                        <select autofocus="" id="inc_head_id" name="inc_head_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($incheadlist as $inchead) {
                                                ?>
                                                <option value="<?php echo $inchead['id'] ?>"<?php
                                                if (set_value('inc_head_id') == $inchead['id']) {
                                                    echo "selected = selected";
                                                }
                                                ?>><?php echo $inchead['income_category'] ?></option>

                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                                        <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('invoice_no'); ?></label>
                                        <input id="invoice_no" name="invoice_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('invoice_no'); ?>" />

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                                        <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date'); ?>" readonly="readonly" />

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?><small class="req"> *</small></label>
                                        <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount'); ?>" />

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <input id="documents" name="documents" placeholder="" type="file" class="filestyle form-control"   value="<?php echo set_value('documents'); ?>" />

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                        <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?></textarea>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="box-footer clear">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->       
                        </form>  
                    </div>
                </div>                 
            </div>

        </div>
    </div>    
</div>
<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"> <?php echo $this->lang->line('edit_income'); ?></h4> 
            </div>

            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr" id="edit_data">
                    </div>
                </div>
            </div>

        </div>
    </div>    
</div>

<script>
    $(document).ready(function(){
        $('.select_month').on('change', function(){
        window.location = $(this).val();
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
     
            format: date_format,
            endDate: '+0d',
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });

    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });

    $(document).ready(function (e) {
        $("#add_income").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/income/add',
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
                    alert("Fail")
                }
            });
        }));
    });

    function edit(id) {
        $('#myModaledit').modal('show');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/income/getDataByid/' + id,
            success: function (data) {
                $('#edit_data').html(data);
            },
            error: function () {
                alert("Fail")
            }
        });
    }
</script>