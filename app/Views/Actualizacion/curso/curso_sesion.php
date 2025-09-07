<?php
use App\Controllers\Actualizacion\Curso;
?>
<div class="card mt-n10">
    <div class="card-header"><?= esc($title) ?></div>
    <div class="card-body"> 
		<div class="container-fluid">

		<?= session()->getFlashdata('error') ?>
		<?= validation_list_errors() ?> 

		<div class="sbp-preview">
            <div class="sbp-preview-content">
				<form action="<?= url_to('\\' . Curso::class .'::createSesion', $curso->Id) ?>" method="post">
				<?= csrf_field() ?>
                <input type="hidden" name="Id_Curso" value="<?= esc($curso->Id)?>">

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Tema">Tema</label>
                            <textarea class="form-control" rows="2" name="Tema"><?= set_value('Tema') ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="Contenido">Temas/Subtemas</label>
                            <textarea class="form-control" rows="2" name="Contenido"><?= set_value('Contenido') ?></textarea>
                        </div>
				    </div>
                    
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Tecnicas">Técnicas de Instrucción/Grupales</label>
                            <input class="form-control" type="input" name="Tecnicas" value="<?= set_value('Tecnicas') ?>"></input>
                        </div>
                        <div class="col-md-6">
                            <label for="Objetivo">Objetivos de Aprendizaje</label>
                            <input class="form-control" type="input" name="Objetivo" value="<?= set_value('Objetivo') ?>"></input>
					    </div>
				    </div>				
					<div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Duracion">Duración</label>
                            <input class="form-control" type="input" name="Duracion" value="<?= set_value('Duracion') ?>"></input>
                        </div>
                        <div class="col-md-6">
                            <label for="Actividades">Actividades De Enseñanza y Aprendizaje</label>
                           <textarea class="form-control" rows="2" name="Actividades"><?= set_value('Actividades') ?></textarea>
					    </div>
				    </div>
					
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">
                            <label for="Evaluacion">Actividades de Evaluación</label>
                            <input class="form-control" type="input" name="Evaluacion" value="<?= set_value('Evaluacion') ?>"></input>
                        </div>
					<div class="col-md-6">
                        <label for="Materiales">Materiales de Apoyo</label>
                        <input class="form-control" type="input" name="Materiales" value="<?= set_value('Materiales') ?>"></input>
                        
					</div>
				</div>

                   
                    <br>

                    <br>

					<input class="btn btn-outline-blue" type="submit" name="submit" value="Crear">

				</form>
			</div>
		</div>	
	</div>
</div>