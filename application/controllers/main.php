<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {
    private $model = NULL;
    
    public function __construct()
    {      
        parent::__construct();                               
        if (ENVIRONMENT == 'production') $this->output->cache(1440);	
        
        $this->load->model('transparencia_model');
        
        $this->model['menu'] = $this->load->view('sections/menu',NULL,TRUE);
        
        $this->model['link'] = array(
            "<link rel='stylesheet' type='text/css' href='". base_url(CSS . 'jquery.dataTables.min.css') ."'>",
            "<link rel='stylesheet' type='text/css' href='". base_url(CSS . 'dataTables.bootstrap.min.css') ."'>",
            "<link rel='stylesheet' type='text/css' href='". base_url(CSS . 'ownDataTableStyle.css') ."'>"
        );
        $this->model['script'] = array(
            "<script src='" . base_url(JS . 'jquery.dataTables.min.js') . "'></script>",
            "<script src='" . base_url(FWRKS . 'htmlTableToExcelSpreadsheet/jquery.table2excel.js') . "'></script>"
        );   
        
        $this->model['scripts'] = "$('#tblData').DataTable({ 'language': {'url': '" . base_url(JS . 'Spanish.json') ."'}});";        
    }
    
    public function index()
    {         
        $this->model['content'] = $this->transparencia(TRUE);
        $this->load->view('layouts/master',$this->model);
    }
    
    public function transparencia($partialView = FALSE){
        $viewModel['table'] = $this->transparencia_model->readPubHTMLtoTable();
        $viewModel['fileObj'] = $this->transparencia_model->arrayObj;
       
        //TRANSPARENCIA
        $this->model['content'] = $this->load->view('sections/transparencia',$viewModel,TRUE);
        
        if ($partialView) return $this->model['content'];
        
        $this->load->view('layouts/master',$this->model);
    }
}
