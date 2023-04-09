<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">


                <?php
                $bar_chart = true;
                $line_chart = true;
                foreach ($notifications as $notice_key => $notice_value) {
                    ?>

                    <div class="dashalert alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="alertclose close close_notice" data-dismiss="alert" aria-label="Close" data-noticeid="<?php echo $notice_value->id; ?>"><span aria-hidden="true">&times;</span></button>

                        <a href="<?php echo site_url('admin/notification') ?>"><?php echo $notice_value->title; ?></a>
                    </div>

                    <?php
                }
                ?>

            </div>
            <?php
            $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
            ?>  
            <?php
            $div_col = 12;
            $div_rol = 12;

            if ($this->rbac->hasPrivilege('staff_role_count_widget', 'can_view')) {
                $div_col = 9;
                $div_rol = 12;
            }

            $widget_col = array();
            if ($this->rbac->hasPrivilege('Monthly fees_collection_widget', 'can_view')) {
                $widget_col[0] = 1;
                $div_rol = 3;
            }

            if ($this->rbac->hasPrivilege('monthly_expense_widget', 'can_view')) {
                $widget_col[1] = 2;
                $div_rol = 3;
            }

            if ($this->rbac->hasPrivilege('student_count_widget', 'can_view')) {
                $widget_col[2] = 3;
                $div_rol = 3;
            }
            $div = sizeof($widget_col);

            if (!empty($widget_col)) {
                $widget = 12 / $div;
            } else {
                $widget = 12;
            }
            ?>          




        </div><!--./row-->

        <div class="row">



            <?php
            if ($this->module_lib->hasActive('OPD')) {
                if ($this->rbac->hasPrivilege('opd_income_widget', 'can_view')) {
                    ?>

                    <div class="col-lg-2 col-md-3 col-sm-6 col20
                         ">
                        <div class="info-box">
                            <a href="<?php echo site_url('admin/patient/reg_search') ?>">
                                <span class="info-box-icon bg-green"><i class="fas fa-users myICONfont"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">تعداد داکتران دایمی</span>
                                    <span class="info-box-number"><?php
                                        if (!empty($permanent['permanent'])) {
                                            echo  $permanent['permanent']." نفر";
                                        } else {
                                            echo "0 "."نفر";
                                        }
                                        ?></span>
                                </div>
                            </a>
                        </div>
                    </div> 
                <?php }
            }
            ?>
            <?php
            if ($this->module_lib->hasActive('IPD')) {
                if ($this->rbac->hasPrivilege('ipd_income_widget', 'can_view')) {
                    ?>
                    <div class="col-lg-2 col-md-3 col-sm-6 col20
                         ">
                        <div class="info-box">
                            <a href="<?php echo site_url('admin/patient/new_search') ?>">
                                <span class="info-box-icon bg-green"><i class="fas fa-user myICONfont"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">تعداد داکتران متفرقه</span>
                                    <span class="info-box-number"><?php
                                        if (!empty($temporary['new'])) {
                                            echo $temporary['new']." نفر";
                                        } else {
                                            echo "0"." نفر";
                                        }
                                        ?></span>
                                </div>
                            </a>
                        </div>
                    </div><!--./col-lg-2-->
                <?php }
                    }
                    ?>
                <?php
                if ($this->module_lib->hasActive('radiology')) {
                    if ($this->rbac->hasPrivilege('radiology_income_widget', 'can_view')) {
                        ?>
                        <div class="col-lg-2 col-md-3 col-sm-6 col20">
                        <div class="info-box">
                            <a href="<?php echo site_url('admin/patient/opd_report') ?>">
                                <span class="info-box-icon bg-green"><i class="fas fa-microscope myICONfont"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">مجموع سرمایه</span>
                                    <span class="info-box-number"><?php
                                        if (!empty($total_amount['amount'])) {
                                            echo $total_amount['amount']." افغانی ";
                                        } else {
                                            echo "0";
                                        }
                                        ?></span>
                                </div>
                            </a>
                        </div>
                    </div><!--./col-lg-2-->   

                    <div class="col-lg-2 col-md-3 col-sm-6 col20">
                        <div class="info-box">
                            <a href="<?php echo site_url('admin/patient/opd_report') ?>">
                                <span class="info-box-icon bg-green"><i class="fas fa-microscope myICONfont"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">مجموع رسید از داکتران</span>
                                    <span class="info-box-number"><?php
                                        if (!empty($total_recieved['recieved'])) {
                                            echo $total_recieved['recieved']." افغانی ";
                                        } else {
                                            echo "0";
                                        }
                                        ?></span>
                                </div>
                            </a>
                        </div>
                    </div><!--./col-lg-2-->

                    <div class="col-lg-2 col-md-3 col-sm-6 col20">
                        <div class="info-box">
                            <a href="<?php echo site_url('admin/patient/opd_report') ?>">
                                <span class="info-box-icon bg-green"><i class="fas fa-microscope myICONfont"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">مجموع طلبکار از داکتران</span>
                                    <span class="info-box-number"><?php
                                        $total_due = $total_amount['amount']-$total_recieved['recieved']; 
                                        if (!empty($total_due)) {
                                            echo $total_due." افغانی ";
                                        } else {
                                            echo "0";
                                        }
                                        ?></span>
                                </div>
                            </a>
                        </div>
                    </div><!--./col-lg-2-->

                    <div class="col-lg-2 col-md-3 col-sm-6 col20">
                        <div class="info-box">
                            <a href="<?php echo site_url('admin/patient/opd_report') ?>">
                                <span class="info-box-icon bg-green"><i class="fas fa-microscope myICONfont"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">تعداد داکتران مونث</span>
                                    <span class="info-box-number"><?php
                                        if (!empty($total_female['female'])) {
                                            echo $total_female['female']." نفر ";
                                        } else {
                                            echo "0";
                                        }
                                        ?></span>
                                </div>
                            </a>
                        </div>
                    </div><!--./col-lg-2-->

                    <div class="col-lg-2 col-md-3 col-sm-6 col20">
                        <div class="info-box">
                            <a href="<?php echo site_url('admin/patient/opd_report') ?>">
                                <span class="info-box-icon bg-green"><i class="fas fa-microscope myICONfont"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">تعداد داکتران مذکر</span>
                                    <span class="info-box-number"><?php
                                        if (!empty($total_male['male'])) {
                                            echo $total_male['male']." نفر ";
                                        } else {
                                            echo "0";
                                        }
                                        ?></span>
                                </div>
                            </a>
                        </div>
                    </div><!--./col-lg-2-->
                    <div class="col-lg-2 col-md-3 col-sm-6 col20">
                        <div class="info-box">
                            <a href="<?php echo site_url('admin/patient/opd_report') ?>">
                                <span class="info-box-icon bg-green"><i class="fas fa-microscope myICONfont"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">تعداد کاربران</span>
                                    <span class="info-box-number"><?php
                                            echo "6"." نفر ";
                                        
                                        ?></span>
                                </div>
                            </a>
                        </div>
                    </div><!--./col-lg-2-->
                    <?php }
                }
                ?> 
            <?php if ($this->module_lib->hasActive('income')) { ?>
                <div class="col-lg-2 col-md-3 col-sm-6 col20">
                    <div class="info-box">
                        <a href="#">
                            <span class="info-box-icon bg-green"><i class="fas fa-money-bill-wave myICONfont"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">تعداد نوعیت ساخت دندان</span>
                                <span class="info-box-number"><?php
                                if (!empty($total_teeth['teeth'])) {
                                    echo $total_teeth['teeth']." عدد";
                                } else {
                                    echo "0"."عدد ";
                                }
                                ?></span>
                            </div>
                        </a>
                    </div>
                </div><!--./col-lg-2-->
<?php } ?>
<?php if ($this->module_lib->hasActive('expense')) { ?>
                <div class="col-lg-2 col-md-3 col-sm-6 col20
                     ">
                    <div class="info-box">
                        <a href="<?php echo site_url('admin/expense') ?>">
                            <span class="info-box-icon expenes-red"><i class="fab fa-creative-commons-nc myICONfont"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">مجموع تخفیف</span>
                                <span class="info-box-number"><?php
                                    if (!empty($total_discount['discount'])) {
                                        echo $total_discount['discount']." افغانی";
                                    } else {
                                        echo "0"." افغانی";
                                    }
                                    ?></span>
                            </div>
                        </a>
                    </div>
                </div><!--./col-lg-2-->
<?php } ?>
        </div><!--./row-->

        <div class="row">
<?php
if ($this->rbac->hasPrivilege('yearly_income_expense_chart', 'can_view')) {
    ?>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="panel panel-primary">
                <div class="panel-heading">گراف درآمد ماهوار</div>
                <div class="panel-body">در این گراف آمار دقیق از مجموع در آمد ماهوار را به زودی نمایش میدهد.</div>
                
                <p>حمل</p>
                <div class="container">
                <div class="skills html">90%</div>
                </div>

                <p>ثور</p>
                <div class="container">
                <div class="skills css">80%</div>
                </div>

                <p>جوزا</p>
                <div class="container">
                <div class="skills js">65%</div>
                </div>

                <p>سرطان</p>
                <div class="container">
                <div class="skills php">60%</div>
                </div>
                <br><br>
            </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">گراف درآمد ماهوار</div>
                    <div class="panel-body">در این گراف آمار دقیق از مجموع در آمد ماهوار را به زودی نمایش میدهد.</div>
                    <p>حمل</p>
                    <div class="container">
                    <div class="skills html">90%</div>
                    </div>

                    <p>ثور</p>
                    <div class="container">
                    <div class="skills css">80%</div>
                    </div>

                    <p>جوزا</p>
                    <div class="container">
                    <div class="skills js">65%</div>
                    </div>

                    <p>سرطان</p>
                    <div class="container">
                    <div class="skills php">60%</div>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
<style>
    .container {
    width: 95%; /* Full width */
    background-color: #ddd; /* Grey background */
}

.skills {
    text-align: right; /* Right-align text */
    padding: 2px; /* Add some padding */
    color: white; /* White text color */
}

.html {width: 90%; background-color: #4CAF50;} /* Green */
.css {width: 80%; background-color: #2196F3;} /* Blue */
.js {width: 65%; background-color: #f44336;} /* Red */
.php {width: 60%; background-color: #808080;} /* Dark Grey */
</style>

<?php } ?>
 
</div>  
</div>  
<script src="<?php echo base_url() ?>backend/js/Chart.bundle.js"></script>
<script src="<?php echo base_url() ?>backend/js/utils.js"></script>
<script type="text/javascript">



    window.onload = function () {
        var dataPointss = [];
        console.log(dataPointss);


        var yearly_collection_array = <?php echo json_encode($yearly_collection) ?>;
        var yearly_expense_array = <?php echo json_encode($yearly_expense) ?>;
        var MONTHS = <?php echo json_encode($total_month) ?>;
        console.log(yearly_collection_array);
        console.log(yearly_expense_array);


        var config = {
            type: 'line',
            data: {
                labels: MONTHS,
                datasets: [

                    {
                        label: '<?php echo $this->lang->line('income') ?>',
                        fill: false,
                        backgroundColor: '#66aa18',
                        borderColor: '#66aa18',
                        data: yearly_collection_array,
                    },

                    {
                        label: '<?php echo $this->lang->line('expense') ?>',
                        backgroundColor: window.chartColors.red,
                        borderColor: window.chartColors.red,
                        data: yearly_expense_array,
                        fill: false,
                    }
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: 'Chart Data'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: 'Value'
                            },

                        }]
                }
            }
        };

        var ctx = document.getElementById('lineChart').getContext('2d');
        window.myLine = new Chart(ctx, config);

        /* Pie chart */
        var ph = "pharmacy";

        var dataPointss = [];
        var color = ['#f56954', '#00a65a', '#f39c12', '#2f4074', '#00c0ef', '#3c8dbc', '#d2d6de', '#b7b83f'];
        var datas = <?php echo json_encode($jsonarr) ?>;

    $(document).ready(function () {

        $(document).on('click', '.close_notice', function () {
            var data = $(this).data();
            $.ajax({
                type: "POST",
                url: base_url + "admin/notification/read",
                data: {'notice': data.noticeid},
                dataType: "json",
                success: function (data) {
                    if (data.status == "fail") {

                        errorMsg(data.msg);
                    } else {
                        successMsg(data.msg);
                    }

                }
            });
        });
    });
</script>
