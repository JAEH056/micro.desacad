<?php
use App\Controllers\Actualizacion\Periodo;
?>
<div class="card mt-n10">
    <div class="card-header"><?= esc($title) ?></div>
    <div class="card-body"> 
		<div class="container-fluid">

		<?= session()->getFlashdata('error') ?>
		<?= validation_list_errors() ?> 

		<div class="sbp-preview">
            <div class="sbp-preview-content">
				<form action="<?= url_to('\\' . Periodo::class .'::create') ?>" method="post">
				<?= csrf_field() ?>

					<label for="Nombre">Periodo</label>
					<input class="form-control" type="input" name="Nombre" value="<?= set_value('Nombre') ?>"></input>
					<br>
					<div class="row gx-3 mb-3">
					    <div class="col-md-6">
							<label for="body">Fecha de Inicio</label>
							<input class="form-control" type="date" name="Inicia" value="<?= set_value('Inicia') ?>"></input>
						</div>
						<div class="col-md-6">
							<label for="body">Fecha de Terminación</label>
							<input class="form-control" type="date" name="Termina" value="<?= set_value('Termina') ?>"></input>
							
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