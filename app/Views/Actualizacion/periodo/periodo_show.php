<div class="card mt-n10">
    <div class="card-header"><?= esc($title) ?></div>
    <div class="card-body"> 
        <div class="container-fluid">
            <ul>
                <li>Id <?= esc($periodo->Id) ?></li>
                <li>Periodo <?= esc($periodo->Nombre) ?></li>
                <li>Inicia <?= esc($periodo->Inicia) ?></li>
                <li>Termina <?= esc($periodo->Termina) ?></li>
                <li>Intervalo <?= esc($periodo->Intervalo) ?></li>
            </ul>
        </div>
    </div>
</div>
