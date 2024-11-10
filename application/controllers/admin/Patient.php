<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class patient extends Admin_Controller
{
  function __construct()
  {

    parent::__construct();
    $this->config->load("payroll");
    $this->load->library('Enc_lib');
    $this->marital_status = $this->config->item('marital_status');
    $this->search_type = $this->config->item('search_type');
    $this->blood_group = $this->config->item('bloodgroup');
    $this->load->model("bed_model");
    $this->load->model("payment_model");
    $this->load->model("report_model");
    $this->load->model("bedgroup_model");
    $this->load->model("floor_model");
    $this->load->model("printing_model");
    $this->charge_type = $this->config->item('charge_type');
    $data["charge_type"] = $this->charge_type;
    $this->patient_login_prefix = "pat";
  }

  public function reg_search()
{
    if (!$this->rbac->hasPrivilege('consultant register', 'can_add')) {
        access_denied();
    }

    $data["title"] = 'Consultant Register';
    $this->session->set_userdata('top_menu', 'Consultant Register');

    $setting = $this->setting_model->get();
    $data['setting'] = $setting;
    $opd_month = $setting[0]['opd_record_month'];
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $data['organisation'] = $this->Organisation_model->get();

    // Get the search text from POST if it exists
    $search_text = $this->input->post('search_text');

    // If search text is provided, count rows based on the search query
    if (!empty($search_text)) {
        $total_rows = $this->patient_model->countSearchPatients($search_text);
    } else {
        // If no search text, count total rows as usual
        $total_rows = $this->patient_model->countPatients();
    }

    $base_url = site_url('admin/patient/reg_search');
    $pagination = configure_pagination($base_url, $total_rows);

    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

    // Fetch paginated data depending on whether a search is being performed
    if (!empty($search_text)) {
        $resultlist = $this->patient_model->searchPatients($search_text, $pagination->per_page, $page);
    } else {
        $resultlist = $this->patient_model->searchByMonth($pagination->per_page, $page);
    }

    $start_record = $page + 1;
    $end_record = min($page + $pagination->per_page, $total_rows);

    // Add total visit and last visit details to the result list
    $i = 0;
    foreach ($resultlist as $visits) {
        $patient_id = $visits["id"];
        $total_visit = $this->patient_model->totalVisit($patient_id);
        $last_visit = $this->patient_model->lastVisit($patient_id);
        $resultlist[$i]["total_visit"] = $total_visit["total_visit"];
        $resultlist[$i]["last_visit"] = $last_visit["last_visit"];
        $i++;
    }

    // Pass data to the view
    $data["resultlist"] = $resultlist;
    $data["pagination"] = $pagination->create_links();
    $data["start_record"] = $start_record;
    $data["end_record"] = $end_record;
    $data["total_records"] = $total_rows;
    $data['labconf'] = $this->patient_model->getLabConf();

    // Load views
    $this->load->view('layout/header');
    $this->load->view('admin/patient/reg_search', $data);
    $this->load->view('layout/footer');
}



  public function getAllDoctors()
  {

    if (!$this->rbac->hasPrivilege('consultant register', 'can_add')) {
      access_denied();
    }
    $data["title"] = 'consultant register';
    $this->session->set_userdata('top_menu', 'consultant register');
    $setting = $this->setting_model->get();
    $data['setting'] = $setting;
    $opd_month = $setting[0]['opd_record_month'];
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $resultlist = $this->patient_model->searchByMonth();
    $data['organisation'] = $this->Organisation_model->get();
    $i = 0;
    // print_r($resultlist);
    // die();
    foreach ($resultlist as $visits) {
      $patient_id = $visits["id"];
      $myPatient_id = $visits['patient_id'];
      $total_visit = $this->patient_model->totalVisit($patient_id);
      $last_visit = $this->patient_model->lastVisit($patient_id);
      $resultlist[$i]["total_visit"] = $total_visit["total_visit"];
      $resultlist[$i]["last_visit"] = $last_visit["last_visit"];
      $i++;
    }
    $data['resultlist1'] = $this->patient_model->searchByMonth_forExShow($opd_month, '');
    $data['labconf'] = $this->patient_model->getLabConf();
    $data["resultlist"] = $resultlist;

    $this->load->view('layout/header');
    $this->load->view('admin/patient/get_all_doctors.php', $data);
    $this->load->view('layout/footer');
  }

  public function new_search()
  {

    if (!$this->rbac->hasPrivilege('consultant register', 'can_add')) {
      access_denied();
    }
    $data["title"] = 'consultant register';
    $this->session->set_userdata('top_menu', 'consultant register');
    $setting = $this->setting_model->get();
    $data['setting'] = $setting;
    $opd_month = $setting[0]['opd_record_month'];
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $resultlist = $this->patient_model->searchNew();
    $data['organisation'] = $this->Organisation_model->get();
    $i = 0;
    // print_r($resultlist);
    // die();
    foreach ($resultlist as $visits) {
      $patient_id = $visits["id"];
      $myPatient_id = $visits['patient_id'];
      $total_visit = $this->patient_model->totalVisit($patient_id);
      $last_visit = $this->patient_model->lastVisit($patient_id);
      $resultlist[$i]["total_visit"] = $total_visit["total_visit"];
      $resultlist[$i]["last_visit"] = $last_visit["last_visit"];
      $i++;
    }
    $data['resultlist1'] = $this->patient_model->searchByMonth_forExShow($opd_month, '');
    $data['labconf'] = $this->patient_model->getLabConf();
    $data["resultlist"] = $resultlist;

    $this->load->view('layout/header');
    $this->load->view('admin/patient/new_search.php', $data);
    $this->load->view('layout/footer');
  }
  public function unauthorized()
  {
    $data = array();
    $this->load->view('layout/header', $data);
    $this->load->view('unauthorized', $data);
    $this->load->view('layout/footer', $data);
  }
  public function getPatientType()
  {
    $opd_ipd_patient_type = $this->input->post('opd_ipd_patient_type');
    $opd_ipd_no = $this->input->post('opd_ipd_no');
    if ($opd_ipd_patient_type == 'opd') {
      if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
        access_denied();
      }
      $result = $this->patient_model->getOpdPatient($opd_ipd_no);
    } elseif ($opd_ipd_patient_type == 'ipd') {
      if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
        access_denied();
      }
      $result = $this->patient_model->getIpdPatient($opd_ipd_no);
    }
    echo json_encode($result);
  }

  public function add_revisit()
  {
    if (!$this->rbac->hasPrivilege('revisit', 'can_add')) {
      access_denied();
    }
    $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');
    // $this->form_validation->set_rules('appointment_date', $this->lang->line('appointment')." ".$this->lang->line('date'),'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'firstname' => form_error('name'),
        //  'appointment_date' => form_error('appointment_date'),
        'amount' => form_error('amount'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $check_patient_id = $this->patient_model->getMaxOPDId();
      if (empty($check_patient_id)) {
        $check_patient_id = 0;
      }

      $opdn_id = $check_patient_id + 1;


      $patient_id = $this->input->post('id');
      $patient_data = array(
        'id' => $this->input->post('id'),
        'patient_name' => $this->input->post('name'),
        'dob' => $this->input->post('year'),
        'month' => $this->input->post('month'),
        'day' => $this->input->post('day'),
        'updated_at' => date('Y-m-d H:i:s') 
      );
      $this->patient_model->add($patient_data);

      $patient_opd_data = array(
        'patient_id' => $this->input->post('id'),
        'op_type' => $this->input->post('opd'),
        'op_id' => $this->input->post('opdval'),
      );
      if ($this->input->post('opd') != "" && $this->input->post('opdval') != "") {
        $patient_opd_data['op_type'] = $this->input->post('opd');
        $patient_opd_data['op_id'] = $this->input->post('opdval');
      }
      $this->patient_model->addPatientOperation($patient_opd_data);
      // $appointment_date = $this->input->post('appointment_date');
      $id = $this->input->post('id');
      $this->db->select("round", False);
      $this->db->from('opd_details');
      $this->db->where('patient_id', $id);
      $this->db->order_by('id', DESC);
      $this->db->limit(1);
      $q = $this->db->get();
      $result = $q->row();
      $update_round = $result->round + 1;
      $opd_data = array(
        'patient_id' => $this->input->post('id'),
        // 'appointment_date' => date('Y-m-d H:i:s', $this->customlib->datetostrtotime($appointment_date)),
        'opd_no' => $this->input->post('id_number'),
        // 'height' => $this->input->post('height'),
        // 'weight' => $this->input->post('weight'),
        // 'bp' => $this->input->post('bp'),
        // 'case_type' => $this->input->post('revisit_case'),
        // 'symptoms' => $this->input->post('symptoms'),
        // 'known_allergies' => $this->input->post('known_allergies'),
        'refference' => $this->input->post('refference'),
        'cons_doctor' => $this->input->post('consultant_doctor'),
        'amount' => $this->input->post('amount'),
        'casualty' => $this->input->post('year'),
        'symptoms' => $this->input->post('month'),
        'bp' => $this->input->post('day'),
        'payment_mode' => $this->input->post('payment_mode'),
        'note_remark' => $this->input->post('note_remark'),
        // 'date' => date('Y-m-d', $this->customlib->datetostrtotime($appointment_date)),
        'round' => $update_round,
      );

      //       echo "<pre>";
      // print_r($_POST);
      // echo "</pre>";
      // die();
      $opd_id = $this->patient_model->add_opd($opd_data);
      $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
    }
    echo json_encode($array);
  }

  public function print_bill($id = 0)
  {

    $data['patient_opd'] = $this->patient_model->getPatientOPD($id);
    $data['patient'] = $this->patient_model->getPatientNo($id);

    $this->load->view("admin/patient/print_bill", $data);
  }
  public function print_bill_ipd($id = 0)
  {

    $data['patient_opd'] = $this->patient_model->getPatientOPD($id);
    $data['patient'] = $this->patient_model->getPatientNo($id);
    $data['patient_ward'] = $this->patient_model->getthisPatientWard($id);

    $this->load->view("admin/patient/print_bill_ipd", $data);
  }
  public function reg_patient()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_add')) {
      access_denied();
    }
    $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
    // $this->form_validation->set_rules('appointment_date', $this->lang->line('appointment')." ".$this->lang->line('date'),'trim|required|xss_clean');
    $this->form_validation->set_rules('consultant_doctor', $this->lang->line('consultant') . " " . $this->lang->line('doctor'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');

    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'name' => form_error('name'),
        // 'appointment_date' => form_error('appointment_date'),
        'consultant_doctor' => form_error('consultant_doctor'),
        'amount' => form_error('amount'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $check_patient_id = $this->patient_model->getMaxId();
      $check_opd_id = $this->patient_model->getMaxOPDId();
      if (empty($check_patient_id)) {
        $check_patient_id = 1000;
        $check_opd_id = 0;
      }

      $patient_id = $check_patient_id + 1;
      $opdnoid = $check_opd_id + 1;

      $patient_data = array(
        'patient_name' => $this->input->post('name'),
        'guardian_name' => $this->input->post('guardian_name'),
        'gender' => $this->input->post('gender'),
        'age' => $this->input->post('age_year'),
        'month' => $this->input->post('month'),
        'day' => $this->input->post('day'),
        'dob' => $this->input->post('year'),
        'address' => $this->input->post('address'),
        'province' => $this->input->post('province'),
        'district' => $this->input->post('district'),
        'patient_unique_id' => $patient_id,
        'is_active' => 'yes',
        'patient_type' => $this->input->post('patient_type'),
        'mobileno' => $this->input->post('phone_number'),
        'hmis_no' => $this->input->post('id_number'),
        'payment' => $this->input->post('marketer'),
        'test_price' => $this->input->post('porcelen_price'),
        'note' => $this->input->post('note'),
        // 'admission_date' => $this->input->post('appointment_date'),
      );
      // print_r($patient_data); die();
      $insert_id = $this->patient_model->add($patient_data);
      $patient_opd_data = array(
        'patient_id' => $insert_id,
        'op_type' => $this->input->post('opd'),
        'op_id' => $this->input->post('opdval'),
      );
      $this->patient_model->addPatientOperation($patient_opd_data);
      $appointment_date = $this->input->post('appointment_date');
      $opd_data = array(
        // 'appointment_date' => date('Y-m-d H:i:s', $this->customlib->datetostrtotime($appointment_date)),
        'cons_doctor' => $this->input->post('consultant_doctor'),
        'amount' => $this->input->post('amount'),
        'tax' => '0',
        'patient_id' => $insert_id,
        'casualty' => $this->input->post('casualty'),
        'payment_mode' => $this->input->post('payment_mode'),
        // 'opd_no' => 'BEFORE'.$opdnoid,
        'opd_no' => $this->input->post('id_number'),
        'symptoms' => $this->input->post('month'),
        'bp' => $this->input->post('day'),
        'casualty' => $this->input->post('year'),
        'date' => date('Y-m-d', $this->customlib->datetostrtotime($appointment_date)),
        'round' => 1,
      );
      $opd_id = $this->patient_model->add_opd($opd_data);
      $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
      $data_patient_login = array(
        'username' => $this->patient_login_prefix . $insert_id,
        'password' => $user_password,
        'user_id' => $insert_id,
        'role' => 'patient'
      );
      $this->user_model->add($data_patient_login);
      $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
      if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
        $fileInfo = pathinfo($_FILES["file"]["name"]);
        $img_name = $insert_id . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/patient_images/" . $img_name);
        $data_img = array('id' => $insert_id, 'image' => 'uploads/patient_images/' . $img_name);
        $this->patient_model->add($data_img);
      }
      $sender_details = array('patient_id' => $insert_id, 'opd_no' => 'OPDN' . $opdnoid, 'contact_no' => $this->input->post('contact'), 'email' => $this->input->post('email'));
    }
    redirect('admin/patient/reg_search');
    // echo json_encode($patient_data);  
  }
  public function getPatientId()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $result = $this->patient_model->getPatientId();
    $data["result"] = $result;
    echo json_encode($result);
  }
  public function index()
  {

    if (!$this->rbac->hasPrivilege('opd_patient', 'can_add')) {
      access_denied();
    }
    $patient_type = $this->customlib->getPatienttype();
    $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('appointment_date', $this->lang->line('appointment') . " " . $this->lang->line('date'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('consultant_doctor', $this->lang->line('consultant') . " " . $this->lang->line('doctor'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');

    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'name' => form_error('name'),
        'appointment_date' => form_error('appointment_date'),
        'consultant_doctor' => form_error('consultant_doctor'),
        'amount' => form_error('amount'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $check_patient_id = $this->patient_model->getMaxId();
      $check_opd_id = $this->patient_model->getMaxOPDId();
      if (empty($check_patient_id)) {
        $check_patient_id = 1000;
        $check_opd_id = 0;
      }

      $patient_id = $check_patient_id + 1;
      $opdnoid = $check_opd_id + 1;

      $patient_data = array(
        'patient_name' => $this->input->post('name'),
        'mobileno' => $this->input->post('contact'),
        'marital_status' => $this->input->post('marital_status'),
        'email' => $this->input->post('email'),
        'gender' => $this->input->post('gender'),
        'guardian_name' => $this->input->post('guardian_name'),
        'blood_group' => $this->input->post('blood_group'),
        'address' => $this->input->post('address'),
        'patient_unique_id' => $patient_id,
        'note' => $this->input->post('note'),
        'age' => $this->input->post('age'),
        'month' => $this->input->post('month'),
        'is_active' => 'yes',
        'patient_type' => $patient_type['outpatient'],
        'organisation' => $this->input->post('organisation'),
        'province' => $this->input->post('province'),
        'district' => $this->input->post('district'),
        'village' => $this->input->post('village'),
      );
      $insert_id = $this->patient_model->add($patient_data);
      $patient_opd_data = array(
        'patient_id' => $insert_id,
        'op_type' => $this->input->post('opd'),
        'op_id' => $this->input->post('opdval'),
      );
      $this->patient_model->addPatientOperation($patient_opd_data);
      $appointment_date = $this->input->post('appointment_date');
      $opd_data = array(
        'appointment_date' => date('Y-m-d H:i:s', $this->customlib->datetostrtotime($appointment_date)),
        'case_type' => $this->input->post('case'),
        'opd_no' => 'OPDN' . $opdnoid,
        'symptoms' => $this->input->post('symptoms'),
        'known_allergies' => $this->input->post('known_allergies'),
        'refference' => $this->input->post('refference'),
        'cons_doctor' => $this->input->post('consultant_doctor'),
        'amount' => $this->input->post('amount'),
        'tax' => '0',
        'height' => $this->input->post('height'),
        'weight' => $this->input->post('weight'),
        'bp' => $this->input->post('bp'),
        'patient_id' => $insert_id,
        'casualty' => $this->input->post('casualty'),
        'payment_mode' => $this->input->post('payment_mode'),
      );
      $opd_id = $this->patient_model->add_opd($opd_data);
      $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
      $data_patient_login = array(
        'username' => $this->patient_login_prefix . $insert_id,
        'password' => $user_password,
        'user_id' => $insert_id,
        'role' => 'patient'
      );
      $this->user_model->add($data_patient_login);
      $consultant_data = array(
        'patient_id' => $insert_id,
        'date' => date('Y-m-d'),
        'cons_doctor' => $this->input->post('consultant_doctor'),
      );
      $this->patient_model->addCons($consultant_data);
      $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
      if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
        $fileInfo = pathinfo($_FILES["file"]["name"]);
        $img_name = $insert_id . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/patient_images/" . $img_name);
        $data_img = array('id' => $insert_id, 'image' => 'uploads/patient_images/' . $img_name);
        $this->patient_model->add($data_img);
      }
      $sender_details = array('patient_id' => $insert_id, 'opd_no' => 'OPDN' . $opdnoid, 'contact_no' => $this->input->post('contact'), 'email' => $this->input->post('email'));
      $this->mailsmsconf->mailsms('opd_patient_registration', $sender_details);
      $patient_login_detail = array('id' => $insert_id, 'credential_for' => 'patient', 'username' => $this->patient_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $this->input->post('contact'), 'email' => $this->input->post('email'));
      $this->mailsmsconf->mailsms('login_credential', $patient_login_detail);
    }
    echo json_encode($array);
  }
  public function add_info()
  {
    if (!$this->rbac->hasPrivilege('revisit', 'can_add')) {
      access_denied();
    }
    $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('hmis_no', $this->lang->line('hmis_no'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('therapy', "therapy", 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'firstname' => form_error('name'),
        'therapy' => form_error('therapy'),
        'hmis_no' => form_error('hmis_no'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $check_patient_id = $this->patient_model->getMaxOPDId();
      if (empty($check_patient_id)) {
        $check_patient_id = 0;
      }
      $opdn_id = $check_patient_id + 1;
      $patient_id = $this->input->post('id');
      $patient_data = array(
        'id' => $this->input->post('id'),
        'age' => $this->input->post('age'),
        'gender' => $this->input->post('gender'),
        'old_patient' => $this->input->post('new_old'),
        'referred_of' => $this->input->post('referred_off'),
        'diagnostic' => $this->input->post('diagnose'),
        'therapy' => $this->input->post('therapy'),
        'hmis_no' => $this->input->post('hmis_no'),
        'referred_to' => $this->input->post('referred_to'),
        'is_info' => 1,
      );
      $this->patient_model->add($patient_data);

      $patient_opd_data = array(
        'patient_id' => $this->input->post('id'),
        'op_type' => $this->input->post('opd'),
        'op_id' => $this->input->post('opdval'),
      );
      if ($this->input->post('opd') != "" && $this->input->post('opdval') != "") {
        $patient_opd_data['op_type'] = $this->input->post('opd');
        $patient_opd_data['op_id'] = $this->input->post('opdval');
      }
      $this->patient_model->addPatientOperation($patient_opd_data);
      $appointment_date = $this->input->post('appointment_date');
      $opd_data = array(
        'diagnoses' => $this->input->post('diagnose'),
        'therapies' => $this->input->post('therapy'),
        'hmis_nu' => $this->input->post('hmis_no'),
      );
      $pid = $this->input->post('patient_id');
      $round = $this->input->post('round');
      // $opd_id = $this->patient_model->add_opd($opd_data);
      $opd_details = $this->patient_model->update_opd_hmis($pid, $round, $opd_data);
      $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
    }
    // print_r($array);
    echo json_encode($array);
  }


  public function add_patient()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_add')) {
      access_denied();
    }
    $patient_type = $this->customlib->getPatienttype();
    $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('appointment_date', $this->lang->line('appointment') . " " . $this->lang->line('date'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('consultant_doctor', $this->lang->line('consultant') . " " . $this->lang->line('doctor'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');

    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'name' => form_error('name'),
        'appointment_date' => form_error('appointment_date'),
        'consultant_doctor' => form_error('consultant_doctor'),
        'amount' => form_error('amount'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $check_patient_id = $this->patient_model->getMaxId();
      $check_opd_id = $this->patient_model->getMaxOPDId();
      if (empty($check_patient_id)) {
        $check_patient_id = 1000;
        $check_opd_id = 0;
      }

      $patient_id = $check_patient_id + 1;
      $opdnoid = $check_opd_id + 1;

      $patient_data = array(
        'patient_name' => $this->input->post('name'),
        'mobileno' => $this->input->post('contact'),
        'marital_status' => $this->input->post('marital_status'),
        'email' => $this->input->post('email'),
        'gender' => $this->input->post('gender'),
        'guardian_name' => $this->input->post('guardian_name'),
        'blood_group' => $this->input->post('blood_group'),
        'address' => $this->input->post('address'),
        'patient_unique_id' => $patient_id,
        'note' => $this->input->post('note'),
        'age' => $this->input->post('age'),
        'month' => $this->input->post('month'),
        'is_active' => 'yes',
        'patient_type' => $patient_type['outpatient'],
        'organisation' => $this->input->post('organisation'),
        'province' => $this->input->post('province'),
        'district' => $this->input->post('district'),
        'village' => $this->input->post('village'),
      );
      $insert_id = $this->patient_model->add($patient_data);
      $patient_opd_data = array(
        'patient_id' => $insert_id,
        'op_type' => $this->input->post('opd'),
        'op_id' => $this->input->post('opdval'),
      );
      $this->patient_model->addPatientOperation($patient_opd_data);
      $appointment_date = $this->input->post('appointment_date');
      $opd_data = array(
        'appointment_date' => date('Y-m-d H:i:s', $this->customlib->datetostrtotime($appointment_date)),
        'case_type' => $this->input->post('case'),
        'opd_no' => 'OPDN' . $opdnoid,
        'symptoms' => $this->input->post('symptoms'),
        'known_allergies' => $this->input->post('known_allergies'),
        'refference' => $this->input->post('refference'),
        'cons_doctor' => $this->input->post('consultant_doctor'),
        'amount' => $this->input->post('amount'),
        'tax' => '0',
        'height' => $this->input->post('height'),
        'weight' => $this->input->post('weight'),
        'bp' => $this->input->post('bp'),
        'patient_id' => $insert_id,
        'casualty' => $this->input->post('casualty'),
        'payment_mode' => $this->input->post('payment_mode'),
      );
      $opd_id = $this->patient_model->add_opd($opd_data);
      $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
      $data_patient_login = array(
        'username' => $this->patient_login_prefix . $insert_id,
        'password' => $user_password,
        'user_id' => $insert_id,
        'role' => 'patient'
      );
      $this->user_model->add($data_patient_login);
      $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
      if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
        $fileInfo = pathinfo($_FILES["file"]["name"]);
        $img_name = $insert_id . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/patient_images/" . $img_name);
        $data_img = array('id' => $insert_id, 'image' => 'uploads/patient_images/' . $img_name);
        $this->patient_model->add($data_img);
      }
      $sender_details = array('patient_id' => $insert_id, 'opd_no' => 'OPDN' . $opdnoid, 'contact_no' => $this->input->post('contact'), 'email' => $this->input->post('email'));
      $this->mailsmsconf->mailsms('opd_patient_registration', $sender_details);
      $patient_login_detail = array('id' => $insert_id, 'credential_for' => 'patient', 'username' => $this->patient_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $this->input->post('contact'), 'email' => $this->input->post('email'));
      $this->mailsmsconf->mailsms('login_credential', $patient_login_detail);
    }
    redirect('admin/patient/search');
  }
  public function search()
  {

    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["title"] = 'opd_patient';
    $this->session->set_userdata('top_menu', 'OPD_Out_Patient');
    $setting = $this->setting_model->get();
    $data['setting'] = $setting;
    $opd_month = $setting[0]['opd_record_month'];
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;

    if ($opd_month) {
      $resultlist = $this->patient_model->searchByMonth($opd_month, '');
    } else {
      $resultlist = $this->patient_model->searchFullText('1', '');
    }
    $data['organisation'] = $this->Organisation_model->get();
    $i = 0;
    foreach ($resultlist as $visits) {
      $patient_id = $visits["id"];
      $total_visit = $this->patient_model->totalVisit($patient_id);
      $last_visit = $this->patient_model->lastVisit($patient_id);
      $resultlist[$i]["total_visit"] = $total_visit["total_visit"];
      $resultlist[$i]["last_visit"] = $last_visit["last_visit"];
      $i++;
    }
    $data['labconf'] = $this->patient_model->getLabConf();
    $data["resultlist"] = $resultlist;
    $this->load->view('layout/header');
    $this->load->view('admin/patient/search.php', $data);
    $this->load->view('layout/footer');
  }
  public function search_internal()
  {

    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["title"] = 'opd_patient';
    $this->session->set_userdata('top_menu', 'OPD_Out_Patient');
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $resultlist = $this->patient_model->searchByMonth_search_internal($opd_month, '');
    $data['labconf'] = $this->patient_model->getLabConf();
    $data["resultlist"] = $resultlist;
    $this->load->view('layout/header');
    $this->load->view('admin/patient/search_internal.php', $data);
    $this->load->view('layout/footer');
  }

  public function search_pediateric()
  {

    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["title"] = 'opd_patient' . "Padiateric";
    $this->session->set_userdata('top_menu', 'OPD_Out_Patient');
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $resultlist = $this->patient_model->searchByMonth_search_pediateric($opd_month, '');
    $data['labconf'] = $this->patient_model->getLabConf();
    $data["resultlist"] = $resultlist;
    $this->load->view('layout/header');
    $this->load->view('admin/patient/patiateric.php', $data);
    $this->load->view('layout/footer');
  }

  public function search_ob()
  {

    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["title"] = 'opd_patient' . "Padiateric";
    $this->session->set_userdata('top_menu', 'OPD_Out_Patient');
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $resultlist = $this->patient_model->searchByMonth_search_ob($opd_month, '');
    $data['labconf'] = $this->patient_model->getLabConf();
    $data["resultlist"] = $resultlist;
    $this->load->view('layout/header');
    $this->load->view('admin/patient/ob_gyn.php', $data);
    $this->load->view('layout/footer');
  }

  public function search_general()
  {

    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["title"] = 'opd_patient' . "Padiateric";
    $this->session->set_userdata('top_menu', 'OPD_Out_Patient');
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $resultlist = $this->patient_model->searchByMonth_general($opd_month, '');
    $data['labconf'] = $this->patient_model->getLabConf();
    $data["resultlist"] = $resultlist;
    $this->load->view('layout/header');
    $this->load->view('admin/patient/general_surgery.php', $data);
    $this->load->view('layout/footer');
  }

  public function addExamination()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_add')) {
      access_denied();
    }
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // echo  $this->input->post('checkbox2');
    // die();
    // update discount in opd_details table
    $total_discount = $this->input->post('totaldiscount');
    $patient_id = $this->input->post('ex_id');
    $round = $this->input->post('round');
    $cur_discount = $this->patient_model->getCurDiscount($patient_id, $round);
    $final_discount = $cur_discount + $total_discount;
    $d = $this->patient_model->insertDiscount($patient_id, $round, $final_discount);
    $user_record = $this->patient_model->getPatientRecord($this->input->post('ex_id'));
    $allow = $this->input->post('allowance_type1');
    //each time new examination add , we ++ lab_round > visitor might have multiple lab in single visit 
    $round = $this->patient_model->updateLabRound('opd_details', $this->input->post('ex_id'));
    $number = $this->input->post('ex_number');
    for ($i = 1; $i <= $number; $i++) {
      if ($this->input->post('allowance_type' . $i) != "") {
        $allow .= ',' . $this->input->post('allowance_type' . $i);
        $lab_conf_record = $this->patient_model->getLabConfRecord($this->input->post('allowance_type' . $i));
        $lab_array_data = array(
          'patient_name' => $user_record['patient_name'],
          'patient_fname' => $user_record['guardian_name'],
          'patient_id' => $user_record['id'],
          'unique_id' => $this->input->post('patient_unique_id'),
          'age' => $user_record['age'],
          'date' => date('Y-m-d'),
          'year' => $this->input->post('year'),
          'month' => $this->input->post('month'),
          'day' => $this->input->post('day'),
          'gender' => $user_record['gender'],
          // 'operation_type' => $lab_conf_record['test_section'], 
          'test_name' => $lab_conf_record['test_name'],
          // 'fees' => $lab_conf_record['price'],
          'fees' => $this->input->post('amount_all'),
          'discount' => $this->input->post('discount1'),
          'duplicate' => $this->input->post('numbers'),
          'add_description' => $this->input->post('notes'),
          //left up
          'la' => $this->input->post('checkbox1'),
          'lb' => $this->input->post('checkbox2'),
          'lc' => $this->input->post('checkbox3'),
          'ld' => $this->input->post('checkbox4'),
          'le' => $this->input->post('checkbox5'),
          'lf' => $this->input->post('checkbox6'),
          'lg' => $this->input->post('checkbox7'),
          'lh' => $this->input->post('checkbox8'),
          //right up
          'ra' => $this->input->post('checkbox9'),
          'rb' => $this->input->post('checkbox10'),
          'rc' => $this->input->post('checkbox11'),
          'rd' => $this->input->post('checkbox12'),
          're' => $this->input->post('checkbox13'),
          'rf' => $this->input->post('checkbox14'),
          'rg' => $this->input->post('checkbox15'),
          'rh' => $this->input->post('checkbox16'),
          //left down
          'lda' => $this->input->post('checkbox17'),
          'ldb' => $this->input->post('checkbox18'),
          'ldc' => $this->input->post('checkbox19'),
          'ldd' => $this->input->post('checkbox20'),
          'lde' => $this->input->post('checkbox21'),
          'ldf' => $this->input->post('checkbox22'),
          'ldg' => $this->input->post('checkbox23'),
          'ldh' => $this->input->post('checkbox24'),
          //right down
          'rda' => $this->input->post('checkbox25'),
          'rdb' => $this->input->post('checkbox26'),
          'rdc' => $this->input->post('checkbox27'),
          'rdd' => $this->input->post('checkbox28'),
          'rde' => $this->input->post('checkbox29'),
          'rdf' => $this->input->post('checkbox30'),
          'rdg' => $this->input->post('checkbox31'),
          'rdh' => $this->input->post('checkbox32'),
          'created_at' => date('Y-m-d h:i:s'),
          'round' => $round->round,
          'lab_round' => $round->lab_round + 1,
          'lab_time' => time(),
        );
        $this->patient_model->addLabLab($lab_array_data);
        $array = array('status' => 'success', 'error' => '', 'message' => 'Record Added Successfully.');
      }
      echo json_encode($array);
    }
    $res = $this->patient_model->getPatientNo($this->input->post('ex_id'));
    $arrayName = array(
      'id' => $this->input->post('ex_id'),
      'is_examined' => 1,
      'updated_at' => date('Y-m-d H:i:s') 
    );
    $this->patient_model->add($arrayName);
    redirect('admin/patient/reg_search');
  }
  public function editExamination()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_add')) {
      access_denied();
    }
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // echo  $this->input->post('checkbox2');
    // die();
    // update discount in opd_details table
    $total_discount = $this->input->post('totaldiscount');
    $patient_id = $this->input->post('ex_id');
    $round = $this->input->post('round');
    $cur_discount = $this->patient_model->getCurDiscount($patient_id, $round);
    $final_discount = $cur_discount + $total_discount;
    $d = $this->patient_model->insertDiscount($patient_id, $round, $final_discount);
    $user_record = $this->patient_model->getPatientRecord($this->input->post('ex_id'));
    $allow = $this->input->post('allowance_type1');
    //each time new examination add , we ++ lab_round > visitor might have multiple lab in single visit 
    $round = $this->patient_model->updateLabRound('opd_details', $this->input->post('ex_id'));
    $number = $this->input->post('ex_number');
    for ($i = 1; $i <= $number; $i++) {
      if ($this->input->post('allowance_type' . $i) != "") {
        $allow .= ',' . $this->input->post('allowance_type' . $i);
        $lab_conf_record = $this->patient_model->getLabConfRecord($this->input->post('allowance_type' . $i));
        $lab_array_data = array(
          'patient_name' => $user_record['patient_name'],
          'patient_fname' => $user_record['guardian_name'],
          'patient_id' => $user_record['id'],
          'unique_id' => $user_record['patient_unique_id'],
          'age' => $user_record['age'],
          'date' => date('Y-m-d'),
          'year' => $this->input->post('year'),
          'month' => $this->input->post('month'),
          'day' => $this->input->post('day'),
          'gender' => $user_record['gender'],
          // 'operation_type' => $lab_conf_record['test_section'], 
          'test_name' => $lab_conf_record['test_name'],
          // 'fees' => $lab_conf_record['price'],
          'fees' => $this->input->post('amount_all'),
          'discount' => $this->input->post('discount1'),
          'duplicate' => $this->input->post('numbers'),
          'add_description' => $this->input->post('notes'),
          //left up
          'la' => $this->input->post('checkbox1'),
          'lb' => $this->input->post('checkbox2'),
          'lc' => $this->input->post('checkbox3'),
          'ld' => $this->input->post('checkbox4'),
          'le' => $this->input->post('checkbox5'),
          'lf' => $this->input->post('checkbox6'),
          'lg' => $this->input->post('checkbox7'),
          'lh' => $this->input->post('checkbox8'),
          //right up
          'ra' => $this->input->post('checkbox9'),
          'rb' => $this->input->post('checkbox10'),
          'rc' => $this->input->post('checkbox11'),
          'rd' => $this->input->post('checkbox12'),
          're' => $this->input->post('checkbox13'),
          'rf' => $this->input->post('checkbox14'),
          'rg' => $this->input->post('checkbox15'),
          'rh' => $this->input->post('checkbox16'),
          //left down
          'lda' => $this->input->post('checkbox17'),
          'ldb' => $this->input->post('checkbox18'),
          'ldc' => $this->input->post('checkbox19'),
          'ldd' => $this->input->post('checkbox20'),
          'lde' => $this->input->post('checkbox21'),
          'ldf' => $this->input->post('checkbox22'),
          'ldg' => $this->input->post('checkbox23'),
          'ldh' => $this->input->post('checkbox24'),
          //right down
          'rda' => $this->input->post('checkbox25'),
          'rdb' => $this->input->post('checkbox26'),
          'rdc' => $this->input->post('checkbox27'),
          'rdd' => $this->input->post('checkbox28'),
          'rde' => $this->input->post('checkbox29'),
          'rdf' => $this->input->post('checkbox30'),
          'rdg' => $this->input->post('checkbox31'),
          'rdh' => $this->input->post('checkbox32'),
          'created_at' => date('Y-m-d h:i:s'),
          'round' => $round->round,
          'lab_round' => $round->lab_round + 1,
          'lab_time' => time(),
        );
        $this->patient_model->addLabLab($lab_array_data);
        $array = array('status' => 'success', 'error' => '', 'message' => 'Record Added Successfully.');
      }
      echo json_encode($array);
    }
    $res = $this->patient_model->getPatientNo($this->input->post('ex_id'));
    $arrayName = array(
      'id' => $this->input->post('ex_id'),
      'is_examined' => 1,
    );
    $this->patient_model->add($arrayName);
    redirect('admin/patient/teethlist');
  }
  public function handle_upload()
  {
    if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {

      $allowedExts = array('jpg', 'jpeg', 'png');
      $temp = explode(".", $_FILES["file"]["name"]);
      $extension = end($temp);
      if ($_FILES["file"]["error"] > 0) {
        $error .= "Error opening the file<br />";
      }
      if (
        $_FILES["file"]["type"] != 'image/gif' &&
        $_FILES["file"]["type"] != 'image/jpeg' &&
        $_FILES["file"]["type"] != 'image/png'
      ) {
        $this->form_validation->set_message('handle_upload', 'File type not allowed');
        return false;
      }
      if (!in_array($extension, $allowedExts)) {
        $this->form_validation->set_message('handle_upload', 'Extension not allowed');
        return false;
      }
      if ($_FILES["file"]["size"] > 102400) {
        $this->form_validation->set_message('handle_upload', 'File size shoud be less than 100 kB');
        return false;
      }
      return true;
    } else {
      return true;
    }
  }
  public function getOldPatient()
  {
    if (!$this->rbac->hasPrivilege('old_patient', 'can_view')) {
      access_denied();
    }
    $this->session->set_userdata('top_menu', 'OPD_Out_Patient');
    $setting = $this->setting_model->get();
    $data['setting'] = $setting;
    $data['title'] = 'old_patient';
    $opd_month = $setting[0]['opd_record_month'];
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $resultlist = $this->patient_model->searchFullText($opd_month, '');
    $data['organisation'] = $this->Organisation_model->get();
    $i = 0;
    foreach ($resultlist as $visits) {
      $patient_id = $visits["id"];
      $total_visit = $this->patient_model->totalVisit($patient_id);
      $last_visit = $this->patient_model->lastVisit($patient_id);
      $resultlist[$i]["total_visit"] = $total_visit["total_visit"];
      $resultlist[$i]["last_visit"] = $last_visit["last_visit"];
      $i++;
    }
    $data["resultlist"] = $resultlist;
    $this->load->view('layout/header');
    $this->load->view('admin/patient/search.php', $data);
    $this->load->view('layout/footer');
  }

  public function ipdsearch($bedid = '', $bedgroupid = '')
  {
    if (!$this->rbac->hasPrivilege('ipd_patient', 'can_view')) {
      access_denied();
    }
    if (!empty($bedgroupid)) {
      $data["bedid"] = $bedid;
      $data["bedgroupid"] = $bedgroupid;
    }

    $this->session->set_userdata('top_menu', 'IPD_in_patient');
    $this->session->set_userdata('sub_menu', 'ipsearch_list');
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $data['bed_list'] = $this->bed_model->bedNoType();
    $data['floor_list'] = $this->floor_model->floor_list();
    $data['bedlist'] = $this->bed_model->bed_list();
    $data['bedgroup_list'] = $this->bedgroup_model->bedGroupFloor();
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $setting = $this->setting_model->get();
    $data['setting'] = $setting;


    //$data['resultlist']=$this->patient_model->search_ipd_patients('');
    $data['resultlist'] = $this->patient_model->getPtientIpd('');
    $data['patient_ward'] = $this->patient_model->getPatientWard('');
    $i = 0;
    foreach ($data['resultlist'] as $key => $value) {
      $charges = $this->patient_model->getCharges($value["id"]);
      $data['resultlist'][$i]["charges"] = $charges['charge'];
      $payment = $this->patient_model->getPayment($value["id"]);
      $data['resultlist'][$i]["payment"] = $payment['payment'];
      $i++;
    }
    $data['organisation'] = $this->Organisation_model->get();
    //print_r($data['resultlist'][1])."<br>";die;
    $this->load->view('layout/header');
    $this->load->view('admin/patient/ipdsearch.php', $data);
    $this->load->view('layout/footer');
  }

  public function discharged_patients()
  {
    if (!$this->rbac->hasPrivilege('discharged patients', 'can_view')) {
      access_denied();
    }
    $this->session->set_userdata('top_menu', 'IPD_in_patient');
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $data['bed_list'] = $this->bed_model->bedNoType();
    $data['bedgroup_list'] = $this->bedgroup_model->bedGroupFloor();
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $setting = $this->setting_model->get();
    $data['setting'] = $setting;

    $data['resultlist'] = $this->patient_model->search_ipd_patients('', $active = 'no');
    $i = 0;
    foreach ($data['resultlist'] as $key => $value) {
      $charges = $this->patient_model->getCharges($value["id"]);
      $data['resultlist'][$i]["charges"] = $charges['charge'];
      $payment = $this->patient_model->getPayment($value["id"]);
      $data['resultlist'][$i]["payment"] = $payment['payment'];
      $discharge_details = $this->patient_model->getIpdBillDetails($value["id"]);
      $data['resultlist'][$i]["discharge_date"] = $discharge_details['date'];
      $data['resultlist'][$i]["other_charge"] = $discharge_details['other_charge'];
      $data['resultlist'][$i]["tax"] = $discharge_details['tax'];
      $data['resultlist'][$i]["discount"] = $discharge_details['discount'];
      $data['resultlist'][$i]["net_amount"] = $discharge_details['net_amount'] + $payment['payment'];
      $i++;
    }
    $data['organisation'] = $this->Organisation_model->get();
    $this->load->view('layout/header');
    $this->load->view('admin/patient/dischargedPatients.php', $data);
    $this->load->view('layout/footer');
  }
  public function profile($id)
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $data["id"] = $id;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $data["marketer"] = $this->staff_model->getStaffbyrole(2);
    $result = array();
    $diagnosis_details = array();
    $opd_details = array();
    $timeline_list = array();

    //profile page
    if (!empty($id)) {
      $result = $this->patient_model->getDetails($id);
      $opd_details = $this->patient_model->getOPDetails($id);
      // print_r($opd_details);
      $diagnosis_details = $this->patient_model->getDiagnosisDetails($id);
      $timeline_list = $this->timeline_model->getPatientTimeline($id, $timeline_status = '');
    }

    $data["result"] = $result;

    $data['resultlist1'] = $this->patient_model->searchByMonth_forExShow($opd_month, '');
    $data['patient_lab_lab'] = $this->patient_model->getPatientLabLabIncome($id);
    $data['patient_lab_ecg'] = $this->patient_model->getPatientLabECGIncome($id);
    $data['patient_lab_ult'] = $this->patient_model->getPatientLabUltIncome($id);
    $data['patient_lab_xray'] = $this->patient_model->getPatientLabXrayIncome($id);
    $data["diagnosis_detail"] = $diagnosis_details;
    $data["prescription_detail"] = $prescription_details;
    // print_r($data);
    // die();
    $data["opd_details"] = $opd_details;
    $data["timeline_list"] = $timeline_list;
    $data['organisation'] = $this->Organisation_model->get();

    // get diagnosis date
    $data['opd_details_diagnosis'] = $this->patient_model->get_opd_details_diagnosis($this->uri->segment(4));

    $this->load->view("layout/header");
    $this->load->view("admin/patient/profile", $data);
    $this->load->view("layout/footer");
  }

  public function ipdprofile($id, $active = 'yes')
  {
    if (!$this->rbac->hasPrivilege('ipd_patient', 'can_view')) {
      access_denied();
    }
    $data['bed_list'] = $this->bed_model->bedNoType();
    $data['bedgroup_list'] = $this->bedgroup_model->bedGroupFloor();
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $data['organisation'] = $this->Organisation_model->get();

    $data['patientdetail'] = $this->patient_model->getPatientRecord($id);
    $data["id"] = $id;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $result = array();
    $diagnosis_details = array();
    $opd_details = array();
    $timeline_list = array();
    $charges = array();
    if (!empty($id)) {
      $result = $this->patient_model->getIpdDetails($id, $active);
      if ($result['status'] == 'paid') {
        $generate = $this->patient_model->getBillInfo($result["id"]);
        $data["bill_info"] = $generate;
      }
      // $diagnosis_details = $this->patient_model->getDetails($id);
      $data['resultlist1'] = $this->patient_model->searchByMonth_forExShow($opd_month, '');
      $timeline_list = $this->timeline_model->getPatientTimeline($id, $timeline_status = '');
      $prescription_details = $this->prescription_model->getPatientPrescription($id);
      $consultant_register = $this->patient_model->getPatientConsultant($id);
      $charges = $this->charge_model->getCharges($id);
      $paid_amount = $this->payment_model->getPaidTotal($id);
      $data["paid_amount"] = $paid_amount["paid_amount"];
      $balance_amount = $this->payment_model->getBalanceTotal($id);
      $data["balance_amount"] = $balance_amount["balance_amount"];
      $data["consultant_register"] = $consultant_register;
      $data["result"] = $result;
      $data["diagnosis_detail"] = $diagnosis_details;
      $data["prescription_detail"] = $prescription_details;
      $data["opd_details"] = $opd_details;
      $data["timeline_list"] = $timeline_list;
      $data["charge_type"] = $this->charge_type;
      $data["charges"] = $charges;

      //incomes
      $data['patient_price'] = $this->patient_model->getPatientTestPrice($id);
      $data['patient_lab_lab'] = $this->patient_model->getPatientLabLabIncome($id);
      $data['patient_lab_ecg'] = $this->patient_model->getPatientLabECGIncome($id);
      $data['patient_lab_ult'] = $this->patient_model->getPatientLabUltIncome($id);
      $data['patient_lab_xray'] = $this->patient_model->getPatientLabXrayIncome($id);
      $data['patient_ward'] = $this->patient_model->getPatientWardIncome($id);
      //Get Nursing, Operation, and ipd_amount
      // $data['nursing_services'] = $this->patient_model->getNursingServinces($id);
      $data['operations_lists'] = $this->patient_model->getOperationList($id);
      $data['nursing_chges_lists'] = $this->patient_model->getNursingCharges($id);
      $data['ipd_deatils_amount'] = $this->patient_model->getIPDamount($id);

      //get larst Round from opd_detail
      $data['patient_round'] = $this->patient_model->getLastRound('opd_details', $id);
      //Print Last records
      // $nu_lround =  $data['nursing_chges_lists'][0]['round'];
      // echo $data['patient_round'];
      $data['op_li_last'] = $this->patient_model->getOperationListLast($id, $data['patient_round']);
      $data['nursing_last'] = $this->patient_model->getNursingLast($id, $data['patient_round']);
      $data['payment_details'] = $this->payment_model->paymentDetails($id, $data['patient_round']);
      $data['payments'] = $this->payment_model->paymentList($id);
      $data['opd_details_diagnosis'] = $this->patient_model->get_opd_details_diagnosis($this->uri->segment(4));
    }
    $this->load->view("layout/header");
    $this->load->view("admin/patient/ipdprofile", $data);
    $this->load->view("layout/footer");
  }

  public function deleteIpdPatientCharge($pateint_id, $id)
  {
    if (!$this->rbac->hasPrivilege('charges', 'can_delete')) {
      access_denied();
    }
    $this->charge_model->deleteIpdPatientCharge($id);
    $this->session->set_flashdata('msg', '<div class="alert alert-success">Patient Charges deleted successfully</div>');
    redirect('admin/patient/ipdprofile/' . $pateint_id . '#charges');
  }
  public function deleteTeeth($id)
  {
    if (!$this->rbac->hasPrivilege('consultant register', 'can_add')) {
      access_denied();
    }
    $this->patient_model->deleteTeeth($id);
    $this->session->set_flashdata('msg', '<div class="alert alert-success">Patient Nursing deleted successfully</div>');
    redirect('admin/patient/teethlist/');
  }
  public function deleteIpdPatientDiagnosis($pateint_id, $id)
  {
    if (!$this->rbac->hasPrivilege('ipd diagnosis', 'can_delete')) {
      access_denied();
    }
    $this->patient_model->deleteIpdPatientDiagnosis($id);
    $this->session->set_flashdata('msg', '<div class="alert alert-success">Patient Operation deleted successfully</div>');
    redirect('admin/patient/ipdprofile/' . $pateint_id . '#diagnosis');
  }
  public function deleteIpdPatientPayment($pateint_id, $id)
  {
    if (!$this->rbac->hasPrivilege('payment', 'can_delete')) {
      access_denied();
    }
    $this->payment_model->deleteIpdPatientPayment($id);
    $this->session->set_flashdata('msg', '<div class="alert alert-success">Patient Payment deleted successfully</div>');
    redirect('admin/patient/ipdprofile/' . $pateint_id . '#payment');
  }
  public function deleteOpdPatientDiagnosis($pateint_id, $id)
  {
    if (!$this->rbac->hasPrivilege('opd diagnosis', 'can_delete')) {
      access_denied();
    }
    $this->patient_model->deleteIpdPatientDiagnosis($id);

    //redirect('admin/patient/profile/'.$pateint_id.'#diagnosis');
  }
  public function report_download($doc)
  {
    $this->load->helper('download');
    $filepath = "./" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6);
    $data = file_get_contents($filepath);
    $name = $this->uri->segment(6);
    force_download($name, $data);
  }
  public function getDetails()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $id = $this->input->post("patient_id");
    $opdid = $this->input->post("opd_id");
    $result = $this->patient_model->getDetails($id, $opdid);
    $appointment_date = date($this->customlib->getSchoolDateFormat(true, true), strtotime($result['appointment_date']));

    $result["appointment_date"] = $appointment_date;
    echo json_encode($result);
  }
  public function getIpdDetails()
  {
    if (!$this->rbac->hasPrivilege('ipd_patient', 'can_view')) {
      access_denied();
    }
    $id = $this->input->post("recordid");
    $active = $this->input->post("active");
    $result = $this->patient_model->getIpdDetails($id, $active);

    $result['date'] = date($this->customlib->getSchoolDateFormat(true, true), strtotime($result['date']));
    echo json_encode($result);
  }
  public function update()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_edit')) {
      access_denied();
    }
    $patient_type = $this->customlib->getPatienttype();
    $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'firstname' => form_error('name'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $id = $this->input->post('updateid');
      $patient_data = array(
        'id' => $this->input->post('updateid'),
        'patient_name' => $this->input->post('name'),
        'mobileno' => $this->input->post('contact'),
        //'marital_status' => $this->input->post('marital_status'),
        //'blood_group' => $this->input->post('blood_group'),         
        'test_price' => $this->input->post('test_price'),
        //'gender' => $this->input->post('gender'),
        'guardian_name' => $this->input->post('guardian_name'),
        'address' => $this->input->post('address'),
        'note' => $this->input->post('note'),
        'age' => $this->input->post('age'),
        'month' => $this->input->post('month'),
        'organisation' => $this->input->post('organisation'),
        'credit_limit' => $this->input->post('credit_limit'),
        'payment' => $this->input->post('marketer'),
        'is_active' => 'yes',

      );
      $this->patient_model->add($patient_data);
      $array = array('status' => 'success', 'error' => '', 'message' => "Record Updated Successfully");
      if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
        $fileInfo = pathinfo($_FILES["file"]["name"]);
        $img_name = $id . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/patient_images/" . $img_name);
        $data_img = array('id' => $id, 'image' => 'uploads/patient_images/' . $img_name);
        $this->patient_model->add($data_img);
      }
    }

    echo json_encode($array);
  }
  public function ipd_update()
  {
    if (!$this->rbac->hasPrivilege('ipd_patient', 'can_edit')) {
      access_denied();
    }
    $patient_type = $this->customlib->getPatienttype();
    $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('blood_group', $this->lang->line('blood') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
    //$this->form_validation->set_rules('bed_no', 'Bed', 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'firstname' => form_error('name'),
        'gender' => form_error('gender'),
        'blood_group' => form_error('blood_group'),
        // 'bed_no' => form_error('bed_no'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $id = $this->input->post('updateid');
      $appointment_date = $this->input->post('appointment_date');

      $patient_data = array(
        'id' => $this->input->post('updateid'),
        'patient_name' => $this->input->post('name'),
        'mobileno' => $this->input->post('contact'),
        'marital_status' => $this->input->post('marital_status'),
        'email' => $this->input->post('email'),
        'gender' => $this->input->post('gender'),
        'guardian_name' => $this->input->post('guardian_name'),
        'blood_group' => $this->input->post('blood_group'),
        'address' => $this->input->post('address'),
        'note' => $this->input->post('note'),
        'age' => $this->input->post('age'),
        'month' => $this->input->post('month'),
        'is_active' => 'yes',
        'old_patient' => $this->input->post('old_patient'),
        'organisation' => $this->input->post('organisation'),
        'credit_limit' => $this->input->post('credit_limit'),
      );
      $this->patient_model->add($patient_data);
      $ipd_data = array(
        'id' => $this->input->post('ipdid'),
        'date' => date('Y-m-d H:i:s', $this->customlib->datetostrtotime($appointment_date)),
        'bed' => $this->input->post('bed_no'),
        'bed_group_id' => $this->input->post('bed_group_id'),
        'height' => $this->input->post('height'),
        'bp' => $this->input->post('bp'),
        'weight' => $this->input->post('weight'),
        'case_type' => $this->input->post('case_type'),
        'symptoms' => $this->input->post('symptoms'),
        'known_allergies' => $this->input->post('known_allergies'),
        'refference' => $this->input->post('refference'),
        'cons_doctor' => $this->input->post('cons_doctor'),
        'casualty' => $this->input->post('casualty'),
      );
      $bed_data = array('id' => $this->input->post('bed_no'), 'is_active' => 'no');
      $this->bed_model->savebed($bed_data);
      $ipd_id = $this->patient_model->add_ipd($ipd_data);
      $array = array('status' => 'success', 'error' => '', 'message' => "Patient Updated Successfully");
      if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
        $fileInfo = pathinfo($_FILES["file"]["name"]);
        $img_name = $id . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/patient_images/" . $img_name);
        $data_img = array('id' => $id, 'image' => 'uploads/patient_images/' . $img_name);
        $this->patient_model->add($data_img);
      }
    }
    echo json_encode($array);
  }
  public function opd_detail_update()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_edit')) {
      access_denied();
    }
    $id = $this->input->post('opdid');
    $this->form_validation->set_rules('appointment_date', $this->lang->line('appointment') . " " . $this->lang->line('date'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('consultant_doctor', $this->lang->line('consultant') . " " . $this->lang->line('doctor'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('opdid', $this->lang->line('opd') . " " . $this->lang->line('id'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == TRUE) {
      $appointment_date = $this->input->post('appointment_date');

      $patient_data = array(
        'id' => $this->input->post('patientid'),
        'organisation' => $this->input->post('organisation'),
        'old_patient' => $this->input->post('old_patient'),
      );
      $opd_data = array(
        'id' => $this->input->post('opdid'),
        'appointment_date' => date('Y-m-d H:i:s', $this->customlib->datetostrtotime($appointment_date)),
        'case_type' => $this->input->post('case'),
        'symptoms' => $this->input->post('symptoms'),
        'note_remark' => $this->input->post('note_remark'),
        'cons_doctor' => $this->input->post('consultant_doctor'),
        'amount' => $this->input->post('amount'),
        'payment_mode' => $this->input->post('payment_mode'),
      );
      //   print_r($opd_data);
      //exit();
      $opd_id = $this->patient_model->add_opd($opd_data);
      $this->patient_model->add($patient_data);

      $array = array('status' => 'success', 'error' => '', 'message' => "Record Updated Successfully");
    } else {

      $msg = array(
        'appointment_date' => form_error('appointment_date'),
        'consultant_doctor' => form_error('consultant_doctor'),
        'opdid' => form_error('opdid'),
        'amount' => form_error('amount'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    }
    echo json_encode($array);
  }

  public function opd_details()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $id = $this->input->post("recordid");
    $opdid = $this->input->post("opdid");
    $result = $this->patient_model->getOPDetails($id, $opdid);
    $appointment_date = date($this->customlib->getSchoolDateFormat(true, true), strtotime($result['appointment_date']));
    $result["appointment_date"] = $appointment_date;
    echo json_encode($result);
  }
  public function add_diagnosis()
  {
    $this->form_validation->set_rules('report_type', $this->lang->line('report') . " " . $this->lang->line('type'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'report_type' => form_error('report_type'),
        'description' => form_error('description'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $report_date = $this->input->post('report_date');
      $data = array(
        'report_type' => $this->input->post("report_type"),
        'report_date' => date('Y-m-d', $this->customlib->datetostrtotime($report_date)),
        'patient_id' => $this->input->post("patient"),
        'description' => $this->input->post("description"),
      );
      $insert_id = $this->patient_model->add_diagnosis($data);
      if (isset($_FILES["report_document"]) && !empty($_FILES['report_document']['name'])) {
        $fileInfo = pathinfo($_FILES["report_document"]["name"]);
        $img_name = $insert_id . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES["report_document"]["tmp_name"], "./uploads/patient_images/" . $img_name);
        $data_img = array('id' => $insert_id, 'document' => 'uploads/patient_images/' . $img_name);
        $this->patient_model->add_diagnosis($data_img);
      }
      $array = array('status' => 'success', 'error' => '', 'message' => 'Record Added Successfully.');
    }
    echo json_encode($array);
  }
  public function add_prescription()
  {
    if (!$this->rbac->hasPrivilege('prescription', 'can_add')) {
      access_denied();
    }
    $this->form_validation->set_rules('medicine[]', $this->lang->line('medicine'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'medicine' => form_error('medicine[]'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $opd_id = $this->input->post('opd_no');
      $medicine = $this->input->post("medicine[]");
      $dosage = $this->input->post("dosage[]");
      $instruction = $this->input->post("instruction[]");
      $header_note = $this->input->post("header_note");
      $footer_note = $this->input->post("footer_note");
      $data_array = array();
      $i = 0;
      foreach ($medicine as $key => $value) {
        $inst = '';
        $do = '';
        if (!empty($dosage[$i])) {
          $do = $dosage[$i];
        }
        if (!empty($instruction[$i])) {
          $inst = $instruction[$i];
        }
        $data = array('opd_id' => $opd_id, 'medicine' => $value, 'dosage' => $do, 'instruction' => $inst);
        $data_array[] = $data;
        $i++;
      }
      $opd_array = array('id' => $opd_id, 'header_note' => $header_note, 'footer_note' => $footer_note);
      $this->patient_model->add_prescription($data_array);
      $this->patient_model->add_opd($opd_array);
      $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
    }
    echo json_encode($array);
  }
  public function update_prescription()
  {
    if (!$this->rbac->hasPrivilege('prescription', 'can_edit')) {
      access_denied();
    }
    $this->form_validation->set_rules('medicine[]', $this->lang->line('medicine'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'medicine' => form_error('medicine[]'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $opd_id = $this->input->post('opd_id');
      $medicine = $this->input->post("medicine[]");
      $prescription_id = $this->input->post("prescription_id[]");
      $previous_pres_id = $this->input->post("previous_pres_id[]");

      $dosage = $this->input->post("dosage[]");
      $instruction = $this->input->post("instruction[]");
      $header_note = $this->input->post("header_note");
      $footer_note = $this->input->post("footer_note");
      // print_r($prescription_id);
      // print_r($previous_pres_id);

      $data_array = array();
      $delete_arr = array();
      foreach ($previous_pres_id as $pkey => $pvalue) {
        if (in_array($pvalue, $prescription_id)) {

        } else {
          $delete_arr[] = array('id' => $pvalue, );
        }
      }

      $i = 0;
      foreach ($medicine as $key => $value) {
        $inst = '';
        $do = '';
        if (!empty($dosage[$i])) {
          $do = $dosage[$i];
        }
        if (!empty($instruction[$i])) {
          $inst = $instruction[$i];
        }
        if ($prescription_id[$i] == 0) {
          $add_data = array('opd_id' => $opd_id, 'medicine' => $value, 'dosage' => $do, 'instruction' => $inst);

          $data_array[] = $add_data;

        } else {


          $update_data = array('id' => $prescription_id[$i], 'opd_id' => $opd_id, 'medicine' => $value, 'dosage' => $do, 'instruction' => $inst);

          $this->prescription_model->update_prescription($update_data);
        }


        $i++;
      }
      $opd_array = array('id' => $opd_id, 'header_note' => $header_note, 'footer_note' => $footer_note);

      if (!empty($data_array)) {
        $this->patient_model->add_prescription($data_array);
      }
      if (!empty($delete_arr)) {

        $this->prescription_model->delete_prescription($delete_arr);
      }
      $this->patient_model->add_opd($opd_array);

      $array = array('status' => 'success', 'error' => '', 'message' => 'Prescription Added Successfully');
    }
    echo json_encode($array);
  }
  public function add_inpatient()
  {
    if (!$this->rbac->hasPrivilege('ipd_patient', 'can_add')) {
      access_denied();
    }
    $patient_type = $this->customlib->getPatienttype();
    $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('appointment_date', $this->lang->line('appointment') . " " . $this->lang->line('date'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('bed_no', $this->lang->line('bed'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('consultant_doctor', $this->lang->line('consultant') . " " . $this->lang->line('doctor'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'firstname' => form_error('name'),
        'gender' => form_error('gender'),
        'appointment_date' => form_error('appointment_date'),
        'bed_no' => form_error('bed_no'),
        'consultant_doctor' => form_error('consultant_doctor'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $check_patient_id = $this->patient_model->getMaxId();
      if (empty($check_patient_id)) {
        $check_patient_id = 1000;
      }
      $patient_id = $check_patient_id + 1;
      $appointment_date = $this->input->post('appointment_date');
      $patient_data = array(
        'patient_name' => $this->input->post('name'),
        'mobileno' => $this->input->post('contact'),
        'marital_status' => $this->input->post('marital_status'),
        'email' => $this->input->post('email'),
        'gender' => $this->input->post('gender'),
        'guardian_name' => $this->input->post('guardian_name'),
        'blood_group' => $this->input->post('blood_group'),
        'address' => $this->input->post('address'),
        'patient_unique_id' => $patient_id,
        'note' => $this->input->post('note'),
        'age' => $this->input->post('age'),
        'month' => $this->input->post('month'),
        'is_active' => 'yes',
        'patient_type' => $patient_type['inpatient'],
        'old_patient' => $this->input->post('old_patient'),
        'organisation' => $this->input->post('organisation'),
        'credit_limit' => $this->input->post('credit_limit'),
      );
      $insert_id = $this->patient_model->add($patient_data);
      $ipd_data = array(
        'date' => date('Y-m-d H:i:s', $this->customlib->datetostrtotime($appointment_date)),
        'ipd_no' => "IPDN" . $patient_id,
        'bed' => $this->input->post('bed_no'),
        'bed_group_id' => $this->input->post('bed_group_id'),
        'height' => $this->input->post('height'),
        'weight' => $this->input->post('weight'),
        'bp' => $this->input->post('bp'),
        'case_type' => $this->input->post('case'),
        'symptoms' => $this->input->post('symptoms'),
        'known_allergies' => $this->input->post('known_allergies'),
        'refference' => $this->input->post('refference'),
        'cons_doctor' => $this->input->post('consultant_doctor'),
        'patient_id' => $insert_id,
        'casualty' => $this->input->post('casualty'),
      );
      $bed_data = array('id' => $this->input->post('bed_no'), 'is_active' => 'no');
      $this->bed_model->savebed($bed_data);
      $ipd_id = $this->patient_model->add_ipd($ipd_data);
      $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
      $data_patient_login = array(
        'username' => $this->patient_login_prefix . $insert_id,
        'password' => $user_password,
        'user_id' => $insert_id,
        'role' => 'patient'
      );

      $this->user_model->add($data_patient_login);

      $array = array('status' => 'success', 'error' => '', 'message' => "Patient Added Successfully");
      if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
        $fileInfo = pathinfo($_FILES["file"]["name"]);
        $img_name = $insert_id . '.' . $fileInfo['extension'];
        move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/patient_images/" . $img_name);
        $data_img = array('id' => $insert_id, 'image' => 'uploads/patient_images/' . $img_name);
        $this->patient_model->add($data_img);
      }

      $sender_details = array('patient_id' => $insert_id, 'opd_no' => '', 'contact_no' => $this->input->post('contact'), 'email' => $this->input->post('email'));
      $this->mailsmsconf->mailsms('ipd_patient_registration', $sender_details);
      $patient_login_detail = array('id' => $insert_id, 'credential_for' => 'patient', 'username' => $this->patient_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $this->input->post('contact'), 'email' => $this->input->post('email'));
      $this->mailsmsconf->mailsms('login_credential', $patient_login_detail);
    }
    echo json_encode($array);
  }
  public function add_consultant_instruction()
  {
    if (!$this->rbac->hasPrivilege('consultant register', 'can_add')) {
      access_denied();
    }
    $this->form_validation->set_rules('date[]', $this->lang->line('applied') . " " . $this->lang->line('date'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('doctor[]', $this->lang->line('consultant'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('instruction[]', $this->lang->line('instruction'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('insdate[]', $this->lang->line('instruction') . " " . $this->lang->line('date'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'date' => form_error('date[]'),
        'doctor' => form_error('doctor[]'),
        'instruction' => form_error('instruction[]'),
        'datee' => form_error('insdate[]')
      );

      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      $date = $this->input->post('date[]');
      $ins_date = $this->input->post('insdate[]');
      //$ins_time = $this->input->post('instime[]');
      $patient_id = $this->input->post('patient_id');
      $doctor = $this->input->post('doctor[]');
      $instruction = $this->input->post('instruction[]');
      $data = array();
      $i = 0;
      foreach ($date as $key => $value) {
        $details = array(
          'date' => date('Y-m-d H:i:s', $this->customlib->datetostrtotime($date[$i])),
          'patient_id' => $patient_id,
          'ins_date' => date('Y-m-d', $this->customlib->datetostrtotime($ins_date[$i])),
          //'ins_time' => date("h:i s",strtotime($ins_time[$i])),    
          'cons_doctor' => $doctor[$i],
          'instruction' => $instruction[$i],
        );
        $data[] = $details;
        $i++;
      }
      $this->patient_model->add_consultantInstruction($data);
      $array = array('status' => 'success', 'error' => '', 'message' => 'Record Added Successfully');
    }
    echo json_encode($array);
  }
  public function ipdCharge()
  {
    $code = $this->input->post('code');
    $org_id = $this->input->post('organisation_id');
    $patient_charge = $this->patient_model->ipdCharge($code, $org_id);
    $data['patient_charge'] = $patient_charge;
    echo json_encode($patient_charge);
  }
  public function opd_report()
{
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
        access_denied();
    }

    $this->session->set_userdata('top_menu', 'Reports');
    $this->session->set_userdata('sub_menu', 'admin/patient/opd_report');

    $select = 'opd_details.*, staff.name, staff.surname, patients.id as pid, patients.patient_name, 
               patients.patient_unique_id, patients.guardian_name, patients.address, patients.admission_date, 
               patients.gender, patients.mobileno, patients.age';
    $join = array(
        'JOIN staff ON opd_details.cons_doctor = staff.id',
        'JOIN patients ON opd_details.patient_id = patients.id'
    );
    $table_name = "opd_details";
    $search_type = $this->input->post("search_type") ? $this->input->post("search_type") : "all_time";

    // Get the current page number from the URL
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

    // Define results per page
    $limit = 50; // Customize this as per your requirement
    $offset = $page;

    // Fetch the total record count
    $results = $this->report_model->countSearchReport($select, $join, $table_name, $search_type, 'opd_details', 'appointment_date');
     

    $total_rows = $results['total_count'];
    $total_amount = $results['total_amount'];
 
    // Set up pagination
    $base_url = site_url('admin/patient/opd_report');
    $pagination = configure_pagination($base_url, $total_rows, $limit);

    // Fetch paginated data
    $resultlist = $this->report_model->searchReport($select, $join, $table_name, $search_type, 'opd_details', 'appointment_date', $limit, $offset);

    // Calculate start and end records for the current page
    $start_record = $offset + 1;
    $end_record = min($offset + $limit, $total_rows);

    // Pass data to the view
    $data["searchlist"] = $this->search_type;
    $data["search_type"] = $search_type;
    $data["resultlist"] = $resultlist;
    $data["pagination"] = $pagination->create_links();
    $data["start_record"] = $start_record;
    $data["end_record"] = $end_record;
    $data["total_records"] = $total_rows;
    $data["total_amount"] = $total_amount;

    // Load views
    $this->load->view('layout/header');
    $this->load->view('admin/patient/opdReport.php', $data);
    $this->load->view('layout/footer');
}
public function get_reg_search_all()
{
    if (!$this->rbac->hasPrivilege('consultant register', 'can_add')) {
      access_denied();
  }

  $data["title"] = 'Consultant Register';
  $this->session->set_userdata('top_menu', 'Consultant Register');

  $setting = $this->setting_model->get();
  $data['setting'] = $setting;
  $opd_month = $setting[0]['opd_record_month'];
  $data["marital_status"] = $this->marital_status;
  $data["payment_mode"] = $this->payment_mode;
  $data["bloodgroup"] = $this->blood_group;
  $doctors = $this->staff_model->getStaffbyrole(3);
  $data["doctors"] = $doctors;
  $data['organisation'] = $this->Organisation_model->get();

  // Get the search text from POST if it exists
  $search_text = $this->input->post('search_text');

  // If search text is provided, count rows based on the search query
  if (!empty($search_text)) {
      $total_rows = $this->patient_model->countSearchPatients($search_text);
  } else {
      // If no search text, count total rows as usual
      $total_rows = $this->patient_model->countPatients();
  }

  $base_url = site_url('admin/patient/reg_search');
  $pagination = configure_pagination($base_url, $total_rows);

  $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

  // Fetch paginated data depending on whether a search is being performed
  $resultlist = $this->patient_model->searchPatientsWithoutPagination();

  $start_record = $page + 1;
  $end_record = min($page + $pagination->per_page, $total_rows);

  // Add total visit and last visit details to the result list
  $i = 0;
  foreach ($resultlist as $visits) {
      $patient_id = $visits["id"];
      $total_visit = $this->patient_model->totalVisit($patient_id);
      $last_visit = $this->patient_model->lastVisit($patient_id); 
      $amount_calculation = $this->patient_model->get_amount_calculation_for_excel($visits['patient_id']); 
      $last_amount_calculation = $this->patient_model->get_last_amount_for_excel($visits['patient_id']); 

      $resultlist[$i]["total_visit"] = $total_visit["total_visit"];
      $resultlist[$i]["last_visit"] = $last_visit["last_visit"];
      $resultlist[$i]["total_amount"] = $amount_calculation;
      $resultlist[$i]["last_amount_test"] = $last_amount_calculation;
      $i++;
  }

  // Pass data to the view
  $data["resultlist"] = $resultlist;
  $data["pagination"] = $pagination->create_links();
  $data["start_record"] = $start_record;
  $data["end_record"] = $end_record;
  $data["total_records"] = $total_rows;
  $data['labconf'] = $this->patient_model->getLabConf();
   // Return data as JSON
   echo json_encode($resultlist);
}

public function get_opd_report_data()
{
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
        access_denied();
    }

    $search_type = $this->input->post("search_type") ? $this->input->post("search_type") : "all_time";

    // Continue with your query and model call
    $select = 'opd_details.*, staff.name, staff.surname, patients.id as pid, patients.patient_name, 
               patients.patient_unique_id, patients.guardian_name, patients.address, patients.admission_date, 
               patients.gender, patients.mobileno, patients.age';
    $join = array(
        'JOIN staff ON opd_details.cons_doctor = staff.id',
        'JOIN patients ON opd_details.patient_id = patients.id'
    );
    $table_name = "opd_details";

    // Call the report model with the search_type parameter
    $resultlist = $this->report_model->searchReport($select, $join, $table_name, $search_type, 'opd_details', 'appointment_date', 1000000, 0);

    // Return data as JSON
    echo json_encode($resultlist);
}


  public function ipdReport()
  {
    if (!$this->rbac->hasPrivilege('ipd_patinet', 'can_view')) {
      access_denied();
    }
    $this->session->set_userdata('top_menu', 'Reports');
    $this->session->set_userdata('sub_menu', 'admin/patient/ipdreport');

    $this->db->select("patients.*,patient_ward.*");
    $this->db->from('patients');
    $this->db->join('patient_ward', 'patient_ward.patient_id = patients.id', 'INNER');
    $query = $this->db->get();
    $data["resultlist"] = $query->result_array();
    $this->load->view('layout/header');
    $this->load->view('admin/patient/ipdReport.php', $data);
    $this->load->view('layout/footer');
  }
  public function revertBill()
  {
    $patient_id = $this->input->post('patient_id');
    $bill_id = $this->input->post('bill_id');
    $bed_id = $this->input->post('bed_id');
    if ((!empty($patient_id)) && (!empty($bill_id))) {
      $patient_data = array('id' => $patient_id, 'is_active' => 'yes');
      $this->patient_model->add($patient_data);
      $bed_data = array('id' => $bed_id, 'is_active' => 'no');
      $this->bed_model->savebed($bed_data);
      $revert = $this->payment_model->revertBill($patient_id, $bill_id);
      $array = array('status' => 'success', 'error' => '', 'message' => 'Record Updated Successfully.');
    } else {
      $array = array('status' => 'fail', 'error' => '', 'message' => 'Record Not Updated.');
    }
    echo json_encode($array);
  }

  public function deleteOPD()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_delete')) {
      access_denied();
    }
    $opdid = $this->input->post('opdid');
    if (!empty($opdid)) {
      $this->patient_model->deleteOPD($opdid);
      $array = array('status' => 'success', 'error' => '', 'message' => 'Record Deleted Successfully.');
    } else {
      $array = array('status' => 'fail', 'error' => '', 'message' => '');
    }
    echo json_encode($array);
  }
  public function deleteOPDPatient()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_delete')) {
      access_denied();
    }
    $id = $this->input->post('id');
    if (!empty($id)) {
      $this->patient_model->deleteOPDPatient($id);
      $array = array('status' => 'success', 'error' => '', 'message' => 'Record Deleted Successfully.');
    } else {
      $array = array('status' => 'fail', 'error' => '', 'message' => '');
    }
    echo json_encode($array);
  }

  public function deleteRecord()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_delete')) {
      access_denied();
    }
    $id = $this->input->post('id');
    if (!empty($id)) {
      $this->patient_model->deleteRecord($id);
      $array = array('status' => 'success', 'error' => '', 'message' => 'Record Deleted Successfully.');
    } else {
      $array = array('status' => 'fail', 'error' => '', 'message' => '');
    }
    echo json_encode($array);
  }
  public function patientCredentialReport()
  {
    $this->session->set_userdata('top_menu', 'Reports');
    $this->session->set_userdata('sub_menu', 'admin/patient/patientcredentialreport');
    $credential = $this->patient_model->patientCredentialReport();
    $data["credential"] = $credential;
    $this->load->view("layout/header");
    $this->load->view("admin/patient/patientcredentialreport", $data);
    $this->load->view("layout/footer");
  }

  public function deleteIpdPatient($id)
  {
    if (!empty($id)) {
      $this->patient_model->deleteIpdPatient($id);
      $array = array('status' => 'success', 'error' => '', 'message' => 'Record Deleted Successfully.');
    } else {
      $array = array('status' => 'fail', 'error' => '', 'message' => '');
    }
    echo json_encode($array);
  }

  public function getBedStatus()
  {
    $floor_list = $this->floor_model->floor_list();
    $bedlist = $this->bed_model->bed_list();
    $bedgroup_list = $this->bedgroup_model->bedGroupFloor();
    $data["floor_list"] = $floor_list;
    $data["bedlist"] = $bedlist;
    $data["bedgroup_list"] = $bedgroup_list;
    $this->load->view("layout/bedstatusmodal", $data);
  }

  public function print($id = 0)
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $data["id"] = $id;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $result = array();
    $diagnosis_details = array();
    $opd_details = array();
    $timeline_list = array();

    if (!empty($id)) {
      $arrayName = array('id' => $id, 'is_printed' => 1, );
      $this->patient_model->add($arrayName);
      $result = $this->patient_model->getDetails($id);
      $opd_details = $this->patient_model->getOPDetails($id);
      $diagnosis_details = $this->patient_model->getDiagnosisDetails($id);
      $timeline_list = $this->timeline_model->getPatientTimeline($id, $timeline_status = '');

    }

    $data["result"] = $result;
    $data["diagnosis_detail"] = $diagnosis_details;
    //$data["prescription_detail"]  = $prescription_details;
    $data["opd_details"] = $opd_details;
    $data["timeline_list"] = $timeline_list;
    $data['organisation'] = $this->Organisation_model->get();
    $data['opd'] = $this->patient_model->getPatientOPD($id);

    //labs record
    $pid = $this->uri->segment(4);
    // $round = $this->uri->segment(5);
    // print_r($pid);
    $data['lab_ecg'] = $this->patient_model->getLabEcgByPatientId($pid);
    $data['lab_xray'] = $this->patient_model->getLabXrayByPatientId($pid);
    $data['lab_ult'] = $this->patient_model->getLabUltByPatientId($pid);
    $data['lab_lab'] = $this->patient_model->getLabLabByPatientId($pid);

    // print_r($data['lab_lab']); die();
    $this->load->view("admin/patient/print", $data);
  }

  public function print_each($id = 0, $is_printed = 1)
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $data["id"] = $id;
    // print_r($data['month']); die();
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $result = array();
    $opd_details = array();

    if (!empty($id)) {
      // $opd_printed = array('patient_id' => $id, 'is_printed'=>1,);
      // $this->patient_model->add_opd_printed($opd_printed);

      // $lab_lab_printed = array('patient_id' => $id, 'is_printed'=>1,);
      // $this->patient_model->add_lab_lab_printed($lab_lab_printed);

      $result = $this->patient_model->getDetails($id);
      $opd_details = $this->patient_model->getOPDetailsForEachPrint($id);
    }

    $data["result"] = $result;
    $pid = $this->uri->segment(4);

    $data["opd_details"] = $opd_details;
    $data['lab_lab'] = $this->patient_model->getLabLabByPatientIdForEachPrint($pid);

    $data['lab_lab_all'] = $this->patient_model->getLabLabByPatientId($pid);
    $data['opd_details_all'] = $this->patient_model->getOPDetails($id);

    // print_r($data['lab_lab']); die();
    $this->load->view("admin/patient/print_each", $data);
  }

  public function print_confirm($id = 0)
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["id"] = $id;
    // print_r($data['id']); die();
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $result = array();
    $opd_details = array();

    if (!empty($id)) {
      $opd_printed = array('patient_id' => $id, 'is_printed' => 1, );
      $this->patient_model->add_opd_printed($opd_printed);

      $lab_lab_printed = array('patient_id' => $id, 'is_printed' => 1, );
      $this->patient_model->add_lab_lab_printed($lab_lab_printed);
    }

    $data["result"] = $result;
    $pid = $this->uri->segment(4);
    $this->load->view("admin/patient/print_confirmation", $data);
  }

  public function print_lab($id = 0)
  {
    $round = $this->uri->segment(5);
    $table = $this->uri->segment(6);
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $data["id"] = $id;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $diagnosis_details = array();
    $opd_details = array();
    $timeline_list = array();
    if (!empty($id)) {
      $arrayName = array('id' => $id, 'is_printed' => 1, );
      $this->patient_model->add($arrayName);
      //var_dump($result);exit;
      $opd_details = $this->patient_model->getOPDetails($id);
      $diagnosis_details = $this->patient_model->getDiagnosisDetails($id);
      $timeline_list = $this->timeline_model->getPatientTimeline($id, $timeline_status = '');
    }


    $data["diagnosis_detail"] = $diagnosis_details;
    //$data["prescription_detail"]  = $prescription_details;
    $data["opd_details"] = $opd_details;
    $data["timeline_list"] = $timeline_list;
    $data['organisation'] = $this->Organisation_model->get();
    $data['opd'] = $this->patient_model->getPatientOPD($id);
    $data['result'] = $this->patient_model->get_Dynamic_lab_for_print($id, $round, $table);
    // $this->load->view("layout/header");
    $this->load->view("admin/patient/print_lab", $data);
    // $this->load->view("layout/footer");
  }

  public function getOPD()
  {
    $id = $this->input->post("patient_id");
    $result = $this->patient_model->getOPD($id);

    $option = "";
    foreach ($result as $key) {
      $option .= "<option value='" . $key['id'] . "'>" . $key['name'] . "</option>";
    }
    echo $option;
    # code...
  }

  public function bringLabconf()
  {
    $id = $this->input->post("patient_id");
    $result = $this->patient_model->bringLabconf($id);

    echo $result['price'];
  }

  public function bringTeeths($y)
{
    $query = $this->db->select('lab_lab.*')->where("year", $y)->get('lab_lab');
    $data = $query->result_array();
    echo json_encode($data);
}


  public function getPatientNo()
  {
    $id = $this->input->post("patient_id");
    $result = $this->patient_model->getPatientNo($id);
    echo json_encode($result);
    # code...
  }

  public function createPatient()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $data["title"] = 'opd_patient';
    $this->session->set_userdata('top_menu', 'OPD_Out_Patient');
    $setting = $this->setting_model->get();
    $data['setting'] = $setting;
    $opd_month = $setting[0]['opd_record_month'];
    $data["marital_status"] = $this->marital_status;
    $data["payment_mode"] = $this->payment_mode;
    $data["bloodgroup"] = $this->blood_group;
    $doctors = $this->staff_model->getStaffbyrole(3);
    $data["doctors"] = $doctors;
    $data["marketer"] = $this->staff_model->getStaffbyrole(2);
    if ($opd_month) {
      // $resultlist = $this->patient_model->searchByMonth($opd_month,''); 
    } else {
      $resultlist = $this->patient_model->searchFullText('1', '');
    }
    $data['organisation'] = $this->Organisation_model->get();
    $i = 0;
    foreach ($resultlist as $visits) {
      $patient_id = $visits["id"];
      $total_visit = $this->patient_model->totalVisit($patient_id);
      $last_visit = $this->patient_model->lastVisit($patient_id);
      $resultlist[$i]["total_visit"] = $total_visit["total_visit"];
      $resultlist[$i]["last_visit"] = $last_visit["last_visit"];
      $i++;
    }
    $data["resultlist"] = $resultlist;
    $this->load->view('layout/header');
    $this->load->view('admin/patient/create_patient', $data);
    $this->load->view('layout/footer');
  }

  public function addPatientNursing()
  {
    if (!$this->rbac->hasPrivilege('ot_patient', 'can_add')) {
      access_denied();
    }
    $this->form_validation->set_rules('enterance_date', "Nursing Charges" . " " . $this->lang->line('name'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $msg = array(
        'indate' => $this->input->post('enterance_date'),
      );
      $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
    } else {
      // print_r($_POST);
      // echo 'patient id:'.$this->input->post('patient_id');
      // $round_id = $this->input->post('patient_id');
      //  $this->db->select("round");
      //  $this->db->from('patient_nursing');
      //  $this->db->where('patient_id',$round_id);
      //  $this->db->order_by('round',DESC);
      //  $this->db->limit(1);
      //  $last_round = $this->db->get();
      //  $result = $last_round->row();
      // print_r($result);
      //  $update_round = $result->round+1;
      $operation_detail = array(
        'patient_id' => $this->input->post('patient_id'),
        'indate' => $this->input->post('enterance_date'),
        'outdate' => $this->input->post('current_date'),
        'bed_time' => $this->input->post('bed_duration'),
        'night' => $this->input->post('night_charge'),
        'total_fees' => $this->input->post('total_nursing_charges'),
        'observation' => $this->input->post('nursing_desc'),
        'round' => $this->input->post('patient_round'),
        'date' => $this->input->post('current_date'),
        'discount' => $this->input->post('discount'),

      );
      $this->patient_model->storePatientNursing($operation_detail);
    }
    $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));

    echo json_encode($array);
  }
  public function addPatienttoWard()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }

    $id = $this->input->post('patient_id');
    $addtowarddata = array(
      'entry_date' => $this->input->post('current_date'),
      'add_description' => $this->input->post('add_description'),
      'is_warded' => $this->input->post('is_warded')
    );

    $addtowarddata['id'] = $id;
    $this->patient_model->addPatienttoWard($addtowarddata);
    redirect('admin/patient/search_pediateric');
  }

  public function updateIPDPatient()
  {
    $id = $this->input->post('id');
    $radiology = array(
      'patient_name' => $this->input->post('patient_name'),
      'entry_date' => $this->input->post('date'),
      'recognition' => $this->input->post('recognition'),
      'type_disease' => $this->input->post('type_disease'),
      'diagnostic' => $this->input->post('diagnostic'),
      'age' => $this->input->post('age'),
      'month' => $this->input->post('age_month'),
      'day' => $this->input->post('age_day'),
      'note' => $this->input->post('add_desc'),
    );
    $radiology['id'] = $id;
    $this->patient_model->updateIPDPatient($radiology);
    $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
    echo json_encode($array);
    # code...
  }

  public function getIPDPatientRecord()
  {
    $id = $this->input->post("patient_id");
    $result = $this->patient_model->getIPDPatientRecord($id);
    echo json_encode($result);

    # code...
  }


  public function addWard()
  {
    $round = $this->patient_model->getLastRound('opd_details', $this->input->post('patient_id'));
    $ipd_patient_data = array(
      'ward_duration' => $this->input->post('ward_duration'),
      'exit_date' => $this->input->post('exit_date'),
      'night' => $this->input->post('night'),
      'operation' => $this->input->post('operation'),
      'died' => $this->input->post('died'),
      'escape' => $this->input->post('escape'),
      'leave' => $this->input->post('leave'),
      'reference' => $this->input->post('reference'),
      'blood_group' => $this->input->post('blood_group'),
      'birth' => $this->input->post('birth'),
      'mi' => $this->input->post('mi'),
      'description' => $this->input->post('description'),
    );
    $this->patient_model->storePatientWard($ipd_patient_data, $this->input->post('patient_id'), $round);
    $arrayName = array('id' => $this->input->post('patient_id'), 'is_warded' => 1, );
    $this->patient_model->add_ipd($arrayName);
    redirect('admin/patient/ipdsearch');
  }
  public function addEntranceFee()
  {
    $round = $this->patient_model->getLastRound('opd_details', $this->input->post('id'));
    $entranceFeeData = array(
      'patient_id' => $this->input->post('id'),
      'entrance_fee' => $this->input->post('entrance_fee'),
      'date' => $this->input->post('current_date'),
      'description' => $this->input->post('add_desc'),
      'round' => $round,
    );
    // print_r($entranceFeeData);
    // die();
    $this->patient_model->addEntranceFeeModel($entranceFeeData);
    redirect('admin/patient/ipdsearch');
  }
  public function ipd_add_nicu()
  {
    $this->session->set_userdata('top_menu', 'IPD_in_patient');
    $this->session->set_userdata('sub_menu', 'ipd_add_nicu');

    $this->load->view('layout/header');
    // $this->load->view('admin/patient/addNICU', $data);
    $this->load->view('layout/footer');
  }


  public function storeNICU()
  {
    $ipd_patient_data = array(
      'name' => $this->input->post('name'),
      'father_name' => $this->input->post('father_name'),
      'address' => $this->input->post('address'),
      'weight_at_ward' => $this->input->post('weight_at_ward'),
      'net_weight' => $this->input->post('net_weight'),
      'date_awarded' => $this->input->post('date_awarded'),
      'age' => $this->input->post('age'),
      'sex' => $this->input->post('sex'),
      'evidence_type' => $this->input->post('evidence_type'),
      'source' => $this->input->post('source'),
      'medical_problem' => $this->input->post('medical_problem'),
      'diagnostic' => $this->input->post('diagnostic'),
      'phone_number' => $this->input->post('phone_number'),
      'date_exited' => $this->input->post('date_exited'),
      'died' => $this->input->post('died'),
    );

    $this->patient_model->storePatientNICU($ipd_patient_data);

    redirect('admin/patient/search_nicu');
  }

  public function teethlissdft()
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $this->session->set_userdata('top_menu', 'setup');
    $this->session->set_userdata('sub_menu', 'charges/index');
    $this->session->set_userdata('top_menu', 'IPD_in_patient');
    $data['labconf'] = $this->patient_model->getLabConf();
    $data["resultlist"] = $this->patient_model->teetlist();
    $this->load->view('layout/header');
    $this->load->view('admin/patient/teethshow.php', $data);
    $this->load->view('layout/footer');
  }

  public function teethlist($year=1401)
  {
    if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
      access_denied();
    }
    $this->session->set_userdata('top_menu', 'setup');
    $this->session->set_userdata('sub_menu', 'charges/index');
    $chargecategoryid = $this->input->post("chargecategoryid");
    $data['labconf'] = $this->patient_model->getLabConf();
    $data['getyears'] = $this->patient_model->getYears();
  
    // $chargeCategory = $this->charge_category_model->getChargeCategoryAnnually($year);
    // $data["chargeCategory"] = $chargeCategory;
    $data['charge_type'] = $this->charge_type;
    $this->form_validation->set_rules(
      'name',
      'Name',
      array(
        'required',
        array('check_exists', array($this->charge_category_model, 'valid_charge_category'))
      )
    );
    $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
    $this->form_validation->set_rules('charge_type', 'Charge Type', 'required');
    $data["title"] = "Add Charge Category";
    if ($this->form_validation->run()) {
      $name = $this->input->post("name");
      $description = $this->input->post("description");
      $charge_type = $this->input->post("charge_type");
      $chargecategoryid = $this->input->post("id");

      if (!empty($chargecategoryid)) {
        $data = array('name' => $name, 'description' => $description, 'charge_type' => $charge_type, 'id' => $chargecategoryid);
      } else {

        $data = array('name' => $name, 'description' => $description, 'charge_type' => $charge_type);
      }
      $insert_id = $this->charge_category_model->addChargeCategory($data);
      $this->session->set_flashdata('msg', '<div class="alert alert-success">Record added Successfully</div>');
      redirect("admin/chargecategory/charges");
    } else {
      $this->load->view("layout/header");
      $this->load->view("admin/patient/teethshow.php", $data);
      $this->load->view("layout/footer");
    }
  }

  public function updateNICU()
  {
    $ipd_patient_data = array(
      'id' => $this->input->post('patient_id'),
      'name' => $this->input->post('name'),
      'father_name' => $this->input->post('father_name'),
      'address' => $this->input->post('address')

    );


    $this->patient_model->updateNICU($ipd_patient_data);

    $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));

    echo json_encode($array);
    # code...
  }

  public function printDischarge($id = 0)
  {
    $data['patient'] = $this->patient_model->getPatientRecord($id);
    $data['operations_lists'] = $this->patient_model->getOperationList($id);
    $data['nursing_chges_lists'] = $this->patient_model->getNursingCharges($id);
    $data['ipd_deatils_amount'] = $this->patient_model->getIPDamount($id);
    // $data['patient_ward'] = $this->patient_model->getNursingServinces($id);
    //Print Last records
    $data['patient_round'] = $this->patient_model->getLastRound('opd_details', $id);
    $data['operation'] = $this->patient_model->getOperationListLast($id, $data['patient_round']);
    // print_r($data); die();
    $data['nursing_last'] = $this->patient_model->getNursingLast($id, $data['patient_round']);
    $data['payment_details'] = $this->payment_model->paymentDetails($id, $data['patient_round']);
    $payment = $this->payment_model->paymentList($id);
    $data['opd_details_diagnosis'] = $this->patient_model->get_opd_details_diagnosis($this->uri->segment(4));
    $data['patient_ward'] = $this->patient_model->getPatientWardCost($id, $data['patient_round']);
    $data['opd_details'] = $this->patient_model->getPatientOPD2($id, $data['patient_round']);
    // print_r($data); die();
    $this->load->view('admin/patient/printDischarge.php', $data);

  }
}