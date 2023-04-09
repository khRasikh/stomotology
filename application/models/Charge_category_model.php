<?php
 
class Charge_category_model extends CI_model {

    public function valid_charge_category($str) {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        if (!isset($id)) {
            $id = 0;
        }
        if ($this->check_category_exists($id, $name)) {
            $this->form_validation->set_message('check_exists', 'Record already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getChargeCategory($id = null) {
        if (!empty($id)) {
            $query = $this->db->where("id", $id)->get('lab_lab');
            return $query->row_array();
        } else {
            $query = $this->db->where('year', 1400)->get("lab_lab");
            return $query->result_array();
        }
    }

    public function check_category_exists($id, $name) {
        if ($id != 0) {
            $data = array('id != ' => $id, 'patient_name' => $name);
            $query = $this->db->where($data)->get('lab_lab');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $this->db->where('patient_name', $name);
            $query = $this->db->get('lab_lab');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function addChargeCategory($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('lab_lab', $data);
        } else {
            $this->db->insert('lab_lab', $data);
            return $this->db->insert_id();
        } 
    }

    public function getall() {
        $this->datatables->select('id,name,description,charge_type');
        $this->datatables->from('charge_categories');
        $this->datatables->add_column('view', '<a href="' . site_url('admin/chargecategory/edit/$1') . '" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit"> <i class="fa fa-pencil"></i></a><a href="' . site_url('admin/chargecategory/delete/$1') . '" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Delete">
                                                        <i class="fa fa-remove"></i>
                                                    </a>', 'id');
        return $this->datatables->generate();
    }

    public function delete($id) {
        $this->db->where("id", $id)->delete("lab_lab");
    }

}
