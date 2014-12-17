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
        border: 1px #ddd;width: 670px;
    }
</style>


<page>
    <div style="margin-left: 75px; margin-right: 75px; margin-top: 40px;">
        <div  style="width: 650px; background-color: #0074a7; color:#fff; padding: 5px;">
            <div class="container">
                <div style="color:#fff; font-size: 36px; text-align: center">Certificado de Inscripci&oacute;n</div>
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

        <div style="width: 670px; color:#00509f;">

            <br>
            <h4>Datos del Usuario</h4>
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
            <h4>Ofertas</h4>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="trb" style="width: 218px; padding-bottom: 7px; font-size: 16px;">No.</th>
                        <th class="trb" style="width: 218px; padding-bottom: 7px; font-size: 16px;">Codigo del Empleo</th>
                        <th class="trb" style="width: 218px; padding-bottom: 7px; font-size: 16px;">Region</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($ofertas as $oferta) {
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo 'UMBEMP' . str_pad($oferta->EMPLEO_ID, 3, "0", STR_PAD_LEFT); ?></td>
                            <td><?php echo $oferta->REGIONAL_NOMBRE; ?></td>
                        </tr>                    
                        <?php
                        $count++;
                    }
                    ?>
                </tbody>
            </table>            
        </div>
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