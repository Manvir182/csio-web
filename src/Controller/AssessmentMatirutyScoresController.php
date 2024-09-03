<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssessmentMatirutyScores Controller
 *
 * @property \App\Model\Table\AssessmentMatirutyScoresTable $AssessmentMatirutyScores
 *
 * @method \App\Model\Entity\AssessmentMatirutyScore[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentMatirutyScoresController extends AppController
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
        $assessmentMatirutyScores = $this->paginate($this->AssessmentMatirutyScores);

        $this->set(compact('assessmentMatirutyScores'));
    }

    /**
     * View method
     *
     * @param string|null $id Assessment Matiruty Score id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assessmentMatirutyScore = $this->AssessmentMatirutyScores->get($id, [
            'contain' => ['AssessmentControls']
        ]);

        $this->set('assessmentMatirutyScore', $assessmentMatirutyScore);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assessmentMatirutyScore = $this->AssessmentMatirutyScores->newEntity();
        if ($this->request->is('post')) {
            $assessmentMatirutyScore = $this->AssessmentMatirutyScores->patchEntity($assessmentMatirutyScore, $this->request->getData());
            if ($this->AssessmentMatirutyScores->save($assessmentMatirutyScore)) {
                $this->Flash->success(__('The assessment matiruty score has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment matiruty score could not be saved. Please, try again.'));
        }
        $assessmentControls = $this->AssessmentMatirutyScores->AssessmentControls->find('list', ['limit' => 200]);
        $this->set(compact('assessmentMatirutyScore', 'assessmentControls'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assessment Matiruty Score id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assessmentMatirutyScore = $this->AssessmentMatirutyScores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessmentMatirutyScore = $this->AssessmentMatirutyScores->patchEntity($assessmentMatirutyScore, $this->request->getData());
            if ($this->AssessmentMatirutyScores->save($assessmentMatirutyScore)) {
                $this->Flash->success(__('The assessment matiruty score has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment matiruty score could not be saved. Please, try again.'));
        }
        $assessmentControls = $this->AssessmentMatirutyScores->AssessmentControls->find('list', ['limit' => 200]);
        $this->set(compact('assessmentMatirutyScore', 'assessmentControls'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assessment Matiruty Score id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assessmentMatirutyScore = $this->AssessmentMatirutyScores->get($id);
        if ($this->AssessmentMatirutyScores->delete($assessmentMatirutyScore)) {
            $this->Flash->success(__('The assessment matiruty score has been deleted.'));
        } else {
            $this->Flash->error(__('The assessment matiruty score could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
