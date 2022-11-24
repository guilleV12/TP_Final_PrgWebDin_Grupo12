<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
if ($objSession->validar()){
$objUs = new AbmUsuario();
$objRolU = new AbmUsuarioRol();
$listaUR = $objRolU->buscar(null);
$objR = new AbmRol();
$listaR = $objR->buscar(null);
?>
   <div class="easyui-layout" id="#win" style="margin-left:400px">
   <h2>Panel de roles personales:</h2>
    <div style="margin:20px 0 10px 0;"></div>
    <div class="easyui-tabs" id="tt" style="width:700px;height:300px">
        <div title="Usuario: <?php echo $objSession->getUsuario()->getUsNombre() ?>" style="padding:10px">
            <p style="font-size:14px"></p>
            <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $objSession->getUsuario()->getIdusuario() ?>">
            <ul>
                <li>Rol actual: <?php echo $_SESSION['rol'] ?></li>
                    <li>Roles disponibles:</li>
                    <ul>
                        <?php foreach ($listaUR as $rol){
                            if ($rol->getIdUsuario()->getIdUsuario() == $objSession->getUsuario()->getIdUsuario()) {
                                foreach ($listaR as $roles){
                                    if ($rol->getIdRol()->getIdRol() == $roles->getIdRol()){
                                        echo "<li>".$roles->getRoDescripcion()."</li>";
                                    }
                                }
                            }
                        }
                          ?>
                    </ul>
                <li>
                <div class="form-group has-feedback">
                        <label for="idrol" class="control-label">Cambio de rol:</label>
                        <div class="input-group">
                        <select id="idrol" name="idrol" class="easyui" data-options="required:true" >
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($listaUR as $rol){  
                                if ($rol->getIdUsuario()->getIdUsuario() == $objSession->getUsuario()->getIdUsuario()) {
                                foreach ($listaR as $roles){
                                    if ($rol->getIdRol()->getIdRol() == $roles->getIdRol()){
                                        echo "<option value='".$roles->getIdRol()."'>".$roles->getRoDescripcion()."</option>";
                                    }
                                }
                            }

                             } ?>
                        </select>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="cambiarRol()">Cambiar de Rol</a>
                </li>
            </ul>
        </div>
        
    </div>
   </div>

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
     function cambiarRol(){
        var idusuario = $("#idusuario").val();
        var idrol = $("#idrol").val();
        var w = $('#win');
        $.post('editarRolActual.php?idusuario='+idusuario+'&idrol='+idrol,
        function(result){
            console.log(result);
                if (result.respuesta){
                    //var w = $('#win');    // reload the  data
                    //w.panel('refresh');
                } else {
                    $.messager.show({    // show error message
                    title: 'Error',
                    msg: result.errorMsg
                    });
                }
                },'json');
                alert("Listo!");   
                location.reload();
    }
</script>