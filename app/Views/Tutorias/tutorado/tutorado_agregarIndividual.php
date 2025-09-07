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
                    <div class="col-md-12">
                        <label for="Id_Tutorado">Tutorado</label>
                        <?= form_dropdown('Id_Tutorado', $tutorado, null, ['class'=>'form-select']) ?>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label for="Horas">Horas</label>
                        <input class="form-control" type="input" name="Horas" value="<?= set_value('Horas') ?>"></input>
                    </div>
                    <div class="col-md-6">
                        <label for="Fecha">Fecha</label>
                        <input class="form-control" type="date" name="Fecha" value="<?= set_value('Fecha') ?>"></input>
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