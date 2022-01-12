<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];
echo isset($msg) && $msg != "" ? '<div class="alert alert-danger text-center" role="alert">' . $msg . '</div>' : "" ?>
<h4 class="card-header text-uppercase text-center text-bold mb-4"><?= !isset($modificar) ? "Alta de Cita" : "Modificación de Cita" ?></h4>
<form name='datosCita' method="POST" action="index.php?orden=<?= !isset($modificar) ? "AltaCita" : "ModificarCita" ?>" class="form_inline justify-content-center flex-column flex-md-row">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group my-2">
				<label for="" class="mx-2">Mascota</label>
				<select name="mascota" class="form-control" required>
					<?php foreach ($mascotas as $mascota) {
						$selected = isset($modificar) && ($mascota['id_mascota'] == $cita['id_mascota']) ? "selected" : "";
						echo "<option value='" . $mascota['id_mascota'] .  "' " . $selected . ">" . $mascota['descripcion'] . "</option>";
					} ?>
				</select>
			</div>
			<div class="form-group my-2">
				<label for="" class="mx-2">Intervención</label>
				<select name="intervencion" class="form-control" required>
					<?php foreach ($intervenciones as $intervencion) {
						$selected = isset($modificar) && ($intervencion['id_intervencion'] == $cita['id_intervencion']) ? "selected" : "";
						echo "<option value='" . $intervencion['id_intervencion'] .  "' " . $selected . ">" . $intervencion['intervencion'] . "</option>";
					} ?>
				</select>
			</div>
			<div class="form-group my-2">
				<label for="" class="mx-2">Vigente</label>
				<select name="estado" class="form-control" required>
					<option value="0" <?= isset($modificar) && !$cita['estado'] ? "selected" : "" ?>>Anulada</option>
					<option value="1" <?= isset($modificar) && $cita['estado'] ? "selected" : "" ?>>Vigente</option>
				</select>
			</div>
			<div class="form-group my-2">
				<label for="" class="mx-2">Fecha</label>
				<input type="date" name="fecha" class="form-control" placeholder="Fecha" value="<?= isset($modificar) ? $cita['fecha'] : "" ?>" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group my-2">
				<label for="" class="mx-2">Observaciones</label>
				<textarea name="observaciones" maxlength="500" rows="7" class="form-control" placeholder="Observaciones" required><?= isset($modificar) ? $cita['observaciones'] : '' ?></textarea>
			</div>
		</div>
	</div>
	<?php if (isset($modificar)) { ?>
		<input type="hidden" name="id_cita" value="<?= $cita['id_cita'] ?>" />
	<?php } ?>
	<div class="form-group mx-2 my-2 text-center">
		<button class="btn btn-success col-2" type="submit">Hecho</button>
		<button class="btn btn-danger col-2" type="button" onclick="window.location='<?= $auto ?>?orden=verCitas'">Cancelar</button>
	</div>
</form>
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";
?>