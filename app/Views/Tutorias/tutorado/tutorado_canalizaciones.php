<?php

use App\Controllers\Tutorias\Canalizacion;
use App\Controllers\Tutorias\Formatos;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-4"><?= esc($title) ?></span>
            <a class="col-sm-auto btn btn-primary" href="<?= url_to('\\' . Canalizacion::class . '::showAddCanalizacion', $tutoria->Id_Alumno, $tutoria->Id_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Agregar Canalización"><i class="fa-solid fa-plus"></i>Agregar Canalización</a>
        </div>
    </div>
    <!-- Envia la lista de errores al formulario -->
    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success">
            <div class="position-absolute top-0 end-0 mt-2 me-2">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?= session()->getFlashdata('mensaje') ?>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Departamento</th>
                    <th>Diagnostico</th>
                    <th>Actividades</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($canalizacion as $cana): ?>
                    <tr>
                        <td><?= esc($cana->Fecha) ?></td>
                        <td><?= esc($cana->Departamento) ?></td>
                        <td><?= esc($cana->Diagnostico) ?></td>
                        <td><?= esc($cana->Actividades) ?></td>
                        <td><a href="<?= url_to('\\' . Formatos::class . '::impSeguimiento', $cana->Id) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Informe" target="_blank"><i class="fa-regular fa-file-lines"></i></a></td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>