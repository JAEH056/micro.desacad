<?php
use App\Controllers\Actualizacion\Curso;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Curso::class .'::create') ?>" data-bs-toggle="tooltip" data-bs-title="Agregar Curso"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Curso</th>
                    <th>Instructor</th>
                    <th>Periodo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; ?>
                <?php foreach ($cursos as $curso): ?>
                <?php $i++ ?>
                <tr>
                    <td><?= esc($curso->Clave) ?></td>
                    <td><a href="<?= url_to('\\' . Curso::class .'::inscritos', $curso->Id )?>"><?= esc($curso->Nombre) ?></a></td>
                    <td>
                            <?php foreach (explode('|', $curso->Instructor) as $instructor): ?>
                                <?= esc($instructor) ?><br>
                            <?php endforeach ?>
                    </td>
                    <td><?= esc($curso->Periodo) ?></td>
                    <td>
                        <a href="<?= url_to('\\' . Curso::class .'::toggleBloqueo', $curso->Id) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="<?= $curso->Bloqueado ? 'Desbloquear' : 'Bloquear' ?>">
                            <i class="fa-solid <?= $curso->Bloqueado ? 'fa-toggle-on' : 'fa-toggle-off' ?>"></i>
                        </a>
                        <a href="<?= url_to('\\' . Curso::class .'::show', $curso->Id )?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Detalles"><i class="fa-solid fa-circle-info"></i></a>
                        <?php if (!$curso->Bloqueado): ?>
                            <a href="<?= url_to('\\' . Curso::class .'::update', $curso->Id )?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="<?= url_to('\\' . Curso::class .'::mostrarInstructor', $curso->Id )?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Instructor"><i class="fa-solid fa-user-plus"></i></a>
                            <a href="<?= url_to('\\' . Curso::class .'::impCarta', $curso->Id) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Descargar Carta Descriptiva"><i class="fa-solid fa-file-import"></i></a>
                            <a href="<?= url_to('\\' . Curso::class .'::impPlan', $curso->Id) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Descargar Plan de Sesión"><i class="fa-solid fa-file-import"></i></a>
                            <a href="<?= url_to('\\' . Curso::class .'::impReporte', $curso->Id) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Descargar Reporte Final"><i class="fa-solid fa-file-import"></i></a>
                            <a href="<?= url_to('\\' . Curso::class .'::evidenciaVer', $curso->Id) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Evidencia"><i class="fa-solid fa-image"></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#Modal<?= $i ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>
                            <div class="modal fade" id="Modal<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar el curso "<?= esc($curso->Nombre) ?>"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <a href="<?= url_to('\\' . Curso::class .'::cursoDelete', $curso->Id )?>" class="btn btn-primary">Si</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </td>

                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>


