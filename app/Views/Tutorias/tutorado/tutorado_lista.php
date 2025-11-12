<?php

use App\Controllers\Tutorias\Canalizacion;
use App\Controllers\Tutorias\Grupo;
use App\Controllers\Tutorias\Tutorado;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto btn btn-primary h-25" href="<?= url_to('\\' . Grupo::class . '::addGrupo') ?>" data-bs-toggle="tooltip" data-bs-title="Nuevo Grupo"><i class="fa-solid fa-plus"></i>Nuevo Grupo</a>
        </div>
    </div>
    <div class="card-body">
        <!-- Envia la lista de mensajes al formulario -->
        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success">
                <div class="position-absolute top-0 end-0 mt-2 me-2">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <p><?= esc(session()->getFlashdata('mensaje')) ?></p>
            </div>
        <?php endif; ?>
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Tutor</th>
                    <th>Carrera</th>
                    <th>Nombre</th>
                    <th>Semestre</th>
                    <th>Periodo</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutorados as $tuto): ?>
                    <tr>

                        <td><a href="<?= url_to('\\' . Tutorado::class . '::dataTutor', $tuto->Id) ?>"><?= esc($tuto->Tutor) ?></a></td>
                        <td><?= esc($tuto->Carrera) ?></td>
                        <td><?= esc($tuto->Nombre) ?></td>
                        <td><?= esc($tuto->Semestre) ?></td>
                        <td><?= esc($tuto->Periodo) ?></td>
                        <td>
                            <!--<a href="" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Canalizaciones"><i class="fa-solid fa-circle-info"></i></a>-->
                            <a href="<?= url_to('\\' . Tutorado::class . '::showTutorados', $tuto->Id_Grupo) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Grupales"><i class="fa-solid fa-users"></i></a>
                            <a href="<?= url_to('\\' . Canalizacion::class . '::showIndividuales', $tuto->Id, $tuto->Id_Grupo) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Individuales"><i class="fa-solid fa-user"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>