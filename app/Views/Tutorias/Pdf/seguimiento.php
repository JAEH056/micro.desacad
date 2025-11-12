<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Seguimiento</title>
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
            table { border-collapse: collapse;}
            table,th,td {border: 1px solid black;}
            table { 
                width: 100%;
                height: 2%;
            }
            th,td{
                font-family: montserrat;
                font-size: 14px;
            }
            .l{
                border-top: 1px solid black;
                height: 2px;
                max-width: 250px;
                padding: 0;
                margin-left: 735px;
            }
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
            }
            .txt{
                text-align: center;
                line-height: 0%;
                font-family: montserrat;
            }
            .b{
                border: 0;
                border:none;
            }
            .b1{
                border-top: solid 1px;
                border-right: solid 0px;
                border-bottom: solid 0px;
                border-left: solid 1px;
            }
            .b2{
                border-top: solid 0px;
                border-right: solid 0px;
                border-bottom: solid 0px;
                border-left: solid 1px;
            }
            .b3{
                border-top: solid 0px;
                border-right: solid 0px;
                border-bottom: solid 1px;
                border-left: solid 1px;
            }
            .bo1{
                border-right: solid 0px;
            }
            .bo2{
                border-left: solid 0px;
            }
            #fila1>div {
            display: inline-block;
            }
            #fila1>div>div {
                border-top: solid 1px;
                border-right: solid 1px;
                border-bottom: solid 1px;
                border-left: solid 1px;
                height: 40px;
            }
            .tam{
                text-align: center;
                margin-left:auto;margin-right:auto;
                width: 70%;
                text-align: center;
                
            }
            .pos{
                /*margin-left:auto;margin-right:auto;*/
                text-align: center;
                width: 100%;

            }
        </style>

    </head>

    <header>
        <img src="data:image/png;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/logo_ITSH.png'))?>" height="8%" width="7%" margin-left= "20%">
        <p class="txt"><b>INSTITUTO TECNOLÓGICO SUPERIOR DE HUATUSCO</b></p>
        <p class="txt"><b>DEPARTAMENTO DE DESARROLLO ACADÉMICO</b></p>
        <p class="txt">PROGRAMA INSTITUCIONAL DE TUTORÍA</p>
        <p class="txt"><b>SEGUIMIENTO A DEBILIDADES O PROBLEMAS DESTACADOS</b></p>
    </header>
    <body>
        <p class="pos"><b>Periodo:</b> <u><?= esc($cana->Periodo)?></u> <span> <b>Fecha de canalización:</b><u><?= esc($cana->Fecha)?></u></span></p>
        <table>
            <thead>
                <tr>
                    <td class="bo1" width='50%' rowspan="1" colspan="3"><b>Nombre de tutor/a o docente que canaliza:</b> <?= esc($cana->Tutor)?></td>
                </tr>
                <tr>
                    <td class="bo1" width='50%' rowspan="1" colspan="3"><b>Nombre del/la estudiantes:</b> <?= esc($cana->Alumno)?></td>
                </tr>
                <tr>
                    <td class="b" width='6.5cm' rowspan="1" colspan="1"><b>Número de control:</b> <?= esc($cana->Nc)?></td>
                    <td class="b" width='11.5cm' rowspan="1" colspan="1"><b>Carrera:</b> <?= esc($cana->Nombre)?></td>
                    <td class="b" width='5.5cm' rowspan="1" colspan="1"><b>Canalización Número:___</b></td>
                </tr>
            </thead>
        </table>
        <br>
        <table>
            <thead>
                <tr>
                    <th width='6.5cm' rowspan="1" colspan="1">Diagnostico: Debilidades del/la tutorado/a o problema detectado.</th>
                    <th width='9.5cm' rowspan="1" colspan="1">Departamento al que se canaliza en caso de ser necesario</th>
                    <th width='8.5cm' rowspan="1" colspan="1">Actividades desarrolladas por el departamento o instancia al que se canalizó</th>
                </tr>
                <tr>
                    <td rowspan="1" colspan="1"><?= esc($cana->Diagnostico)?></td>
                    <td rowspan="1" colspan="1">
                        <?php foreach($depas as $d): ?>
                            (<?= ($cana->Id_Departamento == $d->Id) ? "X" : "&nbsp;&nbsp;   " ?>)
                            <?= esc($d->Nombre)?><br>
                        <?php endforeach ?>
                    </td>
                    <td rowspan="1" colspan="1"><?= esc($cana->Actividades)?></td>
                </tr>
            </thead>
        </table>
        
        <p><b></b>
        <p style=" padding: 0 10px 0 50px; margin: 0 auto;"><b>Departamento o Instancia que atendió la problemática<span style=" padding: 0 10px 0 250px; margin: 0 auto;">Firma del / la estudiante</b></span></p>
        <p style=" padding: 0 10px 0 150px; margin: 0 auto;"><b>(Nombre y sello)</b></p>
        <br>
        <p style=" padding: 0 10px 0 50px; margin: 0 auto;">_______________________________________________<span style=" padding: 0 10px 0 150px; margin: 0 auto;">______________________________________________</span></p>
        <br>
        <p style=" padding: 0 10px 0 100px;"><b>Firma del tutor(a) o docente que canaliza:</b>____________________________________________</p>
        <br>

        <table class="tam">
            <thead>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="4"><b>Elaboró:</b></td>
                    <td colspan="3"><b>Revisó:</b></td>
                    <td colspan="3"><b>Autorizó:</b></td>
                </tr>
                <tr>
                    <td colspan="3"><b>Puesto</b></td>
                    <td colspan="4"><b>Coordinación de tutorías</b></td>
                    <td colspan="3"><b>Controlador(a) de documentos</b></td>
                    <td colspan="3"><b>Subdirección Académica</b></td>
                </tr>
                <tr>
                    <td colspan="3"><b>Fecha</b></td>
                    <td colspan="4"><b>16 de junio de 2022</b></td>
                    <td colspan="3"><b>17 de junio de 2022</b></td>
                    <td colspan="3"><b>17 de junio de 2022</b></td>
                </tr>
            </thead>
        </table>          
    </body>
    <footer>
        
        <p style="padding: 0 0 0 10px;">R00/0622 
            <span style=" padding: 0 0 0 800px; margin: 0 auto;">F-DA-14</span>
        </p>
        
    </footer>

</html>