<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
        <span class="col-sm-auto"><?= esc($title) ?></span>
        </div>
    <div class="card-body"> 
        <table class="table">
            <tbody>
                <tr>
                    <th>Clave</th>
                    <td class="text-start"><?= esc($curso->Clave) ?></td>
                </tr>
                <tr>
                    <th>Capacidad</th>
                    <td class="text-start"><?= esc($curso->Capacidad) ?></td>
                </tr>
                <tr>
                    <th>Curso</th>
                    <td class="text-start"><?= esc($curso->Nombre) ?></td>
                </tr>
                <tr>
                    <th>Instructor</th>
                    <td class="text-start"><?= esc($curso->Instructor) ?></td>
                </tr>
                <tr>
                    <th>Periodo</th>
                    <td class="text-start"><?= esc($curso->Periodo) ?></td>
                </tr>
                <tr>
                    <th>Objetivo</th>
                    <td class="text-start"><?= esc($curso->Objetivo) ?></td>
                </tr>
                <tr>
                    <th>Lugar</th>
                    <td class="text-start"><?= esc($curso->Lugar) ?></td>
                </tr>
                <tr>
                    <th>Requerimiento</th>
                    <td class="text-start"><?= esc($curso->Requerimiento) ?></td>
                </tr>
                <tr>
                    <th>Perfil</th>
                    <td class="text-start"><?= esc($curso->Perfil) ?></td>
                </tr>
                <tr>
                    <th>Duración</th>
                    <td class="text-start"><?= esc($curso->Duracion) ?></td>
                </tr>
                <tr>
                    <th>Horario</th>
                    <td class="text-start"><?= esc($curso->Horario) ?></td>
                </tr>
                <tr>
                    <th>Folio</th>
                    <td class="text-start"><?= esc($curso->Folio) ?></td>
                </tr>
            </tbody>
        </table> 
    </div>
</div>