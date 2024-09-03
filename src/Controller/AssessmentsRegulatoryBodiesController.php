<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssessmentsRegulatoryBodies Controller
 *
 * @property \App\Model\Table\AssessmentsRegulatoryBodiesTable $AssessmentsRegulatoryBodies
 *
 * @method \App\Model\Entity\AssessmentsRegulatoryBody[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentsRegulatoryBodiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Assessments', 'RegulatoryBodies']
        ];
        $assessmentsRegulatoryBodies = $this->paginate($this->AssessmentsRegulatoryBodies);

        $this->set(compact('assessmentsRegulatoryBodies'));
    }

    /**
     * View method
     *
     * @param string|null $id Assessments Regulatory Body id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assessmentsRegulatoryBody = $this->AssessmentsRegulatoryBodies->get($id, [
            'contain' => ['Assessments', 'RegulatoryBodies']
        ]);

        $this->set('assessmentsRegulatoryBody', $assessmentsRegulatoryBody);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assessmentsRegulatoryBody = $this->AssessmentsRegulatoryBodies->newEntity();
        if ($this->request->is('post')) {
            $assessmentsRegulatoryBody = $this->AssessmentsRegulatoryBodies->patchEntity($assessmentsRegulatoryBody, $this->request->getData());
            if ($this->AssessmentsRegulatoryBodies->save($assessmentsRegulatoryBody)) {
                $this->Flash->success(__('The assessments regulatory body has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessments regulatory body could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentsRegulatoryBodies->Assessments->find('list', ['limit' => 200]);
        $regulatoryBodies = $this->AssessmentsRegulatoryBodies->RegulatoryBodies->find('list', ['limit' => 200]);
        $this->set(compact('assessmentsRegulatoryBody', 'assessments', 'regulatoryBodies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assessments Regulatory Body id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assessmentsRegulatoryBody = $this->AssessmentsRegulatoryBodies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessmentsRegulatoryBody = $this->AssessmentsRegulatoryBodies->patchEntity($assessmentsRegulatoryBody, $this->request->getData());
            if ($this->AssessmentsRegulatoryBodies->save($assessmentsRegulatoryBody)) {
                $this->Flash->success(__('The assessments regulatory body has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessments regulatory body could not be saved. Please, try again.'));
        }
        $assessments = $this->AssessmentsRegulatoryBodies->Assessments->find('list', ['limit' => 200]);
        $regulatoryBodies = $this->AssessmentsRegulatoryBodies->RegulatoryBodies->find('list', ['limit' => 200]);
        $this->set(compact('assessmentsRegulatoryBody', 'assessments', 'regulatoryBodies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assessments Regulatory Body id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assessmentsRegulatoryBody = $this->AssessmentsRegulatoryBodies->get($id);
        if ($this->AssessmentsRegulatoryBodies->delete($assessmentsRegulatoryBody)) {
            $this->Flash->success(__('The assessments regulatory body has been deleted.'));
        } else {
            $this->Flash->error(__('The assessments regulatory body could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
