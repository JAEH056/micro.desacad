
<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Plan de sesión</title>
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
            font-family: Montserrat-Black.ttf;
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
            /*position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;*/

            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

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
            /background-color: blue;/
        }
    </style>

    </head>

    <header>
        <table  position: absolute>
            <thead>
                
                <tr>
                    <td width="15%" rowspan="3" ><img src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/post_logo_educ.jpg'))?>" height="100px" width="100%"></td>
                    <td width="45%"rowspan="2"><b>Plan de Sesión</b></td>
                    <td width="15%"rowspan="1"><b>Código:</b> M00-SC-DP-020-R10</td>
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
    <p class="prin"><b>PLAN DE SESIÓN</p>
    
    <div id="cont">
        <div id="fila1">
            <div style="width: 55%">
                <div>
                NOMBRE DEL CURSO DE CAPACITACIÓN:<?= esc($curso->Nombre) ?>
                </div>
            </div><div style="width: 15%">
                <div>
                FECHA DE IMPARTICIÓN:  <?= esc($curso->Periodo) ?>
                </div>
            </div><div style="width: 30%">
                <div>
                NOMBRE DEL INSTRUCTOR(A):<?= esc($curso->Instructor) ?>
                </div>
            </div>
        </div>
        <div id="fila2">
            <div style="width: 50%">
                <div>
                TEMA DE LA SESIÓN:<?= esc($secu->Tema) ?>
                </div>
            </div><div style="width: 50%">
                <div>
                OBJETIVO PARTICULAR:<?= esc($secu->Objetivo) ?>
                </div>
            </div>
        </div><div id="fila3">
            <div style="width: 28%">
                <div>
                N° DE SESIÓN: 1
                </div>
            </div><div style="width: 27%">
                <div>
                No. DE PARTICIPANTES: <?= esc($participantes->cantidad)?>
                </div>
            </div><div style="width: 45%">
                <div>
                PERFIL DE LOS/LAS PARTICIPANTES:<?= esc($curso->Perfil) ?>
                </div>
            </div>
        </div>
        <div id="fila4">
            <div style="width: 28%">
                <div>
                DURACIÓN DE LA SESIÓN:<?= esc($secu->Horas) ?>
                </div>
            </div><div style="width: 27%">
                <div>
                LUGAR DE IMPARTICIÓN:<?= esc($curso->Lugar) ?>
                </div>
            </div><div style="width: 45%">
                <div>
                REQUERIMIENTO DEL LUGAR:<?= esc($curso->Requerimiento) ?>
                </div>
            </div>
        </div>
    </div>

    <p style="max-width: 710;padding: 0; margin-left: 0px; font-size: 16px;">El contenido de los materiales de apoyo utilizados en la capacitación deberá estar libre de estereotipos, prejuicios; utilizando lenguaje incluyente, claro, no sexista, sin ningún tipo de discriminación y accesible para personal con discapacidad, cuando lo requiera.</p>
    <br>

    <table class="t">
        <thead>
        <?php $Nombre = '' ?>
            <?php foreach ($secuencia as $sec): ?>
                <?php if($Nombre != $sec->Nombre): ?>
                <?php $Nombre = $sec->Nombre ?>
                <tr bgcolor="#B8E097">
                    <td width='7%'><b>(TEMAS Y/O SUBTEMAS)</b></td>
                    <td width='14%'><b>OBJETIVOS ESPECIFICOS</b></td>
                    <td width='14%'><b>TÉCNICAS GRUPALES</b></td>
                    <td width='27%'><b>ACTIVIDADES DE ENSEÑANZA Y APREDIZAJE</b></td>
                    <td width='5%'><b>DURACIÓN</b></td>
                    <td width='13%'><b>ACTIVIDADES DE EVALUACIÓN</b></td>
                    <td width='20%'><b>MATERIEALES DE APOYO</b></td>
                </tr>
            
                <tr>
                    <td bgcolor="#B8E097" colspan="7"><i><b><?= esc($sec->Nombre) ?></b></i></td>
                </tr>
                <?php endif ?>
                <tr>
                    <td ><?= esc($sec->Temas) ?></td>
                    <td ><?= esc($sec->Objetivos) ?></td>
                    <td ><?= esc($sec->Tecnicas) ?></td>
                    <td ><?= esc($sec->Actividades) ?></td>
                    <td ><?= esc($sec->Duracion) ?></td>
                    <td ><?= esc($sec->Evaluacion) ?></td>
                    <td ><?= esc($sec->Materiales) ?></td>
                </tr>
            <?php endforeach;?>
        </thead>
    </table>


    </body>
    <footer>
        <p class="text">M00-SC-DP-020-R09 
            <span style=" padding: 0 0 0 840px; margin: 0 auto;">REV. O</span>
        </p>
        
    </footer>

</html>