<?php

use App\Controllers\Actualizacion\Curso;
?>
<div class="card mt-n10">
    <div class="container-fluid px-4">
        <div class="row gx-4">
            <!-- Knowledge base main category card 1-->
            <?php $usuario = session_get('usuario'); ?>
            <?php foreach ($cursos as $curso): ?>
                <?php if (isset($curso->Concluido)): ?>
                    <div class="col-xl-12 col-md-6">
                        <div class="text-center p-5">
                            <h4 class="text-muted">El curso <?= esc($curso->Curso) ?> a finalizado<i class="fa-solid fa-book"></i></h4>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-xl-12 col-md-6">
                        <a class="card card-icon lift lift-sm mb-4" href="<?= url_to('\\' . Curso::class . '::actividadCurso', $curso->Id) ?>">
                            <div class="row g-0">
                                <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50 fa-solid fa-chalkboard-user" data-feather="compass"></i></div>
                                <div class="col">
                                    <div class="card-body py-5">
                                        <input type="hidden" name="Id" value="<?= esc($usuario->Id) ?>">
                                        <input type="hidden" name="Id" value="<?= esc($curso->Id) ?>">
                                        <h5 class="card-title text-primary mb-2"><?= esc($curso->Curso) ?></h5>
                                        <p class="card-text mb-1"><?= esc($curso->Objetivo) ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>
    </div>
</div>