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

                if ( ($files['excelFile']['error'] != 0) || ($files['xmlFile']['error'] != 0 ) )
                    throw new Exception("Falta adjuntar archivo(s)");
            
                $excelExtension = NULL;
                $xmlExtension = NULL;
                try {
                    $excelExtension = '.' . explode(".", $files['excelFile']['name'])[1];
                    $xmlExtension = '.' . explode(".", $files['xmlFile']['name'])[1];
                } catch (Exception $exc) {
                    throw new Exception("No se pudo leer la extensión del archivo adjunto");
                }
                
                $this->load->library('doupload');
                
                doupload::config(EXCELREPO, 'xls|xlsx');
                
                $uniqid = uniqid('',true);
                
                $_FILES['userfile']['name']= $uniqid . $excelExtension;
                $_FILES['userfile']['type']= $files['excelFile']['type'];
                $_FILES['userfile']['tmp_name']= $files['excelFile']['tmp_name'];
                $_FILES['userfile']['error']= $files['excelFile']['error'];
                $_FILES['userfile']['size']= $files['excelFile']['size'];
                
                $MsgResponseExcel = NULL;
                if (doupload::upload($MsgResponseExcel)) {
                    
                    $excel = $MsgResponseExcel;
                    
                    doupload::config(XMLREPO, 'xml');

                    $_FILES['userfile']['name']= $uniqid . $xmlExtension;
                    $_FILES['userfile']['type']= $files['xmlFile']['type'];
                    $_FILES['userfile']['tmp_name']= $files['xmlFile']['tmp_name'];
                    $_FILES['userfile']['error']= $files['xmlFile']['error'];
                    $_FILES['userfile']['size']= $files['xmlFile']['size'];

                    $MsgResponseXML = NULL;
                    doupload::upload($MsgResponseXML);
                    
                    $xml = $MsgResponseXML;

                    $excel['upload_data']['original_name'] = $files['excelFile']['name'];
                    $xml['upload_data']['original_name'] = $files['xmlFile']['name'];                    
                    
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
                    
                    $jsonCatalog[$uniqid]['excel'] = $excel['upload_data'];
                    $jsonCatalog[$uniqid]['xml'] = $xml['upload_data'];
                                          
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
        $this->table->set_heading('Archivo Excel', 'Archivo XML', 'Descripción', 'Fecha de Publicación', 'Hora de Publicación','Acciones');
        
        $areOneActive = FALSE;
        
        foreach($jsonCatalog as $index => $row)
        {
            if ( $row['data']['status'] > 1 )                
                continue;
            $cell = array('data' => $row['excel']['original_name'], 'class' => ( $row['data']['status'] == 1 ? 'success' : '') );
            

            //'<i class="fa fa-eye" aria-hidden="true"></i>'
            
            $actions = anchor("./transparencia/download/Excel/$index",'<i class="fa fa-download fa-2x actionButton" aria-hidden="true" data-toggle="tooltip" title="Descargar archivo de Excel"></i>')
                    . anchor("./transparencia/download/XML/$index",'<i class="fa fa-download fa-2x actionButton" aria-hidden="true" data-toggle="tooltip" title="Descargar archivo XML"></i>')
                    . anchor("./transparencia/delete/$index",'<i class="fa fa-trash fa-2x actionButton" aria-hidden="true" data-toggle="tooltip" title="Eliminar archivos"></i>')
                    . anchor("./transparencia/". ( $row['data']['status'] == 1 ? 'hide' : 'show') ."/$index",'<i class="fa fa-eye'. ( $row['data']['status'] == 1 ? '-slash' : '') .' fa-2x actionButton" aria-hidden="true" data-toggle="tooltip" title="' . ( $row['data']['status'] == 1 ? 'Ocultar información' : 'Publicar información') . '"></i>');
            
            $this->table->add_row(
                array('data' => $row['excel']['original_name'], 'class' => ( $row['data']['status'] == 1 ? 'success' : '') ),
                array('data' => $row['xml']['original_name'], 'class' => ( $row['data']['status'] == 1 ? 'success' : '') ),
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