<?php
use App\Controllers\Actualizacion\Periodo;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Periodo::class .'::create')?>" data-bs-toggle="tooltip" data-bs-title="Agregar Periodo"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de terminación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $p=0; ?>
                    <?php foreach ($periodos as $periodo): ?>
                <?php $p++ ?>
                
                <tr>
                    <td><a href="<?= url_to('\\' . Periodo::class .'::show', $periodo->Id)?>"><?= esc($periodo->Nombre) ?></a></td>
                    <td><?= esc($periodo->Inicia->toLocalizedString("eee d 'de' MMM, yyyy")) ?></td>
                    <td><?= esc($periodo->Termina?->toLocalizedString("eee d 'de' MMM, yyyy")) ?></td>
                    <td>
                        <a href="<?= url_to('\\' . Periodo::class .'::update', $periodo->Id)?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                        <?php if($periodo->Puede_Borrar): ?>
                            <a data-bs-toggle="modal" data-bs-target="#Modal<?= $p ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>
                            <div class="modal fade" id="Modal<?= $p ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estas seguro de eliminar el periodo "<?= esc($periodo->Nombre) ?>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <a href="<?= url_to('\\' . Periodo::class .'::delete', $periodo->Id)?>" class="btn btn-primary">Si</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </td>

                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

