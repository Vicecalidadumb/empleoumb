<div class="container">
    <?php echo form_open('ingreso/recordar_pin_envio', 'class="form-signin" role="form" autocomplete="off"'); ?>
    <img src="<?php echo base_url($convocatoria[0]->CONVOCATORIA_IMAGEN); ?>" style="width: 100% ;">
    <h4><?php echo $convocatoria[0]->CONVOCATORIA_NOMBRE ?></h4>
    <h2 class="form-signin-heading">Recordatorio de PIN de Inscripci&oacute;n</h2>

    <br>
    <h4 class="form-signin-heading" style="color:red !important;">Para recordar el PIN de Inscripci&oacute;n, 
        por favor introduzca su numero de documento y la dirección de correo electr&oacute;nico.
    </h4>
    <?php echo form_input('username', '', 'class="form-control" placeholder="Documento" autofocus') ?>
    <?php echo form_input('email', '', 'class="form-control" placeholder="Correo Electronico" autofocus') ?>
    <br>
    <button class="btn btn-lg btn-warning btn-block loading-example-btn" data-loading-text="Consultando informaci&oacute;n..." type="submit">Recordar Pin</button>

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

    <br><br><br><br><br>
</div> <!-- /container -->

