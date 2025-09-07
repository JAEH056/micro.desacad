<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Carta Descriptiva</title>
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
        header{
            position:fixed;
            top:0;
            left: 0;
            width: 100%;
            right: 0cm;
            height: 5%;
        }
        table { 
            border-collapse: collapse;
        }
        table,th,td {
            border: 1px solid black;
        }
        table   { 
            width: 100%;
            height: 2%;
        }
        th{ background:#5E5151; color:white}
        h4 {text-align:end;}
        body {
            font-size: 10px;
            font-family: Montserrat-Black;
            line-height: 15px;
            margin-top: 12%;
            margin-left: 0;
            margin-right: 0;
            margin-bottom: 2cm;
        }

        .sub {
        text-decoration: underline;
        padding: 0 10px 100% 0;
        }
        .t{
            text-align: center;
        }
        .text{
            font-family: montserrat;
            font-size: 10px;
            text-transform: uppercase;
            margin-top:1;
            margin-bottom:1;
        }
        .l{
            border-top: 1px solid black;
            height: 2px;
            max-width: 250px;
            padding: 0;
            margin-left: 35px;
        }
        .l2{
            border-top: 1px solid black;
            height: 2px;
            max-width: 300px;
            padding: 0;
            margin-left: 650px;
        }
        .lt{
            border-top: 1px solid black;
            height: 2px;
            max-width: 305;
            padding: 0;
            margin-left: 255px;
        }
        .fd{
            border-top: 1px solid black;
            height: 2px;
            max-width: 150;
            padding: 0;
            margin-left: 755px;
        }
        .c{
            border-top: 1px solid black;
            height: 2px;
            max-width: 750;
            padding: 0;
            margin-left: 155px;
        }
        .i{
            border-top: 1px solid black;
            height: 2px;
            max-width: 710;
            padding: 0;
            margin-left: 210px;
        }
        .prin{
            font-family: montserrat;
            font-size: 24px;
            text-transform: uppercase;
            text-align: center;
        }
        .bor{
            width: 100%;
            border-color: black;
            border-width: 1px;
            border-style: solid;
        }
        .ele{
            width: 60%;
            height: 35px;
            border-color: black;
            border-width: 1px;
            border-style: solid;
        }
        .ele1{
            width: 40%;
            height: 50px;
            border-color: black;
            border-width: 1px;
            border-style: solid;
            position: absolute; 
            left: 270;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }
        div {
        margin-top: 0px;
        }

        #cont {
            border: solid black 0px;
        }

        #fila1>div {
            display: inline-block;
        }
        #fila1>div>div {
            border: solid black 1px;
            height: 40px;
        }

        #fila2>div {
            display: inline-block;
        }
        #fila2>div>div {
            border: solid black 1px;
            height: 40px;
        }
        #fila3>div {
            display: inline-block;
        }
        #fila3>div>div {
            border: solid black 1px;
            height: 40px;
        }
        #fila4>div {
            display: inline-block;
        }
        #fila4>div>div {
            border: solid black 1px;
            height: 40px;
        }
        #fila2caja1 {
            /*background-color: blue;*/
        }
    </style>

    </head>

    <header>
        <table  position: absolute>
            <thead>
                
                <tr>
                    <td width="15%" rowspan="3" ><img src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/post_logo_educ.jpg'))?>" height="100px" width="100%"></td>
                    <td width="45%"rowspan="2"><b>Carta Descriptiva</b></td>
                    <td width="10%"rowspan="1"><b>Código:</b> M00-SC-DP-020-R09</td>
                </tr>
                <tr>
                    <td rowspan="1"><b>Revisión: 0</b></td>
                </tr>
                <tr>
                    <td rowspan="1"><b>Referencia a la Norma ISO 9001:2015 y la NMX-R-025-SCFI-2015</b></td>
                    <td rowspan="1"><b>Página 1 de 1</b></td>
                </tr>
            </thead>
        </table>
    </header>
    <body>
    <br>
    <p class="prin"><b>CARTA DESCRIPTIVA</p>
        
    <div id="cont">
        <div id="fila1">
            <div style="width: 55%">
                <div>
                NOMBRE DEL CURSO DE CAPACITACIÓN: <?= esc($curso->Nombre) ?>
                </div>
            </div><div style="width: 45%">
                <div>
                FECHA DE IMPARTICIÓN: <?= esc($curso->Periodo) ?>
                </div>
            </div>
        </div>
        <div id="fila2">
            <div style="width: 70%">
                <div>
                OBJETIVO GENERAL DEL CURSO: <?= esc($curso->Objetivo) ?>
                </div>
            </div><div style="width: 30%">
                <div>
                PERFIL DE LOS (LAS) PARTICIPANTES: <?= esc($curso->Perfil) ?>
                </div>
            </div>
        </div><div id="fila3">
            <div style="width: 40%">
                <div>
                N° DE SESIONES:
                </div>
            </div><div style="width: 20%">
                <div>
                DURACIÓN DE LA SESIÓN: <?= esc($sesion->Duracion) ?>
                </div>
            </div><div style="width: 15%">
                <div>
                No. DE PARTICIPANTES: <?= esc($participantes->cantidad)?>
                </div>
            </div><div style="width: 25%">
                <div>
                NOMBRE DEL INSTRUCTOR(A): <?= esc($curso->Instructor) ?>
                </div>
            </div>
        </div>
        <div id="fila4">
            <div style="width: 50%">
                <div>
                LUGAR DE IMPARTICIÓN: <?= esc($curso->Lugar) ?>
                </div>
            </div><div style="width: 50%">
                <div>
                REQUERIMIENTOS DEL LUGAR: <?= esc($curso->Requerimiento) ?>
                </div>
            </div>
        </div>
    </div>

    <p style="max-width: 710;padding: 0; margin-left: 40px; font-size: 18px;">El contenido de los materiales de apoyo utilizados en la capacitación deberá estar libre de estereotipos, prejuicios; utilizando lenguaje incluyente, claro, no sexista, sin ningún tipo de discriminación y accesible para personal con discapacidad, cuando lo requiera.</p>
    
    <table class="t">
        <thead>
            
            <tr>
                <td bgcolor="#2A6896" colspan="7" ><b>PRIMERA SESIÓN</b></td>
            </tr>
            <tr>
                <td width='7%'><b>CONTENIDO (TEMAS)</b></td>
                <td width='14%'><b>OBJETIVOS DE APRENDIZAJE</b></td>
                <td width='14%'><b>TÉCNICAS DE INSTRUCCIÓN/GRUPALES</b></td>
                <td width='27%'><b>ACTIVIDADES DE ENSEÑANZA Y APREDIZAJE</b></td>
                <td width='5%'><b>DURACIÓN</b></td>
                <td width='13%'><b>ACTIVIDADES DE EVALUACIÓN</b></td>
                <td width='20%'><b>MATERIEALES DE APOYO</b></td>
            </tr>
            <tr>
                <td ><?= esc($sesion->Contenido) ?></td>
                <td ><?= esc($sesion->Objetivo) ?></td>
                <td ><?= esc($sesion->Tecnicas) ?></td>
                <td ><?= esc($sesion->Actividades) ?></td>
                <td ><?= esc($sesion->Duracion) ?></td>
                <td ><?= esc($sesion->Evaluacion) ?></td>
                <td ><?= esc($sesion->Materiales) ?></td>
            </tr>
        </thead>
    </table>


    </body>
    <footer>
        <p class="text">M00-SC-DP-020-R09 
            <span style=" padding: 0 0 0 840px; margin: 0 auto;">REV. O</span>
        </p>
        
    </footer>

</html>