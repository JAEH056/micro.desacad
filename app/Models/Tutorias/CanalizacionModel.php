<?php
namespace App\Models\Tutorias;

use CodeIgniter\Model;

class CanalizacionModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'canalizacion';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Departamento', 'Id_Tutoria', 'Fecha', 'Diagnostico', 'Actividades'];
    protected $returnType    = \App\Entities\Tutorias\Canalizacion::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }
   
    public function findDepartamento(){
        $sql = <<<EOL
            SELECT * FROM departamento
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;
    }
}