<br/>
<div class="page-header">
    <h1>Transparencia</h1>
</div>
<p>Administración de información de transparencia.</p>      
<div class="container">
    <div class="row">
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
        <div id="RegForm" class="col-sm-12 pading-top">
            <div class="page-header">
                <h3>Formulario de Registro</h3>
            </div>
            <form class="form-horizontal " method="post" enctype="multipart/form-data" action="<?php echo base_url("index.php/administrador/transparencia") ?>">    
                <?php 
                    if ($this->input->post() || $this->session->flashdata('success')) { ?>
                        <div class='alert <?php echo ($this->session->flashdata('error') ? 'alert-danger' : ($this->session->flashdata('success') ? 'alert-success' : 'alert-danger' )); ?>  text-left'>
                            <i class='fa fa-exclamation-triangle'></i>
                            <span style='padding-left: 10px;'><?php echo ($this->session->flashdata('error') ? $this->session->flashdata('error') : ($this->session->flashdata('success') ? $this->session->flashdata('success') : '' )); ?></span>
                        </div>
                <?php } ?>
                
                <div class="form-group">
                    <label class="control-label custom-file col-sm-3" for="htmlFile"><a href="#" data-toggle="tooltip" title="Información requerida">*</a> Archivo HTML: </label>
                    <div class="input-group col-sm-8">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
                        <input id="htmlFile" name="htmlFile" type="file" class="form-control" accept=".html">
                    </div>        
                </div>                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="descFile">Descripción:</label>
                    <div class="col-sm-8" style="padding: 0; margin: 0;">            
                        <textarea id="descFile" name="descFile" class="form-control" rows="5" ></textarea>
                    </div>
                </div>
                <button id="btnSubmit" type="submit" class="btn btn-success btn-md" data-loading-text="<i class='fa fa-spinner fa-pulse fa-2x fa-fw'></i> Registrando, favor de esperar..."><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp; Registrar</button>
                <h2 class="pull-right label label-warning">* Información requerida</h2>                
            </form>
        </div>
    </div>
</div>

<style type="text/css">
    .modal-header, h4, .close {
        background-color: #5cb85c;
        color:white !important;
        text-align: center;
        font-size: 30px;
    }
    .modal-footer {
        background-color: #f9f9f9;
    }
    .modal-dialog {
        margin: 105px!Important;
    }
    @media (min-width: 768px) {
        .modal-dialog {        
            margin: 110px auto!Important;
        }
    }
</style>

<script type="text/javascript">
    
    function cancelDeleteAction(){
        $('body').click();
    }
    
    $(document).ready(function(){
        setTimeout(function() { $('#errorAction').alert('close'); $('#successAction').alert('close');  }, 5000);
        setTimeout(function() { $('#successAction').alert('close');  }, 20000);
        
        $('form').submit(function () {
            var $this = $('#btnSubmit');
            $this.button('loading');
            setTimeout(function () {
                $this.button('reset');
            }, 30000);
        });

        $(".deleteActionBtn").popover(
            {                
                html: true, 
                placement: "left"
            }
        );

        $('body').on('click', function (e) {            
            $('[data-toggle="popover"],[data-original-title]').each(function () {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {                
                    (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
                }
            });
        });
        
        $(".deleteActionBtn").click(function(event){
            event.preventDefault();
        });
    })
</script>
    