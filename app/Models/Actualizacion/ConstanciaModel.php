<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;

class ConstanciaModel extends Model
{
    protected $table         = 'constancias';
    protected $allowedFields = [
        'Id_Inscripcion', 'Registro', 'Fecha', 'Consecutivo', 'Anio'
    ];
    protected $returnType    = \App\Entities\Actualizacion\Curso::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }



}
