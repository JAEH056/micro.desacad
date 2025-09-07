<?php
use App\Controllers\Actualizacion\Curso;
?>
    <div class="container-fluid px-4">
        <div class="row gx-4">
            <div class="card mt-n10">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="me-3"><?= esc($title) ?></span>
                                <div class="d-flex align-items-center ms-auto">
                                    <a href="<?= url_to('\\' . Curso::class . '::listInscritos', $curso->Id) ?>"
                                        data-bs-toggle="tooltip" data-bs-title="Lista de asistencia">
                                        <i class="fa-regular fa-file-lines me-3" style="font-size: 2em;"></i>
                                    </a>

                                    <?php if ($concluido): ?>
                                        <a href="<?= url_to('\\' . Curso::class . '::constancias', $curso->Id) ?>"
                                            data-bs-toggle="tooltip" data-bs-title="Constancias"><i
                                                class="fa-solid fa-file-lines me-3" style="font-size: 2em;"></i></a>
                                    <?php else: ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                            <i class="fa-solid fa-trophy" style="font-size: 2em;"></i>
                                        </a>
                                        <!-- Modal de Confirmación -->
                                        <div class="modal fade" id="confirmModal" tabindex="-1"
                                            aria-labelledby="confirmModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmModalLabel">¿Estás seguro de
                                                            finalizar el curso?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Si finalizas el curso, podrás generar las constancias. ¿Quieres
                                                        continuar?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="<?= url_to('\\' . Curso::class . '::concluirCurso', $curso->Id) ?>"
                                                            class="btn btn-primary">Sí, finalizar curso</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <?= session()->getFlashdata('error') ?>
                        <?= validation_list_errors() ?>
                        <div class="card mb-6">
                            <div class="card-body">
                                <table class="TablaBonita">
                                    <thead>
                                        <tr>
                                            <th>Grado</th>
                                            <th>Nombre</th>
                                            <th>Puesto</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $u = 0; ?>
                                        <?php foreach ($usuarios as $user): ?>
                                            <?php $u++ ?>

                                            <tr>
                                                <td><?= esc($user->Grado) ?></td>
                                                <td><?= esc($user->Nombre) ?></td>
                                                <td><?= esc($user->NCargo) ?></td>
                                                <td>
                                                    <!--<a href="<// url_to('\\' . Curso::class .'::usuarioConstancia', $curso->Id, $user->Id )?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip"  data-bs-title="Constancia"><i class="fa-solid fa-file-import"></i></a>-->
                                                    <a href="<?= url_to('\\' . Curso::class . '::userCedula', $curso->Id, $user->Id) ?>"
                                                        class="btn btn-datatable btn-icon btn-transparent-dark"
                                                        data-bs-toggle="tooltip" data-bs-title="Cedula"><i
                                                            class="fa-solid fa-file-import"></i></a>
                                                    <?php if ($user->encuesta): ?>
                                                        <a href="<?= url_to('\\' . Curso::class . '::userEncuesta', $curso->Id, $user->Id) ?>"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark"
                                                            data-bs-toggle="tooltip" data-bs-title="Encuesta"><i
                                                                class="fa-solid fa-file-import"></i></a>
                                                    <?php endif; ?>

                                                    <a data-bs-toggle="modal" data-bs-target="#Modal<?= $u ?>"
                                                        class="btn btn-datatable btn-icon btn-transparent-dark"
                                                        data-bs-toggle="tooltip" data-bs-title="Eliminar"><i
                                                            class="fa-regular fa-trash-can"></i></a>
                                                    <div class="modal fade" id="Modal<?= $u ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Eliminar</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ¿Estas seguro de eliminar el usuario
                                                                    "<?= esc($user->Nombre) ?>"?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">No</button>
                                                                    <a href="<?= url_to('\\' . Curso::class . '::inscritoDelete', $user->Id) ?>"
                                                                        class="btn btn-primary">Si</a>
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
                    </div>
                    <?php if ($puedeInscribir): ?>
                        <div class="col-lg-6">
                            <div class="card card-header-actions">
                                <div class="card-header">
                                    Agregar Participante
                                </div>
                                <div class="card-body">
                                    <?= session()->getFlashdata('error') ?>
                                    <?= validation_list_errors() ?>


                                    <?= form_open(url_to('\\' . Curso::class . '::inscribirParti')) ?>
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="Id_Curso" value="<?= esc($curso->Id) ?>">

                                    <div>
                                        <label for="Usuario">Usuarios</label>
                                        <?= form_dropdown('Id_Usuario', $usua, null, ['class' => '', 'id' => 'listIn']) ?>
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <input class="btn btn-outline-blue" type="submit" name="submit" value="Ingresar">
                                    </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            El curso ha alcanzado su capacidad máxima de participantes.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        new SlimSelect({
            select: '#listIn'
        })
    </script>