<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$datos = data_submitted();

$obj= new AbmUsuario();
$lista = $obj->buscar(null);
if ($objSession->validar()){
switch ($_SESSION['rol']) {
    case 'Administrador':
        ?>
       
        <div class="tab" style="margin-left:20%">
            <h4 style="margin-bottom:3%">Administracion del sitio: </h4>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Usuarios</a>
                <a href="../Usuario/index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a><br>
            </div>
            <div class="item2" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Roles</a>
                <a href="../Rol/index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Usuario Rol</a>
                <a href="../UsuarioRol/index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Cambiar Rol</a>
                <a href="../UsuarioRol/cambiarRol.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
           
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Menus</a>
                <a href="../Menu/index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Menu rol</a>
                <a href="../MenuRol/index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Compra Estado</a>
                <a href="../CompraEstado/index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
        </div>
<?php
        break;

    case 'Cliente':
        ?>
        <div class="tab" style="margin-left:20%">
            <h4 style="margin-bottom:3%">Administracion de cuenta: </h4>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Datos cuenta</a>
                <a href="../Usuario/indexClte.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a><br>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Estado de mis compras</a>
                <a href="../CompraEstado/indexClte.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Cambiar Rol</a>
                <a href="../UsuarioRol/cambiarRol.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
        </div>

<?php

        break;

    case 'Deposito':
        ?>
        <div class="tab" style="margin-left:20%">
            <h4 style="margin-bottom:3%">Administracion : </h4>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Productos</a>
                <a href="../Productos/index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Cambiar Rol</a>
                <a href="../UsuarioRol/cambiarRol.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Compra Estado</a>
                <a href="../CompraEstado/index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
        </div>

<?php

        break;
    
    default:
        # code...
        break;
}

} else{ ?>
    <div class="w3-display-middle">
<h1 class="w3-jumbo w3-animate-top w3-center"><code>Acceso Denegado</code></h1>
<hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
<h3 class="w3-center w3-animate-right">No tiene permiso para ver esta pagina.</h3>
<h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
<h6 class="w3-center w3-animate-zoom">error: Debe iniciar sesion.</h6>
</div>
<?php } 
?>