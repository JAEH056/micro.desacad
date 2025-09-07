<?php
namespace App\Controllers\Tutorias;

use CodeIgniter\Controller;
use App\Controllers\BaseController;

use App\Models\Tutorias\PeriodoModel;
use App\Entities\Tutorias\Periodo as PeriodoEntity;
use CodeIgniter\Exceptions\PageNotFoundException;

class Periodo extends BaseController {

    public function showPeriodos(){
        $model = model(PeriodoModel::class);

        $periodos = $model->findPeriodo();

        $data = [
            'title' => 'Periodos',
            'periodos' => $periodos,
       ];

        return view('templates/header', $data)
            . view('Tutorias/periodo/periodo_ver', $data)
            . view('templates/footer');
    }

    public function addPeriodo()
    {
        helper('form');

        $data = [
            'title' => 'Crear un nuevo periodo'
        ];
        
        if($this->request->is('get')){
            return view('templates/header', $data)
        .        view('Tutorias/periodo/periodo_crear', $data)
        .        view('templates/footer');
        }

        $post= $this->request->getPost(['Id', 'Nombre', 'Inicia', 'Termina']);

        $sonValidos = $this->validateData($post, [
            'Nombre'   => 'required|max_length[255]|min_length[3]',
            'Inicia'   => 'required|valid_date',
            'Termina'  => 'required|valid_date',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', $data)
                . view('Tutorias/periodo/periodo_crear')
                . view('templates/footer');
        }

        $model =  model(PeriodoModel::class);

        $periodo = new PeriodoEntity();
        $periodo->Nombre   = $post['Nombre'];
        $periodo->Inicia   = $post['Inicia'];
        $periodo->Termina  = $post['Termina'];

        $model->save($periodo);

        return $this->response->redirect(url_to('\\' . Periodo::class .'::showPeriodos'));

    }

    public function updatePeriodo(int $id=0){

        $model = model(PeriodoModel::class);

        $data = [
            'title'  => 'Actualiza las fechas',
            'periodo'  => $model->get($id),
        ];

        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Tutorias/periodo/periodo_editar')
		        . view('templates/footer');
        }

        $id = $this->request->getpost('Id');
        $post = $this->request->getPost(['Nombre', 'Inicia', 'Termina']);
        
        $sonValidos = $this->validateData($post, [
            'Nombre'      => 'required|numeric',
            'Inicia'      => 'required|valid_date',
            'Termina'     => ['valid_date', static function ($value, $data, &$error, $field) {
                if( empty($value) ) return true;

                $inicia =  \DateTime::createFromFormat('Y-m-d', $data['Inicia'])->getTimestamp();
                $termina = \DateTime::createFromFormat('Y-m-d', $value)->getTimestamp();

                if( $termina < $inicia){
                    $error = 'La fecha final no puede ser anterior a la fecha inicial';
                    return false;
                }
                return true;
            }],
        ]);

        if (! $sonValidos ) {
            return redirect()->back()->withInput();
        }
    
        $model->update($id, $post);
        return $this->response->redirect(url_to('\\' .Periodo::class .'::showPeriodos'));
    }
}
