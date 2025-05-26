<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Plants Controller
 *
 * @property \App\Model\Table\PlantsTable $Plants
 */
class PlantsController extends AppController
{
    public function index()
    {
        $query = $this->Plants->find();
        $plants = $this->paginate($query);

        $this->set(compact('plants'));
    }

    public function view($id = null)
    {
        $plant = $this->Plants->get($id);
        $this->set(compact('plant'));
    }

    public function add()
    {
        $plant = $this->Plants->newEmptyEntity();
        if ($this->request->is('post')) {
            $plant = $this->Plants->patchEntity($plant, $this->request->getData());

            // Upload da imagem
            $imageFile = $this->request->getData('image_file');
            if (!empty($imageFile) && $imageFile->getError() === 0) {
                $name = time() . '_' . $imageFile->getClientFilename();  // evita conflitos
                $targetPath = WWW_ROOT . 'img' . DS . 'plants' . DS . $name;

                $imageFile->moveTo($targetPath);
                $plant->image = 'plants/' . $name;  // salva caminho relativo
            }

            if ($this->Plants->save($plant)) {
                $this->Flash->success(__('The plant has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plant could not be saved. Please, try again.'));
        }
        $this->set(compact('plant'));
    }

    public function edit($id = null)
    {
        $plant = $this->Plants->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plant = $this->Plants->patchEntity($plant, $this->request->getData());

            // Upload da imagem
            $imageFile = $this->request->getData('image_file');
            if (!empty($imageFile) && $imageFile->getError() === 0) {
                $name = time() . '_' . $imageFile->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . 'plants' . DS . $name;

                $imageFile->moveTo($targetPath);
                $plant->image = 'plants/' . $name;
            }

            if ($this->Plants->save($plant)) {
                $this->Flash->success(__('The plant has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plant could not be saved. Please, try again.'));
        }
        $this->set(compact('plant'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plant = $this->Plants->get($id);
        if ($this->Plants->delete($plant)) {
            $this->Flash->success(__('The plant has been deleted.'));
        } else {
            $this->Flash->error(__('The plant could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

