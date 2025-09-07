<?php

use App\Controllers\Actualizacion\Usuario;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
            <a class="col-sm-auto" href="<?= url_to('\\' . Usuario::class . '::create') ?>" data-bs-toggle="tooltip" data-bs-title="Agregar Usuario"><i class="fa-solid fa-circle-plus" style="font-size: 2em;"></i></a>
        </div>
    </div>
    <div class="card-body">
        <table class="TablaBonita">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Curp</th>
                    <th>RFC</th>
                    <th>Email</th>
                    <th>Sexo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $u = 0; ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <?php $u++ ?>
                    <tr>
                        <td><?= esc($usuario->Nombre) ?></td>
                        <td><?= esc($usuario->Curp) ?></td>
                        <td><?= esc($usuario->Rfc) ?></td>
                        <td><?= esc($usuario->Email) ?></td>
                        <td><?= esc($usuario->Sexo) ?></td>
                        <td>
                            <a href="<?= url_to('\\' . Usuario::class . '::userShow', $usuario->Id) ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Editar cuenta"><i class="fa-solid fa-circle-user"></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#Modal<?= $u ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>
                            <div class="modal fade" id="Modal<?= $u ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar el usuario "<?= esc($usuario->Nombre) ?>"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <a href="<?= url_to('\\' . Usuario::class . '::delete', $usuario->Id) ?>" class="btn btn-primary">Si</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>