<?php
use App\Controllers\Tutorias\Tutorado;
?>
<?php $usuario = session_get('usuario'); ?>
<div class="container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-xl-5 mb-4">
            <!-- Dashboard example card 1-->
            <a class="card lift h-100" href="<?= url_to('\\' . Tutorado::class .'::showCanalizacion', $usuario->Id, $idGrupo->Id_Grupo) ?>">
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
        <div class="col-xl-2 mb-4"></div>
        <div class="col-xl-5 mb-4">
            <!-- Dashboard example card 3-->
            <a class="card lift h-100" href="<?= url_to('\\' . Tutorado::class . '::showTutorias', $usuario->Id, $idGrupo->Id_Grupo)?>">
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
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class .'::impInforme',$idGrupo->Id_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Informe"><i class="fa-regular fa-file-lines" style="font-size: 2em;"></i></a>
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