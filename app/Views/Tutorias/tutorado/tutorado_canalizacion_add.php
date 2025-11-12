<?php

use App\Controllers\Tutorias\Canalizacion;
?>


<div class="card mt-n10">
    <div class="card-header d-flex justify-content-between">
        <span class=""><?= esc($title) ?></span>
        <a href="<?= url_to('\\' . Canalizacion::class . '::showCanalizacion', session_get('usuario')->Id, $Id_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Canalizaciones"><i class="fa-solid fa-angles-left"></i>Regresar</a>
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
    <div class="card-body">
        <div class="sbp-preview-content">
            <form action="<?= url_to('\\' . Canalizacion::class . '::addCanalizacion', $Id_Alumno, $Id_Grupo) ?>" method="POST">
                <input type="hidden" name="Id_Tutoria" id="campo_id" value="<?= esc($tutoria->Id_Tutoria) ?>">
                <?= csrf_field() ?>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label for="campo_id_dpto">Departamento</label>
                        <?= form_dropdown('Id_Departamento', $departamento, null, ['class' => 'form-select', 'id' => 'campo_id_dpto']) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="campo_fecha">Fecha</label>
                        <input class="form-control" type="date" name="Fecha" id="campo_fecha" value="<?= set_value('Fecha') ?>"></input>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label for="campo_diagnostico">Diagnostico</label>
                        <input class="form-control" type="input" name="Diagnostico" id="campo_diagnostico" value="<?= set_value('Diagnostico') ?>"></input>
                    </div>
                    <div class="col-md-6">
                        <label for="campo_actividades">Actividades</label>
                        <input class="form-control" type="input" name="Actividades" id="campo_actividades" value="<?= set_value('Actividades') ?>"></input>
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <input class="btn btn-outline-blue" type="submit" name="submit" value="Agregar">
                </div>
            </form>
        </div>
    </div>
</div>