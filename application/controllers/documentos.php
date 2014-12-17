<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documentos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        $this->load->model('register_model');
        $this->load->model('particles_model');
        $this->load->model('formal_model');
        $this->load->model('noformal_model');
        $this->load->model('laboral_model');
        validate_login($this->session->userdata('logged_in'));
        recalculate_uploaded_documents();
    }

    public function index() {
        redirect('', 'refresh');
    }

    public function certificado($view_pdf = 0) {
        $id_user = $this->session->userdata('USUARIO_ID');
        $id_convocatoria = $this->session->userdata('CONVOCATORIA_ID');

        if ($id_user != '') {
            $data['user'] = $this->register_model->get_user_inscription($id_user, $id_convocatoria);

            $data['documents_particles_user'] = $this->particles_model->get_documents_particles_user($this->session->userdata("INSCRIPCION_PIN"), 'ALL');
            $data['documents_formal_user'] = $this->formal_model->get_documents_formal_user($this->session->userdata("INSCRIPCION_PIN"), 'ALL');
            $data['documents_noformal_user'] = $this->noformal_model->get_documents_noformal_user($this->session->userdata("INSCRIPCION_PIN"), 'ALL');
            $data['documents_laboral_user'] = $this->laboral_model->get_documents_laboral_user($this->session->userdata("INSCRIPCION_PIN"), 'ALL');

            //echo '<pre>'.print_r($user,true).'</pre>';
            if (count($data['user']) > 0) {
                $data['title'] = 'Certificado de Registro';
                $data['content'] = 'documents/certified';

                $data['template_config'] = array(
                    'signin' => 0,
                    'menu' => 1,
                    'bootstrap-theme' => 0,
                    'jquery' => 1,
                    'validate' => 1,
                    'bootstrapjs' => 1
                );

                if ($view_pdf) {
                    $this->load->library('My_PDF');

                    //$DATA = $this->load->view('register/style_pdf', '',true);
                    $DATA = $this->load->view('documents/certified_pdf', $data, true);

                    //echo $DATA;
                    $path_file = 'certificado_de_cargue_de_documentos_' . $data['user'][0]->USUARIO_NUMERODOCUMENTO . '.pdf';

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
                $this->session->set_flashdata(array('message' => 'Error al cargar el certificado de inscripcion.', 'message_type' => 'danger'));
                redirect('', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Error al cargar el certificado de inscripcion.', 'message_type' => 'danger'));
            redirect('', 'refresh');
        }
    }

}
