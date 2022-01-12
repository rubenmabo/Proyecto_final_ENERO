<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];
echo isset($msg) && $msg != "" ? '<div class="alert alert-danger text-center" role="alert">' . $msg . '</div>' : "" ?>
<h4 class="card-header text-uppercase text-center text-bold mb-4"><?= !isset($modificar) ? "Alta de Mascota" : "Modificación de Mascota" ?></h4>
<form name='datosMascota' method="POST" action="index.php?orden=<?= !isset($modificar) ? "AltaMascota" : "ModificarMascota" ?>" class="form_inline justify-content-center flex-column flex-md-row">
	<div class="row">
		<div class="form-group my-2 col-md-6">
			<label for="" class="mx-2">Nombre</label>
			<input name="nombre" maxlength="30" class="form-control" placeholder="Nombre" value="<?= isset($modificar) ? $mascota['nombre'] : "" ?>" required>
		</div>
		<div class="form-group my-2 col-md-6">
			<label for="" class="mx-2">Fecha de nacimiento</label>
			<input type="date" name="nacimiento" class="form-control" placeholder="Fecha de nacimiento" value="<?= isset($modificar) ? $mascota['fecha_nacimiento'] : "" ?>" required>
		</div>
	</div>
	<div class="row">
		<div class="form-group my-2 col-md-6">
			<label for="" class="mx-2">Especie</label>
			<input name="especie" maxlength="50" class="form-control" placeholder="Especie" value="<?= isset($modificar) ? $mascota['especie'] : "" ?>" required>
		</div>
		<div class="form-group my-2 col-md-6">
			<label for="" class="mx-2">Raza</label>
			<input name="raza" maxlength="50" class="form-control" placeholder="Raza" value="<?= isset($modificar) ? $mascota['raza'] : "" ?>" required>
		</div>
	</div>
	<?php if (isset($modificar)) { ?>
		<input type="hidden" name="id_mascota" value="<?= $mascota['id_mascota'] ?>" />
	<?php } ?>
	<div class="form-group mx-2 my-2 text-center">
		<button class="btn btn-success col-2" type="submit">Hecho</button>
		<button class="btn btn-danger col-2" type="button" onclick="window.location='<?= $auto ?>?orden=verMascotas'">Cancelar</button>
	</div>
</form>
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>