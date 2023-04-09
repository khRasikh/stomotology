<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Practice extends Front_Controller {
 public function __construct() {
        parent::__construct();
      
    }

public function Function_practice()
{
echo "string";
$this->load->view('practice');
}
}

?>