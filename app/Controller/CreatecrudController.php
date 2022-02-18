<?php  

namespace App\Controller;

use App\Helper\View;

class CreatecrudController
{
    private $data = [];
	public function index () : void 
    {

        $this->data['title'] = "MZ - Criador de Crud PHP";

        View::render('template/header', $this->data);
        View::render('form/form_generate', $this->data);
        View::render('template/footer');
    }
}