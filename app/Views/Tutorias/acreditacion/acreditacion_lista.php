<?php

use App\Controllers\Tutorias\Tutorado;
?>


<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class . '::showTutorias', $tutoria->Id) ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Tutorias"><i class="fa-solid fa-angles-left"></i>Regresar</a>
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
    <div class="sbp-preview-content">
        <div class="card-body">
            <form action="<?= url_to('\\' . Tutorado::class . '::alumAcreditado', $tuto->Id_Tutoria) ?>" method="post">
                <?= csrf_field() ?>
                <div class="row gx-3 mb-3">
                    <?php if (empty($listaAcreditados)): ?>
                        <div class="col mt-5 mx-5">
                            <div class="alert alert-info" role="alert">
                                No hay alumnos por acreditar.
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-md-6">
                            <label for="Fecha">Fecha</label>
                            <input class="form-control" type="date" name="Fecha" value="<?= set_value('Fecha') ?>"></input>
                        </div>
                        <div class="col-md-6">
                            <label class="" for="Id_Usuario">Selecciona a los alumnos acreditados:</label>
                            <?php $i = 0; ?>
                            <?php foreach ($listaAcreditados as $alumno): if ($alumno->acreditado == 0): ?>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="alumnos[<?= $i++ ?>]" value="<?= $alumno->Id_Tutorado ?>">
                                        <label class="form-check-label" for="flexSwitchCheckDefault" name="<?= $alumno->Nombre ?>" for="alumno_<?= $alumno->Id_Tutorado ?>">
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
</div>
<div class="card mt-3">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2">Alumnos acreditados</span>
        </div>
    </div>
    <div class="card-body">
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Número de control</th>
                    <th>Alumno</th>
                    <th>Carrera</th>
                    <th>Fecha de Acreditado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaAcreditados as $tuto): if ($tuto->acreditado != 0): ?>
                        <tr>
                            <td><?= esc($tuto->Nc) ?></td>
                            <td><?= esc($tuto->Nombre) ?></td>
                            <td><?= esc($tuto->Programa) ?></td>
                            <td><?= esc($tuto->Act_Asist) ?></td>
                        </tr>
                <?php endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>