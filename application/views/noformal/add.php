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
                <li class="active"><a href="<?php echo base_url('noformal') ?>">
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
        <h1>Agregar Educaci&oacute;n No Formal</h1>   
        <h5>
            T&Iacute;TULOS Y CERTIFICACIONES DE EDUCACI&Oacute;N PARA EL TRABAJO Y EL DESARROLLO HUMANO
        </h5>
    </div>

    <div class="row">
        <?php if (count($documents_noformal_user) > 0) { ?>
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td style="font-weight: bold !important;">
                                No. Folio
                            </td>
                            <td style="font-weight: bold !important;">
                                Instituto
                            </td>
                            <td style="font-weight: bold !important;">
                                Nombre del curso
                            </td>
                            <td style="font-weight: bold !important;">
                                Intensidad
                            </td>
                            <td style="font-weight: bold !important;">
                                Fecha de Terminaci&oacute;n
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
                        //echo print_r($documents_formal_user, true);
                        $count = 1;
                        foreach ($documents_noformal_user as $document) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $document->DOCUMENTO_FOLIO; ?>
                                </td>
                                <td>
                                    <?php echo $document->UNIVERSIDAD; ?>
                                </td>
                                <td>
                                    <?php echo $document->TITULO; ?>
                                </td>
                                <td>
                                    <?php echo $document->INTENSIDAD; ?>
                                </td>
                                <td>
                                    <?php echo $document->FECHA_TERMINACION; ?>
                                </td>                                
                                <td style="padding: 1px !important;">
                                    <a target="_blank" href="<?php echo base_url('formal/view_document/' . encrypt_id($document->DOCUMENTO_ID)) ?>" class="btn btn-info btn-sm">
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
                                                <a href="<?php echo base_url('noformal/delete_document/' . encrypt_id($document->DOCUMENTO_ID)) ?>">
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
                No se han cargado documentos de Educaci&oacute;n No Formal, por favor ingrese un documento en el siguiente formulario:
            </div>        
        <?php } ?>
    </div>
    <br><br>

    <?php echo form_open_multipart('noformal/insert', 'id="noformal_insert" class="form-signin" role="form" method="POST" autocomplete="off"'); ?>

    <table class="table table-bordered" style="background-color: #f4f4f4 !important;">
        <tr>
            <td>
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="text-align: center !important;color: #3071a9 !important;">
                            INGRESO Y ACTUALIZACI&Oacute;N DE ESTUDIOS
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Instituci&oacute;n</label>
                            <?php echo form_input('UNIVERSIDAD', '', 'id="UNIVERSIDAD" class="form-control" tabindex=1'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre del Curso </label>
                            <?php echo form_input('TITULO', '', 'id="TITULO" class="form-control" tabindex=2'); ?>
                        </div>
                    </div>                  
                </div> 
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Intensidad Horaria </label>
                            <?php echo form_input('INTENSIDAD', '', 'id="INTENSIDAD" class="form-control" tabindex=3') ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha de Terminaci&oacute;n (AAAA-MM-DD) </label>
                            <?php echo form_input('FECHA_TERMINACION', '', 'id="FECHA_TERMINACION" class="form-control datepicker" tabindex=4') ?>
                        </div>
                    </div>                  
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Adjunto </label>
                            <?php echo form_upload('userfile', '', 'id="userfile" class="filebase" tabindex=4') ?>
                        </div>
                    </div>                 
                </div>            

                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" data-loading-text="Enviando..." class="loading-example-btn-3 btn btn-success">Ingresar Estudio</button>
                        <a href="">
                            <button type="button" class="btn btn-danger">Cancelar </button>
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
                <a href="<?php echo base_url("formal") ?>" class="btn btn-info" role="button">
                    Regresar al paso 2: Educaci&oacute;n Formal
                </a>        
            </p>
        </div>

        <div class="col-md-6">
            <p style="text-align: right !important;">
                <a href="<?php echo base_url("laboral") ?>" class="btn btn-info" role="button">
                    Ir al paso 4: Experiencia Laboral
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