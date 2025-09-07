<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Encuesta</title>
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

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        table {
            width: 100%;
            height: 2%;
        }

        .tb {
            border: 0;
        }

        .tb1 {
            width: 0.5cm;
            border: 0;
        }

        th {
            background-color: #B7B7B7;
            color: white;
            color: #000000;
        }

        h4 {
            text-align: end;
        }

        body {
            font-size: 10px;
            line-height: 15px;
        }

        .sub {
            text-decoration: underline;
            padding: 0 10px 100% 0;
        }

        .t {
            text-align: center;
            font-size: 12px;
            margin-top: 1;
            margin-bottom: 1;

        }

        .tx {
            text-align: center;
        }

        .text {
            font-family: montserrat;
            font-size: 10px;
            /*text-transform: uppercase;*/
            margin-top: 1;
            margin-bottom: 1;
        }

        .bi {
            border-top: 1px solid #000000
        }

        .tt {
            font-family: montserrat;
            font-size: 12px;
            margin-top: 1;
            margin-bottom: 1;
        }

        .l {
            border-top: 1px solid black;
            height: 2px;
            max-width: 250px;
            padding: 0;
            margin-left: 35px;
        }

        .l2 {
            border-top: 1px solid black;
            height: 2px;
            max-width: 300px;
            padding: 0;
            margin-left: 650px;
        }

        .nc {
            border-top: 1px solid black;
            height: 2px;
            max-width: 230px;
            padding: 0;
            margin-left: 112px;
        }

        .lt {
            border-top: 1px solid black;
            height: 2px;
            max-width: 505;
            padding: 0;
            margin-left: 187px;
        }

        .fd {
            border-top: 1px solid black;
            height: 2px;
            max-width: 135;
            padding: 0;
            margin-left: 550px;
        }

        .c {
            border-top: 1px solid black;
            height: 2px;
            max-width: 750;
            padding: 0;
            margin-left: 155px;
        }

        .i {
            border-top: 1px solid black;
            height: 2px;
            max-width: 710;
            padding: 0;
            margin-left: 157px;
        }

        .tc {
            width: 20px;
            word-wrap: break-word;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .cn {
            width: 10px;
            height: 20px;
            padding-top: 30px 50px;
            background-color: white;
            border: 1px solid black;
            margin-left: 20px;
        }

        .he {
            height: 1%;
        }

        .qb {
            border-top: 0;
            border-right: 0;
            border-bottom: 1px solid black;
            border-left: 0;
        }

        .mi-imagen {
            max-width: 100%;
            /* Asegura que la imagen no se desborde */
            height: auto;
            /* Mantiene la proporción de la imagen */
            display: block;
            /* Elimina espacios en la parte inferior */
            margin: auto;
            /* Centra la imagen dentro del <td> */
        }

        .mi-tabla {
            width: 100%;
            /* Cambia el porcentaje o usa px para un ancho fijo */
            margin: auto;
            /* Centra la tabla en la página */
            border-collapse: collapse;
            /* Para un aspecto más limpio */
        }

        .nc1 {
            display: inline-block;
            width: 225;
            height: auto;
            padding: auto;
            border-bottom: 1px solid black;
        }

        .p1 {
            display: inline-block;
            width: 130;
            height: auto;
            padding: auto;
            border-bottom: 1px solid black;
            /*position: absolute; 
            padding: 0 10px 0 0px;
            margin: 0 auto;*/
        }
    </style>

</head>

<body>
    <header>
        <table class="mi-tabla">
            <thead>

                <tr>
                    <td height="20px" width="9%" rowspan="3"><img class="mi-imagen" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/post_logo_educ.jpg')) ?>"></td>
                    <td height="1%" width="25%" rowspan="2">Encuesta de Opinión</td>
                    <td height="1%" width="12%" rowspan="1" class="t">Código: M00-SC-DP-020-R</td>
                    <td height="1%" width="6%" rowspan="3"><img class="mi-imagen" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('//var/www/proyecto/public/logos/TecNM_logo.png')) ?>"></td>
                </tr>
                <tr>
                    <td rowspan="1" class="t">Revisión: 0</td>
                </tr>
                <tr>
                    <td rowspan="1">Referencia a la Norma ISO 9001:2015 y la NMX-R-025-SCFI-2015</td>
                    <td rowspan="1" class="t">Página 1 de 1</td>
                </tr>
            </thead>
        </table>

        <br>
        <table class="tb">
            <thead>
                <tr>
                    <td class="tb" colspan="3" width='25%' bgcolor="#FFFEFE"></td>
                    <td colspan="1" width='25%' class="tx">Clave de identificación</td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1"></td>
                    <td class="t tb" colspan="1">Encuesta de Opinión Cursos de Capacitación Presencial</td>
                    <td class="t tb" colspan="1"></td>
                    <td colspan="1"></td>
                </tr>
            </thead>
        </table>
        <br>
        <table style="width:100%; border-collapse:separate; border-spacing:0; border:none; font-size:10px; margin-bottom:4px;">
            <tr>
                <td style="border:none; padding:2px 4px; width:2.5cm;">Nombre del Curso:</td>
                <td class="qb" style=" padding:2px 4px; width:8cm; text-align:left; vertical-align:bottom;">
                    <?= esc($curso->Nombre) ?>
                </td>
                <td style="border:none; padding:1px 2px; width:2.5cm;">Fecha de realización:</td>
                <td class="qb" style="border-bottom:1px solid black; padding:1px 2px; width:4.5cm; text-align:left; vertical-align:bottom;">
                    <?= esc($curso->Periodo) ?>
                </td>
            </tr>
        </table>

        <!-- Centro de Trabajo -->
        <table style="width:100%; border-collapse:separate; border-spacing:0; border:none; font-size:10px; margin-bottom:4px;">
            <tr>
                <td style="border:none; padding:2px 4px; width:4cm;">Nombre del Centro de Trabajo:</td>
                <td class="qb" style="padding:2px 4px; width:15cm; text-align:left; vertical-align:bottom;">
                    Instituto Tecnológico Superior de Huatusco
                </td>
            </tr>
        </table>

        <!-- Instructor -->
        <table style="width:100%; border-collapse:separate; border-spacing:0; border:none; font-size:10px; margin-bottom:4px;">
            <tr>
                <td style="border:none; padding:2px 4px; width:3cm;">Nombre del Instructor(a):</td>
                <td class="qb" style="padding:2px 4px; width:16cm; text-align:left; vertical-align:bottom;">
                    <?= esc($curso->Instructor) ?>
                </td>
            </tr>
        </table>
        <p class="t"><b>La presente encuesta tiene como finalidad conocer su opinión sobre el curso de capacitación en el que participó, las respuestas nos servirán para mejorarlo.</b></p><br>
        <p class="tt"><b>INSTRUCCIÓN:</b> <span>Solicitamos exprese su opinión sobre los siguientes aspectos escribiendo el número correspondiente en el recuadro de la derecha según la siguiente escala:</span></p>
        <br>

        <table class="tb">
            <tbody>
                <tr style="width: 17.5cm;">
                    <td style="border:none;" rowspan="1" colspan="1" width='1.1cm'></td>
                    <td class="t" rowspan="1" colspan="1" width='0.5cm'>5</td>
                    <td class="tb" rowspan="1" colspan="2" width='2.1cm'>Totalmente de acuerdo</td>
                    <td class="tb" rowspan="1" colspan="1" width='0.6cm'></td>
                    <td class="t" rowspan="1" colspan="1" width='0.5cm'>4</td>
                    <td class="tb tx" rowspan="1" colspan="2" width='2.3cm'>Parcialmente de acuerdo</td>
                    <td class="tb" rowspan="1" colspan="1" width='0.7cm'></td>
                    <td class="t" rowspan="1" colspan="1" width='0.5cm'>3</td>
                    <td class="tb" rowspan="1" colspan="2" width='2.6cm'>Indiferente</td>
                    <td class="t" rowspan="1" colspan="1" width='0.5cm'>2</td>
                    <td class="tb" rowspan="1" colspan="2" width='2.1cm'>Parcialmente en desacuerdo</td>
                    <td class="tb" rowspan="1" colspan="1" width='0.5cm'></td>
                    <td class="t" rowspan="1" colspan="1" width='0.5cm'>1</td>
                    <td class="tb" rowspan="1" colspan="2" width='2.1cm'>En desacuerdo</td>
                    <td class="tb" rowspan="1" colspan="1" width='0.8cm'></td>
                </tr>
            </tbody>
        </table>
        <table class="tb">
            <thead>
                <tr>
                    <td class="tb he" colspan="17"></td>
                </tr>
            </thead>
            <tbody style="width: 17.5cm;">

                <tr>
                    <td class="tb he" colspan="17"></td>
                </tr>

                <tr>
                    <th colspan="8">INSTRUCTOR(A)</th>
                    <td class="tb1" colspan="1"></td>
                    <th colspan="8">CURSO</th>
                </tr>
                <!-- Espacio en blanco-->
                <tr>
                    <td class="tb he" colspan="17"></td>
                </tr>

                <tr>
                    <td class="t tb" colspan="1">1</td>
                    <td class="qb" colspan="5">Expuso el objetivo y temario del curso.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[0]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1">11</td>
                    <td class="qb" colspan="5">La distribución del tiempo fue adecuada para cubrir el contenido.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[10]['Respuesta'] ?></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1">2</td>
                    <td class="qb" colspan="5">Mostró dominio del contenido abordado.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[1]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1" colspan="1"></td>

                    <td class="t tb" colspan="1">12</td>
                    <td class="qb" colspan="5">Los temas fueron suficientes para alcanzar el objetivo del curso.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[11]['Respuesta'] ?></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1">3</td>
                    <td class="qb" colspan="5">Fomentó la participación del grupo.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[2]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1">13</td>
                    <td class="qb" colspan="5">El curso comprendidó ejercicios de práctica relacionados con el contenido.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[12]['Respuesta'] ?></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1">4</td>
                    <td class="qb" colspan="5">Aclaró las dudas que se presentaron.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[3]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1">14</td>
                    <td class="qb" colspan="5">El curso cubrió sus expectativas.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[13]['Respuesta'] ?></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1">5</td>
                    <td class="qb" colspan="5">Dio retroalimentación a los ejercicios realizados</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[4]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1"></td>
                    <td class="tb" colspan="5"></td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1">6</td>
                    <td class="qb" colspan="5">Aplicó una evaluación final relacionada con los contenidos del curso.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[5]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1"></td>

                    <th colspan="8">INFRAESTRUCTURA</th>
                </tr>
                <tr>
                    <td class="t tb" colspan="1">7</td>
                    <td class="qb" colspan="5">Inició y concluyó puntualmente las sesiones.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[6]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1"></td>
                    <td class="tb" colspan="5"></td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1"></td>
                    <td class="tb" colspan="5"></td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="tb" rowspan="1" colspan="1"></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1">15</td>
                    <td class="qb" colspan="5">La iluminación del aula fue adecuada.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[14]['Respuesta'] ?></td>
                </tr>
                <tr>
                    <th colspan="8">MATERIAL DIDÁCTICO</th>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1">16</td>
                    <td class="qb" colspan="5">La ventilación del aula fue adecuada.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[15]['Respuesta'] ?></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1"></td>
                    <td class="tb" colspan="5"></td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="tb" rowspan="1" colspan="1"></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1">17</td>
                    <td class="qb" colspan="5">El aseo del aula fue adecuado.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[16]['Respuesta'] ?></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1">8</td>
                    <td class="qb" colspan="5">El material didáctico fue útil a lo largo del curso.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[7]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1">18</td>
                    <td class="qb" colspan="5">El servicio de los sanitarios fue adecuado (limpieza, abasto de papel, toallas, jabón, etc.).</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[17]['Respuesta'] ?></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1">9</td>
                    <td class="qb" colspan="5">La impresión del material didáctico fue legible.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[8]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1">19</td>
                    <td class="qb" colspan="5">El servicio de café fue adecuado</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[18]['Respuesta'] ?></td>
                </tr>
                <tr>
                    <td class="t tb" colspan="1">10</td>
                    <td class="qb" colspan="5">La variedad del material didáctico fue suficiente para apoyar su aprendizaje.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[9]['Respuesta'] ?></td>

                    <td class="tb1" colspan="1"></td>

                    <td class="t tb" colspan="1">20</td>
                    <td class="qb" colspan="5">Recibió apoyo del personal que coordinó el curso.</td>
                    <td class="tb" rowspan="1" colspan="1"></td>
                    <td class="t" rowspan="1" colspan="1"><?= $encuesta->Respuestas[19]['Respuesta'] ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <table>
            <thead>
                <tr>
                    <th width='auto' style=" background-color:#B7B7B7 ;">COMENTARIOS O SUGERENCIAS</td>
                </tr>
                <tr>
                    <td height="10%" class="t"><?= esc($encuesta->Comentarios) ?></td>
                </tr>
            </thead>
        </table>

        <footer>
            <p style=" text-align: center;">Gracias.</p>
            <p>M00-SC-DP-020-R08 <span style=" position: absolute; padding: 0 10px 0 585px; margin: 0 auto;">Rev. 0</span></p>
        </footer>

</html>