<?php
use App\Controllers\Actualizacion\Curso;
?>

<style>
    .t{
        text-align: center;
    }
</style>
<div class="card mt-n10">
    <div class="card-header"><?= esc($title) ?></div>
    <div class="card-body"> 
		<div class="container-fluid">

		<?= session()->getFlashdata('error') ?>
		<?= validation_list_errors() ?> 

		<div class="sbp-preview">
            <div class="sbp-preview-content">
				<form action="<?= url_to('\\' . Curso::class .'::createReporte',$curso->Id) ?>" method="post">
				<?= csrf_field() ?>
                <input type="hidden" name="Id_Curso" value="<?= esc($curso->Id)?>">
                    <div class="text-center">
                        <label>Resultados Alcanzados</label>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-5">
                            <label for="Objetivos">Objetivos</label>
                            <textarea class="form-control" rows="2" name="Objetivos"><?= set_value('Objetivos') ?></textarea>
                        </div>
                        <div class="col-md-2">
                            <label for="Porcentaje">%</label>
                            <input class="form-control" rows="2" name="Porcentaje_Obj" value="<?= set_value('Porcentaje') ?>"></input>
                        </div>
                        <div class="col-md-5">
                            <label for="Comentarios">Comentarios</label>
                            <textarea class="form-control" rows="2" name="Comentarios_Obj"><?= set_value('Comentarios') ?></textarea>
                        </div>
				    </div>
                    
                    <div class="row gx-3 mb-3">
                        <div class="col-md-5">
                            <label for="Expectativas">Expectativas</label>
                            <textarea class="form-control" rows="2" name="Expectativas"><?= set_value('Expectativas') ?></textarea>
                        </div>
                        <div class="col-md-2">
                            <label for="Porcentaje">%</label>
                            <input class="form-control" rows="2" name="Porcentaje_Exp" value="<?= set_value('Porcentaje') ?>"></input>
                        </div>
                        <div class="col-md-5">
                            <label for="Comentarios">Comentarios</label>
                            <textarea class="form-control" rows="2" name="Comentarios_Exp"><?= set_value('Comentarios') ?></textarea>
                        </div>
				    </div>
                    <div class="text-center">
                        <label>Recuperación de Experiencias</label>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                            <label for="Dinamica">Comentarios sobre la dinámica del grupo</label>
                            <textarea class="form-control" rows="2" name="Dinamica"> <?= set_value('Dinamica') ?></textarea>
                        </div>
				    </div>				
					<div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Areas">Areas de oportunidad del instructor</label>
                            <textarea class="form-control" rows="2" name="Areas"><?= set_value('Areas') ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="Practicas">Mejores prácticas del instructor</label>
                           <textarea class="form-control" rows="2" name="Practicas"><?= set_value('Practicas') ?></textarea>
					    </div>
				    </div>
                    <div class="text-center">
                        <label>Contingencias</label>
                    </div>
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">
                            <label for="Contingencia">Contingencia</label>
                            <input class="form-control" type="input" name="Contingencia" value="<?= set_value('Contingencia') ?>"></input>
                        </div>
                        <div class="col-md-6">
                            <label for="Accion">Acción correctiva</label>
                            <input class="form-control" type="input" name="Accion" value="<?= set_value('Accion') ?>"></input>
                        </div>
				    </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-12">
                        <label for="Ajustes">Ajustes al programa de trabajo</label>
                        <textarea class="form-control" rows="2" name="Ajustes"> <?= set_value('Ajustes') ?></textarea>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-12">
                        <label for="Evaluaciones">Resultado de las evaluaciones aplicadas a los/las participantes durante el desarrollo del curso</label>
                        <textarea class="form-control" rows="2" name="Evaluaciones"> <?= set_value('Evaluaciones') ?></textarea>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-12">
                        <label for="Resultado">Resultados finales conforme a la atención brindada a los requerimientos del usuario solicitante</label>
                        <textarea class="form-control" rows="2" name="Resultado"> <?= set_value('Resultado') ?></textarea>
                    </div>
                </div>
                <div class="t">  
                    <input class="btn btn-outline-blue" type="submit" name="submit" value="Crear">
                </div>
				</form>
			</div>
		</div>	
	</div>
</div>