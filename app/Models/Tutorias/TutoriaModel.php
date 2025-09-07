<?php
namespace App\Models\Tutorias;

use CodeIgniter\Model;

class TutoriaModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'tutoria_grupal';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Grupo', 'Id_Actividades', 'Horas', 'Fecha'];
    protected $returnType    = \App\Entities\Tutorias\Tutoria::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }

    public function findTutoria(int $id){
        $sql = <<<EOL
            SELECT * FROM tutoria_grupal AS tg 
            WHERE tg.Id = $id
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows;
    }

    public function guardarTutorados(int $id_tutoria, array $alumnos, string $fecha ){
        $this->db;
        $data = [];
        foreach($alumnos as $alumno) {
            $data[] = [
                'Id_Tutorado' => $alumno,
                'Id_Tutoria'  => $id_tutoria,
                'Fecha'       => $fecha,
            ];
        }
        //var_dump($data);
        //die;
        if (!empty($data)) {
            $builder = $this->db->table('asistencia');
            $builder->insertBatch($data);
        }    
    }

    public function guardarAcreditados(array $alumnos, string $fecha ){
        $this->db;
        $data = [];
        foreach($alumnos as $alumno) {
            $data[] = [
                'Id_Tutorado' => $alumno,
                'Fecha'       => $fecha,
            ];
        }
        //var_dump($data);
        //die;
        if (!empty($data)) {
            $builder = $this->db->table('acreditado');
            $builder->insertBatch($data);
        }    
    }

    public function findTutorias(int $id_grupo){
        $sql = <<<EOL
            SELECT 
                tg.Id AS Id_Tutoria,
                g.Id AS Id_Grupo,
                t.Id AS Id_Tutor,
                tg.Id_Actividades,
                ac.Descripcion,
                tg.Horas,
                tg.Fecha
            FROM 
                    Desarrollo.usuario AS u
                JOIN tutor AS t ON t.Id_Usuario = u.Id
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN tutoria_grupal AS tg ON tg.Id_Grupo = g.Id
                JOIN actividades AS ac ON ac.Id = tg.Id_Actividades
                JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
                
            WHERE
                g.Id = $id_grupo

                AND IF(pe.Termina IS NOT NULL, pe.termina >= NOW(), TRUE) 
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function showTutorias(int $idGrupo){
        $sql = <<<EOL
            SELECT 
            g.Id AS Id_Grupo,
            tg.Id,
            tg.Horas,
            tg.Fecha,
            a.Descripcion AS Actividades
            FROM
                    grupo AS g
                JOIN tutoria_grupal AS tg ON tg.Id_Grupo = g.Id
                JOIN actividades AS a ON a.Id = tg.Id_Actividades
            WHERE
                tg.Id_Grupo = $idGrupo
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
    public function showGrupo(int $id){
        $sql = <<<EOL
            SELECT
            g.Id AS Id_Grupo
            FROM
                tutorias.grupo AS g
            WHERE
                g.Id = $id
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutoria::class);
        return $rows;
    }
    public function tutoriaGrupal(int $id){
        $sql = <<<EOL
            SELECT
            tg.Id AS Id_Tutoria
            FROM
                tutorias.tutoria_grupal AS tg
            WHERE
                tg.Id = $id
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutoria::class);
        return $rows;
    }
}