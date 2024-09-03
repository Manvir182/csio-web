<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RbControlRequirements Controller
 *
 * @property \App\Model\Table\RbControlRequirementsTable $RbControlRequirements
 *
 * @method \App\Model\Entity\RbControlRequirement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RbControlRequirementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RbControls']
        ];
        $rbControlRequirements = $this->paginate($this->RbControlRequirements);

        $this->set(compact('rbControlRequirements'));
    }

    /**
     * View method
     *
     * @param string|null $id Rb Control Requirement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rbControlRequirement = $this->RbControlRequirements->get($id, [
            'contain' => ['RbControls']
        ]);

        $this->set('rbControlRequirement', $rbControlRequirement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rbControlRequirement = $this->RbControlRequirements->newEntity();
        if ($this->request->is('post')) {
            $rbControlRequirement = $this->RbControlRequirements->patchEntity($rbControlRequirement, $this->request->getData());
            if ($this->RbControlRequirements->save($rbControlRequirement)) {
                $this->Flash->success(__('The rb control requirement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rb control requirement could not be saved. Please, try again.'));
        }
        $rbControls = $this->RbControlRequirements->RbControls->find('list', ['limit' => 200]);
        $this->set(compact('rbControlRequirement', 'rbControls'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rb Control Requirement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rbControlRequirement = $this->RbControlRequirements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rbControlRequirement = $this->RbControlRequirements->patchEntity($rbControlRequirement, $this->request->getData());
            if ($this->RbControlRequirements->save($rbControlRequirement)) {
                $this->Flash->success(__('The rb control requirement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rb control requirement could not be saved. Please, try again.'));
        }
        $rbControls = $this->RbControlRequirements->RbControls->find('list', ['limit' => 200]);
        $this->set(compact('rbControlRequirement', 'rbControls'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rb Control Requirement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rbControlRequirement = $this->RbControlRequirements->get($id);
        if ($this->RbControlRequirements->delete($rbControlRequirement)) {
            $this->Flash->success(__('The rb control requirement has been deleted.'));
        } else {
            $this->Flash->error(__('The rb control requirement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
