<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];
echo isset($msg) && $msg != "" ? '<div class="alert alert-danger text-center" role="alert">' . $msg . '</div>' : "" ?>
<h4 class="card-header text-uppercase text-center text-bold mb-4"><?= !isset($modificar) ? "Alta de Historial" : "Modificación de Historial" ?></h4>
<form name='datosHistorial' method="POST" action="index.php?orden=<?= !isset($modificar) ? "AltaHistorial" : "ModificarHistorial" ?>" class="form_inline justify-content-center flex-column flex-md-row">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group my-2">
				<label for="" class="mx-2">Intervención</label>
				<select name="intervencion" class="form-control" required>
					<?php foreach ($intervenciones as $intervencion) {
						print_r($intervencion);
						$selected = isset($modificar) && ($intervencion['id_intervencion'] == $historial['id_intervencion']) ? "selected" : "";
						echo "<option value='" . $intervencion['id_intervencion'] .  "' " . $selected . ">" . $intervencion['intervencion'] . "</option>";
					} ?>
				</select>
			</div>
			<div class="form-group my-2">
				<label for="" class="mx-2">Fecha</label>
				<input type="date" name="fecha" class="form-control" placeholder="Fecha" value="<?= isset($modificar) ? $historial['fecha'] : "" ?>" required>
			</div>
			<div class="form-group my-2">
				<label for="" class="mx-2">Descripción</label>
				<input name="descripcion" maxlength="50" class="form-control" placeholder="Descripción" value="<?= isset($modificar) ? $historial['descripcion'] : "" ?>" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group my-2">
				<label for="" class="mx-2">Observaciones</label>
				<textarea name="observaciones" maxlength="500" rows="7" class="form-control" placeholder="Observaciones" required><?= isset($modificar) ? $historial['observaciones'] : '' ?></textarea>
			</div>
		</div>
	</div>
	<?php if (isset($modificar)) { ?>
		<input type="hidden" name="id_historial" value="<?= $historial['id_historial'] ?>" />
	<?php } ?>
	<div class="form-group mx-2 my-2 text-center">
		<button class="btn btn-success col-2" type="submit">Hecho</button>
		<button class="btn btn-danger col-2" type="button" onclick="window.location='<?= $auto ?>?orden=verHistorial'">Cancelar</button>
	</div>
</form>
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";
?>