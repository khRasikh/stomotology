
<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<form   id="edit_incomedata" class="ptt10"   accept-charset="utf-8" enctype="multipart/form-data">
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
                <label for="exampleInputEmail1"><?php echo $this->lang->line('income_head'); ?></label>
                <select autofocus="" id="inc_head_id" name="inc_head_id" class="form-control" >
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <?php
                    foreach ($incheadlist as $inchead) {
                        ?>
                        <option value="<?php echo $inchead['id'] ?>"<?php
                        if ($income['inc_head_id'] == $inchead['id']) {
                            echo "selected =selected";
                        }
                        ?>><?php echo $inchead['income_category'] ?></option>
                                <?php
                                $count++;
                            }
                            ?>
                </select>
                <span class="text-danger"><?php echo form_error('inc_head_id'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $income['name']); ?>" />
                <input id="income_id"
                       type="hidden" class="form-control"  value="<?php echo $income['id']; ?>" />
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">VO.N</label>
                <input id="invoice_no" name="invoice_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('invoice_no', $income['invoice_no']); ?>" />
                <span class="text-danger"><?php echo form_error('invoice_no'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                <input id="editdate" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($income['date']))); ?>" readonly="readonly" />
                <span class="text-danger"><?php echo form_error('date'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Project Line<small class="req"> *</small></label>
                <input id="project_line" name="project_line" placeholder="" type="text" class="form-control"  value="<?php echo set_value('project_line', $income['project_line']); ?>" />
                <span class="text-danger"><?php echo form_error('project_line'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Dr.<small class="req"> *</small></label>
                <input id="dr" name="dr" placeholder="" type="text" class="form-control"  value="<?php echo set_value('dr', $income['dr']); ?>" />
                <span class="text-danger"><?php echo form_error('dr'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Cr><small class="req"> *</small></label>
                <input id="cr" name="cr" placeholder="" type="text" class="form-control"  value="<?php echo set_value('cr', $income['cr']); ?>" />
                <span class="text-danger"><?php echo form_error('cr'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?><small class="req"> *</small></label>
                <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount', $income['amount']); ?>" />
                <span class="text-danger"><?php echo form_error('amount'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Section<small class="req"> *</small></label>
                <input id="section" name="section" placeholder="" type="text" class="form-control"  value="<?php echo set_value('section', $income['section']); ?>" />
                <span class="text-danger"><?php echo form_error('section'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Donor<small class="req"> *</small></label>
                <input id="donor" name="donor" placeholder="" type="text" class="form-control"  value="<?php echo set_value('donor', $income['donor']); ?>" />
                <span class="text-danger"><?php echo form_error('donor'); ?></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Area<small class="req"> *</small></label>
                <input id="area" name="area" placeholder="" type="text" class="form-control"  value="<?php echo set_value('area', $income['area']); ?>" />
                <span class="text-danger"><?php echo form_error('area'); ?></span>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                <input id="documentsf" name="documents" placeholder="" type="file" class="filestyle form-control" name='file' size='20' data-height="26"  value="<?php echo set_value('documents'); ?>" />
                <span class="text-danger"><?php echo form_error('documents'); ?></span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?><?php echo set_value('description', $income['note']) ?></textarea>
                <span class="text-danger"><?php echo form_error('description'); ?></span>
            </div>
        </div><!-- /.box-body -->
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
        </div>
    </div>   
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $('.filestyle').dropify();
    });
</script>                   
<script type="text/javascript"> $(document).ready(function (e) {
        $("#edit_incomedata").on('submit', (function (e) {
            var id = $("#income_id").val();
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/income/edit/' + id,
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
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#editdate').datepicker({
           
            format: date_format,
            endDate: '+0d',
            autoclose: true
        });
    });
</script>
