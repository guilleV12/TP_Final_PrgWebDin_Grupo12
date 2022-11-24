<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$obj = new AbmMenu();
$lista = $obj->buscar(null);
if ($objSession->validar()) {

$arraymenus = [];
if (count($lista) > 0) {
    for ($i = 0; $i < count($lista); $i++){
        if ($lista[$i]->getIdPadre() == null && $lista[$i]->getMeDeshabilitado() == '0000-00-00 00:00:00'){
            array_push($arraymenus,$lista[$i]);
        }
    }

foreach ($arraymenus as $menu){
$objMR = new AbmMenuRol();
$idmenu['idmenu'] = $menu->getIdMenu();
$listaMR = $objMR->buscar($idmenu);
if (count($listaMR) > 0){
if ($listaMR[0]->getIdRol()->getRoDescripcion() == $_SESSION['rol']){
?>

<div class="row">
     <div class="col-2">
     </div>
        <div class="col-4">
        <div class="card m-4" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $menu->getMeNombre(); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text"></p>
                <a href="#" class="easyui-menubutton" data-options="menu:'#mm1'">Categorias</a>
                <div id="mm1" style="width:150px;">
                <?php 
                    foreach($lista as $submenus){
                        if ($submenus->getIdPadre() != null && $submenus->getMeDeshabilitado() == '0000-00-00 00:00:00'){
                            if ($submenus->getIdPadre()->getIdMenu() == $menu->getIdMenu()){
                            ?>
                            <div data-options="iconCls:'icon-undo'"><a href="<?php echo $submenus->getMeDescripcion() ?>"><?php echo $submenus->getMeNombre() ?></a></div>
                            <div class="menu-sep"></div>
                            <?php }
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        </div>


<?php }else{
    ?>
    <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top w3-center"><code>Problema de roles!</code></h1>
    <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
    <h3 class="w3-center w3-animate-right">No tiene el rol adecuado para ver el menu o el menu no tiene un rol asignado.</h3>
    <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
    <h6 class="w3-center w3-animate-zoom">Configuración->Cambiar Rol->Cliente||Configuración->Menu Rol->Editar</h6>
    </div>
    
    <?php
}}} }}else{?>
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