  <aside class="main-sidebar" id="alert2">
 <?php if ($this->rbac->hasPrivilege('student', 'can_view')) { ?>
                        <form class="navbar-form navbar-left search-form2" role="search"  action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="input-group ">

                                <input type="text"  name="search_text" class="form-control search-form" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    <?php } ?>
                <section class="sidebar" id="sibe-box">
                    <?php $this->load->view('layout/top_sidemenu'); ?>
                    <ul class="sidebar-menu verttop">

                    <li class="treeview dashboard_text">
                        <a href="<?php echo base_url()?>admin/admin/dashboard">
                            <i class="fas fa-home"></i> <span>دشبورد</span>
                        </a>
                    </li>

                      <?php
                        if ($this->module_lib->hasActive('OPD')) {
                            if($this->rbac->hasPrivilege('opd_patient', 'can_view')) {
                                ?>
                           <li class="treeview <?php echo set_Topmenu('OPD_Out_Patient'); ?>">
                                    <a href="<?php echo base_url(); ?>admin/patient/reg_search">
                                        <i class="fas fa-users"></i> <span>ثبت </span><i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                    <li class="<?php echo set_Submenu('admin/patient/reg_search'); ?>"> <a href="<?php echo base_url();?>admin/patient/reg_search">
                                        <i class="fas fa-group"></i> <span>لیست داکتران دایمی </span>
                                       </a>
                                     </li>

                                     <li class="<?php echo set_Submenu('admin/patient/new_search'); ?>"> <a href="<?php echo base_url();?>admin/patient/new_search">
                                        <i class="fas fa-group"></i> <span>لیست داکتران متفرقه </span>
                                       </a>
                                     </li>
                                     
                                     <li class="<?php echo set_Submenu('admin/patient/teethlist'); ?>"> <a href="<?php echo base_url();?>admin/patient/teethlist">
                                        <i class="fas fa-list"></i> <span>ساخت دندانها </span>
                                       </a>
                                     </li>

                                     <li class="<?php echo set_Submenu('admin/patient/reg_search'); ?>"> <a href="<?php echo base_url();?>admin/patient/createPatient">
                                     
                                        <i class="fas fa-plus"></i> <span>اضافه </span>
                                       </a>
                                     </li>

                                    </ul>

                            </li>
                          <?php } } ?>
                        <?php
                        if ($this->module_lib->hasActive('OPD')) {
                            if($this->rbac->hasPrivilege('opd_patient', 'can_view')) {
                                ?>
								            <!-- <li class="treeview <?php echo set_Topmenu('OPD_Out_Patient'); ?>">
                                    <a href="<?php echo base_url(); ?>admin/patient/search">
                                        <i class="fas fa-stethoscope"></i> <span>OPD</span><i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                     <li class="<?php echo set_Submenu('admin/radio/search_internal'); ?>"> <a href="<?php echo base_url();?>admin/patient/search_internal">
                                        <i class="fas fa-user"></i> <span>Internal Medicine</span>
                                       </a>
                                     </li>
                                     <li class="<?php echo set_Submenu('admin/radio/search_pediateric'); ?>"> <a href="<?php echo base_url();?>admin/patient/search_pediateric">
                                        <i class="fas fa-stethoscope"></i> <span>Pediateric & Malnutrition</span>
                                       </a>
                                     </li>
                                     <li class="<?php echo set_Submenu('admin/radio/search_ob'); ?>"> <a href="<?php echo base_url();?>admin/patient/search_ob">
                                        <i class="fas fa-stethoscope"></i> <span>OB/GYN</span>
                                       </a>
                                     </li>
                                     <li class="<?php echo set_Submenu('admin/radio/search_general'); ?>"> <a href="<?php echo base_url();?>admin/patient/search_general">
                                        <i class="fas fa-stethoscope"></i> <span>General Surgery</span>
                                       </a>
                                     </li>

                                    </ul>

                            </li> -->
                            <?php } } ?>
                           <?php
                        if ($this->module_lib->hasActive('OPD')) {
                            if($this->rbac->hasPrivilege('opd_patient', 'can_view') ) {
                                ?>
                            <li class="treeview <?php echo set_Topmenu('operation_theatre');?>">
                                    <a href="<?php echo base_url();?>admin/radio/search">
                                        <i class="fas fa-microscope"></i> <span>انواع ساخت دندان</span><i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                      <?php if ($this->module_lib->hasActive('OPD')) {
                                        if($this->rbac->hasPrivilege('opd_patient', 'can_view')) {
                                          ?>
                                       <!-- <li class="<?php echo set_Submenu('admin/radio/search_lab'); ?>"> <a href="<?php echo base_url();?>admin/radio/search_lab">
                                        <i class="fas fa-microscope"></i> <span>نوعیت معاینات</span>
                                       </a></li> -->
                                       <li class="<?php echo set_Submenu('search_lab_config'); ?>">
                                         <a href="<?php echo base_url();?>admin/radio/search_lab_config">
                                           <i class="fas fa-cogs"></i> <span>لیست انواع ساخت دندان</span>
                                         </a>
                                       </li>
                                       <?php } }
                                       if ($this->module_lib->hasActive('expense')) {
                                        if($this->rbac->hasPrivilege('expense','can_view')){
                                       ?>
                                        <?php } } ?>
                                    </ul>

                           </li>
                            <?php } } ?>



				            <?php
                       if ($this->module_lib->hasActive('operation_theatre')) {
                           if($this->rbac->hasPrivilege('ot_patient', 'can_view')) {
                                ?>
								            <!--  <li class="treeview <?php echo set_Topmenu('operation_theatre');?> ">
                                    <a href="<?php echo base_url() ?>admin/operationtheatre/otsearch">
                                        <i class="fas fa-cut"></i> <span>Operations</span>
                                    </a>

                            </li>    -->
                          <?php } } ?>
                            <?php
                       if ($this->module_lib->hasActive('blood_bank')) {
                           if($this->rbac->hasPrivilege('blood_bank_status', 'can_view')) {
                                ?>
							                	<!-- <li class="treeview <?php echo set_Topmenu('blood_bank'); ?>">
                                    <a href="<?php echo base_url()?>admin/bloodbankstatus/">
                                        <i class="fas fa-tint"></i> <span><?php echo $this->lang->line('blood_bank');?></span>

                                    </a>

                                </li> -->
                          <?php } } ?>
                           <?php
                       if ($this->module_lib->hasActive('IPD')) {
                           if($this->rbac->hasPrivilege('ipd_patient', 'can_view')) {
                                ?>
                           <!-- <li class="treeview <?php echo set_Topmenu('IPD_in_patient'); ?>">
                                    <a href="<?php echo base_url() ?>admin/patient/ipdsearch">
                                        <i class="fas fa-procedures" aria-hidden="true"></i> <span>IPD</span><i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                      <li class="<?php echo set_Submenu('ipsearch_list'); ?>"> <a href="<?php echo base_url();?>admin/patient/ipdsearch">
                                        <i class="fas fa-users"></i> <span>Patient List</span>
                                       </a>
                                     </li>
                                     <li class="<?php echo set_Submenu('ipd_patient_nicu'); ?>">
                                       <a href="<?php echo base_url();?>admin/patient/search_nicu">
                                         <i class="fa fa-user"></i>
                                         <span> NICU</span>
                                       </a>
                                     </li>
                                     <li class="<?php echo set_Submenu('ipd_patient_nicu'); ?>">
                                       <a href="<?php echo base_url();?>admin/radio/search_nursing">
                                         <i class="fa fa-user"></i>
                                         <span>Nursing Forceps</span>
                                       </a>
                                     </li>
                                     <li class="<?php echo set_Submenu('ipd_add_nicu'); ?>">
                                       <a href="<?php echo base_url();?>admin/patient/ipd_add_nicu">
                                         <i class="fa fa-plus"></i>
                                         <span>Add NICU</span>
                                       </a>
                                     </li>
                                    </ul>
                                </li> -->
                             <?php } } ?>
                            <?php
                       if ($this->module_lib->hasActive('tpa_management')) {
                           if($this->rbac->hasPrivilege('organisation', 'can_view')) {
                                ?>
                            <?php } }
                            if (($this->module_lib->hasActive('income')) || ($this->module_lib->hasActive('expense'))) {
                              if(($this->rbac->hasPrivilege('income', 'can_view')) || ($this->rbac->hasPrivilege('expense', 'can_view'))) {
                            ?>
								       <!-- <li class="treeview <?php echo set_Topmenu('finance');?>">
                                    <a href="<?php echo base_url(); ?>admin/patient/search">
                                        <i class="fas fa-money-bill-wave"></i>مالی</span> <i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                      <?php if ($this->module_lib->hasActive('income')) {
                                        if($this->rbac->hasPrivilege('income', 'can_view')) {
                                          ?>
                                       <li class="<?php echo set_Submenu('income/index'); ?>"><a href="<?php echo base_url(); ?>admin/income"><i class="fas fa-angle-right"></i>Expenses</a></li>
                                       <?php } }
                                       if ($this->module_lib->hasActive('expense')) {
                                        if($this->rbac->hasPrivilege('expense','can_view')){
                                       ?>
                                        <li class="<?php echo set_Submenu('expense/index'); ?>"><a href="<?php echo base_url(); ?>admin/payroll"><i class="fas fa-angle-right"></i>Employee <?php echo $this->lang->line('payroll'); ?></a></li>
                                        <li class="<?php echo set_Submenu('income/opdincome'); ?>">
                                          <a href="<?php echo base_url(); ?>admin/income/patient_income/<?php echo date('m'); ?>"><i class="fas fa-angle-right"></i>گذارش کلی</a>
                                        </li>
                                         <li class="<?php echo set_Submenu('income/ipdincome'); ?>">
                                          <a href="<?php echo base_url(); ?>admin/income/patient_income2/<?php echo date('m'); ?>"><i class="fas fa-angle-right"></i>IPD Income</a>
                                        </li>  
                                        <?php } } ?>
                                    </ul>

                  </li> -->
                                <?php }
                              }

                                  if ($this->module_lib->hasActive('ambulance')) {
                                     if($this->rbac->hasPrivilege('ambulance','can_view')){
                                ?>
                                <?php } }


                        if ($this->module_lib->hasActive('human_resource')) {
                            if (($this->rbac->hasPrivilege('staff', 'can_view') ||
                             $this->rbac->hasPrivilege('staff_attendance', 'can_view') ||
                              $this->rbac->hasPrivilege('staff_attendance_report', 'can_view') ||
                               $this->rbac->hasPrivilege('staff_payroll', 'can_view') ||
                                $this->rbac->hasPrivilege('payroll_report', 'can_view'))) {
                                ?>

                               <li class="treeview <?php echo set_Topmenu('HR');?>">
                                    <a href="<?php echo base_url(); ?>admin/staff">
                                      <i class="fas fa-sitemap"></i> <span><?php echo $this->lang->line('human_resource'); ?></span>
                                    </a>

                                </li> 


                                <?php
                            }
                        }
                        if ($this->module_lib->hasActive('communicate')) {
                            if (($this->rbac->hasPrivilege('notice_board', 'can_view') ||
                             $this->rbac->hasPrivilege('email_sms', 'can_view') ||
                              $this->rbac->hasPrivilege('email_sms_log', 'can_view'))) {
                                ?>
                               <!--  <li class="treeview <?php echo set_Topmenu('Messaging'); ?>">
                                    <a href= "<?php echo base_url();?>admin/notification">
                                        <i class = "fas fa-bullhorn"></i> <span><?php echo $this->lang->line('messaging'); ?></span>
                                    </a>

                                </li> -->
                                <?php
                            }
                        }
                        if ($this->module_lib->hasActive('download_center')) {
                            if (($this->rbac->hasPrivilege('upload_content', 'can_view'))) {
                                ?>
                                <li class="treeview <?php echo set_Topmenu('Download Center'); ?>">
                                    <a href="<?php echo base_url(); ?>admin/content">
                                        <i class="fas fa-download"></i> <span>اثنادها</span>
                                    </a>

                                </li>
                                <?php
                            }
                        }


                        if ($this->module_lib->hasActive('inventory')) {
                            if (($this->rbac->hasPrivilege('issue_item', 'can_view') ||
                             $this->rbac->hasPrivilege('item_stock', 'can_view') ||
                              $this->rbac->hasPrivilege('item', 'can_view') ||
                               $this->rbac->hasPrivilege('item_category', 'can_view') ||
                                $this->rbac->hasPrivilege('item_category', 'can_view') ||
                                 $this->rbac->hasPrivilege('store', 'can_view') ||
                                  $this->rbac->hasPrivilege('supplier', 'can_view'))) {
                                ?>
                                <?php
                            }
                        }
                                if ($this->module_lib->hasActive('front_cms')) {
                                if (($this->rbac->hasPrivilege('event', 'can_view') ||
                                $this->rbac->hasPrivilege('gallery', 'can_view') ||
                                $this->rbac->hasPrivilege('notice', 'can_view') ||
                                $this->rbac->hasPrivilege('media_manager', 'can_view') ||
                                $this->rbac->hasPrivilege('pages', 'can_view') ||
                                $this->rbac->hasPrivilege('menus', 'can_view') ||
                                $this->rbac->hasPrivilege('banner_images', 'can_view'))) {
                                ?>
                                <?php
                            }
                        }

                        if ($this->module_lib->hasActive('reports')) {

                                ?>
                                <li class="treeview <?php echo set_Topmenu('Reports'); ?>">
                                    <a href="#">
                                        <i class="fas fa-line-chart"></i> <span><?php echo $this->lang->line('reports'); ?></span> <i class="fa fa-angle-right pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                      <li class="<?php echo set_Submenu('admin/income/transactionreport'); ?>"><a href="<?php echo base_url(); ?>admin/income/transactionreport"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('transaction_report'); ?></a>
                                      </li> 
                                    <?php
                                    if ($this->module_lib->hasActive('OPD')) {
                                        if ($this->rbac->hasPrivilege('opd_report', 'can_view')) {
                                            ?>
                                            <li class="<?php echo set_Submenu('admin/patient/opd_report'); ?>"><a href="<?php echo base_url(); ?>admin/patient/opd_report"><i class="fas fa-angle-right"></i> گذارش کلی در آمد</a></li>
                                            <?php
                                        } }

                                          if ($this->module_lib->hasActive('IPD')) {
                                        if ($this->rbac->hasPrivilege('ipd_report', 'can_view')) {
                                            ?>
                                             <!-- <li class="<?php echo set_Submenu('admin/patient/ipdreport'); ?>"><a href="<?php echo base_url(); ?>admin/patient/ipdreport"><i class="fas fa-angle-right"></i> گذارش کلی</a></li> -->
                                            <?php
                                        } }

                                           if ($this->module_lib->hasActive('pharmacy')) {
                                        if ($this->rbac->hasPrivilege('pharmacy_bill_report', 'can_view')) {
                                            ?><!-- <li class="<?php echo set_Submenu('admin/pharmacy/billreport'); ?>"><a href="<?php echo base_url(); ?>admin/pharmacy/billreport"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('pharmacy')." ".$this->lang->line('bill')." ".$this->lang->line('report'); ?></a></li> -->
                                            <?php
                                        } }
                                        if ($this->module_lib->hasActive('pathology')) {
                                        if ($this->rbac->hasPrivilege('pathology_patient_report', 'can_view')) {
                                            ?><!-- <li class="<?php echo set_Submenu('admin/pathology/pathologyreport'); ?>"><a href="<?php echo base_url(); ?>admin/pathology/pathologyreport"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('pathology')." ".$this->lang->line('patient')." ".$this->lang->line('report'); ?></a></li> -->
                                            <?php
                                        } }
                                        if ($this->module_lib->hasActive('radiology')) {
                                        if ($this->rbac->hasPrivilege('radiology_patient_report', 'can_view')) {
                                            ?><!-- <li class="<?php echo set_Submenu('admin/radio/radiologyreport'); ?>"><a href="<?php echo base_url(); ?>admin/radio/radiologyreport"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('radiology')." ".$this->lang->line('patient')." ".$this->lang->line('report'); ?></a></li> -->
                                            <?php
                                        } }
                                         if ($this->module_lib->hasActive('operation_theatre')) {
                                        if ($this->rbac->hasPrivilege('ot_report', 'can_view')) {
                                            ?>
                                            <!-- <li class="<?php echo set_Submenu('admin/operationtheatre/otreport'); ?>"><a href="<?php echo base_url(); ?>admin/operationtheatre/otreport"><i class="fas fa-angle-right"></i>Operation Reports</a></li> -->
                                            <?php
                                        } }
                                         if ($this->module_lib->hasActive('blood_bank')) {
                                         if ($this->rbac->hasPrivilege('blood_donor_report', 'can_view')) {
                                            ?>
                                            <!-- <li class="<?php echo set_Submenu('admin/bloodbank/bloodissuereport'); ?>"><a href="<?php echo base_url(); ?>admin/bloodbank/bloodissuereport"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('blood')." ".$this->lang->line('issue')." ".$this->lang->line('report'); ?></a></li> -->
                                            <?php
                                        } }
                                        if ($this->module_lib->hasActive('blood_bank')) {
                                         if ($this->rbac->hasPrivilege('blood_donor_report', 'can_view')) {
                                            ?>
                                            <!-- <li class="<?php echo set_Submenu('admin/bloodbank/blooddonorreport'); ?>"><a href="<?php echo base_url(); ?>admin/bloodbank/blooddonorreport"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('blood')." ".$this->lang->line('donor')." ".$this->lang->line('report'); ?></a></li> -->
                                            <?php
                                        } }

                                        if ($this->module_lib->hasActive('income')) {
                                        if ($this->rbac->hasPrivilege('income', 'can_view')) { ?>
                                        <!-- <li class="<?php echo set_Submenu('admin/income/incomesearch'); ?>"><a href="<?php echo base_url(); ?>admin/income/incomesearch"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('income')." ".$this->lang->line('report'); ?></a></li> -->
                                        <?php } }
                                        if ($this->module_lib->hasActive('expense')) {
                                        if ($this->rbac->hasPrivilege('expense', 'can_view')) { ?>
                                        <!-- <li class="<?php echo set_Submenu('admin/expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('expense')." ".$this->lang->line('report'); ?></a></li> -->
                                        <?php } }
                                     //   if ($this->module_lib->hasActive('income')) {
                                         //if ($this->rbac->hasPrivilege('income', 'can_view')) {
                                            ?>
                                            <?php
                                       // } }
                                        if ($this->rbac->hasPrivilege('payroll_month_report', 'can_view')) {
                                            ?>
                                            <!-- <li class="<?php echo set_Submenu('admin/payroll/payrollreport'); ?>"><a href="<?php echo base_url(); ?>admin/payroll/payrollreport"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('payroll')." ".$this->lang->line('month')." ".$this->lang->line('report'); ?></a></li> -->
                                            <?php
                                        }
                                       if ($this->rbac->hasPrivilege('payroll_report', 'can_view')) {
                                            ?>
                                            <!-- <li class="<?php echo set_Submenu('admin/payroll/payrollsearch'); ?>"><a href="<?php echo base_url(); ?>admin/payroll/payrollsearch"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('payroll_report'); ?></a></li> -->
                                            <?php
                                        }
                                        if ($this->rbac->hasPrivilege('staff_attendance_report', 'can_view')) { 
                                            ?>

                                            <!-- <li class="<?php echo set_Submenu('admin/staffattendance/attendancereport'); ?>"><a href="<?php echo base_url(); ?>admin/staffattendance/attendancereport"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('staff_attendance_report'); ?></a></li> -->
                                            <?php
                                        }

                                        if ($this->rbac->hasPrivilege('user_log', 'can_view')) {
                                            ?>
                                            <li class="<?php echo set_Submenu('userlog/index'); ?>"><a href="<?php echo base_url(); ?>admin/userlog"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('user_log'); ?></a></li>
                                        <?php }
                                        if ($this->rbac->hasPrivilege('patient_login_credential', 'can_view')) {
                                            ?>
                                            <!-- <li class="<?php echo set_Submenu('admin/patient/patientcredentialreport'); ?>"><a href="<?php echo base_url(); ?>admin/patient/patientcredentialreport"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('patient_login_credential'); ?></a></li> -->
                                        <?php }
                                          if ($this->module_lib->hasActive('communicate')) {
                                        if ($this->rbac->hasPrivilege('email_sms_log', 'can_view')) {
                                            ?>
                                            <!-- <li class="<?php echo set_Submenu('mailsms/index'); ?>"><a href="<?php echo base_url(); ?>admin/mailsms/index"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('email_/_sms_log'); ?></a></li> -->
                                        <?php } ?>

                                    </ul>
                                </li>
                                <li class="treeview <?php echo set_Topmenu('setup'); ?>"">
                                    <a href="<?php echo base_url(); ?>">
                                        <i class="fas fa-cogs"></i> <span>موارد اضافی</span> <i class="fa fa-angle-right pull-right"></i>
                                    </a>
                             <ul class="treeview-menu">
                             <?php
                                                if ($this->rbac->hasPrivilege('general_setting', 'can_view')) {
                                            ?>
                                            <li class="<?php echo set_Submenu('schsettings/index'); ?>"><a href="<?php echo base_url(); ?>schsettings"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('settings');?></a></li>

                                            <?php
                                        }
                                        if ($this->rbac->hasPrivilege('charges', 'can_view')) {
                                         ?>
                                         <!-- <li class="<?php echo set_Submenu('charges/index'); ?>"><a href="<?php echo base_url(); ?>admin/charges"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('hospital')." ".$this->lang->line('charges');?></a></li> -->
                                         <?php }
                                         if ($this->module_lib->hasActive('IPD')) {
                                            if($this->rbac->hasPrivilege('bed_status','can_view')){
                                        ?>
                                    <!-- <li class="<?php echo set_Submenu('bed'); ?>"><a href="<?php echo base_url(); ?>admin/setup/bed/status"><i class="fas fa-angle-right"></i>IPD In</a></li> -->
                                    <?php } }
                                      if ($this->module_lib->hasActive('OPD')) {
                                        // if($this->rbac->hasPrivilege('opd_prescription_print_header_footer','can_view')){
                                    ?>
                                    <!-- <li class="<?php echo set_Submenu('admin/printing'); ?>"><a href="<?php echo base_url(); ?>admin/printing"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('print')." ".$this->lang->line('header')." ".$this->lang->line('footer'); ?></a></li> -->
                                    <?php }// }
                                        if($this->module_lib->hasActive('front_office')){
                                        if ($this->rbac->hasPrivilege('setup_front_office', 'can_view')) {
                                            ?>

                                            <!-- <li class="<?php echo set_Submenu('admin/visitorspurpose'); ?>"><a href="<?php echo base_url(); ?>admin/visitorspurpose"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('front_office'); ?></a></li> -->

                                        <?php } }

                                       if ($this->module_lib->hasActive('pharmacy')) {
                                        if($this->rbac->hasPrivilege('medicine_category','can_view')){
                                    ?>
                                    <!-- <li class="<?php echo set_Submenu('medicine/index'); ?>"><a href="<?php echo base_url(); ?>admin/medicinecategory/medicine"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('pharmacy'); ?></a></li> -->
                                    <?php } }
                                    if ($this->module_lib->hasActive('pathology')) {
                                      if($this->rbac->hasPrivilege('pathology_category','can_view')){
                                     ?>
                                     <!-- <li class="<?php echo set_Submenu('addCategory/index'); ?>"><a href="<?php echo base_url(); ?>admin/pathologycategory/addcategory"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('pathology'); ?></a></li> -->
                                     <?php } }
                                     if ($this->module_lib->hasActive('radiology')) {
                                       if($this->rbac->hasPrivilege('radiology_category','can_view')){
                                     ?>
                                     <!--  <li class="<?php echo set_Submenu('addlab/index'); ?>"><a href="<?php echo base_url(); ?>admin/lab/addLab"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('radiology'); ?></a></li> -->
                                      <?php } }
                                        if (($this->module_lib->hasActive('income')) || ($this->module_lib->hasActive('expense')))  {

                                        if (($this->rbac->hasPrivilege('income_head', 'can_view')) || ($this->rbac->hasPrivilege('income_head', 'can_view'))){
                                            ?>
                                             <li class="<?php echo set_Submenu('finance/index'); ?>"><a href="<?php echo base_url(); ?>admin/incomehead"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('finance');?></a></li> 
                                         <?php           }  } ?>
                                         <li class="<?php echo set_Submenu('hr/index'); ?>"><a href="<?php echo base_url(); ?>admin/leavetypes"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('human_resource'); ?></a></li> 
                                         <?php
                                                if ($this->module_lib->hasActive('inventory')){
                                    if($this->rbac->hasPrivilege('item_category', 'can_view')){
                                                 ?>
                                      <!-- <li class="<?php echo set_Submenu('inventory/index'); ?>"><a href="<?php echo base_url(); ?>admin/itemcategory"><i class="fas fa-angle-right"></i> <?php echo $this->lang->line('inventory'); ?></a></li> -->
                                    <?php } } ?>


                                 </ul>

                                </li>
                                <?php
                            }
                        }


                        if ($this->module_lib->hasActive('system_settings')) {
                            if (($this->rbac->hasPrivilege('general_setting', 'can_view') ||
                             $this->rbac->hasPrivilege('session_setting', 'can_view') ||
                              $this->rbac->hasPrivilege('notification_setting', 'can_view') ||
                               $this->rbac->hasPrivilege('sms_setting', 'can_view') ||
                                $this->rbac->hasPrivilege('email_setting', 'can_view') ||
                                 $this->rbac->hasPrivilege('payment_methods', 'can_view') ||
                                  $this->rbac->hasPrivilege('languages', 'can_view') ||
                                   $this->rbac->hasPrivilege('languages', 'can_add') ||
                                    $this->rbac->hasPrivilege('backup_restore', 'can_view') ||
                                     $this->rbac->hasPrivilege('front_cms_setting', 'can_view'))) {
                                ?>


                                <?php
                            }
                        }
                        ?>


                    </ul>
                </section>
            </aside>