
<div class="container bs-docs-container">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>

    <?php
//echo print_y($this->session->userdata('rol_permissions'));
//echo print_y($this->session->userdata('politicas'));
    ?>

    <div class="jumbotron">
        <div style="text-align: center">
            <img src="<?php echo base_url($this->session->userdata('CONVOCATORIA_IMAGEN')); ?>" >
        </div>
        <h2>Bienvenido <?php echo $this->session->userdata('USUARIO_NOMBRES') . ' ' . $this->session->userdata('USUARIO_APELLIDOS'); ?></h2>
        <p>Al aplicativo de cargue de documentos.</p>
        <p style="text-align: center"><strong><?php echo $this->session->userdata('CONVOCATORIA_NOMBRE'); ?></strong></p>
        <br>
        <p style="font-size: 15px !important; text-align: justify !important;">
            <strong>PROCEDIMIENTO PARA EL CARGUE DE DOCUMENTOS</strong>
            <br>
            Bienvenido al procedimiento de cargue de documentos
            <br><br>
            Para realizar el proceso de cargue de documentos, tenga en cuenta que estos deben ser escaneados en archivos 
            independientes (por separado), en blanco y negro, en formato PDF y su tama&ntilde;o no debe ser superior a dos 
            <strong>(2) megabytes (MB)</strong>.
            <br><br>
            <?php if (!$this->session->userdata('politicas')): ?>
                Si acepta las anteriores condiciones haga "click" en el bot&oacute;n <span class="label label-danger">ACEPTAR</span>.
            <?php endif; ?>
        </p>

        <p style="text-align: right !important;">
            <?php if (!$this->session->userdata('politicas')) { ?>
                <?php if (count($ofertas) > 0) { ?>
                    <a href="<?php echo base_url("ingreso/politicasok") ?>" class="btn btn-danger btn-lg" role="button">
                        Aceptar
                    </a>
                <?php } else { ?>
                    <br><br>
                <div class="alert alert-danger" role="alert">
                    <strong>
                        Error: No puede continuar con el proceso de cargue de documentos 
                    </strong>
                    <br><br>
                    Usted todav&iacute;a no ha aplicado a una Oferta de Empleo, 
                    para aplicar a una, por favor ingrese a Ofertas de Empleo dando clic 
                    <a href="<?php echo base_url('ofertas'); ?>" target="_blank">Aqu&iacute;</a>, 
                    busque la oferta que le interesa y de clic en "Aplicar a esta oferta", 
                    luego vuelva a esta p&aacute;gina y rec&aacute;rguela para seguir con el proceso 
                    de cargue de documentos.
                </div>                
            <?php } ?>
        <?php } else { ?>
            <a href="<?php echo base_url("especificos") ?>" class="btn btn-success btn-lg" role="button">
                Ir al paso 1: Documentos Especificos
            </a>        
        <?php } ?>
        </p>
    </div>
</div>