<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Radio extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->config->load("payroll");
        $this->search_type = $this->config->item('search_type');
        $this->load->model("report_model");
    }

    public function unauthorized() {
        $data = array();
        $this->load->view('layout/header', $data);
        $this->load->view('unauthorized', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_add')) {
            access_denied();
        }
        $this->form_validation->set_rules('test_name', $this->lang->line('test') . " " . $this->lang->line('name'), 'required');
        $this->form_validation->set_rules('short_name', $this->lang->line('short') . " " . $this->lang->line('name'), 'required');
        $this->form_validation->set_rules('test_type', $this->lang->line('test') . " " . $this->lang->line('type'), 'required');
        $this->form_validation->set_rules('radiology_category_id', $this->lang->line('category') . " " . $this->lang->line('name'), 'required');
        $this->form_validation->set_rules('charge_category_id', $this->lang->line('charge') . " " . $this->lang->line('category'), 'required');
        $this->form_validation->set_rules('code', $this->lang->line('code'), 'required');
        $this->form_validation->set_rules('standard_charge', $this->lang->line('standard') . " " . $this->lang->line('charge'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'test_name' => form_error('test_name'),
                'short_name' => form_error('short_name'),
                'test_type' => form_error('test_type'),
                'radiology_category_id' => form_error('radiology_category_id'),
                'charge_category_id' => form_error('charge_category_id'),
                'code' => form_error('code'),
                'standard_charge' => form_error('standard_charge')
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $radiology = array(
                'test_name' => $this->input->post('test_name'),
                'short_name' => $this->input->post('short_name'),
                'test_type' => $this->input->post('test_type'),
                'radiology_category_id' => $this->input->post('radiology_category_id'),
                'sub_category' => $this->input->post('sub_category'),
                'report_days' => $this->input->post('report_days'),
                'charge_id' => $this->input->post('code')
            );
            $this->radio_model->add($radiology);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
    }

    public function search() {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'radiology');
        $categoryName = $this->lab_model->getlabName();
        $data["categoryName"] = $categoryName;
        $data['charge_category'] = $this->radio_model->getChargeCategory();
        $doctors = $this->staff_model->getStaffbyrole(3);
        $data["doctors"] = $doctors;
        $data['resultlist'] = $this->radio_model->searchFullText();
        $result = $this->radio_model->getRadiology();
        $data['result'] = $result;

        $this->load->view('layout/header');
        $this->load->view('admin/radio/search.php', $data);
        $this->load->view('layout/footer');
    }
      

      public function search_nursing() {
        if (!$this->rbac->hasPrivilege('nursing', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'ipd');
        $categoryName = $this->lab_model->getlabName();
        $data["categoryName"] = $categoryName;
        $data['charge_category'] = $this->radio_model->getChargeCategory();
        $doctors = $this->staff_model->getStaffbyrole(3);
        $data["doctors"] = $doctors;
        $data['resultlist'] = $this->radio_model->searchFullText();
        $result = $this->radio_model->getRadiology();
        $data['result'] = $result;
        $this->load->view('layout/header');
        $this->load->view('admin/radio/search_nursing', $data);
        $this->load->view('layout/footer');
    }

    
    public function getDetails() {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_view')) {
            access_denied();
        }
        $id = $this->input->post("radiology_id");
        $result = $this->radio_model->getDetails($id);
        echo json_encode($result);
    }

    public function update() {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_edit')) {
            access_denied();
        }
        $this->form_validation->set_rules('test_name', $this->lang->line('test') . " " . $this->lang->line('name'), 'required');
        $this->form_validation->set_rules('short_name', $this->lang->line('short') . " " . $this->lang->line('name'), 'required');
        $this->form_validation->set_rules('test_type', $this->lang->line('test') . " " . $this->lang->line('type'), 'required');
        $this->form_validation->set_rules('radiology_category_id', $this->lang->line('category') . " " . $this->lang->line('name'), 'required');
        $this->form_validation->set_rules('charge_category_id', $this->lang->line('charge') . " " . $this->lang->line('category'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'test_name' => form_error('test_name'),
                'short_name' => form_error('short_name'),
                'test_type' => form_error('test_type'),
                'radiology_category_id' => form_error('radiology_category_id'),
                'charge_category_id' => form_error('charge_category_id')
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $id = $this->input->post('id');
            $charge_category_id = $this->input->post('charge_category_id');
            $radiology = array(
                'id' => $id,
                'test_name' => $this->input->post('test_name'),
                'short_name' => $this->input->post('short_name'),
                'test_type' => $this->input->post('test_type'),
                'radiology_category_id' => $this->input->post('radiology_category_id'),
                'sub_category' => $this->input->post('sub_category'),
                'report_days' => $this->input->post('report_days'),
                'charge_id' => $charge_category_id
            );
            $this->radio_model->update($radiology);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
    }

    public function delete($id) {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_delete')) {
            access_denied();
        }
        if (!empty($id)) {
            $this->radio_model->delete($id);
            $array = array('status' => 'success', 'error' => '', 'message' => 'Record Deleted Successfully.');
        } else {
            $array = array('status' => 'fail', 'error' => '', 'message' => '');
        }
        echo json_encode($array);
    }

    public function getRadiology() {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_view')) {
            access_denied();
        }
        $id = $this->input->post('radiology_id');
        $result = $this->radio_model->getRadiology($id);
        echo json_encode($result);
    }

    public function testReportBatch() {
        if (!$this->rbac->hasPrivilege('add_patient_test_reprt', 'can_add')) {
            access_denied();
        }
        if (!empty($_FILES['radiology_report']['name'])) {
            $config['upload_path'] = 'uploads/radiology_report/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = $_FILES['radiology_report']['name'];
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('radiology_report')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }
        } else {
            $picture = '';
        }
        $this->form_validation->set_rules('radiology_id', $this->lang->line('patient') . " " . $this->lang->line('id'), 'required');

        $this->form_validation->set_rules('patient_name', $this->lang->line('patient') . " " . $this->lang->line('name'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'radiology_id' => form_error('radiology_id'),
                'patient_name' => form_error('patient_name'),
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $id = $this->input->post('radiology_id');
            $patient_id = $this->input->post('patient_id');
            $reporting_date = $this->input->post("reporting_date");

            $report_batch = array(
                'radiology_id' => $id,
                'patient_id' => $patient_id,
                'customer_type' => $this->input->post('customer_type'),
                'patient_name' => $this->input->post('patient_name'),
                'consultant_doctor' => $this->input->post('consultant_doctor'),
                'reporting_date' => date('Y-m-d', $this->customlib->datetostrtotime($reporting_date)),
                'description' => $this->input->post('description'),
                'radiology_report' => $picture,
                'apply_charge' => $this->input->post('apply_charge')
            );
            $this->radio_model->testReportBatch($report_batch);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
    }

    public function getTestReportBatch() {
        if (!$this->rbac->hasPrivilege('add_patient_test_reprt', 'can_view')) {
            access_denied();
        }
        $id = $this->input->post("radiology_id");
        $doctors = $this->staff_model->getStaffbyrole(3);
        $data["doctors"] = $doctors;
        $result = $this->radio_model->getTestReportBatch($id);
        $data["result"] = $result;
        $this->load->view('layout/header');
        $this->load->view('admin/radio/reportDetail', $data);
        $this->load->view('layout/footer');
    }

    public function getRadiologyReport() {
        if (!$this->rbac->hasPrivilege('add_patient_test_reprt', 'can_view')) {
            access_denied();
        }
        $id = $this->input->post('id');
        $result = $this->radio_model->getRadiologyReport($id);
        $result['reporting_date'] = date($this->customlib->getSchoolDateFormat(), strtotime($result['reporting_date']));

        echo json_encode($result);
    }

    public function updateTestReport() {
        if (!$this->rbac->hasPrivilege('add_patient_test_reprt', 'can_edit')) {
            access_denied();
        }
        if (!empty($_FILES['radiology_report']['name'])) {
            $config['upload_path'] = 'uploads/radiology_report/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = $_FILES['radiology_report']['name'];
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('radiology_report')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }
        } else {
            $picture = '';
        }
        $this->form_validation->set_rules('id', 'Id', 'required');

        $this->form_validation->set_rules('patient_name', $this->lang->line('patient') . " " . $this->lang->line('name'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'id' => form_error('id'),
                'patient_name' => form_error('patient_name'),
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $id = $this->input->post('id');
            $reporting_date = $this->input->post("reporting_date");

            $report_batch = array(
                'id' => $id,
                'customer_type' => $this->input->post('customer_type'),
                'consultant_doctor' => $this->input->post('consultant_doctor'),
                'reporting_date' => date('Y-m-d', $this->customlib->datetostrtotime($reporting_date)),
                'description' => $this->input->post('description'),
                'radiology_report' => $picture,
                'apply_charge' => $this->input->post('apply_charge'),
            );
            $this->radio_model->updateTestReport($report_batch);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
    }

    public function download($doc) {
        $this->load->helper('download');
        $filepath = "./uploads/radiology_report/" . $doc;
        $data = file_get_contents($filepath);
        force_download($doc, $data);
    }

    public function deleteTestReport($id) {
        if (!$this->rbac->hasPrivilege('add_patient_test_reprt', 'can_delete')) {
            access_denied();
        }
        $this->radio_model->deleteTestReport($id);
    }

    public function radiologyReport() {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'admin/radio/radiologyreport');
        $select = 'radiology_report.*, radio.id, radio.short_name,staff.name,staff.surname,charges.id as cid,charges.charge_category,charges.standard_charge';
        $join = array(
            'JOIN radio ON radiology_report.radiology_id = radio.id',
            'JOIN staff ON radiology_report.consultant_doctor = staff.id',
            'JOIN charges ON charges.id = radio.charge_id'
        );
        $table_name = "radiology_report";
        $search_type = $this->input->post("search_type");
        if (isset($search_type)) {
            $search_type = $this->input->post("search_type");
        } else {
            $search_type = "this_month";
        }

        if (empty($search_type)) {
            $search_type = "";
            $resultlist = $this->report_model->getReport($select, $join, $table_name);
        } else {

            $search_table = "radiology_report";
            $search_column = "reporting_date";
            $resultlist = $this->report_model->searchReport($select, $join, $table_name, $search_type, $search_table, $search_column);
        }
        $data["searchlist"] = $this->search_type;
        $data["search_type"] = $search_type;
        $data["resultlist"] = $resultlist;
        $this->load->view('layout/header');
        $this->load->view('admin/radio/radiologyReport.php', $data);
        $this->load->view('layout/footer');
    }

    public function examination() {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'examination');
        $categoryName = $this->lab_model->getlabName();
        $data["categoryName"] = $categoryName;
        $data['charge_category'] = $this->radio_model->getChargeCategory();
        $doctors = $this->staff_model->getStaffbyrole(3);
        $data["doctors"] = $doctors;
        $data['resultlist'] = $this->radio_model->getDiognostic();
        $result = $this->radio_model->getRadiology();
        $data['result'] = $result;
        $this->load->view('layout/header');
        $this->load->view('admin/radio/examination.php', $data);
        $this->load->view('layout/footer');
    }

    public function search_ult()
    {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'examination');
        $this->session->set_userdata('sub_menu', 'search_ult');
        $categoryName = $this->lab_model->getlabName();
        $data["categoryName"] = $categoryName;
        $data['charge_category'] = $this->radio_model->getChargeCategory();
        $doctors = $this->staff_model->getStaffbyrole(3);
        $data["doctors"] = $doctors;
        $data['resultlist'] = $this->radio_model->getLabUltra();
        $result = $this->radio_model->getRadiology();
        $data['result'] = $result;
        $this->load->view('layout/header');
        $this->load->view('admin/radio/search_ult.php', $data);
        $this->load->view('layout/footer');
        # code...
    }

    public function search_x_ray()
    {
       if (!$this->rbac->hasPrivilege('radiology test', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'examination');
        $this->session->set_userdata('sub_menu', 'search_x_ray');
        $categoryName = $this->lab_model->getlabName();
        $data["categoryName"] = $categoryName;
        $data['charge_category'] = $this->radio_model->getChargeCategory();
        $doctors = $this->staff_model->getStaffbyrole(3);
        $data["doctors"] = $doctors;
        $data['resultlist'] = $this->radio_model->get_x_ray();
        $result = $this->radio_model->getRadiology();
        $data['result'] = $result;
        $this->load->view('layout/header');
        $this->load->view('admin/radio/search_x_ray', $data);
        $this->load->view('layout/footer');
        # code...
    }

    public function search_ecg()
    {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'examination');
        $this->session->set_userdata('sub_menu', 'search_ecg');
        $categoryName = $this->lab_model->getlabName();
        $data["categoryName"] = $categoryName;
        $data['charge_category'] = $this->radio_model->getChargeCategory();
        $doctors = $this->staff_model->getStaffbyrole(3);
        $data["doctors"] = $doctors;
        $data['resultlist'] = $this->radio_model->getLabECG();
        $result = $this->radio_model->getRadiology();
        $data['result'] = $result;
        $this->load->view('layout/header');
        $this->load->view('admin/radio/search_ecg.php', $data);
        $this->load->view('layout/footer');
        # code...
    }

    public function addLabUlt()
    {
        $radiology = array(
            'patient_name' => $this->input->post('patient_name'),
            'patient_fname' => $this->input->post('patient_fname'),
            'address' => $this->input->post('address'),
            'date' => $this->input->post('date'),
            'register_num_ipd' => $this->input->post('register_num_ipd'),
            'register_num_opd' => $this->input->post('register_num_opd'),
            'operation_type' => $this->input->post('operation_type'),
            'ticket' => $this->input->post('ticket'),
            'fees' => $this->input->post('fees'),
            'observation' => $this->input->post('observation'),
        );
        $this->radio_model->addLabUlt($radiology);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        redirect('admin/radio/search_ult');
        # code...
    }
    public function add_nursing_forcep()
    {
        echo "string";
        $radiology = array(
            'forcep_name' => $this->input->post('forcep_name'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'before_birth' => $this->input->post('before_birth'),
            'giving_birth' => $this->input->post('giving_birth'),
            'after_birth' => $this->input->post('after_birth'),
            'family_arrangement' => $this->input->post('family_arrangement'),
            'birth_leaving' => $this->input->post('birth_leaving')
        );
        $this->radio_model->addForcep($radiology);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        redirect('admin/radio/search_nursing');
        # code...
    }

    public function getPatientRecord()
    {
        $id = $this->input->post("patient_id");
        $result = $this->radio_model->getPatientRecord($id);
        echo json_encode($result);
    }

    public function updatePatientUlt()
    {
        $id = $this->input->post('id');
            $radiology = array(
                'patient_name' => $this->input->post('patient_name'),
                'patient_fname' => $this->input->post('patient_fname'),
                'address' => $this->input->post('address'),
                'date' => $this->input->post('date'),
                'register_num_ipd' => $this->input->post('register_num_ipd'),
                'register_num_opd' => $this->input->post('register_num_opd'),
                'operation_type' => $this->input->post('operation_type'),
                'ticket' => $this->input->post('ticket'),
                'fees' => $this->input->post('fees'),
                'observation' => $this->input->post('observation'),
            );
        $radiology['id'] = $id;
        $this->radio_model->updatePatientUlt($radiology);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        
        echo json_encode($array);
    }

    public function addLabECG()
    {
        $radiology = array(
            'patient_name' => $this->input->post('patient_name'),
            'patient_fname' => $this->input->post('patient_fname'),
            'address' => $this->input->post('address'),
            'date' => $this->input->post('date'),
            'age' => $this->input->post('age'),
            'operation_type' => $this->input->post('operation_type'),
            'gender' => $this->input->post('gender'),
            'fees' => $this->input->post('fees'),
            'observation' => $this->input->post('observation'),
        );
        $this->radio_model->addLabECG($radiology);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        redirect('admin/radio/search_ecg');
        # code...
    }

    public function getPatientRecordECG()
    {
        $id = $this->input->post("patient_id");
        $result = $this->radio_model->getPatientRecordECG($id);
        echo json_encode($result);
    }



    public function search_lab_config()
    {
        if (!$this->rbac->hasPrivilege('opd_patient', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'examination');
        $this->session->set_userdata('sub_menu', 'search_lab_config');
        // $categoryName = $this->lab_model->getlabName();
        // $data["categoryName"] = $categoryName;
        // $data['charge_category'] = $this->radio_model->getChargeCategory();
        // $doctors = $this->staff_model->getStaffbyrole(3);
        // $data["doctors"] = $doctors;
        $data['resultlist'] = $this->radio_model->getLabConf();
        // $result = $this->radio_model->getRadiology();
        // $data['result'] = $result;
        $this->load->view('layout/header');
        $this->load->view('admin/radio/search_lab_config', $data);
        $this->load->view('layout/footer');
    }
    public function search_lab()
    {
        if (!$this->rbac->hasPrivilege('radiology test', 'can_view')) {
            access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'examination');
        $this->session->set_userdata('sub_menu', 'search_lab');
        $categoryName = $this->lab_model->getlabName();
        $data["categoryName"] = $categoryName;
        $data['charge_category'] = $this->radio_model->getChargeCategory();
        $doctors = $this->staff_model->getStaffbyrole(3);
        $data["doctors"] = $doctors;
        $data['resultlist'] = $this->radio_model->getLab();
        $result = $this->radio_model->getRadiology();
        $data['result'] = $result;
        $this->load->view('layout/header');
        $this->load->view('admin/radio/search_lab', $data);
        $this->load->view('layout/footer');
    }

    public function addLabConf()
    {
        $test = array(
            'test_name' => $this->input->post('test_name'),
            // 'normal' => $this->input->post('normal'),
            'price' => $this->input->post('price'),
            // 'unit' => $this->input->post('unit'),
            'appearance' => $this->input->post('appearance'),
            // 'test_type' => $this->input->post('test_type'),
            'test_type' => "laboratory",
            'test_section' => $this->input->post('test_section'),
            'description' => $this->input->post('description'),
            'created_at' => $this->input->post('entry_date')
        );
        $this->radio_model->addLabConf($test);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        redirect('admin/radio/search_lab_config');
        // echo json_encode($test);
    }

    
    public function getLabConfRecord()
    {
        $id = $this->input->post("patient_id");
        $result = $this->radio_model->getLabConfRecord($id);
        // print_r($result);
        echo json_encode($result);
    }

    public function updateLabConf()
    {
        $id = $this->input->post('id');
            $radiology = array(
            'test_name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'created_at' => $this->input->post('date'),
            'description' => $this->input->post('desc'),
            );
        $radiology['id'] = $id;
        $this->radio_model->updateLabConf($radiology);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        
        echo json_encode($array);
    }

    public function getPatientRecordXray()
    {
        $id = $this->input->post("patient_id");
        $result = $this->radio_model->getPatientRecordXray($id);
        echo json_encode($result);
    }

    public function bringLab()
    {
        $id = $this->input->post("patient_id");
        $result = $this->radio_model->bringLab($id);
        echo json_encode($result);
        # code...
    }
    public function bring_x_ray()
    {
        $id = $this->input->post("patient_id");
        $result = $this->radio_model->bring_x_ray($id);
        echo json_encode($result);
        # code...
    }
    public function bring_ultrasound()
    {
        $id = $this->input->post("patient_id");
        $result = $this->radio_model->bring_ultrasound_m($id);
        echo json_encode($result);
        # code...
    }
    public function updatePatientXray()
    {
        $id = $this->input->post('id');
            $radiology = array(
                'patient_name' => $this->input->post('patient_name'),
                'patient_fname' => $this->input->post('patient_fname'),
                'address' => $this->input->post('address'),
                'date' => $this->input->post('date'),
                'age' => $this->input->post('age'),
                'operation_type' => $this->input->post('operation_type'),
                'gender' => $this->input->post('gender'),
                'fees' => $this->input->post('fees'),
                'observation' => $this->input->post('observation'),
            );
        $radiology['id'] = $id;
        $this->radio_model->updatePatientXray($radiology);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        
        echo json_encode($array);
        # code...
    }

    public function updateLab()
    {
        $id = $this->input->post('id');
            $data = array(
                'patient_name' => $this->input->post('patient_name'),
                'admission_date' => $this->input->post('date'),
                'age' => $this->input->post('age'),
                'gender' => $this->input->post('gender'),
                'patient_fname' => $this->input->post('patient_fname'),
                'operation_type' => $this->input->post('operation_type'),
                'result' => $this->input->post('result'),
            );
        $data['id'] = $id;
        $this->radio_model->updateLab($data);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        echo json_encode($array);
    }
// My code
    public function update_Lab_Lab()
    {
        $id = $this->input->post('lab_id');
            $data = array(
                'duplicate' => $this->input->post('duplicate'),
                'result' => $this->input->post('result'),
                'result_desc' => $this->input->post('result_desc'),
            );
        $this->radio_model->updateLab_Lab_test($data,$id);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        echo json_encode($array);
    }

    public function update_Lab_ult()
    {
        $id = $this->input->post('lab_id');
            $data = array(
                'exam_type' => $this->input->post('exam_type'),
                'description' => $this->input->post('description'),
            );
        $this->radio_model->updateLab_ult_test($data,$id);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        echo json_encode($array);
    }
    public function update_Lab_xray()
    {
        $id = $this->input->post('lab_id');
            $data = array(
                'x_ray_size' => $this->input->post('x_ray_size'),
                'loss' => $this->input->post('loss'),
                'exam_type' => $this->input->post('exam_type'),
                'description' => $this->input->post('description'),
            );
        $this->radio_model->updateLab_xray_test($data,$id);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        echo json_encode($array);
    }

    public function update_Lab_ecg()
    {
        $id = $this->input->post('lab_id');
            $data = array(
                'exam_type' => $this->input->post('exam_type'),
                'description' => $this->input->post('description'),
            );
        $this->radio_model->updateLab_ecg_test($data,$id);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        echo json_encode($array);
    }
// My code
public function edit_lab_lab()
{
    $patient_id = $this->input->post('patient_id');
    $round= $this->input->post('round');
    $data['consultant_doctor'] = $this->input->post('consultant_doctor');
    $data['refer_of'] = $this->input->post('refer_of');
    $data['updated_at'] = $this->input->post('updated_at');
    $data['updated'] = 1;
    $data['add_description'] = $this->input->post('add_description');
    $this->load->model("radio_model");
    $this->radio_model->updateLab_Lab_extraInfo($data,$patient_id,$round);
    redirect('admin/radio/search_lab'); 
    
}
function updateLabUlt()
{
    $patient_id = $this->input->post('patient_id');
    $round= $this->input->post('round');
    $data['consultant_doctor'] = $this->input->post('consultant_doctor');
    $data['refer_of'] = $this->input->post('refer_of');
    $data['updated_at'] = $this->input->post('updated_at');
    $data['updated'] = 1;
    $data['add_description'] = $this->input->post('add_description');
    $this->load->model("radio_model");
    $this->radio_model->updateLab_ult_extraInfo($data,$patient_id,$round);
    redirect('admin/radio/search_ult'); 
}

function updateLabXray()
{
    $patient_id = $this->input->post('patient_id');
    $round= $this->input->post('round');
    $data['consultant_doctor'] = $this->input->post('consultant_doctor');
    $data['refer_of'] = $this->input->post('refer_of');
    $data['updated_at'] = $this->input->post('updated_at');
    $data['updated'] = 1;
    $data['add_description'] = $this->input->post('add_description');
    $this->load->model("radio_model");
    $this->radio_model->updateLab_xray_extraInfo($data,$patient_id,$round);
    redirect('admin/radio/search_x_ray'); 
}
function updatePatientECG()
{
    $patient_id = $this->input->post('patient_id');
    $round= $this->input->post('round');
    $data['consultant_doctor'] = $this->input->post('consultant_doctor');
    $data['refer_of'] = $this->input->post('refer_of');
    $data['updated_at'] = $this->input->post('updated_at');
    $data['updated'] = 1;
    $data['add_description'] = $this->input->post('add_description');
    $this->load->model("radio_model");
    $this->radio_model->updateLab_ecg_extraInfo($data,$patient_id,$round);
    redirect('admin/radio/search_ecg'); 
}

    public function addLabXray()
    {
        $radiology = array(
            'patient_name' => $this->input->post('patient_name'),
            'patient_fname' => $this->input->post('patient_fname'),
            'address' => $this->input->post('address'),
            'date' => $this->input->post('date'),
            'age' => $this->input->post('age'),
            'operation_type' => $this->input->post('operation_type'),
            'gender' => $this->input->post('gender'),
            'fees' => $this->input->post('fees'),
            'observation' => $this->input->post('observation'),
        );
        $this->radio_model->addLabXray($radiology);
        $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        redirect('admin/radio/search_x_ray');
        # code...
    }
    public function bring_ecg()
    {
        $id = $this->input->post("patient_id");
        $result = $this->radio_model->bring_ecg($id);
        echo json_encode($result);
    }

    public function getWard()
    {
        $id = $this->input->post("patient_id");
        $result = $this->radio_model->getWard($id);
        echo json_encode($result);

    }

}
?>