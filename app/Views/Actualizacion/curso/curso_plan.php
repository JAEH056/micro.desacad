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
				<form action="<?= url_to('\\' . Curso::class .'::createSecuencia', $sesion->Id) ?>" method="post">
                
				<?= csrf_field() ?>
                <div class="bg-primary p-2 text-dark bg-opacity-10 t">Apertura</div>
                    <input type="hidden" name="Id_Sesion" value="<?= esc($sesion->Id)?>">
                    <input type="hidden" name="Id_Fase" value="1">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-5">
                            <label for="Temas">Subtemas</label>
                            <input class="form-control" type="input" name="Temas" value="<?= set_value('Temas') ?>"></input>
                        </div>
                        <div class="col-md-5">
                            <label for="Tecnicas">Técnicas Grupales</label>
                            <input class="form-control" type="input" name="Tecnicas" value="<?= set_value('Tecnicas') ?>"></input>
                        </div>
                        <div class="col-md-2">
                            <label for="Duracion">Duración</label>
                            <input class="form-control" type="input" name="Duracion" value="<?= set_value('Duracion') ?>"></input>
                        </div>
				    </div>
                    
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Objetivo">Objetivos Especificos</label>
                            <input class="form-control" type="input" name="Objetivos" value="<?= set_value('Objetivos') ?>"></input>
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
            <div class="bg-primary p-2 text-dark bg-opacity-10 t">Desarrollo</div>
            <input type="hidden" name="Id_Sesion2" value="<?= esc($sesion->Id)?>">
                    <input type="hidden" name="Id_Fase2" value="2">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-5">
                            <label for="Temas">Subtemas</label>
                            <input class="form-control" type="input" name="Temas2" value="<?= set_value('Temas') ?>"></input>
                        </div>
                        <div class="col-md-5">
                            <label for="Tecnicas">Técnicas Grupales</label>
                            <input class="form-control" type="input" name="Tecnicas2" value="<?= set_value('Tecnicas') ?>"></input>
                        </div>
                        <div class="col-md-2">
                            <label for="Duracion">Duración</label>
                            <input class="form-control" type="input" name="Duracion2" value="<?= set_value('Duracion') ?>"></input>
                        </div>
				    </div>
                    
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Objetivo">Objetivos Especificos</label>
                            <input class="form-control" type="input" name="Objetivos2" value="<?= set_value('Objetivos') ?>"></input>
					    </div>
                        <div class="col-md-6">
                            <label for="Actividades">Actividades De Enseñanza y Aprendizaje</label>
                           <textarea class="form-control" rows="2" name="Actividades2"><?= set_value('Actividades') ?></textarea>
					    </div>
				    </div>				
					
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">
                            <label for="Evaluacion">Actividades de Evaluación</label>
                            <input class="form-control" type="input" name="Evaluacion2" value="<?= set_value('Evaluacion') ?>"></input>
                        </div>
					    <div class="col-md-6">
                        <label for="Materiales">Materiales de Apoyo</label>
                        <input class="form-control" type="input" name="Materiales2" value="<?= set_value('Materiales') ?>"></input>
                        
					</div>
				</div>
            <div class="bg-primary p-2 text-dark bg-opacity-10 t">Cirre</div>
            <input type="hidden" name="Id_Sesion3" value="<?= esc($sesion->Id)?>">
                    <input type="hidden" name="Id_Fase3" value="3">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-5">
                            <label for="Temas">Subtemas</label>
                            <input class="form-control" type="input" name="Temas3" value="<?= set_value('Temas') ?>"></input>
                        </div>
                        <div class="col-md-5">
                            <label for="Tecnicas">Técnicas Grupales</label>
                            <input class="form-control" type="input" name="Tecnicas3" value="<?= set_value('Tecnicas') ?>"></input>
                        </div>
                        <div class="col-md-2">
                            <label for="Duracion">Duración</label>
                            <input class="form-control" type="input" name="Duracion3" value="<?= set_value('Duracion') ?>"></input>
                        </div>
				    </div>
                    
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Objetivo">Objetivos Especificos</label>
                            <input class="form-control" type="input" name="Objetivos3" value="<?= set_value('Objetivos') ?>"></input>
					    </div>
                        <div class="col-md-6">
                            <label for="Actividades">Actividades De Enseñanza y Aprendizaje</label>
                           <textarea class="form-control" rows="2" name="Actividades3"><?= set_value('Actividades') ?></textarea>
					    </div>
				    </div>				
					
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">
                            <label for="Evaluacion">Actividades de Evaluación</label>
                            <input class="form-control" type="input" name="Evaluacion3" value="<?= set_value('Evaluacion') ?>"></input>
                        </div>
					    <div class="col-md-6">
                        <label for="Materiales">Materiales de Apoyo</label>
                        <input class="form-control" type="input" name="Materiales3" value="<?= set_value('Materiales') ?>"></input>
                        
					</div>
				</div>
                    <br>

                    <br>
                <div class="t">
					<input class="btn btn-outline-blue" type="submit" name="submit" value="Crear">
                </div>
				</form>
			</div>
		</div>	
	</div>
</div>