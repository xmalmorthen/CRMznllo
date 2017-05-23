<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class transparencia extends CI_Controller {
    private $model = NULL;
    private $jsonCatalog = NULL;
    
    public function __construct()
    {       
        parent::__construct();
        
        try {
            $this->jsonCatalog = @json_decode(file_get_contents(JSONCATALOG), true);
        } catch (Exception $exc) {
        }
        
    }
    
    public function download($fileType,$ref)
    {   
        try {
            $redirectUri = $this->input->get('redirectUri');
            if (isset($this->jsonCatalog[$ref])) {
                $this->load->helper('download');        

                $file = base_url(str_replace("./", "", HTMLREPO . $this->jsonCatalog[$ref]['html']['file_name']));
                
                $file_headers = @get_headers($file);
                if($file_headers[0] == 'HTTP/1.1 404 Not Found')
                    throw new Exception("Archivo no encontrado");

                $data = file_get_contents($file);
                if ($data === FALSE)
                    throw new Exception("Error al leer el archivo");

                force_download($this->jsonCatalog[$ref]['html']['original_name'], $data);
            } else 
                throw new Exception("Referencia a archivo no encontrada");
        } catch (Exception $ex) {          
            $this->session->set_flashdata('errorAction', $ex->getMessage());
            redirect(!$redirectUri ? "./administrador/transparencia" : $redirectUri);
        }
    }
    
    public function delete($ref)
    {
        try {
            
            $lastStatus = NULL;
            
            if (isset($this->jsonCatalog[$ref])) {
                $lastStatus = $this->jsonCatalog[$ref]['data']['status'];
                
                $this->jsonCatalog[$ref]['data']['status'] = 2;                
                $jsonStructure = json_encode($this->jsonCatalog,JSON_UNESCAPED_UNICODE);
                $writeCatalog = @file_put_contents(JSONCATALOG, $jsonStructure);
                    
                if ($writeCatalog === FALSE) 
                    throw new Exception("Error al escribir en el catálogo de archivos");
            } else 
                throw new Exception("Referencia a registro inexistente");

            $this->session->set_flashdata('successAction',"Registro eliminado con éxito");
            
            if ($lastStatus == 1)            
                $this->session->set_flashdata('Note',"Actualmente no se encuentra información pública activa, favor de considerar activar alguno de los registros.");            
        } catch (Exception $exc) {
            $this->session->set_flashdata('errorAction', $ex->getMessage());
        }
        redirect("./administrador/transparencia");                
    }
    
    public function hide($ref)
    {
        try {            
            $lastStatus = NULL;
            
            if (isset($this->jsonCatalog[$ref])) {
                $lastStatus = $this->jsonCatalog[$ref]['data']['status'];
                
                $this->jsonCatalog[$ref]['data']['status'] = 0;                
                $jsonStructure = json_encode($this->jsonCatalog,JSON_UNESCAPED_UNICODE);
                $writeCatalog = @file_put_contents(JSONCATALOG, $jsonStructure);
                    
                if ($writeCatalog === FALSE) 
                    throw new Exception("Error al escribir en el catálogo de archivos");
            } else 
                throw new Exception("Referencia a registro inexistente");

            $this->session->set_flashdata('successAction',"Registro oculto con éxito");
            
            if ($lastStatus == 1)            
                $this->session->set_flashdata('Note',"Actualmente no se encuentra información pública activa, favor de considerar activar alguno de los registros.");
        } catch (Exception $exc) {
            $this->session->set_flashdata('errorAction', $ex->getMessage());
        }
        redirect("./administrador/transparencia");  
    }
    
    public function show($ref)
    {
        try {            
            $lastStatus = NULL;
            
            if (isset($this->jsonCatalog[$ref])) {
                $lastStatus = $this->jsonCatalog[$ref]['data']['status'];
                
                $this->jsonCatalog[$ref]['data']['status'] = 1;                
                
                foreach ($this->jsonCatalog as $clave => $valor) {
                    if ($clave == $ref)                        
                        continue;
                    if ($this->jsonCatalog[$clave]['data']['status'] == 1)
                        $this->jsonCatalog[$clave]['data']['status'] = 0;
                }
                
                $jsonStructure = json_encode($this->jsonCatalog,JSON_UNESCAPED_UNICODE);
                $writeCatalog = @file_put_contents(JSONCATALOG, $jsonStructure);
                    
                if ($writeCatalog === FALSE) 
                    throw new Exception("Error al escribir en el catálogo de archivos");
            } else 
                throw new Exception("Referencia a registro inexistente");

            $this->session->set_flashdata('successAction',"Registro publicado con éxito");
            
            if ($lastStatus == 1)            
                $this->session->set_flashdata('Note',"Actualmente no se encuentra información pública activa, favor de considerar activar alguno de los registros.");
        } catch (Exception $exc) {
            $this->session->set_flashdata('errorAction', $ex->getMessage());
        }
        redirect("./administrador/transparencia");
    }
    
}

/* End of file logon.php */
/* Location: ./application/controllers/logon.php */