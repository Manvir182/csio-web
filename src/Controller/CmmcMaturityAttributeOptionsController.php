<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MaturityAttributeOptions Controller
 *
 * @property \App\Model\Table\MaturityAttributeOptionsTable $MaturityAttributeOptions
 *
 * @method \App\Model\Entity\MaturityAttributeOption[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CmmcMaturityAttributeOptionsController extends AppController
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
		$this->set('pageHeading','Maturity Attributes Options Master');
	}
	
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $maturityAttributeOptions = $this->paginate($this->CmmcMaturityAttributeOptions);

        $this->set(compact('maturityAttributeOptions'));
    }

    /**
     * View method
     *
     * @param string|null $id Maturity Attribute Option id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $maturityAttributeOption = $this->CmmcMaturityAttributeOptions->get($id, [
            'contain' => []
        ]);

        $this->set('maturityAttributeOption', $maturityAttributeOption);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $maturityAttributeOption = $this->CmmcMaturityAttributeOptions->newEntity();
        if ($this->request->is('post')) {
            $maturityAttributeOption = $this->CmmcMaturityAttributeOptions->patchEntity($maturityAttributeOption, $this->request->getData());
            if ($this->CmmcMaturityAttributeOptions->save($maturityAttributeOption)) {
            	
				//updating maturity attribute option description table
            	$this->loadModel('CmmcMaturityAttributes');
				$this->loadModel('CmmcMaturityDescriptions');
				$mDescs=[];
				$maOptions = $this->CmmcMaturityAttributes->find('all')->all();
				foreach($maOptions as $maOption){
					$mDescs[]=[
						'ma_id'=>$maOption->id,
						'mao_id'=>$maturityAttributeOption->id
					];
				}
				if(!empty($mDescs)){
					$mDesc = $this->CmmcMaturityDescriptions->patchEntities($mDescs,$mDescs);
					$this->CmmcMaturityDescriptions->saveMany($mDesc);
				}
				//updating maturity descriptions table ends here.
				
				
				
				
                $this->Flash->success(__('The maturity attribute option has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maturity attribute option could not be saved. Please, try again.'));
        }
        $this->set(compact('maturityAttributeOption'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Maturity Attribute Option id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $maturityAttributeOption = $this->CmmcMaturityAttributeOptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $maturityAttributeOption = $this->CmmcMaturityAttributeOptions->patchEntity($maturityAttributeOption, $this->request->getData());
            if ($this->CmmcMaturityAttributeOptions->save($maturityAttributeOption)) {
                $this->Flash->success(__('The maturity attribute option has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maturity attribute option could not be saved. Please, try again.'));
        }
        $this->set(compact('maturityAttributeOption'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Maturity Attribute Option id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $maturityAttributeOption = $this->CmmcMaturityAttributeOptions->get($id);
        if ($this->CmmcMaturityAttributeOptions->delete($maturityAttributeOption)) {
            $this->Flash->success(__('The maturity attribute option has been deleted.'));
        } else {
            $this->Flash->error(__('The maturity attribute option could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
