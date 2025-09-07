<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;

class InscripcionModel extends Model
{
    protected $table         = 'inscripcion';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Curso', 'Id_Usuario', 'Cuando', 'Acreditado'];
    protected $returnType    = \App\Entities\Actualizacion\Inscripcion::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }

    


}