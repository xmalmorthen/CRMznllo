<div class="container">
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <section class="login-form">
            <div style="text-align: center;"> <img src="<?php echo base_url(IMGS .'logocr-01.png'); ?>" alt="Cruz Roja Mexicana" width="200"> </div>                        
            <?php echo validation_errors(); ?>
            <form method="post" action="<?php echo base_url('index.php/login'); ?>" role="login">
                <input type="hidden" id="rout" name="rout" value="<?php echo isset($rout) ? $rout : ''; ?>"/>
                <input type="email" name="username" id="username" placeholder="Usuario" required autofocus class="form-control input-lg" />
                <input type="password" name="password" id="password" placeholder="Contraseña" required="" class="form-control input-lg"  />
                <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Iniciar Sesión</button>
            </form>
        </section>  
    </div>
    <div class="col-md-4"></div>
  </div>
</div>