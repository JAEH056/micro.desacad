<?php

use App\Controllers\Tutorias\Actividad;
use App\Controllers\Tutorias\Tutorado;
use App\Controllers\Tutorias\Alumno;
use App\Controllers\Tutorias\Grupo;
use App\Controllers\Tutorias\Periodo;
use App\Controllers\Tutorias\Tutor;

$rbac = service('Rbac');

?>
<!-- ************************ -->
<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">

                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">ITSH</div>
                <!-- Sidenav Acceso (Tutores)-->
                <?php if ($rbac->check('SuperUsuario', session()->get('iDpuesto'))): ?>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseTutores" aria-expanded="false" aria-controls="collapseDashboards">
                        <div class="fa-solid fa-chalkboard-user"></div>
                        Tutores
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseTutores" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                            <a class="nav-link" href="<?= url_to('\\' . Tutorado::class . '::showTutores') ?>">Tutorías</a>
                            <a class="nav-link" href="<?= url_to('\\' . Tutor::class . '::showListaTutores') ?>">Tutores</a>
                            <a class="nav-link" href="<?= url_to('\\' . Tutor::class . '::showCreateTutor') ?>">Agregar Tutor</a>
                        </nav>
                    </div>
                <?php endif; ?>

                <?php if ($rbac->check('Docente', session()->get('iDpuesto'))): ?>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseActividades" aria-expanded="false" aria-controls="collapseDashboards">
                        <div class="fa-regular fa-pen-to-square"><i data-feather="activity"></i></div>
                        Actividades
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseActividades" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                            <a class="nav-link" href="<?= url_to('\\' . Actividad::class . '::showActividad') ?>">Crear</a>
                        </nav>
                    </div>
                <?php endif; ?>

                <?php if ($rbac->check('SuperUsuario', session()->get('iDpuesto')) || $rbac->check('Docente', session()->get('iDpuesto'))): ?>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePeriodo" aria-expanded="false" aria-controls="collapseDashboards">
                        <div class="fa-regular fa-calendar-days"></div>
                        Periodo
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePeriodo" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                            <a class="nav-link" href="<?= url_to('\\' . Periodo::class . '::showPeriodos') ?>">Ver</a>
                        </nav>
                    </div>
                    <?php if ($rbac->check('SuperUsuario', session()->get('iDpuesto'))): ?>
                        <div class="collapse" id="collapsePeriodo" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="<?= url_to('\\' . Periodo::class . '::showAddPeriodo') ?>">Agregar</a>
                            </nav>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($rbac->check('SuperUsuario', session()->get('iDpuesto')) || $rbac->check('Docente', session()->get('iDpuesto'))): ?>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAlumos" aria-expanded="false" aria-controls="collapseDashboards">
                        <div class="fa-solid fa-users"><i data-feather="activity"></i></div>
                        Alumnos
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseAlumos" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                            <a class="nav-link" href="<?= url_to('\\' . Alumno::class . '::showAlumnos') ?>">Ver</a>
                            <?php if ($rbac->check('SuperUsuario', session()->get('iDpuesto'))): ?>
                                <a class="nav-link" href="<?= url_to('\\' . Alumno::class . '::showCrearAlumno') ?>">Crear</a>
                            <?php endif; ?>
                        </nav>
                    </div>
                <?php endif; ?>

                <?php if ($rbac->check('Docente', session()->get('iDpuesto'))): ?>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseTutorias" aria-expanded="false" aria-controls="collapseDashboards">
                        <div class="fa-solid fa-chalkboard-user"></div>
                        Tutorías
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseTutorias" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                            <a class="nav-link" href="<?= url_to('\\' . Grupo::class . '::showGrupos', $usuario->Id) ?>">Grupos</a>
                            <!--    <a class="nav-link" href="/*url_to('\\' . Tutorado::class .'::showCanalizacion', $usuario->Id) */">Individuales</a>
                    <a class="nav-link" href="/* url_to('\\' . Tutorado::class .'::findTutorados', $usuario->Id) */">Grupo</a>
                    <a class="nav-link" href="/*url_to('\\' . Tutorado::class . '::showTutorias', $usuario->Id) */">Tutorías</a>-->
                        </nav>
                    </div>
                <?php endif; ?>


                <!--
               <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboardsTu" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-chalkboard-user"></div>
                    Tutorados
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDashboardsTu" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="<?= url_to('\\' . Tutorado::class . '::findTutorados', $usuario->Id) ?>">Ver</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-users"><i data-feather="activity"></i></div>
                    Canalizaciones 
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUsers" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="">Ver</a>

                    </nav>
                </div>
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-users"><i data-feather="activity"></i></div>
                    Tutorias
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUsers" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="">Individual</a>
                    <a class="nav-link" href="">Grupal</a>
                    </nav>
                </div>-->
            </div>
        </div>
    </nav>
</div>