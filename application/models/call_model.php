<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Call_model extends CI_Model {

    public function get_conv($conv,$INSCRIPCION_PIN = '') {
        $SQL = " AND '".date("Y-m-d H:i:s")."' BETWEEN FECHA_INICIO_INS AND FECHA_FINAL_INS ";
        if($INSCRIPCION_PIN == '1159875'){
            $SQL = '';
        }
        
        if($INSCRIPCION_PIN == '1168424'){
            $SQL = '';
        }    
        
        if($INSCRIPCION_PIN == '1168529'){
            $SQL = '';
        }    
        
        if($INSCRIPCION_PIN == '1168530'){
            $SQL = '';
        }   
        
        if($INSCRIPCION_PIN == '1163502'){
            $SQL = '';
        }   
        
        if($INSCRIPCION_PIN == '1168531'){
            $SQL = '';
        }   

		if($INSCRIPCION_PIN == '1168532'){
            $SQL = '';
        }
		
		if($INSCRIPCION_PIN == '1168533'){
            $SQL = '';
        }		
        
        $sql_string = "SELECT *
                      FROM 
                            {$this->db->dbprefix('convocatorias')} c,
                            {$this->db->dbprefix('configuracion')} co
                      WHERE
                      c.CONVOCATORIA_ID = co.CONVOCATORIA_ID
                      $SQL
                      AND c.CONVOCATORIA_ID = '$conv' LIMIT 1";
                           //echo $sql_string;
                           // exit();
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }
    
    public function get_conv_ens($conv,$INSCRIPCION_PIN = '') {
        $SQL = " AND '".date("Y-m-d H:i:s")."' BETWEEN FECHA_INICIO_ENS AND FECHA_FINAL_ENS ";
        if($INSCRIPCION_PIN == '1159875'){
            $SQL = '';
        }
        
        if($INSCRIPCION_PIN == '1168424'){
            $SQL = '';
        } 
        
        if($INSCRIPCION_PIN == '1168529'){
            $SQL = '';
        }          
        
        $sql_string = "SELECT *
                      FROM 
                            {$this->db->dbprefix('convocatorias')} c,
                            {$this->db->dbprefix('configuracion')} co
                      WHERE
                      c.CONVOCATORIA_ID = co.CONVOCATORIA_ID
                      $SQL
                      AND c.CONVOCATORIA_ID = '$conv' LIMIT 1";
                            //echo $sql_string;
                            //exit();
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }    

}
