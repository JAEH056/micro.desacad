<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;
use App\Entities\Actualizacion\Evidencias as EvidenciasEntity;

class EvidenciasModel extends Model
{
    protected $table         = 'evidencias';
    protected $primariKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Curso', 'Imagen'];
    protected $returnType    = \App\Entities\Actualizacion\Evidencias::class;



    public function obtenerImagenes(int $id_curso){
        $sql = <<<EOL
            SELECT
            c.Id, 
            e.Imagen,
            e.Id AS Id_Img
            FROM
                    curso AS c
                JOIN Desarrollo.evidencias AS e ON c.Id = e.Id_Curso
            WHERE
            c.Id = $id_curso
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getCustomResultObject(\App\Entities\Actualizacion\Curso::class);
        return $rows;  
    }

    public function imagenDelete(int $id) {
        $imagen = $this->find($id);
        
        if ($imagen) {
            
            $filePath = FCPATH . 'evidencias/' . $imagen->Imagen;

            if (file_exists($filePath)) {
                unlink($filePath);
            }
            return $this->delete($id);
        }
        
        return false; 
    }
}