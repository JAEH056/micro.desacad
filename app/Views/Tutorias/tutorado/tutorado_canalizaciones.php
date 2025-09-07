<?php
use App\Controllers\Tutorias\Tutorado;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-4"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class . '::addCanalizacion', $tutoria->Id_Alumno, $tutoria->Id_Grupo )?>" data-bs-toggle="tooltip" data-bs-title="Agregar Canalización"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
            </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Departamento</th>
                    <th>Diagnostico</th>
                    <th>Actividades</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($canalizacion as $cana): ?>
                <tr> 
                    <td><?= esc($cana->Fecha) ?></td>
                    <td><?= esc($cana->Departamento) ?></td>
                    <td><?= esc($cana->Diagnostico) ?></td>
                    <td><?= esc($cana->Actividades) ?></td>
                    <td><a href="<?= url_to('\\' . Tutorado::class . '::impSeguimiento',$cana->Id)?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Informe"><i class="fa-regular fa-file-lines"></i></a></td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>