<?php

use App\Controllers\Tutorias\Canalizacion;
use App\Controllers\Tutorias\Tutorado;
?>


<div class="card card-header-actions mt-n10">
    <div class="card-header">
        <span class=""><?= esc($title) ?></span>
        <a href="<?= url_to('\\' . Canalizacion::class . '::showCanalizacion', session()->get('usuario')->Id, $grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Tutores"><i class="fa-solid fa-angles-left"></i>Regresar</a>
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
        <form action="<?= esc(url_to('\\' . Canalizacion::class . '::addIndividual', $grupo)) ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row gx-3 mb-3">
                <div class="col-md-12">
                    <label for="Id_Tutorado">Tutorado</label>
                    <?= form_dropdown('Id_Tutorado', $tutorado, null, ['class' => 'form-select']) ?>
                </div>
            </div>
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label for="Horas">Horas</label>
                    <input class="form-control" type="input" name="Horas" value="<?= set_value('Horas') ?>"></input>
                </div>
                <div class="col-md-6">
                    <label for="Fecha">Fecha</label>
                    <input class="form-control" type="date" name="Fecha" value="<?= set_value('Fecha') ?>"></input>
                </div>
            </div>
            <br>
            <div class="text-center">
                <input class="btn btn-outline-blue" type="submit" name="submit" value="Agregar">
            </div>
        </form>
    </div>
</div>