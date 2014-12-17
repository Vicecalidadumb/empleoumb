<div class="container bs-docs-container">
    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>

    <?php echo validation_errors(); ?>

    <div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class=""><a href="<?php echo base_url('especificos') ?>">
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
                <li class="active"><a href="<?php echo base_url('laboral') ?>">
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
        <h1>Experiencia Laboral</h1>
    </div>

    <div class="row">
        <?php if (count($documents_laboral_user) > 0) { ?>
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td style="font-weight: bold !important;">
                                No. Folio
                            </td>
                            <td style="font-weight: bold !important;">
                                Entidad
                            </td>
                            <td style="font-weight: bold !important;">
                                Cargo
                            </td>
                            <td style="font-weight: bold !important;">
                                Fecha de Inicio
                            </td>
                            <td style="font-weight: bold !important;">
                                Fecha de Terminaci&oacute;n
                            </td>
                            <td style="font-weight: bold !important;">
                                Empleo Actual
                            </td>                            

                            <td style="font-weight: bold !important;">
                                Ver Folio
                            </td>
    <!--                        <td style="font-weight: bold !important;">
                                Editar
                            </td>-->
                            <td style="font-weight: bold !important;">
                                Eliminar
                            </td>                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //echo print_r($documents_laboral_user, true);
                        $count = 1;
                        foreach ($documents_laboral_user as $document) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $document->DOCUMENTO_FOLIO; ?>
                                </td>
                                <td>
                                    <?php echo $document->UNIVERSIDAD; ?>
                                </td>
                                <td>
                                    <?php echo $document->CARGO; ?>
                                </td>
                                <td>
                                    <?php echo $document->FECHA_INICIO; ?>
                                </td>
                                <td>
                                    <?php echo $document->FECHA_FIN; ?>
                                </td>
                                <td>
                                    <?php echo $document->EMPLEO_ACTUAL; ?>
                                </td>                                

                                <td style="padding: 1px !important;">
                                    <a target="_blank" href="<?php echo base_url('laboral/view_document/' . encrypt_id($document->DOCUMENTO_ID)) ?>" class="btn btn-info btn-sm">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        Ver
                                    </a>
                                </td>
        <!--                                    <td style="padding: 1px !important;">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                        Editar
                                    </button>
                                </td>-->
                                <td style="padding: 1px !important;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle btn-sm" data-toggle="dropdown">
                                            Eliminar <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="<?php echo base_url('laboral/delete_document/' . encrypt_id($document->DOCUMENTO_ID)) ?>">
                                                    Confirmar Eliminaci&oacute;n
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>                   
                            </tr>                                    
                            <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
                </td>
                </tr>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                No se han cargado documentos de Experiencia Laboral, por favor ingrese un documento en el siguiente formulario:
            </div>        
        <?php } ?>
    </div>
    <br><br>

    <?php echo form_open_multipart('laboral/insert', 'id="laboral_insert" class="form-signin" role="form" method="POST" autocomplete="off"'); ?>

    <table class="table table-bordered" style="background-color: #f4f4f4 !important;">
        <tr>
            <td>
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="text-align: center !important;color: #3071a9 !important;">
                            INGRESO DE EXPERIENCIA LABORAL
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Entidad </label>
                            <?php echo form_input('UNIVERSIDAD', '', 'id="UNIVERSIDAD" class="form-control" tabindex=5'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre del Cargo o Actividad desempe&ntilde;ada </label>
                            <?php echo form_input('CARGO', '', 'id="CARGO" class="form-control" tabindex=6'); ?>
                        </div>
                    </div>                  
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha de Inicio (AAAA-MM-DD)</label>
                            <?php echo form_input('FECHA_INICIO', '', 'id="FECHA_INICIO" class="form-control datepicker" tabindex=7') ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha de Terminaci&oacute;n (AAAA-MM-DD)</label>
                            <?php echo form_input('FECHA_FIN', '', 'id="FECHA_FIN" class="form-control datepicker" tabindex=8') ?>
                        </div>
                    </div>                  
                </div> 
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Empleo y/o Contrato Actual </label>
                            <?php echo form_dropdown('EMPLEO_ACTUAL', array('SI' => 'SI', 'NO' => 'NO'), 'NO', 'id="EMPLEO_ACTUAL" class="form-control" tabindex=4'); ?>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Adjunto </label>
                            <?php echo form_upload('userfile', '', 'id="userfile" class="filebase"') ?>
                        </div>
                    </div>                 
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" data-loading-text="Enviando..." class="loading-example-btn-4 btn btn-success">Ingresar Experiencia</button>
                        <a href="">
                            <button type="button" class="btn btn-danger">Cancelar</button>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <?php echo form_close(); ?>




    <br><br><br><br>
    <div class="row">
        <div class="col-md-6">
            <p style="text-align: left !important;">
                <a href="<?php echo base_url("noformal") ?>" class="btn btn-info" role="button">
                    Regresar al paso 3: Educaci&oacute;n No Formal
                </a>        
            </p>
        </div>

        <div class="col-md-6">
            <p style="text-align: right !important;">
                <a href="<?php echo base_url("documentos/certificado") ?>" class="btn btn-info" role="button">
                    Ir al paso 5: Certificado de Cargue de Documentos
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