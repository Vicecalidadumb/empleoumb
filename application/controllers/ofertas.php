<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ofertas extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        //$this->module_sigla = 'USU';
        $this->load->model('ofertas_model');
        $this->load->model('register_model');
        $this->load->model('call_model');
        $this->load->model('call_model');
        $this->load->helper('miscellaneous');

        $this->load->library('My_RECAPTCHA');
    }

    public function index($empleo = '') {
        $data['title'] = 'Ofertas de Empleos';

        $data['template_config'] = array(
            'signin' => 0,
            'menu' => 1,
            'bootstrap-theme' => 0,
            'jquery' => 1,
            'validate' => 1,
            'bootstrapjs' => 0
        );
        $data['validar_busqueda'] = 0;
        if ($this->input->post('empleo', TRUE) || $empleo != '') {
            $data['validar_busqueda'] = 1;

            if ($empleo != '') {
                //$data['palabra_clave'] = htmlentities(htmlspecialchars(urldecode($empleo)), ENT_QUOTES, "UTF-8");
                //$palabra_clave = htmlentities(htmlspecialchars(urldecode($empleo)), ENT_QUOTES, "UTF-8");
                $data['palabra_clave'] = base64_decode($empleo);
                $palabra_clave = base64_decode($empleo);
            } else {
                $data['palabra_clave'] = $this->input->post('empleo', TRUE);
                $palabra_clave = $this->input->post('empleo', TRUE);
            }
            $palabra_clave = str_replace("'", '', $palabra_clave);
            $palabra_clave = str_replace('"', '', $palabra_clave);
            $palabra_clave = addslashes($palabra_clave);

            //$data['ofertas_perfil'] = $this->ofertas_model->get_offers($palabra_clave);
            $data['ofertas'] = $this->ofertas_model->get_offers_groupperfil($palabra_clave, 5);
        } else {
            //$data['ofertas_perfil'] = $this->ofertas_model->get_offers('Aleatorio');
            $data['ofertas'] = $this->ofertas_model->get_offers_groupperfil('Aleatorio', 5);
        }

        $data['regiones'] = $this->ofertas_model->get_regiones('Aleatorio', 5);

        $data['content'] = 'jobs/index';
        $this->load->view('template/template_jobs', $data);
    }

    public function informacion($oferta = '') {
        if ($oferta != '') {
            $oferta = deencrypt_id_v2($oferta);
            $data['oferta'] = $this->ofertas_model->get_offer($oferta);

            if (count($data['oferta']) > 0) {

                $data['title'] = 'Información del Empleo UMBEMP' . str_pad($oferta, 3, "0", STR_PAD_LEFT);
                $data['ofertas'] = $this->ofertas_model->get_offers_groupperfil('Aleatorio', 3);
                $data['regiones'] = $this->ofertas_model->get_regiones('Aleatorio', 5);

                $data['template_config'] = array(
                    'signin' => 0,
                    'menu' => 1,
                    'bootstrap-theme' => 0,
                    'jquery' => 1,
                    'validate' => 1,
                    'bootstrapjs' => 0
                );

                $data['content'] = 'jobs/view';
                $this->load->view('template/template_jobs', $data);
            } else {
                $this->session->set_flashdata(array('message' => 'Error al consultar la oferta', 'message_type' => 'danger'));
                redirect('ofertas', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Error al consultar la oferta', 'message_type' => 'danger'));
            redirect('ofertas', 'refresh');
        }
    }

    public function aplicar($oferta = '') {
        if ($oferta != '') {
            if ($this->session->userdata('logged_in')) {
                $data['convocatoria'] = $this->call_model->get_conv($this->session->userdata('CONVOCATORIA_ID'));
                if (count($data['convocatoria']) > 0) {

                    $oferta = deencrypt_id_v2($oferta);
                    $data['oferta'] = $this->ofertas_model->get_offer($oferta);

                    if (count($data['oferta']) > 0) {

                        $ARRAY_regiones = explode('-', $data['oferta'][0]->REGIONES_ID);
                        $data_ = explode(',', $ARRAY_regiones[0]);
                        if (count($ARRAY_regiones) == 1) {
                            $data = array(
                                'INSCRIPCION_PIN' => $this->session->userdata('INSCRIPCION_PIN'),
                                'EMPLEO_ID' => $data['oferta'][0]->EMPLEO_ID,
                                'REGIONAL_ID' => trim($data_[0], '-'),
                                'MAXIMO_EMPLEOS' => $data['convocatoria'][0]->MAXIMO_EMPLEOS,
                                'MAXIMO_REGIONES' => $data['convocatoria'][0]->MAXIMO_REGIONES
                            );
                            $insert = $this->ofertas_model->insert_offer($data);
                            $this->session->set_flashdata(array('message' => 'Ofertas actualizadas con exito', 'message_type' => 'info'));
                            //exit();
                            redirect('ingreso/constancia', 'refresh');
                        }

                        $data['title'] = 'Información del Empleo UMBEMP' . str_pad($oferta, 3, "0", STR_PAD_LEFT);
                        $data['ofertas'] = $this->ofertas_model->get_offers_groupperfil('Aleatorio', 3);
                        $data['regiones'] = $this->ofertas_model->get_regiones('Aleatorio', 5);
                        $data['template_config'] = array(
                            'signin' => 0,
                            'menu' => 1,
                            'bootstrap-theme' => 0,
                            'jquery' => 1,
                            'validate' => 1,
                            'bootstrapjs' => 0
                        );

                        $data['content'] = 'jobs/add';
                        $this->load->view('template/template_jobs', $data);
                    } else {
                        $this->session->set_flashdata(array('message' => 'Error al consultar la oferta', 'message_type' => 'danger'));
                        redirect('ofertas', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata(array('message' => 'Convocatoria no encontrada o fuera de fechas.', 'message_type' => 'danger'));
                    redirect('', 'refresh');
                }
            } else {
                $this->session->set_flashdata(array('message' => 'Error al consultar la oferta', 'message_type' => 'danger'));
                redirect('ofertas', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Error al consultar la oferta', 'message_type' => 'danger'));
            redirect('ofertas', 'refresh');
        }
    }

    public function aplicar_insert($oferta = '') {
        if ($oferta != '') {
            if ($this->session->userdata('logged_in')) {
                $convocatoria = $this->call_model->get_conv($this->session->userdata('CONVOCATORIA_ID'));
                if (count($convocatoria) > 0) {

                    $oferta = deencrypt_id_v2($oferta);
                    $oferta = $this->ofertas_model->get_offer($oferta);
                    if (count($oferta) > 0) {

                        $ARRAY_regiones = explode('-', $oferta[0]->REGIONES_ID);
                        foreach ($ARRAY_regiones as $region) {
                            $separar = explode(',', $region);
                            $regiones[$separar[0]] = $separar[1];
                        }
                        $contador_regiones = 0;
                        for ($a = 1; $a <= $convocatoria[0]->MAXIMO_REGIONES; $a++) {
                            if ($this->input->post('region_' . $a) != '') {
                                $contador_regiones++;
                                $data = array(
                                    'INSCRIPCION_PIN' => $this->session->userdata('INSCRIPCION_PIN'),
                                    'EMPLEO_ID' => $oferta[0]->EMPLEO_ID,
                                    'REGIONAL_ID' => $this->input->post('region_' . $a),
                                    'MAXIMO_EMPLEOS' => $convocatoria[0]->MAXIMO_EMPLEOS,
                                    'MAXIMO_REGIONES' => $convocatoria[0]->MAXIMO_REGIONES
                                );
                                $insert = $this->ofertas_model->insert_offer($data);
                            }
                        }

                        $this->session->set_flashdata(array('message' => 'Ofertas actualizadas con exito', 'message_type' => 'info'));
                        redirect('ingreso/constancia', 'refresh');

                        if ($contador_regiones == 0) {
                            $this->session->set_flashdata(array('message' => 'Por favor seleccione almenos una region.', 'message_type' => 'danger'));
                            redirect('ofertas/aplicar/' . encrypt_id_v2($oferta[0]->EMPLEO_ID), 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata(array('message' => 'Error al consultar la oferta', 'message_type' => 'danger'));
                        redirect('ofertas', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata(array('message' => 'Convocatoria no encontrada o fuera de fechas.', 'message_type' => 'danger'));
                    redirect('', 'refresh');
                }
            } else {
                $this->session->set_flashdata(array('message' => 'Error al consultar la oferta', 'message_type' => 'danger'));
                redirect('ofertas', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Error al consultar la oferta', 'message_type' => 'danger'));
            redirect('ofertas', 'refresh');
        }
    }

    public function delete_offer($offer = '') {
        $data['convocatoria'] = $this->call_model->get_conv(1);
        if (count($data['convocatoria']) > 0) {
            $offer = deencrypt_id($offer);
            if ($offer != '') {
                $this->ofertas_model->delete_offer($offer);
                $this->session->set_flashdata(array('message' => 'Seleccion de Oferta Eliminada con Exito', 'message_type' => 'info'));
                redirect('registro/certificado', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al Eliminar la Oferta', 'message_type' => 'danger'));
                redirect('registro/certificado', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Eliminar la Oferta', 'message_type' => 'danger'));
            redirect('registro/certificado', 'refresh');
        }
    }

    /*     * ***************************************************** */

    public function add($conv = 1) {
        $conv = deencrypt_id_v2($conv);

        $data['convocatoria'] = $this->user_model->get_conv($conv);

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
                'bootstrap-theme' => 1,
                'jquery' => 1,
                'validate' => 1,
                'bootstrapjs' => 0
            );

            $data['content'] = 'register/add';
            $this->load->view('template/template', $data);
        } else {
            redirect('login/error404', 'refresh');
        }
    }

    public function document_check($document = 0, $convocatoria = 0) {
        $data['convocatoria'] = $this->user_model->get_conv($convocatoria);
        //FUNCION CREADA PARA VALIDAR LA CREACION DE USUARIOS DE UNA CONVOCATORIA.
        $user = $this->register_model->get_user_convocatoria($document, $convocatoria);
        if (count($user) > 0) {
            $this->form_validation->set_message('document_check', 'El usuario con documento <strong>' . $document . '</strong> ya se encuentra inscrito en la convocatoria: ' . $data['convocatoria'][0]->CONVOCATORIA_NOMBRE);
            return false;
        } else {
            return true;
        }
    }

    public function insert($conv = 1) {
        $conv = deencrypt_id($conv);
        $data['convocatoria'] = $this->user_model->get_conv($conv);

        if (count($data['convocatoria']) > 0) {

            $data['resp_captcha'] = '';
            $privatekey = "6LeZ8PUSAAAAAPOaXIcCLwoKxqWAJJ6sxEcQpYv0";
            $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $this->input->post('recaptcha_challenge_field', TRUE), $this->input->post('recaptcha_response_field', TRUE));

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

            if ($this->form_validation->run() == FALSE || !$resp->is_valid) {

                if (!$resp->is_valid) {
                    $data['resp_captcha'] = '<div class="alert alert-danger">
                                            Los caracteres representados en la imagen no se ha introducido correctamente. Por favor vuelva a intentarlo.
                                        </div> ';
                }

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
                    'bootstrap-theme' => 1,
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
                    'CONVOCATORIA_ID' => addslashes($this->input->post('CONVOCATORIA_ID', TRUE))
                );
                $insert = $this->register_model->insert_user($data);
                if ($insert) {
                    $this->session->set_flashdata(array('message' => 'Usuario agregado con exito', 'message_type' => 'info'));
                    redirect('register/view_certified/' . encrypt_id($insert) . '/' . encrypt_id($this->input->post('CONVOCATORIA_ID', TRUE)), 'refresh');
                } else {
                    $this->session->set_flashdata(array('message' => 'Error al agregar el registro', 'message_type' => 'danger'));
                    redirect('register/add', 'refresh');
                }
            }
        } else {
            redirect('login/error404', 'refresh');
        }
    }

    public function view_certified($id_user = '', $id_convocatoria = '') {
        $data['user'] = $this->register_model->get_user_inscription(deencrypt_id($id_user), deencrypt_id($id_convocatoria));
        //echo '<pre>'.print_r($user,true).'</pre>';
        if (count($data['user']) > 0) {
            $data['title'] = 'Certificado de Registro';
            $data['content'] = 'register/view_certified';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al cargar el certificado de inscripcion.', 'message_type' => 'danger'));
            redirect('', 'refresh');
        }
    }

    public function edit($id_user) {
        $id_user = deencrypt_id($id_user);

        validation_permission_role($this->module_sigla, 'permission_edit');

        $data['user'] = $this->user_model->get_user($id_user);
        if (count($data['user']) > 0) {
            $data['roles'] = get_dropdown($this->user_model->get_all_roles(), 'ID_TIPO_USU', 'NOM_TIPO_USU');
            $data['states'] = get_array_states();

            $data['title'] = 'Editar Usuario';
            $data['content'] = 'user/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('user', 'refresh');
        }
    }

    public function update() {
        validation_permission_role($this->module_sigla, 'permission_edit');

        if ($this->input->post('USUARIO_CLAVE', TRUE) != '') {
            $user_password = make_hash($this->input->post('USUARIO_CLAVE', TRUE));
            $user_id = $this->input->post('USUARIO_ID', TRUE);
            $this->user_model->update_user_password($user_password, $user_id);
        }

        $data = array(
            'USUARIO_ID' => $this->input->post('USUARIO_ID', TRUE),
            'USUARIO_NOMBRES' => $this->input->post('USUARIO_NOMBRES', TRUE),
            'USUARIO_APELLIDOS' => $this->input->post('USUARIO_APELLIDOS', TRUE),
            'USUARIO_TIPODOCUMENTO' => $this->input->post('USUARIO_TIPODOCUMENTO', TRUE),
            'USUARIO_NUMERODOCUMENTO' => $this->input->post('USUARIO_NUMERODOCUMENTO', TRUE),
            'USUARIO_CORREO' => $this->input->post('USUARIO_CORREO', TRUE),
            'ID_TIPO_USU' => $this->input->post('ID_TIPO_USU', TRUE)
        );
        $update = $this->user_model->update_user($data);

        if ($update) {
            $this->session->set_flashdata(array('message' => 'Usuario editado con exito', 'message_type' => 'info'));
            redirect('user', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al editar usuario', 'message_type' => 'warning'));
            redirect('user', 'refresh');
        }
    }

    /*     * ***********************AJAX FUNCTIONS************************** */

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

    public function check_user_mail_ajax() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $user_mail = $this->input->post('user_mail');
            if ($this->input->post('user_id') > 0) {
                $user_id = $this->input->post('user_id');
                $user = $this->user_model->get_user_email_userid($user_mail, $user_id);
            } else {
                $user = $this->user_model->get_user_email($user_mail);
            }
            if (sizeof($user) > 0) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }

    public function get_users_keyword() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $keyword = $this->input->get('q');
            $users = $this->user_model->get_users_keyword($keyword);
            echo json_encode($users);
        } else {
            echo 'Acceso no utorizado';
        }
    }

    public function get_users_core_keyword() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $keyword = $this->input->get('q');
            $users = $this->user_model->get_users_core_keyword($keyword);
            echo json_encode($users);
        } else {
            echo 'Acceso no utorizado';
        }
    }

    public function update_user_notes() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $notes = $this->input->post('notes');
//$this->session->userdata('user_notes') = $notes;
            $this->session->set_userdata('user_notes', $notes);
            $user_id = $this->session->userdata('user_id');
            $this->user_model->update_user_notes($notes, $user_id);
        } else {
            echo 'Acceso no utorizado';
        }
    }

}
