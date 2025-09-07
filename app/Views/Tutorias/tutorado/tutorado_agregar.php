<?php
use App\Controllers\Tutorias\Tutorado;
?>

<div class="container-fluid px-4">
    <div class="row gx-4">
        <div class="card mt-n10">
            <div class="card-header"><?= esc($title) ?></div>
        <?= session()->getFlashdata('error') ?>
		<?= validation_list_errors() ?> 
            <div class="sbp-preview-content">
                <form action="<?= url_to('\\' . Tutorado::class .'::createTutor') ?>" method="post">
                <?= csrf_field() ?>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                        <label for="Id_Usuario">Docente</label>
                        <?= form_dropdown('Id_Usuario', $usuario, null, ['class'=>'form-select']) ?>
                    </div>
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">
                            <label for="Inicia">Inicia</label>
                            <input class="form-control" type="date" name="Inicia" value="<?= set_value('Inicia') ?>"></input>
                        </div>
                        <div class="col-md-6">
                            <label for="Termina">Termina</label>
                            <input class="form-control" type="date" name="Termina" value="<?= set_value('Termina') ?>"></input>
                        
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