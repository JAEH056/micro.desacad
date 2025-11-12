<?php

use App\Controllers\Tutorias\Grupo;
?>
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
        </div>
    </div>
    <div class="card-body px-4">
        <div class="row gx-4">
            <!-- Lista de grupos del asesor -->
            <?php if (empty($grupos)): ?>
                <p>No hay grupos</p>
            <?php else: ?>
                <?php foreach ($grupos as $grupo): ?>
                    <?php $usuario = session_get('usuario'); ?>
                    <a class="card card-icon lift lift-sm mb-4 bg-luz" href="<?= url_to('\\' . Grupo::class . '::gruposMenu', $usuario->Id, $grupo->Id) ?>">
                        <div class="row g-0">
                            <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="compass"></i></div>
                            <div class="col">
                                <div class="card-body py-5">
                                    <input type="hidden" name="Id" value="<?= esc($grupo->Id) ?>">
                                    <h5 class="card-title text-primary mb-2"><?= esc($grupo->Nombre) ?></h5>
                                    <h5 class="card-title text-primary mb-2"><?= esc($grupo->Carrera) ?></h5>
                                    <p class="card-text mb-1"><?= esc($grupo->Semestre) ?></p>
                                    <div class="small text-muted"><?= esc($grupo->Periodo) ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>