<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 *
 * @method \App\Model\Entity\Question[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionsController extends AppController
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
		$this->set('pageHeading','Questions for Questionnaires');
		//$this->viewBuilder()->setLayout('admin');
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Questions->find('all',[
    		'contain'=>['QuestionOptions']
    	]);
   		$questions = $this->paginate($query);
        $this->set(compact('questions'));
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['QuestionOptions']
        ]);

        $this->set('question', $question);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
        	$data = $this->request->getData();
			$qOptions = $data['QuestionOptions'];
			unset($data['QuestionOptions']);
			foreach($qOptions['name'] as $option){
				$data['question_options'][]=[
					'name'=>$option
				];
			}
		
			$questions = TableRegistry::get('Questions');
			$question = $questions->newEntity($data, [
			    'associated' => ['QuestionOptions']
			]);
			$question->dirty('QuestionOptions', true);
			
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
	     }
        $this->set(compact('question'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id,[
        	'contain'=>['QuestionOptions']
        ]);
        if ($this->request->is(['post','put'])) {
        	$data = $this->request->getData();
			
			$qOptions = $data['QuestionOptions'];
			unset($data['QuestionOptions']);
			foreach($qOptions['name'] as $key=>$option){
				if(empty($qOptions['id'][$key])){
					$data['question_options'][]=[
						'name'=>$option
					];
				} else {
					$data['question_options'][]=[
						'id'=>$qOptions['id'][$key],
						'question_id'=>$qOptions['question_id'][$key],
						'name'=>$option
					];
				}
				
			}
		
			$questions = TableRegistry::get('Questions');
			$question = $questions->patchEntity($question,$data, [
			    'associated' => ['QuestionOptions']
			]);
			$question->dirty('QuestionOptions', true);
			
			//re-configure the save strategy if any of the associated record is deleted
			$this->Questions->association('QuestionOptions')->saveStrategy('replace');
			
			
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
			
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
	     }
		
        $this->set(compact('question'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
