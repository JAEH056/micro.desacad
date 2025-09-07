
<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Lista</title>
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

        body{
            font-family: Montserrat;
        }
        table { border-collapse: collapse;}
        table,th,td {border: 1px solid black;}
        table   { 
            width: 100%;
            height: 2%;}
        th,td {
               }
        th{
            background-color: #CDCBC9 ;
        }
        h4 {text-align:end;}
        body {font-size: 10px;
        line-height: 15px;}

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
            margin-left: 259px;
        }
        .fd{
            border-top: 1px solid black;
            height: 2px;
            max-width: 150;
            padding: 0;
            margin-left: 732px;
        }
        .c{
            border-top: 1px solid black;
            height: 2px;
            max-width: 750;
            padding: 0;
            margin-left: 163px;
        }
        .i{
            border-top: 1px solid black;
            height: 2px;
            max-width: 710;
            padding: 0;
            margin-left: 218px;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            }
        .al{
            margin-left: 50px;
        }
        </style>

    </head>

    <header>
        <table>
            <thead>

                <tr>
                    <td height="1%" width="15%" rowspan="3" align="center"><img src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/post_logo_educ.jpg'))?>" height="100px" width="80%"></td>
                    <td height="1%" width="25%"rowspan="2" >Lista de Asistencia</td>
                    <td height="1%" width="12%"rowspan="1" class="t">Código: M00-SC-DP-020-R07</td>
                    <td height="1%" width="11%" rowspan="3" align="center"><img src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/TecNM_logo.png'))?>" height="70px" width="70%" ></td>
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
    </header>

    <body>
        <p class="text" style=" padding: 0 10px 5px 750px; margin: 0 auto;">Hoja:_______    de      _______<p>
        <p class="text" style=" padding: 0 10px 0 145px; margin: 0 auto;">CENTRO DE TRABAJO: INSTITUTO TECNOLOGICO SUPERIOR DE HUATUSCO</p>
        <div class="lt"></div>
        <p class="text"><span style=" padding: 0 10px 0 160px; margin: 0 auto;">CLAVE DEL CURSO: <?= esc($curso->Clave) ?></span> <span style="margin-left: 324px;"> FOLIO:</span></p>
        <div class="lt"></div><div class="fd"></div>
        <p class="text" style=" padding: 0 10px 0 50px; margin: 0 auto;">NOMBRE DEL CURSO: <?= esc($curso->Nombre) ?></p>
        <div class="c"></div>
        <p class="text" style=" padding: 0 10px 0 50px; margin: 0 auto;">NOMBRE(S) DEL INSTRUCTOR(A): <?= esc($curso->Instructor) ?></p>
        <div class="i"></div>
        <p class="text" style="position: absolute; max-width: 400px; min-width: 400px; height: 200px; margin-left: 205px;">PERIODO: <?= esc($curso->Periodo) ?>    <span style="position: absolute; min-width: 100px; height: 200px; margin-left: 250px;">DURACIÓN: <?= esc($curso->Duracion) ?>hrs</span></p>
        <br><div class="lt"></div><div class="fd"></div>
        <p class="text"style=" padding: 0 10px 0 205px; margin: 0 auto;">HORARIO: <?= esc($curso->Horario) ?></p>
        <div class="lt"></div><br>

    <table>
        <thead>
            <tr>
                <th rowspan="3" width='3%'>No.</td>
                <th rowspan="3" width='24%'>NOMBRE DEL PARTICIPANTE</td>
                <th rowspan="3" width='10%'>R.F.C.</td>
                <th rowspan="3" width='24%'>ÁREA DE ADSCRIPCIÓN</td>
                <th rowspan="3" width='3%'>SEXO H/M</td>
                <th rowspan="3" width='3%'>D/A</td>
                <th rowspan="1" colspan="5" width='35%'>ASISTENCIA</td>
            <tr>
                <th rowspan="1" colspan="1">15</th>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
            </tr>
            <tr>
                <th rowspan="1" colspan="1" class="t">L</th>
                <th rowspan="1" colspan="1" class="t">M</th>
                <th rowspan="1" colspan="1" class="t">M</th>
                <th rowspan="1" colspan="1" class="t">J</th>
                <th rowspan="1" colspan="1" class="t">V</th>
            </tr>
            <?php $contador = 1; ?>
            <?php foreach ($usuarios as $user): ?>
            <tr>
                <td rowspan="1" colspan="1" class="t"><?= $contador ?></td>
                <td rowspan="1" colspan="1"><?= esc($user->Nombre) ?></td>
                <td rowspan="1" colspan="1"><?= esc($user->Rfc) ?></td>
                <td rowspan="1" colspan="1"><?= esc($user->Departamento) ?></td>
                <td rowspan="1" colspan="1"><?= esc($user->Sexo) ?></td>
                <td rowspan="1" colspan="1"><?= esc($user->DA) ?></td>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1"></th>
            </tr>
            <?php $contador++;?>
            <?php endforeach; ?>
        </thead>
    </table>
        <p style=" padding: 0 10px 0 0px; margin: 0 auto">H = Hombre     <span style=" padding: 0 10px 0 30px; margin: 0 auto;">M = Mujer </span></p>
        <p style=" padding: 0 10px 0 0px; margin: 0 auto">D = Directivos <span style=" padding: 0 5px 0 23px; margin: 0 auto;">A = Apoyo a la Educación </span></p>
        </body>
        <footer>
            <div class="l"></div><div class="l2"></div>
            <p style=" padding: 0 10px 0 60px; margin: 0 auto;">NOMBRE Y FIRMA DEL INSTRUCTOR(A)   <span style=" padding: 0 10px 0 450px; margin: 0 auto;">NOMBRE Y FIRMA DEL COORDINADOR(A)</span></p>
            <br>
            <p>M00-SC-DP-020-R07</p>
        </footer>

</html>
