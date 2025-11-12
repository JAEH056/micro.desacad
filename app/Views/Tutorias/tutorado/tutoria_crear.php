<?php

use App\Controllers\Tutorias\Tutorado;
?>


<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class . '::showTutorias', $grupo->Id_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Tutorias"><i class="fa-solid fa-angles-left"></i>Regresar</a>
        </div>
    </div>
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
    <div class="card-body">
        <form action="" method="post">
            <input type="hidden" name="Id_Grupo" value="<?= esc($grupo->Id_Grupo) ?>">
            <?= csrf_field() ?>
            <div class="row gx-3 mt-3">
                <div class="col-md-6">
                    <label for="Id_Actividades">Actividad</label>
                    <?= form_dropdown('Id_Actividades', $actividad, null, ['class' => 'form-select', 'id' => 'Id_Actividades']) ?>
                </div>
                <div class="col-md-3">
                    <label for="Horas">Horas</label>
                    <input class="form-control" type="number" min="0" name="Horas" id="Horas" value="<?= set_value('Horas') ?>"></input>
                </div>
                <div class="col-md-3">
                    <label for="Fecha">Fecha</label>
                    <input class="form-control" type="date" name="Fecha" id="Fecha" value="<?= set_value('Fecha') ?>"></input>
                </div>
            </div>
            <br>
            <div class="text-center mb-3">
                <input class="btn btn-outline-blue" type="submit" name="submit" value="Agregar">
            </div>
        </form>
    </div>
</div>