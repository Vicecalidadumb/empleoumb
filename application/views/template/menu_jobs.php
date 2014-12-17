<style>
    body { padding-top: 50px; }
</style>
<header class="navbar navbar-default navbar-fixed-top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Inicio</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo base_url("ofertas") ?>" class="navbar-brand">Inicio</a>
        </div>
        <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" method="POST" action="<?php echo base_url('/ofertas/') ?>" role="form">
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-briefcase"></span>
                    </div>
                    <input class="form-control" value="<?php echo (isset($validar_busqueda) && $validar_busqueda) ? $palabra_clave : ''; ?>" name="empleo" type="text" placeholder="Palabra Clave">
                </div>
                <button type="submit" class="btn btn-primary">Buscar Empleos</button>
            </form>          
        </div>
        </nav>
    </div>
</header>