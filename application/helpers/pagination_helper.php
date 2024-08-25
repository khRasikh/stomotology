<?php
function configure_pagination($base_url, $total_rows, $per_page = 10, $uri_segment = 4, $num_links = 5)
{
    // Load CodeIgniter instance
    $CI = &get_instance();

    // Load Pagination Library
    $CI->load->library('pagination');

    // Pagination Configuration
    $config = array();
    $config['base_url'] = $base_url;
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $per_page;
    $config['uri_segment'] = $uri_segment;
    $config['num_links'] = $num_links;

    // Styling the pagination
    $config['full_tag_open'] = '<ul class="pagination" style="direction: rtl;">';
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><span>';
    $config['cur_tag_close'] = '</span></li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['prev_link'] = 'قبلی';  // Previous in RTL language
    $config['next_link'] = 'بعدی';  // Next in RTL language
    $config['first_link'] = 'صفحه اول'; // First Page in RTL language
    $config['last_link'] = 'صفحه آخر'; // Last Page in RTL language

    // Initialize pagination
    $CI->pagination->initialize($config);

    // Return the initialized pagination object for further use
    return $CI->pagination;
}
