<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function index()
    {
        $view['title'] = 'Dashboard';
        $view['pageName'] = 'home';
        $this->load->view('index', $view);
    }
}

/* End of file Administrator.php */
