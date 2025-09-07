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
            <input type="hidden" name="Id_Tutoria" value="<?= esc($tutoria->Id_Tutoria)?>">
            <?= csrf_field() ?>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label for="Id">Departamento</label>
                        <?= form_dropdown('Id_Departamento', $departamento, null, ['class'=>'form-select']) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="Fecha">Fecha</label>
                        <input class="form-control" type="date" name="Fecha" value="<?= set_value('Fecha') ?>"></input>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label for="Diagnostico">Diagnostico</label>
                        <input class="form-control" type="input" name="Diagnostico" value="<?= set_value('Diagnostico') ?>"></input>
                    </div>
                    <div class="col-md-6">
                        <label for="Actividades">Actividades</label>
                        <input class="form-control" type="input" name="Actividades" value="<?= set_value('Actividades') ?>"></input>
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