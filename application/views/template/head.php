<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        ?>              
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo base_url('images/vice/favicon.png'); ?>">

        <title><?php echo $title; ?></title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">


        <?php if ($template_config['signin']): ?>
            <!-- Custom styles for this template -->
            <link href="<?php echo base_url('dist/css/signin.css'); ?>" rel="stylesheet">        
        <?php endif; ?>


        <?php if ($template_config['bootstrap-theme']): ?>
            <!-- Bootstrap theme -->
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.css">
        <?php endif; ?>

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('dist/css/theme.css'); ?>" rel="stylesheet">

        <link href="<?php echo base_url('dist/css/docs.min.css'); ?>" rel="stylesheet">

        <link href="<?php echo base_url('dist/css/sticky-footer.css'); ?>" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <?php if ($template_config['jquery']): ?>
            <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <?php endif; ?>

        <?php if ($template_config['validate']): ?>
            <script src="<?php echo base_url('dist/js/jquery.validate.min.js'); ?>"></script> 
            <script src="<?php echo base_url('dist/js/messages_es.js'); ?>"></script>
        <?php endif; ?>

        <link href="<?php echo base_url('dist/css/style.css'); ?>" rel="stylesheet">

        <?php if ($template_config['bootstrapjs']): ?>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <?php endif; ?>

        <script src="<?php echo base_url('docs-assets/js/holder.js'); ?>"></script>        


        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.1/themes/redmond/jquery-ui.css">


        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/flick/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>    

        <script src="<?php echo base_url('js/script_umb.js'); ?>"></script>   


        <script src="<?php echo base_url('dist/js/bootstrap-button.js'); ?>"></script>
        <script>
            var base_url_js = '<?php echo base_url(); ?>';
        </script>

        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-55303628-1', 'auto');
            ga('send', 'pageview');

        </script>        

    </head>
    <body>