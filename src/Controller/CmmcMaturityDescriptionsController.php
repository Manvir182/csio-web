<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CmmcMaturityDescriptionsController extends AppController
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
		$this->set('pageHeading','Maturity Attributes Descriptions');
		$this->viewBuilder()->setLayout('admin');
		
		$this->Security->setConfig('unlockedActions', ['index']);
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
    	
        $mDescs = $this->CmmcMaturityDescriptions->find('all',[
			'contain'=>['CmmcMaturityAttributes','CmmcMaturityAttributeOptions']
		])->all();
		
		if($this->request->is(['put','post'])){
			$data = $this->request->getData();
			$mdata=[];
			foreach($data['id'] as $k=>$id){
				$mdata[]=[
					'id'=>$id,
					'description'=>$data['description'][$k]
				];
			}
			
			$mDescs = $this->CmmcMaturityDescriptions->patchEntities($mDescs,$mdata);
			$this->CmmcMaturityDescriptions->saveMany($mDescs);
			$this->redirect($this->referer());
		}
		
		
		
		
		
		$descs = [];
		foreach($mDescs as $k=>$val){
			$descs[$val->cmmc_maturity_attribute->id][$val->cmmc_maturity_attribute_option->id] = [
				'mdesc_id'=>$val->id,
				'moption'=>$val->cmmc_maturity_attribute_option->name,
				'moption_score'=>$val->cmmc_maturity_attribute_option->score,
				'mattr'=>$val->cmmc_maturity_attribute->name,
				'description'=>$val->description
			];
		}
		
		
		
		
		
		$this->set('descs',$descs);
    }

    
}
