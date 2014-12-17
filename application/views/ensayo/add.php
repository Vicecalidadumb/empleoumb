<section class="container" id="main">
    <div id="survey_container">
        <div id="middle-wizard">

            <div class="step">
                <?php if ($this->session->flashdata('message')) { ?>
                    <div role="alert" class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                <?php } ?>                
            </div>    

            <div class="step">
                <div class="row">
                    <div class="col-md-12" style="text-align: justify !important;font-size: 16px;">
                        <p style="text-align: justify !important;font-size: 16px;">
                                     <br><br>
                        <h2 class="col-md-12">Instrucciones</h2>
                        
<!--Bienvenidos a la Convocatoria de la Defesor&iacute;a del Pueblo, dirigida a revisar su capacidad de 
an&aacute;lisis y de argumentaci&oacute;n, a partir de la construcci&oacute;n de un Ensayo en el que usted debe
desarrollar una tesis relacionada con los Derechos Humanos y el Derecho Internacional  
Humanitario.
<br><br>
El ensayo es un texto de car&aacute;cter argumentativo cuya intenci&oacute;n es persuadir a trav&eacute;s de 
evidencias, en este sentido, un ensayo puede tener diversas finalidades: resolver un problema, 
proponer alternativas de soluci&oacute;n (si las admite) o mostrar que ninguna de ellas es concluyente. 
<br><br>
Asimismo, puede pretender precisar la formulaci&oacute;n de un problema y su tratamiento, discutir los 
puntos de vista que se han planteado al respecto, o mostrar que es un falso problema (cuando se 
sospecha que lo que lo motiva no es m&aacute;s que una confusi&oacute;n mental o falacia).
Para construir el ensayo es importante que tenga en cuenta las siguientes consideraciones
<br><br>
En primer lugar, entender la tesis desde la cual deben desarrollarse sus argumentos, 
reconociendo el tema alrededor del cual va a girar el tratamiento de la informaci&oacute;n.
<br><br>
En segundo lugar identificar o formular los argumentos que desarrollan la tesis, 
porque sobre un mismo tema suele haber diversos puntos de vista. Discriminar cu&aacute;les 
son esos puntos de vista, ponerlos en relaci&oacute;n y en tensi&oacute;n unos con otros, descubrir 
en qu&eacute; se oponen o contradicen, es la estrategia para plantear los argumentos o 
comentar un texto. &Eacute;ste ser&aacute; el coraz&oacute;n de un buen ensayo, lograr que todo de respuesta a la tesis.
<br><br>
En tercer lugar debe cerciorarse de que se ha entendido o formulado bien los t&eacute;rminos en que est&aacute; 
expresado el tema y formulado las tesis, en cuanto a la claridad de los t&eacute;rminos utilizados 
con el fin dar coherencia, concordancia y pertinencia a su ensayo.
<br><br>
La construcci&oacute;n de un ensayo debe considerar como estructura: una introducci&oacute;n (en la cual 
se plantea el problema, as&iacute; como su importancia o su inter&eacute;s, y se anticipa resumidamente 
el punto de vista que se adoptar&aacute; para su examen), un desarrollo y una conclusi&oacute;n personal. 
<br><br>
Finalmente, es importante el uso de argumentos de todo tipo: de autoridad, por analog&iacute;a, 
de ejemplificaci&oacute;n, etc. Recuerde que si va a hacer uso de argumentos de autoridad, 
estos deben estar adecuadamente citados utilizando las normas APA. 
<br><br>
Esperamos que el ejercicio que desarrolle involucre todos los aspectos mencionados 
anteriormente logrando un buen ensayo. -->

<img src="<?php echo base_url('images/vice\Defensoria-imagenes2.jpg'); ?>" style="width: 100%;"> 

                    </div>
                </div>
            </div>          
        </div>
        <div id="bottom-wizard">

            <div class="row">
                <div class="col-md-6" style="text-align: left !important;">
                    <a href="<?php echo base_url('ensayo/logout') ?>" class="btn btn-danger">&nbsp;&nbsp;&nbsp;Salir&nbsp;&nbsp;&nbsp;</a>
                </div>                    
                <div class="col-md-6" style="text-align:right  !important;">                    
                    <a href="<?php echo base_url('ensayo/insert') ?>" class="btn btn-primary">Iniciar el Ensayo Virtual</a>
                </div> 
            </div> 
            <div class="row">
                <div class="col-md-12" style="text-align: left !important;">
                    <br>
                    <h5>
                        <span class="label label-default">
                            Sesion iniciada por:
                            <?php echo $this->session->userdata('USUARIO_NOMBRES') . ' ' . $this->session->userdata('USUARIO_APELLIDOS'); ?>
                        </span>
                    </h5>
                </div>                
            </div>            
        </div>

    </div>
</section>