<?php defined('BASEPATH') OR exit('No direct script access allowed');

class transparencia_model extends CI_Model{
    private $jsonCatalog = NULL;
    private $HTMLFile = NULL;
    public  $arrayObj = NULL;
        
    public function __construct() {
        parent::__construct();
        
        try {
            try {
            $this->jsonCatalog = @json_decode(file_get_contents(JSONCATALOG), true);
            } catch (Exception $exc) {
            }
           
            if ($this->jsonCatalog == NULL)
                throw new Exception("No se pudo leer el catálogo de archivos");        
                
            $this->load->library('table');            
        } catch (Exception $ex) {
        }
    }
    
    public function readPubHTMLtoTable() { 
        if ($this->jsonCatalog == NULL) return NULL;
        
        $returnResult = NULL;
        $html = NULL;
        
        try        
        {               
            foreach ($this->jsonCatalog as $clave => $valor) {
                if ($this->jsonCatalog[$clave]['data']['status'] == 1) {
                    $this->arrayObj = $this->jsonCatalog[$clave];
                    $this->arrayObj['Index'] = $clave;
                    $this->HTMLFile = $this->arrayObj['html']['file_name'];
                }
            };
            
            if (!empty($this->HTMLFile)) {            
                $file = base_url(str_replace("./", "", HTMLREPO) . $this->HTMLFile);

                $file_headers = @get_headers($file);
                if($file_headers[0] == 'HTTP/1.1 404 Not Found')
                    throw new Exception("Archivo HTML [ {$file} ] no encontrado");

                $html = file_get_contents($file);

                $doc = new DOMDocument();
                @$doc->loadHTML($html,LIBXML_NOWARNING | LIBXML_NOERROR);

                $tables = @$doc->getElementsByTagName('table');
                foreach($tables as $table) {                
                    $table->setAttribute('id','transparenciaTable');
                    $table->setAttribute('class','table-condensed');
                    $table->setAttribute('width','100%');
                    $table->setAttribute('cellspacing','0');
                    $table->setAttribute('cellpadding','0');

                    $content = $doc->saveHTML($table); 
                }

                $returnResult = $content;
            }
        } catch (Exception $e) {            
            msg_reporting::error_log($e);
            $this->session->set_flashdata('errorView', '');
        }
        
        return $returnResult;
    }
    
    
    
}
