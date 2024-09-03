<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AcrStatuses Controller
 *
 * @property \App\Model\Table\AcrStatusesTable $AcrStatuses
 *
 * @method \App\Model\Entity\AcrStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AcrStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AssessmentControlRequirements', 'Users']
        ];
        $acrStatuses = $this->paginate($this->AcrStatuses);

        $this->set(compact('acrStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Acr Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $acrStatus = $this->AcrStatuses->get($id, [
            'contain' => ['AssessmentControlRequirements', 'Users']
        ]);

        $this->set('acrStatus', $acrStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $acrStatus = $this->AcrStatuses->newEntity();
        if ($this->request->is('post')) {
            $acrStatus = $this->AcrStatuses->patchEntity($acrStatus, $this->request->getData());
            if ($this->AcrStatuses->save($acrStatus)) {
                $this->Flash->success(__('The acr status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The acr status could not be saved. Please, try again.'));
        }
        $assessmentControlRequirements = $this->AcrStatuses->AssessmentControlRequirements->find('list', ['limit' => 200]);
        $users = $this->AcrStatuses->Users->find('list', ['limit' => 200]);
        $this->set(compact('acrStatus', 'assessmentControlRequirements', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Acr Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $acrStatus = $this->AcrStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $acrStatus = $this->AcrStatuses->patchEntity($acrStatus, $this->request->getData());
            if ($this->AcrStatuses->save($acrStatus)) {
                $this->Flash->success(__('The acr status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The acr status could not be saved. Please, try again.'));
        }
        $assessmentControlRequirements = $this->AcrStatuses->AssessmentControlRequirements->find('list', ['limit' => 200]);
        $users = $this->AcrStatuses->Users->find('list', ['limit' => 200]);
        $this->set(compact('acrStatus', 'assessmentControlRequirements', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Acr Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $acrStatus = $this->AcrStatuses->get($id);
        if ($this->AcrStatuses->delete($acrStatus)) {
            $this->Flash->success(__('The acr status has been deleted.'));
        } else {
            $this->Flash->error(__('The acr status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
