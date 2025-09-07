<?php
namespace App\Models\Tutorias;

use CodeIgniter\Model;

class ActividadModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'actividades';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Descripcion'];
    protected $returnType    = \App\Entities\Tutorias\Actividad::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }
    public function findActividad(){
        $sql = <<<EOL
            SELECT * FROM actividades
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Actividad::class);
        return $rows; 
   }
}


    
   