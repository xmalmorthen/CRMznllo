<!-- Container (About Section) -->
<div id="transparencia" class="container-fluid">
    <?php 
        if ($this->session->flashdata('errorView') !== NULL) { ?>
            <div class="jumbotron">
              <h1>Ocurrión un error</h1>      
              <p>No fue posible leer la información, favor de intentarlo de nuevo.</p>
              <?php echo anchor("main/transparencia",'<i class="fa fa-refresh fa-3x" aria-hidden="true" data-toggle="tooltip" title="Recargar página"></i>',array('title' => 'Recargar', 'class' => 'pull-right')); ?>
            </div>            
    <?php }  else {?>

    <div class="page-header">
        <h1>Información de transparencia</h1>
    </div>
    <h3 class="text-right">Publicado el <span class="label label-success"><?php echo $fileObj['data']['date']; ?></span> a las <span class="label label-success"><?php echo $fileObj['data']['time']; ?></span> horas.</h3>
    <p class="text-right"></p>
    <br/>
    <div class="row">
        <div class="col-sm-12">
            <?php echo $table; ?>
        </div>        
    </div>
    <br/><br/>
    
    <div class="page-header">
        <h3>Descarga de archivos</h3>
    </div>
    
    <?php 
        if ($this->session->flashdata('errorAction')) { ?>
            <div id="errorAction" class='alert alert-danger text-left'>
                <i class='fa fa-exclamation-triangle'></i>
                <span style='padding-left: 10px;'><?php echo $this->session->flashdata('errorAction'); ?></span>
            </div>
    <?php } ?>
    
    
    <div class="row">
        <div class="col-sm-3 col-sm-offset-3 text-center">
            Descargar archivo de Excel
        </div>        
        <div class="col-sm-3 text-center">
            Descargar archivo de XML
        </div>        
    </div>
    <div class="row">
        <div class="col-sm-3 col-sm-offset-3 text-center">
            <?php echo anchor("./transparencia/download/Excel/{$fileObj['Index']}?redirectUri=" . base_url($this->uri->uri_string),'<i class="fa fa-download fa-5x actionButton" aria-hidden="true" data-toggle="tooltip" title="Descargar archivo de Excel"></i>'); ?>
        </div>        
        <div class="col-sm-3 text-center">
            <?php echo anchor("./transparencia/download/XML/{$fileObj['Index']}?redirectUri=" . base_url($this->uri->uri_string),'<i class="fa fa-download fa-5x actionButton" aria-hidden="true" data-toggle="tooltip" title="Descargar archivo XML"></i>'); ?>
        </div>        
    </div>
    <?php } ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function() { $('#errorAction').alert('close'); $('#successAction').alert('close');  }, 5000);
    })
</script>

