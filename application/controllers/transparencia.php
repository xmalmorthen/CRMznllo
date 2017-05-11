<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class transparencia extends CI_Controller {
    private $model = NULL;
    
    public function __construct()
    {       
        parent::__construct();
    }
    
    public function download($fileType,$ref)
    {        
        try {
            $jsonCatalog = @json_decode(file_get_contents(JSONCATALOG), true);
        } catch (Exception $exc) {
        }

        if (isset($jsonCatalog[$ref])) {
            $this->load->helper('download');        
            try {
                
                $file = base_url(str_replace("./", "", ( $fileType == 'Excel' ? EXCELREPO : XMLREPO )) . $jsonCatalog[$ref]['excel']['file_name']);
                
                $file_headers = @get_headers($file);
                if($file_headers[0] == 'HTTP/1.1 404 Not Found')
                    throw new Exception("Archivo no encontrado");
                
                $data = file_get_contents($file);
                
                if ($data === FALSE)
                    throw new Exception("Error al leer el archivo");
                
                force_download($jsonCatalog[$ref]['excel']['original_name'], $data);
            } catch (Exception $exc) {
                echo "Error al descargar";
            }            
        } else 
            echo "Referencia a archivo no encontrada";
    }
    
    public function delete($ref)
    {
    }
    
    public function hide($ref)
    {
    }
    
    public function show($ref)
    {
    }
    
}

/* End of file logon.php */
/* Location: ./application/controllers/logon.php */