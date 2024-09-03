<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MaturityAttributes Controller
 *
 * @property \App\Model\Table\MaturityAttributesTable $MaturityAttributes
 *
 * @method \App\Model\Entity\MaturityAttribute[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MaturityAttributesController extends AppController
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
		$this->set('pageHeading','Maturity Attributes Master');
	}
	
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $maturityAttributes = $this->paginate($this->MaturityAttributes);

        $this->set(compact('maturityAttributes'));
    }

    /**
     * View method
     *
     * @param string|null $id Maturity Attribute id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $maturityAttribute = $this->MaturityAttributes->get($id, [
            'contain' => []
        ]);

        $this->set('maturityAttribute', $maturityAttribute);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $maturityAttribute = $this->MaturityAttributes->newEntity();
        if ($this->request->is('post')) {
            $maturityAttribute = $this->MaturityAttributes->patchEntity($maturityAttribute, $this->request->getData());
            if ($this->MaturityAttributes->save($maturityAttribute)) {
            	
				//updating maturity attribute option description table
            	$this->loadModel('MaturityAttributeOptions');
				$this->loadModel('MaturityDescriptions');
				$mDescs=[];
				$maOptions = $this->MaturityAttributeOptions->find('all')->all();
				foreach($maOptions as $maOption){
					$mDescs[]=[
						'ma_id'=>$maturityAttribute->id,
						'mao_id'=>$maOption->id
					];
				}
				if(!empty($mDescs)){
					$mDesc = $this->MaturityDescriptions->patchEntities($mDescs,$mDescs);
					$this->MaturityDescriptions->saveMany($mDesc);
				}
				//updating maturity descriptions table ends here.
				
                $this->Flash->success(__('The maturity attribute has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maturity attribute could not be saved. Please, try again.'));
        }
        $this->set(compact('maturityAttribute'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Maturity Attribute id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $maturityAttribute = $this->MaturityAttributes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $maturityAttribute = $this->MaturityAttributes->patchEntity($maturityAttribute, $this->request->getData());
            if ($this->MaturityAttributes->save($maturityAttribute)) {
                $this->Flash->success(__('The maturity attribute has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maturity attribute could not be saved. Please, try again.'));
        }
        $this->set(compact('maturityAttribute'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Maturity Attribute id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $maturityAttribute = $this->MaturityAttributes->get($id);
        if ($this->MaturityAttributes->delete($maturityAttribute)) {
            $this->Flash->success(__('The maturity attribute has been deleted.'));
        } else {
            $this->Flash->error(__('The maturity attribute could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
