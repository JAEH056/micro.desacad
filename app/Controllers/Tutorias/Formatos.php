<?php

namespace App\Controllers\Tutorias;

use App\Controllers\BaseController;
use App\Models\Tutorias\DepartamentoModel;
use App\Models\Tutorias\TutoradoModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class Formatos extends BaseController
{
    private $tutoradoM;
    private $departamentoM;
    private $DomPDF;
    private $DomOptions;

    public function __construct()
    {
        $this->tutoradoM = new TutoradoModel();
        $this->departamentoM = new DepartamentoModel();
        $this->DomPDF = new Dompdf();
        $this->DomOptions = new Options();
    }
    public function index()
    {
        //
    }

    /**
     * Muestra el informa de tutorias (grupo de tutorados)
     * @param int $id_grupo
     * @return ResponseInterface
     */
    public function impInforme(int $id_grupo): ResponseInterface
    {
        $dompdf = $this->DomPDF;

        $actividades    = $this->tutoradoM->actividad($id_grupo);
        $tutorados      = $this->tutoradoM->informe($id_grupo);
        $grupo          = $this->tutoradoM->grupoTutoria($id_grupo);
        $participantes  = $this->tutoradoM->contParticipantes($id_grupo);
        $mujeres        = $this->tutoradoM->contMujeres($id_grupo);
        $hombres        = $this->tutoradoM->contHombres($id_grupo);

        $this->DomOptions->set('isHtml5ParserEnabled', true);
        $this->DomOptions->set('isRemoteEnabled', true);
        $data = [
            'title'         => 'INFORME',
            'actividades'     => $actividades,
            'tutorados'     => $tutorados,
            'grupo'         => $grupo,
            'participantes' => $participantes,
            'mujeres'       => $mujeres,
            'hombres'       => $hombres,
        ];
        $dompdf->loadHtml(view('Tutorias/Pdf/informe', $data));
        $dompdf->setPaper('Letter', 'landscape');
        $dompdf->render();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="Informe_Tutorias.pdf"')
            ->setBody($dompdf->output());
    }

    /**
     * Muestra el informe de seguimiento de canalizacion
     * @param int $id_canalizacion
     * @return void
     */
    public function impSeguimiento(int $id_canalizacion): ResponseInterface
    {
        $dompdf = $this->DomPDF;
        $cana       = $this->tutoradoM->seguimiento($id_canalizacion);
        $depas      = $this->departamentoM->findDepartamento();

        $this->DomOptions->set('isHtml5ParserEnabled', true);
        $this->DomOptions->set('isRemoteEnabled', true);
        $data = [
            'title'         => 'SEGUIMIENTO',
            'cana'          => $cana,
            'depas'         => $depas,
        ];
        $dompdf->loadHtml(view('Tutorias/Pdf/seguimiento', $data));
        $dompdf->setPaper('Letter', 'landscape');
        $dompdf->render();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="Informe_Seguimiento.pdf"')
            ->setBody($dompdf->output());
    }
}
