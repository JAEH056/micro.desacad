<?php

namespace App\Models\Tutorias;

use CodeIgniter\Model;
use App\Entities\Tutorias\Alumno;

class AlumnoModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'alumno';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Nombre', 'Primer_Apellido', 'Segundo_Apellido', 'Curp', 'Nc', 'Sexo'];
    protected $returnType    = Alumno::class;

    public function get(int $id)
    {
        return $this->where('Id', $id)->first();
    }

    public function findAlumn()
    {
        $sql = <<<EOL
            SELECT 
                CONCAT(a.Nombre, ' ', a.Primer_Apellido, ' ', a.Segundo_Apellido) AS Nombre,
                a.Id,
                a.Nc,
                a.Curp,
                a.Sexo
            FROM alumno AS a
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(Alumno::class);
        return $rows;
    }

    public function findCarrera()
    {
        $sql = <<<EOL
            SELECT * FROM carrera
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(Alumno::class);
        return $rows;
    }

    public function findTutorados(int $id)
    {
        $sql = <<<EOL
            SELECT 
            CONCAT(a.Nombre, ' ', a.Primer_Apellido, ' ', a.Segundo_Apellido) AS Nombre,
            a.Id,
            a.Nc,
            a.Curp,
            a.Sexo
            FROM
                tutorias.tutorado AS t
                JOIN grupo AS g ON g.Id = t.Id_Grupo
                JOIN alumno AS a ON a.Id = t.Id_Alumno
            WHERE
                g.Id = $id
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(Alumno::class);
        return $rows;
    }

    public function findListaTutorados(int $id)
    {
        $sql = <<<EOL
        SELECT CONCAT(a.Nombre, ' ', a.Primer_Apellido, ' ', a.Segundo_Apellido) AS Nombre, a.Id, a.Nc, a.Curp, a.Sexo
        FROM
            tutorias.tutoria_grupal
            JOIN tutorias.tutorado AS t ON t.Id_Grupo = tutoria_grupal.Id_Grupo
            JOIN alumno AS a ON a.Id = t.Id_Alumno
            JOIN tutorias.grupo ON grupo.Id = tutoria_grupal.Id_Grupo
        WHERE tutoria_grupal.Id = $id
        EOL;

        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(Alumno::class);
        return $rows;
    }
}
