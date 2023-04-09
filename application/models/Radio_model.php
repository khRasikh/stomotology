<?php
class Radio_model extends CI_Model {

    public function add($radiology) {
        $this->db->insert('lab_config', $radiology);
    }

    // public function searchFullText() {
    //     $this->db->select('radio.*,lab.id as category_id,lab.lab_name,charges.standard_charge');
    //     $this->db->join('lab', 'radio.radiology_category_id = lab.id', 'left');
    //     $this->db->join('charges', 'radio.charge_id = charges.id', 'left');
    //     $this->db->where('`radio`.`radiology_category_id`=`lab`.`id`');
    //     $this->db->order_by('lab.id', 'desc');
    //     $query = $this->db->get('radio');
    //     return $query->result_array();
    // }
    public function searchFullText() {
        $this->db->select('nursing_forcep.*')->order_by('id', 'desc')->get('nursing_forcep');
    }

    public function getDetails($id) {
        $this->db->select('radio.*,lab.id as category_id,lab.lab_name, charges.id as charge_id, charges.code, charges.charge_category, charges.standard_charge, charges.description');
        $this->db->join('lab', 'radio.radiology_category_id = lab.id', 'left');
        $this->db->join('charges', 'radio.charge_id = charges.id', 'left');
        $this->db->where('radio.id', $id);
        $query = $this->db->get('radio');
        return $query->row_array();
    }

    public function update($radiology) {
        $query = $this->db->where('id', $radiology['id'])
                ->update('radio', $radiology);
    }

    public function delete($id) {
        $this->db->where("id", $id)->delete('radio');
    }

    public function getRadiology($id = null) {
        if (!empty($id)) {
            $this->db->where("radio.id", $id);
        }
        $query = $this->db->select('radio.*,charges.charge_category,charges.code,charges.standard_charge')->join('charges', 'radio.charge_id = charges.id')->order_by('radio.id', 'desc')->get('radio');
        if (!empty($id)) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function testReportBatch($report_batch) {
        $this->db->insert('radiology_report', $report_batch);
    }

    public function getRadiologyReport($id) {
        $query = $this->db->select('radiology_report.*,radio.id as pid,radio.charge_id as cid,staff.name,staff.surname,charges.charge_category,charges.code,charges.standard_charge')
                ->join('radio', 'radiology_report.radiology_id = radio.id')
                ->join('charges', 'radio.charge_id = charges.id')
                ->join('staff', 'staff.id = radiology_report.consultant_doctor', "inner")
                ->where("radiology_report.id", $id)
                ->get('radiology_report');
        return $query->row_array();
    }

    public function updateTestReport($report_batch) {
        $this->db->where('id', $report_batch['id'])->update('radiology_report', $report_batch);
    }

    public function getTestReportBatch($radiology_id) {
        $this->db->select('radiology_report.*, radio.id as rid,radio.test_name, radio.short_name,staff.name,staff.surname,charges.id as cid,charges.charge_category,charges.standard_charge');
        $this->db->join('radio', 'radiology_report.radiology_id = radio.id', 'inner');
        $this->db->join('staff', 'staff.id = radiology_report.consultant_doctor', "inner");
        $this->db->join('charges', 'charges.id = radio.charge_id');
        $this->db->order_by('radio.id', 'desc');
        $query = $this->db->get('radiology_report');
        return $query->result();
    }

    public function deleteTestReport($id) {
        $query = $this->db->where('id', $id)
                ->delete('radiology_report');
    }

    public function getChargeCategory() {
        $query = $this->db->select('charge_categories.*')
                ->where('charge_type', 'investigations')
                ->get('charge_categories');
        return $query->result_array();
    }

    public function getDiognostic(){
        $query = $this->db->select('diognostic.*')->get('diognostic');
        return $query->result_array();
    }

    public function getLabUltra()
    {
        // $query = $this->db->select('lab_ultra_sound.*')->order_by('id','desc')->get('lab_ultra_sound');
        // return $query->result_array();
        
         $this->db->select("lab_ultra_sound.*");
        $this->db->order_by("id","desc");
        $this->db->group_by("unique_id");
        return $this->db->get("lab_ultra_sound")->result_array();
       
        # code...
    }

    public function addLabUlt($data)
    {
        $this->db->insert('lab_ultra_sound',$data);
        # code...
    }
    public function addForcep($data)
    {
        $this->db->insert('nursing_forcep',$data);
        # code...
    }

    public function getPatientRecord($id=0)
    {
        $query = $this->db->select('lab_ultra_sound.*')->where('id',$id)->order_by('id','desc')->get('lab_ultra_sound');
        return $query->row_array();
        # code...
    }

    public function updatePatientUlt($data)
    {
        $query = $this->db->where('id', $data['id'])
                ->update('lab_ultra_sound', $data);
        # code...
    }

    public function getLabECG()
    {
        // $query = $this->db->select('lab_ecg.*')->order_by('id','desc')->get('lab_ecg');
        // return $query->result_array();
        $this->db->select("lab_ecg.*");
        $this->db->order_by("id","desc");
        $this->db->group_by("unique_id");
        return $this->db->get("lab_ecg")->result_array();
        # code...
    }

    public function addLabECG($data)
    {
        $this->db->insert('lab_ecg',$data);
        # code...
    }

    public function getPatientRecordECG($id=0)
    {
        $query = $this->db->select('lab_ecg.*')->where('id',$id)->order_by('id','desc')->get('lab_ecg');
        return $query->row_array();
        # code...
    }

    public function updatePatientECG($data)
    {
        $query = $this->db->where('id', $data['id'])
                ->update('lab_ecg', $data);
        # code...
    }

    public function addLabConf($data)
    {
        $this->db->insert('lab_config',$data);
    }

    public function getLabConfRecord($id=0)
    {
        $query = $this->db->select('lab_config.*')->where('id',$id)->order_by('id','desc')->get('lab_config');
        return $query->row_array();
        # code...
    }

    public function updateLabConf($data)
    {
        $query = $this->db->where('id', $data['id'])
                ->update('lab_config', $data);
    }

    public function getLab()
    {

        $this->db->select("lab_lab.*");
        $this->db->order_by("id","desc");
        $this->db->group_by("unique_id");
        return $this->db->get("lab_lab")->result_array();
    }
    
     public function get_x_ray()
    {
        // $query = $this->db->select('lab_xray.*')->
        // order_by('id','desc')->get('lab_xray');
        // return $query->result_array();
        $this->db->select("lab_xray.*");
        $this->db->order_by("id","desc");
        $this->db->group_by("unique_id");
        return $this->db->get("lab_xray")->result_array();
        # code...
    }
    public function getLabConf()
    {
        $query = $this->db->select('lab_config.*')->
        order_by('id','desc')->get('lab_config');
        return $query->result_array();
        # code...
    }

    public function getLabExra()
    {
        $query = $this->db->select('lab_xray.*')->order_by('id','desc')->get('lab_xray');
        return $query->result_array();
        # code...
    }

    public function getPatientRecordXray($id)
    {
        $query = $this->db->select('patients.*')->where('id',$id)->order_by('id','desc')->get('patients');
        return $query->row_array();
        # code...
    }

    public function bringLab($id)
    {
        $query = $this->db->select('lab_lab.*')->where('id',$id)->order_by('id','desc')->get('lab_lab');
        return $query->row_array();
        # code...
    }
   public function bring_x_ray($id)
    {
        $query = $this->db->select('lab_xray.*')->where('id',$id)->order_by('id','desc')->get('lab_xray');
        return $query->row_array();
        # code...
    }
    public function bring_ultrasound_m($id)
    {
        $query = $this->db->select('lab_ultra_sound.*')->where('id',$id)->order_by('id','desc')->get('lab_ultra_sound');
        return $query->row_array();
        # code...
    }
    public function updatePatientXray($data)
    {
        $query = $this->db->where('id', $data['id'])
                ->update('lab_xray', $data);
    }

    public function updateLab($data)
    {
        $query = $this->db->where('id', $data['id'])
                ->update('lab_lab', $data);
    }

    // My code
    public function updateLab_Lab_test($data,$id)
    {
        $query = $this->db->where('id', $id)
                ->update('lab_lab', $data);
    }
      public function updateLab_ult_test($data,$id)
    {
        $query = $this->db->where('id', $id)
                ->update('lab_ultra_sound', $data);
    }
    public function updateLab_xray_test($data,$id)
    {
        $query = $this->db->where('id', $id)
                ->update('lab_xray', $data);
    }
    public function updateLab_ecg_test($data,$id)
    {
        $query = $this->db->where('id', $id)
                ->update('lab_ecg', $data);
    }
    // My code
    function updateLab_Lab_extraInfo($data,$patient_id,$round)
    {
        $this->db->where('patient_id',$patient_id);
        $this->db->where('round',$round);
		if($this->db->update('lab_lab',$data))
		   return true;
		else
		   return false;
    }

    function updateLab_ult_extraInfo($data,$patient_id,$round)
        {
            $this->db->where('patient_id',$patient_id);
            $this->db->where('round',$round);
    		if($this->db->update('lab_ultra_sound',$data))
    		   return true;
    		else
    		   return false;
        }

    function updateLab_xray_extraInfo($data,$patient_id,$round)
    {
        $this->db->where('patient_id',$patient_id);
        $this->db->where('round',$round);
		if($this->db->update('lab_xray',$data))
		   return true;
		else
		   return false;
    }
    function updateLab_ecg_extraInfo($data,$patient_id,$round)
    {
        $this->db->where('patient_id',$patient_id);
        $this->db->where('round',$round);
		if($this->db->update('lab_ecg',$data))
		   return true;
		else
		   return false;
    }
    
    public function addLabXray($data)
    {
        $this->db->insert('lab_xray',$data);
        # code...
    }

    public function updateLabUlt($data)
    {
        $query = $this->db->where('id', $data['id'])
                ->update('lab_ultra_sound', $data);
    }

    public function bring_ecg($id)
    {
        $query = $this->db->select('lab_ecg.*')->where('id',$id)->order_by('id','desc')->get('lab_ecg');
        return $query->row_array();
        # code...
    }

    public function getWard($id=0)
    {
        $query = $this->db->select('patient_ward.*')->where('patient_id',$id)->get('patient_ward');
        return $query->row_array();
    }
}
?>