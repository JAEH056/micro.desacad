<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;

class SecuenciaModel extends Model
{
    protected $table         = 'secuencia';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Sesion', 'Id_Fase', 'Temas', 'Objetivos', 'Tecnicas', 'Actividades', 'Duracion', 'Evaluacion', 'Materiales'];
    protected $returnType    = \App\Entities\Actualizacion\Secuencia::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }
    public function find($id=null) {
        $sql = <<<EOL
            SELECT
                se.Temas,
                se.Objetivos,
                se.Tecnicas,
                se.Actividades,
                se.Evaluacion,
                se.Materiales,
                se.Duracion,
                s.Tema,
                s.Duracion AS Horas,
                s.Objetivo,
                f.Nombre,
                f.Id
            FROM
                    curso AS c
                JOIN sesion AS s ON s.Id_curso = c.Id
                JOIN secuencia AS se ON se.Id_Sesion = s.Id
                JOIN fase AS f ON f.Id = se.Id_Fase
            WHERE
                c.Id = $id
            ORDER BY
                f.Id, se.Id, s.Id
            EOL;
            $query = $this->db->query($sql);
            $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Secuencia::class);
        return $rows; 
    }

    public function findTema($id=null) {
        $sql = <<<EOL
            SELECT
                se.Temas,
                se.Objetivos,
                se.Tecnicas,
                se.Actividades,
                se.Evaluacion,
                se.Materiales,
                se.Duracion,
                s.Tema,
                s.Duracion AS Horas,
                s.Objetivo,
                f.Nombre,
                f.Id
            FROM
                    curso AS c
                JOIN sesion AS s ON s.Id_curso = c.Id
                JOIN secuencia AS se ON se.Id_Sesion = s.Id
                JOIN fase AS f ON f.Id = se.Id_Fase
            WHERE
                c.Id = $id
            EOL;
            $query = $this->db->query($sql);
            $rows = $query->getRow(1,\App\Entities\Actualizacion\Secuencia::class);
        return $rows; 
    }
}
?>