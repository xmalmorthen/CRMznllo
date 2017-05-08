<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {
    private $model = NULL;
    
    public function __construct()
    {       
        parent::__construct();        
        if (ENVIRONMENT == 'production') $this->output->cache(1440);	
        $this->model['menu'] = $this->load->view('sections/menu',NULL,TRUE);
        
    }
    
    public function index()
    {                
        //TRANSPARENCIA
        $this->model['content'] = $this->load->view('sections/transparencia',NULL,TRUE);        
        
        $this->load->view('layouts/master',$this->model);
    }
}
