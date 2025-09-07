
<?php
use App\Controllers\Actualizacion\Curso;
?>
<!-- Contenido -->
<div class="card mt-n10">
    <div class="card-header"><?= esc($title) ?></div>
    <div class="card-body"> 
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                <form method="post" action="<?= url_to('\\' . Curso::class .'::actualizar')?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="Id" value="<?= esc($curso->Id)?>">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-3">
                            <label for="Clave">Clave</label>
                            <input class="form-control" type="text" name="Clave" value="<?= esc($curso->Clave)?>">
                        </div>
                    <div class="col-md-3">
						<label for="Capacidad">Numero de Integrantes</label>
						<input class="form-control" type="input" name="Capacidad" value="<?= esc($curso->Capacidad) ?>"></input>
						
					</div>
                        <div class="col-md-6">
                            <label for="Nombre">Nombre</label>
                            <input class="form-control" type="text" name="Nombre" value="<?= esc($curso->Nombre)?>">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Inicia">Inicia</label>
                            <input class="form-control" type="date" name="Inicia" value="<?= esc($curso->Inicia)?>"></input>
                        </div>
                        <div class="col-md-6">
                            <label for="Termina">Termina</label>
                            <input class="form-control" type="date" name="Termina" value="<?= esc($curso->Termina)?>"></input>
                            
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Periodo">Periodo</label>
                            <?= form_dropdown('Id_Periodo', $periodos, $curso->Id_Periodo, ['class' => 'form-select']) ?>
                            <!--<input class="form-control" type="form-select form-select-lg mb-3" name="Periodo" value="<?= esc($curso->Periodo)?>" -->
                        </div>
                        <div class="col-md-6">
                            <label for="Lugar">Lugar</label>
                            <input class="form-control" type="text" name="Lugar" value="<?= esc($curso->Lugar)?>">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="Objetivo">Objetivo</label>
                            <textarea class="form-control" rows="1" name="Objetivo"><?= esc($curso->Objetivo)?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="Requerimiento">Requerimiento</label>
                            <textarea class="form-control" rows="1" name="Requerimiento"><?= esc($curso->Requerimiento)?></textarea>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                            <div class="col-md-12">
                            <label for="Perfil">Perfil</label>
                            <input class="form-control" type="text" name="Perfil" value="<?= esc($curso->Perfil)?>">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">    
                        <div class="col-md-4">
                            <label for="Duracion">Duración</label>
                            <input class="form-control" type="number" name="Duracion" value="<?= esc($curso->Duracion)?>">
                        </div>
                    
                    
                            <div class="col-md-4">
                            <label for="Horario">Horario</label>
                            <input class="form-control" type="text" name="Horario" value="<?= esc($curso->Horario)?>">
                        </div>
                        <div class="col-md-4">
                            <label for="Folio">Folio</label>
                            <input class="form-control" type="text" name="Folio" value="<?= esc($curso->Folio)?>">
                        </div>
                    </div>
                
                    <div class="text-center">
                        <input class="btn btn-outline-blue" type="submit" name="submit" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
        <div>
            <?= validation_list_errors() ?>
        </div>
    </div>
</div>
    

