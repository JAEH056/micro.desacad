<?php

use App\Controllers\Tutorias\Periodo;
?>


<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Periodo::class . '::showPeriodos') ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Periodos"><i class="fa-solid fa-angles-left"></i>Regresar</a>
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
            <?= csrf_field() ?>
            <div class="row gx-3 mb-3">
                <div class="row gx-3 mb-3">
                    <div class="col-md-12">
                        <label class="ms-2 mb-1" for="Nombre">Nombre</label>
                        <input class="form-control" type="input" name="Nombre" placeholder="Mes - Mes Año" value="<?= set_value('Nombre') ?>"></input>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label class="ms-2 mb-1" for="Inicia">Inicia</label>
                        <input class="form-control" type="date" name="Inicia" value="<?= set_value('Inicia') ?>"></input>
                    </div>
                    <div class="col-md-6">
                        <label class="ms-2 mb-1" for="Termina">Termina</label>
                        <input class="form-control" type="date" name="Termina" value="<?= set_value('Termina') ?>"></input>
                    </div>
                </div>
                <div class="text-center">
                    <input class="btn btn-outline-blue" type="submit" name="submit" value="Crear">
                </div>
            </div>
        </form>
    </div>
</div>