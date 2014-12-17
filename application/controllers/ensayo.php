<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ensayo extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        //$this->module_sigla = 'USU';
        $this->load->model('user_model');
        //$this->load->model('register_model');
        $this->load->model('call_model');
        $this->load->model('ensayo_model');
        $this->load->helper('miscellaneous');
        //$this->load->library('My_RECAPTCHA');
        date_default_timezone_set('America/Bogota');
    }

    public function index() {
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata(array('message' => '<strong>Error</strong> Debe Iniciar una Sesion.', 'message_type' => 'danger'));
            redirect('ingreso/ensayo', 'refresh');
        } else {

            $id_user = $this->session->userdata('USUARIO_ID');
            $id_convocatoria = $this->session->userdata('CONVOCATORIA_ID');

            $data['title'] = 'Ensayo Virtual';
            $data['content'] = 'ensayo/add';

            $data['template_config'] = array(
                'signin' => 0,
                'menu' => 1,
                'bootstrap-theme' => 0,
                'jquery' => 1,
                'validate' => 1,
                'bootstrapjs' => 1
            );
            $this->load->view('template/template_ensayo', $data);
        }
    }

    public function umb_eva_ensayo($clave = 0, $pin = '') {
        if ($pin == '') {
            echo "NO SE ENCONTRO EL USUARIO";
        } else {
            if ($clave == 88706654126) {
                $data['ensayo'] = $this->ensayo_model->get_ensayo($pin);
                if (count($data['ensayo']) > 0) {
                    $data['title'] = 'Ensayo Virtual';
                    $data['content'] = 'ensayo/eva';

                    $data['template_config'] = array(
                        'signin' => 0,
                        'menu' => 1,
                        'bootstrap-theme' => 0,
                        'jquery' => 1,
                        'validate' => 1,
                        'bootstrapjs' => 1
                    );
                    $this->load->view('template/template_ensayo', $data);
                } else {
                    echo "ERROR: ENSAYO NO ENCONTRADO";
                }
            } else {
                echo "ERROR DE CLAVE";
            }
        }
    }

    public function insert() {
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata(array('message' => '<strong>Error</strong> Debe Iniciar una Sesion.', 'message_type' => 'danger'));
            redirect('ingreso/ensayo', 'refresh');
        } else {
            $id_user = $this->session->userdata('USUARIO_ID');
            $id_convocatoria = $this->session->userdata('CONVOCATORIA_ID');

            $data['convocatoria'] = $this->call_model->get_conv_ens($id_convocatoria, $this->session->userdata('INSCRIPCION_PIN'));

            if (count($data['convocatoria']) > 0) {


                //VERIFICAR LA EXISTENCIA DEL ENSAYO
                $data['ensayo'] = $this->ensayo_model->get_ensayo($this->session->userdata('INSCRIPCION_PIN'));
                if (count($data['ensayo']) == 0) {
                    $data = array(
                        'INSCRIPCION_PIN' => $this->session->userdata('INSCRIPCION_PIN'),
                        'ENSAYO_TEXTO' => '',
                        'ENSAYO_IP' => $_SERVER['REMOTE_ADDR'],
                        'ENSAYO_FECHA_MOD' => date("Y-m-d H:i:s")
                    );
                    $insert = $this->ensayo_model->insert($data);
                    if ($insert) {
                        $data['ensayo'] = $this->ensayo_model->get_ensayo($this->session->userdata('INSCRIPCION_PIN'));
                    } else {
                        $this->session->set_userdata('logged_in', FALSE);
                        $this->session->sess_destroy();
                        $this->session->set_flashdata(array('message' => 'Error al iniciar el ensayo, por favor intentelo de nuevo.', 'message_type' => 'danger'));
                        redirect('ingreso/ensayo', 'location');
                    }
                } else {
                    if ($this->input->post()) {
                        $data = array(
                            'INSCRIPCION_PIN' => $this->session->userdata('INSCRIPCION_PIN'),
                            'ENSAYO_TEXTO' => addslashes(mb_strtoupper($this->input->post('ENSAYO_TEXTO'), 'utf-8')),
                            'ENSAYO_FECHA_MOD' => date("Y-m-d H:i:s"),
                            'ENSAYO_FECHA' => $data['ensayo'][0]->ENSAYO_FECHA,
                            'MAXIMO_SEG_ENSAYO' => $this->session->userdata('MAXIMO_SEG_ENSAYO')
                        );
                        $update = $this->ensayo_model->update($data);
                        if ($update) {
                            $this->session->set_flashdata(array('message' => 'Exito al guardar el ensayo.', 'message_type' => 'info'));
                            redirect('ensayo/insert', 'location');
                        } else {
                            $this->session->set_flashdata(array('message' => 'Error al guardar el ensayo, fecha limite sobrepasada.', 'message_type' => 'danger'));
                            redirect('ensayo/insert', 'location');
                        }
                    }
                    //
                }
                if (count($data['ensayo']) > 0) {

                    $data['title'] = 'Ensayo Virtual';
                    $data['content'] = 'ensayo/new';
                    $data['template_config'] = array(
                        'signin' => 0,
                        'menu' => 1,
                        'bootstrap-theme' => 0,
                        'jquery' => 1,
                        'validate' => 1,
                        'bootstrapjs' => 1
                    );

                    $this->load->view('template/template_ensayo', $data);
                } else {
                    $this->session->set_userdata('logged_in', FALSE);
                    $this->session->sess_destroy();
                    $this->session->set_flashdata(array('message' => 'Error al consultar el ensayo, por favor intentelo de nuevo.', 'message_type' => 'danger'));
                    redirect('ingreso/ensayo', 'location');
                }
            } else {
                $this->session->set_userdata('logged_in', FALSE);
                $this->session->sess_destroy();
                $this->session->set_flashdata(array('message' => 'Ensayo fuera de fechas.', 'message_type' => 'danger'));
                redirect('ingreso/ensayo', 'location');
            }
        }
    }

    public function logout() {
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->sess_destroy();
        //$this->load->view('login/index');
        redirect('ingreso/ensayo', 'location');
    }

}
