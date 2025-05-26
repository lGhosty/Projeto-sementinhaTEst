<?php
declare(strict_types=1);

namespace App\Controller;

class CartItemsController extends AppController
{
    public function index()
    {
        $query = $this->CartItems->find()->contain(['Plants']);
        $cartItems = $this->paginate($query);
        $this->set(compact('cartItems'));
    }

    public function checkout()
    {
        $this->request->allowMethod(['post']);

        // Apaga todos os itens do carrinho
        $this->CartItems->deleteAll([]);

        $this->Flash->success('Compra confirmada com sucesso!');

        // Redireciona para a página principal (ou altere se necessário)
        return $this->redirect(['controller' => 'Plataforma', 'action' => 'index']);
    }

    public function add($plantId = null)
    {
        $this->request->allowMethod(['post', 'get']);

        $plant = $this->CartItems->Plants->get($plantId);

        $cartItem = $this->CartItems->newEmptyEntity();
        $cartItem->plant_id = $plant->id;
        $cartItem->quantity = 1;

        if ($this->CartItems->save($cartItem)) {
            $plant->stock -= 1;
            $this->CartItems->Plants->save($plant);

            $this->Flash->success(__('Planta adicionada ao carrinho com sucesso!'));
        } else {
            $this->Flash->error(__('Erro ao adicionar planta ao carrinho.'));
        }

        return $this->redirect($this->referer());
    }

    public function edit($id = null)
    {
        $cartItem = $this->CartItems->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cartItem = $this->CartItems->patchEntity($cartItem, $this->request->getData());
            if ($this->CartItems->save($cartItem)) {
                $this->Flash->success(__('The cart item has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart item could not be saved. Please, try again.'));
        }
        $plants = $this->CartItems->Plants->find('list', ['limit' => 200]);
        $this->set(compact('cartItem', 'plants'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cartItem = $this->CartItems->get($id);
        if ($this->CartItems->delete($cartItem)) {
            $this->Flash->success(__('The cart item has been deleted.'));
        } else {
            $this->Flash->error(__('The cart item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
