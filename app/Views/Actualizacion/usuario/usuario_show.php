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
                <a class="nav-link active ms-0" href="<?= base_url('da/rol/usuario/mostrar/'. $id_usuario) ?>"><i data-feather="user"></i>Perfil</a>
                <a class="nav-link" href="<?= base_url('da/rol/usuario/cuenta/' . $id_usuario) ?>">Actualizar perfil</a>
                <a class="nav-link" href="<?= base_url('da/rol/usuario/update/' . $id_usuario) ?>">Actualizar Cuenta</a>
                <a class="nav-link" href="<?= base_url('da/rol/usuario/agregar/grado/' . $id_usuario) ?>">Agregar Grado</a>
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Datos del usuario</div>
                        <div class="card-body">
                            <?= csrf_field() ?>
                            <input type="hidden" name="Id" value="<?= esc($usuario->Id) ?>">
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Nombre</th>
                                            <td class="text-start"><?= esc($usuario->Nombre) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Primer Apellido</th>
                                            <td class="text-start"><?= esc($usuario->Primer_Apellido) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Segundo Apellido</th>
                                            <td class="text-start"><?= esc($usuario->Segundo_Apellido) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Sexo</th>
                                            <td class="text-start"><?= esc($usuario->Sexo) ?></td>
                                        </tr>
                                        <tr>
                                            <th>RFC</th>
                                            <td class="text-start"><?= esc($usuario->Rfc) ?></td>
                                        </tr>
                                        <tr>
                                            <th>CURP</th>
                                            <td class="text-start"><?= esc($usuario->Curp) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td class="text-start"><?= esc($usuario->Email) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nivel Academico</th>
                                            <td class="text-start"><?= esc($usuario->Carrera) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Puesto</th>
                                            <td class="text-start"><?= esc($usuario->Cargo) ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

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