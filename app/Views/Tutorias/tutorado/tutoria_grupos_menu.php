<?php

use App\Controllers\Tutorias\Canalizacion;
use App\Controllers\Tutorias\Formatos;
use App\Controllers\Tutorias\Tutorado;
?>
<?php $usuario = session_get('usuario'); ?>
<div class="container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-xl-5 mb-4">
            <!-- Acceso a tutorias individuales -->
            <a class="card lift h-100" href="<?= url_to('\\' . Canalizacion::class . '::showCanalizacion', $usuario->Id, $idGrupo) ?>">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="me-3">
                            <i class="feather-xl text-primary mb-3" data-feather="package"></i>
                            <h5>Individual</h5>
                            <div class="text-muted small"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-2 mb-4"><!-- Separador --></div>
        <div class="col-xl-5 mb-4">
            <!-- Acceso a tutorias grupales -->
            <a class="card lift h-100" href="<?= url_to('\\' . Tutorado::class . '::showTutorias', $idGrupo) ?>">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="me-3">
                            <i class="feather-xl text-green mb-3" data-feather="layout"></i>
                            <h5>Grupal</h5>
                            <div class="text-muted small"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="card mt-n6">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Formatos::class . '::impInforme', $idGrupo) ?>" data-bs-toggle="tooltip" data-bs-title="Informe" target="_blank"><i class="fa-regular fa-file-lines" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body">
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Número de control</th>
                    <th>Alumno</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutorados as $tuto): ?>
                    <tr>
                        <td><?= esc($tuto->Nc) ?></td>
                        <td><?= esc($tuto->Alumno) ?></td>
                        <td><?= esc($tuto->Carrera) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>