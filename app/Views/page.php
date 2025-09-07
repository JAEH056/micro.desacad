<?php
use App\Controllers\Actualizacion\Curso;
use App\Controllers\Tutorias\Tutorado;
?>

<style>
    body {
        background-color: #007bff; /* Color de fondo azul */
        height: 100vh; /* Establecer la altura al 100% del viewport */
        margin: 0; /* Eliminar márgenes */
        display: flex; /* Usar flexbox para centrar verticalmente el contenido */
        justify-content: center; /* Centrar horizontalmente el contenido */
        align-items: center; /* Centrar verticalmente el contenido */
    }

    .card {
        background-color: white; /* Color de fondo de la tarjeta */
        color: black; /* Color del texto */
        padding: 20px; /* Añadir espacio interno */
    }
</style>

<div class="card mt-n10">
    <div class="container-fluid px-4">
        <div class="row gx-4">
            <a href="<?= url_to('\\' . Curso::class .'::showAll')?>" class="btn btn-primary shadow">
                <img src="ruta/a/tu/imagen1.jpg" alt="Cursos" style="width: 100px; height: 100px;">
                <span>Cursos</span>
            </a>
            <a href="<?= url_to('\\' . Tutorado::class .'::showTutor')?>" class="btn btn-primary shadow">
                <img src="ruta/a/tu/imagen2.jpg" alt="Tutorado" style="width: 100px; height: 100px;">
                <span>Tutorado</span>
            </a>
        </div>
    </div>
</div>

