<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RiskSeverityScales Controller
 *
 * @property \App\Model\Table\RiskSeverityScalesTable $RiskSeverityScales
 *
 * @method \App\Model\Entity\RiskSeverityScale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RiskSeverityScalesController extends AppController
{
	
	public function isAuthorized($user){
		if($user['role']=="Super Admin"){
			return true;
		} 
		return false;
		
	}
	public function initialize(){
		parent::initialize();
		$this->set('pageHeading','Risk Severity Scales Master');
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $riskSeverityScales = $this->paginate($this->RiskSeverityScales);

        $this->set(compact('riskSeverityScales'));
    }

    /**
     * View method
     *
     * @param string|null $id Risk Severity Scale id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $riskSeverityScale = $this->RiskSeverityScales->get($id, [
            'contain' => []
        ]);

        $this->set('riskSeverityScale', $riskSeverityScale);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $riskSeverityScale = $this->RiskSeverityScales->newEntity();
        if ($this->request->is('post')) {
            $riskSeverityScale = $this->RiskSeverityScales->patchEntity($riskSeverityScale, $this->request->getData());
            if ($this->RiskSeverityScales->save($riskSeverityScale)) {
                $this->Flash->success(__('The risk severity scale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The risk severity scale could not be saved. Please, try again.'));
        }
        $this->set(compact('riskSeverityScale'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Risk Severity Scale id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $riskSeverityScale = $this->RiskSeverityScales->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $riskSeverityScale = $this->RiskSeverityScales->patchEntity($riskSeverityScale, $this->request->getData());
            if ($this->RiskSeverityScales->save($riskSeverityScale)) {
                $this->Flash->success(__('The risk severity scale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The risk severity scale could not be saved. Please, try again.'));
        }
        $this->set(compact('riskSeverityScale'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Risk Severity Scale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $riskSeverityScale = $this->RiskSeverityScales->get($id);
        if ($this->RiskSeverityScales->delete($riskSeverityScale)) {
            $this->Flash->success(__('The risk severity scale has been deleted.'));
        } else {
            $this->Flash->error(__('The risk severity scale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
