<?php
namespace App\Models\Tutorias;

use CodeIgniter\Model;

class TutorModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'tutor';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Usuario', 'Inicia', 'Termina'];
    protected $returnType    = \App\Entities\Tutorias\Tutor::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }
    
    public function findUsuarios(){
    $sql = <<<EOL
        SELECT
        u.Id AS Id_Usuario,
        CONCAT(u.Nombre, " ", u.Primer_Apellido, " ", u.Segundo_Apellido) AS Nombre
        FROM
                Desarrollo.usuario AS u
            JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
            JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
        LEFT JOIN tutor AS t ON t.Id_Usuario = u.Id
        WHERE
            (o.Cargo_H = 'Docente' OR o.Cargo_M = 'Docente')
            AND (t.Id_Usuario IS NULL OR t.Termina <= CURDATE())  
        EOL;
        $query = $this->db->query($sql);
    $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
    return $rows;
    }

    public function findTutores(){
        $sql = <<<EOL
            SELECT
            u.Id AS Id_Usuario,
            concat( u.Nombre, " ", u.Primer_Apellido, " ", u.Segundo_Apellido) AS Nombre,
            o.Nombre AS Puesto,
            t.Inicia,
            t.Termina,
            t.Id
            FROM 
                    Desarrollo.usuario AS u 
                JOIN tutor AS t ON t.Id_Usuario = u.Id
                JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
                JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
            WHERE
                o.Cargo_H = 'Docente'
                OR
                o.Cargo_M = 'Docente'  
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows;
    }
    
}
