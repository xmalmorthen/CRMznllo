<?php defined('BASEPATH') OR exit('No direct script access allowed');

class transparencia_model extends CI_Model{
    private $jsonCatalog = NULL;
    private $XMLFile = NULL;
    public  $arrayObj = NULL;
        
    public function __construct() {
        parent::__construct();
        
        try {
            try {
            $this->jsonCatalog = @json_decode(file_get_contents(JSONCATALOG), true);
            } catch (Exception $exc) {
            }

            if (!$this->jsonCatalog)
                throw new Exception("No se pudo leer el catálogo de archivos");        
                
            $this->load->library('table');            
        } catch (Exception $ex) {
            msg_reporting::error_log($ex);
            $this->session->set_flashdata('errorView', '');
        }
    }
    
    public function readPubXMLtoTable() { 
        if ($this->session->flashdata('errorView')) return NULL;
        
        $returnResult = NULL;
        $xml = NULL;
        
        try        
        {               
            foreach ($this->jsonCatalog as $clave => $valor) {
                if ($this->jsonCatalog[$clave]['data']['status'] == 1) {
                    $this->arrayObj = $this->jsonCatalog[$clave];
                    $this->arrayObj['Index'] = $clave;
                    $this->XMLFile = $this->arrayObj['xml']['file_name'];
                }
            };
            
            $file = base_url(str_replace("./", "", XMLREPO) . $this->XMLFile);

            $file_headers = @get_headers($file);
            if($file_headers[0] == 'HTTP/1.1 404 Not Found')
                throw new Exception("Archivo XML [ {$file} ] no encontrado");
            
            $xml=simplexml_load_file( $file);
            if (!$xml)
                throw new Exception("Error al leer el XML [ {$this->XMLFile} ]");
            //-- Table Initiation
            $tmpl = array (
                'table_open'          => '<div class="table-responsive"><table id="tblData" class="table table-condensed table-hover" cellspacing="0" width="100%">',
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
                   
            foreach($xml->children() as $items) { 
                $this->table->add_row(
                    array('data' => $items['category'], 'class' => ( '' ) ),
                    array('data' => $items->title, 'class' => ( '' ) ),
                    array('data' => $items->author, 'class' => ( '' ) ),
                    array('data' => $items->year, 'class' => ( '' ) ),
                    array('data' => $items->price, 'class' => ( '' ) )
                );                
            } 
            
            $this->table->set_template($tmpl);      
            $this->table->set_heading('Category', 'Title', 'Autor', 'Year', 'Price');
            
            $table = $this->table->generate();
            
            $returnResult = $table;
        } catch (Exception $e) {            
            msg_reporting::error_log($e);
            $this->session->set_flashdata('errorView', '');
        }
        
        return $returnResult;
    }
    
    
    
}
