<?php
require(__DIR__ . '/vendor/autolad.php');

use App\Models\Actualizacion\CursoModel;
use App\Models\Actualizacion\PeriodoModel;
use App\Models\Actualizacion\ImparteModel;
use App\Models\Actualizacion\UsuarioModel;


$pdf = new Pdf();
$pdf->usarLogo(__DIR__ . '/assets/img/TecNM_logo.png');
$pdf->usarLogo(__DIR__ . 'assets/img/post_logo_educ.jpg');

$empleados = new Empleado();
$empleado = $empleados->detalles(  );
$gerente  = $pdf->gerenteArea();
$gerenteSis = $pdf->gerenteArea();
$recursos = $pdf->gerenteArea();

$equipo = new Equipo;
$equipos = $equipo->equiposPuestoEmpleado();
//var_dump($equipos); die;

$gabinete = $equipos[0];
$gabinete['atributos'] = $equipo->listaAtributos(); 



$pdf->encabezado();
$pdf->encabezadoFecha(new \DateTime());

$pdf->cuerpo();
$pdf->generar();
//$pdf->prueba(1);
