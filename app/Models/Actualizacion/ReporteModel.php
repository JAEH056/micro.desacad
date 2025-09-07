<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;

class ReporteModel extends Model
{
    protected $table         = 'reporte';
    protected $allowedFields = ['Id_Curso', 'Objetivos', 'Porcentaje_Obj', 'Comentarios_Obj', 'Expectativas', 'Porcentaje_Exp', 'Comentarios_Exp', 'Dinamica', 'Areas', 'Practicas', 'Contingencia', 'Accion', 'Ajustes', 'Evaluaciones', 'Resultado'];
    protected $returnType    = \App\Entities\Actualizacion\Reporte::class;

    public function find($id=null) {
        $sql = <<<EOL
            SELECT 
                *
            FROM
                    reporte AS r
                    JOIN curso AS c ON c.id = r.Id_Curso
            WHERE 
                c.Id = $id
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Actualizacion\Reporte::class);
        return $rows; 
    }





}