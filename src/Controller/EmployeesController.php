<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
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
		$this->set('pageHeading','Employees');
		//$this->viewBuilder()->setLayout('admin');
	}
	
	
    public function index()
    {
    	//$query = $this->Employees->find('all')->where(['Employees.role'=>'Employee','Employees.company_id'=>$this->Auth->user('id')]);
		$query = $this->Employees->find('all',[
			'contain'=>[
				'Departments','Companies'
			],
			'conditions'=>[
				'Employees.role'=>'Employee','Employees.company_id'=>$this->Auth->user('id'),
				"Employees.registration_status != 'Deleted'"
			]
		]);
        
		$users = $this->paginate($query);
		//debug($users);
        $this->set(compact('users'));
    }
	
   
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['Companies','Departments']
        ]);
		if($employee->company_id!=$this->Auth->user('id')){
			$this->Flash->error(__('This Employee Does not belongs to this company.'));
			return $this->redirect($this->referer());
		}
		//debug($employee);
        $this->set('company', $employee);
		
    }

   
    public function add()
    {
    	//$this->loadModel('Departments');
    	$departments = $this->Employees->Departments->find('list');
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
        	$cdata = $this->Employees->find('all',array(
				'fields'=>array(
					'company_code'=>'(MAX(Employees.id)+10000+1)'
				)
			))->first();
			$company_code = "E".$cdata->company_code;
			
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
			$employee->company_id = $this->Auth->user('id');
			$employee->role = "Employee";
			$employee->copany_code = $company_code;
			
			if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The Employee has been saved.'));

                return $this->redirect(['action' => 'view',$employee->id]);
            }
            $this->Flash->error(__('The Employee could not be saved. Please, try again.'));
			
        }
		
        $this->set(compact('employee','departments'));
    }

   
    public function edit($id = null)
    {
    	$this->loadModel('Departments');
    	$departments = $this->Departments->find('list');
		
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
			
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The Employee has been modified.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Employee could not be updated. Please, try again.'));
        }
		$employee->password = "";
		
        $this->set(compact('employee','departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Employees->get($id);
		$user->registration_status = "Deleted";
        if ($this->Employees->save($user)) {
            $this->Flash->success(__('The Employee has been deleted.'));
        } else {
            $this->Flash->error(__('The Employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
