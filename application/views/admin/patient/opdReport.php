<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.5.1/jspdf.plugin.autotable.min.js"></script>


<style type="text/css">
    /*REQUIRED*/
    .carousel-row {
        margin-bottom: 10px;
    }
    .slide-row {
        padding: 0;
        background-color: #ffffff;
        min-height: 150px;
        border: 1px solid #e7e7e7;
        overflow: hidden;
        height: auto;
        position: relative;
    }
    .slide-carousel {
        width: 20%;
        float: left;
        display: inline-block;
    }
    .slide-carousel .carousel-indicators {
        margin-bottom: 0;
        bottom: 0;
        background: rgba(0, 0, 0, .5);
    }
    .slide-carousel .carousel-indicators li {
        border-radius: 0;
        width: 20px;
        height: 6px;
    }
    .slide-carousel .carousel-indicators .active {
        margin: 1px;
    }
    .slide-content {
        position: absolute;
        top: 0;
        left: 20%;
        display: block;
        float: left;
        width: 80%;
        max-height: 76%;
        padding: 1.5% 2% 2% 2%;
        overflow-y: auto;
    }
    .slide-content h4 {
        margin-bottom: 3px;
        margin-top: 0;
    }
    .slide-footer {
        position: absolute;
        bottom: 0;
        left: 20%;
        width: 78%;
        height: 20%;
        margin: 1%;
    }
    /* Scrollbars */
    .slide-content::-webkit-scrollbar {
        width: 5px;
    }
    .slide-content::-webkit-scrollbar-thumb:vertical {
        margin: 5px;
        background-color: #999;
        -webkit-border-radius: 5px;
    }
    .slide-content::-webkit-scrollbar-button:start:decrement,
    .slide-content::-webkit-scrollbar-button:end:increment {
        height: 5px;
        display: block;
    }

/* Ensure pagination is RTL */
.pagination {
    direction: rtl;
    display: flex;
    justify-content: flex-start; /* Start pagination from the right */
}

.pagination li {
    margin: 0 3px;
}

.pagination li a, .pagination li span {
    display: inline-block;
    padding: 2px 4px;
    text-decoration: none;
    background-color: #f8f9fa;
}

.pagination li.active span {
    background-color: #007bff;
    color: #fff;
}

.record-pagination-container {
    display: flex;
    justify-content: space-between; /* Distribute space between the two elements */
    align-items: center; /* Align vertically centered */
    color: #007bff
}

.record-pagination-container-one {
    display: flex;
    justify-content: space-between; /* Distribute space between the two elements */
    align-items: center; /* Align vertically centered */
    margin-left: 19px;
}



.custom-thead th {
        background-color: lightblue !important; /* Dark background */
        font-weight: bold;         /* Bold text */
        padding: 8px 12px;         /* Padding for spacing */
        text-align: center;        /* Center the text */
        border: 1px solid #dee2e6; /* Border for cell separation */
        white-space: nowrap;       /* Prevent text wrapping */
        overflow: hidden;          /* Hide overflow if text is too long */
        text-overflow: ellipsis;   /* Add ellipsis for long text */
    }
.custom-tbody tr{
    padding: 8px 12px;         /* Padding for spacing */
    text-align: center;        /* Center the text */
    border: 1px solid #dee2e6; /* Border for cell separation */
    white-space: nowrap;       /* Prevent text wrapping */
    overflow: hidden;          /* Hide overflow if text is too long */
    text-overflow: ellipsis;   /* Add ellipsis for long text */
}
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                <div class="box-header with-border ">
                        <?php if ($title == 'old_patient') { ?>
                                <h3 class="box-title titlefix"><?php echo $this->lang->line('opd') . " " . $this->lang->line('old') . " " . $this->lang->line('patient') ?></h3>
                        <?php } else { ?>
                                <h3 class="box-title titlefix">لیست تمام رسید ها از داکتران - این رسیدات را  در مدت زمان های مختلف جستجو کنید</h3>

                        <?php } ?>
                    </div> 

                    <form role="form" action="<?php echo site_url('admin/patient/opd_report') ?>" method="post" class="">
                        <div class="box-body row">

                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="col-sm-3 col-md-3" >
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('search') . " " . $this->lang->line('type'); ?></label><small class="req"> *</small>
                                    <select class="form-control" id="search_type" name="search_type" onchange="showdate(this.value)">
                                        <option value="all_time"><?php echo $this->lang->line('all') ?></option>
                                        <?php foreach ($searchlist as $key => $search) {
                                            ?>
                                            <option value="<?php echo $key ?>" <?php
                                            if ((isset($search_type)) && ($search_type == $key)) {
                                                echo "selected";
                                            }
                                            ?>><?php echo $search ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('search_type'); ?></span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3" id="fromdate" style="display: none">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('date_from'); ?></label><small class="req"> *</small>
                                    <input id="date_from" name="date_from" placeholder="" type="text" class="form-control date" value="<?php echo set_value('date_from', date($this->customlib->getSchoolDateFormat())); ?>"  />
                                    <span class="text-danger"><?php echo form_error('date_from'); ?></span>
                                </div>
                            </div> 
                            <div class="col-sm-3 col-md-3" id="todate" style="display: none">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('date_to'); ?></label><small class="req"> *</small>
                                    <input id="date_to" name="date_to" placeholder="" type="text" class="form-control date" value="<?php echo set_value('date_to', date($this->customlib->getSchoolDateFormat())); ?>"  />
                                    <span class="text-danger"><?php echo form_error('date_to'); ?></span>
                                </div>
                            </div> 

                            <div class="col-sm-3 col-md-3" id="todate">
                                <div class="form-group">
                                    <label style="color: #ffff">-</label>
                                    <button type="submit" name="search" value="search_filter" class="form-control btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div> 
 
                        </div>

                    </form>
                    <div class="box border0 clear">
                    <div class="box-tools pull-center">
                                <button type="button" class="btn btn-success btn-md" style="margin-bottom: 10px; border-radius: 8px; margin-right: 10px" onclick="exportToExcel()">
                                    <i class="fa fa-list">&nbsp; </i>دانلود به اکسل
                                </button>
                                <a href="<?php echo base_url(); ?>/admin/patient/reg_search" class="btn btn-primary btn-md" style="margin-bottom: 10px; border-radius: 8px;">
                                    <i class="fa fa-users">&nbsp; </i> لیست داکتران
                                </a>
                                <button type="button" class="btn btn-warning btn-md" style="margin-bottom: 10px; border-radius: 8px;" onclick="exportToPDF()">
                                    <i class="fa fa-list">&nbsp; </i>چاپ 
                                </button>
                        </div>  
                        <div class="box-body table-responsive"> 
                         
                            <table class="table table-bordered border-primary table-hover ">
                                <thead class="custom-thead">
                                    <tr>
                                        <th>تاریخ</th>
                                       <th>شماره مسلسل</th> 
                                        <th>آی دی </th>
                                        <th>نام مراجعه کننده</th>
                                        <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                        <!-- <th><?php echo $this->lang->line('age'); ?></th> -->
                                        <th><?php echo $this->lang->line('gender'); ?></th>
                                        <th>نام پدر</th>
                                        <th><?php echo $this->lang->line('address'); ?></th>
                                        <!-- <th><?php echo $this->lang->line('casualty'); ?></th> -->
                                        <!-- <th><?php echo $this->lang->line('refference'); ?></th> -->
                                        <th>گیرنده</th>
                                        <th> رسید-به عدد</th>
                                        <th> رسید-به حروف</th>
                                    </tr>
                                </thead>
                                <tbody class="custom-tbody">
                                    <?php
                                    if (empty($resultlist)) {
                                        ?>
                                                <tr>
                                                    <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?>
                                                    </td>
                                                </tr>   
                                        <?php
                                    } else{
                                        $count = 1;
                                        $total = 0;
                                        foreach ($resultlist as $report) {
                                            if (!empty($report['amount'])) {
                                                $total += $report['amount'];
                                            }
                                            ?>      
                                            <tr>
                                                <td><?php echo $report['bp']; ?>-<?php echo $report['symptoms']; ?>-<?php echo $report['casualty']; ?></td>  
                                                <td><?php echo $report['opd_no']; ?></td>  
                                                <td><?php echo $report['patient_unique_id']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>admin/patient/profile/<?php echo $report['pid']; ?>"><?php echo $report['patient_name'] ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $report['mobileno']; ?></td>
                                                <td><?php echo $report['gender']; ?></td>
                                                <td><?php echo $report['guardian_name']; ?></td>
                                                <td><?php echo $report['address']; ?></td>
                                                <td><?php echo $report['name'] . " " . $report['surname']; ?></td>
                                                <td><?php echo $report['amount']; ?>
                                                <td class="text-right"><?php echo $report['payment_mode']; ?></td>
                                                </td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                    <tr class="box box-solid total-bg" style="font-size: 22px; color: green;">
                                        <td class="text-right" colspan='14'>  مجموع رسید از  <?php echo "{$total_records}" ?> ثبت  <label style="margin-right: 70%;"><?php echo "{$total_amount}" ?> افغانی</label>
                                        </td>
                                    </tr>
<?php } ?>
                            </table>
                                <!-- Pagination Links -->
                                <div class="record-pagination-container-one">
                                    <div>
                                        <?php echo $pagination; ?>
                                    </div>
                                    <div>
                                        <?php echo "ثبت {$start_record} الی {$end_record}  از مجموع تعداد {$total_records} رسید عواید"; ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>   
</div>  
</section>
</div>


<script type="text/javascript">
    $(document).ready(function (e) {

        showdate('<?php echo $search_type; ?>');
    });

    function showdate(value) {

        if (value == 'period') {
            $('#fromdate').show();
            $('#todate').show();
        } else {
            $('#fromdate').hide();
            $('#todate').hide();
        }
    }
function exportToExcel() {
    var searchType = document.getElementById('search_type').value;
    $.ajax({
        url: '<?php echo base_url("admin/patient/get_opd_report_data"); ?>',  // Your server-side method URL
        type: 'POST',  // Changed to POST since we are sending data
        dataType: 'json',
        data: { search_type: searchType },  // Passing search_type as a parameter
        success: function(data) {
            if (data) {
                generateExcel(data);
            } else {
                console.error('No data received from the server');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX request failed:', status, error);
            console.error('Response:', xhr.responseText);
        }
    });
}


function generateExcel(data) {
    if (!data || !Array.isArray(data)) {
        console.error('Data is undefined, null, or not in the correct format.');
        return;
    }

    const propertyMapping = { 
        'patient_unique_id': 'شماره مسلسل',
        'pid': 'آی دی',
        'patient_name': 'نام مراجعه کننده',
        'mobileno': 'شماره تلفن همراه',
        'gender': 'حالت مدنی',
        'guardian_name': 'نام پدر',
        'address': 'آدرس',
        'name': 'گیرنده',
        'amount': 'رسید-به عدد',
        'payment_mode': 'رسید-به حروف',
    };

    let totalAmount = 0;
    const transformedData = data.map(item => {
        const transformedItem = {};
        Object.keys(propertyMapping).forEach(key => {
            if (key === 'amount') {
                transformedItem[propertyMapping[key]] = parseFloat(item[key]) || 0; // Convert to float and handle missing values
                totalAmount += transformedItem[propertyMapping[key]]; // Accumulate total amount
            } else {
                transformedItem[propertyMapping[key]] = item[key] || ''; // Handle missing values
            }
        });

        transformedItem['تاریخ'] = item.bp + '-' + item.symptoms + '-' + item.casualty;
        return transformedItem;
    });

    // Create the Excel file
    const filename = 'رسید مجموعی.xlsx';
    const headers = Object.values(propertyMapping);

    const worksheet = XLSX.utils.json_to_sheet(transformedData, { header: headers });
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, 'لیست رسید مجموعی از داکتران');

    // Add the total amount row
    const totalRow = headers.map(header => {
        return header === 'رسید-به عدد' ? `${totalAmount}` : ''; // Add total amount in the 'amount' column
    });

    XLSX.utils.sheet_add_aoa(worksheet, [totalRow], { origin: -1 }); // Append totalRow to the end

    XLSX.writeFile(workbook, filename);
}

function generatePositionString(item, ...positions) {
    return positions.map(pos => item[pos] == 1 ? pos.slice(-1) : '-').join('');
}

function exportToPDF(data) {
    const { jsPDF } = window.jspdf;
    
    if (!data || !Array.isArray(data)) {
        console.error('Data is undefined, null, or not in the correct format.');
        return;
    }
    
    const doc = new jsPDF();
    const pageWidth = doc.internal.pageSize.getWidth();
    const pageHeight = doc.internal.pageSize.getHeight();
    
    let yOffset = 10; // Initial y offset
    
    doc.setFontSize(12);
    doc.text('لیست رسید مجموعی از داکتران', pageWidth / 2, yOffset, { align: 'center' });
    yOffset += 10;

    // Define columns
    const columns = [
        'تاریخ', 'شماره مسلسل', 'آی دی', 'نام مراجعه کننده', 
        'شماره تلفن همراه', 'حالت مدنی', 'نام پدر', 'آدرس', 
        'گیرنده', 'رسید-به عدد', 'رسید-به حروف'
    ];
    
    // Map data to rows
    const dataRows = data.map(item => [
        `${item.bp}-${item.symptoms}-${item.casualty}`,
        item.patient_unique_id,
        item.pid,
        item.patient_name,
        item.mobileno,
        item.gender,
        item.guardian_name,
        item.address,
        item.name,
        item.amount,
        item.payment_mode
    ]);
    
    // Generate table
    doc.autoTable({
        head: [columns],
        body: dataRows,
        startY: yOffset,
        theme: 'striped',
        styles: { overflow: 'linebreak' },
        headStyles: { fillColor: [0, 0, 0] }, // Black header background
        columnStyles: { 9: { halign: 'right' } } // Align 'amount' column to right
    });
    
    // Add total amount
    const totalAmount = data.reduce((sum, item) => sum + (parseFloat(item.amount) || 0), 0);
    yOffset = doc.autoTable.previous.finalY + 10; // Update yOffset for footer
    doc.text(`مجموع رسید: ${totalAmount}`, pageWidth / 2, yOffset, { align: 'center' });
    
    // Save PDF
    doc.save('report.pdf');
}


</script>