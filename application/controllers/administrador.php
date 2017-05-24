<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class administrador extends CI_Controller {
    private $model = NULL;
    
    public function __construct()
    {       
        parent::__construct();        
        $this->model['title'] = "CR Mznllo Col - Administrador";   
        $this->model['menu'] = $this->load->view('sections/menuAdministrator',NULL,TRUE);
        
        $this->model['link'] = array(
            "<link rel='stylesheet' type='text/css' href='". base_url(CSS . 'jquery.dataTables.min.css') ."'>",
            "<link rel='stylesheet' type='text/css' href='". base_url(CSS . 'dataTables.bootstrap.min.css') ."'>",
            "<link rel='stylesheet' type='text/css' href='". base_url(CSS . 'ownDataTableStyle.css') ."'>",
            "<link rel='stylesheet' type='text/css' href='". base_url(CSS . 'transparencia.css') ."'>"
        );
        $this->model['script'] = array(
            "<script src='" . base_url(JS . 'jquery.dataTables.min.js') . "'></script>"
        );   
        
        $this->model['scripts'] = "$('#tblFilesUploaded').DataTable({ 'order': [[ 3, 'desc' ],[ 4, 'desc' ]] ,'language': {'url': '" . base_url(JS . 'Spanish.json') ."'}});";
    }
    
    public function index()
    {
        $this->model['content'] = $this->load->view("administrador/index",NULL,TRUE);        
        $this->load->view('layouts/master',$this->model);
    }
    
    public function transparencia()
    {        
        $jsonCatalog = NULL;
        if ($this->input->post()){
            //SUBIDA DE ARCHIVOS           
            try {
                $files = $_FILES;

                if ( $files['htmlFile']['error'] != 0 )
                    throw new Exception("Falta adjuntar archivo");
            
                $htmlExtension = NULL;
                try {
                    $htmlExtension = '.' . explode(".", $files['htmlFile']['name'])[1];
                } catch (Exception $exc) {
                    throw new Exception("No se pudo leer la extensión del archivo adjunto");
                }
                
                $this->load->library('doupload');
                
                doupload::config(HTMLREPO, 'html');
                
                $uniqid = uniqid('',true);
                
                $_FILES['userfile']['name']= $uniqid . $htmlExtension;
                $_FILES['userfile']['type']= $files['htmlFile']['type'];
                $_FILES['userfile']['tmp_name']= $files['htmlFile']['tmp_name'];
                $_FILES['userfile']['error']= $files['htmlFile']['error'];
                $_FILES['userfile']['size']= $files['htmlFile']['size'];
                
                $MsgResponseHTML = NULL;
                if (doupload::upload($MsgResponseHTML)) {
                    
                    $html = $MsgResponseHTML;
                    
                    $html['upload_data']['original_name'] = $files['htmlFile']['name'];
                    
                    //REGISTRO DE ARCHIVO EN CATÁLOGO
                    
                    try {
                        $jsonCatalog = @json_decode(file_get_contents(JSONCATALOG), true);
                    } catch (Exception $exc) {
                    }

                    if (!$jsonCatalog)
                        $jsonCatalog[$uniqid] = array();
                    else {
                        foreach ($jsonCatalog as $clave => $valor) {
                            if ($jsonCatalog[$clave]['data']['status'] == 1)
                                $jsonCatalog[$clave]['data']['status'] = 0;
                        }
                    }
                         
                    $data = array(
                        "date" => date("d/m/Y"),
                        "time" => date("H:i:s"),
                        "user" => $this->session->userdata('logged_in')['username'],
                        "name" => $this->session->userdata('logged_in')['name'],
                        "description" => $this->input->post('descFile'),
                        "status" => 1
                    );
                    
                    $jsonCatalog[$uniqid]['data'] = $data;
                    
                    $jsonCatalog[$uniqid]['html'] = $html['upload_data'];
                                          
                    $jsonStructure = json_encode($jsonCatalog,JSON_UNESCAPED_UNICODE);
                   
                    $writeCatalog = @file_put_contents(JSONCATALOG, $jsonStructure);
                    
                    if ($writeCatalog === FALSE) 
                        throw new Exception("Error al escribir en el catálogo de archivos");
                                        
                    $this->session->set_flashdata('success',"Archivos registrados");
                    
                    redirect('./administrador/transparencia');
                }
            } catch (Exception $exc) {
                $this->session->set_flashdata('error', $exc->getMessage());
            }
        }
        
        if (!$jsonCatalog){
            try {
                $jsonCatalog = @json_decode(file_get_contents(JSONCATALOG), true);                        
            } catch (Exception $exc) {
            }

            if (!$jsonCatalog)
                $jsonCatalog = array();
        }
        
        //-- Table Initiation
        $tmpl = array (
            'table_open'          => '<div class="table-responsive"><table id="tblFilesUploaded" class="table table-condensed table-hover" cellspacing="0" width="100%">',
            'thead_open'            => '<thead>',
            'thead_close'           => '</thead>',

            'heading_row_start'     => '<tr>',
            'heading_row_end'       => '</tr>',
            'heading_cell_start'    => '<th>',
            'heading_cell_end'      => '</th>',

            'tbody_open'            => '<tbody>',
            'tbody_close'           => '</tbody>',

            'row_start'             => '<tr>',
            'row_end'               => '</tr>',
            'cell_start'            => '<td>',
            'cell_end'              => '</td>',

            'row_alt_start'         => '<tr>',
            'row_alt_end'           => '</tr>',
            'cell_alt_start'        => '<td>',
            'cell_alt_end'          => '</td>',

            'table_close'           => '</table></div>'
        );
        
        $this->load->library('table');
        $this->table->set_template($tmpl);      
        $this->table->set_heading('Archivo HTML', 'Descripción', 'Fecha de Publicación', 'Hora de Publicación','Acciones');
        
        $areOneActive = FALSE;
        
        foreach($jsonCatalog as $index => $row)
        {
            if ( $row['data']['status'] > 1 )                
                continue;
            $cell = array('data' => $row['html']['original_name'], 'class' => ( $row['data']['status'] == 1 ? 'success' : '') );
            
            $dataContent = "<div class='pull-right'><a href='". base_url("index.php/transparencia/delete/{$index}") ."' class='btn btn-success' role='button' aria-hidden='true' data-toggle='tooltip' title='Aceptar'><i class='fa fa-check'></i></a> <button type='button' class='btn btn-danger btnActionDeleteCancel' aria-hidden='true' data-toggle='tooltip' title='Cancelar' onclick='cancelDeleteAction()'><i class='fa fa-ban' aria-hidden='true'></i></button></div>";
            
            $actions = anchor("./transparencia/download/HTML/$index",'<i class="fa fa-download fa-2x actionButton" aria-hidden="true" data-toggle="tooltip" title="Descargar archivo de HTML"></i>')
                    . anchor(
                            null,
                            '<i class="fa fa-trash fa-2x actionButton" aria-hidden="true" data-toggle="tooltip" title="Eliminar archivo"></i>',
                            array(
                                'class'=>'deleteActionBtn', 
                                'data-toggle'=>'popover', 
                                'title' => "<h3><i class='fa fa-question-circle-o' aria-hidden='true'></i> Confirmar la acción</h3>",
                                'data-content' => $dataContent))
                    . anchor("./transparencia/". ( $row['data']['status'] == 1 ? 'hide' : 'show') ."/$index",'<i class="fa fa-eye'. ( $row['data']['status'] == 1 ? '-slash' : '') .' fa-2x actionButton" aria-hidden="true" data-toggle="tooltip" title="' . ( $row['data']['status'] == 1 ? 'Ocultar información' : 'Publicar información') . '"></i>');
                       
            $this->table->add_row(
                array('data' => $row['html']['original_name'], 'class' => ( $row['data']['status'] == 1 ? 'success' : '') ),
                array('data' => $row['data']['description'], 'class' => ( $row['data']['status'] == 1 ? 'success' : '') ),
                array('data' => $row['data']['date'], 'class' => ( $row['data']['status'] == 1 ? 'success' : '') ),
                array('data' => $row['data']['time'], 'class' => ( $row['data']['status'] == 1 ? 'success' : '') ),
                array('data' => $actions, 'class' => ( $row['data']['status'] == 1 ? 'success' : '') )
                
            );
            
            if (!$areOneActive)
                $areOneActive = $row['data']['status'] == 1;
        }
        
        if (!$areOneActive)
            $this->session->set_flashdata('Note',"Actualmente no se encuentra información pública activa, favor de considerar activar alguno de los registros.");            
        
        $table = $this->table->generate();
        $viewModel['table'] = $table;                
        
        $this->model['content'] = $this->load->view("administrador/transparencia",$viewModel,TRUE);
        $this->load->view('layouts/master',$this->model);        
    }
    
}

/* End of file logon.php */
/* Location: ./application/controllers/logon.php */