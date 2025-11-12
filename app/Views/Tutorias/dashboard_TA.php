<?php

use App\Controllers\Tutorias\Actividad;
use App\Controllers\Tutorias\Alumno;
use App\Controllers\Tutorias\Grupo;
use App\Controllers\Tutorias\Periodo;
use App\Controllers\Tutorias\Tutorado;

$usuario = session_get('usuario');
$rbac = service('Rbac');
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
        </div>
    </div>
    <div class="card-body">
        <div class="row gx-4">
            <!-- Envia la lista de errores al formulario -->
            <?php if (session()->getFlashdata('mensaje') !== null): ?>
                <div class="alert alert-success">
                    <div class="position-absolute top-0 end-0 mt-2 me-2">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?= esc(session()->getFlashdata('mensaje')) ?>
                </div>
            <?php endif; ?>
            <?php if ($rbac->check('SuperUsuario', session()->get('iDpuesto'))): ?>
                <!-- Acceso para administrador -->
                <a class="card card-icon lift lift-sm mb-4 bg-luz" href="<?= url_to('\\' . Tutorado::class . '::showTutores') ?>">
                    <div class="row g-0">
                        <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="bookmark"></i></div>
                        <div class="col">
                            <div class="card-body py-5">
                                <h5 class="card-title text-primary mb-2">Administración Tutorias</h5>
                                <div class="small text-muted">Gestion de tutores y alumnos.</div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card card-icon lift lift-sm mb-4 bg-luz" href="<?= url_to('\\' . Alumno::class . '::showAlumnos') ?>">
                    <div class="row g-0">
                        <div class="col-auto card-icon-aside bg-secondary"><i class="text-white-50" data-feather="users"></i></div>
                        <div class="col">
                            <div class="card-body py-5">
                                <h5 class="card-title text-secondary mb-2">Administración Alumnos</h5>
                                <div class="small text-muted">Lista y creación de alumnos.</div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card card-icon lift lift-sm mb-4 bg-luz" href="<?= url_to('\\' . Periodo::class . '::showPeriodos') ?>">
                    <div class="row g-0">
                        <div class="col-auto card-icon-aside bg-success"><i class="text-white-50" data-feather="calendar"></i></div>
                        <div class="col">
                            <div class="card-body py-5">
                                <h5 class="card-title text-success mb-2">Administración Periodos</h5>
                                <div class="small text-muted">Lista y creación de periodos.</div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endif; ?>
            <?php if ($rbac->check('Docente', session()->get('iDpuesto'))): ?>
                <!-- Acceso para tutores -->
                <a class="card card-icon lift lift-sm mb-4 bg-luz" href="<?= url_to('\\' . Grupo::class . '::showGrupos', esc($tutor->Id)) ?>">
                    <div class="row g-0">
                        <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="book"></i></div>
                        <div class="col">
                            <div class="card-body py-5">
                                <h5 class="card-title text-primary mb-2">Menu Tutores</h5>
                                <div class="small text-muted">Lista de grupos de tutorias.</div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card card-icon lift lift-sm mb-4 bg-luz" href="<?= url_to('\\' . Alumno::class . '::showAlumnos') ?>">
                    <div class="row g-0">
                        <div class="col-auto card-icon-aside bg-secondary"><i class="text-white-50" data-feather="users"></i></div>
                        <div class="col">
                            <div class="card-body py-5">
                                <h5 class="card-title text-secondary mb-2">Alumnos</h5>
                                <div class="small text-muted">Lista de alumnos en tutorias.</div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card card-icon lift lift-sm mb-4 bg-luz" href="<?= url_to('\\' . Actividad::class . '::showActividad') ?>">
                    <div class="row g-0">
                        <div class="col-auto card-icon-aside bg-success"><i class="text-white-50" data-feather="award"></i></div>
                        <div class="col">
                            <div class="card-body py-5">
                                <h5 class="card-title text-success mb-2">Actividades</h5>
                                <div class="small text-muted">Menu de actividades disponibles para tutorias.</div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>