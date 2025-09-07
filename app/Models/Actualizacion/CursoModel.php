<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;

class CursoModel extends Model
{
    protected $table         = 'curso';
    protected $primaryKey    = 'Id';
    protected $allowedFields = [
        'Id', 'Id_Periodo', 'Capacidad', 'Nombre', 'Inicia', 'Termina',
        'Objetivo', 'Lugar', 'Requerimiento', 'Perfil', 'Duracion',
        'Horario', 'Clave', 'Folio', 'Bloqueado', 'Concluido',
    ];
    protected $returnType    = \App\Entities\Actualizacion\Curso::class;

    public function get(int $id) {
        return $this->where('Id', $id)->first();
    }
    
    public function find($id=null) {
        $sql = <<<EOL
            SELECT 
                GROUP_CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido SEPARATOR ', ') AS Instructor,
                c.Id,
                c.Clave,
                c.Capacidad,
                c.Nombre,
                c.Objetivo, 
                c.Lugar, 
                c.Requerimiento, 
                c.Perfil, 
                c.Bloqueado,
                c.Duracion, 
                c.Horario, 
                c.Folio,
                pc.Nombre AS Periodo
            FROM
                    imparte_curso AS ic
                    JOIN Desarrollo.usuario AS u on u.id = ic.Id_Usuario
                RIGHT JOIN curso AS c on c.id = ic.Id_Curso
                    JOIN periodo_curso AS pc on pc.Id = c.Id_Periodo
            WHERE 
                c.Id = $id
            GROUP BY
                c.Id, pc.Id
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Actualizacion\Curso::class);
        return $rows; 
    }
    
    public function findAll(int $limit = null, int $offset = 0){
        $sqllimit = ($limit>0)? "LIMIT $limit, $offset" : '';
        $sql = <<<EOL
            SELECT 
                GROUP_CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido SEPARATOR '|') AS Instructor,
                c.Id,
                c.Clave,
                c.Nombre,
                c.Objetivo, 
                c.Lugar, 
                c.Requerimiento, 
                c.Perfil, 
                c.Duracion, 
                c.Horario, 
                c.Bloqueado,
                c.Folio,
                pc.Nombre AS Periodo
            FROM           imparte_curso AS ic
                      JOIN Desarrollo.usuario AS u on u.Id = ic.Id_Usuario
                RIGHT JOIN curso AS c on c.Id = ic.Id_Curso
                      JOIN periodo_curso AS pc on pc.Id = c.Id_Periodo
            GROUP BY
                c.Id, pc.Id
            $sqllimit
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows; 
    }

    public function enrrolledUsers(int $id_curso){
        $sql = <<<EOL
            SELECT 
                c.Nombre AS Curso,
                substring_index(group_concat(g.Siglas ORDER BY g.Id DESC), ',', 1) AS Grado,
                CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre,
                i.Id,
                IF(u.sexo = 'M', o.Cargo_M, o.Cargo_H) AS Cargo,
                o.Nombre AS NCargo,
                u.Rfc,
                u.Sexo,
                IF(o.Izq >= 2 AND o.Der <= 41, 'ACADEMICA', 'ADMINISTRATIVA') AS Departamento,
                IF (up.Id_Organigrama IN(1,2,15,13,3,16,20,24), 'D', 'A') AS DA,
                e.Id IS NOT NULL AS encuesta
            FROM
                    usuario AS u
                JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
                JOIN Desarrollo.grado AS g ON u.Id = g.Id_Usuario
                JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
                JOIN inscripcion AS i ON i.Id_Usuario = u.Id
                JOIN curso AS c ON c.Id = i.Id_Curso
                LEFT JOIN encuesta AS e ON e.Id_Inscripcion = i.Id
            WHERE 
                c.Id = $id_curso
            AND IF(up.Termina IS NOT NULL, up.termina >= NOW(), TRUE)
            GROUP BY
                u.Id, up.Id_Usuario, up.Id_Organigrama, o.Id, e.Id
            EOL; 
    $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;    
    }   
    
    public function cursosActuales(int $id_usuario) {
        $sql = <<<EOL
            SELECT
            GROUP_CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido SEPARATOR ', ') AS Instructor,
                c.Id,
                c.Clave,
                c.Nombre,
                c.Objetivo, 
                c.Lugar, 
                c.Requerimiento, 
                c.Perfil, 
                c.Duracion, 
                c.Horario, 
                c.Folio,
                p.Nombre AS Periodo 
            FROM (((curso AS c JOIN periodo_curso AS p ON p.Id = c.Id_Periodo)
                JOIN imparte_curso AS ic ON ic.Id_Curso = c.Id)
                JOIN Desarrollo.usuario AS u ON u.Id = ic.Id_Usuario)
            WHERE c.Inicia > NOW()
            GROUP BY c.Id, ic.Id_Curso
            EXCEPT
            SELECT
            GROUP_CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido SEPARATOR ', ') AS Instructor,
                c.Id,
                c.Clave,
                c.Nombre,
                c.Objetivo, 
                c.Lugar, 
                c.Requerimiento, 
                c.Perfil, 
                c.Duracion, 
                c.Horario, 
                c.Folio,
                p.Nombre AS Periodo  
            FROM ((((curso AS c JOIN inscripcion AS i ON c.Id = i.Id_Curso)
                JOIN periodo_curso AS p ON p.Id = c.Id_Periodo)
                JOIN imparte_curso AS ic ON ic.Id_Curso = c.Id)
                JOIN Desarrollo.usuario AS u ON u.Id = ic.Id_Usuario)
            WHERE i.Id_Usuario = $id_usuario
            GROUP BY c.Id, p.Id, ic.Id_Curso
            EOL;      
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Periodo::class);
        return $rows;
    }
    
    public function misCursos(int $id_usuario){
        $sql = <<<EOL
            SELECT
            c.Nombre AS Curso,
            u.Id,
            i.Id AS Id_Inscripcion,
            c.Objetivo
            FROM
                    inscripcion AS i
                JOIN Desarrollo.usuario AS u ON u.Id = i.Id_Usuario
                JOIN curso AS c ON c.Id = i.Id_Curso
            WHERE
            u.Id = $id_usuario
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;  
    }

    public function findFase(){
        $sql = <<<EOL
            SELECT * FROM fase
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;
    }

    
    public function findCurso($id=null) {
        $sql = <<<EOL
            SELECT 
                GROUP_CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido SEPARATOR ', ') AS Instructor,
                c.Id,
                c.Clave,
                c.Nombre,
                c.Objetivo, 
                c.Lugar, 
                c.Requerimiento, 
                c.Perfil, 
                c.Duracion, 
                c.Horario, 
                c.Folio,
                pc.Nombre AS Periodo
            FROM
                    imparte_curso AS ic
                    JOIN Desarrollo.usuario AS u on u.id = ic.Id_Usuario
                RIGHT JOIN curso AS c on c.id = ic.Id_Curso
                    JOIN inscripcion AS i ON i.Id_Curso = c.Id
                    JOIN periodo_curso AS pc on pc.Id = c.Id_Periodo
            WHERE 
                i.Id = $id
            GROUP BY
                c.Id, pc.Id
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Actualizacion\Curso::class);
        return $rows; 
    }
    public function constanciaUser(int $id_inscripcion){
        $sql = <<<EOL
            SELECT 
                c.Nombre AS Curso,
                substring_index(group_concat(g.Siglas ORDER BY g.Id DESC), ',', 1) AS Grado,
                CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre,
                i.Id,
                IF(u.sexo = 'M', o.Cargo_M, o.Cargo_H) AS Cargo,
                u.Rfc,
                u.Sexo
            FROM
                    usuario AS u
                JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
                JOIN Desarrollo.grado AS g ON u.Id = g.Id_Usuario
                JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
                JOIN inscripcion AS i ON i.Id_Usuario = u.Id
                JOIN curso AS c ON c.Id = i.Id_Curso
            WHERE 
                i.Id = $id_inscripcion
            AND IF(up.Termina IS NOT NULL, up.termina >= NOW(), TRUE)
            GROUP BY
                u.Id, up.Id_Usuario, up.Id_Organigrama, o.Id;
            EOL; 
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;   
    } 
    public function constancias(int $id_curso){
        $sql = <<<EOL
            SELECT 
                c.Id,
                c.Clave,
                c.Nombre,
                c.Duracion, 
                c.Horario, 
                c.Folio,
                c.Termina,
                co.Consecutivo,
                co.Anio,
                i.id,
                substring_index(group_concat(g.Siglas ORDER BY g.Id DESC), ',', 1) AS Grado,
                u.Id,
                CONCAT(u.Nombre, " ", u.Primer_Apellido, " ", u.Segundo_Apellido) AS Usuario
            FROM
                    curso AS c
                JOIN inscripcion AS i ON i.Id_Curso = c.Id
                JOIN constancias AS co ON co.Id_Inscripcion = i.Id
                JOIN usuario AS u ON i.Id_Usuario = u.Id
                JOIN grado AS g ON u.Id = g.Id_Usuario
                JOIN periodo_curso AS p ON c.Id_periodo = p.Id
            WHERE
                c.Id = $id_curso
            GROUP BY
                c.Id,i.Id,u.Id
            EOL;
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;
    }
    /*public function constanciaAlumn(int $id_usuario){
        $sql = <<<EOL
            SELECT 
                c.Nombre AS Curso,
                substring_index(group_concat(g.Siglas ORDER BY g.Id DESC), ',', 1) AS Grado,
                CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre,
                i.Id,
                IF(u.sexo = 'M', o.Cargo_M, o.Cargo_H) AS Cargo,
                u.Rfc,
                u.Sexo
            FROM
                    usuario AS u
                JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
                JOIN Desarrollo.grado AS g ON u.Id = g.Id_Usuario
                JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
                JOIN inscripcion AS i ON i.Id_Usuario = u.Id
                JOIN curso AS c ON c.Id = i.Id_Curso
            WHERE 
                i.Id = $id_inscripcion
            AND IF(up.Termina IS NOT NULL, up.termina >= NOW(), TRUE)
            GROUP BY
                u.Id, up.Id_Usuario, up.Id_Organigrama, o.Id;
            EOL; 
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;   
    } */
    public function imparUsuario(int $id_usuario){
        $sql = <<<EOL
            SELECT 
            CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre,
            c.Nombre AS Curso,
            u.Id,
            c.Id,
            c.Objetivo,
            c.Concluido
            FROM
                    imparte_curso AS ic
                JOIN Desarrollo.usuario AS u ON u.Id = ic.Id_Usuario
                JOIN curso AS c ON c.Id = ic.Id_Curso
            WHERE u.Id = $id_usuario
            EOL; 
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;
    }
    /*public function cursosInstructor(int $id_usuario, int $id_curso){
        $sql = <<<EOL
            SELECT 
                c.Nombre AS Curso,
                substring_index(group_concat(g.Siglas ORDER BY g.Id DESC), ',', 1) AS Grado,
                CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre,
                i.Id,
                IF(u.sexo = 'M', o.Cargo_M, o.Cargo_H) AS Cargo,
                u.Rfc,
                u.Sexo
            FROM
                    usuario AS u
                JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
                JOIN Desarrollo.grado AS g ON u.Id = g.Id_Usuario
                JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
                JOIN inscripcion AS i ON i.Id_Usuario = u.Id
                JOIN curso AS c ON c.Id = i.Id_Curso
            WHERE 
                i.Id = $id_inscripcion
            AND IF(up.Termina IS NOT NULL, up.termina >= NOW(), TRUE)
            GROUP BY
                u.Id, up.Id_Usuario, up.Id_Organigrama, o.Id;
            EOL; 
            $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;   
    } */
    public function resultEncuesta(int $id_curso, int $id_usuario){
        $sqlEncuesta = <<<EOL
            SELECT
                c.Nombre AS Curso,
                e.Fecha,
                e.Comentarios,
                '' AS Respuestas
            FROM
                inscripcion AS i
                JOIN Desarrollo.usuario AS u ON u.Id = i.Id_Usuario
                JOIN curso AS c ON c.Id = i.Id_Curso
                JOIN encuesta AS e ON e.Id_Inscripcion = i.Id
            WHERE c.Id = $id_curso
              AND u.Id = $id_usuario
            EOL;
       
        
        $sqlRespuestas = <<<EOL
            SELECT
                ep.Id,
                ep.Pregunta,
                ep.Seccion, 
                er.Respuesta
            FROM
                    inscripcion AS i
                JOIN encuesta AS e ON e.Id_Inscripcion = i.Id
                JOIN encuesta_respuestas AS er ON er.Id_Encuesta = e.Id
                JOIN encuesta_preguntas AS ep ON ep.Id = er.Id_Pregunta
            WHERE i.Id_Curso = $id_curso
              AND i.Id_Usuario = $id_usuario
        EOL;

        $query = $this->db->query($sqlEncuesta);
        $encuesta = $query->getCustomRowObject(0, \App\Entities\Actualizacion\Encuesta::class);


        $query = $this->db->query($sqlRespuestas);
        $encuesta->Respuestas = $query->getResultArray();

        return $encuesta;
    } 
    public function contParticipantes(int $id){
        $sql = <<<EOL
            SELECT COUNT(*) AS cantidad FROM inscripcion AS i WHERE i.Id_Curso = $id  
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Actualizacion\Curso::class);
        return $rows; 
    
    }
    
    Public function contCapacidad(int $id_curso){
        $sql = <<<EOL
            SELECT 
                COUNT(i.Id_Curso) AS TotalInscripciones,
                c.Capacidad
            FROM
                curso AS c
            LEFT JOIN inscripcion AS i ON c.Id = i.Id_Curso
            WHERE 
                c.Id = $id_curso
            GROUP BY c.Capacidad
        EOL;
        $query = $this->db->query($sql);
        $row = $query->getRow();

        if ($row) {
            // Si las inscripciones son menores que la capacidad, devolver true (se puede inscribir más personas)
            return $row->TotalInscripciones < $row->Capacidad;
        }

        // Si no hay registros o hay un error, no se puede inscribir más personas
        return false;
    }

    public function concluir(int $id_curso, string $fecha){
        $this->update($id_curso, ['Concluido' => $fecha ]);
    }

    public function yaConcluido(int $id_curso):bool {
        $curso = $this->where(['Id' => $id_curso])->first();
        return !empty($curso->Concluido);
    }

    
    
}
?>