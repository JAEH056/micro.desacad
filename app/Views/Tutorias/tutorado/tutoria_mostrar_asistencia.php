<?php

use App\Controllers\Tutorias\Formatos;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Formatos::class . '::impInforme', $grupo->Id_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Informe"><i class="fa-regular fa-file-lines" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body">
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Número de control</th>
                    <th>Alumno</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutorados as $tuto): ?>
                    <tr>
                        <td><?= esc($tuto->Nc) ?></td>
                        <td><?= esc($tuto->Alumno) ?></td>
                        <td><?= esc($tuto->Carrera) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>