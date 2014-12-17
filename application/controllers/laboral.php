<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laboral extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        $this->load->model('laboral_model');
        validate_login($this->session->userdata('logged_in'));
        recalculate_uploaded_documents();
    }

    public function index() {
        $data['title'] = 'Aplicativo de Cargue de Documentos - Experiencia Laboral';
        $data['documents_laboral_user'] = $this->laboral_model->get_documents_laboral_user($this->session->userdata("INSCRIPCION_PIN"));
        $data['content'] = 'laboral/add';

        $data['modalidades'] = get_dropdown($this->laboral_model->get_modalidades(), 'MODALIDAD_ID', 'MODALIDAD_NOMBRE');

        $data['template_config'] = array(
            'signin' => 0,
            'menu' => 1,
            'bootstrap-theme' => 0,
            'jquery' => 1,
            'validate' => 1,
            'bootstrapjs' => 1
        );

        $this->load->view('template/template', $data);
    }

    public function insert() {
        date_default_timezone_set('America/Bogota');
        //echo '<pre>' . print_r($this->input->post()) . '</pre>';

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('UNIVERSIDAD', 'UNIVERSIDAD', 'required|trim');
        $this->form_validation->set_rules('CARGO', 'CARGO', 'required|min_length[2]|trim');
        $this->form_validation->set_rules('FECHA_INICIO', 'Fecha de Inicio', 'required|trim');
        $this->form_validation->set_rules('FECHA_FIN', 'Fecha de Terminaci&oacute;n', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Aplicativo de Cargue de Documentos - Experiencia Laboral';
            $data['documents_laboral_user'] = $this->laboral_model->get_documents_laboral_user($this->session->userdata("INSCRIPCION_PIN"));
            $data['content'] = 'laboral/add';

            $data['modalidades'] = get_dropdown($this->laboral_model->get_modalidades(), 'MODALIDAD_ID', 'MODALIDAD_NOMBRE');

            $data['template_config'] = array(
                'signin' => 0,
                'menu' => 1,
                'bootstrap-theme' => 0,
                'jquery' => 1,
                'validate' => 1,
                'bootstrapjs' => 1
            );

            $this->load->view('template/template', $data);
        } else {

            $TIPO_DOCUMENTO_ID = '4';
            $FECHA = date("Y_m_d_H_i_s");

            $config['upload_path'] = 'images/documentos';
            $config['allowed_types'] = 'pdf';
            $config['encrypt_name'] = FALSE;
            $config['max_size'] = '2000';
            $FINE_NAME = $this->session->userdata("CONVOCATORIA_ID") . '_' . $this->session->userdata("INSCRIPCION_PIN") . '_' . $TIPO_DOCUMENTO_ID . '_' . $FECHA;
            $config['file_name'] = $FINE_NAME;
            $this->load->library('upload', $config);


            $field_name = "userfile";

            if (!$this->upload->do_upload($field_name)) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata(array('message' => strip_tags($error), 'message_type' => 'danger'));
                redirect('laboral', 'refresh');
            } else {

                $upload_data = $this->upload->data();
                $pdf_name = $upload_data['file_name'];

                $data = array(
                    'INSCRIPCION_PIN' => $this->session->userdata("INSCRIPCION_PIN"),
                    'TIPO_DOCUMENTO_ID' => $TIPO_DOCUMENTO_ID,
                    'DOCUMENTO_NOMBRE' => $FINE_NAME,
                    'DOCUMENTO_FECHA' => $FECHA,
                    'DOCUMENTO_ESTADO' => '1',

                    'UNIVERSIDAD' => addslashes($this->input->post('UNIVERSIDAD', TRUE)),
                    'CARGO' => addslashes($this->input->post('CARGO', TRUE)),
                    'FECHA_INICIO' => addslashes($this->input->post('FECHA_INICIO', TRUE)),
                    'FECHA_FIN' => addslashes($this->input->post('FECHA_FIN', TRUE)),
                    'EMPLEO_ACTUAL' => addslashes($this->input->post('EMPLEO_ACTUAL', TRUE))
                );
                $insert = $this->laboral_model->insert_document($data);
                if ($insert) {
                    $this->session->set_flashdata(array('message' => 'Documento cargado con exito.', 'message_type' => 'info'));
                    redirect('laboral', 'refresh');
                } else {
                    $this->session->set_flashdata(array('message' => 'Error al insertar el documento', 'message_type' => 'error'));
                    redirect('laboral', 'refresh');
                }
            }
        }
    }

    public function view_document($DOCUMENTO_ID) {
        $DOCUMENTO_ID = deencrypt_id($DOCUMENTO_ID);
        $document = $this->laboral_model->get_document_user($this->session->userdata("INSCRIPCION_PIN"), $DOCUMENTO_ID);
        $file = $document[0]->DOCUMENTO_NOMBRE . '.pdf';
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $document[0]->INSCRIPCION_PIN . '_' . $document[0]->DOCUMENTO_FOLIO . '.pdf"');
        @readfile('images/documentos/' . $file);
    }

    public function delete_document($DOCUMENTO_ID) {
        $DOCUMENTO_ID = deencrypt_id($DOCUMENTO_ID);
        $this->laboral_model->delete_document_user($this->session->userdata("INSCRIPCION_PIN"), $DOCUMENTO_ID);
        $this->session->set_flashdata(array('message' => 'Documento Eliminado con Exito', 'message_type' => 'info'));
        redirect('laboral', 'refresh');
    }

}
