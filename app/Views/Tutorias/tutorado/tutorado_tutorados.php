<?php

use App\Controllers\Tutorias\Formatos;
use App\Controllers\Tutorias\Tutorado;
?>
<div class="container-fluid px-4">
    <div class="row gx-9">
        <div class="card mt-n10">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-8 col-md-6 px-0">
                    <div class="card card-header-actions">
                        <div class="card-header">
                            <span class="col-sm-4"><?= esc($title) ?></span>
                            <div class="row justify-content-between">
                                <a class="col-sm-auto" href="<?= url_to('\\' . Formatos::class . '::impInforme', $grupo->Id_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Informe" target="_blank"><i class="fa-regular fa-file-lines" style="font-size: 2em;"></i></a>
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
                        <!-- Muestra los mensajes en sesion -->
                        <?php if (session()->getFlashdata('mensaje')): ?>
                            <div class="alert alert-success">
                                <div class="position-absolute top-0 end-0 mt-2 me-2">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?= esc(session()->getFlashdata('mensaje')) ?>
                            </div>
                        <?php endif; ?>
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
                </div>
                <div class="col-lg-4 col-md-6 pt-3">
                    <div class="card card-header-actions">
                        <div class="card-header">
                            Agregar Tutorado
                        </div>
                        <div class="card-body">
                            <!-- Envia la lista de errores al formulario -->
                            <?php if (validation_list_errors()): ?>
                                <div class="alert alert-danger">
                                    <div class="position-absolute top-0 end-0 mt-2 me-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?= validation_list_errors() ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= url_to('\\' . Tutorado::class . '::addTutorado') ?>" method="POST">
                                <?= csrf_field() ?>
                                <input type="hidden" name="Id_Grupo" value="<?= esc($grupo->Id_Grupo) ?>">
                                <div class="col-xl-12">
                                    <label class="mx-1 pb-2" for="Id_Alumno">Alumno</label>
                                    <?= form_dropdown('Id_Alumno', $alumno, null, ['class' => 'form-select']) ?>
                                </div>
                                <div class="text-center pt-4 pb-2">
                                    <button class="btn btn-outline-blue" type="submit" name="submit">Agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>