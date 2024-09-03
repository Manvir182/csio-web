<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssessmentStatuses Controller
 *
 * @property \App\Model\Table\AssessmentStatusesTable $AssessmentStatuses
 *
 * @method \App\Model\Entity\AssessmentStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Assessments', 'Users']
        ];
        $assessmentStatuses = $this->paginate($this->AssessmentStatuses);

        $this->set(compact('assessmentStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Assessment Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assessmentStatus = $this->AssessmentStatuses->get($id, [
            'contain' => ['Assessments', 'Users']
        ]);

        $this->set('assessmentStatus', $assessmentStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assessmentStatus = $this->AssessmentStatuses->newEntity();
        if ($this->request->is('post')) {
            $assessmentStatus = $this->AssessmentStatuses->patchEntity($assessmentStatus, $this->request->getData());
            if ($this->AssessmentStatuses->save($assessmentStatus)) {
                $this->Flash->success(__('The assessment status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment status could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentStatuses->Assessments->find('list', ['limit' => 200]);
        $users = $this->AssessmentStatuses->Users->find('list', ['limit' => 200]);
        $this->set(compact('assessmentStatus', 'assessments', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assessment Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assessmentStatus = $this->AssessmentStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessmentStatus = $this->AssessmentStatuses->patchEntity($assessmentStatus, $this->request->getData());
            if ($this->AssessmentStatuses->save($assessmentStatus)) {
                $this->Flash->success(__('The assessment status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment status could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentStatuses->Assessments->find('list', ['limit' => 200]);
        $users = $this->AssessmentStatuses->Users->find('list', ['limit' => 200]);
        $this->set(compact('assessmentStatus', 'assessments', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assessment Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assessmentStatus = $this->AssessmentStatuses->get($id);
        if ($this->AssessmentStatuses->delete($assessmentStatus)) {
            $this->Flash->success(__('The assessment status has been deleted.'));
        } else {
            $this->Flash->error(__('The assessment status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
