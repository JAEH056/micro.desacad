<?php
namespace App\Models\Tutorias;

use CodeIgniter\Model;

class DepartamentoModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'departamento';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Nombre'];
    protected $returnType    = \App\Entities\Tutorias\Departamento::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }
   
    public function findDepartamento(){
        $sql = <<<EOL
            SELECT * FROM departamento
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Departamento::class);
        return $rows;
    }
}