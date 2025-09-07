<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException; //Add this line

class Pages extends BaseController
{
    public function view(string $page='home'): string {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')){
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $data = [];
	$data['title'] = ucfirst($page); //Capitalize the first letter

	return view('templates/header', $data)
	       . view('pages/' . $page)
	       . view('templates/footer');
    }

    public function index(): string {
        return 'Hola mundo';
    }
}

