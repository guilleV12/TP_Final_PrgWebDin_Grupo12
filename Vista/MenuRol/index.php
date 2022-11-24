<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$datos = data_submitted();
if ($objSession->validar()){
$objMR= new AbmMenuRol();
$objR = new AbmRol();
$objM = new AbmMenu();
$listaR = $objR->buscar(null);
$listaM = $objM->buscar(null);
$listaMR = $objMR->buscar(null);

?>
<h3 style="margin-left:1%">ABM - Menu Rol</h3>
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
        <a href="javascript:void(0)" iconCls="icon-add" class="easyui-linkbutton" onclick="newMenuRol()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="editMenuRol()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" onclick="eliminarMenuRol()">Eliminar</a>
    </div>
   
</div>

<div id="w" class="easyui-window" title="Menu Rol nuevo:" data-options="closed:true, iconCls:'icon-add'" style="width:610px;height:300px;padding:10px;">

        <form class="ff" method="post" name="ff" id="ff" style="margin-left:30%;" novalidate>
        <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="idmenu" class="control-label">Menu:</label>
                        <div class="input-group">
                        <select id="idmenu" name="idmenu" class="easyui" data-options="required:true" >
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($listaM as $menu){  ?>
                                <option value='<?php echo $menu->getIdMenu() ?>' ><?php echo $menu->getMeNombre() ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="idrol" class="control-label">Rol:</label>
                        <div class="input-group">
                        <select id="idrol" name="idrol" class="easyui" data-options="required:true" >
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($listaR as $rol){  ?>
                                <option value='<?php echo $rol->getIdRol() ?>' ><?php echo $rol->getRoDescripcion() ?></option>
                            <?php } ?>
                        </select> 
                        </div>
                    </div>
                </div>
            </div>

  
     
    <a href="javascript:void(0)" class="easyui-linkbutton" id="editarusuariorol" iconCls="icon-add" plain="true" onclick="saveRol()">Confirmar </a>

    </form>


</div>

  
<table id="dg" title="Lista de Roles" class="easyui-datagrid" style="width:705px;height:400px" url="listar.php" singleSelect="true">
        <thead>
        <tr>
        <th field="idmenu" width="100">ID Menu</th>
        <th field="menombre" width="200">Nombre menu</th>
        <th field="idrol" width="100">ID Rol</th>
        <th field="rodescripcion" width="200">Descripcion rol</th>
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
    function newMenuRol(){
        $('#ff').form('clear');
        $('#w').window('open');
        url = 'nuevo.php';
    }

    function editMenuRol(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#w').dialog('open').dialog('center').dialog('setTitle','Editar usuario rol');
            $('#ff').form('load',row);
            url = 'editar.php?idmenu='+row.idmenu;
        }
    }

    function saveRol(){
        //alert(" Accion");
        $('#ff').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
            success: function(result){
            var result = eval('('+result+')');
            console.log(result);

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

    function eliminarMenuRol(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Seguro que desea eliminar este rol?', function(r){
            if (r){
                $.post('eliminar.php?idmenu='+row.idmenu+'&idrol='+row.idrol,
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