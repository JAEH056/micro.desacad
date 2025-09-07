<?php
use App\Controllers\Tutorias\Tutorado;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class . '::addGrupo')?>" data-bs-toggle="tooltip" data-bs-title="Nuevo Grupo"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Tutor</th>
                    <th>Carrera</th>
                    <th>Nombre</th>
                    <th>Semestre</th>
                    <th>Periodo</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutorados as $tuto): ?>
                <tr> 
                    
                    <td><a href="<?= url_to('\\' . Tutorado::class . '::dataTutor', $tuto->Id )?>"><?= esc($tuto->Tutor) ?></a></td>
                    <td><?= esc($tuto->Carrera) ?></td>
                    <td><?= esc($tuto->Nombre) ?></td>
                    <td><?= esc($tuto->Semestre) ?></td>
                    <td><?= esc($tuto->Periodo) ?></td>
                    <td>
                        <!--<a href="" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Canalizaciones"><i class="fa-solid fa-circle-info"></i></a>-->
                        <a href="<?= url_to('\\' . Tutorado::class . '::showTutorados', $tuto->Id_Grupo)?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Grupales"><i class="fa-solid fa-users"></i></a>
                        <a href="<?= url_to('\\' . Tutorado::class . '::showIndividuales', $tuto->Id, $tuto->Id_Grupo)?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Individuales"><i class="fa-solid fa-user"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>