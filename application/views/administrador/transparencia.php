<style type="text/css">    
</style>
    

<br/>
<div class="page-header">
    <h1>Transparencia</h1>
</div>
<p>Administración de información de transparencia.</p>      
<br/>
<div class="container">
    <div class="row">
        <div id="RegForm" class="col-sm-5">
            <form class="form-horizontal " method="post" enctype="multipart/form-data" action="<?php echo base_url("index.php/administrador/transparencia") ?>">    
                <div class="form-group">
                    <label class="control-label custom-file col-sm-3" for="excelFile">Archivo de Excel:</label>
                    <div class="input-group col-sm-9">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="excelFile" name="excelFile" type="file" class="form-control" accept=".xlsx,.xls">
                    </div>        
                </div>
                <div class="form-group">
                    <label class="control-label custom-file col-sm-3" for="xmlFile">Archivo XML:</label>
                    <div class="input-group col-sm-9">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="xmlFile" name="xmlFile" type="file" class="form-control" accept=".xml">
                    </div>        
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="descFile">Descripción:</label>
                    <div class="col-sm-9" style="padding: 0; margin: 0;">            
                        <textarea id="descFile" name="descFile" class="form-control" rows="5" ></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Registrar</button>                
            </form>
        </div>        
        <div id="RegGrid" class="col-sm-7">
            <label class="control-label" for="xmlFile">Archivos Registrados:</label>
            <table class="table table-condensed">
                <thead>
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
                  </tr>
                  <tr>
                    <td>Mary</td>
                    <td>Moe</td>
                    <td>mary@example.com</td>
                  </tr>
                  <tr>
                    <td>July</td>
                    <td>Dooley</td>
                    <td>july@example.com</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>