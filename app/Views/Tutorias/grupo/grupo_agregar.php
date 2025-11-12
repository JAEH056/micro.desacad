<?php

use App\Controllers\Tutorias\Tutorado;
?>


<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class . '::showTutores') ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Grupos"><i class="fa-solid fa-angles-left"></i>Regresar</a>
        </div>
    </div>
    <div class="card-body">
        <!-- Envia la lista de errores al formulario -->
        <?php if (session()->getFlashdata('error') !== null): $errors = session()->get('error'); ?>
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
            <form action="" method="post">
                <div class="row gx-3 mb-3">
                    <?= csrf_field() ?>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4">
                            <label for="Id_Periodo">Periodo</label>
                            <?= form_dropdown('Id_Periodo', $periodo, null, ['class' => 'form-select', 'id' => 'Id_Periodo']) ?>
                        </div>
                        <div class="col-md-4">
                            <label for="Id_Tutor">Tutor del grupo</label>
                            <?= form_dropdown('Id_Tutor', $tutor, null, ['class' => 'form-select', 'id' => 'Id_Tutor']) ?>
                        </div>
                        <div class="col-md-4">
                            <label for="Nombre">Nombre del grupo</label>
                            <input class="form-control" type="text" name="Nombre" id="Nombre" value="<?= set_value('Nombre') ?>"></input>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="Id_Programa">Programa educativo</label>
                            <?= form_dropdown('Id_Programa', $programa, null, ['class' => 'form-select', 'id' => 'Id_Programa']) ?>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="Fecha">Fecha</label>
                            <input class="form-control" type="date" name="Fecha" id="Fecha" value="<?= set_value('Fecha') ?>"></input>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="Semestre">Semestre</label>
                            <select class="form-select" type="input" name="Semestre" id="Semestre">
                                <option value="Primero">PRIMERO</option>
                                <option value="Segundo">SEGUNDO</option>
                                <option value="Tercero">TERCERO</option>
                                <option value="Cuarto">CUARTO</option>
                                <option value="Quinto">QUINTO</option>
                                <option value="Sexto">SEXTO</option>
                                <option value="Septimo">SEPTIMO</option>
                                <option value="Octavo">OCTAVO</option>
                                <option value="Noveno">NOVENO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <input class="btn btn-outline-blue" type="submit" name="submit" value="Agregar">
                </div>
            </form>
        </div>
    </div>
</div>