<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$obj = new AbmProducto();
$lista = $obj->buscar(null);
if ($objSession->validar()){
?>
<h3 style="margin-left:1%">ABM - Productos</h3>
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
        <a href="javascript:void(0)" iconCls="icon-add" class="easyui-linkbutton" onclick="newProducto()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="editProducto()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" onclick="eliminarProducto()">Eliminar</a>
    </div>
   
</div>

<div id="w" class="easyui-window" title="Producto nuevo:" data-options="closed:true, iconCls:'icon-add'" style="width:610px;height:400px;padding:10px;">

        <form class="ff" method="post" name="ff" id="ff" style="margin-left:30%;" novalidate>
        <input id="idproducto" name ="idproducto" type="hidden" value="<?php echo count($lista) ?>" readonly data-options="required:true" >            
            
            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="pronombre" class="control-label">Producto:</label>
                        <div class="input-group">
                        <input id="pronombre" name="pronombre" type="text" class="easyui-textbox" data-options="required:true" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="prodetalle" class="control-label">Detalle:</label>
                        <div class="input-group">
                        <input id="prodetalle" name="prodetalle" type="text" class="easyui-textbox"  required data-options="required:true">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="procantstock" class="control-label">Stock:</label>
                        <div class="input-group">
                        <input id="procantstock" name="procantstock" type="text" class="easyui-textbox"  required data-options="required:true">
                        </div>
                    </div>
                </div>
            </div>
     
    <a href="javascript:void(0)" class="easyui-linkbutton" id="editarusuariorol" iconCls="icon-add" plain="true" onclick="saveProducto()">Confirmar </a>

    </form>


</div>

  
<table id="dg" title="Lista de Roles" class="easyui-datagrid" style="width:705px;height:400px" url="listar.php" singleSelect="true">
        <thead>
        <tr>
        <th field="idproducto" width="100">ID Producto</th>
        <th field="pronombre" width="200">Nombre</th>
        <th field="prodetalle" width="100">Detalle</th>
        <th field="procantstock" width="200">Stock</th>
        </tr>
        </thead>
</table> 

<?php }else{ ?>
        <div class="w3-display-middle">
        <h1 class="w3-jumbo w3-animate-top w3-center"><code>Acceso Denegado</code></h1>
        <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
        <h3 class="w3-center w3-animate-right">No tiene permiso para ver esta pagina.</h3>
        <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
        <h6 class="w3-center w3-animate-zoom">error: Debe iniciar sesion.</h6>
</div>
    <?php } ?>

<script type="text/javascript">
    var url;
    function newProducto(){
        $('#ff').form('clear');
        $('#w').window('open');
        url = 'nuevo.php';
    }

    function editProducto(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#w').dialog('open').dialog('center').dialog('setTitle','Editar usuario rol');
            $('#ff').form('load',row);
            url = 'editar.php?idusuario='+row.idusuario;
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

    function eliminarProducto(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Seguro que desea eliminar este rol?', function(r){
            if (r){
                $.post('eliminar.php?idproducto='+row.idproducto,
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

