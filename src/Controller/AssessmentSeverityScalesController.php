<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssessmentSeverityScales Controller
 *
 * @property \App\Model\Table\AssessmentSeverityScalesTable $AssessmentSeverityScales
 *
 * @method \App\Model\Entity\AssessmentSeverityScale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentSeverityScalesController extends AppController
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
        $assessmentSeverityScales = $this->paginate($this->AssessmentSeverityScales);

        $this->set(compact('assessmentSeverityScales'));
    }

    /**
     * View method
     *
     * @param string|null $id Assessment Severity Scale id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assessmentSeverityScale = $this->AssessmentSeverityScales->get($id, [
            'contain' => ['Assessments']
        ]);

        $this->set('assessmentSeverityScale', $assessmentSeverityScale);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assessmentSeverityScale = $this->AssessmentSeverityScales->newEntity();
        if ($this->request->is('post')) {
            $assessmentSeverityScale = $this->AssessmentSeverityScales->patchEntity($assessmentSeverityScale, $this->request->getData());
            if ($this->AssessmentSeverityScales->save($assessmentSeverityScale)) {
                $this->Flash->success(__('The assessment severity scale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment severity scale could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentSeverityScales->Assessments->find('list', ['limit' => 200]);
        $this->set(compact('assessmentSeverityScale', 'assessments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assessment Severity Scale id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assessmentSeverityScale = $this->AssessmentSeverityScales->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessmentSeverityScale = $this->AssessmentSeverityScales->patchEntity($assessmentSeverityScale, $this->request->getData());
            if ($this->AssessmentSeverityScales->save($assessmentSeverityScale)) {
                $this->Flash->success(__('The assessment severity scale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment severity scale could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentSeverityScales->Assessments->find('list', ['limit' => 200]);
        $this->set(compact('assessmentSeverityScale', 'assessments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assessment Severity Scale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assessmentSeverityScale = $this->AssessmentSeverityScales->get($id);
        if ($this->AssessmentSeverityScales->delete($assessmentSeverityScale)) {
            $this->Flash->success(__('The assessment severity scale has been deleted.'));
        } else {
            $this->Flash->error(__('The assessment severity scale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
