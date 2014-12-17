<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted" style="text-align: center">
                    <br><br>
                    Copyright © <?php echo date("Y"); ?> 
                    <a href="http://umb.edu.co/" target="_blank">
                        Universidad Manuela Beltr&aacute;n
                    </a>
                    - 
                    <a href="http://vicecalidad.umb.edu.co/" target="_blank">
                        Vicerrector&iacute;a de Calidad
                    </a>
                    <br>
                    Cra 24 # 35-57, Barrio La Soledad - Tel&eacute;fono: 5460600 ext. 1142 - 1600
                    <!--            <br>
                                email: @umb.edu.co -->
                    <br>
                    <?php
                    if ($this->session->userdata('logged_in')) {
                        ?>
                        <span style="color:#000">
                            Sesion Iniciada por: 
                            <?php echo $this->session->userdata('USUARIO_NOMBRES') . ' ' . $this->session->userdata('USUARIO_APELLIDOS'); ?>
                        </span>
                        <a href="<?php echo base_url('ingreso/logout'); ?>">Salir</a>
                        <?php
                    }
                    ?>
                </p>
            </div>
            <div class="col-md-6">
                <p class="text-muted">
                    <img style="width: 350px !important;" src="<?php echo base_url('images/vice/banner-home_2.png') ?>">
                </p>
            </div>            
        </div>  
    </div>
</div>    
</body>
</html>