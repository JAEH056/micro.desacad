<?php
use App\Controllers\Tutorias\Tutorado;
?>
<style>
    .alinear{
        margin: 0 auto;
    }
</style>
<div class="container-fluid px-4">
    <div class="row gx-9">
			<div class="card mt-n10">
				<div class="row justify-content-between align-items-center">
					<div class="col-lg-7">
                        <div class="card-header">
                            <div class="row justify-content-between align-items-center">
                                <span class="col-sm-4"><?= esc($title) ?></span>
                                <a class="col-sm-auto" href="<?= url_to('\\' . Tutorado::class .'::impInforme',$grupo->Id_Grupo) ?>" data-bs-toggle="tooltip" data-bs-title="Informe"><i class="fa-regular fa-file-lines" style="font-size: 2em;"></i></a>
                            </div>
                        </div>
                        <?= session()->getFlashdata('error') ?>
                        <?= validation_list_errors() ?>
                        <div class="card mb-6">
                            <div class="card-body"> 
                                <div class="card-body"> 
                                    <table class="TablaBonita"> 
                                        <thead>
                                            <tr>
                                                <th>Número de control</th>
                                                <th>Alumno</th>
                                                <th>Carrera</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($tutorados as $tuto): ?>
                                            <tr>
                                                <td><?= esc($tuto->Nc) ?></td>                
                                                <td><?= esc($tuto->Alumno) ?></td>
                                                <td><?= esc($tuto->Carrera) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
						    </div>
					    </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-header-actions">
                            <div class="card-header">
                                Agregar Tutorado
                            </div>
                            <div class="card-body">
                                <?= session()->getFlashdata('error') ?>
                                <?= validation_list_errors() ?> 
                            </div>
                            <form action="<?= url_to('\\' . Tutorado::class .'::addTutorado') ?>" method="post">

                                <input type="hidden" name="Id_Grupo" value="<?= esc($grupo->Id_Grupo)?>">

                                <?= csrf_field() ?>
                                    
                                <div class="col-md-8 alinear">
                                    <label for="Id_Alumno">Alumno</label>
                                    <?= form_dropdown('Id_Alumno', $alumno, null, ['class'=>'form-select']) ?>
                                </div>
                                <br>
                                <div class="text-center">
                                    <input class="btn btn-outline-blue" type="submit" name="submit" value="Agregar">
                                </div>
                            </form></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>