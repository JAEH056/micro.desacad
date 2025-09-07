<?php
namespace App\Models\Tutorias;

use CodeIgniter\Model;
use App\Entities\Tutorias\Tutorado as TutoradoEntity;


class TutoradoModel extends Model
{
    protected $DBGroup       = 'tutorias';  // <<<--Usar otra BD---->>>
    protected $table         = 'tutorado';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Alumno', 'Id_Grupo', 'Fecha'];
    protected $returnType    = \App\Entities\Tutorias\Tutorado::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }
   

    public function guardarTutorados(int $id_grupo, array $alumnos){
        $this->db;
        $data = [];
        foreach($alumnos as $alumno) {
            $data[] = [
                'Id_Alumno'   => $alumno,
                'Id_Grupo'    => $id_grupo,
            ];
        }
        if (!empty($data)) {
            $builder = $this->db->table('tutorado');
            $builder->insertBatch($data);
        }    
    }
    public function showTutorados(){
        $sql = "SELECT * FROM tutorado";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function findTutor() {
        $sql = <<<EOL
            SELECT
            t.Id,   
            g.Id AS Id_Grupo,       
            concat( u.Nombre, " ", u.Primer_Apellido, " ", u.Segundo_Apellido) AS Tutor,
            u.Curp,
            u.Email,
            t.Inicia,
            g.Semestre,
            g.Nombre,
            pre.Nombre AS Carrera,
            pe.Nombre AS Periodo
            FROM
                    tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN programa_educativo AS pre ON pre.Id = g.Id_Programa
                JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
     
    public function findTutorado(int $idGrupo){
        $sql = <<<EOL
            SELECT
                t.Id,
                concat( u.Nombre, " ", u.Primer_Apellido, " ", u.Segundo_Apellido) AS Tutor,
                concat( a.Nombre, " ", a.Primer_Apellido, " ", a.Segundo_Apellido) AS Alumno,
                a.Curp,
                a.Nc,
                g.Id AS Id_Grupo,
                pro.Nombre AS Carrera 
            FROM
                        tutor AS t                     
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
                JOIN alumno AS a ON a.Id = tt.Id_Alumno
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario  
                JOIN periodo_escolar AS pes ON pes.Id = g.Id_Periodo
                JOIN programa_educativo AS pro ON pro.Id = g.Id_Programa
                                
            WHERE
                g.Id = $idGrupo
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function tutoradosIndividuales(int $id, int $idGrupo){
        $sql = <<<EOL
        SELECT 
            a.Id AS Id_Alumno,
            a.Nc,
            concat( a.Nombre, " ", a.Primer_Apellido, " ", a.Segundo_Apellido) AS Alumno,
            t.Id AS Id_Tutor,
            g.Id AS Id_Grupo,
            ti.Id AS Id_Tutoria
        FROM 
                tutor AS t
            JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
            JOIN grupo AS g ON g.Id_Tutor = t.Id
            JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
            JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
            JOIN alumno AS a ON a.Id = tt.Id_Alumno
            RIGHT JOIN tutoria_individual AS ti ON ti.Id_Tutorado = tt.Id
            
        WHERE
            t.Id = $id
            AND 
            g.Id = $idGrupo
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function tutoradosTutoria(int $idAlumno, int $idGrupo){
        $sql = <<<EOL
        SELECT
        ti.Id AS Id_Tutoria
        FROM
                tutor AS t
            JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
            JOIN grupo AS g ON g.Id_Tutor = t.Id
            JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
            JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
            JOIN alumno AS a ON a.Id = tt.Id_Alumno
            RIGHT JOIN tutoria_individual AS ti ON ti.Id_Tutorado = tt.Id 
        WHERE
            a.Id = $idAlumno
            AND 
            g.Id = $idGrupo
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function dataTutor(int $id){
        $sql = <<<EOL
            SELECT
            concat( u.Nombre, " ", u.Primer_Apellido, " ", u.Segundo_Apellido) AS Tutor,
            u.Curp,
            u.Email,
            o.Nombre AS Puesto
            FROM
                    Desarrollo.usuario AS u
                JOIN tutorias.tutor AS t ON t.Id_Usuario = u.Id
                JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
                JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
            WHERE
                t.Id = $id
                AND IF(up.Termina IS NOT NULL, up.termina >= NOW(), TRUE);
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function showTutoria(int $id){
        $sql = <<<EOL
        SELECT 
            tg.Id
        FROM
                usuario AS u
            JOIN tutor AS t ON t.Id_Usuario = u.Id
            jOIN grupo AS g ON g.Id_ Tutor = t.Id
            JOIN tutoria_grupal AS tg ON tg.Id_Grupo = g.Id
        WHERE
            u.Id = $id
            AND IF(pe.Termina IS NOT NULL, pe.termina >= NOW(), TRUE) 
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
    public function findTutorados(int $id){
        $sql = <<<EOL
            SELECT 
                a.Id AS Id_Alumno,
                concat( a.Nombre, " ", a.Primer_Apellido, " ", a.Segundo_Apellido) AS Alumno,
                t.Id AS Id_Tutor,
                a.Nc,
                pre.Nombre AS Carrera,
                g.Id AS Id_Grupo
            FROM 
                    tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
                JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
                JOIN alumno AS a ON a.Id = tt.Id_Alumno
                JOIN programa_educativo AS pre ON pre.Id = g.Id_Programa
                
            WHERE
                u.Id = $id
                AND IF(pe.Termina IS NOT NULL, pe.termina >= NOW(), TRUE) 
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
    public function userGrupo(int $id){
        $sql = <<<EOL
            SELECT 
                g.Id AS Id_Grupo
            FROM 
                    tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
                JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
                JOIN alumno AS a ON a.Id = tt.Id_Alumno
                JOIN programa_educativo AS pre ON pre.Id = g.Id_Programa
                
            WHERE
                u.Id = $id
                AND IF(pe.Termina IS NOT NULL, pe.termina >= NOW(), TRUE) 
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
        }
    public function findIndividual(int $id_usuario){
        $sql = <<<EOL
            SELECT 
                a.Id AS Id_Alumno,
                concat( a.Nombre, " ", a.Primer_Apellido, " ", a.Segundo_Apellido) AS Alumno,
                a.Nc,
                t.Id AS Id_Tutor,
                g.Id AS Id_Grupo,
                ti.Id AS Id_Tutoria
            FROM 
                    tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
                JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
                JOIN alumno AS a ON a.Id = tt.Id_Alumno
                RIGHT JOIN tutoria_individual AS ti ON ti.Id_Tutorado = tt.Id
            WHERE
                u.Id = $id_usuario
                AND IF(pe.Termina IS NOT NULL, pe.termina >= NOW(), TRUE);
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function findCanalizacion(int $idTutor, int $idGrupo){
        $sql = <<<EOL
            SELECT
            a.Nc,
            g.Id AS idGrupo,
            concat( a.Nombre, " ", a.Primer_Apellido, " ", a.Segundo_Apellido) AS Alumno,
            a.Id AS idAlumno,
            u.Id AS idTutor
            FROM
                tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
                JOIN alumno AS a ON a.Id = tt.Id_Alumno
                JOIN tutoria_individual AS ti ON ti.Id_Tutorado = tt.Id
                
            WHERE
                t.Id = $idTutor
            AND
                g.Id = $idGrupo
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function tutoria(int $idAlumno, int $idGrupo){
        $sql = <<<EOL
        SELECT
        ti.Id AS Id_Tutoria,
        a.Id AS Id_Alumno,
        g.Id AS Id_Grupo
        FROM
            tutor AS t
            JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
            JOIN grupo AS g ON g.Id_Tutor = t.Id
            JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
            JOIN alumno AS a ON a.Id = tt.Id_Alumno
            JOIN tutoria_individual AS ti ON ti.Id_Tutorado = tt.Id
            
        WHERE
            a.Id = $idAlumno
        AND
            g.Id = $idGrupo
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
    public function canalizacionAlumno(int $idAlumno, int $idGrupo){
        $sql = <<<EOL
                SELECT 
                g.Id AS Id_Grupo,
                a.Id AS Id_Alumno,
                concat( a.Nombre, " ", a.Primer_Apellido, " ", a.Segundo_Apellido) AS Alumno,
                d.Id AS Id_Departamento,
                d.Nombre AS Departamento,
                ca.Diagnostico,
                ca.Actividades,
                ca.Fecha,
                ca.Id,
                ti.Id AS Id_Tutoria
            FROM 
                    tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
                JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
                JOIN alumno AS a ON a.Id = tt.Id_Alumno
                RIGHT JOIN tutoria_individual AS ti ON ti.Id_Tutorado = tt.Id
                JOIN canalizacion AS ca ON ca.Id_Tutoria = ti.Id
                JOIN departamento AS d ON d.Id = ca.Id_Departamento
                
            WHERE
                a.Id = $idAlumno
            AND
                g.Id = $idGrupo
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function findTutores(){
        $sql = <<<EOL
            SELECT 
            concat( u.Nombre, " ", u.Primer_Apellido, " ", u.Segundo_Apellido) AS Tutor,
            t.Id
            FROM 
                    tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows;
    }

    public function findEducativo(){
        $sql = <<<EOL
            SELECT * FROM programa_educativo
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows;
    }

    public function showGrupo(int $idTutor, int $idGrupo){
        $sql = <<<EOL
            SELECT 
            g.Id AS Id_Grupo
            FROM
                    tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN tutorado AS tt ON tt.Id_Grupo = g.Id
                JOIN alumno AS a ON a.Id = tt.Id_Alumno
                JOIN tutoria_individual AS ti ON ti.Id_Tutorado = tt.Id
                    
            WHERE
                t.Id = $idTutor
            AND
                g.Id = $idGrupo
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function grupoId(int $idGrupo){
        $sql = <<<EOL
            SELECT 
            g.Id AS Id_Grupo
            FROM
                grupo AS g                  
            WHERE
                g.Id = $idGrupo
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function seguimiento(int $id_canalizacion){
        $sql = <<<EOL
            SELECT
                concat( u.Nombre, " ", u.Primer_Apellido, " ", u.Segundo_Apellido) AS Tutor,
                concat( a.Nombre, " ", a.Primer_Apellido, " ", a.Segundo_Apellido) AS Alumno,
                a.Nc,
                pe.Nombre,
                c.Diagnostico,
                c.Actividades,
                c.Fecha, 
                c.Id_Departamento,
                p.Nombre AS Periodo
            FROM
                    tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN programa_educativo AS pe ON pe.Id = g.Id_Programa
                JOIN tutorado AS tu ON tu.Id_Grupo = g.Id
                JOIN alumno AS a ON a.Id = tu.Id_Alumno
                JOIN tutoria_individual AS ti ON ti.Id_Tutorado = tu.Id
                JOIN canalizacion AS c ON c.Id_Tutoria = ti.Id
                JOIN periodo_escolar AS p ON p.Id = g.Id_Periodo                
            WHERE
                c.Id = $id_canalizacion
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }

    public function grupoAlum(int $id){
        $sql = <<<EOL
            SELECT 
            g.Id AS Id_Grupo
            FROM
                    grupo AS g
                JOIN tutor AS tu ON tu.Id = g.Id_Tutor
                JOIN Desarrollo.usuario AS u ON u.Id = tu.Id_Usuario
                JOIN periodo_escolar AS pe ON pe.Id = g.Id_Periodo
            WHERE
                u.Id = $id
                AND IF(pe.Termina IS NOT NULL, pe.termina >= NOW(), TRUE)
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
    public function grupoTutoria(int $id){
        $sql = <<<EOL
            SELECT
                concat( u.Nombre, " ", u.Primer_Apellido, " ", u.Segundo_Apellido) AS Tutor,
                pe.Nombre,
                p.Nombre AS Periodo
            FROM
                    tutor AS t
                JOIN Desarrollo.usuario AS u ON u.Id = t.Id_Usuario
                JOIN grupo AS g ON g.Id_Tutor = t.Id
                JOIN programa_educativo AS pe ON pe.Id = g.Id_Programa
                JOIN periodo_escolar AS p ON p.Id = g.Id_Periodo
            WHERE
                g.Id = $id
            EOL;
    $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
    public function actividad(int $id){
        $sql = <<<EOL
            SELECT 
            a.Descripcion
            FROM 
                    grupo AS g
                JOIN tutoria_grupal AS tg ON tg.Id_Grupo = g.Id
                JOIN actividades AS a ON a.Id = tg.Id_Actividades
            WHERE
                g.Id = $id
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows;
    }
    public function informe(int $id){
        $sql = <<<EOL
            SELECT 
            concat( a.Nombre, " ", a.Primer_Apellido, " ", a.Segundo_Apellido) AS Alumno,
            a.Nc,
            pe.Nombre,
            g.Semestre,
            SUM(ti.Horas) AS Horas_Individual,
            SUM(tg.Horas) AS Horas_Grupal
            #GROUP_CONCAT(d.Nombre) AS Departamento
            FROM
                    tutorado AS tu
                JOIN alumno AS a ON a.Id = tu.Id_Alumno
                JOIN grupo AS g ON g.Id = tu.Id_Grupo
                JOIN programa_educativo AS pe ON pe.Id = g.Id_Programa
                LEFT JOIN tutoria_grupal AS tg ON tg.Id_Grupo = g.Id
                JOIN actividades AS ac ON ac.Id = tg.Id_Actividades
                LEFT JOIN tutoria_individual AS ti ON ti.Id_Tutorado = tu.Id
                #JOIN canalizacion AS c ON c.Id_Tutoria = ti.Id
                #JOIN departamento AS d ON d.Id = c.Id_Departamento
            WHERE
                g.Id = $id
            GROUP BY tu.Id
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows;
    }
    public function contParticipantes(int $id){
        $sql = <<<EOL
            SELECT COUNT(*) AS cantidad FROM tutorado AS t WHERE t.Id_Grupo = $id
            EOL;
    $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
    public function contHombres(int $id){
        $sql = <<<EOL
            SELECT 
            COUNT(*) AS cantidad 
            FROM 
                    tutorado AS t 
                JOIN alumno AS a ON a.Id = t.Id_Alumno 
            WHERE t.Id_Grupo =$id AND a.Sexo = 'H'
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
        return $rows; 
    }
    public function contMujeres(int $id){
        $sql = <<<EOL
        SELECT COUNT(*) AS cantidad FROM tutorado AS t
        JOIN alumno AS a ON a.Id = t.Id_Alumno
        WHERE t.Id_Grupo =$id AND a.Sexo = 'M'
        EOL;
    $query = $this->db->query($sql);
    $rows = $query->getRow(1, \App\Entities\Tutorias\Tutorado::class);
    return $rows; 
    }

    public function findGrupo(int $id){
        $sql = <<<EOL
        SELECT 
        g.Id,
        g.Nombre,
        g.Semestre,
        pe.Nombre AS Periodo,
        p.Nombre AS Carrera
        FROM
                Desarrollo.usuario AS u
            JOIN tutorias.tutor AS t ON t.Id_Usuario = u.Id
            JOIN tutorias.grupo AS g ON g.Id_Tutor = t.Id
            JOIN tutorias.periodo_escolar AS pe ON pe.Id = g.Id_Periodo
            JOIN tutorias.programa_educativo AS p ON p.Id =g.Id_Programa
        WHERE
            u.Id = $id  
            AND IF(pe.Termina IS NOT NULL, pe.termina >= NOW(), TRUE)
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows;
    }

    public function showAsistencia(int $id){
        $sql = <<<EOL

        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Tutorias\Tutorado::class);
        return $rows;
    }
}


    
   