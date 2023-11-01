<?php

class Patient_model extends CI_Model
{

    public function add($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('patients', $data);
        } else {
            $this->db->insert('patients', $data);
            return $this->db->insert_id();
        }
    }

    public function add_opd($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('opd_details', $data);
        } else {
            $this->db->insert('opd_details', $data);
            return $this->db->insert_id();
        }
    }

    public function add_opd_printed($opd_printed)
    {
        if (isset($opd_printed['patient_id'])) {
            $this->db->where('patient_id', $opd_printed['patient_id']);
            $this->db->update('opd_details', $opd_printed);
        } else {
            $this->db->insert('opd_details', $opd_printed);
            return $this->db->insert_id();
        }
    }

    public function add_lab_lab_printed($lab_data)
    {
        if (isset($lab_data['patient_id'])) {
            $this->db->where('patient_id', $lab_data['patient_id']);
            $this->db->update('lab_lab', $lab_data);
        } else {
            $this->db->insert('lab_lab', $lab_data);
            return $this->db->insert_id();
        }
    }

    public function add_ipd($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('ipd_details', $data);
        } else {
            $this->db->insert('ipd_details', $data);
            return $this->db->insert_id();
        }
    }

    public function adddoc($data)
    {
        $this->db->insert('student_doc', $data);
        return $this->db->insert_id();
    }

    public function searchAll($searchterm)
    {

        $this->db->select('patients.*')
            ->from('patients')
            ->like('patients.patient_name', $searchterm)
            ->or_like('patients.guardian_name', $searchterm)
            ->or_like('patients.patient_type', $searchterm)
            ->or_like('patients.address', $searchterm)
            ->or_like('patients.patient_unique_id', $searchterm)
            ->or_like('patients.hmis_no', $searchterm);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPatientList()
    {

        $this->db->select('patients.*,users.username,users.id as user_tbl_id,users.is_active as user_tbl_active')
            ->join('users', 'users.user_id = patients.id')
            ->from('patients');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchFullText($opd_month, $searchterm, $carray = null)
    {

        $last_date = date("Y-m-t 23:59:59.993", strtotime("-" . $opd_month . " month"));

        $this->db->select('patients.*')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('opd_details.appointment_date < ', $last_date);
        $this->db->group_start();
        $this->db->like('patients.patient_name', $searchterm);
        $this->db->or_like('patients.guardian_name', $searchterm);
        $this->db->group_end();
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_doctors_filtered($emp_id)
    {
        $this->db->select('patients.*,opd_details.appointment_date,opd_details.case_type,opd_details.patient_id,staff.name,
                        staff.surname')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('patients.patient_type', 'permanent');
        $this->db->where('patients.payment', $emp_id);
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchByMonth()
    {
        $page_number = 2; 
        $per_page = 10; 
        $this->db->select('patients.*,opd_details.appointment_date,opd_details.case_type,
        opd_details.patient_id,staff.name as sname,
                        staff.surname')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        // $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->join('staff', 'staff.id = patients.payment', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('patients.patient_type', 'permanent');
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');
        $this->db->limit($per_page, $page_number);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchNew()
    {
        $this->db->select('patients.*,opd_details.appointment_date,opd_details.case_type,opd_details.patient_id,staff.name,staff.surname
                  ')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('patients.patient_type', 'new');
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');
        $query = $this->db->get();

        return $query->result_array();
    }
    public function teetlist()
    {
        $this->db->select('lab_lab.*')->from('lab_lab');
        $this->db->order_by('lab_lab.id', 'desc');
        $query = $this->db->get();

        return $query->result_array();
    }



    // My code
    public function searchByMonth_forExShow_MyCode($id, $opd_month, $searchterm, $carray = null)
    {

        $q = $this->db->select("patient_unique_id as puid")->where("id", $id)->get("patients");
        $result = $q->row();
        $puid = $result->puid;
        $first_date = date('Y-m' . '-01', strtotime("-" . $opd_month . " month"));
        $last_date = date('Y-m' . '-' . date('t', strtotime($first_date)) . ' 23:59:59.993');
        $this->db->select('patients.*,opd_details.appointment_date,opd_details.case_type,staff.name,staff.surname
                  ')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('opd_details.appointment_date >', $first_date);
        $this->db->where('opd_details.appointment_date <', $last_date);
        $this->db->group_start();
        $this->db->like('patients.patient_name', $searchterm);
        $this->db->or_like('patients.guardian_name', $searchterm);
        $this->db->group_end();
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');

        $query = $this->db->where('patient_unique_id', $puid)->get();
        return $query->result_array();
    }

    public function searchByMonth_forExShow($opd_month, $searchterm, $carray = null)
    {
        $first_date = date('Y-m' . '-01', strtotime("-" . $opd_month . " month"));
        $last_date = date('Y-m' . '-' . date('t', strtotime($first_date)) . ' 23:59:59.993');
        $this->db->select('patients.*,opd_details.appointment_date,opd_details.case_type,staff.name,staff.surname
                  ')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('opd_details.appointment_date >', $first_date);
        $this->db->where('opd_details.appointment_date <', $last_date);
        $this->db->group_start();
        $this->db->like('patients.patient_name', $searchterm);
        $this->db->or_like('patients.guardian_name', $searchterm);
        $this->db->group_end();
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');
        $query = $this->db->where('patient_unique_id', 1001)->get();

        return $query->result_array();
    }
    public function searchByMonth_search_internal($opd_month, $searchterm, $carray = null)
    {


        $first_date = date('Y-m' . '-01', strtotime("-" . $opd_month . " month"));
        $last_date = date('Y-m' . '-' . date('t', strtotime($first_date)) . ' 23:59:59.993');

        $this->db->select('patients.*')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('opd_details.appointment_date >', $first_date);
        $this->db->where('opd_details.appointment_date <', $last_date);
        $this->db->group_start();
        $this->db->like('patients.patient_name', $searchterm);
        $this->db->or_like('patients.guardian_name', $searchterm);
        $this->db->group_end();
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');
        $query = $this->db->where('opd', 'Internal Medicine')->get();
        return $query->result_array();
    }
    public function searchByMonth_search_pediateric($opd_month, $searchterm, $carray = null)
    {


        $first_date = date('Y-m' . '-01', strtotime("-" . $opd_month . " month"));
        $last_date = date('Y-m' . '-' . date('t', strtotime($first_date)) . ' 23:59:59.993');

        $this->db->select('patients.*,opd_details.appointment_date,opd_details.case_type,staff.name,staff.surname
                  ')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('opd_details.appointment_date >', $first_date);
        $this->db->where('opd_details.appointment_date <', $last_date);
        $this->db->group_start();
        $this->db->like('patients.patient_name', $searchterm);
        $this->db->or_like('patients.guardian_name', $searchterm);
        $this->db->group_end();
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');
        $query = $this->db->where('opd', 'Pediatric & Malnutrition')->get();

        return $query->result_array();
    }
    public function searchByMonth_search_ob($opd_month, $searchterm, $carray = null)
    {


        $first_date = date('Y-m' . '-01', strtotime("-" . $opd_month . " month"));
        $last_date = date('Y-m' . '-' . date('t', strtotime($first_date)) . ' 23:59:59.993');

        $this->db->select('patients.*,opd_details.appointment_date,opd_details.case_type,staff.name,staff.surname
                  ')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('opd_details.appointment_date >', $first_date);
        $this->db->where('opd_details.appointment_date <', $last_date);
        $this->db->group_start();
        $this->db->like('patients.patient_name', $searchterm);
        $this->db->or_like('patients.guardian_name', $searchterm);
        $this->db->group_end();
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');
        $query = $this->db->where('opd', 'OB/GYN')->get();

        return $query->result_array();
    }
    public function searchByMonth_general($opd_month, $searchterm, $carray = null)
    {


        $first_date = date('Y-m' . '-01', strtotime("-" . $opd_month . " month"));
        $last_date = date('Y-m' . '-' . date('t', strtotime($first_date)) . ' 23:59:59.993');

        $this->db->select('patients.*,opd_details.appointment_date,opd_details.case_type,staff.name,staff.surname
                  ')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('opd_details.appointment_date >', $first_date);
        $this->db->where('opd_details.appointment_date <', $last_date);
        $this->db->group_start();
        $this->db->like('patients.patient_name', $searchterm);
        $this->db->or_like('patients.guardian_name', $searchterm);
        $this->db->group_end();
        $this->db->order_by('patients.id', 'desc');
        $this->db->group_by('opd_details.patient_id');
        $query = $this->db->where('opd', 'General Surgery Department')->get();

        return $query->result_array();
    }

    public function totalVisit($patient_id)
    {
        $query = $this->db->select('count(opd_details.patient_id) as total_visit')
            ->where('patient_id', $patient_id)
            ->get('opd_details');

        return $query->row_array();
    }
    public function getPermanentPatientTotal()
    {
        $query = $this->db->select('count(patients.id) as permanent')
            ->where('patient_type', 'permanent')
            ->get('patients');
        return $query->row_array();
    }
    public function getTemporaryPatientTotal()
    {
        $query = $this->db->select('count(patients.id) as new')
            ->where('patient_type', 'new')
            ->get('patients');
        return $query->row_array();
    }
    public function getTotalAmount()
    {
        $query = $this->db->select('SUM(lab_lab.fees) as amount')
            ->get('lab_lab');
        return $query->row_array();
    }
    public function getTotalRecieved()
    {
        $query = $this->db->select('SUM(opd_details.amount) as recieved')
            ->get('opd_details');
        return $query->row_array();
    }
    public function getTotalTeeth()
    {
        $query = $this->db->select('SUM(lab_lab.duplicate) as teeth')
            ->get('lab_lab');
        return $query->row_array();
    }
    public function getTotalDiscount()
    {
        $query = $this->db->select('SUM(lab_lab.discount) as discount')
            ->get('lab_lab');
        return $query->row_array();
    }
    public function getTotalMale()
    {
        $query = $this->db->select('count(patients.id) as male')
            ->where('gender', 'مذکر')
            ->get('patients');
        return $query->row_array();
    }
    public function getTotalFemale()
    {
        $query = $this->db->select('count(patients.id) as female')
            ->where('gender', 'مونث' | '')
            ->get('patients');
        return $query->row_array();
    }
    public function lastVisit($patient_id)
    {
        $query = $this->db->select('max(opd_details.appointment_date) as last_visit')
            ->where('patient_id', $patient_id)
            ->get('opd_details');
        return $query->row_array();
    }

    public function patientProfile($id, $active = 'yes')
    {

        $query = $this->db->where("id", $id)->get("patients");
        $result = $query->row_array();

        if ($result["patient_type"] == "Outpatient") {
            $data = $this->getDetails($id);
        } else if ($result["patient_type"] == "Inpatient") {

            $data = $this->getIpdDetails($id, $active);
        }
        return $data;
    }

    public function getDetails($id)
    {
        $this->db->select('patients.*,opd_details.round as opd_round,opd_details.therapies as opdthe,
        opd_details.diagnoses as  opd_diag,opd_details.hmis_nu as opd_hmis,opd_details.appointment_date,
        opd_details.case_type,opd_details.id as opdid,opd_details.casualty,opd_details.cons_doctor,
        opd_details.refference,opd_details.opd_no,opd_details.known_allergies,opd_details.amount,opd_details.weight,opd_details.bp,opd_details.symptoms,
        opd_details.tax,opd_details.payment_mode,opd_details.note_remark,organisation.organisation_name,
        organisation.id as orgid,staff.name,staff.surname')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->join('organisation', 'organisation.id = patients.organisation', "left");
        $this->db->where('patients.is_active', 'yes');
        $this->db->where('patients.id', $id);
        $this->db->order_by('opd_details.round', 'DESC');
        $this->db->limit(1);
        if (!empty($opdid)) {
            $this->db->where('opd_details.id', $opdid);
        }
        $query = $this->db->get();
        return $query->row_array();
    }


    public function getIpdDetails($id, $active = 'yes')
    {
        $this->db->select('patients.*,ipd_details.date,ipd_details.case_type,ipd_details.ipd_no,ipd_details.id as ipdid,ipd_details.casualty,ipd_details.weight,ipd_details.bp,ipd_details.cons_doctor,ipd_details.refference,ipd_details.known_allergies,ipd_details.amount,ipd_details.symptoms,ipd_details.tax,ipd_details.bed,ipd_details.bed_group_id,ipd_details.bed,ipd_details.bed_group_id,ipd_details.payment_mode,ipd_billing.status,ipd_billing.gross_total,ipd_billing.discount,ipd_billing.tax,ipd_billing.net_amount,ipd_billing.total_amount,ipd_billing.other_charge,ipd_billing.generated_by,ipd_billing.id as bill_id,staff.name,staff.surname,organisation.organisation_name,bed.name as bed_name,bed.id as bed_id,bed_group.name as bedgroup_name,floor.name as floor_name')->from('patients');
        $this->db->join('ipd_details', 'patients.id = ipd_details.patient_id', "left");
        $this->db->join('ipd_billing', 'patients.id = ipd_billing.patient_id', "left");
        $this->db->join('staff', 'staff.id = ipd_details.cons_doctor', "inner");
        $this->db->join('organisation', 'organisation.id = patients.organisation', "left");
        $this->db->join('bed', 'ipd_details.bed = bed.id', "left");
        $this->db->join('bed_group', 'ipd_details.bed_group_id = bed_group.id', "left");
        $this->db->join('floor', 'floor.id = bed_group.floor', "left");
        $this->db->where('patients.is_active', $active);
        $this->db->where('patients.id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function getPatientId()
    {
        $this->db->select('patients.*,opd_details.appointment_date,opd_details.case_type,opd_details.id as opdid,opd_details.casualty,opd_details.cons_doctor,opd_details.refference,opd_details.known_allergies,opd_details.amount,opd_details.symptoms,opd_details.tax,opd_details.payment_mode')->from('patients');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->where('patients.is_active', 'yes');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getExams($id, $opdid = null)
    {
        if (!empty($opdid)) {
            $this->db->where("opd_details.id", $opdid);
        }
        $this->db->select('opd_details.*,patients.organisation,patients.old_patient,staff.name,staff.surname')->from('opd_details');
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->join('patients', 'patients.id = opd_details.patient_id', "inner");
        $this->db->join('lab_lab', 'lab_lab.id = opd_details.patient_id', "inner");
        $this->db->where('opd_details.patient_id', $id);
        $this->db->order_by('opd_details.id', 'desc');
        $query = $this->db->get();
        if (!empty($opdid)) {
            return $query->row_array();
        } else {

            $result = $query->result_array();
            $i = 0;
            return $result;
        }
    }
    // My code -> my function
    function show_all_thisPatient_exams($id)
    {

        $this->db->select('opd_details.*,patients.*')->from('opd_details');
        $this->db->join('patients', 'patients.id = opd_details.patient_id', "inner");
        $this->db->where('opd_details.patient_id', $id);
        $this->db->order_by('opd_details.id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getOPDetails($id, $opdid = null)
    {
        if (!empty($opdid)) {
            $this->db->where("opd_details.id", $opdid);
        }
        $this->db->select('opd_details.*,patients.organisation,patients.old_patient,staff.name,staff.surname')->from('opd_details');
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->join('patients', 'patients.id = opd_details.patient_id', "inner");
        $this->db->where('opd_details.patient_id', $id);
        $this->db->order_by('opd_details.id', 'desc');
        $query = $this->db->get();

        if (!empty($opdid)) {
            return $query->row_array();
        } else {
            $result = $query->result_array();
            $i = 0;
            foreach ($result as $key => $value) {
                $opd_id = $value["id"];
                $check = $this->db->where("opd_id", $opd_id)->get('prescription');
                if ($check->num_rows() > 0) {
                    $result[$i]['prescription'] = 'yes';
                } else {
                    $result[$i]['prescription'] = 'no';
                }
                $i++;
            }
            return $result;
        }
    }

    public function getOPDetailsForEachPrint($id, $opdid = null)
    {
        if (!empty($opdid)) {
            $this->db->where("opd_details.id", $opdid);
        }
        $this->db->select('opd_details.*,patients.organisation,patients.old_patient,staff.name,staff.surname
            , staff.designation, staff.contact_no,staff.email')->from('opd_details');
        $this->db->join('staff', 'staff.id = opd_details.cons_doctor', "inner");
        $this->db->join('patients', 'patients.id = opd_details.patient_id', "inner");
        $this->db->where('opd_details.patient_id', $id);
        $this->db->where('opd_details.is_printed', 0);
        $this->db->order_by('opd_details.id', 'desc');
        $query = $this->db->get();

        if (!empty($opdid)) {
            return $query->row_array();
        } else {
            $result = $query->result_array();
            $i = 0;
            foreach ($result as $key => $value) {
                $opd_id = $value["id"];
                $check = $this->db->where("opd_id", $opd_id)->get('prescription');
                if ($check->num_rows() > 0) {
                    $result[$i]['prescription'] = 'yes';
                } else {
                    $result[$i]['prescription'] = 'no';
                }
                $i++;
            }
            return $result;
        }
    }

    function add_diagnosis($data)
    {
        if (isset($data["id"])) {
            $this->db->where("id", $data["id"])->update("diagnosis", $data);
        } else {
            $this->db->insert("diagnosis", $data);
            return $this->db->insert_id();
        }
    }

    function getDiagnosisDetails($id)
    {
        $query = $this->db->where("patient_id", $id)->get("diagnosis");
        return $query->result_array();
    }

    public function deleteIpdPatientDiagnosis($id)
    {
        $query = $this->db->where('id', $id)
            ->delete('operation_theatre');
    }

    function add_prescription($data_array)
    {
        $this->db->insert_batch("prescription", $data_array);
    }

    function getMaxId()
    {
        $query = $this->db->select('max(patient_unique_id) as patient_id')->get("patients");
        $result = $query->row_array();
        return $result["patient_id"];
    }

    function getMaxOPDId()
    {
        $query = $this->db->select('max(id) as patient_id')->get("opd_details");
        $result = $query->row_array();
        return $result["patient_id"];
    }

    function search_ipd_patients($searchterm, $active = 'yes')
    {
        $this->db->select('patients.*,bed.name as bed_name,bed_group.name as bedgroup_name, floor.name as floor_name,ipd_details.date,ipd_details.case_type,staff.name,staff.surname
              ')->from('patients');
        $this->db->join('ipd_details', 'patients.id = ipd_details.patient_id', "inner");
        $this->db->join('staff', 'staff.id = ipd_details.cons_doctor', "inner");
        $this->db->join('bed', 'ipd_details.bed = bed.id', "left");
        $this->db->join('bed_group', 'ipd_details.bed_group_id = bed_group.id', "left");
        $this->db->join('floor', 'floor.id = bed_group.floor', "left");
        $this->db->where('patients.is_active', $active);
        $this->db->group_start();
        $this->db->like('patients.patient_name', $searchterm);
        $this->db->or_like('patients.guardian_name', $searchterm);
        $this->db->group_end();
        $this->db->order_by('patients.id');
        $this->db->group_by('ipd_details.patient_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add_consultantInstruction($data)
    {
        $this->db->insert_batch("consultant_register", $data);
    }

    public function deleteTeeth($id)
    {
        $query = $this->db->where('id', $id)
            ->delete('lab_lab');
    }

    function getPatientConsultant($id)
    {
        $query = $this->db->select('consultant_register.*,staff.name,staff.surname')->
            join('staff', 'staff.id = consultant_register.cons_doctor', "inner")->
            where("patient_id", $id)->get("consultant_register");
        // $query = $this->db->select('consultant_register.*')->get("consultant_register");
        return $query->result_array();
    }
    public function ipdCharge($code, $orgid)
    {
        if (!empty($orgid)) {
            $this->db->select('charges.*,organisations_charges.id as org_charge_id, organisations_charges.org_id, organisations_charges.org_charge ');
            $this->db->join('organisations_charges', 'charges.id = organisations_charges.charge_id');
            $this->db->where('organisations_charges.org_id', $orgid);
        }
        $this->db->where('charges.id', $code);
        $query = $this->db->get('charges');
        return $query->row_array();
    }

    public function getDataAppoint($id)
    {
        $query = $this->db->where('patients.id', $id)->get('patients');
        return $query->row_array();
    }

    public function search($id)
    {
        $this->db->select('appointment.*,staff.id as sid,staff.name,staff.surname,patients.id as pid,patients.patient_unique_id');
        $this->db->join('staff', 'appointment.doctor = staff.id', "inner");
        $this->db->join('patients', 'appointment.patient_id = patients.id', 'inner');
        $this->db->where('`appointment`.`doctor`=`staff`.`id`');
        $this->db->where('appointment.patient_id = patients.id');
        $this->db->where('appointment.patient_id=' . $id);
        $query = $this->db->get('appointment');
        return $query->result_array();
    }

    public function getOpdPatient($opd_ipd_no)
    {
        $query = $this->db->select('opd_details.patient_id,opd_details.opd_no,patients.id as pid,patients.patient_name,patients.age,patients.guardian_name,patients.guardian_address,patients.admission_date,patients.gender,staff.name as doctorname,staff.surname')
            ->join('patients', 'opd_details.patient_id = patients.id')
            ->join('staff', 'staff.id = opd_details.cons_doctor', "inner")
            ->where('opd_no', $opd_ipd_no)
            ->get('opd_details');
        return $query->row_array();
    }

    public function getIpdPatient($opd_ipd_no)
    {
        $query = $this->db->select('ipd_details.patient_id,ipd_details.ipd_no,patients.id as pid,patients.patient_name,patients.age,patients.guardian_name,patients.guardian_address,patients.admission_date,patients.gender,staff.name as doctorname,staff.surname')
            ->join('patients', 'ipd_details.patient_id = patients.id')
            ->join('staff', 'staff.id = ipd_details.cons_doctor', "inner")
            ->where('ipd_no', $opd_ipd_no)
            ->get('ipd_details');
        return $query->row_array();
    }

    public function getAppointmentDate()
    {
        $query = $this->db->select('opd_details.appointment_date')->get('opd_details');
    }

    public function deleteOPD($opdid)
    {
        $this->db->where("id", $opdid)->delete("opd_details");
    }

    public function deleteOPDPatient($id)
    {
        $this->db->where("patient_id", $id)->delete("opd_details");
        $this->db->where("patient_id", $id)->delete("pathology_report");
        $this->db->where("patient_id", $id)->delete("radiology_report");
        $this->db->where("user_id", $id)->where("role", 'patient')->delete("users");
        $this->db->where("id", $id)->delete("patients");
    }

    public function deleteRecord($id)
    {
        $this->db->where("patient_id", $id)->delete("lab_lab");
        // $this->db->where("patient_id", $id)->delete("pathology_report");
        // $this->db->where("patient_id", $id)->delete("radiology_report");
        // $this->db->where("user_id", $id)->where("role", 'patient')->delete("users");
        // $this->db->where("id", $id)->delete("patients");/
    }
    public function getCharges($patient_id)
    {
        $query = $this->db->select("sum(apply_charge) as charge")->where("patient_id", $patient_id)->get("patient_charges");
        return $query->row_array();
    }

    public function getPayment($patient_id)
    {
        $query = $this->db->select("sum(paid_amount) as payment")->where("patient_id", $patient_id)->get("payment");
        return $query->row_array();
    }

    public function patientCredentialReport()
    {
        $query = $this->db->select('patients.*,users.id as uid,users.user_id,users.username,users.password')
            ->join('users', 'patients.id = users.user_id')
            ->get('patients');
        return $query->result_array();
    }

    public function getPaymentDetail($patient_id)
    {
        $SQL = 'select patient_charges.amount_due,payment.amount_deposit from (SELECT sum(paid_amount) as `amount_deposit` FROM `payment` WHERE patient_id=' . $this->db->escape($patient_id) . ') as payment ,(SELECT sum(apply_charge) as `amount_due` FROM `patient_charges` WHERE patient_id=' . $this->db->escape($patient_id) . ') as patient_charges';
        $query = $this->db->query($SQL);

        return $query->row();
    }

    public function getIpdBillDetails($id)
    {
        $query = $this->db->where("patient_id", $id)->get("ipd_billing");
        return $query->row_array();
    }

    public function getDepositAmountBetweenDate($start_date, $end_date)
    {
        $opd_query = $this->db->select('*')->get('opd_details');
        $bloodbank_query = $this->db->select('*')->get('blood_issue');
        $pharmacy_query = $this->db->select('*')->get('pharmacy_bill_basic');

        $opd_result = $opd_query->result();
        $bloodbank_result = $bloodbank_query->result();

        $result_value = $opd_result;

        $return_array = array();
        if (!empty($result_value)) {
            $st_date = strtotime($start_date);
            $ed_date = strtotime($end_date);
            foreach ($result_value as $key => $value) {
                $return = $this->findObjectById($result_value, $st_date, $ed_date);

                if (!empty($return)) {
                    foreach ($return as $r_key => $r_value) {
                        $a = array();
                        $a['amount'] = $r_value->amount;
                        $a['date'] = $r_value->appointment_date;
                        $a['amount_discount'] = 0;
                        $a['amount_fine'] = 0;
                        $a['description'] = '';
                        $a['payment_mode'] = $r_value->payment_mode;
                        $a['inv_no'] = $r_value->patient_id;
                        $return_array[] = $a;
                    }
                }
            }
        }

        return $return_array;

    }

    function findObjectById($array, $st_date, $ed_date)
    {

        $sarray = array();
        for ($i = $st_date; $i <= $ed_date; $i += 86400) {
            $find = date('Y-m-d', $i);
            foreach ($array as $row_key => $row_value) {
                $appointment_date = date("Y-m-d", strtotime($row_value->appointment_date));
                if ($appointment_date == $find) {
                    $sarray[] = $row_value;
                }
            }
        }
        return $sarray;
    }

    public function getEarning($field, $module, $search_field = '', $search_value = '', $search = '')
    {

        if ((!empty($search_field)) && (!empty($search_value))) {

            $this->db->where($search_field, $search_value);
        }
        if (!empty($search)) {

            $this->db->where($search);
        }

        $query = $this->db->select('sum(' . $field . ') as amount')->get($module);

        $result = $query->row_array();
        return $result["amount"];
    }

    public function getPathologyEarning($search = '')
    {
        if (!empty($search)) {

            $this->db->where($search);
        }
        $query = $this->db->select('sum(charges.standard_charge) as amount')
            ->join('pathology', 'pathology.charge_id = charges.id')
            ->join('pathology_report', 'pathology_report.pathology_id = pathology.id')
            ->where('pathology_report.customer_type', 'direct')
            ->get('charges');
        $result = $query->row_array();
        return $result["amount"];
    }

    public function getRadiologyEarning($search = '')
    {
        if (!empty($search)) {

            $this->db->where($search);
        }

        $query = $this->db->select('sum(charges.standard_charge) as amount')
            ->join('radio', 'radio.charge_id = charges.id')
            ->join('radiology_report', 'radiology_report.radiology_id = radio.id')
            ->where('radiology_report.customer_type', 'direct')
            ->get('charges');
        $result = $query->row_array();
        return $result["amount"];
    }

    public function getOTEarning($search = '')
    {
        if (!empty($search)) {

            $this->db->where($search);
        }

        $query = $this->db->select('sum(operation_theatre.apply_charge) as amount')
            ->join('operation_theatre', 'operation_theatre.charge_id = charges.id')
            ->where('operation_theatre.customer_type', 'direct')
            ->get('charges');
        $result = $query->row_array();

        return $result["amount"];
    }

    public function deleteIpdPatient($id)
    {
        $query = $this->db->select('bed.id')
            ->join('ipd_details', 'ipd_details.bed = bed.id')
            ->where("ipd_details.patient_id", $id)->get('bed');

        $result = $query->row_array();
        $bed_id = $result["id"];
        $this->db->where("id", $bed_id)->update('bed', array('is_active' => 'yes'));

        $this->db->where("id", $id)->delete('patients');
        $this->db->where("user_id", $id)->where("role", 'patient')->delete('users');
        $this->db->where("patient_id", $id)->delete('ipd_details');
        $this->db->where("patient_id", $id)->delete('patient_charges');
        $this->db->where("patient_id", $id)->delete('payment');
        $this->db->where("patient_id", $id)->delete('ipd_billing');
    }

    public function getIncome($date_from, $date_to)
    {
        $object = new stdClass();

        $query1 = $this->getEarning($field = 'amount', $module = 'opd_details', $search_field = '', $search_value = '', $search = array('appointment_date >=' => $date_from, 'appointment_date <=' => $date_to));
        $amount1 = $query1;


        $query2 = $this->getEarning($field = 'paid_amount', $module = 'payment', $search_field = '', $search_value = '', $search = array('date >=' => $date_from, 'date <=' => $date_to));
        $amount2 = $query2;



        $query3 = $this->getEarning($field = 'net_amount', $module = 'pharmacy_bill_basic', $search_field = '', $search_value = '', $search = array('date >=' => $date_from, 'date <=' => $date_to));
        $amount3 = $query3;

        $query4 = $this->getEarning($field = 'amount', $module = 'blood_issue', $search_field = '', $search_value = '', $search = array('date_of_issue >=' => $date_from, 'date_of_issue <=' => $date_to . " 23:59:59.993"));

        $amount4 = $query4;


        $query5 = $this->getEarning($field = 'amount', $module = 'ambulance_call', $search_field = '', $search_value = '', $search = array('created_at >=' => $date_from, 'created_at <=' => $date_to));
        $amount5 = $query5;

        $query6 = $this->getPathologyEarning(array('pathology_report.reporting_date >=' => $date_from, 'pathology_report.reporting_date <=' => $date_to));
        $amount6 = $query6;


        $query7 = $this->getRadiologyEarning(array('radiology_report.reporting_date >=' => $date_from, 'radiology_report.reporting_date <=' => $date_to));
        $amount7 = $query7;

        $query8 = $this->getOTEarning(array('operation_theatre.date >=' => $date_from, 'operation_theatre.date <=' => $date_to));
        $amount8 = $query8;

        $query9 = $this->getEarning($field = 'amount', $module = 'income', $search_field = '', $search_value = '', $search = array('date >=' => $date_from, 'date <=' => $date_to));
        $amount9 = $query9;
        $query10 = $this->getEarning($field = 'net_amount', $module = 'ipd_billing', $search_field = '', $search_value = '', $search = array('date >=' => $date_from, 'date <=' => $date_to));
        $amount10 = $query10;

        $query11 = $this->getEarning($field = 'price', $module = 'examination', $search_field = '', $search_value = '', $search = array('date >=' => $date_from, 'date <=' => $date_to));
        $amount11 = $query11;

        $amount = $amount1 + $amount2 + $amount3 + $amount4 + $amount5 + $amount6 + $amount7 + $amount8 + $amount9 + $amount10 + $amount11;

        $object->amount = $amount;
        return $object;
    }

    public function getBillInfo($id)
    {
        $query = $this->db->select('staff.name,staff.surname,staff.employee_id,ipd_billing.date as discharge_date')
            ->join('ipd_billing', 'staff.id = ipd_billing.generated_by')
            ->where('ipd_billing.patient_id', $id)
            ->get('staff');
        $result = $query->row_array();
        return $result;
    }

    public function getStatus($id)
    {
        $query = $this->db->where("id", $id)->get("patients");
        $result = $query->row_array();
        return $result;
    }

    public function searchPatientNameLike($searchterm)
    {
        $this->db->select('patients.*')->from('patients');
        $this->db->group_start();
        $this->db->like('patients.patient_name', $searchterm);
        $this->db->group_end();
        $this->db->where('patients.is_active', 'yes');
        $this->db->order_by('patients.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPatientEmail()
    {

        $query = $this->db->select("patients.email,patients.id,patients.mobileno")
            ->join("users", "patients.id = users.user_id")
            ->where("users.role", "patient")
            ->where("patients.is_active", "yes")
            ->get("patients");
        return $query->result_array();
    }

    public function getOPD($id = 0)
    {
        $database = "operation";
        if ($id == 1) {
            $database = "operation";
        } else if ($id == 2) {
            $database = "medical";
        } else if ($id == 3) {
            $database = "children_medical";
        } else if ($id == 4) {
            $database = "giving_births";
        }
        $query = $this->db->select($database . '.*')->get($database);
        return $query->result_array();
    }

    public function bringLabconf($id = 0)
    {
        $query = $this->db->where('id', $id)->get('lab_config');
        return $query->row_array();
    }

    public function addPatientOperation($data)
    {
        $this->db->insert('patient_operation', $data);
        return $this->db->insert_id();
        # code...
    }

    // public function getPatientOPD($id=0)
    // {
    //     $query = $this->db->where('patient_id',$id)->get('patient_operation');
    //     $result = $query->row_array();

    //     $database = "operation";
    //     if($result['op_type']==1)
    //     {
    //         $database = "operation";
    //     }
    //     else if($result['op_type'] == 2){
    //         $database ="medical";
    //     }
    //     else if($result['op_type'] == 3){
    //         $database = "children_medical";
    //     }
    //     else if($result['op_type'] == 4){
    //         $database = "giving_births";
    //     }
    //     $query1 = $this->db->select($database.'.*')->where('id',$result['op_id'])->get($database);
    //     return $query1->row_array();
    // }

    public function getPatientOPD($id = 0)
    {
        $query = $this->db->select('opd_details.*')->where('patient_id', $id)->get('opd_details');
        return $query->row_array();

    }

    public function getPatientOPD2($id = 0, $round)
    {
        $query = $this->db->select('opd_details.*')->where('patient_id', $id)->where('round', $round)->get('opd_details');
        return $query->row_array();

    }
    public function getpatientDetail($id = 0)
    {
        $query = $this->db->select('patient_operation.*')->where('patient_id', $id)->get('patient_operation');
        return $query->row_array();
    }

    public function add_examination($data)
    {
        $this->db->insert('examination', $data);
        return $this->db->insert_id();
    }

    public function getExamination($id = 0)
    {
        $query = $this->db->where('patient_id', $id)->order_by('id', 'desc')->get('examination');
        return $query->row_array();
    }

    public function getPatientNo($id = 0)
    {
        // $query = $this->db->select('patients.*')->where('id',$id)->get('patients');
        // return $query->row_array();
        // my code
        $this->db->select('patients.*,opd_details.round as round');
        $this->db->join('opd_details', 'patients.id = opd_details.patient_id', "inner");
        $this->db->where('patients.id', $id);
        $this->db->where('opd_details.patient_id', $id);
        $this->db->order_by('opd_details.id', 'DESC');
        $query = $this->db->get('patients');
        return $query->row_array();

    }

    public function storePatientNursing($data)
    {
        $this->db->insert('patient_nursing', $data);
        return $this->db->insert_id();
    }

    public function getPtientIpd()
    {

        $query = $this->db->select('patients.*')->where('is_warded', 1)->order_by('id', 'desc')->get('patients');
        return $query->result_array();
    }
    //add to ward
    public function addPatienttoWard($addtowarddata)
    {
        $this->db->where('id', $addtowarddata['id'])->update('patients', $addtowarddata);
    }
    public function add_info_model($add_info)
    {
        $this->db->where('id', $add_info['id'])->update('patients', $add_info);
    }
    public function storeIpdPatient($data)
    {
        $this->db->insert('ipd_details', $data);
    }

    public function updateIPDPatient($data)
    {
        $this->db->where('id', $data['id'])->update('patients', $data);
        # code...
    }

    public function getIPDPatientRecord($id = 0)
    {
        $query = $this->db->where('id', $id)->get('patients');
        return $query->row_array();
        # code...
    }

    public function storePatientNICU($data)
    {
        $this->db->insert('patient_nicu', $data);
    }

    public function getPatientNICU()
    {
        $query = $this->db->select('patient_nicu.*')->get('patient_nicu');
        return $query->result_array();
    }

    public function addLabUlt($data)
    {
        $this->db->insert('lab_ultra_sound', $data);
        # code...
    }
    public function addForcep($data)
    {
        $this->db->insert('lab_ultra_sound', $data);
        # code...
    }

    public function addLabECG($data)
    {
        $this->db->insert('lab_ecg', $data);
        # code...
    }

    public function addLabXray($data)
    {
        $this->db->insert('lab_xray', $data);
        # code...
    }

    public function getNICURecord($id)
    {
        $query = $this->db->select('lab_lab.*')->where('id', $id)->order_by('id', 'desc')->get('lab_lab');
        return $query->row_array();
        # code...
    }

    public function getExaminations($id = null)
    {
        if (!empty($id)) {
            $query = $this->db->where("id", $id)->get('lab_lab');
            return $query->row_array();
        } else {
            $query = $this->db->get("lab_lab");
            return $query->result_array();
        }
    }
    public function updateNICU($data)
    {
        $this->db->where('id', $data['id'])->update('patient_nicu', $data);
        # code...
    }

    public function getLabConf()
    {
        $query = $this->db->select('lab_config.*')->get('lab_config');
        return $query->result_array();
    }
    public function getYears()
    {
        $query = $this->db->select('year')->group_by('year')->get('lab_lab');
        return $query->result_array();
    }
    
    public function getLabConf1()
    {
        $query = $this->db->select('lab_config.*')->get('lab_config');
        return $query->result_array();
    }

    public function getLabConfRecord($id = 0)
    {
        $query = $this->db->select('lab_config.*')->where('id', $id)->order_by('id', 'desc')->get('lab_config');
        return $query->row_array();
        # code...
    }

    public function getPatientRecord($id = 0)
    {
        $query = $this->db->select('patients.*')->where('id', $id)->get('patients');
        return $query->row_array();
        # code...
    }

    // public function addLabLab($data)
    // {
    //     $this->db->insert('lab_lab',$data);
    // }
    public function addLabLab($lab_array_data)
    {
        if (isset($lab_array_data['id'])) {
            $this->db->where('id', $lab_array_data['id']);
            $this->db->update('lab_lab', $lab_array_data);
        } else {
            $this->db->insert('lab_lab', $lab_array_data);
            return $this->db->insert_id();
        }
    }
    public function getLabLab($id = 0)
    {
        $query = $this->db->select('lab_lab.*')->where('id', $id)->get('lab_lab');
        return $query->row_array();
    }

    public function get_Dynamic_lab_for_print($id = 0, $round = 0, $table)
    {
        $q = $this->db->select('lab_time')->where('unique_id', $id)->where('round', $round)->order_by('id', 'DESC')->limit(1)->get($table);
        $res = $q->row();
        $lab_time = $res->lab_time;
        $this->db->select($table . '.*');
        $this->db->where('lab_time', $lab_time);
        $this->db->where('unique_id', $id);
        $this->db->where('round', $round);
        $query = $this->db->get($table);
        if ($query)
            return $query->result_array();

    }

    public function addCons($data)
    {
        $this->db->insert('consultant_register', $data);
    }

    public function getPatientTestPrice($id = null)
    {
        $query = $this->db->select('patients.*')->where('id', $id)->get('patients');
        return $query->row_array();
    }

    public function getPatientLabLabIncome($id = 0)
    {
        $query = $this->db->select('lab_lab.*')->where('patient_id', $id)->get('lab_lab');
        return $query->result_array();
    }

    public function getPatientLabECGIncome($id = 0)
    {
        $query = $this->db->select('lab_ecg.*')->where('patient_id', $id)->get('lab_ecg');
        return $query->result_array();
    }

    public function getPatientLabUltIncome($id = 0)
    {
        $query = $this->db->select('lab_ultra_sound.*')->where('patient_id', $id)->get('lab_ultra_sound');
        return $query->result_array();
    }

    public function getPatientLabXrayIncome($id = 0)
    {
        $query = $this->db->select('lab_xray.*')->where('patient_id', $id)->get('lab_xray');
        return $query->result_array();
    }

    public function getPatientWardIncome($id = 0)
    {
        $query = $this->db->select('patient_ward.*')->where('patient_id', $id)->get('patient_ward');
        return $query->result_array();
    }

    public function geNursingforPrint($id = 0)
    {
        $query = $this->db->select('patient_nursing.*')->where('patient_id', $id)->get('patient_nursing');
        return $query->result_array();
    }

    //id is patient id
    public function getLabEcgByPatientId($id = 0)
    {
        $query = $this->db->select('round, lab_round')->where('patient_id', $id)->order_by('round', 'desc')->limit(1)->get('opd_details');
        $round = $query->row();
        $this->db->select('lab_ecg.*');
        $this->db->where('patient_id', $id);
        $this->db->where('round', $round->round);
        $this->db->where('lab_round', $round->lab_round);
        $query = $this->db->get('lab_ecg');
        if ($query)
            return $query->result_array();
    }

    public function getLabXrayByPatientId($id = 0)
    {
        $query = $this->db->select('round, lab_round')->where('patient_id', $id)->order_by('round', 'desc')->limit(1)->get('opd_details');
        $round = $query->row();
        $this->db->select('lab_xray.*');
        $this->db->where('patient_id', $id);
        $this->db->where('round', $round->round);
        $this->db->where('lab_round', $round->lab_round);
        $query = $this->db->get('lab_xray');
        if ($query)
            return $query->result_array();

    }

    public function getLabUltByPatientId($id = 0)
    {
        $query = $this->db->select('round, lab_round')->where('patient_id', $id)->order_by('round', 'desc')->limit(1)->get('opd_details');
        $round = $query->row();
        $this->db->select('lab_ultra_sound.*');
        $this->db->where('patient_id', $id);
        $this->db->where('round', $round->round);
        $this->db->where('lab_round', $round->lab_round);
        $query = $this->db->get('lab_ultra_sound');
        if ($query)
            return $query->result_array();
    }

    public function getLabLabByPatientId($id = 0)
    {
        $this->db->select('lab_lab.*');
        $this->db->where('patient_id', $id);
        $query = $this->db->get('lab_lab');
        if ($query)
            return $query->result_array();
    }

    public function getLabLabByPatientIdForEachPrint($id = 0)
    {
        $this->db->select('lab_lab.*');
        $this->db->where('patient_id', $id);
        $this->db->where('is_printed', 0);
        $query = $this->db->get('lab_lab');
        if ($query)
            return $query->result_array();

        // $this->db->select('patients.*,opd_details.id,opd_details.is_printed,opd_details.amount,opd_details.appointment_date,opd_details.casualty,opd_details.symptoms,opd_details.bp,opd_details.payment_mode, lab_lab.duplicate,lab_lab.fees,lab_lab.test_name,lab_lab.unique_id,lab_lab.year,lab_lab.month,lab_lab.day')
        //         ->join('opd_details', 'opd_details.patient_id = patients.id', 'INNER')
        //         ->join('lab_lab', 'lab_lab.patient_id = patients.id', 'INNER')
        //         ->where('opd_details.is_printed', 0)
        //         ->where('lab_lab.is_printed', 0)
        //         ->where('patients.id', $id)
        //         ->from('patients');
        // $query = $this->db->get(); 
        // return $query->result_array();
    }
    public function print_each_round($id = 0)
    {
        $this->db->select('patients.*');
        $this->db->where('round', $id);
        $query = $this->db->get('patients');
        if ($query)
            return $query->result_array();
    }
    public function getPatientOperation($id = 0)
    {
        $query = $this->db->select('operation_theatre.*')->where('patient_id', $id)->where('id', 3)->get('operation_theatre');
        if ($query) {
            return $query->row_array();
        }
    }

    public function getPatientWardCost($id = 0, $round)
    {
        $query = $this->db->select('patient_ward.*')->where('patient_id', $id)->where('round', $round)->order_by('id', 'ASC')->limit('1')->get('patient_ward');
        return $query->row_array();
    }

    public function storePatientWard($data, $pid, $round)
    {
        // $this->db->insert('patient_ward',$data);
        $this->db->where('patient_id', $pid);
        $this->db->where('round', $round);
        $this->db->update('patient_ward', $data);
    }
    public function addEntranceFeeModel($data)
    {
        $this->db->insert('patient_ward', $data);
    }
    public function getthisPatientWard($id = 0)
    {
        $query = $this->db->select('patient_ward.*')->where('patient_id', $id)->order_by('id', 'DESC')->limit(1)->get('patient_ward');
        return $query->row_array();
    }
    public function getPatientWard()
    {
        $query = $this->db->select('patient_ward.*')->get('patient_ward');
        return $query->result_array();
    }
    public function getNursingCharges($id = 0)
    {
        $query = $this->db->select('patient_nursing.*')->where('patient_id', $id)->order_by('round', 'DESC')->get('patient_nursing');
        return $query->result_array();
    }
    public function getNursingID($id = 0)
    {
        $query = $this->db->select('round')->where('patient_id', $id)->limit(1)->get('patient_nursing');
        return $query->result_array();
    }
    public function getNursingServinces($id = 0)
    {
        $query = $this->db->select('patient_ward.*')->where('patient_id', $id)->get('patient_ward');
        return $query->result_array();
    }
    public function getOperationList($id = 0)
    {
        $query = $this->db->select('operation_theatre.*')->where('patient_id', $id)->get('operation_theatre');
        return $query->result_array();
    }
    public function getIPDamount($id = null)
    {
        $query = $this->db->select('ipd_details.*')->where('id', $id)->get('ipd_details');
        return $query->row_array();
    }
    public function getNursingChargesLast($id = 0)
    {
        $query = $this->db->select('patient_nursing.*')->where('patient_id', $id)->get('patient_nursing');
        return $query->result_array();
    }

    public function getOperationListLast($id = 0, $round = 0)
    {
        $query = $this->db->select('operation_theatre.*')->where('patient_id', $id)->where('round', $round)->order_by('round', DESC)->limit(2)->get('operation_theatre');
        return $query->result_array();
    }
    public function getNursingLast($id = 0, $round = 0)
    {
        $query = $this->db->select('patient_nursing.*')->where('patient_id', $id)->where('round', $round)->order_by('round', DESC)->limit(1)->get('patient_nursing');
        return $query->result_array();
    }

    //alireza
    public function updateLabRound($table, $uid)
    {
        //first get last round 
        $query = $this->db->select('round, lab_round')->where('patient_id', $uid)->order_by('round', 'desc')->limit(1)->get($table);
        $result = $query->row();
        $added_round = $result->lab_round + 1;


        //then update round
        $this->db->update($table, array('lab_round' => $added_round), array('patient_id' => $uid, 'round' => $result->round));
        return $result;
        // die();
        // $query = $this->db->select('patient_nicu.*')->get('patient_nicu');
        // return $query->result_array();
    }

    public function getLastRound($table, $id)
    {

        $query = $this->db->select('round')->where('patient_id', $id)->order_by('round', 'desc')->limit(1)->get($table);
        $result = $query->row();
        // print_r($result);
        return $result->round;
    }
    function getCurDiscount($pid, $round)
    {
        $query = $this->db->query("SELECT total_discount as discount from opd_details where patient_id='$pid' AND `round`='$round' ");
        $result = $query->row();
        return $result->discount;

    }
    function insertDiscount($pid, $round, $td)
    {
        $query = $this->db->query("UPDATE opd_details set total_discount='$td' where patient_id='$pid' AND `round`='$round' ");
    }
    function update_opd_hmis($pid, $round, $opd_data)
    {
        $this->db->where('patient_id', $pid);
        $this->db->where('round', $round);
        $this->db->update('opd_details', $opd_data);
    }
    function get_opd_details_diagnosis($pid)
    {
        $query = $this->db->select('*')->where('patient_id', $pid)->get('opd_details');
        return $query->result_array();
    }
}

?>