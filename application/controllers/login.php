<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
    private $model = NULL;
    
    public function __construct()
    {       
        parent::__construct();        
        $this->model['title'] = "CR Mznllo Col - Inicio de Sesión";        
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        
        $this->model['link'] = array(
            "<link rel='stylesheet' type='text/css' href='". base_url(CSS . 'login.css') ."'>"
        );
    }
    
    private function _showloginpage(){
        $this->model['content'] = $this->load->view('logon/index',$this->model,TRUE);        
        $this->load->view('layouts/master',$this->model);
    }
    
    public function index()
    {
        if (!$this->input->post()){            
            $this->model['rout'] =  $this->session->flashdata('togourl');
            $this->_showloginpage();
        } else {
            $this->form_validation->set_message('required', 'El dato es requerido');
            $this->form_validation->set_error_delimiters("<div class='alert alert-danger text-left'><i class='fa fa-exclamation-triangle'></i><span style='padding-left: 10px;'>","</span></div>");

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if($this->form_validation->run() == TRUE)
            {                   
                if ($this->_checkuser($this->input->post('username'),$this->input->post('password'))){
                    $this->_redirect();
                } else {                    
                    $this->session->set_flashdata('errorLogin', 'Usuario y/o contraseña incorrectos...');                    
                }
            }
            $this->model['rout'] =  $this->input->post('rout');
            $this->_showloginpage();
        }
    }
    
    private function _checkuser($username,$password)
    {        
        $returnResult = false;
        
        $this->load->model('logon_model');
                
        $sess_array = $this->logon_model->login($username,$password);
        if ($sess_array) {
            $this->session->set_userdata('logged_in', $sess_array);
            $returnResult = TRUE;
        }
        return $returnResult;
    }
    
    private function _redirect(){
        $redirect = $this->router->routes['admin_controller'];        
        $rout = $this->input->post('rout');
        if ($rout){
            $originrout = $this->uri->segment(1) . $this->uri->segment(2);            
            if ($rout != $originrout ){
                $redirect = $rout;
            }
        }       
        redirect($redirect);        
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
    
}

/* End of file logon.php */
/* Location: ./application/controllers/logon.php */