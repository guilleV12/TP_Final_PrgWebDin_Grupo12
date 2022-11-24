<?php 
    include '../../configuracion.php';
    include '../estructura/header.php';
    require_once '../../Utiles/vendor/autoload.php';
    $faker = Faker\Factory::create();
    $objUsuario = new AbmUsuario();
    $usuario = $objSession->getUsuario();
    
?>
<div class="w3-row-padding w3-center w3-margin-top">
<div class="w3-third">
  <div class="w3-card-2 w3-padding-top" style="min-height:460px">
  <h4>Beneficios</h4><br>
  <img src="../img/contacto1.PNG">
  <p>Si se una a nuestra comunidad</p>
  <p>obtendra acceso a productos</p>
  <p>electronicos de primera.</p>
  <p>PCs, TVs, Camaras y Celulares.</p>
  </div>
</div>

<div class="w3-third">
  <div class="w3-card-2 w3-padding-top" style="min-height:460px">
  <h4>Contactos</h4><br>
  <img src="../img/contacto2.PNG" style="border-radius:20%;height:150px;margin-bottom:30px">
  <p>Admin: <?php echo $faker->name() ?></p>
  <p>Telefono: <?php echo $faker->phoneNumber() ?></p>
  <p>Direccion de oficina: <?php echo $faker->address() ?></p>
  <p>Mail: <?php echo $faker->email() ?></p>
  </div>
</div>

<div class="w3-third">
  <div class="w3-card-2 w3-padding-top" style="min-height:460px">
  <h4>Desarrolladores</h4><br>
  <i class="fa fa-diamond w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
  <p>Guillermo Vera</p>
  <p>Mail: <?php echo $faker->email() ?></p>
  <p>Gisel Otero</p>
  <p>Mail: <?php echo $faker->email() ?></p>
  <p>Carla Fernandez</p>
  <p>Mail: <?php echo $faker->email() ?></p>
  <p>Tomas Salto</p>
  <p>Mail: <?php echo $faker->email() ?></p>
  </div>
</div>
</div>