<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

   
    public function get_user_loginpin($username,$pass){
        $sql_string = "SELECT u.*,i.*,c.*,co.*
                      FROM {$this->db->dbprefix('usuarios')} u,
                      {$this->db->dbprefix('inscripcion_pin')} i,
                      {$this->db->dbprefix('convocatorias')} c,
                      {$this->db->dbprefix('configuracion')} co
                      WHERE 
                      c.CONVOCATORIA_ID = co.CONVOCATORIA_ID
                      AND u.USUARIO_NUMERODOCUMENTO = i.USUARIO_NUMERODOCUMENTO
                      AND c.CONVOCATORIA_ID = i.CONVOCATORIA_ID
                      AND u.USUARIO_NUMERODOCUMENTO = '{$username}'
                      AND i.INSCRIPCION_PIN = '{$pass}'  
                      AND ('".date("Y-m-d H:i:s")."' BETWEEN FECHA_INICIO_INS AND FECHA_FINAL_INS 
                          OR i.INSCRIPCION_PIN = '1159875' 
                          OR i.INSCRIPCION_PIN = '1168424' 
                          OR i.INSCRIPCION_PIN = '1168529' 
                          OR i.INSCRIPCION_PIN = '1168530' 
                          OR i.INSCRIPCION_PIN = '1163502'
                          OR i.INSCRIPCION_PIN = '1168531'
						  OR i.INSCRIPCION_PIN = '1168532'
						  OR i.INSCRIPCION_PIN = '1168533'
                          )
                      AND u.USUARIO_ESTADO=1";
        //echo $sql_string;
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();        
    }
    
    public function get_user_loginpin_nodate($username,$pass){
        $sql_string = "SELECT u.*,i.*,c.*,co.*
                      FROM {$this->db->dbprefix('usuarios')} u,
                      {$this->db->dbprefix('inscripcion_pin')} i,
                      {$this->db->dbprefix('convocatorias')} c,
                      {$this->db->dbprefix('configuracion')} co
                      WHERE 
                      c.CONVOCATORIA_ID = co.CONVOCATORIA_ID
                      AND u.USUARIO_NUMERODOCUMENTO = i.USUARIO_NUMERODOCUMENTO
                      AND c.CONVOCATORIA_ID = i.CONVOCATORIA_ID
                      AND u.USUARIO_NUMERODOCUMENTO = '{$username}'
                      AND i.INSCRIPCION_PIN = '{$pass}'  
                      
                      AND u.USUARIO_ESTADO=1";
        //echo $sql_string;
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();          
    }
    
    public function get_user_loginpin_ens($username,$pass){
        $sql_string = "SELECT u.*,i.*,c.*,co.*
                      FROM {$this->db->dbprefix('usuarios')} u,
                      {$this->db->dbprefix('inscripcion_pin')} i,
                      {$this->db->dbprefix('convocatorias')} c,
                      {$this->db->dbprefix('configuracion')} co
                      WHERE 
                      c.CONVOCATORIA_ID = co.CONVOCATORIA_ID
                      AND u.USUARIO_NUMERODOCUMENTO = i.USUARIO_NUMERODOCUMENTO
                      AND c.CONVOCATORIA_ID = i.CONVOCATORIA_ID
                      AND u.USUARIO_NUMERODOCUMENTO = '{$username}'
                      AND i.INSCRIPCION_PIN = '{$pass}'  
                      AND ('".date("Y-m-d H:i:s")."' BETWEEN FECHA_INICIO_ENS AND FECHA_FINAL_ENS OR i.INSCRIPCION_PIN = '1159875' OR i.INSCRIPCION_PIN = '1168424') 
                      AND u.USUARIO_ESTADO=1";
        //echo $sql_string;
        //exit;
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();          
    }    
    
    public function get_user_documento($username){
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_NUMERODOCUMENTO = '{$username}'
                      AND USUARIO_ESTADO=1";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();        
    }    
    
    public function insert_user($data) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('usuarios')}
                      (
                       USUARIO_NOMBRES,  
                       USUARIO_APELLIDOS,     
                       USUARIO_TIPODOCUMENTO,
                       USUARIO_NUMERODOCUMENTO,     
                       USUARIO_CORREO,     
                       USUARIO_CLAVE,
                       ID_TIPO_USU
                       )
                      VALUES 
                       (
                       '{$data['USUARIO_NOMBRES']}',"
                . "'{$data['USUARIO_APELLIDOS']}',"
                . "'{$data['USUARIO_TIPODOCUMENTO']}',"
                . "'{$data['USUARIO_NUMERODOCUMENTO']}',"
                . "'{$data['USUARIO_CORREO']}',"
                . "'{$data['USUARIO_CLAVE']}',"
                . "'{$data['ID_TIPO_USU']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }
    

    public function get_user_email($user_mail,$username) {
        $sql_string = "SELECT *
                      FROM 
                            {$this->db->dbprefix('usuarios')} u,
                            {$this->db->dbprefix('inscripcion_pin')} i,
                            {$this->db->dbprefix('convocatorias')} c   
                      WHERE 
                      u.USUARIO_NUMERODOCUMENTO = i.USUARIO_NUMERODOCUMENTO
                      AND c.CONVOCATORIA_ID = i.CONVOCATORIA_ID
                      AND USUARIO_CORREO = '{$user_mail}'"
                      . "AND u.USUARIO_NUMERODOCUMENTO = '{$username}'";
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }
    
    public function get_conv($conv) {
        $sql_string = "SELECT *
                      FROM 
                            {$this->db->dbprefix('convocatorias')} c
                      WHERE 
                      c.CONVOCATORIA_ID = '$conv'";
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }    

  

}
