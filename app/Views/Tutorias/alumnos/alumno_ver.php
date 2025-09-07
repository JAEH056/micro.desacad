<?php
use App\Controllers\Tutorias\Alumno;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Alumno::class .'::crearAlumno') ?>" data-bs-toggle="tooltip" data-bs-title="Agregar Alumno"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Numero de control</th>
                    <th>Nombre</th>
                    <th>Curp</th>
                    <th>Sexo</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $alum): ?>
                <tr> 
                    
                    <td><?= esc($alum->Nc) ?></td>
                    <td><?= esc($alum->Nombre) ?></td>
                    <td><?= esc($alum->Curp) ?></td>
                    <td><?= esc($alum->Sexo) ?></td>
                    <td>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>