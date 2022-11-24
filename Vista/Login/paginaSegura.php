<?php
    include_once("../Estructura/header.php");
    include_once("../../configuracion.php");
    $objUsuario = new AbmUsuario();
    $usuario = $objSession->getUsuario();
    if ($objSession->validar()){
?>
<div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top w3-center"><code>Bienvenido!</code></h1>
    <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
    <h3 class="w3-center w3-animate-right"></h3>
    <h3 class="w3-center w3-animate-zoom">Si posee mas de un rol y desea cambiarlo:</h3>
    <h6 class="w3-center w3-animate-zoom">Configuración->Cambiar Rol</h6>
    </div>
<div id="win" class="easyui-window" title="My Window" style="width:600px;height:200px" data-options="iconCls:'icon-save',modal:true">
    <h4>Bienvenido <?php echo $usuario->getUsNombre() ?><br>Rol: <?php echo $objSession->getRol(null)->getRoDescripcion() ?> </h4>
</div>

<?php }else{ ?>
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
    $("#win").window({
  left:400,
  top: 60
});
</script>