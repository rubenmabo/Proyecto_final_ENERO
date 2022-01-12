<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];
echo isset($msg) && $msg != "" ? '<div class="alert alert-danger" role="alert">' . $msg . '</div>' : "" ?>
<div class="card shadow">
    <h4 class="card-header text-uppercase text-center text-bold mb-4">Listado de Citas</h4>
    <div class="card-body my-3 p-3 justify-content-center">
        <table class="table">
            <thead class="thead-dark card-header">
                <tr>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Fecha</th>
                    <th scope="col" class="text-center">Mascota</th>
                    <?php if ($_SESSION['user']['tipo'] == TIPO_ADMIN) { ?>
                        <th scope="col" class="text-center">Cliente</th>
                        <th scope="col" class="text-center">Telefono</th>
                    <?php } ?>
                    <th scope="col" class="text-center">Intervencion</th>
                    <th scope="col" class="text-center">Observaciones</th>
                    <?php if ($_SESSION['user']['tipo'] == TIPO_ADMIN) { ?>
                        <th scope="col" class="text-center">Accion</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citas as $cita) {
                    $cita = array_values($cita); ?>
                    <tr>
                        <td class="text-center"><?= !$cita[1] ? "Anulada" : "Vigente" ?></td>
                        <?php
                        for ($j = 2; $j < count($cita) - 1; $j++) {
                            if ($_SESSION['user']['tipo'] == TIPO_ADMIN || ($j != 4 && $j != 5)) { ?>
                                <td class="text-center"><?= $cita[$j] ?></td>
                        <?php
                            }
                        } ?>
                        <td class="text-center text-primary">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#observacionesModal<?= $cita[0] ?>"><span class="material-icons">info</span></button>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="observacionesModal<?= $cita[0] ?>" tabindex="-1" role="dialog" aria-labelledby="observacionesModalLabel<?= $cita[0] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="observacionesModalLabel<?= $cita[0] ?>">Observaciones</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p><?= $cita[7] ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($_SESSION['user']['tipo'] == TIPO_ADMIN) { ?>
                            <td class="text-center">
                                <button class="btn btn-warning text-light" onclick="window.location = '<?= $auto ?>?orden=CargaCita&id_cita=<?= $cita[0] ?>'">
                                    <span class="material-icons">edit</span>
                                </button>
                                <button class="btn btn-danger" onclick="confirmarBorrarCita('<?= $cita[0] ?>')">
                                    <span class="material-icons">delete</span>
                                </button>
                            </td>
                        <?php
                        } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if ($_SESSION['user']['tipo'] == TIPO_ADMIN) { ?>
        <div class="p-3">
            <button class="btn btn-danger d-flex align-items-center mx-auto" onclick="window.location = '<?= $auto ?>?orden=RegistroCita'">
                <span class="material-icons px-2">add_box</span>Añadir cita
            </button>
        </div>
    <?php } ?>
</div>


<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido de la página principal
$contenido = ob_get_clean();
include_once "principal.php";

?>