<?php

use App\Controllers\Tutorias\Periodo;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto btn btn-primary" href="<?= url_to('\\' . Periodo::class . '::showAddPeriodo') ?>" data-bs-toggle="tooltip" data-bs-title="Crear Nuevo Periodo"><i class="fa-solid fa-plus"></i> Nuevo Periodo</a>
        </div>
        <!-- Envia la lista de errores al formulario -->
        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success mt-3">
                <div class="position-absolute top-0 end-0 mt-2 me-2">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?= session()->getFlashdata('mensaje') ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Inicia</th>
                    <th>Termina</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($periodos as $per): ?>
                    <tr>

                        <td><?= esc($per->Nombre) ?></td>
                        <td><?= esc($per->Inicia) ?></td>
                        <td><?= esc($per->Termina) ?></td>
                        <td>
                            <a href="<?= url_to('\\' . Periodo::class . '::updatePeriodo', $per->Id) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>