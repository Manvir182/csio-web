<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * QuestionOptions Controller
 *
 * @property \App\Model\Table\QuestionOptionsTable $QuestionOptions
 *
 * @method \App\Model\Entity\QuestionOption[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionOptionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Questions']
        ];
        $questionOptions = $this->paginate($this->QuestionOptions);

        $this->set(compact('questionOptions'));
    }

    /**
     * View method
     *
     * @param string|null $id Question Option id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionOption = $this->QuestionOptions->get($id, [
            'contain' => ['Questions']
        ]);

        $this->set('questionOption', $questionOption);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionOption = $this->QuestionOptions->newEntity();
        if ($this->request->is('post')) {
            $questionOption = $this->QuestionOptions->patchEntity($questionOption, $this->request->getData());
            if ($this->QuestionOptions->save($questionOption)) {
                $this->Flash->success(__('The question option has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question option could not be saved. Please, try again.'));
        }
        $questions = $this->QuestionOptions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('questionOption', 'questions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question Option id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionOption = $this->QuestionOptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionOption = $this->QuestionOptions->patchEntity($questionOption, $this->request->getData());
            if ($this->QuestionOptions->save($questionOption)) {
                $this->Flash->success(__('The question option has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question option could not be saved. Please, try again.'));
        }
        $questions = $this->QuestionOptions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('questionOption', 'questions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question Option id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionOption = $this->QuestionOptions->get($id);
        if ($this->QuestionOptions->delete($questionOption)) {
            $this->Flash->success(__('The question option has been deleted.'));
        } else {
            $this->Flash->error(__('The question option could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
