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
            <form action="" method="post">
            <?= csrf_field() ?>
                <div class="row gx-3 mb-3">
                    <div class="col-md-4">
                        <label for="Id_Periodo">Periodo</label>
                        <?= form_dropdown('Id_Periodo', $periodo, null, ['class'=>'form-select']) ?>
                    </div>
                    <div class="col-md-4">
                        <label for="Id_Tutor">Tutor</label>
                        <?= form_dropdown('Id_Tutor', $tutor, null, ['class'=>'form-select']) ?>
                    </div>
                    <div class="col-md-4">
                        <label for="Nombre">Nombre</label>
                        <input class="form-control" type="input" name="Nombre" value="<?= set_value('Nombre') ?>"></input>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-5">
                        <label for="Id_Programa">Programa educativo</label>
                        <?= form_dropdown('Id_Programa', $programa, null, ['class'=>'form-select']) ?>
                    </div>
                    <div class="col-md-3">
                        <label for="Fecha">Fecha</label>
                        <input class="form-control" type="date" name="Fecha" value="<?= set_value('Fecha') ?>"></input>
                    </div>
                    <div class="col-md-4">
                        <label for="Semestre">Semestre</label>
                        <input class="form-control" type="input" name="Semestre" value="<?= set_value('Semestre') ?>"></input>
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