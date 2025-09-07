<?php
use App\Controllers\Actualizacion\Curso;
?>
<div class="card mt-n10">
    <!-- Team members / people dashboard card example-->
    <div class="card mb-4">
        <div class="card-header">Actividades</div>
        <div class="card-body">
            <!-- Item 1-->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center flex-shrink-0 me-3">
                    <div class="avatar avatar-xl me-3 bg-gray-200"><i class="fa-regular fa-folder-open"></i><img class="avatar-img img-fluid" src="" alt="" /></div>
                    <div class="d-flex flex-column fw-bold">
                        <a class="text-dark line-height-normal mb-1" href="#!">Instrumentación</a>
                    </div>
                </div>
                <div class="dropdown no-caret">
                    <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownPeople1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-vertical"></i></button>
                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownPeople1">
                        <a class="dropdown-item" href="<?= url_to('\\' . Curso::class .'::createSesion', $curso->Id) ?>">Crear</a>
                        <a class="dropdown-item" href="<?= url_to('\\' . Curso::class .'::impCarta', $curso->Id) ?>">Descargar Carta Descriptiva</a>
                        <a class="dropdown-item" href="<?= url_to('\\' . Curso::class .'::impPlan', $curso->Id) ?>">Descargar Plan de Sesión</a>
                    </div>
                </div>
            </div>
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center flex-shrink-0 me-3">
                    <div class="avatar avatar-xl me-3 bg-gray-200"><i class="fa-solid fa-file-lines"></i><img class="avatar-img img-fluid" src="" alt="" /></div>
                    <div class="d-flex flex-column fw-bold">
                        <a class="text-dark line-height-normal mb-1" href="#!">Reporte Final</a>
                    </div>
                </div>
                <div class="dropdown no-caret">
                    <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownPeople2" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-vertical"></i></button>
                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownPeople1">
                    <?php if ($reporteExistente): ?>
                        <a class="dropdown-item" href="<?= url_to('\\' . Curso::class .'::impReporte', $curso->Id) ?>">Descargar</a>
                    <?php else: ?>
                        <a class="dropdown-item" href="<?= url_to('\\' . Curso::class .'::createReporte', $curso->Id) ?>">Crear</a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center flex-shrink-0 me-3">
                    <div class="avatar avatar-xl me-3 bg-gray-200"><i class="fa-regular fa-file-image"></i><img class="avatar-img img-fluid" src="" alt="" /></div>
                    <div class="d-flex flex-column fw-bold">
                        <a class="text-dark line-height-normal mb-1" href="#!">Evidencia</a>
                    </div>
                </div>
                <div class="dropdown no-caret">
                    <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownPeople2" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-vertical"></i></button>
                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownPeople1">
                        <a class="dropdown-item" href="<?= url_to('\\' . Curso::class .'::evidenciaCurso', $curso->Id) ?>">Subir</a>
                        <a class="dropdown-item" href="<?= url_to('\\' . Curso::class .'::evidenciaVer', $curso->Id) ?>">Ver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>