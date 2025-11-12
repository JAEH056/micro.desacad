<?php

use App\Controllers\Tutorias\Alumno;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto btn btn-primary" href="<?= url_to('\\' . Alumno::class . '::crearAlumno') ?>" data-bs-toggle="tooltip" data-bs-title="Agregar Alumno"><i class="fa-solid fa-plus"></i>Agregar Alumno</a>
        </div>
    </div>
    <div class="card-body">
        <!-- Envia la lista de errores al formulario -->
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
                    <th>Numero de control</th>
                    <th>Nombre</th>
                    <th>Curp</th>
                    <th>Sexo</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $alum): ?>
                    <tr>

                        <td><?= esc($alum->Nc) ?></td>
                        <td><?= esc($alum->Nombre) ?></td>
                        <td><?= esc($alum->Curp) ?></td>
                        <td><?= esc($alum->Sexo) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>