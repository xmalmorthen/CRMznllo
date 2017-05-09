<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button id="btnToggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>">
          <img src="<?php echo base_url(IMGS .'logocr-01.png'); ?>" alt="Cruz Roja Mexicana" width="200">
      </a>      
    </div>
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class=""><a href="<?php echo base_url('index.php/administrador') ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Secciones<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('index.php/administrador/transparencia') ?>">Transparencia</a></li>            
          </ul>
        </li>        
      </ul> 
      <ul class="nav navbar-nav navbar-right">        
        <li><a href="<?php echo base_url('index.php/login/logout') ?>"><span class="glyphicon glyphicon-user"></span> Cerrar Sesión</a></li>
      </ul>
    </div>      
  </div>
</nav>