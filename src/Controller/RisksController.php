<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
/**
 * Risks Controller
 *
 * @property \App\Model\Table\RisksTable $Risks
 *
 * @method \App\Model\Entity\Risk[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RisksController extends AppController
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
		$this->set('pageHeading','Risk Areas Master');
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
    	if($id!=null){
    		$risk = $this->Risks->get($id, [
	            'contain' => []
	        ]);
    	} else {
    		$risk = $this->Risks->newEntity();
    	}
    	
    	
        if ($this->request->is(['post', 'put'])) {
        	$risk = $this->Risks->patchEntity($risk, $this->request->getData());
			$theRisk = $this->Risks->save($risk);
            if ($theRisk) {
            	
				$conn = ConnectionManager::get('default');
				$mapQuery = "INSERT INTO gen_rc_mappings (risk_id, control_id, `status`) 
							 SELECT r.id AS risk_id, gc.id AS control_id, 'Pending' AS `status` FROM risks r, gen_controls gc WHERE r.id='".$theRisk->id."'";
				$stmt = $conn->query($mapQuery);
				
				$mapQuery = "INSERT INTO rb_rc_mappings (rb_id,risk_id, control_id, `status`) 
							 SELECT gc.regulatory_body_id AS rb_id, r.id AS risk_id, gc.id AS control_id, 'Pending' AS `status` FROM risks r, rb_controls gc WHERE r.id='".$theRisk->id."'";
				$stmt = $conn->query($mapQuery);
				
				
                $this->Flash->success(__('The risk has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
            $this->Flash->error(__('The risk could not be saved. Please, try again.'));
			
        }
        
       
        $risks = $this->paginate($this->Risks);
		
		$this->set('thisrisk',$risk);
        $this->set(compact('risks'));
    }

    /**
     * View method
     *
     * @param string|null $id Risk id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $risk = $this->Risks->get($id, [
            'contain' => []
        ]);

        $this->set('risk', $risk);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $risk = $this->Risks->newEntity();
        if ($this->request->is('post')) {
            $risk = $this->Risks->patchEntity($risk, $this->request->getData());
			$theRisk = $this->Risks->save($risk);
            if ($theRisk) {
            	
				
				
                $this->Flash->success(__('The risk has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The risk could not be saved. Please, try again.'));
        }
		
        $this->set(compact('risk'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Risk id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $risk = $this->Risks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $risk = $this->Risks->patchEntity($risk, $this->request->getData());
            if ($this->Risks->save($risk)) {
                $this->Flash->success(__('The risk has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The risk could not be saved. Please, try again.'));
        }
        $this->set(compact('risk'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Risk id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $risk = $this->Risks->get($id);
        if ($this->Risks->delete($risk)) {
            $this->Flash->success(__('The risk has been deleted.'));
        } else {
            $this->Flash->error(__('The risk could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
