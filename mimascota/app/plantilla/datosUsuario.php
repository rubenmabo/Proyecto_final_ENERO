<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];
echo isset($msg) && $msg != "" ? '<div class="alert alert-danger text-center" role="alert">' . $msg . '</div>' : "" ?>
<h4 class="card-header text-uppercase text-center text-bold mb-4"><?= !isset($modificar) ? "Alta de Usuario" : "Modificación de Usuario" ?></h4>
<form name='datosUsuario' method="POST" action="index.php?orden=<?= !isset($modificar) ? "AltaUsuario" : "ModificarUsuario" ?>" class="form_inline justify-content-center flex-column flex-md-row">
	<?php if (!isset($modificar)) { ?>
		<div class="row">
			<div class="form-group my-2 col-md-4">
				<label for="" class="mx-2">Email</label>
				<input type="email" name="email" maxlength="30" class="form-control" placeholder="Email" required autofocus>
			</div>
			<div class="form-group my-2 col-md-4">
				<label for="" class="mx-2">Password</label>
				<input type="password" name="password" maxlength="10" class="form-control" placeholder="Introduzca su clave" required>
			</div>
			<div class="form-group my-2 col-md-4">
				<label for="" class="mx-2">Repite Password</label>
				<input type="password" name="password2" maxlength="10" class="form-control" placeholder="Repita su clave" required>
			</div>
		</div>
	<?php }	 ?>
	<div class="row">
		<div class="form-group my-2 col-md-4">
			<label for="" class="mx-2">Nombre</label>
			<input name="nombre" maxlength="50" class="form-control" placeholder="Nombre" value="<?= isset($modificar) ? $_SESSION['user']['nombre'] : "" ?>" required>
		</div>
		<div class="form-group my-2 col-md-4">
			<label for="" class="mx-2">Primer Apellido</label>
			<input name="apellido1" maxlength="50" class="form-control" placeholder="Primer Apellido" value="<?= isset($modificar) ? $_SESSION['user']['apellido1'] : "" ?>" required>
		</div>
		<div class="form-group my-2 col-md-4">
			<label for="" class="mx-2">Segundo Apellido</label>
			<input name="apellido2" maxlength="50" class="form-control" placeholder="Segundo Apellido" value="<?= isset($modificar) ? $_SESSION['user']['apellido2'] : "" ?>">
		</div>
	</div>
	<div class="row">
		<div class="form-group my-2 col-md-4">
			<label for="" class="mx-2">DNI</label>
			<input name="dni" maxlength="9" class="form-control" placeholder="12345678A" value="<?= isset($modificar) ? $_SESSION['user']['dni'] : "" ?>" required autofocus>
		</div>
		<div class="form-group my-2 col-md-4">
			<label for="" class="mx-2">Teléfono</label>
			<input type="tel" name="telefono" maxlength="9" minlength="9" class="form-control" placeholder="612345678" value="<?= isset($modificar) ? $_SESSION['user']['telefono'] : "" ?>" required>
		</div>
		<div class="form-group my-2 col-md-4">
			<label for="" class="mx-2">Dirección</label>
			<input name="direccion" maxlength="50" class="form-control" placeholder="Dirección" value="<?= isset($modificar) ? $_SESSION['user']['direccion'] : "" ?>" required>
		</div>
	</div>
	<div class="row">
		<div class="form-group my-2 col-md-4">
			<label for="" class="mx-2">Localidad</label>
			<input name="localidad" maxlength="50" class="form-control" placeholder="Localidad" value="<?= isset($modificar) ? $_SESSION['user']['localidad'] : "" ?>" required>
		</div>
		<div class="form-group my-2 col-md-4">
			<label for="" class="mx-2">Provincia</label>
			<input name="provincia" maxlength="50" class="form-control" placeholder="Provincia" value="<?= isset($modificar) ? $_SESSION['user']['provincia'] : "" ?>" required>
		</div>
		<div class="form-group my-2 col-md-4">
			<label for="" class="mx-2">Código Postal</label>
			<input type="number" name="codigo_postal" maxlength="5" minlength="5" class="form-control" placeholder="12345" value="<?= isset($modificar) ? $_SESSION['user']['codigo_postal'] : "" ?>" required>
		</div>
	</div>
	<div class="form-group mx-2 my-2 text-center">
		<button class="btn btn-success col-2" type="submit" onclick="validar(event)">Hecho</button>
		<button class="btn btn-danger col-2" type="button" onclick="window.location='index.php'">Cancelar</button>
	</div>
</form>
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>