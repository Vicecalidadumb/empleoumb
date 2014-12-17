<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registro extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
//DEFINIMOS EL NOMBRE DEL MODULO
//$this->module_sigla = 'USU';
        $this->load->model('user_model');
        $this->load->model('register_model');
        $this->load->model('call_model');
        $this->load->helper('miscellaneous');
        //$this->load->library('My_RECAPTCHA');
    }

    public function index() {
        redirect('', 'refresh');
    }

    public function nuevo($conv = 1) {
        $conv = deencrypt_id($conv);

        $data['convocatoria'] = $this->call_model->get_conv($conv);

        if (count($data['convocatoria']) > 0) {
            $data['resp_captcha'] = '';
            $data['departments_1'] = get_dropdown($this->register_model->get_all_departments(), 'DEPARTAMENTO_ID', 'DEPARTAMENTO_NOMBRE');
            $data['departments_1'][''] = '--SELECCIONE UN DEPARTAMENTO--';
            asort($data['departments_1']);
            $data['departments_2'] = $data['departments_1'];
            $data['convocatorias'] = get_dropdown($this->register_model->get_all_calls(), 'CONVOCATORIA_ID', 'CONVOCATORIA_NOMBRE');
            $data['tipos_documentos'] = get_tipos_documentos();
            $data['title'] = 'Registro de Aspirantes';

            $data['template_config'] = array(
                'signin' => 0,
                'menu' => 1,
                'bootstrap-theme' => 0,
                'jquery' => 1,
                'validate' => 1,
                'bootstrapjs' => 1
            );

            $data['content'] = 'register/add';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Convocatoria no encontrada o fuera de fechas.', 'message_type' => 'danger'));
            redirect('', 'refresh');
        }
    }

    public function insert($conv = 1) {
        $conv = deencrypt_id($conv);
        $data['convocatoria'] = $this->call_model->get_conv($conv);

        if (count($data['convocatoria']) > 0) {
            $data_convocatoria = $data['convocatoria'];
            $data['resp_captcha'] = '';
            //$privatekey = "6LeZ8PUSAAAAAPOaXIcCLwoKxqWAJJ6sxEcQpYv0";
            //$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $this->input->post('recaptcha_challenge_field', TRUE), $this->input->post('recaptcha_response_field', TRUE));

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $this->form_validation->set_rules('USUARIO_TIPODOCUMENTO', 'Tipo de Documento', 'required|trim');
            $this->form_validation->set_rules('USUARIO_NOMBRES', 'Nombres', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('USUARIO_GENERO', 'Genero', 'required|trim');
            $this->form_validation->set_rules('USUARIO_DIRECCIONRESIDENCIA', 'Direccion', 'trim');
            $this->form_validation->set_rules('USUARIO_TELEFONOFIJO', 'Telefono', 'required|trim');
            $this->form_validation->set_rules('USUARIO_CORREO', 'Correo Electronico', 'trim');
            $this->form_validation->set_rules('USUARIO_CORREO_2', 'Correo Electronico', 'required|valid_email|trim');
            $this->form_validation->set_rules('USUARIO_NUMERODOCUMENTO', 'Numero de Documento', 'required|numeric|min_length[2]|trim|callback_document_check[' . $data['convocatoria'][0]->CONVOCATORIA_ID . ']');
            $this->form_validation->set_rules('USUARIO_APELLIDOS', 'Apellidos', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('USUARIO_FECHADENACIMIENTO', 'Fecha de Nacimiento', 'required|min_length[10]|trim');
            $this->form_validation->set_rules('USUARIO_LUGARDENACIMIENTO', 'Municipio de Nacimiento', 'required|trim');
            $this->form_validation->set_rules('USUARIO_LUGARDERESIDENCIA', 'Municipio de Residencia', 'required|trim');
            $this->form_validation->set_rules('USUARIO_CELULAR', 'Numero Celular', 'trim');

            //if ($this->form_validation->run() == FALSE || !$resp->is_valid) {
            if ($this->form_validation->run() == FALSE) {
                /*
                  if (!$resp->is_valid) {
                  $data['resp_captcha'] = '<div class="alert alert-danger">
                  Los caracteres representados en la imagen no se ha introducido correctamente. Por favor vuelva a intentarlo.
                  </div> ';
                  } */

                $data['departments_1'] = get_dropdown($this->register_model->get_all_departments(), 'DEPARTAMENTO_ID', 'DEPARTAMENTO_NOMBRE');
                $data['departments_1'][''] = '--SELECCIONE UN DEPARTAMENTO--';
                asort($data['departments_1']);
                $data['departments_2'] = $data['departments_1'];
                $data['convocatorias'] = get_dropdown($this->register_model->get_all_calls(), 'CONVOCATORIA_ID', 'CONVOCATORIA_NOMBRE');
                $data['tipos_documentos'] = get_tipos_documentos();
                $data['title'] = 'Registro de Aspirantes';

                $data['template_config'] = array(
                    'signin' => 0,
                    'menu' => 1,
                    'bootstrap-theme' => 0,
                    'jquery' => 1,
                    'validate' => 1,
                    'bootstrapjs' => 0
                );

                $data['content'] = 'register/add';
                $this->load->view('template/template', $data);
            } else {
                $data = array(
                    'USUARIO_TIPODOCUMENTO' => addslashes($this->input->post('USUARIO_TIPODOCUMENTO', TRUE)),
                    'USUARIO_NOMBRES' => addslashes(mb_strtoupper($this->input->post('USUARIO_NOMBRES', TRUE), 'utf-8')),
                    'USUARIO_GENERO' => addslashes($this->input->post('USUARIO_GENERO', TRUE)),
                    'USUARIO_DIRECCIONRESIDENCIA' => addslashes(mb_strtoupper($this->input->post('USUARIO_DIRECCIONRESIDENCIA', TRUE), 'utf-8')),
                    'USUARIO_TELEFONOFIJO' => addslashes($this->input->post('USUARIO_TELEFONOFIJO', TRUE)),
                    'USUARIO_CORREO' => addslashes(mb_strtoupper($this->input->post('USUARIO_CORREO', TRUE), 'utf-8')),
                    'USUARIO_NUMERODOCUMENTO' => addslashes($this->input->post('USUARIO_NUMERODOCUMENTO', TRUE)),
                    'USUARIO_APELLIDOS' => addslashes(mb_strtoupper($this->input->post('USUARIO_APELLIDOS', TRUE), 'utf-8')),
                    'USUARIO_FECHADENACIMIENTO' => addslashes($this->input->post('USUARIO_FECHADENACIMIENTO', TRUE)),
                    'USUARIO_LUGARDENACIMIENTO' => addslashes($this->input->post('USUARIO_LUGARDENACIMIENTO', TRUE)),
                    'USUARIO_LUGARDERESIDENCIA' => addslashes($this->input->post('USUARIO_LUGARDERESIDENCIA', TRUE)),
                    'USUARIO_CELULAR' => addslashes($this->input->post('USUARIO_CELULAR', TRUE)),
                    'CONVOCATORIA_ID' => $conv
                );
                $insert = $this->register_model->insert_user($data);
                if ($insert) {

                    $newdata = array(
                        'USUARIO_ID' => $insert['id_user'],
                        'USUARIO_NOMBRES' => $data['USUARIO_NOMBRES'],
                        'USUARIO_APELLIDOS' => $data['USUARIO_APELLIDOS'],
                        'USUARIO_TIPODOCUMENTO' => $data['USUARIO_TIPODOCUMENTO'],
                        'USUARIO_NUMERODOCUMENTO' => $data['USUARIO_NUMERODOCUMENTO'],
                        'USUARIO_CORREO' => $data['USUARIO_CORREO'],
                        'USUARIO_GENERO' => $data['USUARIO_GENERO'],
                        'USUARIO_FECHADENACIMIENTO' => $data['USUARIO_FECHADENACIMIENTO'],
                        'USUARIO_DIRECCIONRESIDENCIA' => $data['USUARIO_DIRECCIONRESIDENCIA'],
                        'USUARIO_TELEFONOFIJO' => $data['USUARIO_TELEFONOFIJO'],
                        'USUARIO_CELULAR' => $data['USUARIO_CELULAR'],
                        'USUARIO_ESTADO' => 1,
                        'CONVOCATORIA_NOMBRE' => $data_convocatoria[0]->CONVOCATORIA_NOMBRE,
                        'CONVOCATORIA_ID' => $data_convocatoria[0]->CONVOCATORIA_ID,
                        'CONVOCATORIA_IMAGEN' => $data_convocatoria[0]->CONVOCATORIA_IMAGEN,
                        'INSCRIPCION_PIN' => $insert['pin'],
                        'FECHA_INICIO_INS' => $data_convocatoria[0]->FECHA_INICIO_INS,
                        'FECHA_FINAL_INS' => $data_convocatoria[0]->FECHA_FINAL_INS,
                        'logged_in' => TRUE,
                        'politicas' => FALSE,
                        'TIPO_DOCUMENTO_ID_1' => 0,
                        'TIPO_DOCUMENTO_ID_2' => 0,
                        'TIPO_DOCUMENTO_ID_3' => 0,
                        'TIPO_DOCUMENTO_ID_4' => 0,
                        'TIPO_DOCUMENTO_ID_TOTAL' => 0
                    );
                    $this->session->set_userdata($newdata);

                    $this->session->set_flashdata(array('message' => 'Usuario agregado con exito, recuerde tomar nota del PIN para poder ingresar al sistema de cargue de documentos.', 'message_type' => 'info'));
                    if ($this->session->userdata('OFERTA_ACTIVA') && $this->session->userdata('OFERTA_ACTIVA') != '') {
                        //redirect('ofertas/informacion/' . $this->session->userdata('OFERTA_ACTIVA'), 'refresh');
                        redirect('registro/certificado', 'refresh');
                    } else {
                        //redirect('ofertas', 'refresh');
                        redirect('registro/certificado', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata(array('message' => 'Error al agregar el registro', 'message_type' => 'danger'));
                    redirect('registro/nuevo/MTM1MzM1MTMzODgz', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Convocatoria no encontrada o fuera de fechas.', 'message_type' => 'danger'));
            redirect('', 'refresh');
        }
    }

    public function certificado($view_pdf = '') {
        $id_user = $this->session->userdata('USUARIO_ID');
        $id_convocatoria = $this->session->userdata('CONVOCATORIA_ID');

        if ($id_user != '') {
            $data['user'] = $this->register_model->get_user_inscription($id_user, $id_convocatoria);
            $data['ofertas'] = $this->register_model->get_user_offers($data['user'][0]->INSCRIPCION_PIN);
            //echo '<pre>'.print_r($user,true).'</pre>';
            if (count($data['user']) > 0) {
                $data['title'] = 'Certificado de Registro';
                $data['content'] = 'register/view_certified';

                $data['template_config'] = array(
                    'signin' => 0,
                    'menu' => 1,
                    'bootstrap-theme' => 0,
                    'jquery' => 1,
                    'validate' => 1,
                    'bootstrapjs' => 1
                );

                if ($view_pdf == 1) {
                    $this->load->library('My_PDF');
                    $data['content'] = 'register/view_certified_pdf';
                    //$DATA = $this->load->view('register/style_pdf', '',true);
                    $DATA = $this->load->view('register/view_certified_pdf', $data, true);
                    $DATA = utf8_decode($DATA);
                    //echo $DATA;
                    $path_file = 'certificado_de_registro_' . $data['user'][0]->USUARIO_NUMERODOCUMENTO . '.pdf';

                    $html2pdf = new HTML2PDF('V', 'LETTER', 'fr', true, 'UTF-8', 0);
                    //$html2pdf->setModeDebug();
                    $html2pdf->pdf->SetDisplayMode('fullpage');
                    $html2pdf->setDefaultFont('Arial');
                    $html2pdf->writeHTML($DATA);
                    $html2pdf->Output($path_file);
                    echo $html2pdf;
                } else {
                    $this->load->view('template/template', $data);
                }
            } else {
                $this->session->set_flashdata(array('message' => 'Error 1: al cargar el certificado de inscripcion.', 'message_type' => 'danger'));
                //redirect('ofertas', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Error 2: al cargar el certificado de inscripcion.', 'message_type' => 'danger'));
            redirect('ofertas', 'refresh');
        }
    }

    public function editar() {
        $id_user = $this->session->userdata('USUARIO_ID');
        $id_convocatoria = $this->session->userdata('CONVOCATORIA_ID');

        $data['convocatoria'] = $this->call_model->get_conv($id_convocatoria,'1159875');

        if (count($data['convocatoria']) > 0) {

            if ($id_user != '') {
                $data['user'] = $this->register_model->get_user_inscription($id_user, $id_convocatoria);
                //$data['convocatoria'] = $this->call_model->get_conv($id_convocatoria);

                $data['departments_1'] = get_dropdown($this->register_model->get_all_departments(), 'DEPARTAMENTO_ID', 'DEPARTAMENTO_NOMBRE');
                $data['departments_1'][''] = '--SELECCIONE UN DEPARTAMENTO--';
                asort($data['departments_1']);

                $data['departments_2'] = $data['departments_1'];
                $data['convocatorias'] = get_dropdown($this->register_model->get_all_calls(), 'CONVOCATORIA_ID', 'CONVOCATORIA_NOMBRE');

                $data['mun'] = get_dropdown($this->register_model->get_all_cities('ALL'), 'MUNICIPIO_ID', 'MUNICIPIO_NOMBRE');

                $data['tipos_documentos'] = get_tipos_documentos();

                $data['title'] = 'Editar datos del Aspirantes';

                $data['template_config'] = array(
                    'signin' => 0,
                    'menu' => 1,
                    'bootstrap-theme' => 0,
                    'jquery' => 1,
                    'validate' => 1,
                    'bootstrapjs' => 1
                );

                $data['content'] = 'register/edit';
                $this->load->view('template/template', $data);
            } else {
                $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
                redirect('user', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Convocatoria no encontrada o fuera de fechas.', 'message_type' => 'danger'));
            redirect('', 'refresh');
        }
    }

    public function update() {
        $id_user = $this->session->userdata('USUARIO_ID');
        $id_convocatoria = $this->session->userdata('CONVOCATORIA_ID');
        $data['convocatoria'] = $this->call_model->get_conv($id_convocatoria,'1159875');

        if (count($data ['convocatoria']) > 0) {
            $data_convocatoria = $data['convocatoria'];
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $this->form_validation->set_rules('USUARIO_TIPODOCUMENTO', 'Tipo de Documento', 'required|trim');
            $this->form_validation->set_rules('USUARIO_NOMBRES', 'Nombres', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('USUARIO_GENERO', 'Genero', 'required|trim');
            $this->form_validation->set_rules('USUARIO_DIRECCIONRESIDENCIA', 'Direccion', 'trim');
            $this->form_validation->set_rules('USUARIO_TELEFONOFIJO', 'Telefono', 'required|trim');
            $this->form_validation->set_rules('USUARIO_CORREO', 'Correo Electronico', 'trim');
            $this->form_validation->set_rules('USUARIO_CORREO_2', 'Correo Electronico', 'required|valid_email|trim');
            $this->form_validation->set_rules('USUARIO_NUMERODOCUMENTO', 'Numero de Documento', 'required|numeric|min_length[2]|trim|callback_documentant_check[' . $data['convocatoria'][0]->CONVOCATORIA_ID . '-' . addslashes($this->input->post('USUARIO_NUMERODOCUMENTO_ANT', TRUE)) . ']');
            $this->form_validation->set_rules('USUARIO_APELLIDOS', 'Apellidos', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('USUARIO_FECHADENACIMIENTO', 'Fecha de Nacimiento', 'required|min_length[10]|trim');
            $this->form_validation->set_rules('USUARIO_LUGARDENACIMIENTO', 'Municipio de Nacimiento', 'required|trim');
            $this->form_validation->set_rules('USUARIO_LUGARDERESIDENCIA', 'Municipio de Residencia', 'required|trim');
            $this->form_validation->set_rules('USUARIO_CELULAR', 'Numero Celular', 'trim');

            if ($this->form_validation->run() == FALSE) {

                $data['user'] = $this->register_model->get_user_inscription($id_user, $id_convocatoria);
                $data['departments_1'] = get_dropdown($this->register_model->get_all_departments(), 'DEPARTAMENTO_ID', 'DEPARTAMENTO_NOMBRE');
                $data['departments_1'][''] = '--SELECCIONE UN DEPARTAMENTO--';
                asort($data['departments_1']);
                $data['departments_2'] = $data['departments_1'];
                $data['convocatorias'] = get_dropdown($this->register_model->get_all_calls(), 'CONVOCATORIA_ID', 'CONVOCATORIA_NOMBRE');
                $data['mun'] = get_dropdown($this->register_model->get_all_cities('ALL'), 'MUNICIPIO_ID', 'MUNICIPIO_NOMBRE');
                $data['tipos_documentos'] = get_tipos_documentos();
                $data['title'] = 'Editar datos del Aspirantes';
                $data['template_config'] = array(
                    'signin' => 0,
                    'menu' => 1,
                    'bootstrap-theme' => 0,
                    'jquery' => 1,
                    'validate' => 1,
                    'bootstrapjs' => 1
                );
                $data['content'] = 'register/edit';
                $this->load->view('template/template', $data);
            } else {
                $data = array(
                    'USUARIO_TIPODOCUMENTO' => addslashes($this->input->post('USUARIO_TIPODOCUMENTO', TRUE)),
                    'USUARIO_NOMBRES' => addslashes(mb_strtoupper($this->input->post('USUARIO_NOMBRES', TRUE), 'utf-8')),
                    'USUARIO_GENERO' => addslashes($this->input->post('USUARIO_GENERO', TRUE)),
                    'USUARIO_DIRECCIONRESIDENCIA' => addslashes(mb_strtoupper($this->input->post('USUARIO_DIRECCIONRESIDENCIA', TRUE), 'utf-8')),
                    'USUARIO_TELEFONOFIJO' => addslashes($this->input->post('USUARIO_TELEFONOFIJO', TRUE)),
                    'USUARIO_CORREO' => addslashes(mb_strtoupper($this->input->post('USUARIO_CORREO', TRUE), 'utf-8')),
                    'USUARIO_NUMERODOCUMENTO' => addslashes($this->input->post('USUARIO_NUMERODOCUMENTO', TRUE)),
                    'USUARIO_APELLIDOS' => addslashes(mb_strtoupper($this->input->post('USUARIO_APELLIDOS', TRUE), 'utf-8')),
                    'USUARIO_FECHADENACIMIENTO' => addslashes($this->input->post('USUARIO_FECHADENACIMIENTO', TRUE)),
                    'USUARIO_LUGARDENACIMIENTO' => addslashes($this->input->post('USUARIO_LUGARDENACIMIENTO', TRUE)),
                    'USUARIO_LUGARDERESIDENCIA' => addslashes($this->input->post('USUARIO_LUGARDERESIDENCIA', TRUE)),
                    'USUARIO_CELULAR' => addslashes($this->input->post('USUARIO_CELULAR', TRUE)),
                    'CONVOCATORIA_ID' => $id_convocatoria,
                    'USUARIO_ID' => addslashes($this->input->post('USUARIO_ID', TRUE)),
                    'INSCRIPCION_PIN' => addslashes($this->input->post('INSCRIPCION_PIN', TRUE)),
                );
                $insert = $this->register_model->update_user($data);
                if ($insert) {
                    $this->session->set_userdata('USUARIO_NOMBRES', $data['USUARIO_NOMBRES']);
                    $this->session->set_userdata('USUARIO_APELLIDOS', $data['USUARIO_APELLIDOS']);
                    $this->session->set_userdata('USUARIO_TIPODOCUMENTO', $data['USUARIO_TIPODOCUMENTO']);
                    $this->session->set_userdata('USUARIO_NUMERODOCUMENTO', $data['USUARIO_NUMERODOCUMENTO']);
                    $this->session->set_userdata('USUARIO_CORREO', $data['USUARIO_CORREO']);
                    $this->session->set_userdata('USUARIO_GENERO', $data['USUARIO_GENERO']);
                    $this->session->set_userdata('USUARIO_FECHADENACIMIENTO', $data['USUARIO_FECHADENACIMIENTO']);
                    $this->session->set_userdata('USUARIO_DIRECCIONRESIDENCIA', $data['USUARIO_DIRECCIONRESIDENCIA']);
                    $this->session->set_userdata('USUARIO_TELEFONOFIJO', $data['USUARIO_TELEFONOFIJO']);
                    $this->session->set_userdata('USUARIO_CELULAR', $data['USUARIO_CELULAR']);
                    $this->session->set_flashdata(array('message' => 'Usuario editado con exito.', 'message_type' => 'info'));

                    redirect('registro/editar', 'refresh');
                } else {
                    $this->session->set_flashdata(array('message' => 'Error al editado el registro', 'message_type' => 'danger'));
                    redirect('registro/editar', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Convocatoria no encontrada o fuera de fechas.', 'message_type' => 'danger'));
            redirect('registro/editar', 'refresh');
        }
    }

    /*     * ************************************** FUNCIONES AJAX ****************************************** */

    public function document_check($document = 0, $convocatoria = 0) {
        $data['convocatoria'] = $this->call_model->get_conv($convocatoria);
        //FUNCION CREADA PARA VALIDAR LA CREACION DE USUARIOS DE UNA CONVOCATORIA.
        $user = $this->register_model->get_user_convocatoria($document, $convocatoria);
        if (count($user) > 0) {
            $this->form_validation->set_message('document_check', 'El usuario con documento <strong>' . $document . '</strong> ya se encuentra inscrito en la convocatoria: ' . $data['convocatoria'][0]->CONVOCATORIA_NOMBRE);
            return false;
        } else {
            return true;
        }
    }

    public function documentant_check($document = 0, $convocatoria = 0) {

        $array = explode('-', $convocatoria);
        $convocatoria = $array[0];
        $documentant = $array[1];

        $data['convocatoria'] = $this->call_model->get_conv($convocatoria);
        //FUNCION CREADA PARA VALIDAR LA CREACION DE USUARIOS DE UNA CONVOCATORIA.
        $user = $this->register_model->get_userant_convocatoria($document, $convocatoria, $documentant);
        if (count($user) > 0) {
            $this->form_validation->set_message('documentant_check', 'El usuario con documento <strong>' . $document . '</strong> ya se encuentra inscrito en la convocatoria: ' . $data['convocatoria'][0]->CONVOCATORIA_NOMBRE);
            return false;
        } else {
            return true;
        }
    }

    public function get_mun() {

        if ($this->input->is_ajax_request()) {

            $id_dep = $this->input->post('dep');
            $select = $this->input->post('select');
            $index = $this->input->post('index');

            if ($id_dep > 0) {
                $mun = get_dropdown($this->register_model->get_all_cities($id_dep), 'MUNICIPIO_ID', 'MUNICIPIO_NOMBRE');
                echo form_dropdown($select, $mun, ' ', 'class="form-control" tabindex=' . $index);
            } else {
                echo form_dropdown($select, array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), ' ', 'class="form-control" tabindex=' . $index);
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }

}
