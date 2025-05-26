<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class PlataformaController extends AppController
{
    public function index()
{
    $plants = $this->fetchTable('Plants')
        ->find()
        ->select(['id', 'nome', 'description', 'price', 'image', 'stock'])
        ->orderBy(['Plants.nome' => 'ASC']);

    $this->set(compact('plants'));
}

}



