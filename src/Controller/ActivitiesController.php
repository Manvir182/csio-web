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
class ActivitiesController extends AppController
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
		$this->set('pageHeading','Company Activities Master');
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
    	if($id!=null){
    		$activity = $this->Activities->get($id, [
	            'contain' => []
	        ]);
			
			if($activity->name=='Unsure'){
				$this->Flash->error(__('This Activity Can not be edited or deleted.'));
				return $this->redirect($this->referer());
			}
			
    	} else {
    		$activity = $this->Activities->newEntity();
    	}
    	
    	
        if ($this->request->is(['post', 'put'])) {
        	$activity = $this->Activities->patchEntity($activity, $this->request->getData());
			$theActivity = $this->Activities->save($activity);
            if ($theActivity) {
            	$this->Flash->success(__('The Activity has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
            $this->Flash->error(__('The Activity could not be saved. Please, try again.'));
			
        }
        
       
        $activities = $this->paginate($this->Activities);
		
		$this->set('thisactivity',$activity);
        $this->set(compact('activities'));
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
        $risk = $this->Activities->get($id);
        if ($this->Activities->delete($risk)) {
            $this->Flash->success(__('The activity has been deleted.'));
        } else {
            $this->Flash->error(__('The activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
