<style>
    .td1{
        width: 350px; 
        padding-bottom: 7px; 
        font-size: 16px;
    }
    .td2{
        width: 304px;
    }
    .trb{
        background-color: #f9f9f9;
    }
    .table{
        border: 1px #ddd;
        width: 670px;
    }
    .td_all{
        padding-bottom: 7px; 
        font-size: 14px;
    }
</style>

<page>

    <div style="margin-left: 75px; margin-right: 75px; margin-top: 40px;width: 670px; color:#00509f;">

        <div  style="width: 650px; background-color: #0074a7; color:#fff; padding: 5px;">
            <div class="container">
                <div style="color:#fff; font-size: 36px; text-align: center">Certificado de Cargue de Documentos</div>
                <br>
                <div style="color:#fff; font-size: 14px; text-align: center"><?php echo $user[0]->CONVOCATORIA_NOMBRE ?></div>
                <br>
                <div id="carbonads-container" style="text-align: center">
                    <span class="carbonad-image">
                        <img src="http://<?php echo $_SERVER['SERVER_NAME'] . '/empleoumb/images/vice/escudo-umb_2.png' ?>">
                    </span>
                </div>
            </div>
        </div>



        <br>
        <h4>Datos del Usuario</h4>
        <br>
        <table class="table table-striped">
            <tbody>
                <tr class="trb">
                    <td class="td1">PIN</td>          
                    <td class="td2"><strong><?php echo $user[0]->INSCRIPCION_PIN; ?></strong></td>       
                </tr>    
                <tr>
                    <td class="td1">Tipo de Documento</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_TIPODOCUMENTO; ?></strong></td>
                </tr>    
                <tr class="trb">
                    <td class="td1">Numero de Documento</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_NUMERODOCUMENTO; ?></strong></td>        
                </tr>
                <tr>
                    <td class="td1">Nombres</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_NOMBRES; ?></strong></td>
                </tr> 
                <tr class="trb">
                    <td class="td1">Apellidos</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_APELLIDOS; ?></strong></td>         
                </tr>
                <tr>
                    <td class="td1">Correo Electronico</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_CORREO; ?></strong></td> 
                </tr>    
                <tr class="trb">
                    <td class="td1">Genero</td>          
                    <td class="td2"><strong><?php echo ($user[0]->USUARIO_GENERO == 'M') ? 'MASCULINO' : 'FEMENINO'; ?></strong></td>         
                </tr>
                <tr>
                    <td class="td1">Fecha de Nacimiento</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_FECHADENACIMIENTO; ?></strong></td> 
                </tr>    
                <tr class="trb">
                    <td class="td1">Lugar de Nacimiento</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_LUGARDENACIMIENTO_N; ?></strong></td>         
                </tr>
                <tr>
                    <td class="td1">Direccion de Residencia</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_DIRECCIONRESIDENCIA; ?></strong></td> 
                </tr>    
                <tr class="trb">
                    <td class="td1">Lugar de Residencia</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_LUGARDERESIDENCIA_N; ?></strong></td>         
                </tr>
                <tr>
                    <td class="td1">Telefono Fijo</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_TELEFONOFIJO; ?></strong></td> 
                </tr>    
                <tr class="trb">
                    <td class="td1">Celular</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_CELULAR; ?></strong></td>         
                </tr>
                <tr>
                    <td class="td1">Fecha de Inscripci&oacute;n</td>          
                    <td class="td2"><strong><?php echo $user[0]->USUARIO_FECHAINGRESO; ?></strong></td>         
                </tr>    
            </tbody>
        </table>
    </div>
</page>

<page_footer>
    <div style="color:#777; text-align: center">
        Copyright © 2014 
        <a href="http://umb.edu.co/" target="_blank">
            Universidad Manuela Beltrán
        </a>
        -
        <a href="http://vicecalidad.umb.edu.co/" target="_blank">
            Vicerrectoría de Calidad
        </a>
        <br>
        Cra 24 # 35-57, Barrio La Soledad - Teléfono: 5460600 ext. 1207 - 1600,
        Fecha Actual: <?php echo date("Y-m-d H:i:s") ?>
    </div>
    <br>
</page_footer>

<page>

    <div style="margin-left: 75px; margin-right: 75px; margin-top: 40px;width: 670px; color:#00509f;">
        <h4>Documentos Obligatorios</h4>
        <?php if (count($documents_particles_user) > 0) { ?>

            <table class="table table-striped">
                <thead>
                    <tr class="trb">
                        <td class="td_all" style="width: 200px;" >
                            No. Folio
                        </td>
                        <td class="td_all" style="width: 200px;">
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
                            <td class="td_all" style="border-top: 1px #ddd; width: 200px;"><?php echo $document->DOCUMENTO_FOLIO; ?></td>
                            <td class="td_all" style="border-top: 1px #ddd; width: 200px;"><?php echo $tipo; ?></td>                                                 
                        </tr>                                    
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        <?php } else { ?>
            <h4>
                No se han cargado documentos obligatorios
            </h4>        
        <?php } ?>  


        <h4>Documentos de Educacion Formal</h4>
        <?php if (count($documents_formal_user) > 0) { ?>

            <table class="table table-striped">
                <thead>
                    <tr class="trb">
                        <td class="td_all" style="font-weight: bold !important; width: 50px;">
                            No. Folio
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 180px;">
                            Modalidad
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 130px;">
                            Universidad/Instituto
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 130px;">
                            Titulo/Nombre programa
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 130px;">
                            Fecha de Grado 
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($documents_formal_user as $document) {
                        ?>
                        <tr>
                            <td class="td_all" style="width: 50px; border-top: 1px #ddd;">
                                <?php echo $document->DOCUMENTO_FOLIO; ?>
                            </td>
                            <td class="td_all" style="width: 180px; border-top: 1px #ddd;">
                                <?php echo $document->MODALIDAD_NOMBRE; ?>
                            </td>
                            <td class="td_all" style="width: 130px; border-top: 1px #ddd;">
                                <?php echo $document->UNIVERSIDAD; ?>
                            </td>
                            <td class="td_all" style="width: 130px; border-top: 1px #ddd;">
                                <?php echo $document->TITULO; ?>
                            </td>
                            <td class="td_all" style="width: 130px; border-top: 1px #ddd;">
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
            <h4>
                No se han cargado documentos de Educaci&oacute;n Formal
            </h4>        
        <?php } ?>

        <h4>Documentos de Educacion No Formal</h4>
        <?php if (count($documents_noformal_user) > 0) { ?>

            <table class="table table-striped">
                <thead>
                    <tr class="trb">
                        <td class="td_all" style="font-weight: bold !important; width: 50px;">
                            No. Folio
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 180px;">
                            Instituto
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 130px;">
                            Nombre del curso
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 130px;">
                            Intensidad
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 130px;">
                            Fecha de Terminaci&oacute;n
                        </td>                                               
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($documents_noformal_user as $document) {
                        ?>
                        <tr>
                            <td class="td_all" style="width: 50px; border-top: 1px #ddd;">
                                <?php echo $document->DOCUMENTO_FOLIO; ?>
                            </td>
                            <td class="td_all" style="width: 180px; border-top: 1px #ddd;">
                                <?php echo $document->UNIVERSIDAD; ?>
                            </td>
                            <td class="td_all" style="width: 130px; border-top: 1px #ddd;">
                                <?php echo $document->TITULO; ?>
                            </td>
                            <td class="td_all" style="width: 130px; border-top: 1px #ddd;">
                                <?php echo $document->INTENSIDAD; ?>
                            </td>
                            <td class="td_all" style="width: 130px; border-top: 1px #ddd;">
                                <?php echo $document->FECHA_TERMINACION; ?>
                            </td>                                             
                        </tr>                                    
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        <?php } else { ?>
            <h4>
                No se han cargado documentos de Educaci&oacute;n No Formal
            </h4>        
        <?php } ?>            

        <h4>Experiencia Laboral</h4>
        <?php if (count($documents_laboral_user) > 0) { ?>
            <table class="table table-striped">
                <thead>
                    <tr class="trb">
                        <td class="td_all" style="font-weight: bold !important; width: 40px;">
                            No. Folio
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 109px;">
                            Entidad
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 109px;">
                            Cargo
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 109px;">
                            Fecha de Inicio
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 109px;">
                            Fecha de Terminaci&oacute;n
                        </td>
                        <td class="td_all" style="font-weight: bold !important; width: 109px;">
                            Empleo Actual
                        </td>                                               
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($documents_laboral_user as $document) {
                        ?>
                        <tr>
                            <td class="td_all" style="width: 40px; border-top: 1px #ddd;">
                                <?php echo $document->DOCUMENTO_FOLIO; ?>
                            </td>
                            <td class="td_all" style="width: 109px; border-top: 1px #ddd;">
                                <?php echo $document->UNIVERSIDAD; ?>
                            </td>
                            <td class="td_all" style="width: 109px; border-top: 1px #ddd;">
                                <?php echo $document->CARGO; ?>
                            </td>
                            <td class="td_all" style="width: 109px; border-top: 1px #ddd;">
                                <?php echo $document->FECHA_INICIO; ?>
                            </td>
                            <td class="td_all" style="width: 109px; border-top: 1px #ddd;">
                                <?php echo $document->FECHA_FIN; ?>
                            </td>
                            <td class="td_all" style="width: 109px; border-top: 1px #ddd;">
                                <?php echo $document->EMPLEO_ACTUAL; ?>
                            </td>                                                
                        </tr>                                    
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <h4>
                No se han cargado documentos de Experiencia Laboral
            </h4>        
        <?php } ?>

    </div>
</page>

<page_footer>
    <div style="color:#777; text-align: center">
        Copyright © 2014 
        <a href="http://umb.edu.co/" target="_blank">
            Universidad Manuela Beltrán
        </a>
        -
        <a href="http://vicecalidad.umb.edu.co/" target="_blank">
            Vicerrectoría de Calidad
        </a>
        <br>
        Cra 24 # 35-57, Barrio La Soledad - Teléfono: 5460600 ext. 1207 - 1600,
        Fecha Actual: <?php echo date("Y-m-d H:i:s") ?>
    </div>
    <br>
</page_footer>