<?php
//echo '<pre>'.print_r($this->session->userdata,true).'</pre>';
?>

<div class="bs-docs-header" id="content" style="margin-bottom: 0px !important;">
    <div class="container">
        <h1>Oferta de Empleos</h1>
        <p>Ofertas de empleo publicadas por la empresa UNIVERSIDAD MANUELA BELTR&Aacute;N</p>
        <p>&nbsp;</p>
        <div id="carbonads-container">
            <div class="carbonad">
                <div id="azcarbon">
                    <span>
                        <span class="carbonad-image">
                            <img src="<?php echo base_url('images/vice/escudo-umb_2.png'); ?>" width="100%">
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <p>
<!--            <a class="btn btn-success btn-lg" href="http://umb.edu.co/sites/convocatoria-de-entidad-de-orden-nacional/" role="button">Mas Informaci&oacute;n »</a>-->
            <?php if (!$this->session->userdata('logged_in')) { ?>
                <a href="<?php echo base_url('ingreso/convocatoria') ?>" class="btn btn-warning btn-lg" title="Debe iniciar sesi&oacute;n para aplicar a una oferta"  role="button">
                    Iniciar sesi&oacute;n o Registrarse Ahora
                    <span class="glyphicon glyphicon-user"></span>
                </a>
            <?php } ?>
        </p>
    </div>
</div>


<div class="container bs-docs-container">
    <div class="row">
        <?php if ($this->session->flashdata('message')) { ?>
            <br>
            <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php } ?>        

        <h2 class="text-primary">
            <?php echo ($validar_busqueda) ? 'Resultados de la Busqueda <small>(' . count($ofertas) . ' Empleos que contienen "<span style="background-color: yellow !important;">' . $palabra_clave . '</span>")</small>' : 'Ofertas Destacadas'; ?>
        </h2>
        <hr>

        <?php
        //echo '<pre>' . print_r($ofertas_perfil, true) . '</pre>';
        $contador = 1;
        foreach ($ofertas as $oferta) {
            if ($validar_busqueda) {
                $oferta->PERFIL = str_ireplace($palabra_clave, '<span style="background-color: yellow !important;">' . $palabra_clave . '</span>', $oferta->PERFIL);
                $oferta->EMPLEO_PROPOSITO = str_ireplace($palabra_clave, '<span style="background-color: yellow !important;">' . $palabra_clave . '</span>', $oferta->EMPLEO_PROPOSITO);
            }
            ?>
            <div class="media">
                <!--<a class="pull-left" href="#">
                        <img class="media-object" alt="64x64" src="<?php echo base_url("images/vice/64/programming_64x64.png") ?>" style="width: 64px; height: 64px;">
                    </a>-->
                <div class="media-body">
                    <h3 class="media-heading">
                        <?php echo '<small>' . $contador . ')</small> ' . $oferta->EMPLEO_DESCRIPCION ?> <small><?php echo 'UMBEMP' . str_pad($oferta->EMPLEO_ID, 3, "0", STR_PAD_LEFT); ?></small>
                    </h3>
                    <h4 class="media-heading text-primary">
                        <small>Perfil: </small><?php echo $oferta->PERFIL ?>
                    </h4>                    

                    <p class="text-primary">
<!--                        <strong><small>Proposito: </small></strong><?php echo $oferta->EMPLEO_PROPOSITO; ?>
                        <br>-->
                        <span class="label label-default">
                            Salario: $<?php echo number_format($oferta->EMPLEO_SALARIO, 0, "'", '.'); ?>
                        </span>
                        <?php
                        $ARRAY_regiones = explode('-', $oferta->REGIONES);
                        foreach ($ARRAY_regiones as $region) {
                            ?>
                            <a href="<?php echo base_url('ofertas/index/' . base64_encode($region)) ?>" style="margin-left: 5px;" class="label label-primary">
                                <?php echo $region; ?>
                            </a>
                            <?php
                        }
                        ?>
                    </p>
                    <a href="<?php echo base_url('ofertas/informacion/' . encrypt_id_v2($oferta->EMPLEO_ID)) ?>" class="btn btn-warning btn-sm">
                        Mas Informaci&oacute;n
                        <span class="glyphicon glyphicon-share-alt"></span>
                    </a>                    
                </div>
            </div>
            <hr>
            <?php
            $contador++;
        }
        ?>

        <div class="jumbotron">
            <h3>Nueva B&uacute;squeda <small>Puede realizar la b&uacute;squeda por palabra clave, regi&oacute;n o codigo de empleo</small></h3>
            <form class="form-horizontal" action="<?php echo base_url('/ofertas/') ?>" method="POST" role="form">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-briefcase"></span>
                    </div>
                    <input class="form-control" value="<?php echo (isset($validar_busqueda) && $validar_busqueda) ? $palabra_clave : ''; ?>" name="empleo" type="text" placeholder="Palabra Clave">
                </div>
                <br>
                <div class="input-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Buscar Empleos</button>
                    </div>
                </div>
                <hr>
                <h4>Buscar por Regi&oacute;n <small>Clic en la regi&oacute;n deseada para buscar empleos</small></h4>
                <?php foreach ($regiones as $region) { ?>
                    <a href="<?php echo base_url('ofertas/index/' . base64_encode($region->REGIONAL_NOMBRE)) ?>" style="margin-left: 5px;" class="label label-primary">
                        <?php echo $region->REGIONAL_NOMBRE ?>
                    </a>
                <?php } ?>
            </form>
        </div>
    </div>

    <br><br>
</div>