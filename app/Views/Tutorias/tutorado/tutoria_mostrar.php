<?php

use App\Controllers\Tutorias\Tutorado;
?>

<div class="card mt-n10">
    <div class="card-header">
        <div class="row d-flex justify-content-between align-items-end">
            <div class="col-sm-6">
                <span><?= esc($title) ?></span>
            </div>
            <div class="col-sm-auto d-flex gap-2">
                <a class="btn btn-success" href="<?= url_to('\\' . Tutorado::class . '::showAlumAcreditado', $grupo->Id_Grupo) ?>">
                    <i class="fa-solid fa-bookmark"></i>
                    <p class="my-0 ms-1">Acreditar</p>
                </a>
                <a class="btn btn-primary" href="<?= url_to('\\' . Tutorado::class . '::showCreateTutoria', $grupo->Id_Grupo) ?>">
                    <i class="fa-solid fa-circle-plus"></i>
                    <p class="my-0 ms-1">Nueva Tutoría</p>
                </a>
            </div>
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
                    <th>Actividad</th>
                    <th>Horas</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutorias as $tuto): ?>
                    <tr>
                        <td><?= esc($tuto->Descripcion) ?></td>
                        <td><?= esc($tuto->Horas) ?></td>
                        <td><?= esc($tuto->Fecha) ?></td>
                        <td>
                            <a href="<?= url_to('\\' . Tutorado::class . '::showTutoriaAsistencia', $tuto->Id_Tutoria) ?>" class="btn btn-outline-dark">
                                <i class="fa-solid fa-users"></i>
                                <p class="ms-1 my-0">Asistencia</p>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>