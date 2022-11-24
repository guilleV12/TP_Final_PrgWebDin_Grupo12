<?php include_once ('../../configuracion.php');
      include_once ('../Estructura/header.php');
   

$title = 'Iniciar sesion';
$data = data_submitted();

?>

<div class="container d-flex justify-content-center align-items-start text-center mt-20vh">
  <div class="text-center mx-auto" style="max-width:300px">

    <img class="mb-4" src="../img/logo.png" alt="logo" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>

    <form class="needs-validation" data-toggle="loginValidator" id="form-login" novalidate action="validarLogin.php" method="post">
      <div class="form-group">
        <div class="input-group">
          <div class="input-group w-100">
            <span id="basic-addon1" class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
            </span>
          <input type="text" name="usnombre" id="usnombre" placeholder="Username" class="form-control" required>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <div class="input-group w-100">
            <span id="basic-addon1" class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
            </svg>
            </span>
          <input type="password" name="uspass" id="uspass" placeholder="Password" class="form-control" required>
          </div>
        </div>
      </div>

      


      <button class="btn btn-primary btn-block mt-4" onclick="codificar()" type="submit"><?php if ($objSession->validar()){ ?>Cambiar de usuario<?php }else { ?>Iniciar sesión<?php } ?></button>

    </form>
  </div>

</div>
<button class="btn btn-primary btn-block mt-4" onclick="cod()" type="submit"><?php if ($objSession->validar()){ ?>Cambiar de usuario<?php }else { ?>Iniciar sesión<?php } ?></button>

<?php
if (array_key_exists("error", $data) && $data["error"] == 1) {
  echo "<div class='alert alert-danger w-25 mx-auto d-flex justify-content-center align-items-center  mt-5' role='alert'>
        Usuario y/o contraseña incorrectos.
      </div>";
} ?>
<?php
if (array_key_exists("error", $data) && $data["error"] == 2) {
  echo "<div class='alert alert-danger w-25 mx-auto d-flex justify-content-center align-items-center  mt-5' role='alert'>
        Usuario no tiene rol asignado.
      </div>";
} ?>

<script type="text/javascript">
  var pass = document.getElementById('uspass');
  function codificar(){
    var code = md5(pass.value);
   // pass.value = code;

  }
</script>