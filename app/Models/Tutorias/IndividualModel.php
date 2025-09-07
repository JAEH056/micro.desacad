<?php
namespace App\Models\Tutorias;

use CodeIgniter\Model;

class IndividualModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'tutoria_individual';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Tutorado', 'Horas', 'Fecha'];
    protected $returnType    = \App\Entities\Tutorias\Individual::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }

    public function tutoradosSelect(int $id_usuario){
        $sql = <<<EOL
            SELECT 
            concat( a.Nombre, " ", a.Primer_Apellido, " ", a.Segundo_Apellido) AS Alumno,
            t.Id AS Id_Tutorado
            FROM 
                    tutorado AS t
                JOIN alumno AS a ON a.Id = t.Id_Alumno
                JOIN grupo AS g ON g.Id = t.Id_Grupo
                JOIN tutor AS tu ON tu.Id = g.Id_Tutor
                JOIN Desarrollo.usuario AS u ON u.Id = tu.Id_Usuario
                JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
            WHERE
                u.Id = $id_usuario
                AND IF(pe.Termina IS NOT NULL, pe.termina >= NOW(), TRUE)
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
}