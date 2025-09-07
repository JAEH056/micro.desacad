<?php
use App\Controllers\Actualizacion\Curso;
?>
<div class="container-fluid px-4">
    <div class="row gx-4">
			<div class="card mt-n10">
				<div class="row justify-content-between align-items-center">
					<div class="col-lg-6">
						<div class="card-header"><?= esc($title . $curso->Nombre) ?></div>
						<?= session()->getFlashdata('error') ?>
						<?= validation_list_errors() ?> 
						<div class="card mb-6">
							<div class="card-body"> 
								<table class="TablaBonita"> 
									<thead>
										<tr>
											<th>Instructor</th>
											<th>Fecha</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php $i=0; ?>
										<?php foreach ($instructores as $ins): ?>
										<?php $i++ ?>
											<tr>
												<td><?= esc($ins->Instructor) ?></td>
												<td><?= esc($ins->Cuando) ?></td>
												<td>
													<a data-bs-toggle="modal" data-bs-target="#Modal<?= $i ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>
													<div class="modal fade" id="Modal<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
															<div class="modal-header">
																<h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
																¿Estas seguro de eliminar el instructor "<?= esc($ins->Instructor) ?>"?
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
																<a href="<?= url_to('\\' . Curso::class .'::deleteInstructor', $ins->Id_Curso, $ins->Id_Usuario )?>" class="btn btn-primary">Si</a>
															</div>
															</div>
														</div>
													</div>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card card-header-actions">
							<div class="card-header">
								Agregar Instructor
							</div>
							<div class="card-body">
							<?= session()->getFlashdata('error') ?>
							<?= validation_list_errors() ?> 

								
								<?= form_open( url_to('\\' . Curso::class .'::insertarInstructor')) ?>
								<?= csrf_field() ?>
								<input type="hidden" name="Id_Curso" value="<?= esc($curso->Id)?>">
									
									<div>
										<label for="Instructor">Instructor</label>
										<?= form_dropdown('Id_Usuario', $usuarios, null, ['class'=>'', 'id'=>'listIn']) ?>
									</div>
									<br>
									<div class="text-center">
									<input class="btn btn-outline-blue" type="submit" name="submit" value="Asignar">
								</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>
	</div>
</div>
<script>
	new SlimSelect({
  select: '#listIn'
})
</script>
