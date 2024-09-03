<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;
/**
 * RegulatoryBodies Controller
 *
 * @property \App\Model\Table\RegulatoryBodiesTable $RegulatoryBodies
 *
 * @method \App\Model\Entity\RegulatoryBody[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegulatoryBodiesController extends AppController
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
		$this->set('pageHeading','Regulatory Bodies Master');

		$this->Security->setConfig('unlockedActions', ['add','edit','view','saveRegulatoryControls','deleteRegulatoryControl']);

	}


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */


    public function index()
    {
    	$this->paginate = [
	        'contain' => ['RbRcMappings'=>function($q) {
			    $q->select([
			         'RbRcMappings.rb_id',
			         'pendings' => $q->func()->count('RbRcMappings.rb_id')
			    ])->where(['RbRcMappings.status'=>'Pending'])
			    ->group(['RbRcMappings.rb_id']);

			    return $q;
	        },'Activities']
	    ];
        $regulatoryBodies = $this->paginate($this->RegulatoryBodies);
		//debug($regulatoryBodies);
        $this->set(compact('regulatoryBodies'));
    }

    /**
     * View method
     *
     * @param string|null $id Regulatory Body id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null,$status=null){

		if($this->request->is(['put','post'])){
			$data = $this->request->getData();


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
			$rcMaping = TableRegistry::get('RbRcMappings');
			$rcentities = $rcMaping->patchEntities($fdata,$fdata);

			//debug($rcentities);

			$result4 = $rcMaping->saveMany($rcentities);

			if($result4){
				$this->Flash->success("Successfully Updated. ");

			} else {
				$this->Flash->error("Sorry! Not Successful. Try again.");
			}

			return $this->redirect(['controller'=>'RegulatoryBodies','action'=>'view',$id]);

		}

		//loading gen_rc_mappings table / model
		$this->loadModel('RbRcMappings');
		$rcMapping = $this->RbRcMappings->find('all',[
			'conditions'=>['rb_id'=>$id],
			'contain'=>['Risks','RbControls']
		])->all();

		$table = array();
		$cols=array();
		$colids = array();

		foreach($rcMapping as $k=>$map){
			$table[$map->rb_control->name][$map->risk->id]= $map;
			$colids[] = $map->risk->id;
			$cols[]=$map->risk->name;
		}

		$colids=array_unique($colids);
		$cols=array_unique($cols);

		$this->set('table',$table);
		$this->set('risks',$cols);
		$this->set('risk_ids',$colids);
		//debug($table);

		$regulatoryBody = $this->RegulatoryBodies->get($id, [
            'contain' => ['RbControls.RbControlRequirements','Activities']
        ]);
        $this->set('regulatoryBody', $regulatoryBody);
		//debug($rcMapping);
		//setting entity for new control area
		$this->loadModel('RbControls');
		$this->set('rControl',$this->RbControls->newEntity());
		$this->set('status',$status);


    }
	public function makeDuplicate($id=null){

		if(empty($id) || is_null($id)){
			$this->Flash->error("Sorry! Invalid Regulatory Body. Try again.");
			return $this->redirect($this->referer());
		}

		$this->request->allowMethod(['post']);



		$testRegu = $this->RegulatoryBodies->get($id, [
            'contain' => ['RbControls.RbControlRequirements','RbControls.RbRcMappings']
        ]);

		$tRegu = [
			'activity_id'=>$testRegu->activity_id,
			'name'=>$testRegu->name
		];

		foreach($testRegu->rb_controls as $k=>$trbcontrol){
			$tRegu['rb_controls'][$k]=[
				'name'=>$trbcontrol->name,
				'control_number'=>$trbcontrol->control_number,
				'description'=>$trbcontrol->description
			];
			foreach($trbcontrol->rb_rc_mappings as $trbmapping){
				$tRegu['rb_controls'][$k]['rb_rc_mappings'][]=[
					'risk_id'=>$trbmapping->risk_id,
					'mapping'=>$trbmapping->mapping,
					'status'=>$trbmapping->status
				];
			}
			foreach($trbcontrol->rb_control_requirements as $trbcreq){
				$tRegu['rb_controls'][$k]['rb_control_requirements'][]=[
					'name'=>$trbcreq->name,
					'req_number'=>$trbcreq->req_number,
					'description'=>$trbcreq->description
				];
			}

		}

		$rEntity = $this->RegulatoryBodies->newEntity($tRegu,[
			'associated'=>['RbControls.RbControlRequirements','RbControls.RbRcMappings']
		]);


		//savingn regulatory body with controls and requirements
		$rstatus = $this->RegulatoryBodies->save($rEntity);
		if($rstatus){
			//getting db instance
			$connection = ConnectionManager::get('default');
			//getting control id (PKs) from regulatory body controls
			$results = $connection->execute("select group_concat(id) as controlIds from rb_controls
			 where regulatory_body_id='".$rEntity->id."'")->fetch('assoc');
			//updating mapping for Regulatory Body
			$results = $connection->execute("update rb_rc_mappings set rb_id='".$rEntity->id."'
			 where control_id in (".$results['controlIds'].")");

			 $this->Flash->success("Successfully Created Duplicate Regulatory Body. ");
		} else {
			$this->Flash->error("Sorry! Not Successful. Try again.");
		}

		return $this->redirect(['action'=>'view',$rEntity->id]);

	}
	public function getControlForm($id=null){
		$this->viewBuilder()->setLayout(false);

		$this->loadModel('RbControls');
		if($id==null){
			$rControl = $this->RbControls->newEntity();
		} else {
			$rControl = $this->RbControls->get($id,[
				'contain'=>['RbControlRequirements']
			]);
		}

		$this->set(compact('rControl'));
	}

	//ajax action for saving control and control requirements
	public function saveRegulatoryControls(){
		$this->viewBuilder()->setLayout(false);
		$this->autoRender = false;

		//$this->request->allowMethod(['post', 'delete']);
		$data = $this->request->getData();

		$this->loadModel('RbControls');
		//debug($data);
		if(empty($data['id'])){
			$rControl = $this->RbControls->newEntity();
		} else {
			$rControl = $this->RbControls->get($data['id'],[
				'contain'=>['RbControlRequirements']
			]);
		}
		//debug($data);
		$rdata=[
			'regulatory_body_id'=>$data['rb_id'],
			'name'=>$data['RbControls']['name'][0],
			'control_number'=>$data['RbControls']['control_number'][0],
			'guidance'=>$data['RbControls']['guidance'][0],
			'description'=>$data['RbControls']['description'][0]
		];

		$reqs = $data['RbControlRequirements'];
		//debug($reqs);

		foreach($reqs[0]['name'] as $i=>$rname){
			if(empty($reqs[0]['id'][$i])){
				$rdata['rb_control_requirements'][]=array(
					'name'=>$rname,
					'req_number'=>$reqs[0]['req_number'][$i],
				);
			} else {
				$rdata['rb_control_requirements'][]=array(
					'id'=>$reqs[0]['id'][$i],
					'name'=>$rname,
					'req_number'=>$reqs[0]['req_number'][$i],
				);
			}
		}



		$this->RbControls->association('RbControlRequirements')->saveStrategy('replace');

		$rControl = $this->RbControls->patchEntity($rControl,$rdata,[
			'associated'=>['RbControlRequirements']
		]);


		$result = $this->RbControls->save($rControl);
		//debug($rControl);
		if($result){
			//creating record in rc mapping
			if(empty($data['id'])){
				$conn = ConnectionManager::get('default');
				$mapQuery = "INSERT INTO rb_rc_mappings (rb_id,risk_id, control_id, `status`)
							 SELECT gc.regulatory_body_id AS rb_id, r.id AS risk_id, gc.id AS control_id, 'Pending' AS `status` FROM risks r, rb_controls gc WHERE gc.regulatory_body_id='".$data['rb_id']."' and gc.id='".$rControl->id."'";
				$stmt = $conn->query($mapQuery);
			}
			$this->Flash->success(__('Control Area successfully updated.'));
        } else {
			$this->Flash->error(__('Not Successful. Try again.'));
		}
		return $this->redirect(['action' => 'view',$rControl->regulatory_body_id,$rControl->id]);


	}


	 public function deleteRegulatoryControl($id = null){
        $this->request->allowMethod(['post', 'delete']);
		$this->loadModel('RbControls');
        $rbControl = $this->RbControls->get($id);
        if ($this->RbControls->delete($rbControl)) {
            $this->Flash->success(__('The Control Area has been deleted.'));
        } else {
            $this->Flash->error(__('The Control Area could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
     public function add() {
        $regulatoryBody = $this->RegulatoryBodies->newEntity();

        if ($this->request->is('post')) {
        	$data = $this->request->getData();

			//*creating formatted data to associated insertion
			$rdata = array(
				'name'=>$data['name'],
				'activity_id'=>$data['activity_id']
			);

			$rb = TableRegistry::get('RegulatoryBodies');
			$entity = $rb->newEntity($rdata);
			//data formatting ends here


			$thisBody = $this->RegulatoryBodies->save($entity);

			if($thisBody){
				/*
				$conn = ConnectionManager::get('default');
				$mapQuery = "INSERT INTO rb_rc_mappings (rb_id,risk_id, control_id, `status`)
							 SELECT gc.regulatory_body_id AS rb_id, r.id AS risk_id, gc.id AS control_id, 'Pending' AS `status` FROM risks r, rb_controls gc WHERE gc.regulatory_body_id='".$thisBody->id."'";
				$stmt = $conn->query($mapQuery);

				*/
				$this->Flash->success(__('The regulatory body has been saved. Kindly add Controls to Regulatory Body.'));
                return $this->redirect(['action' => 'view',$thisBody->id]);
			}
			$this->Flash->error(__('The regulatory body could not be saved. Please, try again.'));



        }

		$activities = $this->RegulatoryBodies->Activities->find('list')->all();

        $this->set(compact('regulatoryBody','activities'));
    }

   	public function add_Old()
    {
        $regulatoryBody = $this->RegulatoryBodies->newEntity();

        if ($this->request->is('post')) {
        	$data = $this->request->getData();

			//*creating formatted data to associated insertion
			$rdata = array(
				'name'=>$data['name']
			);
			$controls = $data['RbControls'];
			$reqs = $data['RbControlRequirements'];

			foreach($controls['name'] as $k => $cname){
				$rdata['rb_controls'][$k]=array(
					'name'=>$cname,
					'control_number'=>$controls['control_number'][$k],
					'description'=>$controls['description'][$k]
				);
				foreach($reqs[$k]['name'] as $i=>$rname){
					$rdata['rb_controls'][$k]['rb_control_requirements'][]=array(
						'name'=>$rname,
						'req_number'=>$reqs[$k]['req_number'][$i],
					);
				}
			}

			$rb = TableRegistry::get('RegulatoryBodies');
			$entity = $rb->newEntity($rdata,array(
				'associated'=>array(
					'RbControls.RbControlRequirements'
				)
			));
			//data formatting ends here


			$thisBody = $this->RegulatoryBodies->save($entity);

			if($thisBody){

				$conn = ConnectionManager::get('default');
				$mapQuery = "INSERT INTO rb_rc_mappings (rb_id,risk_id, control_id, `status`)
							 SELECT gc.regulatory_body_id AS rb_id, r.id AS risk_id, gc.id AS control_id, 'Pending' AS `status` FROM risks r, rb_controls gc WHERE gc.regulatory_body_id='".$thisBody->id."'";
				$stmt = $conn->query($mapQuery);


				$this->Flash->success(__('The regulatory body has been saved.'));
                return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The regulatory body could not be saved. Please, try again.'));



        }

        $this->set(compact('regulatoryBody'));
    }



    /**
     * Edit method
     *
     * @param string|null $id Regulatory Body id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $regulatoryBody = $this->RegulatoryBodies->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {


        	$data = $this->request->getData();

			/*creating formatted data to associated update*/
			$rdata = array(
				'name'=>$data['name'],
				'activity_id'=>$data['activity_id']
			);



			//patching the data to be saved
			$rb = TableRegistry::get('RegulatoryBodies');
			$entity = $rb->patchEntity($regulatoryBody,$rdata);
			//debug($entity);

			$thisBody=$rb->save($entity);
			if($thisBody){
				$this->Flash->success(__('The regulatory body has been saved.'));
                return $this->redirect(['action' => 'view',$id]);
			}

            $this->Flash->error(__('The regulatory body could not be saved. Please, try again.'));

        }
        //debug($regulatoryBody);

        $activities = $this->RegulatoryBodies->Activities->find('list');

        $this->set(compact('regulatoryBody','activities'));
    }

    public function edit_old($id = null)
    {
        $regulatoryBody = $this->RegulatoryBodies->get($id, [
            'contain' => ['RbControls.RbControlRequirements']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

			//for mapping insertion
        	$existingControlIds = "";
			foreach($regulatoryBody->rb_controls as $rCont){
				$existingControlIds.="'".$rCont->id."',";
			}
			$existingControlIds = substr($existingControlIds,0,-1);
			//end for mapping insertion

        	$data = $this->request->getData();

			/*creating formatted data to associated update*/
			$rdata = array(
				'name'=>$data['name']
			);
			$controls = $data['RbControls'];
			$reqs = $data['RbControlRequirements'];
			//debug($reqs);
			foreach($controls['name'] as $k => $cname){

				$rdata['rb_controls'][$k]=array(
					'name'=>$cname,
					'control_number'=>$controls['control_number'][$k],
					'description'=>$controls['description'][$k]
				);
				if(isset($controls['id'][$k]) && !empty($controls['id'][$k])){
					$rdata['rb_controls'][$k]['id']=$controls['id'][$k];
				}

				foreach($reqs[$k]['name'] as $i=>$rname){
					$rdata['rb_controls'][$k]['rb_control_requirements'][$i]=array(
						'name'=>$rname,
						'req_number'=>$reqs[$k]['req_number'][$i],
					);

					if(isset($reqs[$k]['id'][$i]) && !empty($reqs[$k]['id'][$i])){
						$rdata['rb_controls'][$k]['rb_control_requirements'][$i]['id']=$reqs[$k]['id'][$i];
					}

				}
			}

			//re-configure the save strategy if any of the associated record is deleted
			$this->RegulatoryBodies->association('RbControls')->saveStrategy('replace');
			$this->RegulatoryBodies->RbControls->association('RbControlRequirements')->saveStrategy('replace');

			//patching the data to be saved
			$rb = TableRegistry::get('RegulatoryBodies');
			$entity = $rb->patchEntity($regulatoryBody,$rdata,array(
				'associated'=>array(
					'RbControls.RbControlRequirements'
				)
			));
			//debug($entity);
			$thisBody=$rb->save($entity);
			if($thisBody){

				$conn = ConnectionManager::get('default');
				$mapQuery = "INSERT INTO rb_rc_mappings (rb_id,risk_id, control_id, `status`)
						 SELECT gc.regulatory_body_id AS rb_id, r.id AS risk_id, gc.id AS control_id, 'Pending' AS `status` FROM risks r, rb_controls gc WHERE gc.regulatory_body_id='$id' and gc.id not in (".$existingControlIds.")";
				$stmt = $conn->query($mapQuery);

				$this->Flash->success(__('The regulatory body has been saved.'));
                return $this->redirect(['action' => 'view',$id]);
			}
        	/*
            $regulatoryBody = $this->RegulatoryBodies->patchEntity($regulatoryBody, $this->request->getData());
            if ($this->RegulatoryBodies->save($regulatoryBody)) {
                $this->Flash->success(__('The regulatory body has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
			*/
            $this->Flash->error(__('The regulatory body could not be saved. Please, try again.'));
        }
        //debug($regulatoryBody);
        $this->set(compact('regulatoryBody'));
    }

	//risk control mapping masters
	public function rcmappings(){

		if($this->request->is(['put','post'])){
			$data = $this->request->getData();
			//debug($data);

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
			$rcMaping = TableRegistry::get('GenRcMappings');
			$rcentities = $rcMaping->patchEntities($fdata,$fdata);

			$result4 = $rcMaping->saveMany($rcentities);

			if($result4){
				$this->Flash->success("Successfully Updated. ");

			} else {
				$this->Flash->error("Sorry! Not Successful. Try again.");
			}
			return $this->redirect(['controller'=>'gencontrols','action'=>'rcmappings']);


		}



		//loading gen_rc_mappings table / model
		$this->loadModel('RbRcMappings');
		$rcMapping = $this->RbRcMappings->find('all',[

			'contain'=>['Risks','RbControls']
		])->all();

		$table = array();
		$cols=array();
		$colids = array();

		foreach($rcMapping as $k=>$map){
			$table[$map->gen_control->name][$map->risk->id]= $map;
			$colids[] = $map->risk->id;
			$cols[]=$map->risk->name;
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
     * @param string|null $id Regulatory Body id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        //$regulatoryBody = $this->RegulatoryBodies->get($id);
		$rbid = $id;
		$this->loadModel('Assessments');
		//$this->loadModel('RegulatoryBodies');
		$this->loadModel('AssessmentsRegulatoryBodies');
		$aids = $this->AssessmentsRegulatoryBodies->find('all',[
			'conditions'=>[
				'regulatory_body_id'=>$rbid
			]
		])->all();

		foreach($aids as $aid){
			$a = '';
			if(!empty($aid->assessment_id)){
				$a = $this->Assessments->get($aid->assessment_id);
				$a = $this->Assessments->delete($a);
			}
		}
		$rb = $this->RegulatoryBodies->get($rbid);
		$rb = $this->RegulatoryBodies->delete($rb);
		$this->Flash->success(__('The regulatory body and related data has been deleted.'));
		/*
        if ($this->RegulatoryBodies->delete($regulatoryBody)) {
            $this->Flash->success(__('The regulatory body has been deleted.'));
        } else {
            $this->Flash->error(__('The regulatory body could not be deleted. Please, try again.'));
        }
		*/
        return $this->redirect(['action' => 'index']);
    }
}
