<?php

use App\Controllers\Tutorias\Actividad;
?>

<div class="container-fluid px-4">
	<div class="row gx-4">
		<div class="card mt-n10">
			<div class="row justify-content-between align-items-center">
				<div class="card-header"><?= esc($title) ?></div>
				<div class="col-lg-6">
					<div class="card mb-6">
						<div class="card-body">
							<!-- Muestra los mensajes en sesion -->
							<?php if (session()->getFlashdata('mensaje')): ?>
								<div class="alert alert-success">
									<div class="position-absolute top-0 end-0 mt-2 me-2">
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
									<?= esc(session()->getFlashdata('mensaje')) ?>
								</div>
							<?php endif; ?>
							<table class="TablaBonita">
								<thead>
									<tr>
										<th>No.</th>
										<th>Actividades</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 0; ?>
									<?php foreach ($actividades as $act): ?>
										<?php $i++ ?>
										<tr>
											<td><?= esc($act->Id) ?></td>
											<td><?= esc($act->Descripcion) ?></td>
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
																¿Estas seguro de eliminar la Actividad "<?= esc($act->Descripcion) ?>"?
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
																<a href="<?= url_to('\\' . Actividad::class . '::delateActividad', $act->Id) ?>" class="btn btn-primary">Si</a>
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
							Agregar Actividad
						</div>
						<div class="card-body">
							<!-- Envia la lista de errores al formulario -->
							<?php if (session()->getFlashdata('error')): ?>
								<div class="alert alert-danger">
									<div class="position-absolute top-0 end-0 mt-2 me-2">
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
									<?= validation_list_errors() ?>
								</div>
							<?php endif; ?>
							<form action="<?= url_to('\\' . Actividad::class . '::crearActividad') ?>" method="post">
								<?= csrf_field() ?>
								<label class="ms-2 mb-1" for="Nombre">Nombre de la actividad</label>
								<input class="form-control" type="input" name="Descripcion" value="<?= set_value('Descripcion') ?>"></input>
								<br>
								<div class="text-center">
									<input class="btn btn-outline-blue" type="submit" name="submit" value="Crear Actividad">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>