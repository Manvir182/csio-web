<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RbControls Controller
 *
 * @property \App\Model\Table\RbControlsTable $RbControls
 *
 * @method \App\Model\Entity\RbControl[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RbControlsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RegulatoryBodies']
        ];
        $rbControls = $this->paginate($this->RbControls);

        $this->set(compact('rbControls'));
    }

    /**
     * View method
     *
     * @param string|null $id Rb Control id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rbControl = $this->RbControls->get($id, [
            'contain' => ['RegulatoryBodies', 'RbControlRequirements']
        ]);

        $this->set('rbControl', $rbControl);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rbControl = $this->RbControls->newEntity();
        if ($this->request->is('post')) {
            $rbControl = $this->RbControls->patchEntity($rbControl, $this->request->getData());
            if ($this->RbControls->save($rbControl)) {
                $this->Flash->success(__('The rb control has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rb control could not be saved. Please, try again.'));
        }
        $regulatoryBodies = $this->RbControls->RegulatoryBodies->find('list', ['limit' => 200]);
        $this->set(compact('rbControl', 'regulatoryBodies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rb Control id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rbControl = $this->RbControls->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rbControl = $this->RbControls->patchEntity($rbControl, $this->request->getData());
            if ($this->RbControls->save($rbControl)) {
                $this->Flash->success(__('The rb control has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rb control could not be saved. Please, try again.'));
        }
        $regulatoryBodies = $this->RbControls->RegulatoryBodies->find('list', ['limit' => 200]);
        $this->set(compact('rbControl', 'regulatoryBodies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rb Control id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rbControl = $this->RbControls->get($id);
        if ($this->RbControls->delete($rbControl)) {
            $this->Flash->success(__('The rb control has been deleted.'));
        } else {
            $this->Flash->error(__('The rb control could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
