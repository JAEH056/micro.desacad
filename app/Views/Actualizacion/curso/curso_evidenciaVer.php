<!DOCTYPE html>

    <html lang="en">
    <style>
        .container-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
        }

        .gallery-item {
            text-align: center;
            border-radius: 4px;
            padding: 8px;
            transition: transform 0.2s;
        }


        .img-fluid {
            width: 100%;
            height: auto;
            border-radius
        }

        .modal {
            z-index: 2000; /* Asegúrate de que sea un valor alto */
        }
        
    </style>
</html>
<?php
use App\Controllers\Actualizacion\Curso;
?>
<div class="card mt-n10">
    <div class="card-header"><?= esc($title) ?></div>
    <div class="card-body"> 
		<div class="container-fluid">
            <div class="col-sm-12">
                <h1>Imágenes del Curso</h1>
                <div class="container-gallery">
                    <?php if (!empty($imagenes)): ?>
                        <?php $i=0; ?>
                        <?php foreach ($imagenes as $img): ?>
                        <?php $i++ ?>
                        <div class="gallery-item">
                                <?php
                                    $imgSrc = base_url('evidencias/' . $img->Imagen);
                                ?>
                                <img src="<?= esc($imgSrc, 'html') ?>" alt="Imagen del curso" style="width: 300px; height: 300px;">
                                <a href="<?= esc($imgSrc, 'html') ?>" download="<?= esc($img->Imagen) ?>" class="btn btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Descargar"><i class="fa-solid fa-download"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#Modal<?= $i ?>" class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="tooltip" data-bs-title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>
                                <div class="modal fade" id="Modal<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar esta imagen?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <a href="<?= url_to('\\' . Curso::class .'::evidenciaDelete', $img->Id_Img, $curso->Id)?>" class="btn btn-primary">Si</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay imágenes disponibles para este curso.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>