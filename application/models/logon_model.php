<?php defined('BASEPATH') OR exit('No direct script access allowed');

class logon_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login($username,$password) {
        try        
        {            
            if (defined('SESSFORCED'))
            {
                if (SESSFORCED) {
                    
                    if ( ($username == SESSFORCEDUSER) && ($password == SESSFORCEDPASS) ){                    
                        /*
                        * forzado de inicio de sesion
                        */
                        $sess_array = array(
                           'id' => '0',
                           'username' => SESSFORCEDUSER,
                           'name' => 'Administrador del sistema'
                        );
                        return $sess_array;
                    } else {
                        return FALSE;
                    }
                }
            }
        
            $this->load->database();
            
            $vigente = 1;
          
            $this->db->select('idusuario,nombre,clave');
            $this->db->from('cat_usuarios');
            $this->db->where('vigente ',$vigente);
            $this->db->where('idrol ',ROL_LOGEO);
            $this->db->where('login ',$this->db->escape_str($username));            
            $query=$this->db->get();
            
            $data = $query->result_array();
            if ($data){
                if (md5($password) == $data[0]['clave']){
                    $sess_array = NULL;                                     
                    foreach($data as $row)
                    {
                        $sess_array = array(
                            'id' => $data[0]['idusuario'],
                            'username' => $username,
                            'name' => $data[0]['nombre']
                        );
                    }
                    return $sess_array;
                } else {
                    return false;
                }
            } else {
                return false;                
            }            
        } catch (Exception $e) {            
            msg_reporting::error_log($e);
            return false;
        }
    }    
}
