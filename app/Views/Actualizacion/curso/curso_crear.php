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
				<form action="<?= url_to('\\' . Curso::class .'::create') ?>" method="post">
				<?= csrf_field() ?>
				<div class="row gx-3 mb-3">
					<div class="col-md-3">
						<label for="Clave">Clave</label>
						<input class="form-control" type="input" name="Clave" value="<?= set_value('Clave') ?>"></input>
						
					</div>
					<div class="col-md-3">
						<label for="Capacidad">Numero de Integrantes</label>
						<input class="form-control" type="input" name="Capacidad" value="<?= set_value('capacidad') ?>"></input>
						
					</div>
					<div class="col-md-6">
						<label for="Nombre">Curso</label>
						<input class="form-control" type="input" name="Nombre" value="<?= set_value('Nombre') ?>"></input>
						
					</div>
				</div>	
				<div class="row gx-3 mb-3">
					<div class="col-md-6">
						<label for="Periodo">Periodo</label>
						<?= form_dropdown('Id_Periodo', $periodos, null, ['class'=>'form-select']) ?>
					</div>
					<div class="col-md-6">
						<label for="Lugar">Lugar</label>
						<input class="form-control" type="input" name="Lugar" value="<?= set_value('Lugar') ?>"></input>
						
						
					</div>
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
				<div class="row gx-3 mb-3">
					<div class="col-md-6">
						<label for="Objetivo">Objetivo</label>
						<textarea class="form-control" rows="1" name="Objetivo"><?= set_value('Objetivo') ?></textarea>

					</div>
						<div class="col-md-6">
						<label for="Requerimiento">Requerimiento</label>
						<textarea class="form-control" rows="1" name="Requerimiento"><?= set_value('Requerimiento') ?></textarea>

						<!--<input class="form-control" type="te" name="Requerimiento" value="<?= set_value('Requerimiento') ?>"></input>-->
						
					</div>
				</div>
				<div class="row gx-3 mb-3">
					<div class="col-md-12">
						<label for="Perfil">Perfil</label>
						<input class="form-control" type="input" name="Perfil" value="<?= set_value('Perfil') ?>"></input>
						
					</div>
				</div>
				<div class="row gx-3 mb-3">
					<div class="col-md-4">
						<label for="Duracion">Duración</label>
						<input class="form-control" type="input" name="Duracion" value="<?= set_value('Duracion') ?>"></input>
						
					</div>
					<div class="col-md-4">
						<label for="Horario">Horario</label>
						<input class="form-control" type="input" name="Horario" value="<?= set_value('Horario') ?>"></input>
						
					</div>
					<div class="col-md-4">
						<label for="Folio">Folio</label>
						<input class="form-control" type="input" name="Folio" value="<?= set_value('Folio') ?>"></input>
						
					</div>
				</div>
				<div class="text-center">
					<input class="btn btn-outline-blue" type="submit" name="submit" value="Crear">
				</div>
				</form>
			</div>
		</div>	
	</div>
</div>