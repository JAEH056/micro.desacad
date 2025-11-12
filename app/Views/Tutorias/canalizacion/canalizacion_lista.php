<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
        </div>
    </div>
    <div class="card-body">
        <table class="Tabla">
            <thead>
                <tr>
                    <th>Tutor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutorados as $tutorado): ?>
                    <tr>
                        <td><?= esc($tutorado->tutor) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>