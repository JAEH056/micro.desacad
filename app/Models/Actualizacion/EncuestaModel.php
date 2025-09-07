<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;
use App\Entities\Actualizacion\Encuesta as EncuestaEntity;

class EncuestaModel extends Model
{
    protected $table         = 'encuesta';
    protected $primaryKey    = 'Id';
    protected $allowedFields = ['Id', 'Id_Inscripcion', 'Fecha', 'Comentarios'];
    protected $returnType    = \App\Entities\Actualizacion\Encuesta::class;

    public function get(int $id) {
        return $this->from('encuesta_preguntas')->where('Id', $id)->first();
    }



    public function findPreguntas(): array{
        $sql = "SELECT * FROM encuesta_preguntas";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function completa(int $id_inscripcion): bool{
        $sql = <<<EOL
            SELECT COUNT(e.Id) AS Completado
            FROM inscripcion AS i
                JOIN encuesta AS e ON e.Id_Inscripcion = i.Id
            WHERE i.Id = $id_inscripcion;
            EOL;
        $query = $this->db->query($sql);
        $row = $query->getRow();
        return (bool)$row->Completado;
    }
    
    public function guardarRespuesta(int $idInscripcion, string $comentarios, array $preguntas, array $respuestas){
        $this->db;
        
        
        $encuesta = new EncuestaEntity();
        $encuesta->Id_Inscripcion   = $idInscripcion;
        $encuesta->Comentarios      = $comentarios;       
        $idEncuesta = $this->insert($encuesta);
        
        foreach($preguntas as $pregunta) {
            $r = [
                'Id_Encuesta' => $idEncuesta,
                'Id_Pregunta' => $pregunta['Id'],
                'Respuesta'   => $respuestas['p' . $pregunta['Id']],
            ];
            $builder = $this->db->table('encuesta_respuestas');
            $builder->insert($r);
        }
    
        return $idEncuesta;
    }

    public function isEncuestaCompleta($id_inscripcion) {
        $resultado = $this->db->table('encuesta')
            ->where('id_inscripcion', $id_inscripcion)
            ->get()
            ->getRow();
    
        return !empty($resultado);
    }
}