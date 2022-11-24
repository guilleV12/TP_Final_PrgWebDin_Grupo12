<?php
include_once("../../configuracion.php");
include_once("footer.php");
$objSession = new Session();
$objCompra = new AbmCompra();
$title = "TP final";
?>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Css/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../Css/bootstrap-5.1.3-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../Css/bootstrap-5.1.3-dist/css/bootstrap-utilities.css">
    <link rel="stylesheet" href="../Css/bootstrap-5.1.3-dist/css/bootstrap-reboot.css">
    <!-- JS validator -->
    <script src="../Js/validator.js" type="text/javascript"></script>
    <!-- JQuery easyui -->
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/demo/demo.css">
    <script type="text/javascript" src="../js/jquery-easyui-1.6.6/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery-easyui-1.6.6/jquery.easyui.min.js"></script>
    <!-- Hash md5 -->
    <script src="../Js/md5/md5.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>TP Final</title>    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:-2%;margin-bottom:2%;padding:1%">
  <a class="navbar-brand" href="#">Grupo 12</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../Compra/index.php">Productos</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../home/contacto.php">Contacto</a>
      </li>
      <li class="nav-item">
      
      </li>
      <div class="d-flex mx-5" >

        <?php 

        if ($objSession->validar()){ ?>
        
          <a class="easyui-linkbutton" style="margin-left:850px !important;margin-right:10px !important;padding-top:5px" href="../Admin/administracion.php"><img style="height:20px;width:20px" src="../img/config.PNG"></a>
          <a href="javascript:void(0)" style="margin-right:10px !important;padding-top:5px" class="easyui-linkbutton" onclick="$('#carrito').window('open')"><img style="height:20px;width:20px" src="../img/carrito.PNG"></a>
          <a class="btn btn-outline-primary" style="margin-right:0 !important" href="../Login/cerrarSesion.php" role="button">Cerrar sesion</a>
          <?php }else { ?>
            <a class="btn btn-outline-primary" style="margin-left: 950px !important;" href="../Login/index.php" role="button">Iniciar sesion</a>
          <?php }  ?>
        
      </div>
    </ul>
  </div>
</nav>
<div id="carrito" class="easyui-window" title="Carrito de compras" data-options="modal:true,closed:true" style="width:500px;height:600px;padding:10px;">
        <?php
        if($objSession->validar()){
          if ($_SESSION['rol'] == 'Cliente'){
          $usuarioAct = $objSession->getUsuario();
          $idusuario['idusuario'] = $usuarioAct->getIdUsuario();
          $listaC = $objCompra->buscar(null);
          $idcompra['idcompra'] = "";
          $array_compras = [];
          for ($i=0; $i < count($listaC); $i++) {
              if ($listaC[$i]->getIdUsuario()->getIdUsuario() == $idusuario['idusuario']) {
                  array_push($array_compras, $listaC[$i]);
              }
          }


          $objCI = new AbmCompraItem();
          $listaCI = $objCI->buscar(null);
          $array_compraitem = [];
          for ($e=0; $e < count($listaCI); $e++) { 
              for ($k=0; $k < count($array_compras); $k++) { 
                  if ($array_compras[$k]->getIdCompra() == $listaCI[$e]->getIdCompra()->getIdCompra()) {
                      array_push($array_compraitem, $listaCI[$e]);
                  }
              }
          }


          $objProd = new AbmProducto();
          $listaP = $objProd->buscar(null);
          $array_prods = [];
          for ($m=0; $m < count($listaP); $m++) { 
              for ($n=0; $n < count($array_compraitem); $n++) { 
                  if ($array_compraitem[$n]->getIdProducto()->getIdProducto() == $listaP[$m]->getIdProducto()){
                      array_push($array_prods, $listaP[$m]);
                  }
              }
          }


          foreach ($array_prods as $prod) {
        ?>
        <div class="row">
              <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:150px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $prod->getProNombre();?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
            </div>
        <?php
        }
      }else{ ?>
        <p style="margin-left:130px">Debe tener rol <a href="../Admin/" >cliente</a></p><br>
      <?php
      }
        }
        ?>
         <a href="../CompraEstado/indexClte.php" style="margin-left:130px">Ver estado actual de mis compras</a>
</div>
<script type="text/javascript">
  $('#carrito').window({
    top:20
  })
</script>