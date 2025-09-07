<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Reporte</title>


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
            table { border-collapse: collapse;}
            table,th,td {border: 1px solid black;}
            table   {
                width: 100%;
                height: 2%;
            }
            th{
                background-color: #EBE7E7;
            }

            .tb{
                border: 0;
            }
            h4 {text-align:end;}
            body {
                font-size: 10px;
                line-height: 15px;
                margin-top: 12%;
                margin-left: 0;
                margin-right: 0;
                margin-bottom: 2cm;
            }
            .t{
                text-align: center;
                font-size: 12px;
                margin-top:1;
                margin-bottom:1;
            }
            .text{
                font-family: montserrat;
                font-size: 10px;
                text-transform: uppercase;
                margin-top:1;
                margin-bottom:1;
            }
            .te{
            text-align: center;
            }
            .hth{
                height:3%;
            }
            .htd{
                height:2%;
            }
            .o{
                height:4%;
            }
            .hra{
                height: 20%;
            }
            .tdt{
                height: 10%;
            }
            .w{
                width:20%
            }
            .wid{
                width:60%
            }
            .g{
                height: 40%
            }
            .page_break 
            { 
                page-break-before: always; 
            }
        </style>

    </head>

    <header>
        <table>
            <thead>
                <tr>
                    <td width="15%" rowspan="3" >
                        <img src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/post_logo_educ.jpg')) ?>" height="100px" width="100%" />
                    </td>
                    <td width="55%"rowspan="2">Reporte Final</td>
                    <td width="20%"rowspan="1"><b>Código:</b> M00-SC-DP-020-R11</td>
                </tr>
                <tr>
                    <td rowspan="1"><b>Revisión: 0</b></td>
                </tr>
                <tr>
                    <td rowspan="1"><b>Referencia a la Norma ISO 9001:2015 y la NMX-R-025-SCFI-2015</b></td>
                    <td rowspan="1"><b>Página 1 de 3</div></b></td>
                </tr>
            </thead>
        </table>
    </header>

    <body>
        <div>
            <br>
            <table>
                <thead>
                    <tr>
                        <th class="t hth" colspan="7">DATOS GENERALES</th>
                    </tr>
                    <tr>
                        <td class="t hth" width='20%'colspan="2">Nombre del Instructor(a)</td>
                        <td colspan="5"><?= esc($curso->Instructor) ?></td>
                    </tr>
                    <tr>
                        <td class="t htd" colspan="2">Curso</td>
                        <td colspan="5"><?= esc($curso->Nombre) ?></td>
                    </tr>
                    <tr>
                        <td class="t htd" width="" colspan="2">Perfil del Participante</td>
                        <td class="ht"width='35%' colspan="1"><?= esc($curso->Perfil) ?></td>
                        <th class="hth" width='12%' colspan="3">Total de Participantes:</th>
                        <td class="htd" width='33%' colspan="1"><?= esc($participantes->cantidad)?></td>
                    </tr>
                    <tr>
                        <td class="t thd" colspan="2">Lugar(es)</td>
                        <td colspan="5"><?= esc($curso->Lugar) ?></td>
                    </tr>
                    <tr>
                        <td class="t thd" colspan="2">Fecha(s)</td>
                        <td colspan="5"><?= esc($curso->Periodo) ?></td>
                    </tr>
                    <tr>
                        <td class="t thd" colspan="2">Horario(s)</td>
                        <td colspan="1"><?= esc($curso->Horario) ?></td>
                        <th colspan="3"></th>
                        <td colspan="1"></td>
                    </tr>
                    <tr>
                        <td class="t hth" colspan="2">Material de apoyo</td>
                        <td colspan="5"><?= esc($curso->Requerimiento) ?></td>
                    </tr>
                    <tr>
                        <td class="t hth" colspan="2">Objetivo del curso</td>
                        <td colspan="5"><?= esc($curso->Objetivo)?></td>
                    </tr>
                    <tr>
                        <td class="t hth" colspan="7">RESULTADOS ALCANZADOS</td>
                    </tr>
                    <tr class="t hth">
                        <th colspan="1">No.</th>
                        <th colspan="3">Objetivos</th>
                        <th colspan="1">%</th>
                        <th colspan="2">Comentarios</th>
                    </tr>
                    <tr>
                        <td class="hra te" colspan="1">1</td>
                        <td class="hra te" colspan="3"><?= esc($reporte->Objetivos) ?></td>
                        <td class="hra te" colspan="1"><?= esc($reporte->Porcentaje_Obj) ?></td>
                        <td class="hra te" colspan="2"><?= esc($reporte->Comentarios_Obj) ?></td>
                    </tr>
                    <tr class="t htd">
                        <th colspan="1">No.</th>
                        <th colspan="3">Expectativas</th>
                        <th colspan="1">%</th>
                        <th colspan="2">Comentarios</th>
                    </tr>
                    <tr>
                        <td class="hra te" colspan="1">2</td>
                        <td class="hra te" colspan="3"><?= esc($reporte->Expectativas) ?></td>
                        <td class="hra te" colspan="1"><?= esc($reporte->Porcentaje_Exp) ?></td>
                        <td class="hra te" colspan="2"><?= esc($reporte->Comentarios_Exp) ?></td>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="page_break">
        <br>
            <table>
                <thead>
                    <tr>
                        <th class="t hth" colspan="2">RECUPERACIÓN DE EXPERIENCIAS</th>
                    </tr>
                    <tr>
                        <th class="t o" colspan="2">COMENTARIOS SOBRE LA DINÁMICA DEL GRUPO</th>
                    </tr>
                    <tr>
                        <td class="t tdt" colspan="2"><?= esc($reporte->Dinamica) ?></td>
                    </tr>
                    <tr>
                        <th class="t hth" colspan="1">ÁREAS DE OPORTUNIDAD DEL INSTRUCTOR(A)</th>
                        <th class="t hth" colspan="1">MEJORES PRÁCTICAS DEL INSTRUCTOR(A)</th>
                    </tr>
                    <tr>
                        <td class="t hth" colspan="1"><?= esc($reporte->Areas) ?></td>
                        <td class="t hth" colspan="1"><?= esc($reporte->Practicas) ?></td>
                    </tr>
                    <tr>
                        <td class="t hth" colspan="1"></td>
                        <td class="t hth" colspan="1"></td>
                    </tr>
                </thead>
            </table>
        <br>
            <table>
                <thead>
                    <tr>
                        <th class="t o" colspan="2">CONTINGENCIAS</th>
                    </tr>
                    <tr>
                        <td class="t o" colspan="1">CONTINGENCIA</td>
                        <td class="t o" colspan="1">ACCIÓN CORRECTIVA</td>
                    </tr>
                    <tr>
                        <td class="t o" colspan="1"><?= esc($reporte->Contingencia) ?></td>
                        <td class="t o" colspan="1"><?= esc($reporte->Accion) ?></td>
                    </tr>
                    <tr>
                        <td class="t o w" colspan="1"></td>
                        <td class="t o wid" colspan="1"></td>
                    </tr>
                </thead>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th class="t o">AJUSTES AL PROGRAMA DE TRABAJO</th>
                    </tr>
                    <tr>
                        <td class="t hra"><?= esc($reporte->Ajustes) ?></td>
                    </tr>
                </thead>
            </table>


        </div>
        <div class="page_break">
            <br>
            <table>
                <thead>
                    <tr>
                        <th class="t o">RESULTADO DE LAS EVALUACIONES APLICADAS A LOS/LAS PARTICIPANTES DURANTE EL DESARROLLO DEL CURSO</th>
                    </tr>
                    <tr>
                        <td class="t hra"><?= esc($reporte->Evaluaciones) ?></td>
                    </tr>
                </thead>
            </table>
            <br><br>
            <table>
                <thead>
                    <tr>
                        <th class="t o" colspan="">RESULTADOS FINALES CONFORME A LA ATENCIÓN BRINDADA A LOS REQUERIMIENTOS DEL USUARIO SOLICITANTE</th>
                    </tr>
                    <tr>
                        <td class="t g" colspan="1"><?= esc($reporte->Resultado) ?></td>
                    </tr>
                </thead>
            </table>
        </div>
    </body>
        
        
</html>
