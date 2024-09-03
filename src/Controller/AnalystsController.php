<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
/**
 * TPRM Controller
 *
 * @property \App\Model\Table\Invitations $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AnalystsController extends AppController
{

	public function isAuthorized($user){
		if($user['role']=='Analysts'){
			return true;
		} else {
			return false;
		}
	}

	public function initialize(){
		parent::initialize();
		$this->set('pageHeading',$this->Auth->user('company_name'));
		$this->Auth->setConfig('unauthorizedRedirect',array('controller'=>'Analysts','action'=>'login'));
		$this->Auth->setConfig('authenticate', [
	            'Form' => [
	                'finder' => 'analysts',
	                'fields' => ['username' => 'email', 'password' => 'password']
	            ]
	        ]
		);
		$this->Auth->allow(['signup','login','forgotPassword','resetPassword']);
	}

	public function index()
    {
        $this->set('pageHeading',$this->Auth->user('company_name'));
    }


	public function signup($id=null)
	{

		$this->loadModel('Invitations');
		$check_invitations = $this->Invitations->find()
							->where(['invitation_token'=>$id,'invitation_status'=>'Pending'])->first();

		if($check_invitations=="")
		{
			echo "UnAuthorized Access!";
			die;
		}
		else
		{

			$this->loadModel('Analysts');
			$analysts = $this->Analysts->newEntity();

			if ($this->request->is('post'))
			{
				$posted = $this->request->getData();
				$analysts = $this->Analysts->patchEntity($analysts, $this->request->getData());

				$analysts->username = $posted['email'];
				$analysts->source = 'Registration';
				$analysts->role = "Analysts";
				$analysts->registration_status = "Approved";
				$analysts->company_id = $check_invitations->invited_by_user_id;

				if ($this->Analysts->save($analysts)) {

					$check_invitations->invitation_status = "Accepted";
					$this->Invitations->save($check_invitations);

					$this->Flash->success(__('Congratulations! Your registration request is successfully placed.'));
					return $this->redirect(['action' => 'login']);
				}
				$this->Flash->error(__('Sorry! Something went wrong. Please, check & try again.'));
			}

			$data = ['analysts'=>$analysts,'email'=>$check_invitations->company_email,'company_name'=>$check_invitations->company_name];

			$this->viewBuilder()->setLayout('website');
			$this->set($data);
		}
	}


	public function login(){

		$this->Auth->logout();
		$this->viewBuilder()->setLayout('ajax');

		if ($this->request->is('post')) {

			$posted = $this->request->getData();
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
					'Users.role'=>'Analysts',
					'Users.registration_status'=>'Approved'
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
						->viewBuilder()->setTemplate('resetpasswordforanalysts');
					$email->viewBuilder()->setLayout('cisolayout');

				    $resp = $email->send();


					if($resp['message']=='success'){
						$this->Flash->success("We have sent an email with reset password link. Kindly check your inbox.");
						$this->redirect(array('_name'=>'analyst-login'));
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
			return $this->redirect(array('controller'=>'analysts','action'=>'forgotPassword'));
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
				return $this->redirect(array('controller'=>'analysts','action'=>'forgotPassword'));
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
							return $this->redirect(array('_name'=>'analyst-login'));
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


	public function logout(){

	    $this->Auth->logout();
		return $this->redirect(array('controller'=>'pages','action'=>'cisohome'));
	}

	public function dashboard()
	{
		$this->loadModel('Invitations');
		$this->loadModel('Users');
		$invitations = $this->Invitations
						->find()
						->select(['Invitations.id', 'Invitations.company_email','Invitations.assessment_type', 'Invitations.invitation_status','Invitations.invitation_source','Invitations.created', 'Users.username'])
						->join([
							'table' => 'users', // replace with the actual table name of the Users table
							'alias' => 'Users',
							'type' => 'INNER',
							'conditions' => 'Invitations.invited_by_user_id = Users.id'
						])
						->where(['Invitations.company_email' => $this->Auth->user('email')])
						->where(['Invitations.assessment_status' => 0])
						->all();

		$this->viewBuilder()->setLayout('analyst');
		$this->set('pageHeading','Analysts Dashboard');
		$this->set(compact('invitations'));
	}

}
