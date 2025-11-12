<?php

use App\Controllers\Tutorias\Canalizacion;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto btn btn-primary" href="<?= url_to('\\' . Canalizacion::class . '::showAddIndividual', $ID_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Agregar Tutoria Individual"><i class="fa-solid fa-plus"></i>Agregar</a>
        </div>
    </div>
    <div class="card-body">
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Número de control</th>
                    <th>Nombre del Alumno</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($canalizaciones as $cana): ?>
                    <tr>
                        <td><?= esc($cana->Nc) ?></td>
                        <td><?= esc($cana->Alumno) ?></td>
                        <td>
                            <a href="<?= url_to('\\' . Canalizacion::class . '::alumnoCanalizacion', $cana->Id_Alumno, $cana->Id_Grupo) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Canalizaciones"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>