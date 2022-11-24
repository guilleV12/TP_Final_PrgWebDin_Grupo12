<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$datos = data_submitted();

if ($objSession->validar()){
$objCE = new AbmCompraEstado();
$objCET = new AbmCompraEstadoTipo();
$listaCE = $objCE->buscar(null);
$listaCET = $objCET->buscar(null);
if ($_SESSION['rol'] == 'Cliente'){
?>

<h3 style="margin-left:1%">Mis compras:</h3>
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
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="editCompraEstado()">Editar</a>
    </div>
    </div>


<div id="w" class="easyui-window" title="Usuario Rol nuevo:" data-options="closed:true, iconCls:'icon-add'" style="width:610px;height:300px;padding:10px;">

        <form class="ff" method="post" name="ff" id="ff" style="margin-left:30%;" novalidate>

        <input id="idcompraestado" name="idcompraestado" type="hidden" readonly value="<?php echo count($listaCET) ?>">

        <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="idcompra" class="control-label">Compra:</label>
                        <div class="input-group">
                        <input id="idcompra" name="idcompra" type="text" readonly value="<?php echo count($listaCE) ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="idcompraestadotipo" class="control-label">Estado:</label>
                        <div class="input-group">
                        <select id="idcompraestadotipo" name="idcompraestadotipo" class="easyui" data-options="required:true" >
                            <option value="">Seleccione una opcion</option>
                                <option value='4' ><?php echo $listaCET[3]->getCetDescripcion() ?></option>
                        </select> 
                        </div>
                    </div>
                </div>
            </div>

  
     
    <a href="javascript:void(0)" class="easyui-linkbutton" id="editarusuariorol" iconCls="icon-add" plain="true" onclick="saveRol()">Confirmar </a>

    </form>


</div>

<table id="dg" title="Lista de Compras" class="easyui-datagrid" style="width:800px;height:400px" url="listarClte.php" singleSelect="true">
        <thead>
        <tr>
        <th field="idcompraestado" width="150">ID Compra Estado</th>
        <th field="idcompra" width="100">ID Compra</th>
        <th field="idcompraestadotipo" width="200">ID Compra Estado Tipo</th>
        <th field="cefechaini" width="170">Fecha inicial</th>
        <th field="cefechafin" width="170">Fecha final</th>

        </tr>
        </thead>
</table> 


<?php }else{ ?>
    <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top w3-center"><code>Error de rol!</code></h1>
    <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
    <h3 class="w3-center w3-animate-right">Debe estar en rol de cliente para ver sus compras.</h3>
    <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
    <h6 class="w3-center w3-animate-zoom">Configuración->Cambiar Rol->Cliente.</h6>
    </div>
    <?php
}  }else{?>
        <div class="w3-display-middle">
        <h1 class="w3-jumbo w3-animate-top w3-center"><code>Acceso Denegado</code></h1>
        <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
        <h3 class="w3-center w3-animate-right">No tiene permiso para ver esta pagina.</h3>
        <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
        <h6 class="w3-center w3-animate-zoom">error: Debe iniciar sesion.</h6>
        </div>
<?php
}
?>
  



<script type="text/javascript">
    var url;
    function c(){
        $.get('listarClte.php', function(e){
    // algo que quieras hacer despues de enviar la petición.
        console.log(e);
    });
    }
    function newCompraEstado(){
        $('#ff').form('clear');
        $('#w').window('open');
        url = 'nuevo.php';
    }

    function editCompraEstado(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#w').dialog('open').dialog('center').dialog('setTitle','Editar estado');
            $('#ff').form('load',row);
            url = 'editarClte.php?idcompraestado='+row.idcompraestado;
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

    function eliminarCompraEstado(){
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