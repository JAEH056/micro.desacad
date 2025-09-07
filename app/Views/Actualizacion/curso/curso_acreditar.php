<?php
use App\Controllers\Actualizacion\Curso;
?>

<div class="container-fluid px-4">
    <div class="row gx-4">
        <div class="card mt-n10">
            <div class="card-header"><?= esc($title) ?></div>
        <?= session()->getFlashdata('error') ?>
		<?= validation_list_errors() ?> 
            <div class="sbp-preview-content">
            <form action="<?= url_to('\\' . Curso::class .'::acreditarCurso', $curso->Id) ?>" method="post">
                <input type="hidden" name="Id_Curso" value="<?= esc($curso->Id) ?>">
                <?= csrf_field() ?>

                <div class="row gx-3 mb-3">
                    <div class="col-md-10 ">
                        <label for="Id_Usuario">Acreditar docentes</label>
                        <?php $i = 0; ?>
                        <?php foreach ($usuarios as $usu): ?>
                            <div class="form-check mb-2">
                                <?= form_checkbox('usuarios[' . ($i++) . ']', $usu->Id, false, ['class' => 'form-check-input', 'id' => $usu->Id]) ?>
                                <label class="form-check-label" for="usu_<?= $usu->Id ?>">
                                    <?= $usu->Nombre ?>
                                </label>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                
                <br>
                <div class="text-center">
                    <input class="btn btn-outline-blue" type="submit" name="submit" value="Agregar">
                </div>
            </form>
            </div>
        </div>
	</div>
</div>

