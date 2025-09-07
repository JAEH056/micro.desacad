<?php

namespace App\Models\Actualizacion;

use CodeIgniter\Model;


class PuestoModel extends Model
{
    protected $table      = 'puestos';
    protected $primaryKey = 'Id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 'Id_Usuario', 'Id_Organigrama', 'Inicia', 'Termina'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function addPuesto(int $id_usuario, int $id_organigrama):int
    {
        $this->db->table('usuario_puesto')->insert([
            'Id_Usuario'     => $id_usuario,
            'Id_Organigrama' => $id_organigrama,
            'Inicia'         => date('Y-m-d'),
        ]);

        return $this->insertID;
    }

    public function cambiarPuesto(int $Id_usuario, int $New_puesto): bool
    {
        $model = model(PuestoModel::class);

        // 1) Cerrar puesto vigente
        $model->where('Id_Usuario', $Id_usuario)
              ->where('termina', null)
              ->set('termina', date('Y-m-d H:i:s'))
              ->update();

        // 2) Insertar nuevo puesto
        $data = [
            'Id_Usuario'     => $Id_usuario,
            'Id_Organigrama' => $New_puesto,
            'termina'        => null,
        ];
        $model->insert($data);

        // 3) Llamar a asignar rol (puede estar en UsuarioController o en un servicio aparte)
        return $this->asignarRol($New_puesto, $Id_usuario);
    }
}
