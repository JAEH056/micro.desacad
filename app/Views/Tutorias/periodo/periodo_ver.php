<?php
use App\Controllers\Tutorias\Periodo;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Periodo::class .'::addPeriodo') ?>" data-bs-toggle="tooltip" data-bs-title="Agregar Alumno"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Inicia</th>
                    <th>Termina</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($periodos as $per): ?>
                <tr> 
                    
                    <td><?= esc($per->Nombre) ?></td>
                    <td><?= esc($per->Inicia) ?></td>
                    <td><?= esc($per->Termina) ?></td>
                    <td>
                        <a href="<?= url_to('\\' . Periodo::class .'::updatePeriodo', $per->Id )?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>