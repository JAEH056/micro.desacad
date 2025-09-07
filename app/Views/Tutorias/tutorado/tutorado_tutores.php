<?php
use App\Controllers\Tutorias\Tutorado;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class .'::createTutor') ?>" data-bs-toggle="tooltip" data-bs-title="Nuevo Tutor"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Tutor</th>
                    <th>Puesto</th>
                    <th>Inicio</th>
                    <th>Termina</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutores as $tuto): ?>
                <tr> 
                    
                    <td><?= esc($tuto->Nombre) ?></a></td>
                    <td><?= esc($tuto->Puesto) ?></td>
                    <td><?= esc($tuto->Inicia) ?></td>
                    <td><?= esc($tuto->Termina) ?></td>
                    <td>
                        <a href="<?= url_to('\\' . Tutorado::class .'::updateTutor', $tuto->Id )?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>