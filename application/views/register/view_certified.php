

<div class="bs-docs-header" id="content" style="margin-bottom: 0px !important;">
    <div class="container">
        <h1>Certificado de Inscripci&oacute;n</h1>
        <p><?php echo $user[0]->CONVOCATORIA_NOMBRE ?></p>
        <p>&nbsp;</p>
        <div id="carbonads-container">
            <div class="carbonad">
                <div id="azcarbon">
                    <span>
                        <span class="carbonad-image">
                            <img src="<?php echo base_url(str_replace('_1', '_2', $user[0]->CONVOCATORIA_IMAGEN)); ?>" width="100%">
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<div class="container bs-docs-container">

    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>
    <hr>
    <h3>
        Datos del Usuario
        <a href="<?php echo base_url('ingreso/editar_datos') ?>" class="btn btn-success btn-sm">
            Editar mis datos
        </a>
    </h3>

    <table class="table table-striped">
        <tr>
            <td><span style="background-color: yellow">PIN (Codigo de Inscripci&oacute;n)</span></td>       
            <td><span style="background-color: yellow"><strong><?php echo $user[0]->INSCRIPCION_PIN; ?></strong></span></td>

            <td></td>          
            <td></td>        
        </tr>    
        <tr>
            <td>Tipo de Documento</td>          
            <td><strong><?php echo $user[0]->USUARIO_TIPODOCUMENTO; ?></strong></td>

            <td>Numero de Documento</td>          
            <td><strong><?php echo $user[0]->USUARIO_NUMERODOCUMENTO; ?></strong></td>        
        </tr>
        <tr>
            <td>Nombres</td>          
            <td><strong><?php echo $user[0]->USUARIO_NOMBRES; ?></strong></td> 

            <td>Apellidos</td>          
            <td><strong><?php echo $user[0]->USUARIO_APELLIDOS; ?></strong></td>         
        </tr>
        <tr>
            <td>Correo Electronico</td>          
            <td><strong><?php echo $user[0]->USUARIO_CORREO; ?></strong></td> 

            <td>Genero</td>          
            <td><strong><?php echo ($user[0]->USUARIO_GENERO == 'M') ? 'MASCULINO' : 'FEMENINO'; ?></strong></td>         
        </tr>
        <tr>
            <td>Fecha de Nacimiento(YYYY/MM/DD)</td>          
            <td><strong><?php echo $user[0]->USUARIO_FECHADENACIMIENTO; ?></strong></td> 

            <td>Lugar de Nacimiento</td>          
            <td><strong><?php echo $user[0]->USUARIO_LUGARDENACIMIENTO_N; ?></strong></td>         
        </tr>
        <tr>
            <td>Direccion de Residencia</td>          
            <td><strong><?php echo $user[0]->USUARIO_DIRECCIONRESIDENCIA; ?></strong></td> 

            <td>Lugar de Residencia</td>          
            <td><strong><?php echo $user[0]->USUARIO_LUGARDERESIDENCIA_N; ?></strong></td>         
        </tr>
        <tr>
            <td>Telefono Fijo</td>          
            <td><strong><?php echo $user[0]->USUARIO_TELEFONOFIJO; ?></strong></td> 

            <td>Celular</td>          
            <td><strong><?php echo $user[0]->USUARIO_CELULAR; ?></strong></td>         
        </tr>
        <tr>
            <td>Convocatoria</td>          
            <td colspan="3"><strong><?php echo $user[0]->CONVOCATORIA_NOMBRE; ?></strong></td>         
        </tr>
    </table>

    <h3>Ofertas</h3>
    <?php if (count($ofertas) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Codigo del Empleo</th>
                    <th>Region</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($ofertas as $oferta) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td>
                            <a href="<?php echo base_url('ofertas/informacion/' . 'UMBEMP' . str_pad($oferta->EMPLEO_ID, 3, "0", STR_PAD_LEFT)) ?>" style="margin-left: 5px;" class="label label-default">
                                <?php echo 'UMBEMP' . str_pad($oferta->EMPLEO_ID, 3, "0", STR_PAD_LEFT); ?>
                                <span class="glyphicon glyphicon-share-alt"></span>
                            </a>
                        </td>
                        <td><?php echo $oferta->REGIONAL_NOMBRE; ?>
                        </td>

                        <td style="padding: 1px !important;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle btn-sm" data-toggle="dropdown">
                                    Eliminar <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="<?php echo base_url('ofertas/delete_offer/' . encrypt_id($oferta->OFERTAINS_ID)) ?>">
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
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Usted todavia no ha aplicado a una Oferta de Empleo, 
            para aplicar a una, por favor ingrese a Ofertas de Empleo dando click 
            <a href="<?php echo base_url('ofertas'); ?>">
                Aqui
            </a>
            , 
            busque la oferta que le interesa y de click en "Aplicar a esta oferta" 
        </div>        
    <?php } ?>

    <div class="row">
        <div class="col-md-4">
            <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
                <a target="_blank" href="<?php echo base_url('registro/certificado/' . '1'); ?>" class="btn btn-primary btn-lg btn-block">Descargar Certificado en PDF</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
                <a href="<?php echo base_url('ofertas'); ?>" class="btn btn-danger btn-lg btn-block">Buscar Ofertas de Empleo</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
                <a href="<?php echo base_url(''); ?>" class="btn btn-warning btn-lg btn-block">Cargue de Documentos</a>
            </div>
        </div>
    </div>

    <?php if (!$this->session->userdata('logged_in')) { ?>
        <a href="<?php echo base_url(''); ?>"  class="btn btn-success">Iniciar Sesion</a>
    <?php } ?>
</div>
<br><br><br><br>