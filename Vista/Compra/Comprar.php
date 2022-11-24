<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$obj = new AbmProducto();
$lista = $obj->buscar(null);
$data = data_submitted();
if ($objSession->validar()) {
$variable = $data['tipo'];
switch ($variable) {
    case 'Camara':
        for ($i=0; $i < count($lista); $i++){
            if ($lista[$i]->getProDetalle() == "Camara"){
            if ($lista[$i]->getProCantStock() > 0){
        ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                    <img <?php echo 'src="../img/camara'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton" onclick="nuevaCompra(<?php echo $lista[$i]->getIdProducto() ?>)">Anadir al carrito</a>
                </div>
            </div>
            </div>
        
        <?php
        }else { ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                    <img <?php echo 'src="../img/camara'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton">No hay stock</a>
                </div>
            </div>
            </div>
            <?php
        }}}
        
        break;

    case 'Celular':
        for ($i=0; $i < count($lista); $i++){
            if ($lista[$i]->getProDetalle() == "Celular"){
            if ($lista[$i]->getProCantStock() > 0){
        ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                    <img <?php echo 'src="../img/celular'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton" onclick="nuevaCompra(<?php echo $lista[$i]->getIdProducto() ?>)">Anadir al carrito</a>
                </div>
            </div>
            </div>
        
        <?php
        }else { ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                    <img <?php echo 'src="../img/celular'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton">No hay stock</a>
                </div>
            </div>
            </div>
            <?php
        }
        }}
        

    break;

    case 'TV':
        for ($i=0; $i < count($lista); $i++){
            if ($lista[$i]->getProDetalle() == "TV"){
        ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                        <img <?php echo 'src="../img/TV'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton" onclick="nuevaCompra(<?php echo $lista[$i]->getIdProducto() ?>)">Anadir al carrito</a>
                </div>
            </div>
            </div>
        
        <?php
        }}
        

    break;

    case 'PC':
        for ($i=0; $i < count($lista); $i++){
            if ($lista[$i]->getProDetalle() == "PC"){
        ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                        <img <?php echo 'src="../img/PC'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton" onclick="nuevaCompra(<?php echo $lista[$i]->getIdProducto() ?>)">Anadir al carrito</a>
                </div>
            </div>
            </div>
        
        <?php
        }}
    break;
    
    default:
        # code...
        break;
}}else{ ?>
    <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top w3-center"><code>Acceso Denegado</code></h1>
    <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
    <h3 class="w3-center w3-animate-right">No tiene permiso para ver esta pagina.</h3>
    <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
    <h6 class="w3-center w3-animate-zoom">error: Debe iniciar sesion.</h6>
    </div>
    <?php
}

if ($objSession->validar()){
?>
<script type="text/javascript">
  function nuevaCompra(prod){
    var url = 'nuevaCompra.php?idproducto='+prod;
    var idproducto = prod;

    $.get(url, function(e){
    // algo que quieras hacer despues de enviar la petición.
            
        
    });

  }
</script>

<?php
}else { ?>
    <script type="text/javascript">
  function nuevaCompra(prod){
    $.messager.show({    // show error message
                    title: 'Error',
                    msg: 'Debe iniciar sesion para comprar'
                    });     

  }
</script>
<?php
}
?>