<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ensayo_model extends CI_Model {

    public function get_ensayo($INSCRIPCION_PIN) {
        $sql_string = "SELECT *
                      FROM 
                            {$this->db->dbprefix('ensayo')} e
                      WHERE
                      INSCRIPCION_PIN = $INSCRIPCION_PIN AND ENSAYO_ESTADO=1";
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function insert($data) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('ensayo')}
                      (
                        INSCRIPCION_PIN,
                        ENSAYO_TEXTO,
                        ENSAYO_IP
                       )
                      VALUES 
                       (
                        '{$data['INSCRIPCION_PIN']}',
                        '{$data['ENSAYO_TEXTO']}',
                        '{$data['ENSAYO_IP']}'
                        )";
        return $this->db->query($SQL_string);
    }

    public function update($data) {

        //VALIDAR TIEMPO MAXIMO PARA LA PRUEBA
        $tiempo_restante = strtotime(date("Y-m-d H:i:s")) - strtotime($data['ENSAYO_FECHA']);
        $segundos_transcurridos = $data['MAXIMO_SEG_ENSAYO'] - $tiempo_restante;

        if ($segundos_transcurridos > 0) {
            $SQL_string = "UPDATE  {$this->db->dbprefix('ensayo')}
                      SET
                        ENSAYO_TEXTO='{$data['ENSAYO_TEXTO']}',
                        ENSAYO_FECHA_MOD='{$data['ENSAYO_FECHA_MOD']}'
                      WHERE 
                        INSCRIPCION_PIN='{$data['INSCRIPCION_PIN']}'
                       ";
            return $this->db->query($SQL_string);
        } else {
            return 0;
        }
    }

}
