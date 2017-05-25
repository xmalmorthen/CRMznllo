<div class="container">
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <section class="login-form">
            <div style="text-align: center;"> <img src="<?php echo base_url(IMGS .'logocr-01.png'); ?>" alt="Cruz Roja Mexicana" width="200"> </div>                        
            
            <form method="post" action="<?php echo site_url('/login'); ?>" role="login">
                
                <?php 
                    echo validation_errors(); 
                    if ($this->session->flashdata('errorLogin')){ ?>
                        <div class='alert alert-danger text-left'>
                            <i class='fa fa-exclamation-triangle'></i>
                            <span style='padding-left: 10px;'><?php echo $this->session->flashdata('errorLogin'); ?></span>
                        </div>
                <?php } ?>
                
                <input type="hidden" id="rout" name="rout" value="<?php echo isset($rout) ? $rout : set_value('rout'); ?>"/>
                <input type="email" name="username" id="username" placeholder="Usuario" required autofocus class="form-control input-lg" value="<?php echo set_value('username'); ?>" />
                <input type="password" name="password" id="password" placeholder="Contraseña" required="" class="form-control input-lg" value="<?php echo set_value('password'); ?>" />
                <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Iniciar Sesión</button>
            </form>
        </section>  
    </div>
    <div class="col-md-4"></div>
  </div>
</div>