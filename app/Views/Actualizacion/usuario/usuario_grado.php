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
                <a class="nav-link" href="<?= base_url('da/rol/usuario/update/' . $id_usuario) ?>">Actualizar Cuenta</a>
                <a class="nav-link active ms-0" href="<?= base_url('da/rol/usuario/agregar/grado/' . $id_usuario) ?>"><i data-feather="user"></i>Agregar Grado</a>
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Grado Academico</div>
                        <div class="card-body">
                            <form method="post" action="<?= url_to('\\' . Usuario::class . '::updateGrado', $id_usuario)?>">
                                <input type="hidden" name="Id" value="<?= esc($usuario->Id) ?>">
                                <div class="row gx-3 mb-3">
                                    <label for="">Agrega un nuevo nivel Educativo</label>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-2">
                                            <label for="Sexo">Nivel</label>
                                            <select class="form-select" type="form-select form-select-lg mb-3" name="Nivel" value="<?= set_value('Nivel') ?>">
                                                <option selected>Selecciona</option>
                                                <option value="Licenciatura">Licenciatura</option>
                                                <option value="Maestria">Maestría</option>
                                                <option value="Doctorado">Doctorado</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Curp">Carrera</label>
                                            <input class="form-control" type="input" name="Carrera" value="<?= set_value('Carrera') ?>"></input>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Rfc">Programa Educativo</label>
                                            <input class="form-control" type="input" name="Nombre_C" value="<?= set_value('Nombre_C') ?>"></input>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="Rfc">Siglas</label>
                                            <input class="form-control" type="input" name="Siglas" value="<?= set_value('Siglas') ?>"></input>
                                        </div>
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
</div>