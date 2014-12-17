<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">
    <!--<![endif]-->
    <head>

        <!-- Basic Page Needs -->
        <meta charset="utf-8" />
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $title; ?>" />
        <meta name="author" content="UMB" />

        <link rel="shortcut icon" href="<?php echo base_url('images/vice/favicon.png'); ?>">
        
        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- CSS -->
        <?php //echo base_url('css/ensayoparques/') ?>
        <link href="<?php echo base_url('css/ensayoparques/css/bootstrap.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('css/ensayoparques/css/style.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('css/ensayoparques/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('css/ensayoparques/css/socialize-bookmarks.css') ?>" rel="stylesheet" />
        
        <link href="<?php echo base_url('css/ensayoparques/check_radio/skins/square/aero.css') ?>" rel="stylesheet" />

        <!-- Toggle Switch -->
        <link rel="stylesheet" href="<?php echo base_url('css/ensayoparques/css/jquery.switch.css') ?>" />

        <!-- Owl Carousel Assets -->
        <link href="<?php echo base_url('css/ensayoparques/css/owl.carousel.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('css/ensayoparques/css/owl.theme.css') ?>" rel="stylesheet" />

        <!-- Google web font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css' />

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Jquery -->
        <script src="<?php echo base_url('css/ensayoparques/js/jquery-1.10.2.min.js') ?>"></script>
        <script src="<?php echo base_url('css/ensayoparques/js/jquery-ui-1.8.12.min.js') ?>"></script>

        <!-- Wizard-->
        <script src="<?php echo base_url('css/ensayoparques/js/jquery.wizard.js') ?>"></script>

        <!-- Radio and checkbox styles -->
        <script src="<?php echo base_url('css/ensayoparques/check_radio/jquery.icheck.js') ?>"></script>

        <!-- HTML5 and CSS3-in older browsers-->
        <script src="<?php echo base_url('css/ensayoparques/js/modernizr.custom.17475.js') ?>"></script>

        <!-- Support media queries for IE8 -->
        <script src="<?php echo base_url('css/ensayoparques/js/respond.min.js') ?>"></script>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- OTHER JS --> 
        <script src="<?php echo base_url('css/ensayoparques/js/jquery.validate.js') ?>"></script> 
        <script src="<?php echo base_url('css/ensayoparques/js/jquery.placeholder.js') ?>"></script>
        <script src="<?php echo base_url('css/ensayoparques/js/jquery.tweetable.min.js') ?>"></script> 
        <script src="<?php echo base_url('css/ensayoparques/js/jquery.switch.min.js') ?>"></script>
        <script src="<?php echo base_url('css/ensayoparques/js/quantity-bt.js') ?>"></script>
        <script src="<?php echo base_url('css/ensayoparques/js/bootstrap.js') ?>"></script>
        <script src="<?php echo base_url('css/ensayoparques/js/retina.js') ?>"></script>
        <script src="<?php echo base_url('css/ensayoparques/js/owl.carousel.min.js') ?>"></script>
        <script src="<?php echo base_url('css/ensayoparques/js/functions.js') ?>"></script>  


    </head>

    <body>

        <section id="top-area">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-xs-3" id="logo">
                            <a>
                                Ensayo Virtual
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            &nbsp;
                        </div>     
                        <div class="col-md-6 main-title">
                            <h1>Ensayo Virtual</h1>
                            <p>
                                <?php echo $this->session->userdata('CONVOCATORIA_NOMBRE'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </header>
        </section>         