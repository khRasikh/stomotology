<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->config->load("payroll");
        $this->load->library('Enc_lib');
        $this->marital_status = $this->config->item('marital_status');
        $this->payment_mode = $this->config->item('payment_mode');
        $this->blood_group = $this->config->item('bloodgroup');
        $this->load->library('mailsmsconf');

        $this->load->model("payment_model");
        $this->load->model("Printing_model");
        $this->load->model("bed_model");
        $this->charge_type = $this->config->item('charge_type');
        $data["charge_type"] = $this->charge_type;
    }

    function create() {
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('payment_date', $this->lang->line('payment') . " " . $this->lang->line('date'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'amount' => form_error('amount'),
                'payment_date' => form_error('payment_date'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $patient_id = $this->input->post("patient_id");
            $date = $this->input->post("payment_date");
            $paid_amount = $this->input->post('amount');
            $paid_total = $this->payment_model->getPaidTotal($patient_id);
            $totalPaidamount = $paid_total["paid_amount"] + $paid_amount;
            $total = $this->input->post('total');
            $balance_amount = ($total) - ($totalPaidamount);
            $data = array(
                'patient_id' => $this->input->post('patient_id'),
                'paid_amount' => $paid_amount,
                'balance_amount' => $balance_amount,
                'total_amount' => $total,
                'round'=>    $this->input->post('patient_round'),
                'note' => $this->input->post('note'),
                'date' => $this->input->post('payment_date'),
            );

            $this->payment_model->addPayment($data);
            $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
        }


        echo json_encode($array);
    }

    public function download($doc) {
        $this->load->helper('download');
        $filepath = "./uploads/payment_document/" . $doc;
        $data = file_get_contents($filepath);
        force_download($doc, $data);
    }

  public function getBill() {
        $id = $this->input->post("patient_id");
        $data['total_amount'] = $this->input->post("total_amount");
        $data['discount'] = $this->input->post("discount");
        $data['other_charge'] = $this->input->post("other_charge");
        $data['gross_total'] = $this->input->post("gross_total");
        $data['tax'] = $this->input->post("tax");
        $data['net_amount'] = $this->input->post("net_amount");
        $data["print_details"] = $this->Printing_model->get('', 'ipd');
        $status = $this->input->post("status");
        $result = $this->patient_model->getPatientRecord($id);
        /*$charges = $this->charge_model->getCharges($id);
        $paymentDetails = $this->payment_model->paymentDetails($id);*/
        $paid_amount = $this->payment_model->getPaidTotal($id);
        $balance_amount = $this->payment_model->getBalanceTotal($id);
        $data["paid_amount"] = $paid_amount["paid_amount"];
        $data["balance_amount"] = $balance_amount["balance_amount"];
        $data["payment_details"] = $paymentDetails;
        $data["charges"] = $charges;
        $data["result"] = $result;

        //incomes
      $data['patient_price'] = $this->patient_model->getPatientTestPrice($id);
      $data['patient_lab_lab'] = $this->patient_model->getPatientLabLabIncome($id);
      $data['patient_lab_ecg'] = $this->patient_model->getPatientLabECGIncome($id);
      $data['patient_lab_ult'] = $this->patient_model->getPatientLabUltIncome($id);
      $data['patient_lab_xray'] = $this->patient_model->getPatientLabXrayIncome($id);
      $data['patient_ward'] = $this->patient_model->getPatientWardIncome($id);
      $data['operations_lists'] = $this->patient_model->getOperationList($id);
      $data['nursing_chges_lists'] = $this->patient_model->getNursingCharges($id);
  
      //Get Last Record of Nursing and Operation 
      $data['patient_round'] = $this->patient_model->getLastRound('opd_details',$id);
      $data['op_li_last'] = $this->patient_model->getOperationListLast($id, $data['patient_round']);
      $data['nursing_last'] = $this->patient_model->getNursingLast($id, $data['patient_round']);
    //   $nu_lround =  $data['nursing_chges_lists'][0]['round'];
    //   $data['nursing_last'] = $this->patient_model->getNursingLast($id, $nu_lround);
     $this->load->view("admin/patient/ipdBill", $data);
    }
    
    public function addbill() {
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('net_amount', 'Net Amount', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'total_amount' => form_error('total_amount'),
                'net_amount' => form_error('net_amount'),
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $patient_id = $this->input->post('patientid');
            $data = array('patient_id' => $this->input->post('patientid'),
                'patient_id' => $this->input->post('patientid'),
                'discount' => $this->input->post('discount'),
                'other_charge' => $this->input->post('other_charge'),
                'total_amount' => $this->input->post('total_amount'),
                'gross_total' => $this->input->post('gross_total'),
                'tax' => $this->input->post('tax'),
                'net_amount' => $this->input->post('net_amount'),
                'date' => date("Y-m-d"),
                'generated_by' => $this->session->userdata('admin')['id'],
                'status' => 'paid',
                'round' => $this->input->post('round')
            );
            $this->payment_model->add_bill($data);
            $bed_no = $this->input->post('bed_no');
            $bed_data = array('id' => $bed_no, 'is_active' => 'yes');
            $this->bed_model->savebed($bed_data);
            // $patient_data = array('id' => $patient_id, 'is_active' => 'no');
            // $this->patient_model->add($patient_data);
            $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
            $sender_details = array('patient_id' => $patient_id, 'contact_no' => '', 'email' => '');
            $this->mailsmsconf->mailsms('patient_discharged', $sender_details);
        }

        echo json_encode($array);
    }

}

?>