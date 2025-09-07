<?php
use App\Controllers\Actualizacion\Usuario;
?>
<!-- Contenido -->
<!-- Contenido -->
<div class="card mt-n10">
    <main>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link" href="<?= base_url('da/rol/usuario/mostrar/' . $id_usuario) ?>">Perfil</a>
                <a class="nav-link" href="<?= base_url('da/rol/usuario/cuenta/' . $id_usuario) ?>">Actualizar perfil</a>
                <a class="nav-link active ms-0" href="<?= base_url('da/rol/usuario/update/' . $id_usuario) ?>"><i data-feather="user"></i>Actualizar Cuenta</a>
                <a class="nav-link" href="<?= base_url('da/rol/usuario/agregar/grado/' . $id_usuario) ?>">Agregar Grado</a>
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form method="post" action="<?= url_to('\\' . Usuario::class . '::updateUser')?>">
                                <input type="hidden" name="Id" value="<?= esc($usuario->Id) ?>">

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="puesto_actual">Puesto Actual:</label>
                                        <input type="text" class="form-control" value="<?= esc($usuario->Puesto ?? 'Sin asignar') ?>" disabled>
                                    </div>
                                </div>

                                <?php if (!empty($puestos)) : ?>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="Sexo">Asigna un nuevo puesto</label>
                                            <?= form_dropdown('Id_Organigrama', $puestos, null, ['class'=>'form-select']) ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <br>
                                <div class="text-center">
                                    <input class="btn btn-outline-blue" type="submit" name="submit" value="Guardar">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <?= validation_list_errors() ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>