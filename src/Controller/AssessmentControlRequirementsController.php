<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssessmentControlRequirements Controller
 *
 * @property \App\Model\Table\AssessmentControlRequirementsTable $AssessmentControlRequirements
 *
 * @method \App\Model\Entity\AssessmentControlRequirement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentControlRequirementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AssessmentControls']
        ];
        $assessmentControlRequirements = $this->paginate($this->AssessmentControlRequirements);

        $this->set(compact('assessmentControlRequirements'));
    }

    /**
     * View method
     *
     * @param string|null $id Assessment Control Requirement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assessmentControlRequirement = $this->AssessmentControlRequirements->get($id, [
            'contain' => ['AssessmentControls', 'AcrStatuses']
        ]);

        $this->set('assessmentControlRequirement', $assessmentControlRequirement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assessmentControlRequirement = $this->AssessmentControlRequirements->newEntity();
        if ($this->request->is('post')) {
            $assessmentControlRequirement = $this->AssessmentControlRequirements->patchEntity($assessmentControlRequirement, $this->request->getData());
            if ($this->AssessmentControlRequirements->save($assessmentControlRequirement)) {
                $this->Flash->success(__('The assessment control requirement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment control requirement could not be saved. Please, try again.'));
        }
        $assessmentControls = $this->AssessmentControlRequirements->AssessmentControls->find('list', ['limit' => 200]);
        $this->set(compact('assessmentControlRequirement', 'assessmentControls'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assessment Control Requirement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assessmentControlRequirement = $this->AssessmentControlRequirements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessmentControlRequirement = $this->AssessmentControlRequirements->patchEntity($assessmentControlRequirement, $this->request->getData());
            if ($this->AssessmentControlRequirements->save($assessmentControlRequirement)) {
                $this->Flash->success(__('The assessment control requirement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment control requirement could not be saved. Please, try again.'));
        }
        $assessmentControls = $this->AssessmentControlRequirements->AssessmentControls->find('list', ['limit' => 200]);
        $this->set(compact('assessmentControlRequirement', 'assessmentControls'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assessment Control Requirement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assessmentControlRequirement = $this->AssessmentControlRequirements->get($id);
        if ($this->AssessmentControlRequirements->delete($assessmentControlRequirement)) {
            $this->Flash->success(__('The assessment control requirement has been deleted.'));
        } else {
            $this->Flash->error(__('The assessment control requirement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
