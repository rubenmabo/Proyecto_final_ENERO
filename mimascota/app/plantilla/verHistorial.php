<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];
echo isset($msg) && $msg != "" ? '<div class="alert alert-danger" role="alert">' . $msg . '</div>' : "" ?>
<div class="card shadow">
    <h4 class="card-header text-uppercase text-center text-bold mb-4">Listado de Historial</h4>
    <div class="card-body my-3 p-3 justify-content-center">
        <table class="table">
            <thead class="thead-dark card-header">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Mascota</th>
                    <th scope="col" class="text-center">Fecha</th>
                    <th scope="col" class="text-center">Descripción</th>
                    <th scope="col" class="text-center">Intervención</th>
                    <th scope="col" class="text-center">Observaciones</th>
                    <?= $_SESSION['user']['tipo'] == TIPO_ADMIN ? '<th scope="col" class="text-center">Acciones</th>' : '' ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historial as $historia) {
                    $historia = array_values($historia); ?>
                    <tr>
                        <?php
                        for ($j = 0; $j < count($historia) - 1; $j++) { ?>
                            <td class="text-center"><?= $historia[$j] ?></td>
                        <?php } ?>
                        <td class="text-center text-primary">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#observacionesModal<?= $historia[0] ?>"><span class="material-icons">info</span></button>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="observacionesModal<?= $historia[0] ?>" tabindex="-1" role="dialog" aria-labelledby="observacionesModalLabel<?= $historia[0] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="observacionesModalLabel<?= $historia[0] ?>">Observaciones</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p><?= $historia[5] ?></p>
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
                                <button class="btn btn-warning text-light" onclick="window.location = '<?= $auto ?>?orden=CargaHistorial&id_historial=<?= $historia[0] ?>'">
                                    <span class="material-icons">edit</span>
                                </button>
                                <button class="btn btn-danger" onclick="confirmarBorrarHistorial('<?= $historia[0] ?>')">
                                    <span class="material-icons">delete</span>
                                </button>
                            </td>
                    <?php
                        }
                    } ?>
                    </tr>
            </tbody>
        </table>
    </div>
    <?php if ($_SESSION['user']['tipo'] == TIPO_ADMIN) { ?>
        <div class="p-3">
            <button class="btn btn-danger d-flex align-items-center mx-auto" onclick="window.location = '<?= $auto ?>?orden=RegistroHistorial'">
                <span class="material-icons px-2">add_box</span>Añadir historial
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