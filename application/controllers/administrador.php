<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class administrador extends CI_Controller {
    private $model = NULL;
    
    public function __construct()
    {       
        parent::__construct();        
        $this->model['title'] = "CR Mznllo Col - Administrador";        
    }
    
    public function index()
    {
        $this->load->view("administrador/index");
    }
}

/* End of file logon.php */
/* Location: ./application/controllers/logon.php */