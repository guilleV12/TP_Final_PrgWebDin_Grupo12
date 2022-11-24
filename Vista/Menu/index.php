<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$obj = new AbmMenu();
$lista = $obj->buscar(null);
if ($objSession->validar()){
$combo = '<select class="easyui-combobox"  id="idpadre"  name="idpadre" label="Submenu de?:" labelPosition="top" style="width:90%;">
<option value="">-</option>';
foreach ($lista as $objMenu){
    $combo .='<option value="'.$objMenu->getIdmenu().'">'.$objMenu->getMenombre().':'.$objMenu->getMedescripcion().'</option>';
}

$combo .='</select>'; 
?>
<h3 style="margin-left:1%">ABM - Menu</h3>
<div class="row float-left">
    <div class="col-md-12 float-left">
      <?php 
      if(isset($datos) && isset($datos['msg']) && $datos['msg']!=null) {
        echo $datos['msg'];
      } 
     ?>
    </div>
</div>


<div class="row float-right">

    <div class="col-md-12 " style="margin-left:1%;margin-bottom:1%">
        <a href="javascript:void(0)" iconCls="icon-add" class="easyui-linkbutton" onclick="newMenu()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="editMenu()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" onclick="deshabilitarMenu()">Deshabilitar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="habilitarMenu()">Habilitar</a>
   
</div>

<div id="w" class="easyui-window" title="Producto nuevo:" data-options="closed:true, iconCls:'icon-add'" style="width:610px;height:400px;padding:10px;">

        <form class="ff" method="post" name="ff" id="ff" style="margin-left:30%;" novalidate>
            
            <input id="idmenu" name="idmenu" type="hidden" value="<?php echo count($lista) ?>" data-options="required:true" >            
            
            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="menombre" class="control-label">Menu:</label>
                        <div class="input-group">
                        <input id="menombre" name="menombre" type="text" class="easyui-textbox" data-options="required:true" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="medescripcion" class="control-label">Detalle:</label>
                        <div class="input-group">
                        <input id="medescripcion" name="medescripcion" type="text" class="easyui-textbox"  required data-options="required:true">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                      
                        <div style="margin-bottom:10px">
            <?php 
                echo $combo;
            ?>
             
            </div>
                    </div>
                </div>
            </div>
     
    <a href="javascript:void(0)" class="easyui-linkbutton" id="editarusuariorol" iconCls="icon-add" plain="true" onclick="saveProducto()">Confirmar </a>

    </form>


</div>

  
<table id="dg" title="Lista de Roles" class="easyui-datagrid" style="width:80%;height:400px" url="listar.php" singleSelect="true">
        <thead>
        <tr>
        <th field="idmenu" width="100">ID Menu</th>
        <th field="menombre" width="200">Nombre</th>
        <th field="medescripcion" width="500">Detalle</th>
        <th field="idpadre" width="200">ID Padre</th>
        <th field="medeshabilitado" width="200">Deshabilitado</th>
        </tr>
        </thead>
</table> 

<?php }else { ?>
    <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top w3-center"><code>Acceso Denegado</code></h1>
    <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
    <h3 class="w3-center w3-animate-right">No tiene permiso para ver esta pagina.</h3>
    <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
    <h6 class="w3-center w3-animate-zoom">error: Debe iniciar sesion.</h6>
    </div>`
    <?php
}
 ?>

<script type="text/javascript">
    var url;
    function newMenu(){
        $('#ff').form('clear');
        $('#w').window('open');
        url = 'nuevo.php?idmenu='+$('#idmenu').val();
    }

    function editMenu(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#w').dialog('open').dialog('center').dialog('setTitle','Editar menus');
            $('#ff').form('load',row);
            url = 'editar.php?idmenu='+row.idmenu;
        }
    }

    function saveProducto(){
        //alert(" Accion");
        $('#ff').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
            success: function(result){
                console.log(result);

            var result = eval('('+result+')');
            if (!result.respuesta){
                $.messager.show({
                title: 'Error',
                msg: result.errorMsg
            });
            } else {
                    alert("Listo!");        
                    $('#w').window('close');        // close the dialog
                    $('#dg').datagrid('reload');    // reload 
                    }
                }
        });
    }

    function deshabilitarMenu(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Seguro que desea deshabilitar este menu?', function(r){
            if (r){
                $.post('status.php?idmenu='+row.idmenu,
                function(result){
                if (result.respuesta){
                    $('#dg').datagrid('reload');    // reload the  data
                } else {
                    $.messager.show({    // show error message
                    title: 'Error',
                    msg: result.errorMsg
                    });
                }
                },'json');
                alert("Listo!");   
                $('#dg').datagrid('reload');    // reload the  data
                        }
                    });
                }
    }

    function habilitarMenu(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Seguro que desea habilitar este menu?', function(r){
            if (r){
                $.post('status.php?idmenu='+row.idmenu+'&habilitar=si',
                function(result){
                if (result.respuesta){
                    $('#dg').datagrid('reload');    // reload the  data
                } else {
                    $.messager.show({    // show error message
                    title: 'Error',
                    msg: result.errorMsg
                    });
                }
                },'json');
                alert("Listo!");   
                $('#dg').datagrid('reload');    // reload the  data
                        }
                    });
                }
    }

   
</script>