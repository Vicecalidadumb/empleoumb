<div class="container">
    <?php echo form_open('ingreso/verify', 'class="form-signin" role="form" autocomplete="off"'); ?>
    <img src="<?php echo base_url($convocatoria[0]->CONVOCATORIA_IMAGEN); ?>" style="width: 100% ;">
<!--    <h4><?php echo $convocatoria[0]->CONVOCATORIA_NOMBRE ?></h4>-->
    <!--    <h2 class="form-signin-heading">Aplicativo de Cargue de Documentos</h2>-->
    <br>
    <br>
    <h4 class="form-signin-heading" style="color:red !important;">
        Para ingresar al aplicativo digite su n&uacute;mero de documento de identidad y 
        su n&uacute;mero de PIN de Inscripci&oacute;n, posteriormente de click en <span class="label label-success">Ingresar</span><br>
        Si no posee un PIN de Inscripcion, por favor registrese dando click en el boton <span class="label label-info">Registrarse</span><br>
    </h4>
    <?php echo form_input('username', '', 'class="form-control" placeholder="Documento" required autofocus') ?>
    <?php echo form_password('password', '', 'class="form-control" placeholder="Pin" required') ?>

    <label class="checkbox" style="text-align: right !important;cursor: pointer !important">
        <strong>
            <a href="<?php echo base_url('ingreso/recordar_pin/' . encrypt_id($convocatoria[0]->CONVOCATORIA_ID)); ?>">
                He olvidado mi Pin.
            </a>
        </strong>
    </label>

    <?php echo form_submit('Ingresar', 'Ingresar', 'class="btn btn-lg btn-success btn-block"') ?>

    <hr style="border-top: 1px solid #ccc !important;">

    <a href="<?php echo base_url('registro/nuevo/' . encrypt_id($convocatoria[0]->CONVOCATORIA_ID)); ?>" class="btn btn-lg btn-info btn-block">Registrarse</a>

    <?php echo form_close(); ?>

    <?php if ($this->session->flashdata('message')) { ?>
        <?php if ($this->session->flashdata('message_type') == 'pin') { ?>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Recordatorio de Pin de Inscripci&oacute;n</h4>
                        </div>
                        <div class="modal-body">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#myModal').modal('show');
                });
            </script>
        <?php } else { ?>
            <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php } ?>
    <?php } ?>

    <br><br><br><br><br><br><br><br><br>
</div> <!-- /container -->
