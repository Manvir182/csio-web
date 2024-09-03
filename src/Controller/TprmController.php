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
class TprmController extends AppController
{

	public function isAuthorized($user){
		if($user['role']=='Company' || $user['role']=='Employee'){
			return true;
		} else {
			return false;
		}
	}
	public function initialize(){
		parent::initialize();
		$this->set('pageHeading',$this->Auth->user('company_name'));
		$this->Auth->setConfig('unauthorizedRedirect',array('controller'=>'Lab','action'=>'login'));
	}

	public function index()
    {
        $this->set('pageHeading',$this->Auth->user('company_name'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function invite()
    {
		$this->loadModel('Invitations');
		if($this->request->is(['PUT','POST']))
		{
			$invitation = $this->Invitations->newEntity();
			if ($this->request->is('post')) {
				$posted = $this->request->getData();
				$email = $posted['company_email'];
				$invitation_token =  md5(str_shuffle($email.time().$this->Auth->user('username')));

				$invitation = $this->Invitations->patchEntity($invitation, $this->request->getData());
				$invitation->invited_by_user_id = $this->Auth->user('id');
				$invitation->invitation_source = $this->Auth->user('role');
				$invitation->invitation_token = $invitation_token;

				$check_invitations = $this->Invitations->find()
							->where(['company_email'=>$email])
							->count();
				if($check_invitations==0)
				{
					if ($this->Invitations->save($invitation))
					{

						$pdata = array('invitation_token'=>$invitation_token);
						//sending email to company admin
						$email = new Email('Sendgrid');
						$email->setFrom(['info@thecloudciso.com' => 'THE CLOUD CISO'])
							->setTo($posted['company_email'])
							->setSubject("Analyst Invite - THE CLOUD CISO")
							->setViewVars($pdata)
							->setEmailFormat('html')
							->viewBuilder()->setTemplate('analystInvite');
						$email->viewBuilder()->setLayout('cisolayout');
						$resp = $email->send();

						$this->Flash->success("Invitation Sent successfully.");
						return $this->redirect(['action' => 'invite']);
					}
					$this->Flash->error(__('Please, try again.'));
				}else
				{
					$this->Invitations->save($invitation);

					$pdata = array('invitation_token'=>$invitation_token);
						//sending email to company admin
						$email = new Email('Sendgrid');
						$email->setFrom(['info@thecloudciso.com' => 'THE CLOUD CISO'])
							->setTo($posted['company_email'])
							->setSubject("Analyst Invite - THE CLOUD CISO")
							->setViewVars($pdata)
							->setEmailFormat('html')
							->viewBuilder()->setTemplate('analystInvite');
						$email->viewBuilder()->setLayout('cisolayout');
						$resp = $email->send();


					// $this->Flash->error(__('User With this email already invited.'));
					$this->Flash->success("Invitation Sent successfully.");
						return $this->redirect(['action' => 'invite']);
				}

			}
		}

		$role = $this->Auth->user('role');
		if($role=='Employee'){
			$this->viewBuilder()->setLayout('lab');
		}else{
			$this->viewBuilder()->setLayout('admin');
		}
    }

}
