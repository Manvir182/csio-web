<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

	public function isAuthorized($user){
		if($user['role']=="Super Admin"){
			return true;
		} else {
			if($user['role']=='Company' && (($this->request->getParam('action')=='changePassword') || ($this->request->getParam('action')=='myProfile'))){
				return true;
			} else {
				return false;
			}
		}


	}
	public function initialize(){
		parent::initialize();
		$this->Auth->allow(['forgotPassword','resetPassword']);
		$this->Auth->setConfig('authenticate', [
	            'Form' => [
	                'finder' => 'super',
	                'fields' => ['username' => 'email', 'password' => 'password']
	            ]
	        ]
		);


		if($this->Auth->user('role')=='Super Admin'){
			$this->set('pageHeading','Super Admin');
		} else {
			$this->set('pageHeading',$this->Auth->user('company_name'));
		}

		$this->viewBuilder()->setLayout('admin');

	}

	public function dashboard(){
		$this->set('pageHeading','Dashboard');

		$this->loadModel('MaturityDescriptions');
		$a = $this->MaturityDescriptions->find('all',[
			'contain'=>['MaturityAttributes','MaturityAttributeOptions']
		])->all();

		//debug($a);

		$descs = [];
		foreach($a as $k=>$val){
			$descs[$val->maturity_attribute_option->id][$val->maturity_attribute->id] = [
				'mdesc_id'=>$val->id,
				'moption'=>$val->maturity_attribute_option->name,
				'moptoin_score'=>$val->maturity_attribute_option->score,
				'mattr'=>$val->maturity_attribute->name,
				'description'=>$val->description
			];
		}

		//debug($descs);
		$this->set('descs',$descs);

		$manualCompanies = $this->Users->find()
							->where(['Users.source'=>'Admin','Users.role'=>'Company'])
							->count();
		$regCompanies = $this->Users->find()
							->where(['Users.source'=>'Registration','Users.role'=>'Company'])
							->count();
		$this->set(compact('manualCompanies','regCompanies'));
	}

	// public function login(){
	// 	$this->viewBuilder()->setLayout('ajax');

	// 	if ($this->request->is('post')) {
	//         $user = $this->Auth->identify();
	//         if ($user) {
	//             $this->Auth->setUser($user);
	// 			if($user['role']=='Super Admin'){
	// 				return $this->redirect(array('controller'=>'users','action'=>'dashboard','_full' => true));
	// 			} elseif($user['role']=='Company'){
	// 				return $this->redirect(array('controller'=>'companies','action'=>'dashboard','_full' => true));
	// 			} else {
	// 				return $this->redirect(array('controller'=>'lab','action'=>'dashboard','_full' => true));
	// 			}
	//         }
	//         $this->Flash->error('Your username or password is incorrect.');
	//     }
	// }
	public function login(){
		$this->viewBuilder()->setLayout('ajax');

		if ($this->request->is('post')) {
	        $user = $this->Auth->identify();
			if ($user)
			{
				$phone_no = $user['contcode'].$user['phone'];
				$sendOtp = $this->Otp->sendOtp($phone_no);
				if($sendOtp == 201){
					$this->request->getSession()->write('user.id',$user['id']);
					return $this->redirect(array('controller'=>'otp','action'=>'OtpVerification'));
				}else{
					$this->Flash->error('Sorry! we are facing some problems in sending OTP. Please Try again.');
				}
	        }else{
				$this->Flash->error('Your username or password is incorrect.');
			}
	    }
	}

	public function logout(){
	    //$this->Flash->success('You are now logged out.');
	    $this->Auth->logout();
	    return $this->redirect(['controller'=>'pages','action'=>'cisohome']);
	}

	public function changePassword(){
		$user = $this->Users->newEntity();
		if($this->request->is(array('post','put'))){
			$data = $this->request->getData();
			$user = $this->Users->get($this->Auth->user('id'));
			$verify = $this->confirmPassword($data['current_password'],$user);
			$status = preg_match("/^((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,100})$/", $data['new_password']);
			if($verify==true){
				if($status==1){
					$udata['password'] = $data['new_password'];
					$user = $this->Users->patchEntity($user,$udata);
					if($this->Users->save($user)){
						$this->Flash->success('Password successfully changed.');
					} else {
						$this->Flash->error("Not successful. Try agian.");
					}
				} else {
					$this->Flash->error("Sorry! Invalid Password provided.");
				}

			} else {
				$this->Flash->error("Sorry! Current Password does not matched.");
			}
			return $this->redirect(array('action'=>'changePassword'));
		}
		$this->set(compact('user'));
	}

	public function myProfile(){

		$user = $this->Users->get($this->Auth->user('id'));

		if($this->request->is(array('put','post'))){
			$data = $this->request->getData();
			$photoFlag = "";
			$uPhoto = false;
			if(!empty($data['photo']['name'])){
				$ext = explode('.',$data['photo']['name']);
				$ext = end($ext);

				$awsPath = 'profile_pics/'.$data['username'].$this->Auth->user('id').".".$ext;
				$photo = $this->aws->putObject($awsPath,$data['photo']['tmp_name']);
				if($photo['status']=='200'){
					$data['photo'] = $photo['url'];
					$photoFlag = " Profile photo updated.";
					$this->Auth->user('photo',$data['photo']);
				} else {
					unset($data['photo']);
					$photoFlag = " But profile photo not updated.";
				}
			} else {
				unset($data['photo']);
			}

			$updatedUser = $this->Users->patchEntity($user,$data);
			if($this->Users->save($updatedUser)){
				if(strlen($photoFlag)>0){
					$session = $this->getRequest()->getSession();
					$session->write('Auth.user.photo',$updatedUser['photo']);
				}
				$this->Flash->success('Updated Successfully. '.$photoFlag);
				return $this->redirect(array('action'=>'myProfile'));


			} else {
				$this->Flash->success('Sorry! Not updated. Try again. '.$photoFlag);
			}
		}

		$this->set('pageHeading','My Profile');
		$this->set(compact('user'));

	}

	public function forgotPassword(){
		if($this->request->is(array('post'))){
			$this->loadModel('Users');
			$data = $this->request->getData();
			$email = $data['company_email'];

			$token = md5(str_shuffle($email.time().$this->Auth->user('username')));
			$expiry = date('Y-m-d H:i:s',strtotime('+24 hours'));
			$user = $this->Users->find('all',array(
				'conditions'=>array(
					'Users.email'=>$email,
					'Users.role'=>'Super Admin',
				)
			))->first();

			if(empty($user)){
				$this->Flash->error("Sorry! Account with this Email does not exists or active.");
			} else {
				$pdata = array('password_reset_token'=>$token,'token_expiry_date'=>$expiry);
				$user = $this->Users->patchEntity($user,$pdata);
				if($this->Users->save($user)){
					$uemail = $email;

					$email = new Email('Sendgrid');
					$email->setFrom(['info@thecloudciso.com' => 'Reset Password - THE CLOUD CISO'])
					    ->setTo($uemail)
					    ->setSubject("Reset Password - THE CLOUD CISO")
					    ->setViewVars($pdata)
						->setEmailFormat('html')
						->viewBuilder()->setTemplate('resetpasswordforsuper');
					$email->viewBuilder()->setLayout('cisolayout');

				    $resp = $email->send();


					if($resp['message']=='success'){
						$this->Flash->success("We have sent an email with reset password link. Kindly check your inbox.");
						$this->redirect(array('_name'=>'superadmin-login'));
					} else {
						$this->Flash->error("Sorry! Something went wrong. Kindly try again.");
					}
				}
			}

		}


		$this->viewBuilder()->setLayout('ajax');
	}

	public function resetPassword($token=null){
		$this->viewBuilder()->setLayout('ajax');
		$this->loadModel('Users');

		$user = $this->Users->find('all',array(
			'conditions'=>array(
				'Users.password_reset_token'=>$token,
				'Users.token_expiry_date > '=>date('Y-m-d H:i:s')
			)
		))->first();

		if(empty($user)){
			$this->set('status','invalid');
			$this->Flash->error("Sorry! Invalid or Expired Token. Kindly re-submit the password reset request.");
			return $this->redirect(array('controller'=>'users','action'=>'forgotPassword'));
		}

		if($this->request->is('post')){
			$posted = $this->request->getData();
			$nuser = $this->Users->find('all',array(
				'conditions'=>array(
					'Users.password_reset_token'=>$token,
					'Users.token_expiry_date > '=>date('Y-m-d H:i:s')
				)
			))->first();
			if(empty($nuser)){
				$this->set('status','invalid');
				$this->Flash->error("Sorry! Invalid or Expired Token. Kindly re-submit the password reset request.");
				return $this->redirect(array('controller'=>'companies','action'=>'forgotPassword'));
			} else {
				if($posted['npassword']!==$posted['cpassword']){
					$this->Flash->error("Sorry! Passwords does not matched. Try again.");
				} else {
					$status = preg_match("/^((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,100})$/", $posted['npassword']);
					if($status==1){
						$udata['password'] = $posted['npassword'];
						$nuser = $this->Users->patchEntity($nuser,$udata);
						if($this->Users->save($nuser)){
							$this->Flash->success("Successfully Changed your password.");
							return $this->redirect(array('_name'=>'superadmin-login'));
						} else {
							return $this->Flash->error("Sorry! Something went wrong. Kindly try forgot password again.");
							//return $this->redirect(array('controller'=>'companies','action'=>'forgotPassword'));
						}
					} else {
						return $this->Flash->error("Sorry! Invalid Password. Kindly check and try again.");
					}

				}

			}

		}

	}



    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'conditions' => [
            	'Users.role'=>'Super Admin'
            ]
        ];
        $users = $this->paginate($this->Users);
		$this->set('pageHeading','Super Admin Users');
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
    	$this->redirect($this->referer());
    	/*
        $user = $this->Users->get($id, [
            'contain' => ['Companies', 'Departments', 'AcrStatuses', 'AssessmentStatuses', 'LoginHistory', 'Questionnaires']
        ]);

        $this->set('user', $user);
        */
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->role="Super Admin";

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The Suer Admin user account has been created.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Not Successful. Please, try again.'));
        }
        $this->set('pageHeading','Add New Super Admin');
		$this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
		$user->password = "";
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(),['validate' => 'update']);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Super Admin has been updated.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Not Successful. Please, try again.'));
        }
       $this->set('pageHeading','Edit Super Admin');
        $this->set(compact('user'));
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
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Super Admin has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


	public function confirmPassword($inputPassword,$user){
	      return (new DefaultPasswordHasher)->check($inputPassword,$user->password);
	}
}
