<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];
echo isset($msg) && $msg != "" ? '<div class="alert alert-danger text-center" role="alert">' . $msg . '</div>' : "" ?>
<h4 class="card-header text-uppercase text-center text-bold mb-4">Login</h4>
<form name='ACCESO' method="POST" action="index.php" class="form_inline justify-content-center flex-column flex-md-row">
	<div class="row">
		<div class="form-group my-2">
			<label for="" class="mx-2 hidden-sm-down">Email:</label>
			<!--<input type="email" name="email" class="form-control" placeholder="Email" required autofocus value="<?= $email ?>">-->
			<input type="email" name="email" class="form-control" placeholder="email@email.com" required autofocus>
		</div>
		<div class="form-group my-2">
			<label for="" class="mx-2 hidden-sm-down">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Introduzca su clave" required>
		</div>
	</div>
	<div class="form-group mx-2 my-2 text-center">
		<button class="btn btn-danger col-2" type="submit" name="orden">Entrar</button>
	</div>
	<div class="form-group mx-2 my-2 text-center">
		<a href="index.php?orden=Registro" class="text-danger">¿No estas registrado?</a>
	</div>
</form>
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";
?>