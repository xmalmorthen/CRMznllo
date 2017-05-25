<html>
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
                
        <style type="text/css">
            body {
              background: #fdfdfd;
              margin: 0;
              padding: 0;
            }
            .adorno1 {
              width: 30%;
              float: left;
              height: 10px;
              background-color: #b5b5b5;
            }
            .adorno2 {
              width: 70%;
              float: left;
              height: 10px;
              background-color: #119548;
            } 
            .header{
                padding: 0 15%;
                padding-top: 20px;
                background-color: #DFDFDF;
                min-height: 98px;
            }
            .header .logo {
                float: left;
                width: 200px;
            }
            .header .textos{
                float: left;
                margin: 18px 0 0 11px;
            }
            .content{
                padding: 0 20%;
                padding-top: 20px;
                text-align: center;
            }
            .content .errorimage{
                height:400px;
                width:400px;
            }
            .content .infoarea{
                text-align: center;
                max-width: 40%;
                display: inline-block;
                margin: 0 0 150px 0;
            }
            .infoarea .titleerr{
                font-size: 85px;
            }
            .infoarea .subt{
                font-size: 35px;
            }
            .footer {
                padding: 0 12%;
                height: 65px;
                background-color: #DFDFDF;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
            }
            .footer .logo {
                margin: 26px 10px 26px 20px;
                float: left;                
            }
            .footer .textos {                
                float: left;
                margin: 38px 0 0 0;
                font-size: .9em;
                color: black;                
            }
            .footer .optimized {
                position: absolute;
                right: 10px;
                bottom: 5px;    
            }
        </style>
    </head>
    <body>
        <div class="header">
            <img src="<?php echo base_url(ASSETS .'imgs/logocr-01.png'); ?>" class="logo"/>
        </div>
        <div class="content">
            <img class="errorimage" src="<?php echo base_url(ASSETS .'imgs/error.png'); ?>" alt="Error">
            <div class="infoarea">
                <span class="titleerr">¡Oh, no!</span><br/>
                <span class="subt">Algo salió mal.</span><br/>
                <span>La versión de su navegador no es compatible con los requerimientos mínimos del sitio. El sitio requiere un navegador que soporte <b style="font-size: 30px; color:#790F0F">HTML5</b></span><br/><br/>
                <span>Le recomendamos actualizar su navegador...</span>
            </div>
        </div>
        <div class="footer">
            <div class="optimized textos" style="text-align: right; ">
                <span>Sitio desarrollado en HTML5, optimizado para resolución mínima de 1024 x 768 pixeles,<br/>
                navegadores Web Google Chrome, Mozilla Firefox, Microsoft Edge, Internet Explorer 9 o superior</span>
            </div>
        </div>
    </body>
</html>