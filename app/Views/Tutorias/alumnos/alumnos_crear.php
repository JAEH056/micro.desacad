<?php
use App\Controllers\Tutorias\Tutorado;
?>

<div class="container-fluid px-4">
    <div class="row gx-4">
			<div class="card mt-n10">
            <div class="card-header"><?= esc($title) ?></div>
			<?= session()->getFlashdata('error') ?>
				<div class="sbp-preview-content">
				<form action="" method="post">
				<?= csrf_field() ?>

                    <div class="row gx-3 mb-3">
					    <div class="col-md-12">
                            <label for="Nombre">Nombre</label>
                            <input class="form-control" type="input" name="Nombre" value="<?= set_value('Nombre') ?>"></input>
                        </div>
                        
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">
                            <label for="Primer_Apellido">Primer apellido</label>
                            <input class="form-control" type="input" name="Primer_Apellido" value="<?= set_value('Primer_Apellido') ?>"></input>
                        </div>
                        <div class="col-md-6">
                            <label for="Segundo_Apellido">Segundo apellido</label>
                            <input class="form-control" type="input" name="Segundo_Apellido" value="<?= set_value('Segundo_Apellido') ?>"></input>
                        
                        </div>
		            </div>
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">	
                            <label for="Curp">Curp</label>
                            <input class="form-control" type="input" name="Curp" value="<?= set_value('Curp') ?>"></input>
                        </div>    
                        <div class="col-md-3">	
                            <label for="Nc">NC</label>
                            <input class="form-control" type="input" name="Nc" value="<?= set_value('Nc') ?>"></input>
                        </div>   
                        <div class="col-md-3">	
                            <label for="Sexo">Sexo</label>
                            <select class="form-select" type="form-select form-select-lg mb-3" name="Sexo" value="<?= set_value('Sexo') ?>">
                                <option selected>Selecciona</option>
                                <option value="H">H</option>
                                <option value="M">M</option>
                            </select>
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
