<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo isset($title) ? $title : 'Cruz Roja Manzanillo Colima' ; ?></title>
      
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="ROBOTS" content="INDEX, FOLLOW">
    <meta property="og:title" content="Cruz Roja Manzanillo Colima">

    <meta name="description" content="Conoce más de la Cruz Roja Manzanillo Colima ¡Cruz Roja somos todos! Conócenos y se parte de nuestra comunidad">
    <meta name="og:description" content="Conoce más de la Cruz Roja Manzanillo Colima ¡Cruz Roja somos todos! Conócenos y se parte de nuestra comunidad">

    <meta property="og:image" content="<?php echo base_url(IMGS .'logocr-01.png'); ?>">
    <meta name="image" content="<?php echo base_url(IMGS .'logocr-01.png'); ?>">
    <link rel="image_src" href="<?php echo base_url(IMGS .'logocr-01.png'); ?>">
    
    <link rel="icon" href="<?php echo base_url(IMGS .'icocr-01.png'); ?>" sizes="16x16 32x32" type="image/png">
    
    <meta property="og:type" content="website">

    <meta name="keywords" content="cruz roja, cruz roja mexicana, cruz roja manzanillo, cruz roja manzanillo colima">
    <meta name="author" content="Cruz Roja Manzanillo Colima">
    <meta property="og:url" content="http://cruzrojamexicana.org.mx/">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo base_url(FWRKS .'bootstrap-3.3.7/css/bootstrap.min.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(FWRKS .'font-awesome-4.7.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(CSS .'master.css'); ?>">

    <?php 
        if (isset($link)) {
            foreach ($link as &$valor) {
                echo $valor;
            }
        } 
    ?>
    
    <script src="<?php echo base_url(FWRKS .'jquery-3.2.1/jquery-3.2.1.min.js'); ?>"></script>
    <script src="<?php echo base_url(FWRKS .'bootstrap-3.3.7/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url(JS .'modernizr-custom.js'); ?>"></script>
    
</head>
<body id="top" data-spy="scroll" data-target=".navbar" data-offset="60">
    <noscript><meta http-equiv="refresh" content="0;url=<?php echo site_url('error/noscript'); ?>"></noscript>
    <div class="container">
        <!-- MENU SECTION -->    
        <?php if (isset($menu)) echo $menu; ?>
        <!-- CONTENT SECTION -->
        <div class="pading-top">
            <!-- ERROR GENERAL SECTION -->
            <?php 
                if ($this->session->flashdata('errorGeneral')) { ?>
                    <div id="errorGeneral" class='alert alert-danger text-center'>
                        <i class='fa fa-exclamation-triangle'></i>
                        <span style='padding-left: 10px;'><?php echo $this->session->flashdata('errorGeneral'); ?></span>
                    </div>
            <?php } ?>
            
            <?php if (isset($content)) echo $content; ?>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <!-- FOOTER SECTION -->
        <?php $this->load->view("sections/footer") ?>
    </div>
    
    <!-- SCRIPTS SECTION -->    
    <script src="<?php echo base_url(JS .'master.js'); ?>"></script>
    
    <?php
        if (isset($script)) {
            foreach ($script as &$valor) {
                echo $valor;
            } 
        }
    ?>
    
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function() { $('#errorGeneral').alert('close').remove();}, 5000);
            
            if (!Modernizr.borderradius) {
                window.location= '<?php echo site_url('error/compatibilidad'); ?>';
            };
            
            $('[data-toggle="tooltip"]').tooltip(); 
            $('[data-toggle="popover"]').popover({ html: true });
            <?php if (isset($scripts)) echo $scripts; ?>
        })
    </script>

</body>
</html>
