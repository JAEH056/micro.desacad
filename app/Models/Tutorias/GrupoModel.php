<?php
namespace App\Models\Tutorias;

use CodeIgniter\Model;

class GrupoModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'grupo';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Periodo', 'Id_Tutor', 'Id_Programa', 'Nombre', 'Fecha', 'Semestre'];
    protected $returnType    = \App\Entities\Tutorias\Grupo::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }

}