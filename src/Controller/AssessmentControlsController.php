<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssessmentControls Controller
 *
 * @property \App\Model\Table\AssessmentControlsTable $AssessmentControls
 *
 * @method \App\Model\Entity\AssessmentControl[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentControlsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Assessments']
        ];
        $assessmentControls = $this->paginate($this->AssessmentControls);

        $this->set(compact('assessmentControls'));
    }

    /**
     * View method
     *
     * @param string|null $id Assessment Control id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assessmentControl = $this->AssessmentControls->get($id, [
            'contain' => ['Assessments', 'AssessmentControlRequirements', 'AssessmentMatirutyScores', 'RcMappings']
        ]);

        $this->set('assessmentControl', $assessmentControl);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assessmentControl = $this->AssessmentControls->newEntity();
        if ($this->request->is('post')) {
            $assessmentControl = $this->AssessmentControls->patchEntity($assessmentControl, $this->request->getData());
            if ($this->AssessmentControls->save($assessmentControl)) {
                $this->Flash->success(__('The assessment control has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment control could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentControls->Assessments->find('list', ['limit' => 200]);
        $this->set(compact('assessmentControl', 'assessments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assessment Control id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assessmentControl = $this->AssessmentControls->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessmentControl = $this->AssessmentControls->patchEntity($assessmentControl, $this->request->getData());
            if ($this->AssessmentControls->save($assessmentControl)) {
                $this->Flash->success(__('The assessment control has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment control could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentControls->Assessments->find('list', ['limit' => 200]);
        $this->set(compact('assessmentControl', 'assessments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assessment Control id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assessmentControl = $this->AssessmentControls->get($id);
        if ($this->AssessmentControls->delete($assessmentControl)) {
            $this->Flash->success(__('The assessment control has been deleted.'));
        } else {
            $this->Flash->error(__('The assessment control could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
