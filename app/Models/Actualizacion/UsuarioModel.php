<?php

namespace App\Models\Actualizacion;

use CodeIgniter\Model;
use App\Entities\Actualizacion\Usuario;


class UsuarioModel extends Model
{
    protected $table         = 'usuario';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Nombre', 'Primer_Apellido', 'Segundo_Apellido', 'Curp', 'Rfc', 'Email', 'Sexo', 'Password'];
    protected $returnType    = \App\Entities\Actualizacion\Usuario::class;

    protected $validationRules    = [];
    protected $validationMessages = [
        'Nombre'            => [
            'required'      => 'El campo Nombre es obligatorio.',
            'max_length'    => 'El campo Nombre no puede exceder los 255 caracteres.',
            'min_length'    => 'El campo Nombre debe tener al menos 3 caracteres.',
        ],
        'Primer_Apellido'   => [
            'required'      => 'El campo Primer Apellido es obligatorio.',
            'max_length'    => 'El campo Primer Apellido no puede exceder los 255 caracteres.',
            'min_length'    => 'El campo Primer Apellido debe tener al menos 3 caracteres.',
        ],
        'Segundo_Apellido'  => [
            'required'      => 'El campo Segundo Apellido es obligatorio.',
            'max_length'    => 'El campo Segundo Apellido no puede exceder los 255 caracteres.',
            'min_length'    => 'El campo Segundo Apellido debe tener al menos 3 caracteres.',
        ],
        'Curp'              => [
            'required'      => 'El campo CURP es obligatorio.',
            'max_length'    => 'El campo CURP no puede exceder los 18 caracteres.',
        ],
        'Rfc'               => [
            'required'      => 'El campo RFC es obligatorio.',
            'max_length'    => 'El campo RFC no puede exceder los 13 caracteres.',
        ],
        'Sexo'              => [
            'required'      => 'El campo Sexo es obligatorio.',
            'in_list'      => 'El campo Sexo debe ser H o M.',
        ],
        'Email'             => [
            'required'      => 'El campo Email es obligatorio.',
            'max_length'    => 'El campo Email no puede exceder los 254 caracteres.',
            'valid_email'   => 'El campo Email debe contener una dirección de correo electrónico válida.',
            'is_unique'     => 'El campo Email ya está en uso.',
        ],
        'Id_Organigrama'    => [
            'required'      => 'El campo Id Organigrama es obligatorio.',
            'numeric'      => 'El campo Id Organigrama debe ser numérico.',
        ],
        'Password'          => [
            'required'      => 'El campo Password es obligatorio.',
            'max_length'    => 'El campo Password no puede exceder los 255 caracteres.',
            'min_length'    => 'El campo Password debe tener al menos 10 caracteres.',
        ],
    ];

    public function get(int $id)
    {
        return $this->where('Id', $id)->first();
    }

    public function user(int $id)
    {
        $sql = <<<EOL
            SELECT 
                c.Nombre AS Curso,
                CONCAT(c.Duracion, 'Hrs') AS Duracion,
                substring_index(group_concat(g.Siglas ORDER BY g.Id DESC), ',', 1) AS Grado,
                g.Nivel,
                g.Nombre AS Carrera,
                CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre,
                u.Rfc,
                u.Curp,
                u.Email,
                IF(u.sexo = 'M', o.Cargo_M, o.Cargo_H) AS Cargo
            FROM
                    usuario AS u
                JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
                JOIN Desarrollo.grado AS g ON u.Id = g.Id_Usuario
                JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
                JOIN inscripcion AS i ON i.Id_Usuario = u.Id
                JOIN curso AS c ON c.Id = i.Id_Curso
            WHERE 
                    c.Id = $id
                AND IF(up.Termina IS NOT NULL, up.termina >= @cuando, TRUE)
            GROUP BY
                u.Id, up.Id_Usuario, up.Id_Organigrama, o.Id, g.Id
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Usuario::class);

        return $rows[0];
    }

    public function alumn(int $id)
    {
        $sql = <<<EOL
            SELECT 
                u.Id,
                CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre
                u.Nombres,
                CONCAT(u.Primer_Apellido, ' ', u.Segundo_Apellido)Apellidos
            FROM
                usuario AS u
            WHERE
                u.Id = $id
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Usuario::class);
        return $rows;
    }

    public function alumnInfo(int $id)
    {
        $sql = <<<EOL
            SELECT 
                substring_index(group_concat(g.Nivel ORDER BY g.Id DESC), ',', 1) AS Nivel,
                substring_index(group_concat(g.Nombre ORDER BY g.Id DESC), ',', 1) AS Maximo,
                u.Id,
                u.Nombre,
                CONCAT(u.Primer_Apellido, ' ', u.Segundo_Apellido)Apellido,
                u.Rfc,
                u.Curp,
                u.Email,
                IF(u.sexo = 'M', o.Cargo_M, o.Cargo_H) AS Cargo,
                IF(o.Izq >= 2 AND o.Der <= 41, 'ACADEMICA', 'ADMINISTRATIVA') AS Departamento,
                IF (up.Id_Organigrama IN(1,2,15,13,3,16,20,24), 'D', 'A') AS DA
                
            FROM
                    usuario AS u
                JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
                JOIN Desarrollo.grado AS g ON u.Id = g.Id_Usuario
                JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
                JOIN inscripcion AS i ON i.Id_Usuario = u.Id
            WHERE 
                u.Id =$id
                AND IF(up.Termina IS NOT NULL, up.termina >= @cuando, TRUE)
            GROUP BY
                up.Id_Usuario, up.Id_Organigrama, o.Id
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Usuario::class);
        return $rows;
    }

    public function userAll()
    {
        $sql = <<<EOL
            SELECT 
                u.Id,
                CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre,
                u.Curp,
                u.Rfc,
                u.Email,
                u.Sexo
            FROM
                usuario AS u
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Usuario::class);
        return $rows;
    }

    public function enrrolledParti(int $id_curso)
    {
        $sql = <<<EOL
            SELECT 
                c.Nombre AS Curso,
                substring_index(group_concat(g.Siglas ORDER BY g.Id DESC), ',', 1) AS Grado,
                CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre,
                i.Id,
                IF(u.sexo = 'M', o.Cargo_M, o.Cargo_H) AS Cargo,
                o.Nombre AS NCargo,
                u.Id,
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
    public function userAdd()
    {
        $sql = <<<EOL
            SELECT 
                u.Id,
                CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Nombre,
                u.Curp,
                u.Rfc,
                u.Email,
                u.Sexo,
                up.Id_Organigrama
            FROM
                usuario AS u
                JOIN usuario_puesto AS up ON up.Id_Usuario= u.Id
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Usuario::class);
        return $rows;
    }

    public function userPuesto()
    {
        $sql = <<<EOL
            SELECT 
                o.Id,
                o.Nombre, 
                o.Cargo_H, 
                o.Cargo_M
            FROM 
                organigrama AS o
                LEFT JOIN usuario_puesto AS up 
                ON o.Id = up.Id_Organigrama AND up.Termina IS NULL
            WHERE 
                o.Nombre = 'Docente de Ingeniería Industrial'
                OR o.Nombre = 'Docente de Ingeniería en Industrias Alimentarias'
                OR o.Nombre = 'Docente de Ingeniería Electromecánica'
                OR o.Nombre = 'Docente de Ingeniería en Sistemas Computacionales'
                OR o.Nombre = 'Docente de Ingeniería en Gestión Empresarial'
                OR o.Nombre = 'Docente de Ingeniería Ambiental'
                OR o.Nombre = 'Docente de Contador Público'
                OR o.Nombre = 'Instructor'
                OR o.Nombre = 'Empleado'
                OR up.Id_Organigrama IS NULL
            GROUP BY o.Id;
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Usuario::class);
        return $rows;
    }

    public function validar(string $email, string $password): ?Usuario
    {

        // Buscar al usuario con el email dado
        $query = $this->db->table('usuario')->getWhere(['Email' => $email]);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Usuario::class);
        // Si el usuario no existe la autenticación falla
        if (empty($rows)) {
            return null;
        }

        // Verificar la contraseña del usuario
        // Si la contraseña no coincide, la autenticación falla
        $user = $rows[0];
        if (!password_verify($password, $user->Password)) {
            return null;
        }

        // El usuario existe, y la contraseña coincida, por lo que la autenticación es exitosa
        // Se regresa una instancia de Usuario para disponer de los datos del usuario
        //     en el controlador.
        return $user;
    }

    public function puesto(int $usuario): ?int
    {
        $sql = <<<EOL
            SELECT
                p.Id
            FROM
                usuario_puesto AS p
                JOIN Desarrollo.usuario AS u ON u.Id = p.Id_Usuario
            WHERE
                u.Id = $usuario
                AND IF(p.Termina IS NOT NULL, p.termina >= @cuando, TRUE)
            LIMIT 1
        EOL;

        $row = $this->db->query($sql)->getRow();
        return $row ? (int)$row->Id : null;
    }

    public function userData(int $id_usuario)
    {
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
                i.Id = $id_usuario
            GROUP BY
                c.Id, pc.Id
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Actualizacion\Usuario::class);
        return $rows;
    }

    public function userCuenta(int $id_usuario)
    {
        $sql = <<<EOL
            SELECT 
                u.Id,
                u.Nombre,
                u.Primer_Apellido,
                u.Segundo_Apellido,
                substring_index(group_concat(g.Siglas ORDER BY g.Id DESC), ',', 1) AS Grado,
                g.Nivel,
                g.Nombre AS Carrera,
                u.Sexo,
                u.Rfc,
                u.Curp,
                u.Email,
                IF(u.sexo = 'M', o.Cargo_M, o.Cargo_H) AS Cargo,
                o.Nombre As Puesto
            FROM
                    usuario AS u
                JOIN Desarrollo.usuario_puesto AS up ON up.Id_Usuario = u.Id
                JOIN Desarrollo.grado AS g ON u.Id = g.Id_Usuario
                JOIN Desarrollo.organigrama AS o ON o.Id = up.Id_Organigrama
                WHERE 
                    u.Id = $id_usuario
            AND IF(up.Termina IS NOT NULL, up.termina >= @cuando, TRUE)
            GROUP BY
                u.Id, up.Id_Usuario, up.Id_Organigrama, o.Id, g.Id;
            EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Actualizacion\Usuario::class);
        return $rows;
    }
}
