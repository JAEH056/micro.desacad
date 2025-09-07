<?php

namespace App\Models\Actualizacion;

use CodeIgniter\Model;


class GradoModel extends Model
{
    protected $table      = 'grado';
    protected $primaryKey = 'Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'Id', 'Id_Usuario', 'Nivel', 'Carrera', 'Nombre', 'Siglas', 'Fecha'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'Id'         => 'required|integer',
        'Id_Usuario' => 'required|integer',
        'Nivel'      => 'required|string|max_length[100]',
        'Carrera'    => 'required|string|max_length[100]',
        'Nombre'     => 'required|string|max_length[100]',
        'Siglas'     => 'required|string|max_length[10]',
        'Fecha'      => 'required|valid_date'
    ];
    protected $validationMessages = [
        'Id'         => [
            'required' => 'El campo Id es obligatorio',
            'integer'  => 'El campo Id debe ser un número entero'
        ],
        'Id_Usuario' => [
            'required' => 'El campo Id_Usuario es obligatorio',
            'integer'  => 'El campo Id_Usuario debe ser un número entero'
        ],
        'Nivel'      => [
            'required'   => 'El campo Nivel es obligatorio',
            'string'     => 'El campo Nivel debe ser una cadena de texto',
            'max_length' => 'El campo Nivel no puede tener más de 100 caracteres'
        ],
        'Carrera'    => [
            'required'   => 'El campo Carrera es obligatorio',
            'string'     => 'El campo Carrera debe ser una cadena de texto',
            'max_length' => 'El campo Carrera no puede tener más de 100 caracteres'
        ],
        'Nombre'     => [
            'required'   => 'El campo Nombre es obligatorio',
            'string'     => 'El campo Nombre debe ser una cadena de texto',
            'max_length' => 'El campo Nombre no puede tener más de 100 caracteres'
        ],
        'Siglas'     => [
            'required'   => 'El campo Siglas es obligatorio',
            'string'     => 'El campo Siglas debe ser una cadena de texto',
            'max_length' => 'El campo Siglas no puede tener más de 10 caracteres'
        ],
        'Fecha'      => [
            'required'   => 'El campo Fecha es obligatorio',
            'valid_date' => 'El campo Fecha debe ser una fecha válida'
        ]
    ];
    protected $skipValidation     = false;

    public function addGrado(int $id_usuario, array $grado)
    {
        //$db = \Config\Database::connect();
        return $this->db->table('grado')->insert([
            'Id_Usuario' => $id_usuario,
            'Nivel'      => $grado['Nivel'],
            'Carrera'    => $grado['Carrera'],
            'Nombre'     => $grado['Nombre'],
            'Siglas'     => $grado['Siglas'],
            'Fecha'      => date('Y-m-d'),
        ]);
    }

    public function changeGrado(int $id_usuario, int $id_organigrama)
    {
        $db = \Config\Database::connect();
        $db->table('usuario_puesto')
            ->where('Id_Usuario', $id_usuario)
            ->where('Termina IS NULL') // solo el puesto activo
            ->set('Termina', date('Y-m-d'))
            ->update();

        $db->table('usuario_puesto')->insert([
            'Id_Usuario' => $id_usuario,
            'Id_Organigrama' => $id_organigrama,
            'Inicio' => date('Y-m-d'),
            'Termina' => null
        ]);
    }
}
