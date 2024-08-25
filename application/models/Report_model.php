<?php
class Report_model extends CI_Model {

    public function getReport($select = '', $join = array(), $table_name, $additional_where = array()) {
        if (empty($additional_where)) {
            $additional_where = array(" 1 = 1");
        }

        if (!empty($join)) {
            $query = "select " . $select . " from " . $table_name . " " . implode(" ", $join) . " where " . implode("and ", $additional_where);
        } else {
            $query = "select " . $select . " from " . $table_name . " where" . implode("and ", $additional_where);
        }

        $res = $this->db->query($query);
        return $res->result_array();
    }

public function countSearchReport($select, $join = array(), $table_name, $search_type, $search_table, $search_column, $additional_where = array()){
    // Initialize the where array for storing filtering conditions
    $where = array();

    // Handle all search_type cases (same logic as in searchReport)
    if ($search_type == 'period') {
        $from_date = $this->input->post('date_from');
        $to_date = $this->input->post('date_to');
        
        $date_from = date("Y-m-d", $this->customlib->datetostrtotime($from_date));
        $date_to = date("Y-m-d 23:59:59.993", $this->customlib->datetostrtotime($to_date));
        $where[] = "$search_table.$search_column >= '$date_from'";
        $where[] = "$search_table.$search_column <= '$date_to'";

    } else if ($search_type == 'today') {
        $start_of_today = date('Y-m-d 00:00:00');
        $end_of_today = date('Y-m-d 23:59:59');
        $where[] = "$search_table.$search_column BETWEEN '$start_of_today' AND '$end_of_today'";

    } else if ($search_type == 'this_week') {
        $first_date = date('Y-m-d H:i:s', strtotime('-1 week monday 00:00:00'));
        $last_date = date('Y-m-d H:i:s', strtotime('sunday 23:59:59'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_week') {
        $first_date = date('Y-m-d H:i:s', strtotime('-2 week monday 00:00:00'));
        $last_date = date('Y-m-d H:i:s', strtotime('-1 week sunday 23:59:59'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'this_month') {
        $first_date = date('Y-m-01');
        $last_date = date('Y-m-t 23:59:59.993');
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_month') {
        $first_date = date('Y-m-d', strtotime("first day of last month"));
        $last_date = date('Y-m-d 23:59:59.993', strtotime("last day of last month"));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_3_month') {
        $first_date = date('Y-m-d', strtotime('-3 months'));
        $last_date = date('Y-m-d 23:59:59.993', strtotime('last day of this month'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_6_month') {
        $first_date = date('Y-m-d', strtotime('-6 months'));
        $last_date = date('Y-m-d 23:59:59.993', strtotime('last day of this month'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_12_month') {
        $first_date = date('Y-m-d', strtotime('-12 months'));
        $last_date = date('Y-m-d 23:59:59.993', strtotime('last day of this month'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_year') {
        $search_year = date('Y', strtotime('-1 year'));
        $where[] = "YEAR($search_table.$search_column) = '$search_year'";

    } else if ($search_type == 'this_year') {
        $search_year = date('Y');
        $where[] = "YEAR($search_table.$search_column) = '$search_year'";

    } else if ($search_type == 'all_time') {
        // No additional where conditions for 'all_time'
    }

    // Combine additional where conditions if present
    if (empty($additional_where)) {
        $additional_where = array('1 = 1');
    }

    // Build the final WHERE clause
    $where_clause = !empty($where) ? " WHERE " . implode(" AND ", $where) : "";
    $additional_where_clause = !empty($additional_where) ? " AND " . implode(" AND ", $additional_where) : "";

    // Construct the query to get both count and sum
    $query = "SELECT COUNT(*) as total_count, SUM(amount) as total_amount FROM $table_name " . implode(" ", $join) . $where_clause . $additional_where_clause;

    // Execute the query
    $result = $this->db->query($query);
    $row = $result->row();

    // Return both total_count and total_amount as an array
    return [
    'total_count' => $row->total_count,
    'total_amount' => $row->total_amount
    ];

}
public function searchReport($select, $join = array(), $table_name, $search_type, $search_table, $search_column, $limit, $offset, $additional_where = array())
{
    // Initialize the where array for storing filtering conditions
    $where = array();

    // Handle all search_type cases
    if ($search_type == 'period') {
        // Handle 'period' search_type logic...
        $from_date = $this->input->post('date_from');
        $to_date = $this->input->post('date_to');
        
        $date_from = date("Y-m-d", $this->customlib->datetostrtotime($from_date));
        $date_to = date("Y-m-d 23:59:59.993", $this->customlib->datetostrtotime($to_date));
        $where[] = "$search_table.$search_column >= '$date_from'";
        $where[] = "$search_table.$search_column <= '$date_to'";

    } else if ($search_type == 'today') {
        $start_of_today = date('Y-m-d 00:00:00');
        $end_of_today = date('Y-m-d 23:59:59');
        $where[] = "$search_table.$search_column BETWEEN '$start_of_today' AND '$end_of_today'";

    } else if ($search_type == 'this_week') {
        $first_date = date('Y-m-d H:i:s', strtotime('-1 week monday 00:00:00'));
        $last_date = date('Y-m-d H:i:s', strtotime('sunday 23:59:59'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_week') {
        $first_date = date('Y-m-d H:i:s', strtotime('-2 week monday 00:00:00'));
        $last_date = date('Y-m-d H:i:s', strtotime('-1 week sunday 23:59:59'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'this_month') {
        $first_date = date('Y-m-01');
        $last_date = date('Y-m-t 23:59:59.993');
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_month') {
        $first_date = date('Y-m-d', strtotime("first day of last month"));
        $last_date = date('Y-m-d 23:59:59.993', strtotime("last day of last month"));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_3_month') {
        $first_date = date('Y-m-d', strtotime('-3 months'));
        $last_date = date('Y-m-d 23:59:59.993', strtotime('last day of this month'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_6_month') {
        $first_date = date('Y-m-d', strtotime('-6 months'));
        $last_date = date('Y-m-d 23:59:59.993', strtotime('last day of this month'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_12_month') {
        $first_date = date('Y-m-d', strtotime('-12 months'));
        $last_date = date('Y-m-d 23:59:59.993', strtotime('last day of this month'));
        $where[] = "$search_table.$search_column >= '$first_date'";
        $where[] = "$search_table.$search_column <= '$last_date'";

    } else if ($search_type == 'last_year') {
        $search_year = date('Y', strtotime('-1 year'));
        $where[] = "YEAR($search_table.$search_column) = '$search_year'";

    } else if ($search_type == 'this_year') {
        $search_year = date('Y');
        $where[] = "YEAR($search_table.$search_column) = '$search_year'";

    } else if ($search_type == 'all_time') {
        // No additional where conditions for 'all_time'
    }

    // Combine additional where conditions if present
    if (empty($additional_where)) {
        $additional_where = array('1 = 1');
    }

    // Build the final WHERE clause
    $where_clause = !empty($where) ? " WHERE " . implode(" AND ", $where) : "";
    $additional_where_clause = !empty($additional_where) ? " AND " . implode(" AND ", $additional_where) : "";

    // Construct the final query with LIMIT and OFFSET
    $query = "SELECT $select FROM $table_name " . implode(" ", $join) . $where_clause . $additional_where_clause .
             " ORDER BY $search_column DESC LIMIT $limit OFFSET $offset";

    // Execute the query
    $res = $this->db->query($query);
    return $res->result_array();
}

    
    public function transactionReport($select = '', $join = array(), $table_name, $additional_where = array()) {
        if (empty($additional_where)) {
            $additional_where = array(" 1 = 1");
        }

        if (!empty($join)) {
            $query = "select " . $select . " from " . $table_name . " " . implode(" ", $join) . " where " . implode("and ", $additional_where);
        } else {
            $query = "select " . $select . " from " . $table_name . " where" . implode("and ", $additional_where);
        }

        $res = $this->db->query($query);
        return $res->result_array();
    }

}
?>