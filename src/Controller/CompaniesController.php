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
class CompaniesController extends AppController
{

	public function isAuthorized($user){
		if($user['role']=="Super Admin"){
			return true;
		} else {
			if($user['role']=="Company" && $this->getRequest()->getParam('action')=='dashboard'){
				return true;
			}
			return false;
		}
	}

	public function initialize(){
		parent::initialize();
		$this->Auth->allow(['register','forgotPassword','resetPassword']);
		$this->set('pageHeading','Companies');

		$this->Auth->setConfig('authenticate', [
	            'Form' => [
	                'finder' => 'suspended',
	                'fields' => ['username' => 'email', 'password' => 'password']
	            ]
	        ]
		);

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

	    $this->Auth->logout();
		return $this->redirect(array('controller'=>'pages','action'=>'cisohome'));
	}

	public function dashboard(){

		//getting company with employees
		$this->loadModel('Companies');
		$compRegus = $this->Companies->get($this->Auth->user('id'),[
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



		//getting employees of this company
		$connection = ConnectionManager::get('default');
		$compEmps = $connection->execute("SELECT GROUP_CONCAT(id) auids FROM users WHERE company_id='".$this->Auth->user('id')."'")->fetchAll('assoc');

		$auids = explode(',',$compEmps[0]['auids']);
		$auids = implode("','",$auids);


		/*
		$results = $connection->execute("SELECT YEAR(a.created) AS YEAR, QUARTER(a.created) AS QUARTER, ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
			  FROM assessments a, assessment_risks ar, assessments_regulatory_bodies arb, assessment_controls ac
			 WHERE ((a.id=ar.assessment_id )OR (arb.id=ar.arb_id AND arb.assessment_id=a.id))
			 AND
			 ((a.id=ac.assessment_id )OR (arb.id=ac.arb_id AND arb.assessment_id=a.id)) AND a.status='Completed' AND
			 (a.owner_id in ('$auids') OR a.requester_id in ('$auids'))
			 GROUP BY YEAR(a.created), QUARTER(a.created)
			 ORDER BY YEAR(a.created), QUARTER(a.created)")->fetchAll('assoc');
		*/
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
						          AND (a.owner_id in ('$auids')
						                OR a.requester_id in ('$auids'))
						     UNION
						      SELECT
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
                                  AND (a.owner_id  in ('$auids')
                                        OR a.requester_id  in ('$auids'))) t2
						GROUP BY `YEAR`,`QUARTER`
						ORDER BY `YEAR`,`QUARTER`")->fetchAll('assoc');


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


		$this->set('pageHeading',"Dashboard - ".$this->Auth->user('company_name'));




		//for recent assessment results
		$this->loadModel('Assessments');
		$thisAssessment = $this->Assessments->find('all',[
			'conditions'=>[
				'or'=>[
					'Assessments.owner_id in '=>explode(',',$compEmps[0]['auids']),
					'Assessments.requester_id in '=>explode(',',$compEmps[0]['auids'])
				],
				'and'=>[
					'Assessments.status'=>'Completed',
					//'Assessments.modified = max(Assessments.modified)'
				]
			],
			'limit'=>1,
			'order'=>[
				'Assessments.modified'=>'desc'
			]
		])->first();

		$dashData = null;
		if($thisAssessment){
			$dashData = $this->getCompanyDashboardData($thisAssessment->id,$thisAssessment->sub_type);
		}

		/*
		$dashStats = $connection->execute("SELECT ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
			  FROM assessments a, assessment_risks ar, assessments_regulatory_bodies arb, assessment_controls ac
			 WHERE ((a.id=ar.assessment_id )OR (arb.id=ar.arb_id AND arb.assessment_id=a.id))
			 AND
			 ((a.id=ac.assessment_id )OR (arb.id=ac.arb_id AND arb.assessment_id=a.id)) AND a.status='Completed'

			  AND (a.owner_id IN ('$auids') OR a.requester_id IN ('$auids'))
			  group by a.id
			 ORDER BY a.modified desc
			 LIMIT 1")->fetch('assoc');
			*/
		$quarterDates = $this->getPreviousQuarter();
		$minDate = $quarterDates['start'];
		$maxDate = $quarterDates['end'];

		$dashStats = $connection->execute("SELECT ROUND(AVG(avgRiskScore),2) AS avgRiskScore, ROUND(AVG(avgMRating),2) AS avgMRating, ROUND(AVG(avgCompScore),2) AS avgCompScore FROM (
					SELECT * FROM (
					SELECT  ROUND(AVG(ar.inherent_variant),2) avgRiskScore, ROUND(AVG(ac.maturity_rating),2) AS avgMRating, ROUND(AVG(ac.compliance_score),2) AS avgCompScore
								  FROM assessments a, assessment_risks ar, assessments_regulatory_bodies arb, assessment_controls ac
								 WHERE ((a.id=ar.assessment_id )OR (arb.id=ar.arb_id AND arb.assessment_id=a.id))
								 AND
								 ((a.id=ac.assessment_id )OR (arb.id=ac.arb_id AND arb.assessment_id=a.id)) AND a.status='Completed'

								  AND (a.owner_id  IN ('$auids') OR a.requester_id  IN ('$auids'))
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
								 (a.id=ac.assessment_id ) AND a.status='Completed'

								  AND (a.owner_id  IN ('$auids') OR a.requester_id  IN ('$auids'))
								  AND (date(a.modified) between '$minDate' and '$maxDate')
								  GROUP BY a.id
								 ORDER BY a.modified DESC
								 LIMIT 1 ) t2

								 ) t3")->fetch('assoc');





		foreach($scales as $scale){

			if($dashStats['avgRiskScore']==null){
				$dashStats['avgRiskScore'] = 'No Data Available';
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

		//debug($dashStats['avgMRating']);
		foreach($scales2 as $scale){
			if($dashStats['avgMRating']==null){
				$dashStats['avgMRating'] = 'No Data Available';
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




		//debug($dashStats);

		$this->set('dashStats',$dashStats);
		$this->set('dashData',$dashData);
		//debug($dashData);

	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $users = $this->paginate($this->Companies,array('conditions'=>array('Companies.role'=>'Company','Companies.registration_status'=>'Approved')));

        $this->set(compact('users'));
    }

	public function register($msg=null){

		$this->viewBuilder()->setLayout('website');

		$company = $this->Companies->newEntity();
        if ($this->request->is('post')) {
        	/*google recaptcha code
			 * */

			$posted = $this->request->getData();

			/*$url = 'https://www.google.com/recaptcha/api/siteverify';
			$data = array(
				'secret' => '6LeomqMUAAAAAHrpAWcaRIW8G-wN2OB-dsvSNAzg',
				'response' => $posted["g-recaptcha-response"]
			);
			$options = array(
				'http' => array (
					'header'=>"Content-Type: application/x-www-form-urlencoded\r\n".
			                    "Content-Length: ".strlen(http_build_query($data))."\r\n".
			                    "User-Agent:MyAgent/1.0\r\n",
					'method' => 'POST',
					'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$verify = file_get_contents($url, false, $context);
			$captcha_success=json_decode($verify);
			*/
			/*
			 * recaptcha ends
			 */
			$captchaStatus = $this->Captcha->validate($posted['captcha']);

			if($captchaStatus=='invalid'){
				$this->Flash->error(__('Sorry! Captcha not verified. Try again.'));
			} else {
				$cdata = $this->Companies->find('all',array(
					'fields'=>array(
						'company_code'=>'(MAX(Companies.id)+10000+1)'
					)
				))->first();
				$company_code = "C".$cdata->company_code;

	            $company = $this->Companies->patchEntity($company, $this->request->getData());
				$company->company_code = $company_code;
				$company->username = $posted['email'];
				$company->source = 'Registration';
				$company->role = "Company";
				$company->subscribed=$posted['subscribed']==1?'Yes':'No';
				//debug($company);

				if ($this->Companies->save($company)) {
	                $this->Flash->success(__('Congratulations! Your registration request is successfully placed. we will get back to you soon.'));
					$posted['ccode'] = $company_code;
					$email = new Email('Sendgrid');
					$email->setFrom(['info@thecloudciso.com' => 'THE CLOUD CISO'])
					    ->setTo($posted['email'])
					    ->setSubject("Registration Request Submitted - THE CLOUD CISO")
					    ->setViewVars($posted)
						->setEmailFormat('html')
						->viewBuilder()->setTemplate('registration');
					$email->viewBuilder()->setLayout('cisolayout');
						//->template('registration','cisolayout'); //first param is email template file, second one is layout
				    $resp = $email->send();

					/*
					//sending notification to super admin
					$nemail = new Email('Sendgrid');
					$nemail->setFrom(['info@thecloudciso.com' => 'THE CLOUD CISO'])
					    ->setTo('info@thecloudciso.com')
					    //->setTo('dk6418460@gmail.com')
					    ->setSubject("Registration Request Submitted  by ".$posted['first_name']." - THE CLOUD CISO")
					    ->setViewVars($posted)
						->setEmailFormat('html')
						->viewBuilder()->setTemplate('regnotification');
					$nemail->viewBuilder()->setLayout('cisolayout');
						//->template('registration','cisolayout'); //first param is email template file, second one is layout
				    $resp = $nemail->send();
					*/
	                return $this->redirect(['action' => 'register','success']);
	            }


	            $this->Flash->error(__('Sorry! Something went wrong. Please, check & try again.'));

			}

        }

		$this->Captcha->generateCaptcha();
		//$session = $this->request->getSession();
		//debug($session->read('captcha'));


        $this->set(compact('company','msg'));


	}

	 public function companyRequests()
    {
    	$users = $this->paginate($this->Companies,array('conditions'=>array(
			'and'=>array('Companies.role'=>'Company','Companies.registration_status'=>'Pending','Companies.source'=>'Registration')
		)));

        $this->set(compact('users'));
    }

	public function approveRequest($id=null){
		$this->autoRender = false;
		$this->request->allowMethod(['post']);
		$company = $this->Companies->get($id);
		$company->registration_status="Approved";
		;
		$company->reg_status_date = date('Y-m-d H:i:s');
		//debug($company);

        if ($this->Companies->save($company)) {
            $this->Flash->success(__('The Company has been Approved.'));
        } else {
            $this->Flash->error(__('The Company has not been Approved.. Please, try again.'));
        }

        return $this->redirect($this->referer());

	}

	public function rejectRequest($id=null){
		$this->autoRender = false;
		$this->request->allowMethod(['post']);
		$company = $this->Companies->get($id);
		$company->registration_status="Rejected";
		$company->reg_status_date = date('Y-m-d H:i:s',time());

        if ($this->Companies->save($company)) {
        	$arr = json_decode(json_encode($company), true);
			$email = new Email('Sendgrid');
			$email->setFrom(['info@thecloudciso.com' => 'THE CLOUD CISO'])
			    ->setTo($arr['email'])
			    ->setSubject("Account Request Denied - THE CLOUD CISO")
			    ->setViewVars($arr)
				->setEmailFormat('html')
				->viewBuilder()->setTemplate('rejected');
			$email->viewBuilder()->setLayout('cisolayout');
				//->template('registration','cisolayout'); //first param is email template file, second one is layout
		    $resp = $email->send();

			$this->Companies->delete($company);

            $this->Flash->success(__('The Company has been Rejected.'));
        } else {
            $this->Flash->error(__('The Company has not been Rejected.. Please, try again.'));
        }

        return $this->redirect(['controller'=>'companies','action'=>'companyRequests']);
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
        $company = $this->Companies->get($id, [
            //'contain' => ['Assessments', 'Clients'],
            'conditions'=> ['Companies.role'=>'Company']
        ]);

		//for suspension of company's account
		if($this->request->is(['PUT','POST'])){
			$posted = $this->request->getData();
			$patched = $this->Companies->patchEntity($company,$posted);
			$patched->registration_status = "Suspended";
			$patched->reg_status_date = date('Y-m-d H:i:s',time());
			debug($patched);

			if($this->Companies->save($patched)){
				$arr = json_decode(json_encode($patched), true);

				//sendign email to company admin
				$email = new Email('Sendgrid');
				$email->setFrom(['info@thecloudciso.com' => 'THE CLOUD CISO'])
				    ->setTo($arr['email'])
				    ->setSubject("Account Suspended - THE CLOUD CISO")
				    ->setViewVars($arr)
					->setEmailFormat('html')
					->viewBuilder()->setTemplate('suspension');
				$email->viewBuilder()->setLayout('cisolayout');
					//->template('registration','cisolayout'); //first param is email template file, second one is layout
			    $resp = $email->send();

				$this->Flash->success("Company successfully Suspended.");

			} else {
				$this->Flash->error("Sorry! Something went wrong. Please, try again.");
			}
			$this->redirect($this->referer());

		}




		$company->password = '';

        $this->set('company', $company);
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
					'Users.role'=>'Company',
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
						->viewBuilder()->setTemplate('resetpasswordforcompany');
					$email->viewBuilder()->setLayout('cisolayout');

				    $resp = $email->send();


					if($resp['message']=='success'){
						$this->Flash->success("We have sent an email with reset password link. Kindly check your inbox.");
						$this->redirect(array('_name'=>'company-login'));
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
			return $this->redirect(array('controller'=>'companies','action'=>'forgotPassword'));
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
							return $this->redirect(array('_name'=>'company-login'));
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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $company = $this->Companies->newEntity();
        if ($this->request->is('post')) {
        	$posted = $this->request->getData();
        	$cdata = $this->Companies->find('all',array(
				'fields'=>array(
					'company_code'=>'(MAX(Companies.id)+10000+1)'
				)
			))->first();
			$company_code = "C".$cdata->company_code;

            $company = $this->Companies->patchEntity($company, $this->request->getData());
			$company->company_code = $company_code;
			$company->registration_status = "Approved";
			$company->reg_status_date = date('Y-m-d H:i:s');
			$company->source = 'Admin';
			$company->subscribed=$posted['subscribed']==1?'Yes':'No';
			if ($this->Companies->save($company)) {
                $this->Flash->success(__('The Company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Company could not be saved. Please, try again.'));

        }
        $this->set(compact('company'));
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
        $company = $this->Companies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

			$posted = $this->request->getData();
			//debug($posted);
            $company = $this->Companies->patchEntity($company, $this->request->getData());
			$company->subscribed=$posted['subscribed']==1?'Yes':'No';
			//debug($company);

            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The Company has been modified.'));

                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The Company could not be updated. Please, try again.'));

        }
		$company->password = '';
        $this->set(compact('company'));
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
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

	// public function tprm()
	// {
	// 	$this->loadModel('FfiecRisks');
	// 	$fRisks = $this->FfiecRisks->find('all',[
	// 		'contain'=>['FfiecRiskFactors']
	// 	])->all();
	// 	$this->set(compact('fRisks'));

	// 	// $this->viewBuilder()->setLayout('tprm');
	// }
}
