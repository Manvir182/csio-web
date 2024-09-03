<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class OtpController extends AppController
{

	public function OtpVerification()
	{
		$this->render('verify');
	}

	public function Validate()
	{
		$posted = $this->request->getData();
		$otpStatus = $this->Otp->validate($posted['otp']);
		if($otpStatus=='invalid')
		{
			$this->Flash->error("Sorry! Invalid OTP Try Again.");
			return $this->redirect(array('action'=>'OtpVerification'));
		}
		else
		{
			$this->loadModel('Users');
			$user_id =  $this->request->getSession()->read('user.id');
			$user = $this->Users->get($user_id);
			if ($user)
			{
				$this->Auth->setUser($user);
				if($user['role']=='Super Admin'){
					return $this->redirect(array('controller'=>'users','action'=>'dashboard','_full' => true));
				} elseif($user['role']=='Company'){
					return $this->redirect(array('controller'=>'companies','action'=>'dashboard','_full' => true));
				}elseif($user['role']=='Approver'){
					return $this->redirect(array('controller'=>'approvers','action'=>'dashboard','_full' => true));
				}
				elseif($user['role']=='Analysts'){
					return $this->redirect(array('controller'=>'analysts','action'=>'dashboard','_full' => true));
				}
				else {
					$this->loadModel('Users');
					$comp = $this->Users->get($user['id'],[
						'contain'=>['Companies']
					]);
					$user['company_name'] = $comp->company->company_name;
					$this->Auth->setUser($user);
					return $this->redirect(array('controller'=>'lab','action'=>'dashboard','_full' => true));
				}
			}
		}
	}

	public function resendOtp()
	{
		$user_id =  $this->request->getSession()->read('user.id');
		$this->loadModel('Users');
		$user = $this->Users->get($user_id);
		$phone_no = $user['contcode'].$user['phone'];
		$sendOtp = $this->Otp->sendOtp($phone_no);

		if($sendOtp == 201){
			$this->Flash->success('Otp resent successfully.');
		}else{
			$this->Flash->error('Sorry! we are facing some problems in sending OTP. Please Try again.');
		}
		return $this->redirect(array('controller'=>'otp','action'=>'OtpVerification'));
	}
}
