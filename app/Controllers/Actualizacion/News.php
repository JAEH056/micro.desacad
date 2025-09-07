<?php
namespace App\Controllers\Actualizacion;

use App\Models\Actualizacion\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController {

    public function index() {
        $model = model(NewsModel::class);
        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
            .view('news/index')
            .view('templates/footer');
    }

    public function view(string $slug) {
        $model = model(NewsModel::class);
        $data['news'] = $model->getNews($slug);

        if( empty($data['news'])) {
           throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

       $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');

        return view('templates/header')
            . view('news/create')
            . view('templates/footer');
    }

	public function create() {
        helper('form');
        
        if($this->request->is('get')) {
            return view('templates/header', ['title' => 'Crear un nuevo item'])
		        . view('news/create')
		        . view('templates/footer');
	     }

        $post = $this->request->getPost(['title', 'body']);

        $sonValidos = $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ]);

        if (! $sonValidos ) {
		    return view('templates/header', ['title' => 'Crear un nuevo item'])
                . view('news/create')
                . view('templates/footer');
        }

        $model = model (NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug' => url_title($post['title'], '-', true),
            'body' => $post['body'],
	    ]);

        return $this->response->redirect(site_url('/news'));
    }

    public function updateShow(int $id) : string
    {
        $model = model(NewsModel::class);
        $data['news'] = $model->get($id);

        return view('templates/header', ['title' => 'Actualiza la noticia'])
            . view('news/update', $data)
            . view('templates/footer');
    }

    public function updateEdit()
    {
        $model = model(NewsModel::class);

        $id   = $this->request->getpost('id');
        $post = $this->request->getPost(['title', 'body']);
        
        $sonValidos = $this->validateData($post, [
                'title' => 'required|max_length[255]|min_length[3]',
                'body'  => 'required|max_length[5000]|min_length[10]',
            ]);
        

        if (! $sonValidos ) {
            //return $this->response->redirect(url_to('News::updateShow', ($id)));
            return redirect()->back()->withInput();
        }
    
        $post['slug'] = url_title($post['title'], '-', true);
        $model->updateNews($id, $post);
            
        return $this->response->redirect(site_url('/news'));
    }

	public function delete(int $id)
	{
        $model = model(NewsModel::class);
        $model->deleteNews($id);

        return $this->response->redirect(site_url('/news'));
    }
}


