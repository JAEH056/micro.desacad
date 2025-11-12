<?php

use App\Controllers\Tutorias\Formatos;
use App\Controllers\Tutorias\Tutorado;
?>


<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class . '::showTutorias', $tutoria->Id_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Tutorias"><i class="fa-solid fa-angles-left"></i>Regresar</a>
        </div>
    </div>
    <!-- Envia la lista de errores al formulario -->
    <?php if (session()->getFlashdata('error')): $errors = session()->get('error'); ?>
        <div class="alert alert-danger">
            <div class="position-absolute top-0 end-0 mt-2 me-2">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php foreach ($errors as $field => $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success">
            <div class="position-absolute top-0 end-0 mt-2 me-2">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?= session()->getFlashdata('mensaje') ?>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <form action="" method="post">
            <input type="hidden" name="Id_Tutoria" value="<?= esc($tgrupal->Id_Tutoria) ?>">
            <?= csrf_field() ?>
            <div class="row gx-3 mb-3">
                <?php if (empty($listaAsistencia)): ?>
                    <div class="alert alert-info" role="alert">
                        No hay asistencias para mostrar.
                    </div>
                <?php else: ?>
                    <div class="col-md-6">
                        <label for="Fecha">Fecha</label>
                        <input class="form-control" type="date" name="Fecha" value="<?= set_value('Fecha') ?>"></input>
                    </div>
                    <div class="col-md-6 ">
                        <label for="Id_Usuario">Alumnos que asistieron a tutoria</label>
                        <?php $i = 0; ?>
                        <?php foreach ($listaAsistencia as $alumno): if ($alumno->asistencia == 0): ?>
                                <div class="form-check mb-2">
                                    <?= form_checkbox('alumnos[' . ($i++) . ']', $alumno->Id_Tutorado, false, ['class' => 'form-check-input', 'id' => $alumno->Id_Tutorado]) ?>
                                    <label class="form-check-label" name="<?= $alumno->Nombre ?>" for="alumno_<?= $alumno->Id ?>">
                                        <?= $alumno->Nombre ?>
                                    </label>
                                </div>
                        <?php endif;
                        endforeach ?>
                    </div>
                    <br>
                    <div class="text-center mt-3">
                        <input class="btn btn-outline-blue" type="submit" name="submit" value="Agregar">
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2">Alumnos con asistencia</span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Formatos::class . '::impInforme', $tutoria->Id_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Informe" target="_blank"><i class="fa-regular fa-file-lines" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body">
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Número de control</th>
                    <th>Alumno</th>
                    <th>Carrera</th>
                    <th>Fecha de Asistencia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaAsistencia as $tuto): if ($tuto->asistencia != 0): ?>

                        <tr>
                            <td><?= esc($tuto->Nc) ?></td>
                            <td><?= esc($tuto->Nombre) ?></td>
                            <td><?= esc($tuto->Programa) ?></td>
                            <td><?= esc($tuto->Fecha_Asistencia) ?></td>
                        </tr>
                <?php endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>