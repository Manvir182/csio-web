<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;

/**
 * GenControls Controller
 *
 * @property \App\Model\Table\GenControlsTable $GenControls
 *
 * @method \App\Model\Entity\GenControl[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FfiecDomainsController extends AppController
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
		$this->set('pageHeading','FFIEC Regulated Assessment Control Domains');
		
		$this->Security->setConfig('unlockedActions', ['add','edit','rcmappings']);
		
		
	}
	
	
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RegulatoryBodies']
        ];
        $genControls = $this->paginate($this->GenControls);

        $this->set(compact('genControls'));
    }

    /**
     * View method
     *
     * @param string|null $id Gen Control id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $genControl = $this->GenControls->get($id, [
            'contain' => ['GenControlRequirements']
        ]);

        $this->set('genControl', $genControl);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $genControl = $this->GenControls->newEntity();
        if ($this->request->is('post')) {
        	$data = $this->request->getData();
			
			$rControl = array(
				'name'=>$data['RbControls']['name'],
				'description'=>$data['RbControls']['description']
			);
			foreach($data['RbControlRequirements'][0]['name'] as $k=>$reqName){
				$rControl['gen_control_requirements'][]=array(
					'name'=>$reqName
				);
			}
			$gControl = TableRegistry::get('GenControls');
			$entity = $gControl->newEntity($rControl,array(
				'associated'=>array(
					'GenControlRequirements'
				)
			));
			
			$thisControl=$gControl->save($entity);
			if($thisControl){
				
				$conn = ConnectionManager::get('default');
				$mapQuery = "INSERT INTO gen_rc_mappings (risk_id, control_id, `status`) 
							 SELECT r.id AS risk_id, gc.id AS control_id, 'Pending' AS `status` FROM risks r, gen_controls gc WHERE gc.id='".$thisControl->id."'";
				$stmt = $conn->query($mapQuery);
				
				$this->Flash->success(__('The Control Area for Generalized Assessments has been saved.'));
                return $this->redirect(['action' => 'index']);
			}
			/*
            $genControl = $this->GenControls->patchEntity($genControl, $this->request->getData());
            if ($this->GenControls->save($genControl)) {
                $this->Flash->success(__('The gen control has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
			
			*/
            $this->Flash->error(__('The Control Area for Generalized Assessments could not be saved. Please, try again.'));
        }
        
        $this->set(compact('genControl'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gen Control id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $genControl = $this->GenControls->get($id, [
            'contain' => ['GenControlRequirements']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$data=$this->request->getData();
			debug($data);
			$rControl = array(
				'name'=>$data['name'],
				'description'=>$data['description']
			);
			
			foreach($data['RbControlRequirements']['name'] as $k=>$reqName){
				$rControl['gen_control_requirements'][$k]=array(
					'name'=>$reqName
				);
				if(!empty($data['RbControlRequirements']['id'][$k])){
					$rControl['gen_control_requirements'][$k]['id']=$data['RbControlRequirements']['id'][$k];
				}
			}
			
			//re-configure the save strategy if any of the associated record is deleted
			$this->GenControls->association('GenControlRequirements')->saveStrategy('replace');
			
			$gControl = TableRegistry::get('GenControls');
			$entity = $gControl->patchEntity($genControl,$rControl,array(
				'associated'=>array(
					'GenControlRequirements'
				)
			));
			//debug($entity);
			
			if($gControl->save($entity)){
				$this->Flash->success(__('The Control Area for Generalized Assessments has been saved.'));
                return $this->redirect(['action' => 'index']);
			}
			
          	/*
            $genControl = $this->GenControls->patchEntity($genControl, $this->request->getData());
              if ($this->GenControls->save($genControl)) {
                  $this->Flash->success(__('The gen control has been saved.'));
  
                  return $this->redirect(['action' => 'index']);
              }*/
          
            $this->Flash->error(__('The gen control could not be saved. Please, try again.'));
        }
        //debug($genControl);
        $this->set(compact('genControl'));
    }


	//risk control mapping masters
	public function rcmappings(){
		
		if($this->request->is(['put','post'])){
			$data = $this->request->getData();
			debug($data);
			
			$fdata = array();
			foreach($data as $map=>$value){
				$mid = explode('~',$map);
				$mid = end($mid);
				$fdata[] = [
					'id'=>$mid,
					'mapping'=>$value,
					'status'=>'Mapped'
				];
					
			}
			//debug($fdata);
			
			$rcMaping = TableRegistry::get('FfiecMasterRcMappings');
			$rcentities = $rcMaping->patchEntities($fdata,$fdata);
			//debug($rcentities);
			
			$result4 = $rcMaping->saveMany($rcentities);
			
			if($result4){
				$this->Flash->success("Successfully Updated. ");
				
			} else {
				$this->Flash->error("Sorry! Not Successful. Try again.");
			}
			return $this->redirect(['controller'=>'FfiecDomains','action'=>'rcmappings']);
			
			
		}
		
		
		
		//loading gen_rc_mappings table / model
		$this->loadModel('FfiecMasterRcMappings');
		$rcMapping = $this->FfiecMasterRcMappings->find('all',[
			'contain'=>['FfiecRisks','FfiecDomains']
		])->all();
		//debug($rcMapping);
		$table = array();
		$cols=array();
		$colids = array();
		
		foreach($rcMapping as $k=>$map){
			$table[$map->ffiec_domain->name][$map->ffiec_risk->id]= $map;
			$colids[] = $map->ffiec_risk->id;
			$cols[]=$map->ffiec_risk->name;
		}
		
		$colids=array_unique($colids);
		$cols=array_unique($cols);
		
		$this->set('table',$table);
		$this->set('risks',$cols);
		$this->set('risk_ids',$colids);
		
	}


    /**
     * Delete method
     *
     * @param string|null $id Gen Control id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $genControl = $this->GenControls->get($id);
        if ($this->GenControls->delete($genControl)) {
            $this->Flash->success(__('The gen control has been deleted.'));
        } else {
            $this->Flash->error(__('The gen control could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
