
<div class="bs-docs-header" id="content" style="margin-bottom: 0px !important;">
    <div class="container">
        <h1>Registro de Aspirantes</h1>
        <p><?php echo $convocatoria[0]->CONVOCATORIA_NOMBRE ?></p>
        <p>&nbsp;</p>
        <div id="carbonads-container">
            <div class="carbonad">
                <div id="azcarbon">
                    <span>
                        <span class="carbonad-image">
                            <img src="<?php echo base_url(str_replace('_1', '_2', $convocatoria[0]->CONVOCATORIA_IMAGEN)); ?>" width="100%">
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container bs-docs-container">
    <br>

    <!--    <div class="jumbotron">
            <div style="text-align: center">
                <img src="<?php echo base_url($convocatoria[0]->CONVOCATORIA_IMAGEN); ?>" >
            </div>
            <h2>Registro de Aspirantes</h2>
            <p><?php echo $convocatoria[0]->CONVOCATORIA_NOMBRE ?></p>
        </div>-->

    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>

    <?php
    echo $resp_captcha;
    ?>

    <?php echo validation_errors(); ?>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Informaci&oacute;n Importante</h3>
        </div>
        <div class="panel-body">
            Por favor ingrese sus datos b&aacute;sicos para el registro, 
            los campos marcados con asterisco rojo (<span style="color:red">*</span>) son obligatorios.
        </div>
    </div>


    <?php echo form_open('registro/insert/' . encrypt_id($convocatoria[0]->CONVOCATORIA_ID), 'id="register_insert" class="form-signin" role="form" method="POST" autocomplete="off"'); ?>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Tipo de Documento </label>
                <?php echo form_dropdown('USUARIO_TIPODOCUMENTO', $tipos_documentos, set_value('USUARIO_TIPODOCUMENTO'), 'class="form-control" tabindex=1'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Numero de Documento <span style="color:red">*</span></label>
                <?php echo form_input('USUARIO_NUMERODOCUMENTO', set_value('USUARIO_NUMERODOCUMENTO'), 'id="USUARIO_NUMERODOCUMENTO" placeholder="Numero de Documento" class="form-control" tabindex=2') ?>
            </div>
        </div>        

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombres <span style="color:red">*</span></label>
                <?php echo form_input('USUARIO_NOMBRES', set_value('USUARIO_NOMBRES'), 'id="USUARIO_NOMBRES" placeholder="Nombres" class="form-control" tabindex=3') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Apellidos <span style="color:red">*</span></label>
                <?php echo form_input('USUARIO_APELLIDOS', set_value('USUARIO_APELLIDOS'), 'id="USUARIO_APELLIDOS" placeholder="Apellidos" class="form-control" tabindex=4') ?>
            </div>
        </div>        

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Genero </label>
                <?php echo form_dropdown('USUARIO_GENERO', array('M' => 'Masculino', 'F' => 'Femenino'), set_value('USUARIO_GENERO'), 'class="form-control" tabindex=5'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Fecha de Nacimiento (AAAA-MM-DD) <span style="color:red">*</span></label>
                <?php echo form_input('USUARIO_FECHADENACIMIENTO', set_value('USUARIO_FECHADENACIMIENTO'), 'id="USUARIO_FECHADENACIMIENTO" placeholder="Fecha de Nacimiento (AAAA-MM-DD)" class="form-control" tabindex=6') ?>
            </div>   
        </div>        

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Departamento de Nacimiento <span style="color:red">*</span></label>
                <?php echo form_dropdown('DEPARTAMENTO_NACIMIENTO', $departments_1, ' ', 'class="form-control" onchange="get_mun(this.value,\'lugar_de_nacimiento\',\'USUARIO_LUGARDENACIMIENTO\',\'8\' )" tabindex=7'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Municipio de Nacimiento <span style="color:red">*</span></label>
                <span id="lugar_de_nacimiento">
                    <?php echo form_dropdown('USUARIO_LUGARDENACIMIENTO', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=8'); ?>
                </span>
            </div>
        </div>        

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Departamento de Residencia <span style="color:red">*</span></label>
                <?php echo form_dropdown('DEPARTAMENTO_RESIDENCIA', $departments_2, ' ', 'class="form-control" onchange="get_mun(this.value,\'lugar_de_residencia\',\'USUARIO_LUGARDERESIDENCIA\',\'10\')" tabindex=9'); ?>
            </div>      
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Municipio de Residencia <span style="color:red">*</span></label>
                <span id="lugar_de_residencia">
                    <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
                </span>
            </div>
        </div>        

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Direcci&oacute;n de Residencia </label>
                <?php echo form_input('USUARIO_DIRECCIONRESIDENCIA', set_value('USUARIO_DIRECCIONRESIDENCIA'), 'id="USUARIO_DIRECCIONRESIDENCIA" placeholder="Direccion" class="form-control" tabindex=11') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Numero Celular </label>
                <?php echo form_input('USUARIO_CELULAR', set_value('USUARIO_CELULAR'), 'id="USUARIO_CELULAR" placeholder="Numero Celular" class="form-control" tabindex=12') ?>
            </div>
        </div>        

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Telefono fijo <span style="color:red">*</span></label>
                <?php echo form_input('USUARIO_TELEFONOFIJO', set_value('USUARIO_TELEFONOFIJO'), 'id="USUARIO_TELEFONOFIJO" placeholder="Telefono Fijo" class="form-control" tabindex=13') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Correo Electronico <span style="color:red">*</span></label>
                <?php echo form_input('USUARIO_CORREO_2', set_value('USUARIO_CORREO_2'), 'id="USUARIO_CORREO_2" placeholder="Correo Electronico" class="form-control" tabindex=14') ?>
            </div>       
        </div>        

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Confirmar Correo Electronico <span style="color:red">*</span></label>
                <?php echo form_input('USUARIO_CORREO', set_value('USUARIO_CORREO'), 'id="USUARIO_CORREO" placeholder="Confirmar Correo Electronico" class="form-control" tabindex=15') ?>
            </div>
        </div>

    </div>
<!--    <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
        <p style="text-align: center !important;">
            Queremos asegurarnos de que es una persona real quien est&aacute; creando una cuenta.
            Por favor ingrese los caracteres representados en la imagen.
        </p>
        <script type="text/javascript">
            var RecaptchaOptions = {
                theme: 'white'
            };
        </script>
        <?php
        //$publickey = "6LeZ8PUSAAAAAL1raJ7edmSTQT1zhye6c5rPjgJK"; // you got this from the signup page
        //echo recaptcha_get_html($publickey);
        ?>
    </div>-->
    <br>

    <div class="row">
        <button type="submit" class="btn btn-success loading-example-btn" data-loading-text="Enviando...">Guardar Datos</button>

        <a href="">
            <button type="button" class="btn btn-danger">Reiniciar Formulario</button>
        </a>
    </div>


    <?php echo form_close(); ?>

    <br><br><br><br>

    <script>
        /*
         $(document).ready(function() {
         $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
         })*/
    </script>

</div>