<?php

use App\Controllers\Tutorias\Tutor;
?>


<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutor::class . '::showListaTutores') ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Tutores"><i class="fa-solid fa-angles-left"></i>Regresar</a>
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
        <div class="sbp-preview-content">
            <form action="<?= url_to('\\' . Tutor::class . '::createTutor') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row gx-3 mb-3">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                            <label for="Id_Usuario">Docente</label>
                            <?= form_dropdown('Id_Usuario', $usuario, null, ['class' => 'form-select']) ?>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Inicia">Fecha de Inicio</label>
                            <input class="form-control" type="date" name="Inicia" value="<?= set_value('Inicia') ?>"></input>
                        </div>
                        <div class="col-md-6">
                            <label for="Termina">Fecha de Terminación</label>
                            <input class="form-control" type="date" name="Termina" value="<?= set_value('Termina') ?>"></input>

                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <input class="btn btn-outline-blue" type="submit" name="submit" value="Agregar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>