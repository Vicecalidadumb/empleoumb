<div class="container">
    <?php echo form_open('ingreso/verify', 'class="form-signin" role="form" autocomplete="off"'); ?>
    <img src="<?php echo base_url($convocatoria[0]->CONVOCATORIA_IMAGEN); ?>" style="width: 100% ;">
    <h4><?php echo $convocatoria[0]->CONVOCATORIA_NOMBRE ?></h4>
    <h2 class="form-signin-heading">Constancia de Inscripcion</h2>

    <br>
    <h4 class="form-signin-heading" style="color:red !important;">Para ver su certificado de inscripci&oacute;n, 
        por favor introduzca su numero de documento y PIN de Inscripci&oacute;n.
    </h4>
    <?php echo form_hidden('certified',1); ?>
    <?php echo form_input('username', '', 'class="form-control" placeholder="Documento" required autofocus') ?>
    <?php echo form_password('password', '', 'class="form-control" placeholder="Pin" required') ?>
    <br>
    <button class="btn btn-lg btn-info btn-block" type="submit">Consultar</button>

    <?php echo form_close(); ?> 
    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>

    <br><br><br><br><br>
</div> <!-- /container -->

