<section class="container" id="main">
    <?php echo form_open('ensayo/insert', 'id="wrapped" method="POST" class="form-signin" role="form" autocomplete="off"'); ?>

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
                    <h1 class="col-md-12">Ensayo Virtual</h1>
                    <div id="time1"></div>
                    <br>
                    <div class="col-md-12">
                        <div class="step row">
                            <div class="col-md-12">
                                <h3 style="font-weight: 600 !important;text-align: justify !important;font-size: 15px !important;">
                                    <img src="<?php echo base_url('images/vice/Defensoria imagenes.jpg'); ?>" style="width: 100%;"> 
                                    
                                </h3>
                                <textarea style="width: 100%;height: 400px;" name="ENSAYO_TEXTO"><?php echo $ensayo[0]->ENSAYO_TEXTO; ?></textarea>
                                <span class="label label-info">
                                    Fecha de inicio del ensayo:  
                                    <strong>
                                        <?php echo $ensayo[0]->ENSAYO_FECHA; ?>
                                    </strong>
                                </span>
                                <br>
                                <span class="label label-success">
                                    Ultima Fecha de Actualizacion:  
                                    <strong>
                                        <?php echo $ensayo[0]->ENSAYO_FECHA_MOD; ?>
                                    </strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submit step" id="complete" style="display: none;">
                <button type="submit" name="process" class="submit"></button>
            </div>	            
        </div>


        <div id="bottom-wizard">
            <div class="row">
                <div class="col-md-6" style="text-align: left !important;">
                    <a href="<?php echo base_url('ensayo/logout') ?>" class="btn btn-danger">&nbsp;&nbsp;&nbsp;Salir&nbsp;&nbsp;&nbsp;</a>
                </div>                 
                <div class="col-md-6" style="text-align:right  !important;">                    
                    <button type="sutmit" data-loading-text="Guardando....." class="btn btn-success loading-example-btn-all" style="background:#2ed83a !important;">Guardar </button>
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
    <?php echo form_close(); ?>
</section>

<style>
    #time{
        width: 170px !important;
        background-color: #50A9D3 !important;
        color:#FFF !important;
        -webkit-border-top-right-radius: 6px;
        -moz-border-radius-topright: 6px;
        border-top-right-radius: 6px;
        border-color: #46b8da;
        border: 1px solid transparent;
        /*text-shadow: 1px 0 0 #ccc;*/
    }

</style>

<div id="time2" class="navbar-fixed-bottom"></div>



<!--------------------------------------------------------------------------------------------------------------------------->

<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/countdown/jquery.countdown.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/countdown/jquery.plugin.js'); ?>"></script> 
<script type="text/javascript" src="<?php echo base_url('js/countdown/jquery.countdown.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/countdown/jquery.countdown-es.js'); ?>"></script>

<?php
$segundos = strtotime(date("Y-m-d H:i:s")) - strtotime($ensayo[0]->ENSAYO_FECHA);
$segundos = $this->session->userdata('MAXIMO_SEG_ENSAYO') - $segundos;
?>
<script>
    $(document).ready(function() {
        //TIME
        var time = "<?php echo $segundos; ?>";
        $('#time1,#time2').countdown({until: +time, description: 'Tiempo Restante'});
        //LOADING
        $('.loading-example-btn-all').click(function() {
            var btn = $(this)
            btn.button('loading')
        });
    });
</script>

<style>
    #time2{
        width: 170px !important;
        background-color: #50A9D3 !important;
        color:#FFF !important;
        -webkit-border-top-right-radius: 6px;
        -moz-border-radius-topright: 6px;
        border-top-right-radius: 6px;
        border-color: #46b8da;
        border: 1px solid transparent;
    }
    #time1{
        width: 170px !important;
        background-color: #FFFFFF !important;
        color: #6C6C6C !important;
        border-color: #46b8da;
        border: 1px solid #f0f0f0;
        padding: 2px;        
    }    
</style>