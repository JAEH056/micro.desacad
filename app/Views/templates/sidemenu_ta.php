<?php
use App\Controllers\Tutorias\Tutorado;
use App\Controllers\Tutorias\Alumno;
use App\Controllers\Tutorias\Periodo;
?>
<!-- ************************ -->
<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
            
            <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">ITSH</div>
                <!-- Sidenav Accordion (Dashboard)-->
                 <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-chalkboard-user"></div>
                    Tutores 
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="<?= url_to('\\' . Tutorado::class .'::showTutores') ?>">Tutorías</a>
                    <a class="nav-link" href="<?= url_to('\\' . Tutorado::class .'::tutores') ?>">Tutores</a>
                    <a class="nav-link" href="<?= url_to('\\' . Tutorado::class .'::createTutor') ?>">Agregar Tutor</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseCuents" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-regular fa-pen-to-square"><i data-feather="activity"></i></div>
                    Actividades 
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCuents" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link" href="<?= url_to('\\' . Tutorado::class .'::showActividad') ?>">Crear</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboardsp" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-regular fa-calendar-days"></div>
                    Periodo
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDashboardsp" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="<?= url_to('\\' . Periodo::class .'::showPeriodos') ?>">Ver</a>
                    </nav>
                </div>
                <div class="collapse" id="collapseDashboardsp" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="<?= url_to('\\' . Periodo::class .'::addPeriodo') ?>">Agregar</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAlum" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-users"><i data-feather="activity"></i></div>
                    Alumnos 
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAlum" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link" href="<?= url_to('\\' . Alumno::class .'::showAlumnos') ?>">Ver</a>
                        <a class="nav-link" href="<?= url_to('\\' . Alumno::class .'::crearAlumno') ?>">Crear</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseCana" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-chalkboard-user"></div>
                    Tutorías
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCana" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="<?= url_to('\\' . Tutorado::class .'::showGrupos', $usuario->Id) ?>">Grupos</a>
                <!--    <a class="nav-link" href="/*url_to('\\' . Tutorado::class .'::showCanalizacion', $usuario->Id) */">Individuales</a>
                    <a class="nav-link" href="/* url_to('\\' . Tutorado::class .'::findTutorados', $usuario->Id) */">Grupo</a>
                    <a class="nav-link" href="/*url_to('\\' . Tutorado::class . '::showTutorias', $usuario->Id) */">Tutorías</a>-->
                    </nav>
                </div>
                 
                
<!--
               <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboardsTu" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-chalkboard-user"></div>
                    Tutorados
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDashboardsTu" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="<?= url_to('\\' . Tutorado::class .'::findTutorados', $usuario->Id) ?>">Ver</a>
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
                </div>
-->

            </div>
        </div>
    </nav>
</div>