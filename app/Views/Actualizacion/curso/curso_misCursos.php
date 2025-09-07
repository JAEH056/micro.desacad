<?php
use App\Controllers\Actualizacion\Curso;
?>
<div class="card mt-n10">
    <div class="container-fluid px-4">
        <div class="row gx-4">
            <!-- Knowledge base main category card 1-->
            <?php foreach ($cursos as $curso): ?>
                <tr>
                    <td>
                        <?php $usuario = session_get('usuario'); ?>
                        <a class="card card-icon lift lift-sm mb-4" href="">
                            <a class="card card-icon lift lift-sm mb-4" href="<?= url_to('\\' . Curso::class .'::encuesta', $curso->Id_Inscripcion) ?>">

                            <div class="row g-0">
                                <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="compass"></i></div>
                                <div class="col">
                                    <div class="card-body py-5">
                                        <input type="hidden" name="Id" value="<?= esc($usuario->Id)?>">
                                        <input type="hidden" name="Id" value="<?= esc($curso->Id_Inscripcion)?>">
                                        <h5 class="card-title text-primary mb-2"><?= esc($curso->Curso)?></h5>
                                        <p class="card-text mb-1"><?= esc($curso->Objetivo)?></p>
                                        
                                    </div>
                                </div>
                            </div>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-info">
                    <?= session()->getFlashdata('mensaje') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>