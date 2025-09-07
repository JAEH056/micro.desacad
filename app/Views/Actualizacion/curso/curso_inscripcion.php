<?php
use App\Controllers\Actualizacion\Curso;
?>
<div class="card mt-n10">
    <div class="container-fluid px-4">
        <div class="row gx-4">
            <form method="post" action="">
                <input type="hidden" name="Id" value="<?= esc($curso->Id)?>">
                <?php $usuario = session_get('usuario'); ?>
                <input type="hidden" name="Id_Usuario" value="<?= esc($usuario->Id)?>">
                <div class="row justify-content-between align-items-center">
        <span class="col-sm-auto"><?= esc($title) ?></span>
        </div>
            <div class="card-body"> 
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Curso</th>
                            <td class="text-start"><?= esc($curso->Nombre) ?></td>
                        </tr>
                        <tr>
                            <th>Instructor</th>
                            <?php if(!empty($curso->Instructor)):  ?>
                            <td class="text-start"><?= esc($curso->Instructor) ?></td>
                            <?php else: ?>
                                <td>Por asignar</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <th>Periodo</th>
                            <td class="text-start"><?= esc($curso->Periodo) ?></td>
                        </tr>
                        <tr>
                            <th>Objetivo</th>
                            <td class="text-start"><?= esc($curso->Objetivo) ?></td>
                        </tr>
                        <tr>
                            <th>Lugar</th>
                            <td class="text-start"><?= esc($curso->Lugar) ?></td>
                        </tr>
                        <tr>
                            <th>Requerimiento</th>
                            <td class="text-start"><?= esc($curso->Requerimiento) ?></td>
                        </tr>
                        <tr>
                            <th>Perfil</th>
                            <td class="text-start"><?= esc($curso->Perfil) ?></td>
                        </tr>
                        <tr>
                            <th>Duración</th>
                            <td class="text-start"><?= esc($curso->Duracion) ?></td>
                        </tr>
                        <tr>
                            <th>Horario</th>
                            <td class="text-start"><?= esc($curso->Horario) ?></td>
                        </tr>
                        
                    </tbody>
                </table> 
                <div class="text-center">
                    <a class="btn btn-primary shadow" href="<?= url_to('\\' . Curso::class .'::inscribir', $curso->Id, $usuario->Id )?>">Inscribirme</a>
                </div>
            </form>
        </div>
    </div>
</div>