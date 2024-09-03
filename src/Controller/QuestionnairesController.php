<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Questionnaires Controller
 *
 * @property \App\Model\Table\QuestionnairesTable $Questionnaires
 *
 * @method \App\Model\Entity\Questionnaire[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionnairesController extends AppController
{
	
	public function isAuthorized($user){
		if($user['role']=="Company"){
			return true;
		} else {
			return false;
		}
		
	}
	public function initialize(){
		parent::initialize();
		$this->set('pageHeading','Questionnaires for Employees');
		//$this->viewBuilder()->setLayout('admin');
	}
	
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
   public function index()
    {
        $this->paginate = [
            'contain' => ['Employees'],
            'conditions'=>['Employees.company_id'=>$this->Auth->user('id')]
        ];
		
        $questionnaires = $this->paginate($this->Questionnaires);
		$quests = array();
		$questions = array();
		$this->loadModel('Questions');
		foreach($questionnaires as $quest){
			$questions[] = $this->Questions->find('all',array(
				'conditions'=>array(
					"Questions.id in (".$quest->questions.")"
				),
			))->all();
			$quest->questions = $questions;
			$quests[]=[
				'questionnaire'=>$quest,
			];
		}
		
		
        $this->set(compact('questionnaires'));
    }

    /**
     * View method
     *
     * @param string|null $id Questionnaire id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionnaire = $this->Questionnaires->get($id, [
            'contain' => ['Clients', 'QuestQuestions']
        ]);

        $this->set('questionnaire', $questionnaire);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionnaire = $this->Questionnaires->newEntity();
        if ($this->request->is('post')) {
        	$data = $this->request->getData();
			$questions = $data['questions'];
			unset($data['questions']);
			$data['questions']="";
			foreach($questions as $qid){
				$data['questions'] .= $qid.",";
			}
			$data['questions'] = substr($data['questions'],0,-1);
			
            $questionnaire = $this->Questionnaires->patchEntity($questionnaire, $data);
			//debug($questionnaire);
			
            if ($this->Questionnaires->save($questionnaire)) {
            	/*
				if($this->Auth->user('assessment_status')=='Locked'){
					$this->Session->write('Auth.User.assessment_status','Unlocked');
				}
				*/
                $this->Flash->success(__('The questionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The questionnaire could not be saved. Please, try again.'));
            
            
        }
        $employees = $this->Questionnaires->Employees->find('list', ['conditions'=>array('Employees.company_id'=>$this->Auth->user('id'))]);
		
		$this->loadModel('Questions');
		$questions = $this->Questions->find('list');
        $this->set(compact('questionnaire', 'employees','questions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Questionnaire id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
       $questionnaire = $this->Questionnaires->get($id);
        if ($this->request->is(['post','put'])) {
        	$data = $this->request->getData();
			$questions = $data['questions'];
			unset($data['questions']);
			$data['questions']="";
			foreach($questions as $qid){
				$data['questions'] .= $qid.",";
			}
			$data['questions'] = substr($data['questions'],0,-1);
			
            $questionnaire = $this->Questionnaires->patchEntity($questionnaire, $data);
			//debug($questionnaire);
			
            if ($this->Questionnaires->save($questionnaire)) {
                $this->Flash->success(__('The questionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The questionnaire could not be saved. Please, try again.'));
            
            
        }
        $employees = $this->Questionnaires->Employees->find('list', ['conditions'=>array('Employees.role'=>'Employee'),'limit' => 200]);
		$questionnaire->questions = explode(',',$questionnaire->questions); 
		$this->loadModel('Questions');
		$questions = $this->Questions->find('list');
        $this->set(compact('questionnaire', 'employees','questions'));
		//debug($questionnaire);
    }

    /**
     * Delete method
     *
     * @param string|null $id Questionnaire id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionnaire = $this->Questionnaires->get($id);
        if ($this->Questionnaires->delete($questionnaire)) {
            $this->Flash->success(__('The questionnaire has been deleted.'));
        } else {
            $this->Flash->error(__('The questionnaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
