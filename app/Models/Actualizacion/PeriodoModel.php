<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;

class PeriodoModel extends Model
{
    protected $table         = 'periodo_curso';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Nombre', 'Inicia', 'Termina'];
    protected $returnType    = \App\Entities\Actualizacion\Periodo::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }
    
    public function findAll(int $limit = 0, int $offset = 0) {
        $sql = <<<EOL
            SELECT p.*,
                COUNT(c.Id) = 0 AS Puede_Borrar
            FROM
                periodo_curso AS p
            LEFT JOIN curso AS c ON c.Id_Periodo = p.Id
            GROUP BY p.Id 
            EOL;
        
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Periodo::class);
        return $rows;
    } 
    
    public function findActuales() {
        $sql = <<<EOL
            Select *
            From 
                periodo_curso AS pc 
            where 
                (Termina is null or Termina >= now())
            EOL;      
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Periodo::class);
        return $rows;
    }
    
}

?>