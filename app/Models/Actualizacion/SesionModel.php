<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;

class SesionModel extends Model
{
    protected $table         = 'sesion';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Curso', 'Sesiones', 'Contenido', 'Objetivo', 'Tecnicas', 'Actividades', 'Evaluacion', 'Materiales', 'Fecha', 'Duracion'];
    protected $returnType    = \App\Entities\Actualizacion\Sesion::class;

    public function find($id=null) {
        $sql = <<<EOL
            SELECT
                s.Duracion,
                s.Contenido,
                s.Objetivo,
                s.Tecnicas,
                s.Actividades,
                s.Evaluacion,
                s.Materiales,
                s.Tema
            FROM
                    sesion AS s
                JOIN curso AS c ON c.Id = s.Id_Curso
            WHERE
                c.Id = $id
            EOL;
             $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Actualizacion\Sesion::class);
        return $rows; 
    }
    public function sesionId($id=null) {
        $sql = <<<EOL
            SELECT
                s.Duracion,
                s.Contenido,
                s.Objetivo,
                s.Tecnicas,
                s.Actividades,
                s.Evaluacion,
                s.Materiales,
                s.Tema,
                s.Id
            FROM
                    sesion AS s
                JOIN curso AS c ON c.Id = s.Id_Curso
            WHERE
                s.Id = $id
            EOL;
             $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Actualizacion\Sesion::class);
        return $rows; 
    }

}