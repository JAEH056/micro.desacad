<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Informe</title>
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
            table,th,td {
                border: 1px solid black;
                
            }
            th{
                font-family: montserrat;
                font-size: 12px;
            }
            td{
                font-family: montserrat;
                font-size: 12px;
            }
            table { 
                width: 100%;
                height: 2%;
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
                font-family: montserrat;
                text-align: center;
                line-height: 0%;
            }
            .ob{
                font-family: montserrat;
                font-size: 12px;
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
                align: center;
                margin-left:auto;margin-right:auto;
                width: 70%;
                text-align: center;
                
            }
            .e{
                width: 30%;
            }
            .pos{
                text-align: center;
                font-family: montserrat;
                font-size: 13px;
                margin-left:auto;margin-right:auto;
                width: 100%;
            }
        </style>

    </head>

    <header>
        <img src="data:image/png;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/assets/img/LogoITSH.png'))?>" height="8%" width="7%" margin-left= "20%">
        <p class="txt"><b>INSTITUTO TECNOLÓGICO SUPERIOR DE HUATUSCO</b></p>
        <p class="txt"><b>DEPARTAMENTO DE DESARROLLO ACADÉMICO</b></p>
        <p class="txt">PROGRAMA INSTITUCIONAL DE TUTORÍA</p>
        <p class="txt"><b>INFORME DE SEGUIMIENTO Y RESULTADO FINAL DE LA ACCIÓN TUTORIAL</b></p>
    </header>
    <body>
    <?php 
    $fecha = date("d-F-Y");  ?>
        <p class="pos"><b>Periodo:</b> <u><?= esc($grupo->Periodo)?></u> <span> <b>Fecha de entrega:</b><u><?php echo " $fecha" . "\n"; ?></u></span></p>
        <table>
            <thead>
                <tr>
                    <td class="bo1" width='50%' rowspan="1" colspan="1"><b>Nombre del/la tutor/a:</b> <?= esc($grupo->Tutor)?></td>
                    <td class="bo2" width='50%' rowspan="1" colspan="1"><b>Carrera:</b> <?= esc($grupo->Nombre)?></td>
                </tr>
            </thead>
        </table>
        <br>
        <table>
            <thead>
                <tr>
                    <th width='1cm' rowspan="2" colspan="1">No.</th>
                    <th width='2cm' rowspan="2" colspan="1">No. Control</th>
                    <th width='5cm' rowspan="2" colspan="1">Nombre del/la tutorado/a</th>
                    <th width='2cm' rowspan="2" colspan="1">Semestre / grupo</th>
                    <th width='3cm' rowspan="2" colspan="1">Actividades Realizadas</th>
                    <th width='2cm' rowspan="1" colspan="2">Horas Grupal / Individual</th>
                    <th width='8cm' rowspan="2" colspan="1">Áreas de canalizadas y Actividades Desarrolladas.</th>
                    <th width='2cm' rowspan="1" colspan="2">Semestre Acreditado</th>
                </tr>
                <tr>
                    <th rowspan="1" colspan="1">G</th>
                    <th rowspan="1" colspan="1">I</th>
                    <th rowspan="1" colspan="1">SI</th>
                    <th rowspan="1" colspan="1">NO</th>
                </tr>
                <?php $contador = 1; ?>
                <?php foreach ($tutorados as $tuto): ?>
                <tr>
                
                    <td rowspan="1" colspan="1"><?= $contador ?></td>
                    <td rowspan="1" colspan="1"><?= esc($tuto->Nc)?></td>
                    <td rowspan="1" colspan="1"><?= esc($tuto->Alumno)?></td>
                    <td rowspan="1" colspan="1"><?= esc($tuto->Semestre)?></td>
                    <td rowspan="1" colspan="1">y</td>
                    <td rowspan="1" colspan="1">t</td>
                    <td rowspan="1" colspan="1">r</td>
                    <td rowspan="1" colspan="1">h</td>
                    <td rowspan="1" colspan="1">y</td>
                    <td rowspan="1" colspan="1">t</td>
                
                </tr>
                <?php $contador++;?>
                <?php endforeach; ?>
                
            </thead>
        </table>
        <table>
            <thead>
                <tr>
                    <td class="b1" width='5cm' colspan="3">1.-<?= esc(empty($actividades[0]) ? ' ' : $actividades[0]->Descripcion)?></td>
                    <td class="b1" width='5cm' colspan="4">2.-<?= esc(empty($actividades[1]) ? ' ' : $actividades[1]->Descripcion)?></td>
                    <td class="b1" width='5cm' colspan="3">3.-<?= esc(empty($actividades[2]) ? ' ' : $actividades[2]->Descripcion)?></td>
                </tr>
                <tr>
                    <td class="b2" width='5cm' colspan="3">4.-<?= esc(empty($actividades[3]) ? ' ' : $actividades[3]->Descripcion)?></td>
                    <td class="b2" width='5cm' colspan="4">5.-<?= esc(empty($actividades[4]) ? ' ' : $actividades[4]->Descripcion)?></td>
                    <td class="b2" width='5cm' colspan="3">6.-<?= esc(empty($actividades[5]) ? ' ' : $actividades[5]->Descripcion)?></td>
                </tr>
                <tr>
                    <td class="b3" width='5cm' colspan="3">7.-<?= esc(empty($actividades[6]) ? ' ' : $actividades[6]->Descripcion)?></td>
                    <td class="b3" width='5cm' colspan="4">8.-<?= esc(empty($actividades[7]) ? ' ' : $actividades[7]->Descripcion)?></td>
                    <td class="b3" width='5cm' colspan="3">9.-<?= esc(empty($actividades[8]) ? ' ' : $actividades[8]->Descripcion)?></td>
                </tr>
            </thead>
        </table>        
        <table>
            <thead>    
                <tr >
                    <td class="b" width='8cm'>
                        <b>Tutorados asignados:</b>
                       
                    </td>
                    <td class="b" width='10.3cm'>
                        <b>Tutorados/as acreditados/as:</b>
                        <u></u>
                    </td>
                    <td class="b" width='6.2cm'>
                        <b>Horas Grupales:</b>
                        <u></u>
                    </td>
                </tr>
                <tr>
                    <td class="b" width='8cm'>
                        <b>Total:</b>
                        <u><?= esc($participantes->cantidad)?></u>
                        <b>Hombres:</b>
                        <u><?= esc($hombres->cantidad)?></u>
                        <b>Mujeres:</b>
                        <u><?= esc($mujeres->cantidad)?></u>
                    </td>
                    <td class="b" width='10.3cm'>
                        <b>Tutorados/as No acreditados/as:</b>
                        <u></u>
                    </td>
                    <td class="b" width='6.2cm'>
                        <b>Horas Individuales:</b>
                        <u></u>
                    </td>
                </tr>
            </thead>
        </table>
        <div id="cont">
            <div id="fila1">
                <div style="width: 100%">
                    <div class="ob">
                    OBSERVACIONES:
                    </div>
                </div>
            </div>
        </div>
        <br>
        <p style=" padding: 0 10px 0 600px;" class="ob"><b>Firma del/la tutor/a:</b>__________________________</p>
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