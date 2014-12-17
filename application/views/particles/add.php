<div class="container bs-docs-container">
    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>

    <div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="active"><a href="<?php echo base_url('especificos') ?>">
                        <h4 class="list-group-item-heading">Paso 1</h4>
                        <p class="list-group-item-text">Documento Especificos (<?php echo $this->session->userdata('TIPO_DOCUMENTO_ID_1'); ?>)</p>
                    </a></li>
                <li class=""><a href="<?php echo base_url('formal') ?>">
                        <h4 class="list-group-item-heading">Paso 2</h4>
                        <p class="list-group-item-text">Educaci&oacute;n Formal (<?php echo $this->session->userdata('TIPO_DOCUMENTO_ID_2'); ?>)</p>
                    </a></li>
                <li class=""><a href="<?php echo base_url('noformal') ?>">
                        <h4 class="list-group-item-heading">Paso 3</h4>
                        <p class="list-group-item-text">Educaci&oacute;n no Formal (<?php echo $this->session->userdata('TIPO_DOCUMENTO_ID_3'); ?>)</p>
                    </a>
                </li>
                <li class=""><a href="<?php echo base_url('laboral') ?>">
                        <h4 class="list-group-item-heading">Paso 4</h4>
                        <p class="list-group-item-text">Experiencia Laboral (<?php echo $this->session->userdata('TIPO_DOCUMENTO_ID_4'); ?>)</p>
                    </a>
                </li>
                <li class=""><a href="<?php echo base_url('documentos/certificado') ?>">
                        <h4 class="list-group-item-heading">Paso 5</h4>
                        <p class="list-group-item-text">Descargar Certificado (<?php echo $this->session->userdata('TIPO_DOCUMENTO_ID_TOTAL'); ?>)</p>
                    </a>
                </li>            
            </ul>
        </div>
    </div>

    <div class="jumbotron">
        <div style="text-align: center">
            <img src="<?php echo base_url($this->session->userdata('CONVOCATORIA_IMAGEN')); ?>" style="width: 350px;">
        </div>
        <p>Aplicativo de Cargue de Documentos.</p>
        <p style="text-align: center"><strong><?php echo $this->session->userdata('CONVOCATORIA_NOMBRE'); ?></strong></p>

        <p style="font-size: 15px !important; text-align: justify !important;">
            <strong>PASOS PARA REALIZAR EL CARGUE DE ARCHIVOS</strong>
            <br>
            Para cargar los documentos, se debe tener en cuenta el siguiente procedimiento:
            <br>
            <strong>1.</strong> Los documentos deben ser escaneados en formato pdf.
            <br>
            <strong>2.</strong> Aseg&uacute;rese que el tama&ntilde;o del archivo sea de m&aacute;ximo de 2MB.
            <br>
            <strong>3.</strong> Pulse el icono de la opci&oacute;n "Cargar o Modificar" correspondiente al archivo que se desea adjuntar, 
            desplace la barra de desplazamiento hacia abajo y seleccione el archivo que contiene el documento a adjuntar.
            <br>
            <strong>4.</strong> Finalmente, pulse el bot&oacute;n "Subir Documento de Identidad o Subir Libreta Militar (seg&uacute;n sea el caso)" y 
            aseg&uacute;rese que le aparezca el mensaje "archivo adjuntado exitosamente".
            <br>
        <div style="text-align: center;color: #bc0101;font-size: 13px !important;">
            TENGA EN CUENTA ESTAS RECOMENDACIONES PARA CADA DOCUMENTO QUE VAYA A ADJUNTAR, 
            DE ESTO DEPENDE EL &Eacute;XITO DE LA ENTREGA Y RECEPCI&Oacute;N DE SUS DOCUMENTOS.
        </div>
        </p>    
    </div>

    <div class="page-header">
        <h1>Agregar Documento Obligatorio</h1>   
    </div>

    <?php
//echo '<pre>'.print_r($documents_particles_user,true).'</pre>';
    $document_1_ancla = '';
    $document_1_image = 'sin_documento_de_identidad.jpg';

    $document_2_ancla = '';
    $document_2_image = 'sin_libreta_militar.jpg';

    $document_3_ancla = '';
    $document_3_image = 'sin_matricula_profesional.jpg';

    $document_4_ancla = '';
    $document_4_image = 'sin_licencia_de_conduccion.jpg';

    foreach ($documents_particles_user as $document) {
        switch ($document->TIPO_DOCUMENTO_ID) {
            case 51:
                $document_1_ancla = 'href="especificos/view_document/' . encrypt_id($document->DOCUMENTO_ID) . '"';
                $document_1_image = 'documento_cargado.jpg';
                break;
            case 52:
                $document_2_ancla = 'href="especificos/view_document/' . encrypt_id($document->DOCUMENTO_ID) . '"';
                $document_2_image = 'documento_cargado.jpg';
                break;
            case 53:
                $document_3_ancla = 'href="especificos/view_document/' . encrypt_id($document->DOCUMENTO_ID) . '"';
                $document_3_image = 'documento_cargado.jpg';
                break;
            case 54:
                $document_4_ancla = 'href="especificos/view_document/' . encrypt_id($document->DOCUMENTO_ID) . '"';
                $document_4_image = 'documento_cargado.jpg';
                break;
        }
    }
    ?>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <tr>
                    <td>
                        <?php echo form_open_multipart('especificos/insert', 'id="particles_insert" class="form-signin" role="form" method="POST"'); ?>
                        <?php echo form_hidden('TIPO_DOCUMENTO_ID', '51'); ?>
                        <table>
                            <tr>
                                <td style="padding-right: 24px;">
                                    <a <?php echo $document_1_ancla; ?> target="_blank">
                                        <img class="img-rounded" alt="<?php echo $document_1_image; ?>" src="<?php echo base_url('images/vice/' . $document_1_image); ?>" style="width: 140px; height: 140px;">
                                    </a>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Documento de Identidad </label>
                                        <?php echo form_upload('userfile_51', '', 'id="userfile_1" class="filebase"') ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <button type="submit" data-loading-text="Enviando..." class="loading-example-btn btn btn-<?php echo ($document_1_ancla != '') ? 'info' : 'success'; ?>">
                                            Subir <?php echo ($document_1_ancla != '') ? 'de nuevo el' : ''; ?> Documento de Identidad
                                        </button>
                                        <?php if ($document_1_ancla != '') { ?>
                                            <a <?php echo $document_1_ancla; ?> target="_blank" class="btn btn-warning">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                                Ver Folio
                                            </a>
                                        <?php } ?>
                                    </div> 
                                </td>
                            </tr>
                        </table>
                        <?php echo form_close(); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo form_open_multipart('especificos/insert', 'id="particles_insert" class="form-signin" role="form" method="POST"'); ?>
                        <?php echo form_hidden('TIPO_DOCUMENTO_ID', '52'); ?>                    
                        <table>
                            <tr>
                                <td style="padding-right: 24px;">
                                    <a <?php echo $document_2_ancla; ?> target="_blank">
                                        <img class="img-rounded" alt="<?php echo $document_2_image; ?>" src="<?php echo base_url('images/vice/' . $document_2_image); ?>" style="width: 140px; height: 140px;">
                                    </a>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Libreta Militar </label>
                                        <?php echo form_upload('userfile_52', '', 'id="userfile_2" class="filebase"') ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <button type="submit" data-loading-text="Enviando..." class="loading-example-btn btn btn-<?php echo ($document_2_ancla != '') ? 'info' : 'success'; ?>">
                                            Subir <?php echo ($document_2_ancla != '') ? 'de nuevo la' : ''; ?> Libreta Militar
                                        </button>
                                        <?php if ($document_2_ancla != '') { ?>
                                            <a <?php echo $document_2_ancla; ?> target="_blank" class="btn btn-warning">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                                Ver Folio
                                            </a>
                                        <?php } ?>                                        
                                    </div> 
                                </td>
                            </tr>
                        </table>
                        <?php echo form_close(); ?>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <?php echo form_open_multipart('especificos/insert', 'id="particles_insert" class="form-signin" role="form" method="POST"'); ?>
                        <?php echo form_hidden('TIPO_DOCUMENTO_ID', '53'); ?>                    
                        <table>
                            <tr>
                                <td style="padding-right: 24px;">
                                    <a <?php echo $document_3_ancla; ?> target="_blank">
                                        <img class="img-rounded" alt="<?php echo $document_3_image; ?>" src="<?php echo base_url('images/vice/' . $document_3_image); ?>" style="width: 140px; height: 140px;">
                                    </a>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tarjeta/Matricula Profesional </label>
                                        <?php echo form_upload('userfile_53', '', 'id="userfile_3" class="filebase"') ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <button type="submit" data-loading-text="Enviando..." class="loading-example-btn btn btn-<?php echo ($document_3_ancla != '') ? 'info' : 'success'; ?>">
                                            Subir <?php echo ($document_3_ancla != '') ? 'de nuevo la' : ''; ?> Tarjeta/Matricula Profesional
                                        </button>
                                        <?php if ($document_3_ancla != '') { ?>
                                            <a <?php echo $document_3_ancla; ?> target="_blank" class="btn btn-warning">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                                Ver Folio
                                            </a>
                                        <?php } ?>                                        
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <?php echo form_close(); ?>
                    </td>
                </tr>  
                <tr>
                    <td>
                        <?php echo form_open_multipart('especificos/insert', 'id="particles_insert" class="form-signin" role="form" method="POST"'); ?>
                        <?php echo form_hidden('TIPO_DOCUMENTO_ID', '54'); ?>                    
                        <table>
                            <tr>
                                <td style="padding-right: 24px;">
                                    <a <?php echo $document_4_ancla; ?> target="_blank">
                                        <img class="img-rounded" alt="<?php echo $document_4_image; ?>" src="<?php echo base_url('images/vice/' . $document_4_image); ?>" style="width: 140px; height: 140px;">
                                    </a>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Licencia de Conducci&oacute;n </label>
                                        <?php echo form_upload('userfile_54', '', 'id="userfile_4" class="filebase"') ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <button type="submit" data-loading-text="Enviando..." class="loading-example-btn btn btn-<?php echo ($document_4_ancla != '') ? 'info' : 'success'; ?>">
                                            Subir <?php echo ($document_4_ancla != '') ? 'de nuevo la' : ''; ?> Licencia de Conducci&oacute;n
                                        </button>
                                        <?php if ($document_4_ancla != '') { ?>
                                            <a <?php echo $document_4_ancla; ?> target="_blank" class="btn btn-warning">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                                Ver Folio
                                            </a>
                                        <?php } ?>                                        
                                    </div> 
                                </td>
                            </tr>
                        </table>
                        <?php echo form_close(); ?>
                    </td>
                </tr>             
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p style="text-align: right !important;">
                <a href="<?php echo base_url("formal") ?>" class="btn btn-info" role="button">
                    Ir al paso 2: Educaci&oacute;n Formal
                </a>        
            </p>
        </div>    
    </div>
    <div class="row">
        <div class="col-md-12">
            <p style="text-align: center !important;">
                <a href="<?php echo base_url("ingreso/logout") ?>" class="btn btn-danger btn-sm" role="button">
                    Cerrar Sesi&oacute;n
                </a>        
            </p>
        </div>   
    </div>

</div>