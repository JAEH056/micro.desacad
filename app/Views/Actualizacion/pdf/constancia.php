
<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Constancias</title>
        <style>
            
            @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 100;
            src: url('/var/www/proyecto/vendor/dompdf/dompdf/lib/fonts/Montserrat-Thin.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 200;
            src: url('/var/www/proyecto/vendor/dompdf/dompdf/lib/fonts/Montserrat-ExtraLight.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 300;
            src: url('/var/www/proyecto/vendor/dompdf/dompdf/lib/fonts/Montserrat-Light.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            src: url('/var/www/proyecto/vendor/dompdf/dompdf/lib/fonts/Montserrat-Regular.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 500;
            src: url('/var/www/proyecto/vendor/dompdf/dompdf/lib/fonts/Montserrat-Medium.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            src: url('/var/www/proyecto/vendor/dompdf/dompdf/lib/fonts/Montserrat-SemiBold.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            src: url('/var/www/proyecto/vendor/dompdf/dompdf/lib/fonts/Montserrat-Bold.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 800;
            src: url('/var/www/proyecto/vendor/dompdf/dompdf/lib/fonts/Montserrat-ExtraBold.ttf') format('truetype');
            }
            @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 900;
            src: url('/var/www/proyecto/vendor/dompdf/dompdf/lib/fonts/Montserrat-Black.ttf') format('truetype');
            }
            @page {
                size: letter;
                margin-top: 2cm;
                margin-right: 1cm;
                margin-bottom: 1cm;
                margin-left: 2cm; 
            }
            .fondo{
                height: 100%; /* Asegura que html y body ocupen toda la altura */
                margin: 0; /* Eliminar márgenes por defecto */
            }

            .constancia {
                margin: 0;
                padding: 0;
                page-break-after: always;
            }
            header{
                text-align: center;
                position:fixed;
                top:1cm;
                left: 0;
                width: 100%;
                right: 0;
                height: 2%;
                display: flex;
            }
            .fondo{
                position: absolute; /* Asegura que el fondo cubra todo */
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/assets/img/fondo.png')) ?>');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                z-index: -1; /* Coloca la imagen detrás del contenido */
            }

            body {
                font-size: 10px;
                line-height: 15px; 
                margin-top: 22%;                   
            }

            .sub {
                text-decoration: underline;
                border-color: #D4914A;
                left: 7%;
                width: 86%;
            }
            .t{
                font-family: montserrat;
                font-size: 14px;
                text-align: center;
                text-transform: uppercase;
            }
            .
            .l{
                border-top: 1px solid black;
                width: 40%;
                margin: 20px auto;
                
                /*height: 2px;
                max-width: 300px;
                padding: 0;
                margin-left: 200px;*/
                margin-top: 12%;
            }
            .text{
                font-family: montserrat;
                font-size: 20px;
                text-align: center;
                text-transform: uppercase;
            }
            .im{
                max-width: 90%; /* Asegura que la imagen no se desborde */
                height: auto; /* Mantiene la proporción de la imagen */
                display: block; /* Elimina espacios en la parte inferior */
                margin: auto; /* Centra la imagen dentro del <td> */
            }
            .ima{
                max-width: 15%;
                height: auto;
                vertical-align: middle;
                padding: 0;
                margin-top: 0;
                display: inline-block;
                margin-left: 1%;
            }
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                margin-top: -1cm;
                }
            footer img {
                margin-top: 15px; /* Espacio encima de las imágenes */
            }
            .if1{
                max-width: 8%; /* Ajusta el ancho de la imagen según sea necesario */
                height: auto; /* Mantiene la proporción de la imagen */
                margin-left: 5%;
            }
            .if2{
                max-width: 12%; /* Ajusta el ancho de la imagen según sea necesario */
                height: auto; /* Mantiene la proporción de la imagen */
                margin-left: 40%;
            }
            .if3{
                max-width: 8%; /* Ajusta el ancho de la imagen según sea necesario */
                height: auto; /* Mantiene la proporción de la imagen */
                margin-left: 0;
            }

        </style>

    </head>
    <?php foreach ($curso as $cur): ?>
<div class="">    
<div class="constancia">

    <header>
    <img class="im" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo.png'))?>">

    </header>
    
    <body>
    
        <p class="text"><b>EL TECNOLÓGICO NACIONAL DE MÉXICO</b><br></p>
        <p class="text">A TRAVÉS DEL </p>       
        <p class="text">INSTITUTO TECNOLÓGICO SUPERIOR DE HUATUSCO</p>                                           
        <p class="text">OTORGA LA PRESENTE</p>   
        <p class="text"><b>CONSTANCIA</br></p>
        <p class="text">A</p>
       
        <p class="text"><i><b><?= esc($cur->Grado) ?>. <?= esc($cur->Usuario) ?></b></i></p>
        
        <br>
        <br>
        <p class="t">POR SU PARTICIPACIÓNEN EL CURSO DE</p>
        <p class="t"><b><?= esc($cur->Nombre) ?></p>
        <br>

        <?php
            setlocale(LC_TIME, 'es_ES.UTF-8'); // Configura la localización
            $fecha = strtotime($cur->Inicio);
            $fechaInicio = strftime('%d de %B', $fecha);
        ?>
        <?php
            setlocale(LC_TIME, 'es_ES.UTF-8'); // Configura la localización
            $fecha = strtotime($cur->Termina);
            $fechaTermina = strftime('%d de %B', $fecha);
        ?>
        <?php
            $anio = date('Y', strtotime($cur->Termina));
        ?>

        <p class="t">CLAVE: <b><?= esc($cur->Clave) ?></b></p><br>
        <p class="t">REALIZADO DEL <?= $fechaInicio?> AL <?= $fechaTermina?> DE <?= esc($anio)?></p>        
        <p class="t">CON UNA DURACIÓN DE <?= esc($cur->Duracion) ?> HORAS.</p><br>
        <?php
            setlocale(LC_TIME, 'es_ES.UTF-8'); // Configura la localización

            $fechaFinal = esc($cur->Termina);
            $date = new DateTime($fechaFinal);
            $fechaFormateada = strftime('%d de %B de %Y', $date->getTimestamp());
        ?>
        <p class="t">HUATUSCO VERACRUZ, <?= $fechaFormateada ?></p>
        <p class="t">REGISTRO: <b><i>ITSH/DEAC/<?= esc($cur->Anio) ?>/<?= esc($cur->Consecutivo) ?></b></i></p>
        
        
        <div class="l"></div>
        <p class="t"><b>DIRECTOR GENERAL</b></p>


    </body>
    
    <footer>
        <br>
        <hr class="sub">
        <img class="if1" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo1.png'))?>">
        <img class="if2" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo2.png'))?>">
        <img class="if3" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo3.png'))?>">
        <img class="if3" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo4.jpg'))?>">
        <img class="if3" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo5.png'))?>">
    </footer>
</div>
</div>
    <?php endforeach; ?>

</html>
