<?php  

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chargecategory extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->config->load("payroll");
        $this->charge_type = $this->config->item('charge_type');
    }

    public function charges() {
        if (!$this->rbac->hasPrivilege('charge_category', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'setup');
        $this->session->set_userdata('sub_menu', 'charges/index');
        $chargecategoryid = $this->input->post("chargecategoryid");
        
        $chargeCategory = $this->charge_category_model->getChargeCategory();
        $data["chargeCategory"] = $chargeCategory;
        $data['charge_type'] = $this->charge_type;
        $this->form_validation->set_rules(
                'name', 'Name', array('required',
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
            $this->load->view("admin/charges/chargeCategory", $data);
            $this->load->view("layout/footer");
        }
    }

    function add() {
        if (!$this->rbac->hasPrivilege('charge_category', 'can_add')) {
            access_denied();
        }
        $this->form_validation->set_rules(
                'name', $this->lang->line('name'), array('required',
            array('check_exists', array($this->charge_category_model, 'valid_charge_category'))
                )
        );
        // $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
        // $this->form_validation->set_rules('charge_type', $this->lang->line('charge') . " " . $this->lang->line('type'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'patient_name' => form_error('name'),
                // 'description' => form_error('description'),
                // 'charge_type' => form_error('charge_type'),
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $name = $this->input->post("name");
            // $description = $this->input->post("description");
            // $charge_type = $this->input->post("charge_type");
            $chargecategoryid = $this->input->post("id_id");
            if (!empty($chargecategoryid)) {
                $data = array('patient_name' => $name, 'id' => $chargecategoryid);
            } else {
                $data = array('patient_name' => $name);
            }
            $insert_id = $this->charge_category_model->addChargeCategory($data);
            if (!empty($chargecategoryid)) {
                $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('update_message'));
            } else {

                $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            }
        }
        echo json_encode($array);
    }

    function update() {
        if (!$this->rbac->hasPrivilege('opd_patient', 'can_add')) {
            access_denied();
        }
        $this->form_validation->set_rules(
                'name', $this->lang->line('name'), array('required'),
                'unique_id', $this->lang->line('unique_id'), array('required')
            );
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'patient_name' => form_error('name'),
                'unique_id' => form_error('unique_id'),  
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else { 
            $chargecategoryid = $this->input->post("id_id");
            if (!empty($chargecategoryid)) {
                $data = array(
                    'patient_name' => $this->input->post("name"),  
                    'unique_id' => $this->input->post("unique_id"),
                    'day' => $this->input->post("day"),
                    'month' => $this->input->post("month"),
                    'year' => $this->input->post("year"),
                    'test_name' => $this->input->post("allowance_type1"),
                    'duplicate' => $this->input->post("numbers"),
                    'fees' => $this->input->post("amount_all"),
                    'add_description' => $this->input->post("notes"), 
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
                    'id' => $chargecategoryid
                );
            }  
            $insert_id = $this->charge_category_model->addChargeCategory($data);
            if (!empty($chargecategoryid)) {
                $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('update_message'));
            } else {

                $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            }
        }
        echo json_encode($array);
    }
    function get() { //get product data and encode to be JSON object
        if (!$this->rbac->hasPrivilege('charge_category', 'can_view')) {
            access_denied();
        }
        header('Content-Type: application/json');
        echo $this->charge_category_model->getall();
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('charge_category', 'can_edit')) {
            access_denied();
        }
        $result = $this->charge_category_model->getChargeCategory($id);
        $data['charge_type'] = $this->charge_type;
        $data["result"] = $result;
        $data["title"] = "Edit Category";
        $chargeCategory = $this->charge_category_model->getChargeCategory();
        $data["chargeCategory"] = $chargeCategory;
        $this->load->view("layout/header");
        $this->load->view("admin/charges/chargeCategory", $data);
        $this->load->view("layout/footer");
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('opd_patient', 'can_delete')) {
            access_denied();
        }
        $this->charge_category_model->delete($id);
        redirect('admin/chargecategory/charges');
    }

    function get_data($id) {
        $result = $this->charge_category_model->getChargeCategory($id); 
        echo json_encode($result);
    }
}
?>