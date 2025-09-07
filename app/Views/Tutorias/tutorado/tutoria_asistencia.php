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
        
                <input type="hidden" name="Id_Tutoria" value="<?= esc($tgrupal->Id_Tutoria)?>">
                <?= csrf_field() ?>

                
                    <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                            <label for="Fecha">Fecha</label>
                            <input class="form-control" type="date" name="Fecha" value="<?= set_value('Fecha') ?>"></input>
                        </div>
                        <div class="col-md-10 ">
                        <label for="Id_Usuario">Alumnos que asistieron a tutoria</label>
                        <?php $i = 0; ?>
                        <?php foreach ($alumnos as $alumno): ?>
                        
                        
                        <div class="form-check mb-2">
                            <?= form_checkbox('alumnos[' . ($i++) . ']', $alumno->Id, false, ['class' => 'form-check-input', 'id' => $alumno->Id]) ?>
                            <label class="form-check-label" name="<?= $alumno->Nombre ?>" for="alumno_<?= $alumno->Id ?>">
                                <?= $alumno->Nombre ?>
                            </label>
                        </div>
                        
                        <?php endforeach ?>
                        
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

