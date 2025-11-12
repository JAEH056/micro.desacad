<?php

use App\Controllers\Tutorias\Tutor;
use App\Controllers\Tutorias\Tutorado;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto btn btn-primary" href="<?= url_to('\\' . Tutor::class . '::showCreateTutor') ?>" data-bs-toggle="tooltip" data-bs-title="Nuevo Tutor"><i class="fa-solid fa-plus"></i>Nuevo Tutor</a>
        </div>
    </div>
    <div class="card-body">
        <!-- Muestra los mensajes en sesion -->
        <?php if (session()->getFlashdata('mensaje') !== null): ?>
            <div class="alert alert-success">
                <div class="position-absolute top-0 end-0 mt-2 me-2">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?= esc(session()->getFlashdata('mensaje')) ?>
            </div>
        <?php endif; ?>
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Tutor</th>
                    <th>Puesto</th>
                    <th>Inicio</th>
                    <th>Termina</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutores as $tuto): ?>
                    <tr>

                        <td><?= esc($tuto->Nombre) ?></a></td>
                        <td><?= esc($tuto->Puesto) ?></td>
                        <td><?= esc($tuto->Inicia) ?></td>
                        <td><?= esc($tuto->Termina) ?></td>
                        <td>
                            <a href="<?= url_to('\\' . Tutorado::class . '::showUpdateTutor', $tuto->Id) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>