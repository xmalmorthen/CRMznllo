<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class administrador extends CI_Controller {
    private $model = NULL;
    
    public function __construct()
    {       
        parent::__construct();        
        $this->model['title'] = "CR Mznllo Col - Administrador";   
        $this->model['menu'] = $this->load->view('sections/menuAdministrator',NULL,TRUE);
    }
    
    public function index()
    {
        $this->model['content'] = $this->load->view("administrador/index",NULL,TRUE);        
        $this->load->view('layouts/master',$this->model);
    }
    
    public function transparencia()
    {
        if (!$this->input->post()) {        
            $this->model['content'] = $this->load->view("administrador/transparencia",NULL,TRUE);
        } else {             
            $this->load->library('upload');
            
            $config = array();
            $config['upload_path'] = REPO;
            $config['allowed_types'] = 'xls|xlsx|xml';
            $config['max_size']      = '0';
            $config['overwrite']     = FALSE;
            
            $fileCatalog['excel'] = array(
                "name" =>  $_FILES['excelFile']['name'],
                "type" =>  $_FILES['excelFile']['type'],
                "size" =>  $_FILES['excelFile']['size'],
                "uniqueId" => uniqid('excel_',true)
            );
            $fileCatalog['xml'] = array(
                "name" =>  $_FILES['xmlFile']['name'],
                "type" =>  $_FILES['xmlFile']['type'],
                "size" =>  $_FILES['xmlFile']['size'],
                "uniqueId" => uniqid('xml_',true)
            );

            $jsonCatalog = json_encode($fileCatalog,JSON_UNESCAPED_UNICODE);
            
            var_dump($jsonCatalog);
            
            $objCatalog = json_decode($jsonCatalog);
            
            var_dump($objCatalog);
            
            die('OK');
                                    
            $this->upload->initialize($config);
            $this->upload->do_upload();           
            
        }
        
        $this->load->view('layouts/master',$this->model);        
    }
    
    
    
    
    
}

/* End of file logon.php */
/* Location: ./application/controllers/logon.php */