<?php

use App\Controllers\Tutorias\Alumno;
?>


<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Alumno::class . '::showAlumnos') ?>" data-bs-toggle="tooltip" data-bs-title="Lista de Alumnos"><i class="fa-solid fa-angles-left"></i>Regresar</a>
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
            <form action="<?= url_to('\\' . Alumno::class . '::crearAlumno') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row gx-3 mb-3">
                    <div class="row gx-3 mb-2">
                        <div class="col-md-12">
                            <label class="mb-1" for="Nombre">Nombre(s)</label>
                            <input class="form-control" type="input" name="Nombre" value="<?= old('Nombre') ?>"></input>
                        </div>
                    </div>
                    <div class="row gx-3 mb-2">
                        <div class="col-md-6">
                            <label class="mb-1" for="Primer_Apellido">Primer apellido</label>
                            <input class="form-control" type="input" name="Primer_Apellido" value="<?= old('Primer_Apellido') ?>"></input>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-1" for="Segundo_Apellido">Segundo apellido</label>
                            <input class="form-control" type="input" name="Segundo_Apellido" value="<?= old('Segundo_Apellido') ?>"></input>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="mb-1" for="Curp">CURP</label>
                            <input class="form-control" type="input" name="Curp" value="<?= old('Curp') ?>"></input>
                        </div>
                        <div class="col-md-3">
                            <label class="mb-1" for="Nc">Número de control</label>
                            <input class="form-control" type="input" name="Nc" value="<?= old('Nc') ?>"></input>
                        </div>
                        <div class="col-md-3">
                            <label class="mb-1" for="Sexo">Sexo</label>
                            <select class="form-select" type="form-select form-select-lg mb-3" name="Sexo" value="<?= old('Sexo') ?>">
                                <option selected>Selecciona</option>
                                <option value="H">H</option>
                                <option value="M">M</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-outline-blue" type="submit" name="submit" value="Crear">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>