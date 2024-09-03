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
class ApproversController extends AppController
{

	public function isAuthorized($user){
		$compActions = ['listApprovers','add','edit','view','delete'];
		$appActions = ['dashboard','approvalRequests','approvalRequest','saveApprovalComment'];

		if($user['role']=="Approver" && in_array($this->getRequest()->getParam('action'),$appActions)){
			return true;
		} else {
			if($user['role']=="Company" && in_array($this->getRequest()->getParam('action'),$compActions)){
				return true;
			}
			return false;
		}

	}
	public function initialize(){
		parent::initialize();
		$this->Auth->allow(['login','generatePassword','logout','forgotPassword','resetPassword']);
		$this->set('pageHeading','Approver');

		$this->Auth->setConfig('authenticate', [
	            'Form' => [
	                'finder' => 'approver',
	                'fields' => ['username' => 'email', 'password' => 'password']
	            ]
	        ]
		);

		$this->Security->setConfig('unlockedActions', ['saveApprovalComment']);


		$this->loadModel('PolicyApprovals');
	}

	public function approvalRequests(){
		$this->loadModel('PolicyApprovals');

		$this->paginate = [
        	'conditions' => [
        		'PolicyApprovals.approver_id'=>$this->Auth->user('id'),
            	'PolicyApprovals.status != '=>'Rejected',
            	'PolicyApprovals.status !='=>'Approved'
            ],
            'contain'=>[
            	'Policies.Users'
            ],
            'order'=>[
            	'PolicyApprovals.modified'=>'asc'
            ]
	    ];

        $approvals = $this->paginate($this->PolicyApprovals);
		//debug($approvals);
		$this->set(compact('approvals'));

		$this->viewBuilder()->setLayout('admin');
		$this->set('pageHeading','Approval Requests');
	}

	public function approvalRequest($id=null){
		if($id==null){
			$this->Flash->error(__('Invalid Parameter provided.'));
			return $this->redirect(['action' => 'approvalRequests']);
		}

		$approval = $this->PolicyApprovals->get($id,[
			'contain'=>[
				'Policies.Users','PolicyApprovalComments.Approvers'
			]
		]);
		//debug($approval);
		if($approval->approver_id!=$this->Auth->user('id')){
			$this->Flash->error(__('Request Does not belongs to Current Approver. Please Check the paramters.'));
			return $this->redirect(['action' => 'approvalRequests']);
		}

		if($this->request->is(['put','post'])){
			$posted = $this->request->getData();
			$updatedApproval = [
				'status'=>$posted['status'],
				'status_date'=>date('Y-m-d H:i:s')
			];

			//updating policy status
			//if all approval requests are approved or Rejected

			$respondedCount = $this->PolicyApprovals->find('all',[
				'PolicyApprovals.policy_id'=>$approval->policy_id,
				'PolicyApprovals.id !='=>$id,
				'PolicyApprovals.responded'=>'Yes'
			])->count();

			$allCount = $this->PolicyApprovals->find('all',[
				'PolicyApprovals.policy_id'=>$approval->policy_id,
				'PolicyApprovals.id !='=>$id,
			])->count();

			if($respondedCount==$allCount){
				$updatedApproval['responded'] = "Yes";
				if($posted['status']=="Approved" ){
					$updatedApproval['policy']['approved']="Yes";
					$updatedApproval['policy']['approved_date']=date('Y-m-d H:i:s');
				} elseif($posted['status']=="Rejected"){
					$updatedApproval['policy']['approved']="No";
				}
			}

			//debug($respondedCount);
			//debug($allCount);
			//debug($updatedApproval);

			$approval = $this->PolicyApprovals->patchEntity($approval,$updatedApproval,
				['associated'=>'Policies']
			);
			//debug($approval);


			if($this->PolicyApprovals->save($approval)){
				 $this->Flash->success(__('Status Successfully Updated.'));
			} else {
				 $this->Flash->error(__('Status has not been Updated.'));
			}
			$this->redirect($this->referer());

		}




		$this->set(compact('approval'));

		$this->viewBuilder()->setLayout('admin');
		$this->set('pageHeading','Approval Request Details');

	}

	public function saveApprovalComment(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->loadModel('PolicyApprovalComments');
		$newComment = $this->PolicyApprovalComments->newEntity();

		$posted = $this->request->getData();
		$comment = [
			'policy_approval_id' => $posted['approval_request_id'],
			'remarks' => strip_tags($posted['comment']),
			'approver_id' => $this->Auth->user('id')
		];


		$newComment = $this->PolicyApprovalComments->patchEntity($newComment,$comment);

		if($this->PolicyApprovalComments->save($newComment)){

			$this->set('comment',$newComment);
			$this->render('get_saved_comment');
		} else {
			echo 0;
		}



	}

	public function add()
    {
    	$this->loadModel('Approvers');
    	$approver = $this->Approvers->newEntity();
        if ($this->request->is('post')) {
        	$posted =$this->request->getData();
			$approver = $this->Approvers->patchEntity($approver, $posted);
			$approver->username = $posted['email'];
			$approver->company_id = $this->Auth->user('id');
			$approver->role = "Approver";

			if ($this->Approvers->save($approver)) {
                $this->Flash->success(__('The Approver has been saved.'));

                return $this->redirect(['action' => 'view',$approver->id]);
            }

            $this->Flash->error(__('The Approver could not be saved. Please, try again.'));

        }

        $this->set(compact('approver'));
    } //end add action


    public function edit($id = null){
    	$this->loadModel('Approvers');

        $approver = $this->Approvers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$posted =$this->request->getData();

            $approver = $this->Approvers->patchEntity($approver, $posted);
			$approver->username = $posted['email'];
			$approver->company_id = $this->Auth->user('id');
			$approver->role = "Approver";

            if ($this->Approvers->save($approver)) {
                $this->Flash->success(__('The Approver has been modified.'));

                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The Approver could not be updated. Please, try again.'));
        }
		$approver->password = "";

        $this->set(compact('approver'));
    }//end edit action


	public function view($id = null)
    {
    	$this->loadModel('Approvers');
        $approver = $this->Approvers->get($id, [
            'contain' => ['Companies']
        ]);


		if($approver->company_id!=$this->Auth->user('id')){
			$this->Flash->error(__('This Approver Does not belongs to this company.'));
			return $this->redirect($this->referer());
		}

        $this->set('approver', $approver);

    } //end view action

    public function listApprovers()
    {
    	$this->loadModel('Approvers');

		$approvers = $this->paginate($this->Approvers,array(
			'conditions'=>array(
				'Approvers.role'=>'Approver',
        		'Approvers.company_id'=>$this->Auth->user('id'),
        		'Approvers.approver_deleted is null'
				)
			)
		);

        $this->set('approvers', $approvers);

    } //end view action

	public function login(){
		$this->Auth->logout();

		$this->viewBuilder()->setLayout('ajax');

		if ($this->request->is('post')) {
	        $user = $this->Auth->identify();
	        if ($user) {
	            $this->Auth->setUser($user);
				return $this->redirect(array('controller'=>'approvers','action'=>'dashboard','_full' => true));
	        }
	        $this->Flash->error('Your username or password is incorrect. If you did not created any password yet. Kindly follow forgot password link.');
	    }
	}
	// public function login(){
	// 	$this->viewBuilder()->setLayout('ajax');
	// 	if ($this->request->is('post')) {
	//         $user = $this->Auth->identify();
	//         if ($user)
	// 		{
	// 			$phone_no = $user['contcode'].$user['phone'];
	// 			$sendOtp = $this->Otp->sendOtp($phone_no);
	// 			if($sendOtp == 201){
	// 				$this->request->getSession()->write('user.id',$user['id']);
	// 				return $this->redirect(array('controller'=>'otp','action'=>'OtpVerification'));
	// 			}else{
	// 				$this->Flash->error('Sorry! we are facing some problems in sending OTP. Please Try again.');
	// 			}
	//         }else{
	//         $this->Flash->error('Your username or password is incorrect. If you did not created any password yet. Kindly follow forgot password link.');
	// 		}
	//     }

	// }

	public function logout(){

	    $this->Auth->logout();
		return $this->redirect(array('controller'=>'pages','action'=>'cisohome'));
	}

	public function dashboard(){
		$this->viewBuilder()->setLayout('admin');
		$this->set('pageHeading','Approver Dashboard');
	}


	public function forgotPassword(){
		if($this->request->is(array('post'))){
			$this->loadModel('Approvers');
			$data = $this->request->getData();
			$email = $data['company_email'];

			$token = md5(str_shuffle($email.time().$this->Auth->user('username')));
			$expiry = date('Y-m-d H:i:s',strtotime('+24 hours'));
			$user = $this->Approvers->find('all',array(
				'conditions'=>array(
					'Approvers.email'=>$email,
					'Approvers.role'=>'Approver'
				)
			))->first();

			if(empty($user)){
				$this->Flash->error("Sorry! Account with this Email does not exists or active.");
			} elseif($user->approver_deleted!=""){
				$this->Flash->error("Sorry! Account with this Email is removed.");
			}  else {
				$pdata = array('password_reset_token'=>$token,'token_expiry_date'=>$expiry);
				$user = $this->Approvers->patchEntity($user,$pdata);
				if($this->Approvers->save($user)){
					$uemail = $email;

					$email = new Email('Sendgrid');
					$email->setFrom(['info@thecloudciso.com' => 'Reset Password - THE CLOUD CISO'])
					    ->setTo($uemail)
					    ->setSubject("Reset Password - THE CLOUD CISO")
					    ->setViewVars($pdata)
						->setEmailFormat('html')
						->viewBuilder()->setTemplate('resetpasswordforapprover');
					$email->viewBuilder()->setLayout('cisolayout');

				    $resp = $email->send();


					if($resp['message']=='success'){
						$this->Flash->success("We have sent an email with reset password link. Kindly check your inbox.");
						$this->redirect(array('_name'=>'approver-login'));
					} else {
						$this->Flash->error("Sorry! Something went wrong. Kindly try again.");
					}
				}
			}

		}


		$this->viewBuilder()->setLayout('ajax');
	}//end of forgot password

	public function generatePassword(){
		if($this->request->is(array('post'))){
			$this->loadModel('Approvers');
			$data = $this->request->getData();
			$email = $data['email'];

			$token = md5(str_shuffle($email.time().$this->Auth->user('username')));
			$expiry = date('Y-m-d H:i:s',strtotime('+24 hours'));
			$user = $this->Approvers->find('all',array(
				'conditions'=>array(
					'Approvers.email'=>$email,
					'Approvers.role'=>'Approver'
				)
			))->first();


			if(empty($user)){
				$this->Flash->error("Sorry! Account with this Email does not exists.");
			} elseif($user->approver_deleted==NULL){
				$this->Flash->error("Sorry! Account with this Email is removed.");
			} else {

				$pdata = array('password_reset_token'=>$token,'token_expiry_date'=>$expiry);
				$user = $this->Approvers->patchEntity($user,$pdata);
				if($this->Approvers->save($user)){
					$uemail = $email;

					$email = new Email('Sendgrid');
					$email->setFrom(['info@thecloudciso.com' => 'Generate Password - THE CLOUD CISO'])
					    ->setTo($uemail)
					    ->setSubject("Generate Password - THE CLOUD CISO")
					    ->setViewVars($pdata)
						->setEmailFormat('html')
						->viewBuilder()->setTemplate('generatepasswordforapprover');
					$email->viewBuilder()->setLayout('cisolayout');

				    $resp = $email->send();


					if($resp['message']=='success'){
						$this->Flash->success("We have sent an email with generate password link. Kindly check your inbox.");
						$this->redirect(array('_name'=>'approver-login'));
					} else {
						$this->Flash->error("Sorry! Something went wrong. Kindly try again.");
					}
				}
			}

		}


		$this->viewBuilder()->setLayout('ajax');
	}//end of generate password

	public function resetPassword($token=null){
		$this->viewBuilder()->setLayout('ajax');
		$this->loadModel('Approvers');

		$user = $this->Approvers->find('all',array(
			'conditions'=>array(
				'Approvers.password_reset_token'=>$token,
				'Approvers.token_expiry_date > '=>date('Y-m-d H:i:s'),
				'Approvers.role'=>'Approver'
			)
		))->first();

		if(empty($user)){
			$this->set('status','invalid');
			$this->Flash->error("Sorry! Invalid or Expired Token. Kindly re-submit the password reset request.");
			return $this->redirect(array('controller'=>'approvers','action'=>'forgotPassword'));
		}

		if($this->request->is('post')){
			$posted = $this->request->getData();
			$nuser = $this->Approvers->find('all',array(
				'conditions'=>array(
					'Approvers.password_reset_token'=>$token,
					'Approvers.token_expiry_date > '=>date('Y-m-d H:i:s')
				)
			))->first();
			if(empty($nuser)){
				$this->set('status','invalid');
				$this->Flash->error("Sorry! Invalid or Expired Token. Kindly re-submit the password reset request.");
				return $this->redirect(array('controller'=>'approvers','action'=>'forgotPassword'));
			} else {
				if($posted['npassword']!==$posted['cpassword']){
					$this->Flash->error("Sorry! Passwords does not matched. Try again.");
				} else {
					$status = preg_match("/^((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,100})$/", $posted['npassword']);
					if($status==1){
						$udata['password'] = $posted['npassword'];
						$udata['approver_password_created'] = 'Yes';
						$nuser = $this->Approvers->patchEntity($nuser,$udata);
						if($this->Approvers->save($nuser)){
							$this->Flash->success("Your password is Successfully Changed .");
							return $this->redirect(array('_name'=>'approver-login'));
						} else {
							return $this->Flash->error("Sorry! Something went wrong. Kindly try forgot password again.");
							//return $this->redirect(array('controller'=>'companies','action'=>'forgotPassword'));
						}
					} else {
						return $this->Flash->error("Sorry! Invalid Password format. Kindly check and try again.");
					}

				}

			}

		}

	} //end of reset password

	public function delete($id=null){
		$this->autoRender = false;

		$this->request->allowMethod(['post', 'delete']);
		$this->loadModel('Approvers');
        $approver = $this->Approvers->get($id);
		$approver->approver_deleted = date('Y-m-d H:i:s');
        if ($this->Approvers->save($approver)) {
            $this->Flash->success("Approver deleted successfully.");
        } else {
            $this->Flash->success("Approver has not been deleted. Try again");
        }

        return $this->redirect($this->referer());
	}





}
