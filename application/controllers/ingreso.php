<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ingreso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('config_model');
        $this->load->helper('security');
        $this->load->helper('miscellaneous');
        //$this->load->library('My_PHPMailer');
        date_default_timezone_set('America/Bogota');
    }

    public function index() {
        redirect('', 'refresh');
    }

    public function mantenimiento() {
        $data['title'] = 'Pagina en Mantenimiento';

        $data['template_config'] = array(
            'signin' => 0,
            'menu' => 0,
            'bootstrap-theme' => 0,
            'jquery' => 0,
            'validate' => 0,
            'bootstrapjs' => 0
        );

        $data['content'] = 'login/mantenimiento';
        $this->load->view('template/template', $data);
    }

    public function error404() {
        $data['title'] = 'Error 404';

        $data['template_config'] = array(
            'signin' => 0,
            'menu' => 0,
            'bootstrap-theme' => 0,
            'jquery' => 0,
            'validate' => 0,
            'bootstrapjs' => 0
        );

        $data['content'] = 'login/404';
        $this->load->view('template/template', $data);
    }

    public function constancia($conv = 'NzM4NzY5MTE2NjMx') {
        $conv = deencrypt_id($conv);

        if ($this->session->userdata('logged_in')) {
            redirect('registro/certificado', 'refresh');
        } else {

            $data['convocatoria'] = $this->user_model->get_conv($conv);

            if (count($data['convocatoria']) > 0) {
                $data['title'] = 'Constancia de Inscripcion';

                $data['template_config'] = array(
                    'signin' => 1,
                    'menu' => 0,
                    'bootstrap-theme' => 0,
                    'jquery' => 0,
                    'validate' => 0,
                    'bootstrapjs' => 0
                );

                $data['content'] = 'login/certified';
                $this->load->view('template/template', $data);
            } else {
                redirect('ingreso/error404', 'refresh');
            }
        }
    }

    public function ensayo($conv = 'NzM4NzY5MTE2NjMx') {
        $conv = deencrypt_id($conv);

        $data['convocatoria'] = $this->user_model->get_conv($conv);

        $data['title'] = 'Constancia de Inscripcion';

        $data['template_config'] = array(
            'signin' => 1,
            'menu' => 0,
            'bootstrap-theme' => 0,
            'jquery' => 1,
            'validate' => 1,
            'bootstrapjs' => 0
        );

        $data['content'] = 'login/ensayo';
        $this->load->view('template/template', $data);
    }

    public function editar_datos($conv = 'NzM4NzY5MTE2NjMx') {
        $conv = deencrypt_id($conv);

        if ($this->session->userdata('logged_in')) {
            redirect('registro/editar', 'refresh');
        } else {

            $data['convocatoria'] = $this->user_model->get_conv($conv);

            if (count($data['convocatoria']) > 0) {
                $data['title'] = 'Constancia de Inscripcion';

                $data['template_config'] = array(
                    'signin' => 1,
                    'menu' => 0,
                    'bootstrap-theme' => 0,
                    'jquery' => 0,
                    'validate' => 0,
                    'bootstrapjs' => 0
                );

                $data['content'] = 'login/edit';
                $this->load->view('template/template', $data);
            } else {
                redirect('ingreso/error404', 'refresh');
            }
        }
    }

    public function convocatoria($conv = 'NzM4NzY5MTE2NjMx', $oferta = '') {
        $conv = deencrypt_id($conv);
        if ($this->session->userdata('logged_in')) {
            redirect('escritorio', 'refresh');
        } else {
            if ($oferta != '') {

                $newdata = array(
                    'OFERTA_ACTIVA' => $oferta
                );
                if ($this->session->userdata('OFERTA_ACTIVA'))
                    $this->session->set_userdata('OFERTA_ACTIVA', $oferta);
                else
                    $this->session->set_userdata($newdata);
            }
            $data['convocatoria'] = $this->user_model->get_conv($conv);

            if (count($data['convocatoria']) > 0) {
                $data['title'] = 'Ingreso al Aplicativo';

                $data['template_config'] = array(
                    'signin' => 1,
                    'menu' => 0,
                    'bootstrap-theme' => 0,
                    'jquery' => 1,
                    'validate' => 1,
                    'bootstrapjs' => 1
                );
                $data['content'] = 'login/index';
                $this->load->view('template/template', $data);
            } else {
                redirect('ingreso/error404', 'refresh');
            }
        }
    }

    public function recordar_pin($conv = 'NzM4NzY5MTE2NjMx') {
        $conv = deencrypt_id($conv);

        $data['convocatoria'] = $this->user_model->get_conv($conv);

        if (count($data['convocatoria']) > 0) {
            $data['title'] = 'Recordatorio PIN';

            $data['template_config'] = array(
                'signin' => 1,
                'menu' => 0,
                'bootstrap-theme' => 0,
                'jquery' => 1,
                'validate' => 1,
                'bootstrapjs' => 1
            );

            $data['content'] = 'login/pin';
            $this->load->view('template/template', $data);
        } else {
            redirect('ingreso/error404', 'refresh');
        }
    }

    public function recordar_pin_envio() {
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $user = $this->user_model->get_user_email($email, $username);
        //$mail = 
        if (sizeof($user) > 0) {

            $this->session->set_flashdata(array('message' => 'Su numero de PIN es: ' . $user[0]->INSCRIPCION_PIN . ', recuerde guardarlo para poder ingresar al aplicativo.', 'message_type' => 'pin'));
            redirect('ingreso/recordar_pin', 'refresh');

            ////////ENVIO POR CORREO ELECTRONICO
            //echo '<pre>' . print_r($user, true) . '</pre>';
            /*
              $mails_destinations = array($user[0]->USUARIO_CORREO => $user[0]->USUARIO_NOMBRES . ' ' . $user[0]->USUARIO_APELLIDOS);
              $subject = "Recordatorio PIN - " . str_replace('&oacute;', 'o', $user[0]->CONVOCATORIA_NOMBRE);
              $message = "Sr(a). <strong>" . $user[0]->USUARIO_NOMBRES . ' ' . $user[0]->USUARIO_APELLIDOS . "</strong><br><br>";
              $message.= "Recibimos en la Universidad Manuela Beltr&aacute;n una solicitud para recordatorio de PIN.<br>";
              $message.= "Su numero de PIN es: <strong>" . $user[0]->INSCRIPCION_PIN . "</strong><br><br><br>";
              $message.= "<span style='color: #328bb0;font-size: 11px;'>Antes de imprimir este e-mail piense bien si es necesario hacerlo.
              La protecci&oacute;n del medio ambiente es compromiso de todos.<br><br>
              Aviso de Confidencialidad de Email :Este mensaje puede contener informaci&oacute;n privilegiada y/o confidencial.
              Si usted no es el destinatario indicado en este mensaje (o el responsable de hacer llegar este mensaje al destinatario),
              no est&aacute; autorizado para copiar o entregar este mensaje a ninguna persona. En este caso, deber&aacute; destruir
              este mensaje y se le ruega que avise al remitente por e-mail. Por favor, av&iacute;senos de inmediato si usted o su empresa
              no admite la utilizaci&oacute;n de correo electr&oacute;nico por Internet para mensajes de este tipo. Cualquier opini&oacute;n,
              conclusi&oacute;n, u otra informaci&oacute;n contenida en este mensaje, que no est&eacute; relacionada con las actividades
              oficiales de nuestra firma, deber&aacute; considerarse como nunca proporcionada o aprobada por la firma.
              <br><br>
              Internet Email Confidentiality Footer :Privileged/Confidential information may be contained in this message.
              If you are not the addressee indicated in this message (or responsible for delivery of the message to such person),
              you may not copy or deliver this message to anyone. In such case, you should destroy this message and kindly notify
              the sender by reply email. Please advise immediately if you or you employer does not consent to internet email for
              messages of this kind. Opinions, conclusions and other information in this message that are not related to the
              official business of my firm shall be understood as neither given nor endorsed by it.</span>";

              $path_attachment = array();
              $mail_hostdime = 'vicecalidad@umb.edu.co';

              $return_mail = send_mail($mails_destinations, $subject, $message, $path_attachment, $mail_hostdime);


              if ($return_mail == 1) {
              $this->session->set_flashdata(array('message' => 'Su PIN a sido enviado al correo electronico ' . $user[0]->USUARIO_CORREO . ', por favor revise la carpeta de Spam ya que hotmail y/o otros puede poner nuestro email en esta carpeta.', 'message_type' => 'info'));
              redirect('ingreso/recordar_pin', 'refresh');
              } else {
              $this->session->set_flashdata(array('message' => 'Error al ', 'message_type' => 'danger'));
              redirect('ingreso/recordar_pin', 'refresh');
              }
             * 
             */
        } else {
            $this->session->set_flashdata(array('message' => 'Error al consultar el registro, por favor intente nuevamente', 'message_type' => 'warning'));
            redirect('ingreso/recordar_pin', 'refresh');
        }
    }

    public function make_hash($var = 1) {
        echo make_hash($var);
    }

    public function politicasok() {
        $this->session->set_userdata('politicas', TRUE);
        redirect('especificos', 'location');
    }

    public function verify() {
        $username = $this->input->post('username');
        $pass = strip_tags(utf8_decode($this->input->post('password')));
        $user = $this->user_model->get_user_documento($username);
        $user_loginpin = $this->user_model->get_user_loginpin($username, $pass);

        if ($this->input->post('ensayo'))
            $user_loginpin = $this->user_model->get_user_loginpin_ens($username, $pass);
        
        if ($this->input->post('edit'))
            $user_loginpin = $this->user_model->get_user_loginpin_nodate($username, $pass);  
        
        if ($this->input->post('certified'))
            $user_loginpin = $this->user_model->get_user_loginpin_nodate($username, $pass);        

        if (sizeof($user) > 0) {

            //if (verifyHash($pass, $user[0]->USUARIO_CLAVE) || check_password($pass, $user[0]->USUARIO_CLAVE) || $pass==$user[0]->USUARIO_CLAVE2) {
            if (sizeof($user_loginpin) > 0) {

                //OBTENER PERMISOS DE MODULOS PARA EL ROL ACTUAL
                $rol_permissions = $this->config_model->get_rol_permissions($user[0]->ID_TIPO_USU, 'SIGLA_MODULO');

                //echo print_r($user,true);
                $newdata = array(
                    'USUARIO_ID' => $user_loginpin[0]->USUARIO_ID,
                    'USUARIO_NOMBRES' => $user_loginpin[0]->USUARIO_NOMBRES,
                    'USUARIO_APELLIDOS' => $user_loginpin[0]->USUARIO_APELLIDOS,
                    'USUARIO_TIPODOCUMENTO' => $user_loginpin[0]->USUARIO_TIPODOCUMENTO,
                    'USUARIO_NUMERODOCUMENTO' => $user_loginpin[0]->USUARIO_NUMERODOCUMENTO,
                    'USUARIO_CORREO' => $user_loginpin[0]->USUARIO_CORREO,
                    'USUARIO_GENERO' => $user_loginpin[0]->USUARIO_GENERO,
                    'USUARIO_FECHADENACIMIENTO' => $user_loginpin[0]->USUARIO_FECHADENACIMIENTO,
                    'USUARIO_DIRECCIONRESIDENCIA' => $user_loginpin[0]->USUARIO_DIRECCIONRESIDENCIA,
                    'USUARIO_TELEFONOFIJO' => $user_loginpin[0]->USUARIO_TELEFONOFIJO,
                    'USUARIO_CELULAR' => $user_loginpin[0]->USUARIO_CELULAR,
                    'USUARIO_ESTADO' => $user_loginpin[0]->USUARIO_ESTADO,
                    'USUARIO_FECHAINGRESO' => $user_loginpin[0]->USUARIO_FECHAINGRESO,
                    'CONVOCATORIA_NOMBRE' => $user_loginpin[0]->CONVOCATORIA_NOMBRE,
                    'CONVOCATORIA_ID' => $user_loginpin[0]->CONVOCATORIA_ID,
                    'CONVOCATORIA_IMAGEN' => $user_loginpin[0]->CONVOCATORIA_IMAGEN,
                    'INSCRIPCION_PIN' => $user_loginpin[0]->INSCRIPCION_PIN,
                    'FECHA_INICIO_INS' => $user_loginpin[0]->FECHA_INICIO_INS,
                    'FECHA_FINAL_INS' => $user_loginpin[0]->FECHA_FINAL_INS,
                    'FECHA_INICIO_ENS' => $user_loginpin[0]->FECHA_INICIO_ENS,
                    'FECHA_FINAL_ENS' => $user_loginpin[0]->FECHA_FINAL_ENS,                    
                    'MAXIMO_SEG_ENSAYO' => $user_loginpin[0]->MAXIMO_SEG_ENSAYO,
                    'ID_TIPO_USU' => $user_loginpin[0]->ID_TIPO_USU,
                    'rol_permissions' => $rol_permissions,
                    'logged_in' => TRUE,
                    'politicas' => FALSE,
                    'TIPO_DOCUMENTO_ID_1' => 0,
                    'TIPO_DOCUMENTO_ID_2' => 0,
                    'TIPO_DOCUMENTO_ID_3' => 0,
                    'TIPO_DOCUMENTO_ID_4' => 0,
                    'TIPO_DOCUMENTO_ID_TOTAL' => 0
                );
                //echo print_r($newdata,true);

                $this->session->set_userdata($newdata);
                //echo print_y($this->session->userdata('logged_in'));
                if ($this->input->post('certified')) {
                    redirect('registro/certificado', 'refresh');
                } elseif ($this->input->post('edit')) {
                    redirect('registro/editar', 'refresh');
                } elseif ($this->input->post('ensayo')) {
                    redirect('ensayo', 'refresh');
                } else {
                    redirect('escritorio', 'location');
                }
            } else {
                $this->session->set_flashdata(array('message' => '<strong>Error:</strong> Error al ingresar.', 'message_type' => 'danger'));

                if ($this->input->post('certified')) {
                    redirect('ingreso/constancia', 'refresh');
                } elseif ($this->input->post('edit')) {
                    redirect('ingreso/editar_datos', 'refresh');
                } elseif ($this->input->post('ensayo')) {
                    redirect('ingreso/ensayo', 'refresh');
                } else {
                    redirect('', 'location');
                }
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Su n&uacute;mero de documento no se encuentra registrado en el sistema', 'message_type' => 'warning'));

            if ($this->input->post('certified')) {
                redirect('ingreso/constancia', 'refresh');
            } elseif ($this->input->post('edit')) {
                redirect('ingreso/editar_datos', 'refresh');
            } elseif ($this->input->post('ensayo')) {
                redirect('ingreso/ensayo', 'refresh');
            } else {
                redirect('', 'location');
            }
        }
    }

    public function logout() {
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->sess_destroy();
        //$this->load->view('login/index');
        redirect('/ofertas', 'location');
    }

}
