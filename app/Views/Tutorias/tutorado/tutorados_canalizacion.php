<?php
use App\Controllers\Tutorias\Tutorado;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <?php $usuario = session_get('usuario');?>
            <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class . '::addIndividual', $usuario->Id)?>" data-bs-toggle="tooltip" data-bs-title="Agregar Canalización"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Nc</th>
                    <th>Nombre del Alumno</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($canalizaciones as $cana): ?>
                <tr> 
                    <td><?= esc($cana->Nc) ?></td>
                    <td><?= esc($cana->Alumno) ?></td>
                    <td>
                        <a href="<?= url_to('\\' . Tutorado::class .'::alumnoCanalizacion', $cana->Id_Alumno, $cana->Id_Grupo) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Canalizaciones"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>