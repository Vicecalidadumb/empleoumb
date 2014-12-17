

<div class="bs-docs-header" id="content" style="margin-bottom: 0px !important;">
    <div class="container">
        <h1>Certificado de Cargue de Documentos</h1>
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
    <div class="row">
        <div class="col-md-12">
            <hr>
            <h3>Datos del Usuario</h3>


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
        </div>

        <div class="col-md-12">
            <h3>Documentos Obligatorios</h3>
            <?php if (count($documents_particles_user) > 0) { ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td style="font-weight: bold !important;">
                                No. Folio
                            </td>
                            <td style="font-weight: bold !important;">
                                Tipo de Documento
                            </td>                                              
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($documents_particles_user as $document) {
                            switch ($document->TIPO_DOCUMENTO_ID) {
                                case 51:$tipo = 'Documento de Identidad';
                                    break;
                                case 52:$tipo = 'Libreta Militar';
                                    break;
                                case 53:$tipo = 'Tarjeta/Matricula Profesional';
                                    break;
                                case 54:$tipo = 'Licencia de Conducci&oacute;n';
                                    break;
                            }
                            ?>
                            <tr>
                                <td><?php echo $document->DOCUMENTO_FOLIO; ?></td>
                                <td><?php echo $tipo; ?></td>                                                 
                            </tr>                                    
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    No se han cargado documentos obligatorios
                </div>        
            <?php } ?>            
        </div>


        <div class="col-md-12">
            <h3>Documentos de Educacion Formal</h3>

            <?php if (count($documents_formal_user) > 0) { ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td style="font-weight: bold !important;">
                                No. Folio
                            </td>
                            <td style="font-weight: bold !important;">
                                Modalidad
                            </td>
                            <td style="font-weight: bold !important;">
                                Universidad/Instituto
                            </td>
                            <td style="font-weight: bold !important;">
                                Titulo/Nombre programa
                            </td>
                            <td style="font-weight: bold !important;">
                                Fecha de Grado 
                            </td>                                              
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //echo print_r($documents_formal_user, true);
                        $count = 1;
                        foreach ($documents_formal_user as $document) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $document->DOCUMENTO_FOLIO; ?>
                                </td>
                                <td>
                                    <?php echo $document->MODALIDAD_NOMBRE; ?>
                                </td>
                                <td>
                                    <?php echo $document->UNIVERSIDAD; ?>
                                </td>
                                <td>
                                    <?php echo $document->TITULO; ?>
                                </td>
                                <td>
                                    <?php echo $document->FECHA_GRADO; ?>
                                </td>                                                  
                            </tr>                                    
                            <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>

            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    No se han cargado documentos de Educaci&oacute;n Formal
                </div>        
            <?php } ?>
        </div>

        <div class="col-md-12">
            <h3>Documentos de Educacion No Formal</h3>
            <?php if (count($documents_noformal_user) > 0) { ?>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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
                            </tr>                                    
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    No se han cargado documentos de Educaci&oacute;n No Formal
                </div>        
            <?php } ?>            

        </div>

        <div class="col-md-12">
            <h3>Experiencia Laboral</h3>
            <?php if (count($documents_laboral_user) > 0) { ?>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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
                            </tr>                                    
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    No se han cargado documentos de Experiencia Laboral
                </div>        
            <?php } ?>            
        </div>



        <div class="col-md-12">
            <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
                <a target="_blank" href="<?php echo base_url('documentos/certificado/1'); ?>" class="btn btn-warning btn-lg btn-block">Descargar Certificado en Formato PDF</a>
            </div>   
        </div>



    </div>
</div>
<br><br><br><br>