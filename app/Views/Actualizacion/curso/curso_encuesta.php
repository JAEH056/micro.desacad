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
				<form action="<?= url_to('\\' . Curso::class .'::saveEncuesta', $id_inscripcion) ?>" method="post" >
				    <?= csrf_field() ?>
                    <div class="row gx-3 mb-3">
                    <input type="hidden" name="Id_Inscripcion" value="<?= esc($id_inscripcion)?>">
                        <style>
                            .girada td:not(:first-child) {
                                writing-mode: vertical-rl;
                                text-orientation: mixed;
                                transform: rotate(-180deg);
                            }
                        </style>
                        <table>
                            <tbody>
                                <tr class="girada">
                                    <td>Preguntas</td>
                                    <td>Totalmente <br>de acuerdo</td>
                                    <td>Parcialmente <br>de acuerdo</td>
                                    <td>Indiferente</td>
                                    <td>Parcialmente <br>en desacuerdo</td>
                                    <td>En desacuerdo</td>
                                </tr>
                                <?php $seccion = '' ?>
                                <?php foreach ($preguntas as $pregunta): ?>
                                    <?php if($seccion != $pregunta['Seccion']): ?>
                                        <?php $seccion = $pregunta['Seccion'] ?>
                                        <tr>
                                            <td colspan="6" class="bg-light text-center">
                                                <?= $pregunta['Seccion'] ?>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                    <tr>
                                        <th>
                                            <?= $pregunta['Pregunta'] ?>
                                        </th>
                                        <?php for($i = 5; $i > 0; $i--): ?>
                                            <td style="white-space: nowrap;">
                                                <?php $btnid   = 'p' . $pregunta['Id'] . 'r' . $i ?>
                                                <?php $btnname = 'p' . $pregunta['Id'] ?>
                                                <input type="radio" class="btn-check" name="<?= $btnname ?>" id="<?= $btnid ?>" autocomplete="off" value="<?= $i ?>">
                                                <label class="btn btn-outline-secondary" name="<?= $btnname ?>" for="<?= $btnid ?>"><?= $i ?></label>
                                            </td>
                                        <?php endfor ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-12 text-center">
                                <label for="Comentarios">COMENTARIOS O SUGERENCIAS</label>
                                <textarea class="form-control" rows="2" name="Comentarios"><?= set_value('Comentarios') ?></textarea>
                            </div>
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