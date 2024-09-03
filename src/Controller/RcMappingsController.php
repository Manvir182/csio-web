<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RcMappings Controller
 *
 * @property \App\Model\Table\RcMappingsTable $RcMappings
 *
 * @method \App\Model\Entity\RcMapping[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RcMappingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AssessmentRisks', 'AssessmentControls']
        ];
        $rcMappings = $this->paginate($this->RcMappings);

        $this->set(compact('rcMappings'));
    }

    /**
     * View method
     *
     * @param string|null $id Rc Mapping id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rcMapping = $this->RcMappings->get($id, [
            'contain' => ['AssessmentRisks', 'AssessmentControls']
        ]);

        $this->set('rcMapping', $rcMapping);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rcMapping = $this->RcMappings->newEntity();
        if ($this->request->is('post')) {
            $rcMapping = $this->RcMappings->patchEntity($rcMapping, $this->request->getData());
            if ($this->RcMappings->save($rcMapping)) {
                $this->Flash->success(__('The rc mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rc mapping could not be saved. Please, try again.'));
        }
        $assessmentRisks = $this->RcMappings->AssessmentRisks->find('list', ['limit' => 200]);
        $assessmentControls = $this->RcMappings->AssessmentControls->find('list', ['limit' => 200]);
        $this->set(compact('rcMapping', 'assessmentRisks', 'assessmentControls'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rc Mapping id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rcMapping = $this->RcMappings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rcMapping = $this->RcMappings->patchEntity($rcMapping, $this->request->getData());
            if ($this->RcMappings->save($rcMapping)) {
                $this->Flash->success(__('The rc mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rc mapping could not be saved. Please, try again.'));
        }
        $assessmentRisks = $this->RcMappings->AssessmentRisks->find('list', ['limit' => 200]);
        $assessmentControls = $this->RcMappings->AssessmentControls->find('list', ['limit' => 200]);
        $this->set(compact('rcMapping', 'assessmentRisks', 'assessmentControls'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rc Mapping id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rcMapping = $this->RcMappings->get($id);
        if ($this->RcMappings->delete($rcMapping)) {
            $this->Flash->success(__('The rc mapping has been deleted.'));
        } else {
            $this->Flash->error(__('The rc mapping could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
