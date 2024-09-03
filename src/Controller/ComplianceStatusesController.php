<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ComplianceStatuses Controller
 *
 * @property \App\Model\Table\ComplianceStatusesTable $ComplianceStatuses
 *
 * @method \App\Model\Entity\ComplianceStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComplianceStatusesController extends AppController
{
	
	public function isAuthorized($user){
		if($user['role']=="Super Admin"){
			return true;
		} else {
			return false;
		}
		
	}
	public function initialize(){
		parent::initialize();
		$this->set('pageHeading','Compliance Statuses Master');
	}
	
	

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $complianceStatuses = $this->paginate($this->ComplianceStatuses);

        $this->set(compact('complianceStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Compliance Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $complianceStatus = $this->ComplianceStatuses->get($id, [
            'contain' => []
        ]);

        $this->set('complianceStatus', $complianceStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $complianceStatus = $this->ComplianceStatuses->newEntity();
        if ($this->request->is('post')) {
            $complianceStatus = $this->ComplianceStatuses->patchEntity($complianceStatus, $this->request->getData());
            if ($this->ComplianceStatuses->save($complianceStatus)) {
                $this->Flash->success(__('The compliance status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The compliance status could not be saved. Please, try again.'));
        }
        $this->set(compact('complianceStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Compliance Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $complianceStatus = $this->ComplianceStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $complianceStatus = $this->ComplianceStatuses->patchEntity($complianceStatus, $this->request->getData());
            if ($this->ComplianceStatuses->save($complianceStatus)) {
                $this->Flash->success(__('The compliance status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The compliance status could not be saved. Please, try again.'));
        }
        $this->set(compact('complianceStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Compliance Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $complianceStatus = $this->ComplianceStatuses->get($id);
        if ($this->ComplianceStatuses->delete($complianceStatus)) {
            $this->Flash->success(__('The compliance status has been deleted.'));
        } else {
            $this->Flash->error(__('The compliance status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
