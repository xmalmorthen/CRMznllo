<?php //defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Autor: Miguel Angel Rueda Aguilar
 * Fecha: 10-05-2017
 * Descripción: Clase para subir archivos
 */

class doupload {
    
    private static $config = NULL;
    
    public static function config($upload_path,$allowed_types,$max_size = '0'){
        self::$config                   = array();
        self::$config['upload_path']    = $upload_path;
        self::$config['allowed_types']  = $allowed_types;
        self::$config['max_size']       = $max_size;
        self::$config['overwrite']      = FALSE;
    }
    
    public static function upload(&$MsgResponse){
        $returnResponse = FALSE;
        
        try {            
            if (!self::$config) throw new Exception("No se ha configurado la subida del archivo");
            
            $CI = & get_instance();
            $CI->load->library('upload');
                      
            $CI->upload->initialize(self::$config);
            $returnResponse = $CI->upload->do_upload();
            
            if (!$returnResponse)
                $MsgResponse = array('error' => $CI->upload->display_errors());
            else
                $MsgResponse = array('upload_data' => $CI->upload->data());
        } catch (Exception $ex) {
            $MsgResponse = $ex->getMessage();
        }
        return $returnResponse;
    }
    
}
