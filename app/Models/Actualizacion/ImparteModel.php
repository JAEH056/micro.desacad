<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;

class ImparteModel extends Model
{
    protected $table         = 'imparte_curso';
    protected $allowedFields = ['Id_Curso', 'Id_Usuario', 'Cuando'];
    protected $returnType    = \App\Entities\Actualizacion\Instructor::class;

   // public function get(int $id_curso) {
    //    return $this->where('Id_Curso', $id_curso)->first();
    //}


    public function findInstructor(int $id_curso)  {
        $sql = <<<EOL
        SELECT 
            CONCAT(u.Nombre, ' ', u.Primer_Apellido, ' ', u.Segundo_Apellido) AS Instructor,
            ic.Id_Curso,
            ic.Id_Usuario,
            ic.Cuando
        FROM
                imparte_curso AS ic
            RIGHT JOIN Desarrollo.usuario AS u on u.Id = ic.Id_Usuario
        WHERE 
            ic.Id_Curso = $id_curso
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getResult(\App\Entities\Actualizacion\Instructor::class);
        return $rows; 
    }

    public function getInstructor()  {
        $sql = <<<EOL
        SELECT 
            *
        FROM
            usuario AS u
            LEFT JOIN Desarrollo.usuario_puesto AS up on up.Id_Usuario = u.Id
        WHERE
            up.Id_Usuario IS NULL 
        EOL;
        $query = $this->db->query($sql);
        $rows = $query->getRow(1, \App\Entities\Actualizacion\Instructor::class);
        return $rows; 
    }
    public function deleteInstructor(int $id_curso, int $id_usuario){
        $sql = <<<EOL
        DELETE FROM imparte_curso WHERE Id_Curso = $id_curso AND Id_Usuario = $id_usuario
        EOL;
        $query = $this->db->query($sql);
    }
}  
?>