<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class PlataformaController extends AppController
{
    public function index()
    {
        $plants = $this->fetchTable('Plants')
            ->find()
            ->select(['id', 'name', 'description', 'price', 'image', 'stock'])
            ->orderBy(['Plants.name' => 'ASC'])
            ->toArray();  // importante converter

        $cartItems = $this->fetchTable('CartItems')->find('all', [
            'contain' => ['Plants']
        ])->toArray();

        $this->set(compact('plants', 'cartItems'));
    }
}




