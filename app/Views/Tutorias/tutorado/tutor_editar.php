<?php

use App\Controllers\Tutorias\Tutor;
use App\Controllers\Tutorias\Tutorado;
?>
<!-- Contenido -->
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutor::class . '::showListaTutores') ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Tutores"><i class="fa-solid fa-angles-left"></i>Regresar</a>
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
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form method="post" action="<?= url_to('\\' . Tutorado::class . '::updateTutor', $tutor->Id) ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="Id" value="<?= esc($tutor->Id) ?>">
                    <input type="hidden" name="Id_Usuario" value="<?= esc($tutor->Id_Usuario) ?>">

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Inicia">Inicia</label>
                            <input class="form-control" type="date" name="Inicia" value="<?= esc($tutor->Inicia) ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="Termina">Termina</label>
                            <input class="form-control" type="date" name="Termina" value="<?= esc($tutor->Termina) ?>">
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <input class="btn btn-outline-blue" type="submit" name="submit" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
        <div>
            <?= validation_list_errors() ?>
        </div>
    </div>
</div>