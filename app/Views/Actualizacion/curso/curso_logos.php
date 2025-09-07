<?php
use App\Controllers\Actualizacion\Curso;
?>
<style>
    img {
        max-width: 10%;
        /* Ajusta el ancho de la imagen según sea necesario */
        height: auto;
        /* Mantiene la proporción de la imagen */
        margin-left: 5%;
    }
</style>

<div class="container-fluid px-4">
    <div class="row gx-4">
        <div class="card mt-n10">
            <div class="card-header"><?= esc($title) ?></div>
            <?= session()->getFlashdata('error') ?>
            <?= validation_list_errors() ?>

            <!-- Aseguramos que cada card esté en su columna -->
            <div class="row"> <!-- Nueva fila para agrupar los cards horizontalmente -->
                <div class="col-md-6 mb-4"> <!-- Cada card está en una columna de 3/12 del ancho -->
                    <div class="card">
                        <div style="margin: 20px 10px 0 50px">
                        <img
                            src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo1.png')) ?>">
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data"
                                action="<?= url_to('\\' . Curso::class . '::logoUpdate1') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="nombre" value="logo1.png">
                                <label for="formFileMultiple" class="form-label">Elige tu imagen</label>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input class="form-control" type="file" id="formFileMultiple" name="Imagen"
                                            accept="image/*" multiple>
                                        <button class="btn btn-primary" type="submit" name="submit"
                                            value="Subir">Subir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div style="margin: 10px 10px 0 50px">
                        <img
                            src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo2.png')) ?>">
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data"
                                action="<?= url_to('\\' . Curso::class . '::logoUpdate2') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="nombre" value="logo2.png">
                                <label for="formFileMultiple" class="form-label">Elige tu imagen</label>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input class="form-control" type="file" id="formFileMultiple" name="Imagen"
                                            accept="image/*" multiple>
                                        <button class="btn btn-primary" type="submit" name="submit"
                                            value="Subir">Subir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div style="margin: 10px 10px 0 50px">
                        <img
                            src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo3.png')) ?>">
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data"
                                action="<?= url_to('\\' . Curso::class . '::logoUpdate3') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="nombre" value="logo3.png">
                                <label for="formFileMultiple" class="form-label">Elige tu imagen</label>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input class="form-control" type="file" id="formFileMultiple" name="Imagen"
                                            accept="image/*" multiple>
                                        <button class="btn btn-primary" type="submit" name="submit"
                                            value="Subir">Subir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div style="margin: 10px 10px 0 50px">
                            <img
                                src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo4.png')) ?>">
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data"
                                action="<?= url_to('\\' . Curso::class . '::logoUpdate4') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="nombre" value="logo4.jpg">
                                <label for="formFileMultiple" class="form-label">Elige tu imagen</label>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input class="form-control" type="file" id="formFileMultiple" name="Imagen"
                                            accept="image/*" multiple>
                                        <button class="btn btn-primary" type="submit" name="submit"
                                            value="Subir">Subir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div style="margin: 10px 10px 0 50px">
                        <img
                            src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo5.png')) ?>">
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data"
                                action="<?= url_to('\\' . Curso::class . '::logoUpdate5') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="nombre" value="logo5.png">
                                <label for="formFileMultiple" class="form-label">Elige tu imagen</label>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input class="form-control" type="file" id="formFileMultiple" name="Imagen"
                                            accept="image/*" multiple>
                                        <button class="btn btn-primary" type="submit" name="submit"
                                            value="Subir">Subir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>