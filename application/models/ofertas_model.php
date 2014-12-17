<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ofertas_model extends CI_Model {

    public function get_offer($id = 0) {
        $sql_string = "SELECT e.*,a.*,"
                . "( "
                . "SELECT GROUP_CONCAT(p.PERFIL_NOMBRE SEPARATOR ',') "
                . "FROM {$this->db->dbprefix('perfil')} p WHERE e.EMPLEO_ID = p.PERFIL_EMPLEO_ID "
                . ") PERFIL, "
                . "( "
                . "SELECT GROUP_CONCAT(r.REGIONAL_NOMBRE SEPARATOR '-') "
                . "FROM {$this->db->dbprefix('regional')} r,{$this->db->dbprefix('empleo_dep')} ed "
                . " WHERE r.REGIONAL_ID = ed.ID_REGIONAL AND ed.ID_EMPLEO = e.EMPLEO_ID "
                . ") REGIONES, "
                . "( "
                . "SELECT GROUP_CONCAT(CONCAT(r.REGIONAL_ID,',',r.REGIONAL_NOMBRE) SEPARATOR '-') "
                . "FROM {$this->db->dbprefix('regional')} r,{$this->db->dbprefix('empleo_dep')} ed "
                . " WHERE r.REGIONAL_ID = ed.ID_REGIONAL AND ed.ID_EMPLEO = e.EMPLEO_ID "
                . ") REGIONES_ID "
                . " FROM {$this->db->dbprefix('empleo')} e,"
                . "{$this->db->dbprefix('actividad')} a"
                . " WHERE e.EMPLEO_ESTADO=1 AND e.EMPLEO_ID = a.ACTIVIDAD_EMPLEO_ID"
                . " AND e.EMPLEO_ID = $id";
        //echo $sql_string;
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_offers($palabra_clave) {
        $where = '';
        if ($palabra_clave != 'Aleatorio') {
            $where = " AND ((SELECT GROUP_CONCAT(p.PERFIL_NOMBRE SEPARATOR ',') "
                    . "FROM {$this->db->dbprefix('perfil')} p WHERE e.EMPLEO_ID = p.PERFIL_EMPLEO_ID) LIKE '%$palabra_clave%' "
                    . "OR e.EMPLEO_DESCRIPCION LIKE '%$palabra_clave%' )";
        } else {
            $where = ' ORDER BY RAND() LIMIT 5 ';
        }

        $sql_string = "SELECT e.*,a.*,"
                . "( "
                . "SELECT GROUP_CONCAT(p.PERFIL_NOMBRE SEPARATOR ',') "
                . "FROM {$this->db->dbprefix('perfil')} p WHERE e.EMPLEO_ID = p.PERFIL_EMPLEO_ID "
                . ") PERFIL, "
                . "( "
                . "SELECT GROUP_CONCAT(r.REGIONAL_NOMBRE SEPARATOR '-') "
                . "FROM {$this->db->dbprefix('regional')} r,{$this->db->dbprefix('empleo_dep')} ed "
                . " WHERE r.REGIONAL_ID = ed.ID_REGIONAL AND ed.ID_EMPLEO = e.EMPLEO_ID "
                . ") REGIONES "
                . " FROM {$this->db->dbprefix('empleo')} e,"
                . "{$this->db->dbprefix('actividad')} a"
                . " WHERE e.EMPLEO_ESTADO=1 AND e.EMPLEO_ID = a.ACTIVIDAD_EMPLEO_ID"
                . "$where ";
        //echo $sql_string;
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_offers_groupperfil($palabra_clave, $limit) {
        $where = ' GROUP BY e.EMPLEO_ID ';
        if ($palabra_clave != 'Aleatorio') {
            $where = " AND ((SELECT GROUP_CONCAT(p.PERFIL_NOMBRE SEPARATOR ',') "
                    . "FROM {$this->db->dbprefix('perfil')} p WHERE e.EMPLEO_ID = p.PERFIL_EMPLEO_ID) LIKE '%$palabra_clave%' "
                    . "OR (SELECT GROUP_CONCAT(r.REGIONAL_NOMBRE SEPARATOR '-') "
                    . "FROM {$this->db->dbprefix('regional')} r,{$this->db->dbprefix('empleo_dep')} ed WHERE r.REGIONAL_ID = ed.ID_REGIONAL AND ed.ID_EMPLEO = e.EMPLEO_ID)  LIKE '%$palabra_clave%' "
                    . "OR e.EMPLEO_DESCRIPCION LIKE '%$palabra_clave%'"
                    . "OR e.EMPLEO_ID = '" . str_replace('UMB2014', '', $palabra_clave) . "') ";
        } else {
            $where = ' ORDER BY RAND() LIMIT ' . $limit;
        }

        $sql_string = "SELECT e.*,"
                . "( "
                . "SELECT GROUP_CONCAT(p.PERFIL_NOMBRE SEPARATOR ',') "
                . "FROM {$this->db->dbprefix('perfil')} p WHERE e.EMPLEO_ID = p.PERFIL_EMPLEO_ID "
                . ") PERFIL, "
                . "( "
                . "SELECT GROUP_CONCAT(r.REGIONAL_NOMBRE SEPARATOR '-') "
                . "FROM {$this->db->dbprefix('regional')} r,{$this->db->dbprefix('empleo_dep')} ed "
                . " WHERE r.REGIONAL_ID = ed.ID_REGIONAL AND ed.ID_EMPLEO = e.EMPLEO_ID "
                . ") REGIONES "
                . " FROM {$this->db->dbprefix('empleo')} e"
                . " WHERE  e.EMPLEO_ESTADO=1 "
                . "  $where ";
        //echo $sql_string;
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }
    
    public function get_regiones(){
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('regional')} ORDER BY REGIONAL_NOMBRE";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();        
    }

    public function insert_offer($data) {
        $sql_string = "SELECT * FROM {$this->db->dbprefix('oferta_ins')} WHERE INSCRIPCION_PIN='{$data['INSCRIPCION_PIN']}' AND EMPLEO_ID!='{$data['EMPLEO_ID']}' AND ESTADO=1 GROUP BY EMPLEO_ID";
        $sql_query = $this->db->query($sql_string);
        $resultado_1 = $sql_query->result();

        if (count($resultado_1) < $data['MAXIMO_EMPLEOS']) {
            $sql_string = "SELECT * FROM {$this->db->dbprefix('oferta_ins')} WHERE INSCRIPCION_PIN='{$data['INSCRIPCION_PIN']}' AND EMPLEO_ID='{$data['EMPLEO_ID']}'  AND ESTADO=1";
            $sql_query = $this->db->query($sql_string);
            $resultado_2 = $sql_query->result();

            if (count($resultado_2) < $data['MAXIMO_REGIONES']) {

                $sql_string = "SELECT * FROM {$this->db->dbprefix('oferta_ins')} WHERE INSCRIPCION_PIN='{$data['INSCRIPCION_PIN']}' AND EMPLEO_ID='{$data['EMPLEO_ID']}' AND REGIONAL_ID='{$data['REGIONAL_ID']}'  AND ESTADO=1";
                $sql_query = $this->db->query($sql_string);
                $resultado_3 = $sql_query->result();

                if (count($resultado_3) == 0) {
                    $SQL_string = "INSERT INTO {$this->db->dbprefix('oferta_ins')}
                      (
                       INSCRIPCION_PIN,
                       EMPLEO_ID,
                       REGIONAL_ID,
                       IP
                       )
                      VALUES 
                       (
                       '{$data['INSCRIPCION_PIN']}',"
                            . "'{$data['EMPLEO_ID']}',"
                            . "'{$data['REGIONAL_ID']}',
                            '".$_SERVER['REMOTE_ADDR']."' 
                       )
                       ";
                            //echo $SQL_string;
                    return $this->db->query($SQL_string);
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    
    public function delete_offer($offer){
        $sql_string = "UPDATE
                      {$this->db->dbprefix('oferta_ins')}
                      SET ESTADO = 0 WHERE OFERTAINS_ID=$offer";
        $sql_query = $this->db->query($sql_string);
    }

    /*     * ******************************************* */

    public function get_user_documento($username) {
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

    public function get_user_email($user_mail, $username) {
        $sql_string = "SELECT *
                      FROM 
                            {$this->db->dbprefix('usuarios')} u,
                            {$this->db->dbprefix('inscripcion_pin')} i
                      WHERE 
                      u.USUARIO_NUMERODOCUMENTO = i.USUARIO_NUMERODOCUMENTO
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
