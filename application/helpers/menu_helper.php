<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('active_link')) {

    function activate_menu($controller, $action) {
        $CI = get_instance();
        $method = $CI->router->fetch_method();
        $class = $CI->router->fetch_class();
        return ($method == $action && $controller == $class) ? 'active' : '';
    }

    function set_Topmenu($top_menu_name) {
        $CI = get_instance();
        $session_top_menu = $CI->session->userdata('top_menu');
        if ($session_top_menu == $top_menu_name) {
            return 'active';
        }
        return "";
    }

    function set_Submenu($sub_menu_name) {
        $CI = get_instance();
        $session_sub_menu = $CI->session->userdata('sub_menu');
        if ($session_sub_menu == $sub_menu_name) {
            return 'active';
        }
        return "";
    }

    function set_Innermenu($inner_menu_name) {
        $CI = get_instance();
        $session_sub_menu = $CI->session->userdata('inner_menu');
        if ($session_sub_menu == $inner_menu_name) {
            return 'active';
        }
        return "";
    }

    function set_sidebar_Submenu($sub_sidebar_menu_name) {
        $CI = get_instance();
        $session_sub_menu = $CI->session->userdata('sub_sidebar_menu');
        if ($session_sub_menu == $sub_sidebar_menu_name) {
            return 'active';
        }
        return "";
    }

}

function access_denied() {
    redirect('admin/unauthorized');
}

function update_config_installed() {
    $CI = & get_instance();
    $config_path = APPPATH . 'config/config.php';
    $CI->load->helper('file');
    @chmod($config_path, FILE_WRITE_MODE);
    $config_file = read_file($config_path);
    $config_file = trim($config_file);
    $config_file = str_replace("\$config['installed'] = false;", "\$config['installed'] = true;", $config_file);
    $config_file = str_replace("\$config['base_url'] = '';", "\$config['base_url'] = '" . site_url() . "';", $config_file);
    if (!$fp = fopen($config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
        return FALSE;
    }
    flock($fp, LOCK_EX);
    fwrite($fp, $config_file, strlen($config_file));
    flock($fp, LOCK_UN);
    fclose($fp);
    @chmod($config_path, FILE_READ_MODE);
    return TRUE;
}

function update_autoload_installed() {
    $CI = & get_instance();
    $autoload_path = APPPATH . 'config/autoload.php';
    $CI->load->helper('file');
    @chmod($autoload_path, FILE_WRITE_MODE);
    $autoload_file = read_file($autoload_path);
    $autoload_file = trim($autoload_file);
    $autoload_file = str_replace("\$autoload['model'] = array()", "\$autoload['model'] = array('staff_model', 'setting_model', 'language_model', 'admin_model', 'smsconfig_model', 'langpharses_model', 'expense_model', 'expensehead_model', 'content_model', 'user_model', 'notification_model', 'paymentsetting_model', 'payroll_model', 'department_model', 'designation_model', 'emailconfig_model', 'income_model', 'incomehead_model', 'itemcategory_model', 'item_model', 'messages_model', 'itemstore_model', 'itemsupplier_model', 'notificationsetting_model', 'itemstock_model', 'itemissue_model', 'userlog_model', 'cms_program_model', 'cms_menu_model', 'cms_media_model', 'cms_page_model', 'cms_menuitems_model', 'cms_page_content_model', 'role_model', 'calendar_model', 'userpermission_model', 'staffroles_model', 'staffattendancemodel', 'rolepermission_model', 'timeline_model', 'Module_model', 'patient_model', 'Floor_Model', 'Bedtype_Model', 'Bed_Model', 'prescription_model', 'operationtheatre_model', 'pharmacy_model', 'medicine_category_model', 'lab_model', 'pathology_category_model', 'pathology_model', 'blooddonor_model', 'blood_donorcycle_model', 'bloodissue_model', 'bloodbankstatus_model', 'charge_category_model', 'charge_model', 'Organisation_model', 'Tpa_model', 'vehicle_model', 'appointment_model', 'radio_model', 'floor_model', 'bed_model', 'bedgroup_model')", $autoload_file);
    $autoload_file = str_replace("\$autoload['libraries'] = array('database', 'session', 'form_validation')", "\$autoload['libraries'] = array('database', 'email', 'session', 'form_validation', 'upload', 'pagination', 'Customlib', 'Role', 'Smsgateway', 'QDMailer', 'Adler32', 'Aes')", $autoload_file);
    if (!$fp = fopen($autoload_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
        return FALSE;
    }
    flock($fp, LOCK_EX);
    fwrite($fp, $autoload_file, strlen($autoload_file));
    flock($fp, LOCK_UN);
    fclose($fp);
    @chmod($config_path, FILE_READ_MODE);
    return TRUE;
}

function delete_dir($dirPath) {
    if (!is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            delete_dir($file);
        } else {
            unlink($file);
        }
    }
    if (rmdir($dirPath)) {
        return true;
    }
    return false;
}

function admin_url($url = '') {
    if ($url == '') {
        return site_url() . 'site/login';
    } else {
        return site_url() . 'site/login';
    }
}
function show_test_name($table_name,$pid)
{
  $CI = & get_instance();
  $query = $CI->db->query("SELECT operation_type from $table_name where unique_id='$pid' ");
  $result = $query->row();
  if(isset($result))
  {
    echo $result->operation_type;
  }
}
function show_test_name2($table_name,$pid,$lround)
{
  $CI = & get_instance();
  $query = $CI->db->query("SELECT operation_type from $table_name where unique_id='$pid' AND `round`='$lround'");
  $result = $query->row();
  if(isset($result))
  {
    echo $result->operation_type;
  }
}
function show_test_fee($table_name,$pid)
{
  $CI = & get_instance();
  $query = $CI->db->query("SELECT fees from $table_name where unique_id='$pid'");
  $result = $query->row();
  if(isset($result))
  {
    echo $result->fees;
  }
}
function show_test_fee2($table_name,$pid,$lround)
{
  $CI = & get_instance();
  $query = $CI->db->query("SELECT fees from $table_name where unique_id='$pid' AND `round`='$lround'");
  $result = $query->row();
  if(isset($result))
  {
    echo $result->fees;
  }
}
 
function show_test_date($table_name,$pid)
{
    $CI = & get_instance();
  $query = $CI->db->query("SELECT `date` as dates from $table_name where unique_id='$pid'");
  $result = $query->row();
  if(isset($result))
  {
    echo $result->dates;
  }
}
function show_test_date2($table_name,$pid,$lround)
{
    $CI = & get_instance();
  $query = $CI->db->query("SELECT `date` as dates from $table_name where unique_id='$pid' AND `round`='$lround'");
  $result = $query->row();
  if(isset($result))
  {
    echo $result->dates;
  }
}
function show_examination_result($table,$puid,$last_round)
{
  $CI = & get_instance();
  $query = $CI->db->query("SELECT * from $table where unique_id='$puid' AND `round`='$last_round'");
  $result = $query->result_array();
  return $result;
}
function show_lab_ultra_data($table,$puid)
{
  $CI = & get_instance();
  $query = $CI->db->query("SELECT operation_type from $table where unique_id='$puid' ");
  $result = $query->result_array();
  return $result;
}
function show_lab_ecg_data($table,$puid)
{
  $CI = & get_instance();
  $query = $CI->db->query("SELECT operation_type from $table where unique_id='$puid' ");
  $result = $query->result_array();
  return $result;
}
function show_lab_xray_data($table,$puid)
{
  $CI = & get_instance();
  $query = $CI->db->query("SELECT   operation_type from $table where unique_id='$puid' ");
  $result = $query->result_array();
  return $result;
}
function show_patient_total_visit($pid)
{
    $CI = & get_instance();
    $query = $CI->db->query("SELECT count(opd_details.patient_id) as total_visit from opd_details where patient_id='$pid'");
    $result = $query->row();
    if(isset($result))
    {
      echo $result->total_visit;
    }
}
function show_all_revisited_list($pid)
{
    $CI = & get_instance();
    $query = $CI->db->query("SELECT id as opd_details_id,appointment_date from opd_details where patient_id='$pid'");
    $result = $query->result_array();
    return $result;
}
function get_lab_data($table,$pid)
{
    $last_round =0;
    $CI = & get_instance();
    $q = $CI->db->query("SELECT `round` from opd_details where patient_id='$pid' order by id desc limit 1");
    $r = $q->row();
    if(isset($r)){ $last_round = $r->round; }
    $query = $CI->db->query("SELECT operation_type,fees,`date` as dates from $table where patient_id='$pid' AND `round`='$last_round'");
    $result = $query->result_array();
    return $result;
}
function show_last_round($table_name,$pid)
{   
 
    $CI = & get_instance();
    $q = $CI->db->query("SELECT `round` as rounds from $table_name where patient_id='$pid' order by id DESC limit 1");
    $r = $q->row();
    if(isset($r)){ return $r->rounds; }
}
function show_lab_lab_ex_information($table_name,$pid,$last_lab_round)
{
    $CI = & get_instance();
    $q = $CI->db->query("SELECT *  from $table_name where patient_id='$pid' AND `round`='$last_lab_round'");
    $result = $q->result_array();
    return $result;
}
function show_last_round_exams($table_name,$pid,$lround)
{
    $CI = & get_instance();
    $query = $CI->db->query("SELECT *  from $table_name where patient_id='$pid' and `round`='$lround'");
    $result = $query->result_array();
    return $result;
}
function is_new_or_updated($table,$pid,$lround)
{
    $CI = & get_instance();
    $q = $CI->db->query("SELECT updated  from $table where patient_id='$pid' and `round`='$lround'");
    $r = $q->row();
    if(isset($r)){ return $r->updated; }
}
// alireza 
function get_the_examination($table_name,$pid)
{
    $CI = & get_instance();
    $query = $CI->db->query("SELECT *  from $table_name where patient_id='$pid' order by id desc");
                             
    $result = $query->result_array();
    return $result;
}
 
function get_count_each_lab($table_name,$pid, $isPrint=0)
{
  $CI = & get_instance();
    $query = $CI->db->query("SELECT SUM(duplicate) as countset,test_name,SUM(fees) as fee,patient_id,day,month,year,add_description 
      from $table_name where patient_id='$pid' && is_printed=$isPrint group by test_name");
    $result = $query->result_array();
    return $result;
}

function get_last_amount($pid)
{
    $CI = & get_instance();
    // $query = $CI->db->query("SELECT amount from opd_details where patient_id='$pid' order by id desc limit 1");
    $query = $CI->db->query("SELECT sum(amount) from opd_details where patient_id='$pid'");
    return $query->result_array()[0]['sum(amount)'];
}
function get_total_should_pay($pid)
{
    $CI = & get_instance();
    // $query = $CI->db->query("SELECT id from lab_lab where patient_id='$pid' order by id desc limit 1");
    $query = $CI->db->query("SELECT sum(fees) from lab_lab where patient_id='$pid'");
    return $query->result_array()[0]['sum(fees)'];
}
function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
  }
  function show_discharged_date($pid,$round)
  {
    $CI = & get_instance();
    $q = $CI->db->query("SELECT exit_date from patient_ward where patient_id='$pid' and `round`='$round'");
    $r = $q->row();
    if(isset($r)){ echo $r->exit_date; }
  }
  function show_data($column,$table_name,$pid,$round)
  {
    $CI = & get_instance();
    $query = $CI->db->query("SELECT $column from $table_name where patient_id='$pid' AND `round`='$round' ");       
    $result = $query->row();
    if(isset($result))
    { echo $result->$column;}
  }
  function show_data2($column,$table_name,$pid,$round)
  {
    $CI = & get_instance();
    $query = $CI->db->query("SELECT $column from $table_name where patient_id='$pid' AND `round`='$round' ");       
    $result = $query->row();
    if(isset($result))
    { return $result->$column;}
  }
  function show_data_sum($table_name,$pid,$round)
  {
    $CI = & get_instance();
    $query = $CI->db->query("SELECT sum(apply_charge) as charge from $table_name where patient_id='$pid' AND `round`='$round' ");       
    $result = $query->row();
    if(isset($result))
    { return $result->charge;}
  }


?>