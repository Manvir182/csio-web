<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LoginHistory Controller
 *
 * @property \App\Model\Table\LoginHistoryTable $LoginHistory
 *
 * @method \App\Model\Entity\LoginHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoginHistoryController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $loginHistory = $this->paginate($this->LoginHistory);

        $this->set(compact('loginHistory'));
    }

    /**
     * View method
     *
     * @param string|null $id Login History id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $loginHistory = $this->LoginHistory->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('loginHistory', $loginHistory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loginHistory = $this->LoginHistory->newEntity();
        if ($this->request->is('post')) {
            $loginHistory = $this->LoginHistory->patchEntity($loginHistory, $this->request->getData());
            if ($this->LoginHistory->save($loginHistory)) {
                $this->Flash->success(__('The login history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The login history could not be saved. Please, try again.'));
        }
        $users = $this->LoginHistory->Users->find('list', ['limit' => 200]);
        $this->set(compact('loginHistory', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Login History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loginHistory = $this->LoginHistory->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $loginHistory = $this->LoginHistory->patchEntity($loginHistory, $this->request->getData());
            if ($this->LoginHistory->save($loginHistory)) {
                $this->Flash->success(__('The login history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The login history could not be saved. Please, try again.'));
        }
        $users = $this->LoginHistory->Users->find('list', ['limit' => 200]);
        $this->set(compact('loginHistory', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Login History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $loginHistory = $this->LoginHistory->get($id);
        if ($this->LoginHistory->delete($loginHistory)) {
            $this->Flash->success(__('The login history has been deleted.'));
        } else {
            $this->Flash->error(__('The login history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
