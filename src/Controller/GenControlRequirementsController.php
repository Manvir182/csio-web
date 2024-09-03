<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GenControlRequirements Controller
 *
 * @property \App\Model\Table\GenControlRequirementsTable $GenControlRequirements
 *
 * @method \App\Model\Entity\GenControlRequirement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GenControlRequirementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['GenControls']
        ];
        $genControlRequirements = $this->paginate($this->GenControlRequirements);

        $this->set(compact('genControlRequirements'));
    }

    /**
     * View method
     *
     * @param string|null $id Gen Control Requirement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $genControlRequirement = $this->GenControlRequirements->get($id, [
            'contain' => ['GenControls']
        ]);

        $this->set('genControlRequirement', $genControlRequirement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $genControlRequirement = $this->GenControlRequirements->newEntity();
        if ($this->request->is('post')) {
            $genControlRequirement = $this->GenControlRequirements->patchEntity($genControlRequirement, $this->request->getData());
            if ($this->GenControlRequirements->save($genControlRequirement)) {
                $this->Flash->success(__('The gen control requirement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gen control requirement could not be saved. Please, try again.'));
        }
        $genControls = $this->GenControlRequirements->GenControls->find('list', ['limit' => 200]);
        $this->set(compact('genControlRequirement', 'genControls'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gen Control Requirement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $genControlRequirement = $this->GenControlRequirements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $genControlRequirement = $this->GenControlRequirements->patchEntity($genControlRequirement, $this->request->getData());
            if ($this->GenControlRequirements->save($genControlRequirement)) {
                $this->Flash->success(__('The gen control requirement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gen control requirement could not be saved. Please, try again.'));
        }
        $genControls = $this->GenControlRequirements->GenControls->find('list', ['limit' => 200]);
        $this->set(compact('genControlRequirement', 'genControls'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gen Control Requirement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $genControlRequirement = $this->GenControlRequirements->get($id);
        if ($this->GenControlRequirements->delete($genControlRequirement)) {
            $this->Flash->success(__('The gen control requirement has been deleted.'));
        } else {
            $this->Flash->error(__('The gen control requirement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
