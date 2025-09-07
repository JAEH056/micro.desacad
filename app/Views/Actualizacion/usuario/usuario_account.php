<?php

use App\Controllers\Actualizacion\Usuario;
?>
<!-- Contenido -->
<div class="card mt-n10">
    <main>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link" href="<?= base_url('da/rol/usuario/mostrar/'. $id_usuario) ?>">Perfil</a>
                <a class="nav-link active ms-0" href="<?= base_url('da/rol/usuario/cuenta/' . $id_usuario) ?>"><i data-feather="user"></i>Actualizar perfil</a>
                <a class="nav-link" href="<?= base_url('da/rol/usuario/update/' . $id_usuario) ?>">Actualizar Cuenta</a>
                <a class="nav-link" href="<?= base_url('da/rol/usuario/agregar/grado/' . $id_usuario) ?>">Agregar Grado</a>
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form method="post" action="<?= url_to('\\' . Usuario::class . '::actualizar')?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="Id" value="<?= esc($usuario->Id) ?>">
                                <!-- Form Group (username)-->
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-12">
                                        <label for="Nombre">Nombre</label>
                                        <input class="form-control" type="text" name="Nombre" value="<?= esc($usuario->Nombre) ?>">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="Primer_Apellido">Primer apellido</label>
                                        <input class="form-control" type="text" name="Primer_Apellido" value="<?= esc($usuario->Primer_Apellido) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="Segundo_Apellido">Segundo apellido</label>
                                        <input class="form-control" type="text" name="Segundo_Apellido" value="<?= esc($usuario->Segundo_Apellido) ?>">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-4">
                                        <label for="Curp">Curp</label>
                                        <input class="form-control" type="text" name="Curp" value="<?= esc($usuario->Curp) ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="Rfc">RFC</label>
                                        <input class="form-control" type="text" name="Rfc" value="<?= esc($usuario->Rfc) ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="Sexo">Sexo</label>
                                        <?= form_dropdown('Sexo', ['M' => 'Mujer', 'H' => 'Hombre'], $usuario->Sexo, ['class' => 'form-select']); ?>
                                    </div>
                                </div>
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