<?php
use App\Controllers\Actualizacion\Curso;
?>
<div class="card mt-n10">
    <div class="card-header"><?= esc($title) ?></div>
    <div class="card-body"> 
		<div class="container-fluid">
            <div class="col-sm-4">
            <?= session()->getFlashdata('error') ?>
            <?= validation_list_errors() ?> 
                <div class="form-group col">
                    <form enctype="multipart/form-data" action="<?= url_to('\\' . Curso::class .'::guardarImg') ?>" method="post"> 
                    <?= csrf_field() ?>
                        <input type="hidden" name="Id_Curso" value="<?= esc($curso->Id)?>">
                        <div class="form-group">
                            <label for="formFileMultiple" class="form-label">Elige tu imagen</label>
                            <input class="form-control" type="file" id="formFileMultiple" name="Imagen" accept="image/*" multiple>
                        </div>
                        <br>
                        <div class="text-center">
                            <button class="btn btn-outline-blue" type="submit" name="submit" value="Subir">Subir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
