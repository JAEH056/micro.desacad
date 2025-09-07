<?php
namespace App\Entities\Actualizacion;

use CodeIgniter\Entity\Entity;

class Usuario extends Entity {

    protected $attributes = [
        'Id'                => null,
        'Nombre'            => null,
        'Primer_Apellido'   => null,
        'Segundo_Apellido'  => null,
        'Curp'              => null,
        'Rfc'               => null,
        'Sexo'              => null,
        'Email'             => null,
        'Id_Organigrama'    => null,
        'Password'          => null,
    ];

}
