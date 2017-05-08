<link rel="stylesheet" href="<?php echo base_url(ASSETS .'css/logon/logged.css'); ?>">
<div>
    <div id="bienvenidalabel">
        <span class="texto_negrita texto_bienvenida">Bienvenido...!!!</span>
        <a class="logoutbtn" href="<?php echo site_url('logon/logout'); ?>" data-toggle="tooltip" data-placement="bottom" title="Cerrar sesión">
            <div>
                <i class="fa fa-sign-out fa-3x"></i>
            </div>
            <div class="lbllogout">
                Cerrar sesión
            </div>
        </a>        
        <br/>
        <span class="texto_normal"><?php echo $name; ?></span>
    </div>    
    <div id="imguserlogin">
        <img src="<?php echo base_url(ASSETS .'images/logon/logged.png'); ?>" alt="Sesión iniciada" class="img-circle img_logged" />
    </div>    
</div>