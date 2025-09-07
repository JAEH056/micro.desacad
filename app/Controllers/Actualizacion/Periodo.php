<?php
namespace App\Controllers\Actualizacion;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Actualizacion\PeriodoModel;
use App\Entities\Actualizacion\Periodo as PeriodoEntity;
use CodeIgniter\Exceptions\PageNotFoundException;

class Periodo extends BaseController {

    public function show(int $id)
    {
        $model = model(PeriodoModel::class);

        $periodo = $model->find($id);

        if ( empty($periodo) ) {
            throw new PageNotFoundException('No encontré el periodo ' . $id);
        }

        $data = [
            'title' => 'Detalles del periodo ' . $periodo->Nombre,
            'periodo' => $periodo,
        ];
        
        return view('templates/header', $data)
            . view('Actualizacion/periodo/periodo_show', $data)
            . view('templates/footer');
    }
    public function showAll()
    {
        $model = model(PeriodoModel::class);

        $periodos = $model->findAll();

        $data = [
            'title' => 'Lista de periodos',
            'periodos' => $periodos,
        ];
        
        return view('templates/header', $data)
            . view('Actualizacion/periodo/periodos_lista', $data)
            . view('templates/footer');
    }

    public function create() {
        helper('form');
 
        $data = [
            'title' => 'Crear un nuevo periodo'
        ];
        
        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Actualizacion/periodo/periodo_crear')
		        . view('templates/footer');
        }
         
        $post = $this->request->getPost(['Nombre', 'Inicia', 'Termina']);
        
        $sonValidos = $this->validateData($post, [
            'Nombre'  => 'required|max_length[255]|min_length[3]',
            'Inicia'  => 'required|valid_date',
            'Termina' => ['valid_date', static function ($value, $data, &$error, $field) {
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
		    return view('templates/header', $data)
                . view('Actualizacion/periodo/periodo_crear')
                . view('templates/footer');
        }
        
        $model =  model(PeriodoModel::class);
        
        $periodo = new PeriodoEntity();
        $periodo->Nombre = $post['Nombre'];
        $periodo->Inicia = $post['Inicia'];
        $periodo->Termina = $post['Termina'];

        $model->save($periodo);
       
        return $this->response->redirect(url_to('\\' . Periodo::class .'::showAll'));

    }

    public function update(int $id=0)
    {
        $model = model(PeriodoModel::class);

        $data = [
            'title'  => 'Actualiza el periodo',
            'periodo' => $model->get($id),
        ];

        if($this->request->is('get')) {
            return view('templates/header', $data)
		        . view('Actualizacion/periodo/periodo_editar')
		        . view('templates/footer');
        }

        $id = $this->request->getpost('Id');
        $post = $this->request->getPost(['Nombre', 'Inicia', 'Termina']);
        
        $sonValidos = $this->validateData($post, [
            'Nombre'  => 'required|max_length[255]|min_length[3]',
            'Inicia'  => 'required|valid_date',
            'Termina' => ['valid_date', static function ($value, $data, &$error, $field) {
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
        return $this->response->redirect(url_to('\\' . Periodo::class .'::showAll'));
    }
    
    public function delete(int $id)
	{
        $model = model(PeriodoModel::class);
        $model->delete($id);

        return $this->response->redirect(url_to('\\' . Periodo::class .'::showAll'));
    }
}
?>