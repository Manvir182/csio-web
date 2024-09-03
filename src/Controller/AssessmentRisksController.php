<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssessmentRisks Controller
 *
 * @property \App\Model\Table\AssessmentRisksTable $AssessmentRisks
 *
 * @method \App\Model\Entity\AssessmentRisk[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentRisksController extends AppController
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
        $assessmentRisks = $this->paginate($this->AssessmentRisks);

        $this->set(compact('assessmentRisks'));
    }

    /**
     * View method
     *
     * @param string|null $id Assessment Risk id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assessmentRisk = $this->AssessmentRisks->get($id, [
            'contain' => ['Assessments', 'RcMappings']
        ]);

        $this->set('assessmentRisk', $assessmentRisk);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assessmentRisk = $this->AssessmentRisks->newEntity();
        if ($this->request->is('post')) {
            $assessmentRisk = $this->AssessmentRisks->patchEntity($assessmentRisk, $this->request->getData());
            if ($this->AssessmentRisks->save($assessmentRisk)) {
                $this->Flash->success(__('The assessment risk has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment risk could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentRisks->Assessments->find('list', ['limit' => 200]);
        $this->set(compact('assessmentRisk', 'assessments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assessment Risk id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assessmentRisk = $this->AssessmentRisks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessmentRisk = $this->AssessmentRisks->patchEntity($assessmentRisk, $this->request->getData());
            if ($this->AssessmentRisks->save($assessmentRisk)) {
                $this->Flash->success(__('The assessment risk has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment risk could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentRisks->Assessments->find('list', ['limit' => 200]);
        $this->set(compact('assessmentRisk', 'assessments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assessment Risk id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assessmentRisk = $this->AssessmentRisks->get($id);
        if ($this->AssessmentRisks->delete($assessmentRisk)) {
            $this->Flash->success(__('The assessment risk has been deleted.'));
        } else {
            $this->Flash->error(__('The assessment risk could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
