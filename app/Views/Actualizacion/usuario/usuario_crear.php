<?php
use App\Controllers\Actualizacion\Usuario;
?>
<div class="card mt-n10">
    <div class="card-header"><?= esc($title) ?></div>
    <div class="card-body"> 
		<div class="container-fluid">

		<?= session()->getFlashdata('error') ?>
		<?= validation_list_errors() ?> 

		<div class="sbp-preview">
            <div class="sbp-preview-content">
				<form action="<?= url_to('\\' . Usuario::class .'::create') ?>" method="post">
				<?= csrf_field() ?>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Nombre">Nombre</label>
                            <input class="form-control" type="input" name="Nombre" value="<?= set_value('Nombre') ?>" required></input>
                        </div>                
					    <div class="col-md-3">
                            <label for="Primer_Apellido">Primer apellido</label>
                            <input class="form-control" type="input" name="Primer_Apellido" value="<?= set_value('Primer_Apellido') ?>" required></input>
                        </div>
                        <div class="col-md-3">
                            <label for="Segundo_Apellido">Segundo apellido</label>
                            <input class="form-control" type="input" name="Segundo_Apellido" value="<?= set_value('Segundo_Apellido') ?>" required></input>
                        
                        </div>
		            </div>
                    <div class="row gx-3 mb-3">
					    <div class="col-md-5">	
                            <label for="Curp">Curp</label>
                            <input class="form-control" type="input" name="Curp" 
                                   value="<?= set_value('Curp') ?>"
                                   title="Ingresa una CURP válida (18 caracteres en mayúsculas)"
                                   minlength="18"
                                   maxlength="18"
                                   required></input>
                        </div>    
                        <div class="col-md-5">
                            <label for="Rfc">RFC</label>
                            <input class="form-control" type="input" name="Rfc" value="<?= set_value('Rfc') ?>"
                                   title="Ingresa un RFC válido (13 caracteres en mayúsculas)"
                                   minlength="13"
                                   maxlength="13"
                                   required></input>
                        </div>
                        <div class="col-md-2">	
                            <label for="Sexo">Sexo</label>
                            <select class="form-select" type="form-select form-select-lg mb-3" name="Sexo" value="<?= set_value('Sexo') ?>"required >
                                <option selected>Selecciona</option>
                                <option value="H">H</option>
                                <option value="M">M</option>
                            </select>
                        </div>
		            </div>
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">	
                            <label for="Email">Email</label>
                            <input class="form-control" type="email" name="Email" 
                                   value="<?= set_value('Email') ?>" 
                                   required>
                        </div>
                        <div class="col-md-6">	
                            <label for="Sexo">Asigna Puesto</label>
                            <?= form_dropdown('Id_Organigrama', $puestos, null, ['class'=>'form-select']) ?>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-2">	
                            <label for="Sexo">Nivel</label>
                            <select class="form-select" type="form-select form-select-lg mb-3" name="Nivel" value="<?= set_value('Nivel') ?>"required>
                                <option selected>Selecciona</option>
                                <option value="Licenciatura">Licenciatura</option>
                                <option value="Maestria">Maestría</option>
                                <option value="Doctorado">Doctorado</option>
                            </select>
                        </div>
					    <div class="col-md-4">	
                            <label for="Curp">Carrera</label>
                            <input class="form-control" type="input" name="Carrera" value="<?= set_value('Carrera') ?>"required></input>
                        </div>    
                        <div class="col-md-4">
                            <label for="Rfc">Programa Educativo</label>
                            <input class="form-control" type="input" name="Nombre_C" value="<?= set_value('Nombre_C') ?>"required></input>
                        </div>
                         <div class="col-md-2">
                            <label for="Rfc">Siglas</label>
                            <input class="form-control" type="input" name="Siglas" value="<?= set_value('Siglas') ?>"required></input>
                        </div>
		            </div>
                    <div class="row gx-3 mb-3">
					    <div class="col-md-6">	
                            <label for="Password">Password</label>
                            <input class="form-control" type="password" name="Password" value="<?= set_value('Password') ?>"required></input>
                        </div>    
                        <div class="col-md-6">
                            <label for="pass_confirm" class="form-label">Confirma Password</label>
                            <input class="form-control" type="password" name="pass_confirm" value="<?= set_value('pass_confirm') ?>"required></input
                            >
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