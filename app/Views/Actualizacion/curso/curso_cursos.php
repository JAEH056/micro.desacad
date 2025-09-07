<?php
use App\Controllers\Actualizacion\Curso;
?>
<div class="card mt-n10">
    <div class="container-fluid px-4">
        <div class="row gx-4">
        <?php if (!empty($cursos)) : ?>
            <!-- Knowledge base main category card 1-->
            <?php foreach ($cursos as $curso): ?>
                <tr>
                    <td>
                        <?php $usuario = session_get('usuario'); ?>
                        <a class="card card-icon lift lift-sm mb-4" href="<?= url_to('\\' . Curso::class .'::inscripcionCurso', $curso->Id, $usuario->Id) ?>">
                            <div class="row g-0">
                                <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="compass"></i></div>
                                <div class="col">
                                    <div class="card-body py-5">
                                        <input type="hidden" name="Id" value="<?= esc($curso->Id)?>">
                                        <h5 class="card-title text-primary mb-2"><?= esc($curso->Nombre)?></h5>
                                        <p class="card-text mb-1"><?= esc($curso->Objetivo)?></p>
                                        <div class="small text-muted"><?= esc($curso->Instructor)?></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php else : ?>
            <div class="text-center p-5">
                <h4 class="text-muted">No hay cursos disponibles en este momento <i class="fa-solid fa-book"></i></h4>
                <p class="text-muted">Por favor, vuelve a intentarlo más tarde.</p>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>