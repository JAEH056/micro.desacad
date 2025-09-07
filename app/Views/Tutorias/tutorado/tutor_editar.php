<?php
use App\Controllers\Tutorias\Tutorado;
?>
<!-- Contenido -->
<div class="card mt-n10">
    <div class="card-header"><?= esc($title) ?></div>
    <div class="card-body"> 
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                <form method="post" action="<?= url_to('\\' . Tutorado::class .'::updateTutor') ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="Id" value="<?= esc($tutor->Id)?>">
                    <input type="hidden" name="Id_Usuario" value="<?= esc($tutor->Id_Usuario)?>">
                    
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">
                            <label for="Inicia">Inicia</label>
                            <input class="form-control" type="date" name="Inicia" value="<?= esc($tutor->Inicia) ?>">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="Termina">Termina</label>
                            <input class="form-control" type="date" name="Termina" value="<?= esc($tutor->Termina) ?>">
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