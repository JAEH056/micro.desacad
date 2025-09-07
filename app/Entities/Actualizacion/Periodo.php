<?php
namespace App\Entities\Actualizacion;

use CodeIgniter\Entity\Entity;

class Periodo extends Entity {

    protected $casts = [
        'Inicia'  => 'datetime',
        'Termina' => '?datetime',
    ];

    public function getIntervalo(): string {
        return $this->Inicia . ' - ' . $this->Termina;
    }

}
