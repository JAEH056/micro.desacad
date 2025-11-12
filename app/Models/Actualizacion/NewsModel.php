<?php
namespace App\Models\Actualizacion;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $allowedFields = ['title', 'slug', 'body', 'id'];

    public function get(int $id) {
        return $this->where('id', $id)->first();
    }
    
    public function getNews($slug = false)
    {
        if($slug === false){
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }

    public function deleteNews(int $id)
    {
        $this->where('id', $id)->delete($id);
    }

    public function updateNews(int $id, array $data) {
        
        if(! empty(array_diff(array_keys($data), $this->allowedFields))) {
            throw new \Exception('Datos con campos inválidos.');
        }
        $this->where('id', $id)
             ->update($id, $data);
    }
}
