<?php

use App\Controllers\Tutorias\Tutorado;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
        </div>
    </div>
    <div class="card-body">
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Horas</th>
                    <th>Fecha</th>
                    <th>Asistencia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutoria as $tuto): ?>
                    <tr>
                        <td><?= esc($tuto->Actividades) ?></td>
                        <td><?= esc($tuto->Horas) ?></td>
                        <td><?= esc($tuto->Fecha) ?></td>
                        <td>
                            <a href="<?= url_to('\\' . Tutorado::class . '::showTutoriaAsistencia', $tuto->Id_Grupo) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Grupales"><i class="fa-solid fa-users"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>