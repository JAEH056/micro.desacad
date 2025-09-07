<?php
use App\Controllers\Actualizacion\Curso;
use App\Controllers\Actualizacion\Periodo;
use App\Controllers\Actualizacion\Usuario;
?>
<!-- ************************ -->
<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
            
            <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">ITSH</div>
                <!-- Sidenav Accordion (Dashboard)-->
            <?php $iDpuesto = session()->get('iDpuesto'); 
            if(service('rbac')->Check('SuperUsuario', $iDpuesto)): ?>
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-chalkboard-user"></div>
                    Cursos
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
            
                <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link" href="<?= url_to('\\' . Curso::class .'::showAll') ?>">Curso</a>
                        <a class="nav-link" href="<?= url_to('\\' . Periodo::class .'::showAll') ?>">Periodos</a>
                        <a class="nav-link" href="<?= url_to('\\' . Curso::class .'::logoShow') ?>">Editar constancia</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-users"><i data-feather="activity"></i></div>
                    Usuarios
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUsers" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link" href="<?= url_to('\\' . Usuario::class .'::showAll') ?>">Usuarios</a>
                        <a class="nav-link" href="<?= url_to('\\' . Usuario::class .'::create') ?>">Agregar</a>
                        <a class="nav-link" href="dashboard-3.html"></a>
                    </nav>
                </div>
            <?php endif; ?>
            <?php $iDpuesto = session()->get('iDpuesto'); 
            if(service('rbac')->Check('Docente', $iDpuesto)): ?>
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseCurs" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-users"><i data-feather="activity"></i></div>
                    Cursos
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCurs" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link" href="<?= url_to('\\' . Curso::class .'::cursoConcluido', $usuario->Id) ?>">Mis Cursos</a>
                        <a class="nav-link" href="<?= url_to('\\' . Curso::class .'::cursos', $usuario->Id)?>">Cursos</a>
                    </nav>
                </div>
            <?php endif; ?>
            <?php $iDpuesto = session()->get('iDpuesto'); 
            if(service('rbac')->Check('Invitado', $iDpuesto)): ?>
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseIns" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="fa-solid fa-users"><i data-feather="activity"></i></div>
                    Curso
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseIns" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link" href="<?= url_to('\\' . Curso::class .'::cursoInstructor', $usuario->Id) ?>">Actividades</a>
                        
                    </nav>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </nav>
</div>