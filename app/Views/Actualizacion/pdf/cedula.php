<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cedula</title>
        <style>
        header{
                position:fixed;
                top:-1cm;
                left: 0;
                width: 100%;
                right: 0;
                height: 2%;
                display: flex;
            }
        body {
                font-size: 10px;
                line-height: 15px;
                margin-top: 11%;
                margin-left: 0;
                margin-right: 0;
                margin-bottom: 2cm;
            }
        table{
            position: absolute;
            width: 100%;
        }   
        th{
            background-color: #CDCBC9 ;
        }
        .t{
            font-family: montserrat;
            font-size: 14px;
            text-transform: uppercase;
        }
        .l{
            border-top: 1px solid black;
            height: 2px;
            max-width: 200px;
            padding: 0;
            margin-left: 530px;
        }
        .prin{
            font-family: montserrat;
            font-size: 24px;
            text-transform: uppercase;
            text-align: center;
        }
        .text{
            font-family: montserrat;
            font-size: 14px;
            text-transform: uppercase;
            margin-top:1;
            margin-bottom:1;
        }
        .f{
            border-top: 1px solid black;
            height: 1px;
            max-width: 128px;
            padding: 0;
            margin-left: 600px;
        }
        .pos1{
            text-align: left;
        }
        
        .pos3{
            text-align: center;
        }
        .b{
            border-top: 1px solid black;
            height: 1px;
            max-width: 600px;
            padding: 0;
            margin-left: 130px;
        }
        .bi{
            border-top: 1px solid black;
            height: 1px;
            max-width: 460px;
            padding: 0;
            margin-left: 330px;
        }
        .bp{
            border-top: 1px solid black;
            height: 1px;
            max-width: 575px;
            padding: 0;
            margin-left: 200px;
        }
        .b1{
            border-top: 1px solid black;
            height: 1px;
            max-width: 280px;
            padding: 0;
            margin-left: 75px;
        }
        .h{
            border-top: 1px solid black;
            height: 1px;
            max-width: 470px;
            padding: 0;
            margin-left: 75px;
        }
        .b2{
            border-top: 1px solid black;
            height: 1px;
            max-width: 290px;
            padding: 0;
            margin-left: 446px;
        }
        .n{
            border-top: 1px solid black;
            height: 1px;
            max-width: 660px;
            padding: 0;
            margin-left: 70px;
        }
        .rf{
            border-top: 1px solid black;
            height: 1px;
            max-width: 300px;
            padding: 0;
            margin-left: 40px;
        }
        .cu{
            border-top: 1px solid black;
            height: 1px;
            max-width: 340px;
            padding: 0;
            margin-left: 390px;
        }
        .co{
            border-top: 1px solid black;
            height: 1px;
            max-width: 572px;
            padding: 0;
            margin-left: 157px;
        }
        .em{
            border-top: 1px solid black;
            height: 1px;
            max-width: 572px;
            padding: 0;
            margin-left: 178px;
        }
        .gr{
            border-top: 1px solid black;
            height: 1px;
            max-width: 550px;
            padding: 0;
            margin-left: 196px;
        }
        .it{
            border-top: 1px solid black;
            height: 1px;
            max-width: 470px;
            padding: 0;
            margin-left: 270px;
        }
        .gm{
            border-top: 1px solid black;
            height: 1px;
            max-width: 510px;
            padding: 0;
            margin-left: 229px;
        }
        .aa{
            border-top: 1px solid black;
            height: 1px;
            max-width: 580px;
            padding: 0;
            margin-left: 175px;
        }
        .to{
            border-top: 1px solid black;
            height: 1px;
            max-width: 400px;
            padding: 0;
            margin-left: 140px;
        }
        .e{
            border-top: 1px solid black;
            height: 1px;
            max-width: 155px;
            padding: 0;
            margin-left: 570px;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            }
        .im{
            max-width: 30%;
            height: auto;
            vertical-align: top;
            margin-top: 0;
            display: inline-block;
            margin: auto;
            margin-left: 5%;
        }
        .ima{
            max-width: 15%;
            height: auto;
            vertical-align: middle;
            padding: 0;
            margin-top: 0;
            display: inline-block;
            margin-left: 45%;
        }
        .ni1{
            display:inline-block;  
            width:390px; 
            height: auto; 
            padding:auto; 
            border-bottom: 1px solid black;
        }
        
        </style>

    </head>

    <header>
        <section>
            <img class="im" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/post_logo_educ.jpg'))?>">
            <img class="ima" src="data:image/jpg;base64,<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/TecNM_logo.png'))?>">
        </section>
    </header>
    <body>
        <p class="prin"><b>CÉDULA DE INSCRIPCIÓN<br></p>
        <p class="text " style="padding: 0 10px 0 550px; margin: 0 auto;"><b>FECHA </b>21/02/2024</p>   <div class="f"></div>    
        <br>
        <table>
            <thead>
                <tr>
                    <th class="text pos3"><b>DATOS DEL EVENTO</b></th>
                </tr>
            </thead>
        </table>
        <br>  
        <br>                                         
        <p class="text">CLAVE DE CURSO: <?= esc($curso->Clave) ?></p>
        <div class="b"></div>   
        <p class="text">NOMBRE DEL CURSO: <?= esc($curso->Nombre) ?></p>
            <div class="co"></div><br>
        <p class="text">NOMBRE DEL INSTRUCTOR(A) RESPONSABLE: <span class="ni1"><?= esc($curso->Instructor) ?></span></p>
        <!--<div class="bi"></div>-->
        <p class="text">PERIODO DE REALIZACIÓN: <?= esc($curso->Periodo) ?></p>
        <div class="bp"></div>
        <p class="text">HORARIO: <?= esc($curso->Horario) ?><span style=" position: absolute; left: 270; margin: 0 auto;">DURACIÓN: <?= esc($curso->Duracion) ?>HRS</span></p>
        <div class="b1"></div><div class="b2"></div>  
        <br>
        <table>
            <thead>
                <tr>
                    <th class="text pos3"><b>DATOS PERSONALES</b></th>
                </tr>
            </thead>
        </table>
        <br>
        <br>
        <?php foreach ($usuarios as $user): ?>
            <p class="text" style=" padding: 0 10px 0 450px; margin: 0 auto;">HOMBRE<span style=" padding: 0 10px 0 10px; margin: 0 auto;">  (   )</span><span style=" padding: 0 10px 0 10px; margin: 0 auto;">MUJER</span><span style=" padding: 0 10px 0 10px; margin: 0 auto;">  (   )</span></p><br>
            <p class="text">NOMBRE:<span style=" padding: 0 0 0 150px; margin: 0 auto;"><?= esc($user->Nombre) ?></span><span style=" padding: 0 10px 0 120px; margin: 0 auto;"><?= esc($user->Apellido) ?></span></p> 
            <div class="n"></div>
            <p class="text" style="padding: 0 10px 0 200px; margin: 0 auto;">NOMBRE(S)<span style=" padding: 0 10px 0 150px; margin: 0 auto;">APELLIDOS</span></p><br>
            
            <p class="text">R.F.C.: <?= esc($user->Rfc) ?>
                <span style=" position: absolute; left: 260; margin: 0 auto;">CURP: <?= esc($user->Curp) ?></span>
            </p>
            <div class="rf"></div><div class="cu"></div>

            <p class="text">CORREO ELECTRÓNICO: <?= esc($user->Email) ?></p>
            <div class="em"></div>
            <p class="text">GRADO MÁXIMO DE ESTUDIOS: <?= esc($user->Nivel) ?></p>
            <div class="gm"></div>
            <p class="text">NOMBRE DE LA CARRERA: <?= esc($user->Maximo) ?></p>
            <div class="gr"></div>
            <?php endforeach; ?>
        <br>
        <table>
            <thead>
                <tr>
                    <th class="text pos3"><b>DATOS LABORALES</b></th>
                </tr>
            </thead>
        </table>
        <br>
        <br>
        <p class="text" style=" padding: 0 10px 0 20px; margin: 0 auto;">DIRECTIVO<span style=" padding: 0 10px 0 10px; margin: 0 auto;">  (   )</span><span style=" padding: 0 10px 0 50px; margin: 0 auto;">APOYO A LA EDUCACIÓN O DOCENTE CON ACTIVIDADES ADMTVAS.</span><span style=" padding: 0 10px 0 5px; margin: 0 auto;">  (   )</span></p><br>
        <p class="text">INSTITUTO TECNOLÓGICO O CENTRO: INSTITUTO TECNOLÓGICO SUPERIOR DE HUATUSCO</p>
        <div class="it"></div>
        <p class="text">ÁREA DE ADSCRIPCIÓN: <?= esc($user->Departamento) ?></p>
        <div class="aa"></div>
        <p class="text">PUESTO QUE DESEMPEÑA: <?= esc($user->Cargo) ?></p>
        <div class="gr"></div>
        
        <p class="text">NOMBRE DEL JEFE INMEDIATO: Maria Ocho Croda</p>
        <div class="gm"></div>
        <p class="text">TELÉFONO OFICIAL: 273 4 4000
            <span style=" position: absolute; left: 405; margin: 0 auto;">EXT.: 223</span>
        </p>
        <div class="to"></div><div class="e"></div>
        <p class="text">HORARIO: 9:00 am - 6:00 pm</p>
        <div class="h"></div>
        <br>
        <br>
        <br>
        <div class="l"></div>
        <p class="t" style=" padding: 0 10px 0 610px; margin: 0 auto;"><b>FIRMA</b></p>
    </body>
    <footer>
        <p class="text">M00-SC-DP-020-R06 
            <span style=" margin-left: 70%;">REV. O</span>
        </p>
        
    </footer>

</html>