<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Query;
/**
 * Lab Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LabController extends AppController
{

	public function isAuthorized($user){
		if($user['role']=="Employee"){
			return true;
		} else {
			return false;
		}

	}

	public $companyId = null;

	public function initialize(){
		parent::initialize();

		$this->Auth->setConfig('unauthorizedRedirect',array('controller'=>'Lab','action'=>'login'));
		$this->Auth->setConfig('authenticate', [
	            'Form' => [
	                'finder' => 'emp',
	                'fields' => ['username' => 'email', 'password' => 'password']
	            ]
	        ]
		);
		$this->Auth->allow(['login','forgotPassword','resetPassword']);

		$this->Security->setConfig('unlockedActions', ['saveApprovalComment','exportEgrcDocument','getActivityRegulations','regulationComplianceWizard','remediationManagement','savePolicyRiskMapping','deletePolicy','deleteEgrcRisk','updateRemediation','updateDeficiencyRemediation','deficiencyManagement']);
		$this->viewBuilder()->setLayout('lab');

		$this->set('egrcNav','policiesAndStandards');

		if($this->Auth->user()){
			$thisUser = $this->Auth->user();
			if($thisUser['role']=='Company'){
				$this->companyId = $thisUser['id'];
			} else if($thisUser['role']=='Employee'){
				$this->companyId = $thisUser['company_id'];
			}
		}
	}

	public function comingSoon(){

	}

	public function policiesAndStandards(){
		$this->loadModel('Employees');
		//$policies = $this->Employees->Policies->findAllByTypeAndCompanyIdAndApproved('Policy',$this->companyId,'Yes')->all();
		//$standards = $this->Employees->Standards->findAllByTypeAndCompanyIdAndApproved('Standard',$this->companyId,'Yes')->all();

		$policies = $this->Employees->Policies->find('all',[
			'conditions'=>[
				'Policies.type'=>'Policy',
				'Policies.company_id'=>$this->companyId,
				'OR'=>[
					['Policies.approved'=>'Yes'],
					['Policies.approved'=>'Pending']
				]
			]

		])->all();

		$standards = $this->Employees->Standards->find('all',[
			'conditions'=>[
				'Standards.type'=>'Standard',
				'Standards.company_id'=>$this->companyId,
				'OR'=>[
					['Standards.approved'=>'Yes'],
					['Standards.approved'=>'Pending']
				]
			]

		])->all();


		$company = $this->Employees->Companies->get($this->companyId);


		$this->set(compact('policies','standards','company'));

	}

	public function getPolicyOrStandard($id){
		//$this->viewBuilder()->setLayout(false);
		$this->loadModel('Employees');
		$policy = $this->Employees->Policies->get($id,[
			'contain'=>['PolicyDefinitions','PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
		]);

		$policy->logoType = filter_var($policy->logo, FILTER_VALIDATE_URL);

		$company = $this->Employees->Companies->get($policy->company_id);

		$this->set(compact('policy','company'));

	}

	public function exportEgrcDocument(){
		$this->viewBuilder()->setLayout(false);
		$this->autoRender = false;
		header("Content-type: application/vnd.ms-word");
		header("Content-disposition: attachment;Filename=".rand().".doc");
		header("Pragma:no-cache");
		header("Expires: 0");
		$data =  $this->request->getData();
		echo $data['data'];

	}

	public function deletePolicy(){
		$this->autoRender = false;

		$this->request->allowMethod(['post', 'delete']);
		$posted = $this->request->getData();
		$id = $posted['id'];
		$this->loadModel('Policies');
        $policy = $this->Policies->get($id);
        if ($this->Policies->delete($policy)) {
            echo 1;
        } else {
            echo 0;
        }
	}

	public function getPolicyApprovalsWithComments($id){
		//$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->loadModel('PolicyApprovals');
		$approvals = $this->PolicyApprovals->find('all',[
			'conditions'=>[
				'policy_id'=>$id
			],
			'contain'=>[
				'Policies.Users','PolicyApprovalComments.Approvers','Approvers'
			]
		])->all();

		$this->set(compact('approvals'));

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
			//'approver_id' => $this->Auth->user('id')
		];


		$newComment = $this->PolicyApprovalComments->patchEntity($newComment,$comment);

		if($this->PolicyApprovalComments->save($newComment)){

			$this->set('comment',$newComment);
			$this->render('get_saved_comment');
		} else {
			echo 0;
		}



	}


	public function addPolicy(){


		$this->loadModel('Policies');
		$policy = $this->Policies->newEntity([
			'contain'=>['PolicyDefinitions','PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
		]);



		//getting company of the user
		$this->loadModel('Users');
		$company = $this->Users->get($this->Auth->User('company_id'));

		//generating document Number
		$pols = $this->Policies->find('all',[
			'conditions'=>[
				'Policies.company_id'=>$this->Auth->user('company_id'),
				'Policies.type'=>'Policy'
			]
		])->count();

		$docNumbers = strtoupper("POL-".substr($company->company_name,0,3)."-".str_pad($pols+1,4,"0",STR_PAD_LEFT));
		$dtype = "Policy";
		$this->set(compact('policy','docNumbers','dtype'));

	}

	public function addStandard(){


		$this->loadModel('Policies');
		$policy = $this->Policies->newEntity([
			'contain'=>['PolicyDefinitions','PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
		]);

		//getting company of the user
		$this->loadModel('Users');
		$company = $this->Users->get($this->Auth->User('company_id'));

		//generating document Number
		$pols = $this->Policies->find('all',[
			'conditions'=>[
				'Policies.company_id'=>$this->Auth->user('company_id'),
				'Policies.type'=>'Standard'
			]
		])->count();

		$docNumbers = strtoupper("STD-".substr($company->company_name,0,3)."-".str_pad($pols+1,4,"0",STR_PAD_LEFT));
		$dtype = "Standard";
		$this->set(compact('policy','docNumbers','dtype'));

		$this->render('add_policy');

	}


	public function savePolicy(){

		$this->loadModel('Approvers');

		$this->loadModel('Policies');
		$policy = $this->Policies->newEntity([
			'contain'=>['PolicyDefinitions','PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
		]);

		//getting company of the user
		$this->loadModel('Users');
		$company = $this->Users->get($this->companyId);

		if($this->request->is(['put','post'])){
			$posted = $this->request->getData();

			//debug($posted);

			$definitions = [];
			$approvers = [];
			$responsibilities = [];
			$statements = [];

			//debug($posted);
			//formatting data to save in one call
			foreach($posted['policy_approvers']['name'] as $k=>$record){
				if(!empty($record)){

					//getting approver information
					$aprvr = $this->Approvers->findByEmail($posted['policy_approvers']['email'][$k])->first();

					$approvers[]=[
						'approver_id'=>$aprvr->id,
						'name'=>$record,
						'title'=>$posted['policy_approvers']['title'][$k],
						'department'=>$posted['policy_approvers']['department'][$k],
						'email'=>$posted['policy_approvers']['email'][$k],
						'type'=>empty($posted['policy_approvers']['type'][$k])?"Approver":"Author"
					];
				}

			}
			$posted['policy_approvers'] = $approvers;
			foreach($posted['policy_definitions']['term'] as $k=>$record){
				if(!empty($record)){
					$definitions[]=[
						'term'=>$record,
						'definition'=>$posted['policy_definitions']['definition'][$k]
					];
				}
			}
			$posted['policy_definitions'] = $definitions;
			foreach($posted['policy_responsibilities']['roles'] as $k=>$record){
				if(!empty($record)){
					$responsibilities[]=[
						'roles'=>$record,
						'responsibilities'=>$posted['policy_responsibilities']['responsibilities'][$k]
					];
				}
			}
			$posted['policy_responsibilities'] = $responsibilities;
			foreach($posted['policy_statements']['name'] as $k=>$record){
				if(!empty($record)){
					$statements[]=[
						'name'=>$record
					];
				}
			}
			$posted['policy_statements'] = $statements;

			$sendApprovalMail = false;
			//checking if the approval mail is to sent or not
			//And
			//generating RC Mappings masters for this policy with existing risks
			//with mapping status Pending and mapping as 'N'
			//if the policy is Saved with status as Final
			if($posted['status']=='Final'){
				$this->loadModel('EgrcRisks');
				$eRisks = $this->EgrcRisks->find('all',[
					'conditions'=>[
						'OR'=>[
							'EgrcRisks.company_id'=>'',
							'EgrcRisks.company_id IS NULL',
							'EgrcRisks.company_id'=>$this->companyId
						]
					]
				]);

				$eMasterRcMappings = [];
				foreach($eRisks as $eRisk){
					$eMasterRcMappings[]=[
						'egrc_risk_id'=>$eRisk->id,
						'company_id'=>$this->companyId
					];
				}
				$posted['egrc_master_rc_mappings'] = $eMasterRcMappings;


				$sendApprovalMail = true;
			}
			//rc mapping masters generation ends

			//formatting of data ends here


			if(empty($posted['logo']['name'])){

				$posted['logo'] = $company->company_name;
				$logoStatus = "Logo Updated as Company Name.";
			} else {
				/* uploading logo image file*/
				$ext = explode('.',$posted['logo']['name']);
				$ext = end($ext);
				if($ext=='jpg' || $ext=='png' || $ext=='jpeg'){
					$awsPath = 'egrc/logos/logo-'.str_replace(' ','_',microtime())."_".$posted['document_number'].".".$ext;
					$file = $this->aws->putObject($awsPath,$posted['logo']['tmp_name']);
					if($file['status']=='200'){
						$posted['logo']=$file['url'];
						$logoStatus = "Logo Updated.";
					}  else {
						$this->loadModel('Users');
						$company = $this->Users->get($this->companyId);
						$posted['logo'] = $company->company_name;
						$logoStatus = "Logo Updated as Company Name due to issue in file upload.";
					}
				}
				/* uploading logo image file ends*/
			}



			$posted['revision'] = "0.1";
			$posted['user_id'] = $this->Auth->user('id');
			$posted['company_id'] = $company->id;
			$posted['approved'] = 'Yes';
			$posted['effective_date'] = empty($posted['effective_date'])?'':date('Y-m-d',strtotime($posted['effective_date']));

			$posted = $this->Policies->newEntity($posted,[
				'contain'=>['PolicyApprovers','PolicyChangeHistory','EgrcMasterRcMappings','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
			]);


			//debug($posted);


			$saved = $this->Policies->save($posted);
			if($saved){

				//sending approval mail and saving approval request listings
				if($sendApprovalMail==true){
					if($this->sendMailToApprovers($posted)){
						$this->Flash->success("Successfully Saved. ".$logoStatus." And Email sent for Approval");
					} else {
						$this->Flash->success("Successfully Saved. ".$logoStatus." And Email Not sent for approval.");
					}
				} else {
					$this->Flash->success("Successfully Saved. ".$logoStatus);
				}

			} else {
				$this->Flash->error("Sorry! Not saved. ".$logoStatus);
			}

			$this->redirect(['controller'=>'lab','action'=>'policiesAndStandards']);

		}

	}

	public function editPolicy($id){


		$this->loadModel('Policies');
		$policy = $this->Policies->get($id,[
			'contain'=>['PolicyDefinitions','PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
		]);

		$policy->logoType = filter_var($policy->logo, FILTER_VALIDATE_URL);
		$dtype = "Policy";
		//getting company of the user
		$this->loadModel('Users');
		$company = $this->Users->get($this->Auth->User('company_id'));

		$this->set(compact('policy','dtype'));

		//debug($policy);

	}

	public function editStandard($id){


		$this->loadModel('Policies');
		$policy = $this->Policies->get($id,[
			'contain'=>['PolicyDefinitions','PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
		]);

		$policy->logoType = filter_var($policy->logo, FILTER_VALIDATE_URL);
		$dtype = "Standard";
		//getting company of the user
		$this->loadModel('Users');
		$company = $this->Users->get($this->Auth->User('company_id'));

		$this->set(compact('policy','dtype'));

		$this->render('edit_policy');

	}


	public function saveEditPolicy($id){

		$this->autoRender = false;

		$this->loadModel('Policies');
		$policy = $this->Policies->get($id,[
			'contain'=>['PolicyDefinitions','PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
		]);

		$oldPolicy = $this->Policies->get($id,[
			'contain'=>['PolicyDefinitions','PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
		]);

		$this->loadModel('Users');
		$company = $this->Users->get($this->companyId);


		if($this->request->is(['put','post'])){
			$posted = $this->request->getData();
			$definitions = [];
			$approvers = [];
			$responsibilities = [];
			$statements = [];

			//debug($posted);
			$this->loadModel('Approvers');
			foreach($posted['policy_approvers']['name'] as $k=>$record){

				//getting approver information
				$aprvr = $this->Approvers->findByEmail($posted['policy_approvers']['email'][$k])->first();

				if($aprvr){
					if(isset($posted['policy_approvers']['id'][$k])){
						$approvers[]=[
							'approver_id'=>$aprvr->id,
							'id'=>$posted['policy_approvers']['id'][$k],
							'name'=>$record,
							'title'=>$posted['policy_approvers']['title'][$k],
							'department'=>$posted['policy_approvers']['department'][$k],
							'email'=>$posted['policy_approvers']['email'][$k],
							'type'=>empty($posted['policy_approvers']['type'][$k])?"Approver":"Author"
						];
					} else {
						$approvers[]=[
							'approver_id'=>$aprvr->id,
							'name'=>$record,
							'title'=>$posted['policy_approvers']['title'][$k],
							'department'=>$posted['policy_approvers']['department'][$k],
							'email'=>$posted['policy_approvers']['email'][$k],
							'type'=>empty($posted['policy_approvers']['type'][$k])?"Approver":"Author"
						];
					}
				}

				//debug($posted['policy_approvers']['type'][$k]);
			}
			$posted['policy_approvers'] = $approvers;
			foreach($posted['policy_definitions']['term'] as $k=>$record){
				if(isset($posted['policy_definitions']['id'][$k])){
					$definitions[]=[
						'id'=>$posted['policy_definitions']['id'][$k],
						'term'=>$record,
						'definition'=>$posted['policy_definitions']['definition'][$k]
					];
				} else {
					$definitions[]=[
						'term'=>$record,
						'definition'=>$posted['policy_definitions']['definition'][$k]
					];
				}

			}
			$posted['policy_definitions'] = $definitions;
			foreach($posted['policy_responsibilities']['roles'] as $k=>$record){
				if(isset($posted['policy_responsibilities']['id'][$k])){
					$responsibilities[]=[
						'id'=>$posted['policy_responsibilities']['id'][$k],
						'roles'=>$record,
						'responsibilities'=>$posted['policy_responsibilities']['responsibilities'][$k]
					];
				} else {
					$responsibilities[]=[
						'roles'=>$record,
						'responsibilities'=>$posted['policy_responsibilities']['responsibilities'][$k]
					];
				}

			}
			$posted['policy_responsibilities'] = $responsibilities;
			foreach($posted['policy_statements']['name'] as $k=>$record){
				if(isset($posted['policy_statements']['id'][$k])){
					$statements[]=[
						'id'=>$posted['policy_statements']['id'][$k],
						'name'=>$record
					];
				} else {
					$statements[]=[
						'name'=>$record
					];
				}

			}
			$posted['policy_statements'] = $statements;


			$logoStatus = "";
			if(!empty($posted['logo']['name'])){
				/* uploading logo image file*/
				$ext = explode('.',$posted['logo']['name']);
				$ext = end($ext);
				if($ext=='jpg' || $ext=='png' || $ext=='jpeg'){
					$awsPath = 'egrc/logos/logo-'.str_replace(' ','_',microtime())."_".$posted['document_number'].".".$ext;
					$file = $this->aws->putObject($awsPath,$posted['logo']['tmp_name']);
					if($file['status']=='200'){
						$posted['logo']=$file['url'];
						$logoStatus = "Logo Updated.";
					}
				}
				/* uploading logo image file ends*/
			} else {
				$posted['logo'] = $policy->logo;
			}



			$posted['revision'] = "0.1";
			$posted['user_id'] = $this->Auth->user('id');
			$posted['company_id'] = $company->id;
			$posted['effective_date'] = date('Y-m-d',strtotime($posted['effective_date']));

			$this->Policies->association('PolicyApprovers')->saveStrategy('replace');
			$this->Policies->association('PolicyDefinitions')->saveStrategy('replace');
			$this->Policies->association('PolicyResponsibilities')->saveStrategy('replace');
			$this->Policies->association('PolicyStatements')->saveStrategy('replace');

			//debug($posted);

			$posted = $this->Policies->patchEntity($policy,$posted,[
				'contain'=>['PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
			]);

			//debug($posted);

			$isUpdated = false;

			if($posted->status=="Final" && !empty($posted->getDirty())){
				$isUpdated = true;
				$posted->approved = "Yes";
			}

			$saved = $this->Policies->save($posted);
			if($saved){

				if($isUpdated==true && $oldPolicy->approved=="Yes"){

					if($this->sendMailToApprovers($posted,$oldPolicy)){
						$this->Flash->success("Successfully Saved. ".$logoStatus." Emails sent to Approvers");
					} else {
						$this->Flash->success("Successfully Saved. ".$logoStatus);
					}
				}

			} else {
				$this->Flash->error("Sorry! Not saved. ".$logoStatus);
			}


			$this->redirect(['controller'=>'lab','action'=>'policiesAndStandards']);

		}

	}

	//sending emails to approvers
	public function sendMailToApprovers($newPolicy,$existing=null){

		$newPolJson = json_encode($newPolicy);
		$oldPolJson = "";
		if($existing!=null){
			$oldPolJson = json_encode($existing);
		}

		//saving data for approvals
		$this->loadModel('PolicyApprovals');
		$approvals = [];
		$email = new Email('Sendgrid'); //creating email object
		foreach($newPolicy->policy_approvers as $approver){
			$approvals[]=[
				'policy_id'=>$newPolicy->id,
				'approver_id'=>$approver->approver_id,
				'old_data'=>$oldPolJson,
				'new_data'=>$newPolJson,
				'remarks'=>$oldPolJson==""?'New '.$newPolicy->type.' Created':$newPolicy->type.' Modified',
				'status_date'=>date('Y-m-d H:i:s')
			];

			//adding "to" emails
			$email->addTo($approver->email);

		}

		$approval = $this->PolicyApprovals->newEntities($approvals,$approvals);
		if($this->PolicyApprovals->saveMany($approval)){


			$pdata = [
				'policy_name'=>$newPolicy->name,
				'document_number'=>$newPolicy->document_number

			];

			//$email = new Email('Sendgrid');
			$email->setFrom(['info@thecloudciso.com' => 'Policy/Standard Approval Request - THE CLOUD CISO'])
			    ->setSubject("Policy/Standard Approval Request - THE CLOUD CISO")
			    ->setViewVars($pdata)
				->setEmailFormat('html')
				->viewBuilder()->setTemplate('policyapproval');
			$email->viewBuilder()->setLayout('cisolayout');

		    $resp = $email->send();

			return true;
		} else {
			return false;
		}


	}



	//ajax action for deleting the eGRC Risk with mappings
	public function deleteEgrcRisk($id = null)
    {
    	$this->autoRender = false;

		$this->request->allowMethod(['post', 'delete']);
		$posted = $this->request->getData();
		$id = $posted['id'];
		$this->loadModel('EgrcRisks');
        $eRisk = $this->EgrcRisks->get($id);
        if ($this->EgrcRisks->delete($eRisk)) {
            echo 1;
        } else {
            echo 0;
        }
	}

	//ajax action to verify existence of the approver
	public function isApproverExist($email=null){
		$this->autoRender = false;
		//$this->request->allowMethod(['post']);
		$this->loadModel('Approvers');
		$approver = $this->Approvers->find('all',[
			'conditions'=>[
				'Approvers.email'=>$email,
				'Approvers.role'=>'Approver',
				'Approvers.approver_deleted is null',
				'Approvers.company_id'=>$this->Auth->user('company_id')
			]
		])->first();

		if(!empty($approver->id)){
			echo 1;
		} else {
			echo 0;
		}

	}



	public function riskControlRegistry(){

		$company_id = $this->companyId;
		$this->loadModel('Policies');
		$policies = $this->Policies->find('all',[
			'conditions'=>[
				'Policies.approved'=>'Yes',
				'Policies.status'=>'Final',
				'Policies.company_id'=>$company_id
			],
			'contain'=>[
				'PolicyStatements','EgrcMasterRcMappings.EgrcRisks'=>function(Query $query) use ($company_id){
					return $query->where(['OR'=>['EgrcRisks.company_id'=>'','EgrcRisks.company_id IS NULL','EgrcRisks.company_id'=>$company_id]]);
				},
				'EgrcMasterRcMappings'=>function(Query $query) use ($company_id){
					return $query->where(['EgrcMasterRcMappings.company_id'=>$company_id]);
				}
			]
		])->all();

		$this->loadModel('Companies');
		$ucompany = $this->Companies->get($company_id);
		$this->set(compact('policies','ucompany'));
		$this->set('egrcNav','riskControlRegistry');
	}

	public function savePolicyRiskMapping(){
		$this->autoRender = false;

		if($this->request->is(['post','put'])){
			$this->loadModel('EgrcRisks');
			$this->loadModel('EgrcMasterRcMappings');

			$posted = $this->request->getData();

			//debug($posted);

			$nmapping = [];
			$riskNames = [];
			$riskDesc = [];
			if(!empty($posted['nmapping'])){
				$nmapping = $posted['nmapping'];
				unset($posted['nmapping']);
			}

			if(!empty($posted['risknames'])){
				$riskNames=$posted['risknames'];
				unset($posted['risknames']);
			}
			if(!empty($posted['riskdesc'])){
				$riskDesc = $posted['riskdesc'];
				unset($posted['riskdesc']);
			}

			//debug($nmapping);

			$fdata = array();
			foreach($posted as $map=>$value){
				$mid = explode('~',$map);
				$mid = end($mid);
				$fdata[] = [
					'id'=>$mid,
					'mapping'=>$value,
					'status'=>'Mapped'
				];

			}


			$newRiskMsg = "";
			if(!empty($nmapping)){
				$risks = [];
				foreach($riskNames as $k=>$rnam){
					$policy_id = $k;
					foreach($rnam as $rk=>$rname){
						$risks[]=[
							'company_id'=>$this->companyId,
							'name'=>$rname,
							'description'=>$riskDesc[$k][$rk]
						];
					}
				}
				//creating new risk with mapping
				foreach($risks as $rk=>$risk){
					$risks[$rk]['egrc_master_rc_mappings'][]=[
						'egrc_policy_id'=>$policy_id,
						'company_id'=>$this->companyId,
						'mapping'=>$nmapping[$policy_id][$rk],
						'status'=>'Mapped'
					];
				}

				$opQuery = $this->EgrcMasterRcMappings->find('all',[
					'conditions'=>[
						'EgrcMasterRcMappings.egrc_policy_id !='=>$policy_id,
						'EgrcMasterRcMappings.company_id'=>$this->companyId
					]
				]);
				$opIds = $opQuery->select(['opids'=>'group_concat(distinct(egrc_policy_id))'])->first();
				$opIds = explode(',',$opIds->opids);

				//adding mapping for risk for other policy/standard
				foreach($risks as $rk=>$risk){
					foreach($opIds as $opid){
						$risks[$rk]['egrc_master_rc_mappings'][]=[
							'egrc_policy_id'=>$opid,
							'mapping'=>'N',
							'company_id'=>$this->companyId,
							'status'=>'Pending'
						];
					}
				}

				//if new risks present
				$newRisks = $this->EgrcRisks->newEntities($risks,[
					'associated'=>['EgrcMasterRcMappings']
				]);



				if(!$this->EgrcRisks->saveMany($newRisks)){
					$newRiskMsg = " But New Risks Not Updated. Check if the Risk name already exists.";
				}


			}

			$eRisks = $this->EgrcMasterRcMappings->patchEntities($fdata,$fdata);


			$status = $this->EgrcMasterRcMappings->saveMany($eRisks);



			if($status){
				$this->Flash->success("Registry Successfully Updated. ".$newRiskMsg);

			} else {
				$this->Flash->error("Sorry! Not Successful. Try again.");
			}
			return $this->redirect($this->referer());


		}
	}


	public function remediationManagement(){

		$connection = ConnectionManager::get('default');

		//getting company details of current user/e=mployee
		$this->loadModel('Companies');
		$company = $this->Companies->get($this->companyId,[
			'fields'=>[
				'id','company_name','email'
			]
		]);

		$this->loadModel('EgrcRemediations');

		$search="";
		$date = "";
		if($this->request->is(['put','post'])){
			$posted = $this->request->getData();
			//debug($posted);
			$field = $posted['stype'];
			$value = $posted['stext'];

			if($field=='created'){
				$this->paginate = [
		            'conditions' => [
		            	'EgrcRemediations.company_id'=>$this->companyId,
		            	"date(EgrcRemediations.created) between '".date('Y-m-d',strtotime($value))."' and '".date('Y-m-d',strtotime($posted['stext2']))."'"
		            ],
		            'maxLimit'=>'500',
		            'limit'=>'500'
		        ];
				$date = $posted['stext2'];
			} else {
				$this->paginate = [
		            'conditions' => [
		            	'EgrcRemediations.company_id'=>$this->companyId,
		            	"EgrcRemediations.".$field." like '%".$value."%'"
		            ],
		            'maxLimit'=>'500',
		            'limit'=>'=500'
		        ];
				$date = "";
			}

		} else {
			$this->paginate = [
            	'conditions' => [
	            	'EgrcRemediations.company_id'=>$this->companyId,

	            ]
		    ];
		}

        $remds = $this->paginate($this->EgrcRemediations);

		//debug($remds);

		//generating statistics for charts


		$affectedPolicy = $connection->execute("SELECT affected_policy, COUNT(*) AS ccount FROM egrc_remediations
						WHERE company_id='".$company->id."'
						GROUP BY affected_policy ORDER BY ccount DESC LIMIT 1")->fetchAll('assoc');

		$outstanding = $connection->execute("SELECT COUNT(*) AS pc FROM egrc_remediations
						WHERE company_id='".$company->id."'
						AND DATE(remediation_date) < CURDATE()
						AND STATUS != '' AND STATUS !='Remediated'")->fetchAll('assoc');
		$ontrack = $connection->execute("SELECT COUNT(*) AS pc FROM egrc_remediations
						WHERE company_id='".$company->id."'
						AND status='On Track'")->fetchAll('assoc');
		$pastSixMonths = $connection->execute("SELECT COUNT(*) AS pc FROM egrc_remediations
						WHERE company_id='".$company->id."'
						AND status='Remediated' and date(remediation_date) between '".date('Y-m-d',strtotime('- 6 months'))."' and CURDATE()")->fetchAll('assoc');

		$chart1 = $connection->execute("SELECT
					MAX(CASE
					   WHEN risk_ranking='Extreme' THEN nums
					   ELSE 0
					END) AS 'Extreme',
					MAX(CASE
					   WHEN risk_ranking='Major' THEN nums
					   ELSE 0
					END) AS 'Major',
					MAX(CASE
					   WHEN risk_ranking='Minor' THEN nums
					   ELSE 0
					END) AS 'Minor',
					MAX(CASE
					   WHEN risk_ranking='Moderate' THEN nums
					   ELSE 0
					END) AS 'Moderate',
					MAX(CASE
					   WHEN risk_ranking='Significant' THEN nums
					   ELSE 0
					END) AS 'Significant'

					FROM(
					SELECT risk_ranking, COUNT(risk_ranking) AS nums
					FROM egrc_remediations
					WHERE risk_ranking IS NOT NULL
					AND company_id='".$company->id."'
					GROUP BY risk_ranking
					) t")->fetchAll('assoc');

		$allRisksCount = $connection->execute("SELECT risk_ranking,COUNT(risk_ranking) AS nums
						FROM egrc_remediations
						WHERE risk_ranking IS NOT NULL
						AND company_id='".$company->id."'")->fetchAll('assoc');
		$highRisksCount = $connection->execute("SELECT risk_ranking,COUNT(risk_ranking) AS nums
						FROM egrc_remediations
						WHERE risk_ranking IS NOT NULL
						AND company_id='".$company->id."'
						AND risk_ranking IN ('Extreme','Major')")->fetchAll('assoc');

		$stats['affected_policy'] = empty($affectedPolicy[0])?'0':$affectedPolicy[0];
		$stats['ontrack'] = empty($ontrack[0])?'No Data Available':$ontrack[0];
		$stats['outstanding'] = empty($outstanding[0])?'No Data Available':$outstanding[0];
		$stats['pastSixMonths'] = empty($pastSixMonths[0])?'No Data Available':$pastSixMonths[0];
		$stats['chart1'] = empty($chart1[0])?'No Data Available':$chart1[0];
		$stats['highrisk'] = (!empty($highRisksCount[0]['nums']) && !empty($allRisksCount[0]['nums']))?round(($highRisksCount[0]['nums']/$allRisksCount[0]['nums'])*100,2)." %":"0 %";

		//generating statistics ends here
		//debug($stats);



		$this->set(compact('remds','search','date','stats'));
		$this->set('company',$company);
		$this->set('egrcNav','remediationManagement');
	}

	public function deficiencyManagement(){

		$connection = ConnectionManager::get('default');

		//getting company details of current user/e=mployee

		$this->loadModel('Companies');

		$company = $this->Companies->get($this->companyId,[
			'fields'=>[
				'id','company_name','email'
			]
		]);


		$this->loadModel('EgrcRemediationsCopy');

		$search="";
		$date = "";
		if($this->request->is(['put','post'])){
			$posted = $this->request->getData();

			$field = $posted['stype'];
			$value = $posted['stext'];

			if($field=='created'){
				$this->paginate = [
		            'conditions' => [
		            	'EgrcRemediationsCopy.company_id'=>$this->companyId,
		            	"date(EgrcRemediationsCopy.created) between '".date('Y-m-d',strtotime($value))."' and '".date('Y-m-d',strtotime($posted['stext2']))."'"
		            ],
		            'maxLimit'=>'500',
		            'limit'=>'500'
		        ];
				$date = $posted['stext2'];
			} else {
				$this->paginate = [
		            'conditions' => [
		            	'EgrcRemediationsCopy.company_id'=>$this->companyId,
		            	"EgrcRemediationsCopy.".$field." like '%".$value."%'"
		            ],
		            'maxLimit'=>'500',
		            'limit'=>'=500'
		        ];
				$date = "";
			}

		} else {
			$this->paginate = [
            	'conditions' => [
	            	'EgrcRemediationsCopy.company_id'=>$this->companyId,

	            ]
		    ];
		}

        $remds = $this->paginate($this->EgrcRemediationsCopy);


		//debug($remds);

		//generating statistics for charts


		$affectedPolicy = $connection->execute("SELECT affected_policy, COUNT(*) AS ccount FROM egrc_remediations_copy
						WHERE company_id='".$company->id."'
						GROUP BY affected_policy ORDER BY ccount DESC LIMIT 1")->fetchAll('assoc');

		$outstanding = $connection->execute("SELECT COUNT(*) AS pc FROM egrc_remediations_copy
						WHERE company_id='".$company->id."'
						AND DATE(remediation_date) < CURDATE()
						AND STATUS != '' AND STATUS !='Remediated'")->fetchAll('assoc');
		$ontrack = $connection->execute("SELECT COUNT(*) AS pc FROM egrc_remediations_copy
						WHERE company_id='".$company->id."'
						AND status='On Track'")->fetchAll('assoc');
		$pastSixMonths = $connection->execute("SELECT COUNT(*) AS pc FROM egrc_remediations_copy
						WHERE company_id='".$company->id."'
						AND status='Remediated' and date(remediation_date) between '".date('Y-m-d',strtotime('- 6 months'))."' and CURDATE()")->fetchAll('assoc');

		$chart1 = $connection->execute("SELECT
					MAX(CASE
					   WHEN risk_ranking='Extreme' THEN nums
					   ELSE 0
					END) AS 'Extreme',
					MAX(CASE
					   WHEN risk_ranking='Major' THEN nums
					   ELSE 0
					END) AS 'Major',
					MAX(CASE
					   WHEN risk_ranking='Minor' THEN nums
					   ELSE 0
					END) AS 'Minor',
					MAX(CASE
					   WHEN risk_ranking='Moderate' THEN nums
					   ELSE 0
					END) AS 'Moderate',
					MAX(CASE
					   WHEN risk_ranking='Significant' THEN nums
					   ELSE 0
					END) AS 'Significant'

					FROM(
					SELECT risk_ranking, COUNT(risk_ranking) AS nums
					FROM egrc_remediations_copy
					WHERE risk_ranking IS NOT NULL
					AND company_id='".$company->id."'
					GROUP BY risk_ranking
					) t")->fetchAll('assoc');


		$allRisksCount = $connection->execute("SELECT risk_ranking,COUNT(risk_ranking) AS nums
						FROM egrc_remediations_copy
						WHERE risk_ranking IS NOT NULL
						AND company_id='".$company->id."'")->fetchAll('assoc');
		$highRisksCount = $connection->execute("SELECT risk_ranking,COUNT(risk_ranking) AS nums
						FROM egrc_remediations_copy
						WHERE risk_ranking IS NOT NULL
						AND company_id='".$company->id."'
						AND risk_ranking IN ('Extreme','Major')")->fetchAll('assoc');

		$stats['affected_policy'] = empty($affectedPolicy[0])?'0':$affectedPolicy[0];
		$stats['ontrack'] = empty($ontrack[0])?'No Data Available':$ontrack[0];
		$stats['outstanding'] = empty($outstanding[0])?'No Data Available':$outstanding[0];
		$stats['pastSixMonths'] = empty($pastSixMonths[0])?'No Data Available':$pastSixMonths[0];
		$stats['chart1'] = empty($chart1[0])?'No Data Available':$chart1[0];
		$stats['highrisk'] = (!empty($highRisksCount[0]['nums']) && !empty($allRisksCount[0]['nums']))?round(($highRisksCount[0]['nums']/$allRisksCount[0]['nums'])*100,2)." %":"0 %";

		//generating statistics ends here
		//debug($stats);



		$this->set(compact('remds','search','date','stats'));
		$this->set('company',$company);
		$this->set('egrcNav','deficiencyManagement');
	}

	public function updateRemediation(){
		$this->viewBuilder()->setLayout(false);
		$this->autoRender = false;

		if($this->request->is(['post','put'])){
			$posted = $this->request->getData();

			$this->loadModel('EgrcRemediations');
			$remd = $this->EgrcRemediations->get($posted['id']);
			$remd = $this->EgrcRemediations->patchEntity($remd,$posted);

			if($this->EgrcRemediations->save($remd)){
				echo 1;
			} else {
				echo 0;
			}

		}
	}

	public function updateDeficiencyRemediation(){
		$this->viewBuilder()->setLayout(false);
		$this->autoRender = false;

		if($this->request->is(['post','put'])){
			$posted = $this->request->getData();

			$this->loadModel('EgrcRemediationsCopy');
			$remd = $this->EgrcRemediationsCopy->get($posted['id']);
			$remd = $this->EgrcRemediationsCopy->patchEntity($remd,$posted);

			if($this->EgrcRemediationsCopy->save($remd)){
				echo 1;
			} else {
				echo 0;
			}

		}
	}



	/*
	public function addPolicyOrStandard(){

			$this->loadModel('Policies');
			$policy = $this->Policies->newEntity([
				'contain'=>['PolicyDefinitions','PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
			]);

			//getting company of the user
			$this->loadModel('Users');
			$company = $this->Users->get($this->Auth->User('company_id'));

			//generating document Number
			$pols = $this->Policies->find('all',[
				'conditions'=>[
					'Policies.company_id'=>$this->Auth->user('company_id'),
					'Policies.type'=>'Policy'
				]
			])->count();
			$stands = $this->Policies->find('all',[
				'conditions'=>[
					'Policies.company_id'=>$this->Auth->user('company_id'),
					'Policies.type'=>'Standard'
				]
			])->count();

			$docNumbers = json_encode([
				'Policy'=>strtoupper("POL-".substr($company->company_name,0,3)."-".str_pad($pols+1,4,"0",STR_PAD_LEFT)),
				'Standard'=>strtoupper("STD-".substr($company->company_name,0,3)."-".str_pad($stands+1,4,"0",STR_PAD_LEFT))
			]);
			//generating document Number Ends

			$this->set(compact('policy','docNumbers'));

			if($this->request->is(['put','post'])){
				$posted = $this->request->getData();
				$definitions = [];
				$approvers = [];
				$responsibilities = [];
				$statements = [];

				//debug($posted);

				foreach($posted['policy_approvers']['name'] as $k=>$record){
					$approvers[]=[
						'name'=>$record,
						'title'=>$posted['policy_approvers']['title'][$k],
						'department'=>$posted['policy_approvers']['department'][$k],
						'email'=>$posted['policy_approvers']['email'][$k],
						'type'=>empty($posted['policy_approvers']['type'][$k])?"Approver":"Author"
					];
					//debug($posted['policy_approvers']['type'][$k]);
				}
				$posted['policy_approvers'] = $approvers;
				foreach($posted['policy_definitions']['term'] as $k=>$record){
					$definitions[]=[
						'term'=>$record,
						'definition'=>$posted['policy_definitions']['definition'][$k]
					];
				}
				$posted['policy_definitions'] = $definitions;
				foreach($posted['policy_responsibilities']['roles'] as $k=>$record){
					$responsibilities[]=[
						'roles'=>$record,
						'responsibilities'=>$posted['policy_responsibilities']['responsibilities'][$k]
					];
				}
				$posted['policy_responsibilities'] = $responsibilities;
				foreach($posted['policy_statements']['name'] as $k=>$record){
					$statements[]=[
						'name'=>$record
					];
				}
				$posted['policy_statements'] = $statements;



				if(empty($posted['logo']['name'])){

					$posted['logo'] = $company->company_name;
					$logoStatus = "Logo Updated as Company Name.";
				} else {
					//* uploading logo image file
					$ext = explode('.',$posted['logo']['name']);
					$ext = end($ext);
					if($ext=='jpg' || $ext=='png' || $ext=='jpeg'){
						$awsPath = 'egrc/logos/logo-'.str_replace(' ','_',microtime())."_".$posted['document_number'].".".$ext;
						$file = $this->aws->putObject($awsPath,$posted['logo']['tmp_name']);
						if($file['status']=='200'){
							$posted['logo']=$file['url'];
							$logoStatus = "Logo Updated.";
						}  else {
							$this->loadModel('Users');
							$company = $this->Users->get($this->Auth->User('company_id'));
							$posted['logo'] = $company->company_name;
							$logoStatus = "Logo Updated as Company Name due to issue in file upload.";
						}
					}
					//* uploading logo image file ends
				}



				$posted['revision'] = "0.1";
				$posted['user_id'] = $this->Auth->user('id');
				$posted['company_id'] = $company->id;
				$posted['effective_date'] = date('Y-m-d',strtotime($posted['effective_date']));

				$posted = $this->Policies->newEntity($posted,[
					'contain'=>['PolicyApprovers','PolicyChangeHistory','PolicyDefinitions','PolicyResponsibilities','PolicyReviewHistory','PolicyStatements']
				]);

				//debug($posted);



				$saved = $this->Policies->save($posted);
				if($saved){
					$this->Flash->success("Successfully Saved. ".$logoStatus);
				} else {
					$this->Flash->error("Sorry! Not saved. ".$logoStatus);
				}

				$this->redirect(['controller'=>'lab','action'=>'policiesAndStandards']);

			}

		}*/


	public function dashboard($atype=null){

		//getting company with employees
		$this->loadModel('Companies');
		$compRegus = $this->Companies->get($this->Auth->user('company_id'),[
			'contain'=>['Activities.RegulatoryBodies','Employees']
		]);

		//debug($compRegus);
		$compEmpIds = [];
		foreach($compRegus->employees as $emp){
			$compEmpIds[]=$emp->id;
		}
		$compEmpIds = implode(',',$compEmpIds);
		//end of getting company with employees

		//getting Risk Severity Scales to calculate Residual scales
		$this->loadModel('RiskSeverityScales');
		$rs = $this->RiskSeverityScales->find('all',[
			'order'=>[
				'RiskSeverityScales.score'=>'desc'
			]
		])->toArray();

		$scales =[];
		$i=count($rs);
		foreach($rs as $k=>$rscale){
			if($i==0){
				$scales[$rscale['severity_scale']]=[
					//'min'=>0,
					'max'=>$rscale['score'],
					'result'=>$rscale['severity_scale']
				];
			} else {
				$scales[$rscale['severity_scale']]=[
					//'min'=>$rs[$k-1]['score'],
					'max'=>$rscale['score'],
					'result'=>$rscale['severity_scale']
				];
			}
			$i--;
		}

		$this->loadModel('MaturityAttributeOptions');
		$scales2 = $this->MaturityAttributeOptions->find('all',[
			'order'=>[
				'MaturityAttributeOptions.score'=>'desc'
			]
		])->toArray();

		$this->loadModel('ComplianceStatuses');
		$scales3 = $this->ComplianceStatuses->find('all',[
			'order'=>[
				'ComplianceStatuses.score'=>'asc'
			]
		])->toArray();

		$this->loadModel('Assessments');
		$auid = $this->Auth->user('id');
 		$connection = ConnectionManager::get('default');
		/*
		$results = $connection->execute("SELECT YEAR(a.created) AS YEAR, QUARTER(a.created) AS QUARTER, ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
			  FROM assessments a, assessment_risks ar, assessments_regulatory_bodies arb, assessment_controls ac
			 WHERE ((a.id=ar.assessment_id )OR (arb.id=ar.arb_id AND arb.assessment_id=a.id))
			 AND
			 ((a.id=ac.assessment_id )OR (arb.id=ac.arb_id AND arb.assessment_id=a.id)) AND a.status='Completed' AND (a.owner_id='$auid' OR a.requester_id='$auid')
			 GROUP BY YEAR(a.created), QUARTER(a.created)
			 ORDER BY YEAR(a.created), QUARTER(a.created)")->fetchAll('assoc');
		*/


		if($atype=='eGRC'){
			$results = $connection->execute("SELECT
					  `YEAR`,
					  `QUARTER`,
					  ROUND(AVG(inherent_variant),2) AS avgRiskScore,
					  ROUND(AVG(maturity_rating),2) AS avgMRating,
					  ROUND(AVG(compliance_score),2) AS avgCompScore
					FROM ( SELECT
                                    a.id,
                                    YEAR(a.created)      AS `YEAR`,
                                    QUARTER(a.created)   AS `QUARTER`,
                                    ar.inherent_variant,
                                    ac.maturity_rating,
                                    ac.compliance_score
                                  FROM assessments a,
                                    egrc_assessment_risks ar,
                                    egrc_assessment_policies ac
                                  WHERE (a.id = ar.assessment_id)
                                      AND (a.id = ac.assessment_id)
                                      AND a.status = 'Completed'
                                      AND (a.owner_id in ($compEmpIds)
                                            OR a.requester_id in ($compEmpIds))) t2
					GROUP BY `YEAR`,`QUARTER`
					ORDER BY `YEAR`,`QUARTER`")->fetchAll('assoc');
		} else {
			$results = $connection->execute("SELECT
					  `YEAR`,
					  `QUARTER`,
					  ROUND(AVG(inherent_variant),2) AS avgRiskScore,
					  ROUND(AVG(maturity_rating),2) AS avgMRating,
					  ROUND(AVG(compliance_score),2) AS avgCompScore
					FROM (SELECT
					        a.id,
					        YEAR(a.created)     AS `YEAR`,
					        QUARTER(a.created)  AS `QUARTER`,
					        ar.inherent_variant,
					        ac.maturity_rating,
					        ac.compliance_score
					      FROM assessments a,
					        assessment_risks ar,
					        assessments_regulatory_bodies arb,
					        assessment_controls ac
					      WHERE ((a.id = ar.assessment_id)
					              OR (arb.id = ar.arb_id
					                  AND arb.assessment_id = a.id))
					          AND ((a.id = ac.assessment_id)
					                OR (arb.id = ac.arb_id
					                    AND arb.assessment_id = a.id))
					          AND a.status = 'Completed'
					          AND (a.owner_id in ($compEmpIds)
					                OR a.requester_id in ($compEmpIds))UNION SELECT
					                                                a.id,
					                                                YEAR(a.created)      AS `YEAR`,
					                                                QUARTER(a.created)   AS `QUARTER`,
					                                                ar.inherent_variant,
					                                                ac.maturity_rating,
					                                                ac.compliance_score
					                                              FROM assessments a,
					                                                ffiec_assessment_risks ar,
					                                                ffiec_assessment_domains ac
					                                              WHERE (a.id = ar.assessment_id)
					                                                  AND (a.id = ac.assessment_id)
					                                                  AND a.status = 'Completed'
					                                                  AND (a.owner_id in ($compEmpIds)
					                                                        OR a.requester_id in ($compEmpIds))) t2
					GROUP BY `YEAR`,`QUARTER`
					ORDER BY `YEAR`,`QUARTER`")->fetchAll('assoc');
		}


		$labels=[];
		 $yAxis = [];
		 $yAxis2 = [];
		 $yAxixTooltips = [];
		 $yAxix2Tooltips = [];
		 foreach($results as $res){
		 	$labels[]="Qtr ".$res['QUARTER'].", ".$res['YEAR'];
			$yAxis2[]= $res['avgRiskScore']==NULL?0:$res['avgRiskScore'];
			$yAxis[]= $res['avgMRating']==NULL?0:$res['avgMRating'];
			//$yAxixTooltips = [];
		 }
		 $labels="'".implode("','",$labels)."'";
		 $yAxis=implode(",",$yAxis);
		 $yAxis2=implode(",",$yAxis2);
		 $this->set(compact('labels','yAxis','yAxis2'));


		 //for recent assessment results
		$this->loadModel('Assessments');
		if($atype=='eGRC'){
			$thisAssessment = $this->Assessments->find('all',[
				'conditions'=>[
					'or'=>[
						'Assessments.owner_id in ('.$compEmpIds.')',//=>$auid,
						'Assessments.requester_id in ('.$compEmpIds.')'//=>$auid
					],
					'and'=>[
						'Assessments.status'=>'Completed',
						'Assessments.sub_type'=>'eGRC'
					]
				],
				'limit'=>1,
				'order'=>[
					'Assessments.modified'=>'desc'
				]
			])->first();
		} else {
			$thisAssessment = $this->Assessments->find('all',[
				'conditions'=>[
					'or'=>[
						'Assessments.owner_id in ('.$compEmpIds.')',//=>$auid,
						'Assessments.requester_id in ('.$compEmpIds.')'//=>$auid
					],
					'and'=>[
						'Assessments.status'=>'Completed',

					],
					'not'=>[
						'Assessments.sub_type'=>'eGRC',
						'Assessments.sub_type'=>'CMMC'
					]
				],
				'limit'=>1,
				'order'=>[
					'Assessments.modified'=>'desc'
				]
			])->first();
		}



		//debug($thisAssessment);
		$dashData = false;
		if($thisAssessment){
			$dashData = $this->getCompanyDashboardData($thisAssessment->id,$thisAssessment->sub_type);
		}
		/* query without FFIEC Assessments
		$dashStats = $connection->execute("SELECT ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
			  FROM assessments a, assessment_risks ar, assessments_regulatory_bodies arb, assessment_controls ac
			 WHERE ((a.id=ar.assessment_id )OR (arb.id=ar.arb_id AND arb.assessment_id=a.id))
			 AND
			 ((a.id=ac.assessment_id )OR (arb.id=ac.arb_id AND arb.assessment_id=a.id)) AND a.status='Completed'

			  AND (a.owner_id ='$auid' OR a.requester_id ='$auid')
			  group by a.id
			 ORDER BY a.modified desc
			 LIMIT 1")->fetch('assoc');
		*/


		$quarterDates = $this->getPreviousQuarter();
		$minDate = $quarterDates['start'];
		$maxDate = $quarterDates['end'];


		//$maxDate = date('Y-m-t',strtotime('-1 month'));
		//$minDate = date('Y-m-d',strtotime($maxDate. '-3 month +1 day'));

		if($atype=='eGRC'){
			$dashStats = $connection->execute("SELECT ROUND(AVG(avgRiskScore),2) AS avgRiskScore, ROUND(AVG(avgMRating),2) AS avgMRating, ROUND(AVG(avgCompScore),2) AS avgCompScore FROM (
									SELECT ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
									  FROM assessments a, egrc_assessment_risks ar, egrc_assessment_policies ac
									 WHERE ((a.id=ar.assessment_id ))
									 AND
									 (a.id=ac.assessment_id ) AND a.status='Completed'  and a.sub_type!='CMMC'

									  AND (a.owner_id in ($compEmpIds) OR a.requester_id in ($compEmpIds))
									  AND (date(a.modified) between '$minDate' and '$maxDate')
									  GROUP BY a.id
									 ORDER BY a.modified DESC
									 LIMIT 1 ) t2")->fetch('assoc');
		} else {
			//query with FFIEC Assssments
			$dashStats = $connection->execute("SELECT ROUND(AVG(avgRiskScore),2) AS avgRiskScore, ROUND(AVG(avgMRating),2) AS avgMRating, ROUND(AVG(avgCompScore),2) AS avgCompScore FROM (
				SELECT * FROM (
				SELECT  ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
							  FROM assessments a, assessment_risks ar, assessments_regulatory_bodies arb, assessment_controls ac
							 WHERE ((a.id=ar.assessment_id )OR (arb.id=ar.arb_id AND arb.assessment_id=a.id))
							 AND
							 ((a.id=ac.assessment_id )OR (arb.id=ac.arb_id AND arb.assessment_id=a.id)) AND a.status='Completed'  and a.sub_type!='CMMC'

							  AND (a.owner_id in ($compEmpIds) OR a.requester_id in ($compEmpIds))
							  AND (date(a.modified) between '$minDate' and '$maxDate')
							  GROUP BY a.id
							 ORDER BY a.modified DESC
							 LIMIT 1
						) t1

						UNION
				SELECT * FROM
						(
				SELECT ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
							  FROM assessments a, ffiec_assessment_risks ar, ffiec_assessment_domains ac
							 WHERE ((a.id=ar.assessment_id ))
							 AND
							 (a.id=ac.assessment_id ) AND a.status='Completed'  and a.sub_type!='CMMC'

							  AND (a.owner_id in ($compEmpIds) OR a.requester_id in ($compEmpIds))
							  AND (date(a.modified) between '$minDate' and '$maxDate')
							  GROUP BY a.id
							 ORDER BY a.modified DESC
							 LIMIT 1 ) t2

					 ) t3")->fetch('assoc');
		}




		//debug($dashStats);

		foreach($scales as $scale){

			if($dashStats['avgRiskScore']==null ){
				$dashStats['avgRiskScore'] = "No Data Available";
				break;
			} else if(round($dashStats['avgRiskScore'],0)>=$scale['max']){
				$dashStats['avgRiskScore'] = $scale['result'];
				break;
			} else if(round($dashStats['avgRiskScore'],0)<0){
				$dashStats['avgRiskScore'] = "Minor";
				break;
			} else if(round($dashStats['avgRiskScore'],0)<1 && round($dashStats['avgRiskScore'],0)>=0) {
				$dashStats['avgRiskScore'] = 'Minor';
				break;
			}
		}
		$rScls = [];
		foreach($scales as $scl){
			$rScls[$scl['max']] = $scl['result'];
		}
		$this->set('rScales',json_encode($rScls));

		foreach($scales2 as $scale){
			if($dashStats['avgMRating']==null){
				$dashStats['avgMRating'] = "No Data Available";
				break;
			} else if(round($dashStats['avgMRating'],0)>=$scale['score']){
				$dashStats['avgMRating'] = $scale['name'];
				break;
			} else if(round($dashStats['avgMRating'],0)<0){
				$dashStats['avgMRating'] = "Ad hoc";
				break;
			} else if(round($dashStats['avgMRating'],0)<1 && round($dashStats['avgMRating'],0)>=0) {
				$dashStats['avgMRating'] = 'Ad hoc';
				break;
			}
		}
		$mRts = [];
		foreach($scales2 as $scl){
			$mRts[$scl['score']]=$scl['name'];
		}

		$this->set('mRatings',json_encode($mRts));

		//$dashStats['avgCompScore'] =  "5";

		foreach($scales3 as $scale){
			if($dashStats['avgCompScore']==null){
				$dashStats['avgCompScore'] = 'No Data Available';
				break;
			} else if(round($dashStats['avgCompScore'],0)<=$scale['score']){
				$dashStats['avgCompScore'] = $scale['name'];
				break;
			} else if(round($dashStats['avgCompScore'],0)>=4.5){
				$dashStats['avgCompScore'] = "Compliance through independent review";
				break;
			}
		}



		$this->set('dashStats',$dashStats);
		$this->set('dashData',$dashData);

		//render eGRC dashboard
		if($atype=='eGRC'){
			$this->set('egrcNav','eDashboard');
			$this->render('dashboard_egrc');
		} else {
			/* this is Regulation Exposure Section on iRCA Dashboard*/
			// $this->loadModel('Companies');
			// $compRegus = $this->Companies->get($this->Auth->user('company_id'),[
				// 'contain'=>['Activities.RegulatoryBodies','Employees']
			// ]);
//
			// $compEmpIds = [];
			// foreach($compRegus->employees as $emp){
				// $compEmpIds[]=$emp->id;
			// }
			// $compEmpIds = implode(',',$compEmpIds);
			//debug($compEmpIds);

			$reguComplianceData=[];
			foreach($compRegus->activities as $activity){
				if($activity->name=="Banking Services"){

					$exposureData = $connection->execute("SELECT ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
								  FROM assessments a, ffiec_assessment_risks ar, ffiec_assessment_domains ac
								 WHERE ((a.id=ar.assessment_id ))
								 AND
								 (a.id=ac.assessment_id ) AND a.status='Completed'

								  AND (a.owner_id in ($compEmpIds) OR a.requester_id in ($compEmpIds))
								  GROUP BY a.id
								 ORDER BY a.modified DESC
								 LIMIT 1")->fetch('assoc');
					if(empty($exposureData)){
						$exposureData['avgCompScore'] = '&mdash;';
						$exposureData['avgRiskScore'] = '&mdash;';
					} else {


						foreach($scales3 as $scale){
							if($exposureData['avgCompScore']==null){
								$exposureData['avgCompScore'] = 'No Data Available';
								break;
							} else if(round($exposureData['avgCompScore'],0)<=$scale['score']){
								$exposureData['avgCompScore'] = $scale['name'];
								break;
							} else if(round($exposureData['avgCompScore'],0)>=4.5){
								$exposureData['avgCompScore'] = "Compliance through independent review";
								break;
							}
						}

						foreach($scales as $scale){

							if($exposureData['avgRiskScore']==null ){
								$exposureData['avgRiskScore'] = "No Data Available";
								break;
							} else if(round($exposureData['avgRiskScore'],0)>=$scale['max']){
								$exposureData['avgRiskScore'] = $scale['result'];
								break;
							} else if(round($exposureData['avgRiskScore'],0)<0){
								$exposureData['avgRiskScore'] = "Minor";
								break;
							} else if(round($exposureData['avgRiskScore'],0)<1 && round($exposureData['avgRiskScore'],0)>=0) {
								$exposureData['avgRiskScore'] = 'Minor';
								break;
							}
						}
					}
					$reguComplianceData[]=[
						'activity'=>$activity->name,
						'rbody'=>'Federal Financial Institutions Examination Council (FFIEC)',
						'compStatus'=>$exposureData['avgCompScore'],
						'riskExposure'=>$exposureData['avgRiskScore']
					];
				}

				if($activity->name=="Government Contractor Defence Industrial Base (DIB)"){

					$exposureData = $connection->execute("SELECT  ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.score),2) AS avgCompScore
								  FROM assessments a, cmmc_assessment_domains ac
								 WHERE (a.id=ac.assessment_id ) AND a.status='Completed'

								  AND (a.owner_id in ($compEmpIds) OR a.requester_id in ($compEmpIds))
								  GROUP BY a.id
								 ORDER BY a.modified DESC
								 LIMIT 1")->fetch('assoc');
					if(empty($exposureData)){
						$exposureData['avgCompScore'] = '&mdash;';
						$exposureData['avgRiskScore'] = '&mdash;';
					} else {
						$exposureData['avgCompScore'] = round($exposureData['avgCompScore'],0).'% Compliant';
						/*
						foreach($scales3 as $scale){
							if($exposureData['avgCompScore']==null){
								$exposureData['avgCompScore'] = 'No Data Available';
								break;
							} else if(round($exposureData['avgCompScore'],0)<=$scale['score']){
								$exposureData['avgCompScore'] = $scale['name'];
								break;
							} else if(round($exposureData['avgCompScore'],0)>=4.5){
								$exposureData['avgCompScore'] = "Compliance through independent review";
								break;
							}
						}

						foreach($scales as $scale){

							if($exposureData['avgRiskScore']==null ){
								$exposureData['avgRiskScore'] = "No Data Available";
								break;
							} else if(round($exposureData['avgRiskScore'],0)>=$scale['max']){
								$exposureData['avgRiskScore'] = $scale['result'];
								break;
							} else if(round($exposureData['avgRiskScore'],0)<0){
								$exposureData['avgRiskScore'] = "Minor";
								break;
							} else if(round($exposureData['avgRiskScore'],0)<1 && round($exposureData['avgRiskScore'],0)>=0) {
								$exposureData['avgRiskScore'] = 'Minor';
								break;
							}
						} */
					}
					$reguComplianceData[]=[
						'activity'=>$activity->name,
						'rbody'=>'Cybersecurity Maturity Model Certification (CMMC)',
						'compStatus'=>$exposureData['avgCompScore'],
						'riskExposure'=>'&mdash;'
					];
				}

				foreach($activity->regulatory_bodies as $reguBody){
					$exposureData = $connection->execute("SELECT  ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
						  FROM assessments a, assessment_risks ar, assessments_regulatory_bodies arb, assessment_controls ac
						 WHERE ((a.id=ar.assessment_id )OR (arb.id=ar.arb_id AND arb.assessment_id=a.id))
						 AND
						 ((a.id=ac.assessment_id )OR (arb.id=ac.arb_id AND arb.assessment_id=a.id)) AND a.status='Completed'

						  AND (a.owner_id in ($compEmpIds) OR a.requester_id in ($compEmpIds))
						  AND arb.regulatory_body_id='".$reguBody->id."'
						  GROUP BY a.id
						 ORDER BY a.modified DESC
						 LIMIT 1")->fetch('assoc');
					if(empty($exposureData)){
						$exposureData['avgCompScore'] = '&mdash;';
						$exposureData['avgRiskScore'] = '&mdash;';
					} else {


						foreach($scales3 as $scale){
							if($exposureData['avgCompScore']==null){
								$exposureData['avgCompScore'] = 'No Data Available';
								break;
							} else if(round($exposureData['avgCompScore'],0)<=$scale['score']){
								$exposureData['avgCompScore'] = $scale['name'];
								break;
							} else if(round($exposureData['avgCompScore'],0)>=4.5){
								$exposureData['avgCompScore'] = "Compliance through independent review";
								break;
							}
						}

						foreach($scales as $scale){

							if($exposureData['avgRiskScore']==null ){
								$exposureData['avgRiskScore'] = "No Data Available";
								break;
							} else if(round($exposureData['avgRiskScore'],0)>=$scale['max']){
								$exposureData['avgRiskScore'] = $scale['result'];
								break;
							} else if(round($exposureData['avgRiskScore'],0)<0){
								$exposureData['avgRiskScore'] = "Minor";
								break;
							} else if(round($exposureData['avgRiskScore'],0)<1 && round($exposureData['avgRiskScore'],0)>=0) {
								$exposureData['avgRiskScore'] = 'Minor';
								break;
							}
						}
					}
					$reguComplianceData[]=[
						'activity'=>$activity->name,
						'rbody'=>$reguBody->name,
						'compStatus'=>$exposureData['avgCompScore'],
						'riskExposure'=>$exposureData['avgRiskScore'],
						'rbodyId'=>$reguBody->id,
						'activityId'=>$activity->id
					];

				}
			}

			$this->set('reguComplianceData',$reguComplianceData);
			$this->set('compRegus',$compRegus);
			/**/
		}
	}

	/*
	public function dashboard(){
		$this->loadModel('Assessments');
		$auid = $this->Auth->user('id');
 		$connection = ConnectionManager::get('default');
		$results = $connection->execute("SELECT YEAR(a.created) AS YEAR, QUARTER(a.created) AS QUARTER, ROUND(AVG(ar.residual_score),2) avgScore, ROUND(AVG(ac.maturity_rating),2) AS avgComp
			  FROM assessments a, assessment_risks ar, assessments_regulatory_bodies arb, assessment_controls ac
			 WHERE ((a.id=ar.assessment_id )OR (arb.id=ar.arb_id AND arb.assessment_id=a.id))
			 AND
			 ((a.id=ac.assessment_id )OR (arb.id=ac.arb_id AND arb.assessment_id=a.id)) AND a.status='Completed' AND (a.owner_id='$auid' OR a.requester_id='$auid')
			 GROUP BY YEAR(a.created), QUARTER(a.created)
			 ORDER BY YEAR(a.created), QUARTER(a.created)")->fetchAll('assoc');

		 $labels=[];
		 $yAxis = [];
		 $yAxis2 = [];
		 foreach($results as $res){
		 	$labels[]="Qtr ".$res['QUARTER'].", ".$res['YEAR'];
			$yAxis[]= $res['avgScore'];
			$yAxis2[]= $res['avgComp'];
		 }
		 $labels="'".implode("','",$labels)."'";
		 $yAxis=implode(",",$yAxis);
		 $yAxis2=implode(",",$yAxis2);
		 $this->set(compact('labels','yAxis','yAxis2'));
	}
	*/



	// public function login(){
	// 	$this->viewBuilder()->setLayout('ajax');

	// 	if ($this->request->is('post')) {
	//         $user = $this->Auth->identify();

	// 		//$this->session->write('otp.no',"123123");

	//         if ($user) {
	//             $this->Auth->setUser($user);
	// 			if($user['role']=='Super Admin'){
	// 				return $this->redirect(array('controller'=>'users','action'=>'dashboard','_full' => true));
	// 			} elseif($user['role']=='Company'){
	// 				return $this->redirect(array('controller'=>'companies','action'=>'dashboard','_full' => true));
	// 			} else {
	// 				$this->loadModel('Users');
	// 				$comp = $this->Users->get($user['id'],[
	// 					'contain'=>['Companies']
	// 				]);
	// 				$user['company_name'] = $comp->company->company_name;
	// 				$this->Auth->setUser($user);

	// 				return $this->redirect(array('controller'=>'lab','action'=>'dashboard','_full' => true));

	// 			}

	//         }
	//         $this->Flash->error('Your username or password is incorrect.');
	//     }

	// }


	public function login(){
		$this->Auth->logout();

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
		return $this->redirect(array('controller'=>'pages','action'=>'cisohome'));
	}


	public function questionnaire(){
		$employee = $this->Auth->user();

		$this->loadModel('Employees');

		$employee = $this->Employees->get($employee['id'],[
			'contain'=>[
				'Companies'
			]
		]);
		//debug($employee);

		$questionnaire = $this->Employees->Questionnaires->find('all',[
			'conditions'=>[
				'Questionnaires.user_id'=>$employee->id
			]

		])->first();

		if(empty($questionnaire)){
			$this->Flash->error("Sorry! No Questionnaire defined for you. Kindly contact administrator.");
			return $this->redirect($this->referer());
		}

		$this->loadModel('Questions');
		$questions = $this->Questions->find('all',array(
			'conditions'=>array(
				"Questions.id in (".$questionnaire->questions.")"
			),
			'contain'=>array(
				'QuestionOptions'
			)

		))->all();
		$questionnaire->questions = $questions;
		//debug($questionnaire);
		$this->set('questionnaire',$questionnaire);
		$this->set('employee',$employee);

		if($this->request->is(array('put','post'))){
			$data = $this->request->getData();

			/*
			//handle file upload to aws s3 bucket
			$ext = explode('/',$data['signature']['type']);
			$ext = end($ext);
			if(!in_array($ext,array('jpg','png','gif'))){
				$this->Flash->error("Sorry! Only Image files are supported to be uploaded for signatures.");
				return $this->redirect(array('action'=>'questionnaire'));
			} else{
				$tempFile = $data['signature']['tmp_name'];
				$newFile = 'signatures/quest_'.time().'_signatures.'.$ext;
		        $resp = $this->aws->putObject($newFile,$tempFile);
				if($resp['status']=='200'){
					$data['signature'] = $resp['url'];
				} else {
					$this->Flash->error('Sorry! Signature File Upload Error.');
					return $this->redirect(array('action'=>'questionnaire'));
				}
			}
			*/

			$this->loadModel('Questions');
			$answers = array();
			foreach($data['answer'] as $k=>$val){
				$q = $this->Questions->get($k);

				if(is_array($val)){
					$ans = implode(',~',$val);
				} else {
					$ans = $val;
				}
				$answers[] = [
					'question'=>$q->name,
					'answer'=>$ans
				];
			}

			$clientQuest = [
				'name'=>$data['quest_name'],
				'user_id'=>$this->Auth->user('id'),
				'employee_questionnaire_answers'=>$answers,
				'signature'=>$data['signature']
			];


			$newQuest = $this->Employees->EmployeeQuestionnaires->newEntity($clientQuest,[
				'associated'=>['EmployeeQuestionnaireAnswers']
			]);
			$resp = $this->Employees->EmployeeQuestionnaires->save($newQuest,['associated'=>['EmployeeQuestionnaireAnswers']]);
			if($resp){
				if($this->Auth->user('assessments_status')=='Locked'){
					$users = TableRegistry::get('Users');
					$user = $users->get($this->Auth->user('id'));
					$user->assessments_status = 'Unlocked';
					if($users->save($user)){
						$session = $this->getRequest()->getSession();
						$session->write('Auth.User.assessments_status','Unlocked');
					}
				}
				$this->Flash->success("Questionnaire Successfully Saved.");
			} else {
				$this->Flash->error("Sorry! Not successful. Try again.");
			}
			$this->redirect(array('controller'=>'lab','action'=>'dashboard'));
		}

	}

	public function about(){

	}
	public function account(){
		$this->loadModel('Employees');
		$employee = $this->Employees->get($this->Auth->user('id'),[
			'contain'=>[
				'Departments','Companies'
			]
		]);
		$this->set(compact('employee'));
		//debug($employee);
	}
	public function faq(){

	}
	public function services(){

	}
	public function results(){

	}

	public function regulationComplianceWizard(){

		$this->loadModel('Employees');

		if($this->request->is(['put','post'])){
			$posted = $this->request->getData();
			$this->loadModel('Companies');
			$company = [];
			foreach($posted['activities'] as $compId=>$activityIds){
				//getting company with activities
				$company = $this->Companies->get($compId,[
					'contain'=>[
						'Activities'
					]
				]);

				//formatting data to patch to entitiy
				$cdata['id'] = $compId;
				$cdata['activities']['_ids']=$activityIds;

				//patching entity
				$cEntity = $this->Companies->patchEntity($company,$cdata,['associated'=>['Activities']]);

				if($this->Companies->save($cEntity)){
					$this->Flash->success("Activities successfully Mapped to Your Company");
					$this->redirect(array('controller'=>'lab','action'=>'dashboard'));
				} else {
					$this->Flash->error("Sorry! Something went wrong. Kindly try again.");
				}
			}



		}

		$employee = $this->Employees->get($this->Auth->user('id'),[
			'contain'=>[
				'Departments','Companies.Activities'
			]
		]);


		$activities = $this->Employees->Companies->Activities->find('all',[
			'order'=>['sort_order'=>'asc']
		])->all();

		$compActivitiesIds = [];
		foreach($employee->company->activities as $actvty){
			$compActivitiesIds[]=$actvty->id;
		}

		$this->set(compact('employee','activities','compActivitiesIds'));
	}

	public function getActivityRegulations(){
		$this->request->allowMethod(['post', 'delete']);
		//$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$posted = $this->request->getData();

		$this->loadModel('Activities');

		$activities = $this->Activities->find('all',[
			'conditions'=>[
				'id IN'=> explode(',',$posted['activity_ids'])
			],
			'contain'=>['RegulatoryBodies']
		])->all();

		$this->set('activities',$activities);

	}


	public function forgotPassword(){
		if($this->request->is(array('post'))){
			$this->loadModel('Users');
			$data = $this->request->getData();
			$email = $data['company_email'];

			$token = md5($email.time().$this->Auth->user('username'));
			$expiry = date('Y-m-d H:i:s',strtotime('+24 hours'));
			$user = $this->Users->find('all',array(
				'conditions'=>array(
					'Users.email'=>$email,
					'Users.role'=>'Employee'
				)
			))->first();

			if(empty($user)){
				$this->Flash->error("Sorry! This Email does not exists.");
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
						->viewBuilder()->setTemplate('resetpassword');
					$email->viewBuilder()->setLayout('cisolayout');

				    $resp = $email->send();


					if($resp['message']=='success'){
						$this->Flash->success("We have sent an email with reset password link. Kindly check your inbox.");
						$this->redirect(array('controller'=>'lab','action'=>'login'));
					} else {
						$this->Flash->error("Sorry! Something went wrong. Kindly try again.");
					}
				}
			}

		}


		$this->viewBuilder()->setLayout('ajax');
	}

	public function resetPassword($token){
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
			$this->Flash->error("Sorry! Invalid or Expired Token. Kindly re-submit the password change request.");
			return $this->redirect(array('controller'=>'lab','action'=>'forgotPassword'));
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
				$this->Flash->error("Sorry! Invalid Token.");
				return $this->redirect(array('controller'=>'lab','action'=>'forgotPassword'));
			} else {
				$status = preg_match("/^((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,100})$/", $posted['password']);
				if($status==1){
					$udata['password'] = $posted['password'];
					$nuser = $this->Users->patchEntity($nuser,$udata);
					if($this->Users->save($nuser)){
						$this->Flash->success("Successfully Changed your password.");
						return $this->redirect(array('controller'=>'lab','action'=>'login'));
					} else {
						$this->Flash->error("Sorry! Something went wrong. Kindly try forgot password again.");
						//return $this->redirect(array('controller'=>'lab','action'=>'forgotPassword'));
					}
				} else {
					return $this->Flash->error("Sorry! Invalid Password. Kindly check and try again.");
				}
			}

		}



		$user->password = "";
		$this->set(compact('user'));

	}

	public function contactus(){

		if($this->request->is('post')){
			$data = $this->request->getData();
			$email = new Email('Sendgrid');
			$email->setFrom(['info@thecloudciso.com' => 'THE CLOUD CISO'])
			    ->setTo('info@thecloudciso.com')
			    ->setSubject($data['subject'])
			    ->viewVars($data)
				->emailFormat('html')
				->template('contactus','contactus'); //first param is email template file, second one is layout
		    $resp = $email->send();
			if($resp['message']=='success'){
				$email->setFrom(['info@thecloudciso.com' => 'THE CLOUD CISO'])
				    ->setTo($data['email'])
				    ->setSubject('We Received your Query - THE CLOUD CISO')
				    ->viewVars($data)
					->emailFormat('html')
					->template('contactusreply','contactus'); //first param is email template file, second one is layout
			    $resp = $email->send();

				$this->Flash->success("Successfully Submitted. We will contact you soon.");
				$this->redirect(array('action'=>'contactus'));
			} else {
				$this->Flash->error('Sorry! Not submitted. Try again.');
			}
		}


	}



}
