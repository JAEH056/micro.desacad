
<div class="card mt-n10">
    <div class="card-header">
        <div class="row justify-content-between align-items-center">
            <span class="col-sm-2"><?= esc($title) ?></span>
        </div>
    </div>
    <div class="card-body"> 
        <table class="TablaBonita"> 
            <thead>
                <tr>
                    <th>Tutor</th>
                    <th>Curp</th>
                    <th>Email</th>
                    <th>Puesto</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tutor as $tuto): ?>
                <tr> 
                    
                    <td><?= esc($tuto->Tutor) ?></td>
                    <td><?= esc($tuto->Curp) ?></td>
                    <td><?= esc($tuto->Email) ?></td>
                    <td><?= esc($tuto->Puesto) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>