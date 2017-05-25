<html>
    <head>
        <title><?php echo isset($title) ? $title : 'SAL - Oh, ohh...!!!' ; ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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
                min-height: 70px;
            }
            .header .logo {
                float: left;
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
                height: 100px;
                background-color: #119548;
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
                width: 280px;
                float: left;
                margin: 38px 0 0 0;
                font-size: 12px;
                color: #fff;
            }
            .footer .optimized {
                position: absolute;
                right: 10px;
                bottom: 1px;    
            }
        </style>
    </head>
    <body>
        <div class="adorno1"></div>
        <div class="adorno2"></div>
        <div class="header">
            <img src="<?php echo base_url(ASSETS .'images/layout/logo.png'); ?>" class="logo"/>
            <div class="textos">
                <span class="negritas">SISTEMA PARA LA ADMINISTRACIÓN</span><br />
                <span>DE LEYENDAS</span>
            </div>
        </div>
        <div class="content">
            <img class="errorimage" src="<?php echo base_url(ASSETS .'images/layout/error.png'); ?>" alt="Error">
            <div class="infoarea">
                <span class="titleerr">¡Oh, no!</span><br/>
                <span class="subt">Atención.</span><br/>
                <span>Actualmente el sitio no tiene soporte para dispositivos móviles</span><br/><br/>
                <span>Disculpe las molestias...</span>
            </div>
        </div>
        <div class="footer">
            <img src="<?php echo base_url(ASSETS .'images/layout/logo_2.png'); ?>" class="logo" />
            <div class="textos">
                <span class="negritas">SISTEMA PARA LA ADMINISTRACIÓN</span><br />
                <span>DE LEYENDAS</span>
            </div>
            <div class="optimized" style="text-align: right; color: #E0E0E0; font-size: 12px">
                <span>Sitio desarrollado en HTML5, optimizado para resolución mínima de 1024 x 768 pixeles,<br/>
                      navegadores Web Google Chrome, Mozilla Firefox, Internet Explorer 9 o superior</span>
            </div>
        </div>
    </body>
</html>