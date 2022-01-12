<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];
echo isset($msg) && $msg != "" ? '<div class="alert alert-danger" role="alert">' . $msg . '</div>' : "" ?>
<div class="card shadow">
    <h4 class="card-header text-uppercase text-center text-bold mb-4">Listado de Mascotas</h4>
    <div class="card-body my-3 p-3 justify-content-center">
        <table class="table">
            <thead class="thead-dark card-header">
                <tr>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Nacimiento</th>
                    <th scope="col" class="text-center">Especie</th>
                    <th scope="col" class="text-center">Raza</th>
                    <th scope="col" class="text-center">Usuario</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mascotas as $mascota) {
                    $mascota = array_values($mascota); ?>
                    <tr>
                        <?php
                        for ($j = 1; $j < count($mascota); $j++) { ?>
                            <td class="text-center"><?= $mascota[$j] ?></td>
                        <?php } ?>
                        <td class="text-center">
                            <button class="btn btn-warning text-light" onclick="window.location = '<?= $auto ?>?orden=CargaMascota&id_mascota=<?= $mascota[0] ?>'">
                                <span class="material-icons">edit</span>
                            </button>
                            <button class="btn btn-danger" onclick="confirmarBorrarMascota('<?= $mascota[1] . "','" . $mascota[0] . "'" ?>)">
                                <span class="material-icons">delete</span>
                            </button>
                            <button class="btn btn-primary" onclick="window.location = '<?= $auto ?>?orden=verHistorial&id_mascota=<?= $mascota[0] ?>'">
                                <span class="material-icons">list_alt</span>
                            </button>
                        </td>
                    <?php } ?>
                    </tr>
            </tbody>
        </table>
    </div>
    <?php if ($_SESSION['user']['tipo'] != TIPO_ADMIN) { ?>
        <div class="p-3">
            <button class="btn btn-danger d-flex align-items-center mx-auto" onclick="window.location = '<?= $auto ?>?orden=RegistroMascota'">
                <span class="material-icons px-2">add_box</span>Añadir mascota
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