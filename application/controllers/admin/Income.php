<?php

if (!defined('BASEPATH'))  
    exit('No direct script access allowed');

class Income extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('functions');

                $this->config->load("payroll");
        $this->load->model("report_model");
        $this->load->model("patient_model");
        $this->load->model("income_model");
          $this->search_type = $this->config->item('search_type');
    }

    function index() {
        if (!$this->rbac->hasPrivilege('income', 'can_view')) {
            access_denied();
        }


        $this->session->set_userdata('top_menu', 'finance');
        $this->session->set_userdata('sub_menu', 'income/index');
        $data['title'] = 'Add Income';
        $data['title_list'] = 'Recent Incomes';
        

        $income_result = $this->income_model->get();
        $data['incomelist'] = $income_result;
        $incomeHead = $this->incomehead_model->get();
        $data['incheadlist'] = $incomeHead;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/income/incomeList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add(){
        $this->session->set_userdata('top_menu', 'Income');
        $this->session->set_userdata('sub_menu', 'income/index');
        $data['title'] = 'Add Income';
        $data['title_list'] = 'Recent Incomes';
        $this->form_validation->set_rules('inc_head_id[]',$this->lang->line('income_head'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('name',$this->lang->line('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('documents', $this->lang->line('documents'), 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
             $msg = array(
             'inc_head_id[]' => form_error('inc_head_id[]'),          
             'name' => form_error('name'),
              'date' => form_error('date'),
              'amount' => form_error('amount'),
              'documents' => form_error('documents'),

            );

             $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $data = array(
                'inc_head_id' => $this->input->post('inc_head_id'),
                'name' => $this->input->post('name'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'amount' => $this->input->post('amount'),
                'invoice_no' => $this->input->post('invoice_no'),
                'note' => $this->input->post('description'),
                'documents' => $this->input->post('documents'),
            );
            $insert_id = $this->income_model->add($data);
            if (isset($_FILES["documents"]) && !empty($_FILES['documents']['name'])) {
                $fileInfo = pathinfo($_FILES["documents"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["documents"]["tmp_name"], "./uploads/hospital_income/" . $img_name);
                $data_img = array('id' => $insert_id, 'documents' => 'uploads/hospital_income/' . $img_name);
                $this->income_model->add($data_img);
            }
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
 echo json_encode($array);
    }

    public function download($documents) {
        $this->load->helper('download');
        $filepath = "./uploads/hospital_income/" . $this->uri->segment(6);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(6);
        force_download($name, $data);
    }

    function view($id) {
        if (!$this->rbac->hasPrivilege('income', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $income = $this->income_model->get($id);
        $data['income'] = $income;
        $this->load->view('layout/header', $data);
        $this->load->view('income/incomeShow', $data);
        $this->load->view('layout/footer', $data);
    }

   
    function delete($id) {
        if (!$this->rbac->hasPrivilege('income', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->income_model->remove($id);
        redirect('admin/income/index');
    }

    function create() {
        $data['title'] = 'Add Fees Master';
        $this->form_validation->set_rules('income', 'Fees Master', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('income/incomeCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'income' => $this->input->post('income'),
            );
            $this->income_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">income added successfully</div>');
            redirect('income/index');
        }
    }

    function handle_upload() {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["file"]["type"] != 'image/gif' &&
                    $_FILES["file"]["type"] != 'image/jpeg' &&
                    $_FILES["file"]["type"] != 'image/png') {

                $this->form_validation->set_message('handle_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {

                $this->form_validation->set_message('handle_upload', 'Extension not allowed');
                return false;
            }
            if ($_FILES["file"]["size"] > 10240000) {

                $this->form_validation->set_message('handle_upload', 'File size shoud be less than 100 kB');
                return false;
            }
            if ($error == "") {
                return true;
            }
        } else {
            return true;
        }
    }

function getDataByid($id){
   // print_r($id);
    $data['title'] = 'Edit Fees Master';
 $data['id'] = $id;
     $income = $this->income_model->get($id);
      $data['income'] = $income;
     $expnseHead = $this->incomehead_model->get();
        $data['incheadlist'] = $expnseHead;
$this->load->view('admin/income/editModal', $data);
}


    function edit($id) {

        $data['title'] = 'Edit Fees Master';
        $data['id'] = $id;
        $income = $this->income_model->get($id);
        $data['income'] = $income;
        $data['title_list'] = 'Fees Master List';
        $income_result = $this->income_model->get();
        $data['incomelist'] = $income_result;
        $expnseHead = $this->incomehead_model->get();
        $data['incheadlist'] = $expnseHead;
        $this->form_validation->set_rules('inc_head_id', $this->lang->line('income_head'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('inc_head_id[]',$this->lang->line('income_head'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('name',$this->lang->line('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            // $this->load->view('layout/header', $data);
            // $this->load->view('admin/income/incomeEdit', $data);
            // $this->load->view('layout/footer', $data);
             $msg = array(
             'inc_head_id[]' => form_error('inc_head_id[]'),          
             'amount' => form_error('amount'),           
             'name' => form_error('name'),
               'date' => form_error('date'),
                // 'documents' => form_error('documents'),

            );

             $array = array('status' => 'fail', 'error' => $msg, 'message' => '');

        } else {
            $data = array(
                'id' => $id,
                'inc_head_id' => $this->input->post('inc_head_id'),
                'name' => $this->input->post('name'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'amount' => $this->input->post('amount'),
                'invoice_no' => $this->input->post('invoice_no'),
                'project_line' => $this->input->post('project_line'),
                'dr' => $this->input->post('dr'),
                'cr' => $this->input->post('cr'),
                'section' => $this->input->post('section'),
                'donor' => $this->input->post('donor'),
                'area' => $this->input->post('area'),
                'note' => $this->input->post('description'),
            );
            $insert_id = $this->income_model->add($data);
           // print_r($insert_id);
            if (isset($_FILES["documents"]) && !empty($_FILES['documents']['name'])) {
                $fileInfo = pathinfo($_FILES["documents"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["documents"]["tmp_name"], "./uploads/hospital_income/" . $img_name);
                $data_img = array('id' => $id, 'documents' => 'uploads/hospital_income/' . $img_name);
                $this->income_model->add($data_img);
            }

             $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('update_message'));
        }

        echo json_encode($array);
    }

    public function patient_income()
    {
      if (!$this->rbac->hasPrivilege('income', 'can_view')) {
        access_denied();
      }
      $this->session->set_userdata('top_menu', 'finance');
      $this->session->set_userdata('sub_menu', 'income/opdincome');
      $data['title'] = 'Add Income';
      $data['title_list'] = 'Recent Incomes';

      $income_result = $this->income_model->get();
      $data['incomelist'] = $income_result;
      $incomeHead = $this->incomehead_model->get();
      $data['incheadlist'] = $incomeHead;

      $this->load->view('layout/header', $data);
      $this->load->view('admin/income/opd_income', $data);
      $this->load->view('layout/footer', $data);
    }

    public function patient_income2()
    {
      if (!$this->rbac->hasPrivilege('income', 'can_view')) {
        access_denied();
      }
      $this->session->set_userdata('top_menu', 'finance');
      $this->session->set_userdata('sub_menu', 'income/ipdincome');
      $data['title'] = 'Add Income';
      $data['title_list'] = 'Recent Incomes';

      $income_result = $this->income_model->get();
      $data['incomelist'] = $income_result;
      $incomeHead = $this->incomehead_model->get();
      $data['incheadlist'] = $incomeHead;

      $this->load->view('layout/header', $data);
      $this->load->view('admin/income/ipd_income', $data);
      $this->load->view('layout/footer', $data);
    }

   public function incomeSearch()
        {
  
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'admin/income/incomesearch');

      $select = 'income.id,income.date,income.name,income.invoice_no,income.amount,income.documents,income.note,income_head.income_category,income.inc_head_id';   
    $join  = array('JOIN income_head ON income.inc_head_id = income_head.id');
    $table_name = "income";
    //$this->form_validation->set_rules('search_type', 'Search Type', 'trim|required|xss_clean');

         $search_type = $this->input->post("search_type");
    if(isset($search_type)){
      $search_type = $this->input->post("search_type");
    }else{
      $search_type = "this_month";
    } 
      //if ($this->form_validation->run() == FALSE) {
      if(empty($search_type)){

        $search_type = "";  
        $listMessage =  $this->report_model->getReport($select,$join,$table_name);
      }else{

        $search_table =  "income";
        $search_column =  "date";
         $additional  = array();
         $additional_where  = array();
        $listMessage = $this->report_model->searchReport($select,$join,$table_name,$search_type,$search_table,$search_column);
      
      }
        $data['resultList'] = $listMessage;
         $data["searchlist"] = $this->search_type ;
          $data["search_type"] = $search_type;
            $this->load->view('layout/header', $data);
          $this->load->view('admin/income/incomeSearch', $data);
             $this->load->view('layout/footer', $data);
        }

          public function transactionreport($value='')
        {

             $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'admin/income/transactionreport');
         $search_type = $this->input->post("search_type");
    if(isset($search_type)){
      $search_type = $this->input->post("search_type");
    }else{
      $search_type = "this_month";
    } 
      
        $parameter = array('OPD' => array('label' =>'OPD','table' =>'opd_details',
                                        'search_column' => 'appointment_date','select' => 'opd_details.*,opd_details.appointment_date as date,opd_details.opd_no as reff, patients.id as pid,patients.patient_name,patients.patient_unique_id',
                                        'join' => array('JOIN staff ON opd_details.cons_doctor = staff.id',
                                     'JOIN patients ON opd_details.patient_id = patients.id'
                                  )),
            'IPD' => array('label' =>'IPD','table' =>'ipd_details',
                           'search_column' => 'date',
                           'select' => 'ipd_details.*,payment.paid_amount as amount,patients.id as pid,patients.patient_name,ipd_details.ipd_no as reff,patients.patient_unique_id',
                           'join' => array(
                           'JOIN staff ON ipd_details.cons_doctor = staff.id',
                          'JOIN patients ON ipd_details.patient_id = patients.id',
                          'JOIN payment ON payment.patient_id = patients.id',
                         ),
                       ),
            
            // 'Pharmacy' => array('label' =>'Pharmacy','table' =>'pharmacy_bill_basic',
            //                'search_column' => 'date',
            //                'select' => 'pharmacy_bill_basic.*,pharmacy_bill_basic.customer_name as patient_name,pharmacy_bill_basic.bill_no as reff,pharmacy_bill_basic.net_amount as amount',
            //                'join' => array()
            //                 ),
            //  'Pathology' => array('label' =>'Pathology','table' =>'pathology_report',
            //                'search_column' => 'reporting_date',
            //                'select' => 'pathology_report.*, pathology_report.apply_charge as amount,pathology_report.reporting_date as date,pathology.id, pathology.short_name,charges.id as cid,charges.charge_category,charges.standard_charge',
            //                'join' => array(
            //               'JOIN pathology ON pathology_report.pathology_id = pathology.id',
            //               'JOIN staff ON pathology_report.consultant_doctor = staff.id',
            //               'JOIN charges ON charges.id = pathology.charge_id')
            //                 ),
            //  'Radiology' => array('label' =>'Radiology','table' =>'radiology_report',
            //                'search_column' => 'reporting_date',
            //                'select' => 'radiology_report.*,radiology_report.apply_charge as amount,radiology_report.reporting_date as date, radio.id, radio.short_name,charges.id as cid,charges.charge_category,charges.standard_charge',
            //                'join' =>  array(
            //       'JOIN radio ON radiology_report.radiology_id = radio.id',
            //       'JOIN staff ON radiology_report.consultant_doctor = staff.id',
            //       'JOIN charges ON charges.id = radio.charge_id'
            //     )),
                   'Operation_Theatre' => array('label' =>'Operation Theatre','table' =>'operation_theatre',
                   'search_column' => 'date',
                   'select' => 'operation_theatre.*,patients.id as pid,patients.patient_unique_id,patients.patient_name,charges.id as cid,charges.charge_category,charges.code,charges.description,charges.standard_charge, operation_theatre.apply_charge as amount',
                   'join' =>  array(
                'JOIN patients ON operation_theatre.patient_id=patients.id',
                'JOIN staff ON staff.id = operation_theatre.consultant_doctor',
                'JOIN charges ON operation_theatre.charge_id = charges.id',
              )),

             'Blood_Bank' => array('label' =>'Blood Bank','table' =>'blood_issue',
                   'search_column' => 'created_at',
                   'select' => 'blood_issue.*,blood_issue.created_at as date,blood_issue.recieve_to as patient_name',
                   'join' =>  array()),
             'ambulance' => array('label' =>'Ambulance','table' =>'ambulance_call',
                   'search_column' => 'date',
                   'select' => 'ambulance_call.*',
                   'join' =>  array()),
             'income' => array('label' =>'General Income','table' =>'income',
                   'search_column' => 'date',
                   'select' => 'income.*,income.name as patient_name,income.invoice_no as reff',
                   'join' =>  array('JOIN income_head ON income.inc_head_id = income_head.id')),
             'expense' => array('label' =>'Expenses','table' =>'expenses',
                   'search_column' => 'date',
                   'select' => 'expenses.*,expenses.name as patient_name,expenses.invoice_no as reff',
                   'join' =>  array('JOIN expense_head ON expenses.exp_head_id = expense_head.id')),
             'payroll' => array('label' =>'Payroll','table' =>'staff_payslip',
                   'search_column' => 'payment_date',
                   'select' => 'staff_payslip.*,staff.name as patient_name,staff.surname,staff.employee_id as patient_unique_id,staff_payslip.payment_date as date,staff_payslip.net_salary as amount,staff_payslip.id as reff',
                   'join' =>  array('JOIN staff ON staff_payslip.staff_id = staff.id')),

        );
    
   
        $i = 0 ;
        $data["parameter"] = $parameter ;
        foreach ($parameter as $key => $value) {
            # code...
        
       $select =  $parameter[$key]['select'];
        $join =  $parameter[$key]['join'];
        $table_name = $parameter[$key]['table'];

 // Get the current page number from the URL
 $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

 // Define results per page
 $limit = 10; // Customize this as per your requirement
 $offset = $page;

         if(empty($search_type)){

        $search_type = "";  
        $resultList =  $this->report_model->transactionReport($select,$join,$table_name);

      }else{

        $search_table =  $parameter[$key]['table'];
        $search_column =  $parameter[$key]['search_column'];
         $additional  = array();
         $additional_where  = array();
        $resultList = $this->report_model->searchReport($select,$join,$table_name,$search_type,$search_table,$search_column,$limit, $offset);
      
      }
    
        $rd[$parameter[$key]['label']] = $resultList ;
        $data['parameter'][$key]['resultList'] = $resultList;
    
        $i++;
    }
      $neq["IPD"] = array('label' =>'IPD','table' =>'ipd_details',
                           'search_column' => 'date',
                           'select' => 'ipd_details.*,ipd_billing.net_amount as amount,patients.id as pid,patients.patient_name,ipd_details.ipd_no as reff,patients.patient_unique_id',
                           'join' => array(
                           'JOIN staff ON ipd_details.cons_doctor = staff.id',
                          'JOIN patients ON ipd_details.patient_id = patients.id',
                          'JOIN payment ON payment.patient_id = patients.id',
                          'JOIN ipd_billing ON ipd_billing.patient_id = patients.id',
                         ),
                       );
  

   $resultList2 =  $this->report_model->searchReport($select='ipd_details.*,ipd_billing.net_amount as amount,patients.id as pid,patients.patient_name,ipd_details.ipd_no as reff,patients.patient_unique_id',$join=array(
                           'JOIN staff ON ipd_details.cons_doctor = staff.id',
                          'JOIN patients ON ipd_details.patient_id = patients.id',
                          'JOIN payment ON payment.patient_id = patients.id',
                          'JOIN ipd_billing ON ipd_billing.patient_id = patients.id',
                         ),$table_name='ipd_details',$search_type,$search_table='ipd_billing',$search_column='date',$limit, $offset);
 
 //  $one = array('label' =>'IPD' );
if(!empty($resultList2)){

    array_push($rd["IPD"], $resultList2[0]);
    array_push($data['parameter']["IPD"]['resultList'], $resultList2[0]);

}
  
   //$data['parameter']["IPD"]['resultList'] = $resultList;
   //    echo "<pre>";
   // print_r($rd["IPD"]);
   //  exit();
     $data["resultlist"] = $rd ;
   
         $data["searchlist"] = $this->search_type ;
          $data["search_type"] = $search_type;
            $this->load->view('layout/header', $data);
          $this->load->view('admin/income/transactionReport', $data);
             $this->load->view('layout/footer', $data);
        }

    

    
       
}

?>