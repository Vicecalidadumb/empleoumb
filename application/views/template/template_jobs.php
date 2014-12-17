<?php
$this->load->view('template/head');
if ($template_config['menu'])
    $this->load->view('template/menu_jobs');
$this->load->view($content);
$this->load->view('template/footer_jobs');
