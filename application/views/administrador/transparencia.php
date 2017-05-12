<br/>
<div class="page-header">
    <h1>Transparencia</h1>
</div>
<p>Administración de información de transparencia.</p>      
<br/>
<div class="container">
    <div class="row">
        <div id="RegForm" class="col-sm-12">
            <form class="form-horizontal " method="post" enctype="multipart/form-data" action="<?php echo base_url("index.php/administrador/transparencia") ?>">    
                <?php 
                    if ($this->input->post() || $this->session->flashdata('success')) { ?>
                        <div class='alert <?php echo ($this->session->flashdata('error') ? 'alert-danger' : ($this->session->flashdata('success') ? 'alert-success' : 'alert-danger' )); ?>  text-left'>
                            <i class='fa fa-exclamation-triangle'></i>
                            <span style='padding-left: 10px;'><?php echo ($this->session->flashdata('error') ? $this->session->flashdata('error') : ($this->session->flashdata('success') ? $this->session->flashdata('success') : '' )); ?></span>
                        </div>
                <?php } ?>
                
                <div class="form-group">
                    <label class="control-label custom-file col-sm-3" for="excelFile">* Archivo de Excel:</label>
                    <div class="input-group col-sm-8">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="excelFile" name="excelFile" type="file" class="form-control" accept=".xlsx,.xls">
                    </div>        
                </div>
                <div class="form-group">
                    <label class="control-label custom-file col-sm-3" for="xmlFile">* Archivo XML:</label>
                    <div class="input-group col-sm-8">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="xmlFile" name="xmlFile" type="file" class="form-control" accept=".xml">
                    </div>        
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="descFile">Descripción:</label>
                    <div class="col-sm-8" style="padding: 0; margin: 0;">            
                        <textarea id="descFile" name="descFile" class="form-control" rows="5" ></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Registrar</button>
                <h2 class="pull-right label label-warning">* Información requerida</h2>
                
            </form>
            <br/>
            <br/>
        </div>
        <div id="RegGrid" class="col-sm-12">
            <div class="page-header">
                <h3>Repositorio</h3>
            </div>
            <p>Archivos Registrados:</p>
            
            <?php 
                if ($this->session->flashdata('errorAction')) { ?>
                    <div id="errorAction" class='alert alert-danger text-left'>
                        <i class='fa fa-exclamation-triangle'></i>
                        <span style='padding-left: 10px;'><?php echo $this->session->flashdata('errorAction'); ?></span>
                    </div>
            <?php } else if ($this->session->flashdata('successAction')){?>
                    <div id="successAction" class='alert alert-success text-left'>
                        <i class='fa fa-check'></i>
                        <span style='padding-left: 10px;'><?php echo $this->session->flashdata('successAction'); ?></span>
                    </div>
            <?php } ?>
            
            <?php if ($this->session->flashdata('Note')){?>            
                <div id="NoteAction" class='alert alert-warning text-left'>
                    <i class='fa fa-info'></i>
                    <span style='padding-left: 10px;'><?php echo $this->session->flashdata('Note'); ?></span>
                </div>
            <?php } ?>
            
            <?php echo $table; ?>            
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function() { $('#errorAction').alert('close'); $('#successAction').alert('close');  }, 5000);
        setTimeout(function() { $('#successAction').alert('close');  }, 20000);
    })
</script>
    