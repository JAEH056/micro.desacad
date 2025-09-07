<?php
use App\Controllers\Tutorias\Tutorado;
?>

<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class . '::createTutoria', $grupo->Id_Grupo)?>" data-bs-toggle="tooltip" data-bs-title="Nuevo Tutoría"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Horas</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutorias as $tuto): ?>
                    <tr>
                       <td><?= esc($tuto->Descripcion) ?></td>                
                       <td><?= esc($tuto->Horas) ?></td>
                       <td><?= esc($tuto->Fecha) ?></td>
                       <td>
                            <a href="<?= url_to('\\' . Tutorado::class .'::tutoriaAsistencia',$tuto->Id_Tutoria)?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Asistencias"><i class="fa-solid fa-users"></i></a>
                            <a href="<?= url_to('\\' . Tutorado::class .'::alumAcreditado',$tuto->Id_Tutoria)?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Acreditar"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
    </div> 
</div>
                                                
        