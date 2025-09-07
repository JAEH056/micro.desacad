<?php
namespace App\Models\Tutorias;

use CodeIgniter\Model;

class PeriodoModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'periodo_escolar';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Nombre', 'Inicia', 'Termina'];
    protected $returnType    = \App\Entities\Tutorias\Periodo::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }
    
    public function findPeriodo(){
        $sql = <<<EOL
            SELECT * FROM periodo_escolar
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Alumno::class);
        return $rows;
    }
}
