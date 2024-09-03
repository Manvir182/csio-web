<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Controller\Exception\SecurityException;
use Cake\Datasource\ConnectionManager;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    protected $aws=null;

	public function isAuthorized($user){
   		//temporary deny everything after login
	    return false;
	}

    public function initialize()
    {
        parent::initialize();

		//aws bucket Object Initialization for whole application
		$this->aws = TableRegistry::get('CisoS3');

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

		$this->loadComponent('Captcha');
		$this->loadComponent('Otp');

		$this->loadComponent('Auth', [
	  		'authorize'=> 'Controller',
	  		'authError'=>"Sorry! You are not authorized to access this area.",
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'pages',
                'action' => 'home'
            ],
            'logoutAction' => [
                'controller' => 'Pages',
                'action' => 'cisohome'
            ],
             // If unauthorized, return them to page they were just on
            //'unauthorizedRedirect' => false
			'unauthorizedRedirect' => array('controller'=>'pages','action'=>'cisohome'),
			//'logoutRedirect'=>['controller'=>'pages','action'=>'home']

        ]);

		//loading Layouts
		if($this->Auth->user('role')=='Super Admin'){
			$this->viewBuilder()->setLayout('admin');
		} elseif($this->Auth->user('role')=='Company'){
			$this->viewBuilder()->setLayout('admin');
		} elseif($this->Auth->user('role')=='Employee'){
			//$this->viewBuilder()->setLayout('employee');
			$this->viewBuilder()->setLayout('website');
		} else {
			$this->viewBuilder()->setLayout('website');
		}


        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //temporary skipping Security Component for certain actions
		$skipSecurityForActions = array('maturityScoring','riskControlMapping','webhome');
		if(!in_array($this->request->getParam('action'), $skipSecurityForActions)){
			$this->loadComponent('Security');
       		//$this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
			//$this->Security->blackHoleCallback = 'forceSSL';
			//$this->Security->requireSecure();
		}


		$this->set('thisUser',$this->Auth->user());

		//home is website's home page
		$this->Auth->allow(['login','logout','home','cisohome','otpverification','otpvalidate','validate','resendOtp']);
        //$this->Auth->allow();


        //data for info icons and other usage
        $this->loadModel('RiskSeverityScales');
		$cScales = $this->RiskSeverityScales->find('all')->all();
		$this->loadModel('ComplianceStatuses');
		$ceScales = $this->ComplianceStatuses->find('all',['order'=>['ComplianceStatuses.score'=>'desc']])->all();


		$this->loadModel("MaturityDescriptions");
		$mDescs = $this->MaturityDescriptions->find('all',[
			'contain'=>[
				'MaturityAttributes','MaturityAttributeOptions'
			],
			'order'=>[
				'MaturityDescriptions.ma_id'=>'asc',
				'MaturityDescriptions.mao_id'=>'asc'
			]
		])->all();
		$descs = [];
		foreach($mDescs as $k=>$val){
			$descs[$val->maturity_attribute->name][$val->maturity_attribute_option->name] = $val->description;
		}

		$this->loadModel("CmmcMaturityDescriptions");
		$cmDescs = $this->CmmcMaturityDescriptions->find('all',[
			'contain'=>[
				'CmmcMaturityAttributes','CmmcMaturityAttributeOptions'
			],
			'order'=>[
				'CmmcMaturityDescriptions.ma_id'=>'asc',
				'CmmcMaturityDescriptions.mao_id'=>'asc'
			]
		])->all();
		$cdescs = [];
		foreach($cmDescs as $k=>$val){
			$cdescs[$val->cmmc_maturity_attribute->name][$val->cmmc_maturity_attribute_option->name] = $val->description;
		}


		//for maturity rating validation
		$a1 = [];
		$fullComplianceScore = 0;
		$fullComplianceScore2 = 0;
		foreach($ceScales as $k=>$aic){
			$a1[$aic->score]=$aic->name;
			if($k==0){
				$fullComplianceScore = $aic->score;
			}
			if($k==1){
				$fullComplianceScore2 = $aic->score;
			}
		}
		//for maturity rating validation ends

		$this->set(compact('cScales','ceScales','descs','cdescs','a1','fullComplianceScore','fullComplianceScore2'));
        //data for info icons ends

		if($_SERVER['HTTP_HOST']=="localhost"){
			$uProto = "http:";
		} else {
			$uProto = "https:";
		}
		$this->set(compact('uProto'));



		//getting if the mappings are complete or not
		$this->loadModel('GenRcMappings');
		$this->loadModel('RbRcMappings');

		$genMappingPending = $this->GenRcMappings->find()
							->where(['GenRcMappings.status'=>'Pending'])
							->count();
		$RbMappingPending = $this->RbRcMappings->find()
							->where(['RbRcMappings.status'=>'Pending'])
							->count();
		$this->set(compact('genMappingPending','RbMappingPending'));


		//risk color codes
		$rcolors=[
			'Minor'=>'#008000','Major'=>'#ff0000','Moderate'=>'#ffff00','Extreme'=>'#701314','Significant'=>'#ff9900',""=>""
		];
		$this->set('rcolors',$rcolors);

		$this->loadModel('MaturityAttributeOptions');
		$mrScals = $this->MaturityAttributeOptions->find('all')->all();
		$mrScales = [];
		foreach($mrScals as $mrScale){
			$mrScales[$mrScale->score]=$mrScale->name;
		}
		$this->set('mrScales',$mrScales);

		$this->loadModel('FfiecMaturityLevels');
		$fMLevels = $this->FfiecMaturityLevels->find('all')->all();
		$this->set(compact('fMLevels'));



    }

	public function beforeFilter(Event $event){
		//$this->Security->requireSecure();
		/*
		$this->request->addDetector('ssl', array('callback' => function() {
            return CakeRequest::header('X-Forwarded-Proto') == 'https';
        }));

		$this->Security->requireSecure();
		*/
		//debug($_SERVER);
	}

	/*
	public function forceSSL(){
		if(!$this->request->is('ssl')){
			return $this->redirect('https://' . $_SERVER('SERVER_NAME') . Router::url($this->request->getRequestTarget()));
		}
	}
	*/
	public function forceSSL( $error = '', SecurityException $exception = null)
    {
        if ($exception instanceof SecurityException && $exception->getType() === 'secure') {
            return $this->redirect('https://' . env('SERVER_NAME') . Router::url($this->request->getRequestTarget()));
        }
        throw $exception;
    }


	public function getCompanyDashboardData($id = null,$subType=null) {

		$this->loadModel('Assessments');
    	if($subType=='Regulated'){
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','Users.Companies','AssessmentsRegulatoryBodies.RegulatoryBodies','AssessmentsRegulatoryBodies.AssessmentSeverityScales','AssessmentsRegulatoryBodies.AssessmentRisks','AssessmentsRegulatoryBodies.AssessmentControls','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores','AssessmentsRegulatoryBodies.AssessmentControls.RcMappings','AssessmentsRegulatoryBodies.RcMappings.AssessmentRisks','AssessmentsRegulatoryBodies.RcMappings.AssessmentControls']
	        ]);

			$rcmappings = [];

			foreach($assessment->assessments_regulatory_bodies as $ke=>$rbody){
				$table = array();
				$cols=array();
				$colids = array();
				foreach($rbody->rc_mappings as $k=>$map){
					$table[$map->assessment_control->name][$map->assessment_risk->id]= $map;
					$colids[] = $map->assessment_risk->id;
					$cols[]=$map->assessment_risk->risk;
				}
				$colids=array_unique($colids);
				$cols=array_unique($cols);

				$rcmappings[$ke] = $rbody->regulatory_body;
				$rcmappings[$ke]['mappings'] = [
					'table'=>$table,
					'risk_ids'=>$colids,
					'risks'=>$cols
				];

			}

			$this->set(compact('rcmappings'));

			$response = [
				'rcmappings'=>$rcmappings
			];


    	} elseif($subType=='FFIEC Regulated') {
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','Users.Companies','FfiecAssessmentRisks.FfiecAssessmentRiskFactors','AssessmentSeverityScales','FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements','FfiecAssessmentDomains.FfiecAssessmentMaturityScores','FfiecAssessmentDomains.FfiecRcMappings','FfiecRcMappings.FfiecAssessmentRisks','FfiecRcMappings.FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements']
	        ]);

			$table = array();
			$cols=array();
			$colids = array();
			//for managing Exceptions
			$exceptions = [];
			//generating table headers
			$excepHeaders[]=["Findings / Exceptions"];

			foreach($assessment->ffiec_assessment_risks as $eaRisks){
				$excepHeaders[1][$eaRisks->id] = $eaRisks->risk;
			}
			//generationg table headers ends
			$expConditions = ['Partially Compliant','Non Compliant'];
			//debug($assessment);
			$expControls = [];
			foreach($assessment->ffiec_assessment_domains as $aCont){

				if(in_array($aCont->compliance_status,$expConditions)){

					foreach($aCont->ffiec_assessment_domain_a_factors as $facReq){
						foreach($facReq->ffiec_assessment_domain_requirements as $acReq){
							if(in_array($acReq->compliance_status,$expConditions)){
								$expControls[$aCont->name][$facReq->name][] = $acReq->name;
							}
						}
					}

				}
				$excepHeaders[2][$aCont->id] = $aCont->name;
			}
			//debug($excepHeaders);
			//for managing exceptions ends

			$expTable=[];
			foreach($assessment->ffiec_rc_mappings as $k=>$map){
				$table[$map->ffiec_assessment_domain->name][$map->ffiec_assessment_risk->id]= $map;
				$colids[] = $map->ffiec_assessment_risk->id;
				$cols[]=$map->ffiec_assessment_risk->risk;

				if(in_array($map->ffiec_assessment_domain->compliance_status,$expConditions)){
					$exps="";
					foreach($map->ffiec_assessment_domain->ffiec_assessment_domain_a_factors as $facReq){
						foreach($facReq->ffiec_assessment_domain_requirements as $acReq){
							if(in_array($acReq->compliance_status,$expConditions)){
								$exps.=$acReq->name."\n";
							}
						}
					}
					$exps = substr($exps,0,-2);
					if(strlen($exps)>0){
						$expTable[$map->ffiec_assessment_domain->id."~~".$exps][$map->ffiec_assessment_risk->id] = $map->mapping;
					}

				}
			}
			//debug($expTable);

			$colids=array_unique($colids);
			$cols=array_unique($cols);

			//$this->set('risks',$cols);
			//$this->set('risk_ids',$colids);
			//$this->set('table',$table);

			//$this->set(compact('expTable','excepHeaders','excel'));



			$response = [
				'risks'=>$cols,
				'risk_ids'=>$colids,
				'table'=>$table,
				'expTable'=>$expTable,
				'excepHeaders'=>$excepHeaders
			];


    	} elseif($subType=='eGRC') {

    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','Users.Companies','EgrcAssessmentRisks','AssessmentSeverityScales','EgrcAssessmentPolicies.EgrcAssessmentPolicyStatements','EgrcAssessmentPolicies.EgrcAssessmentMaturityScores','EgrcAssessmentPolicies.EgrcRcMappings','EgrcRcMappings.EgrcAssessmentRisks','EgrcRcMappings.EgrcAssessmentPolicies.EgrcAssessmentPolicyStatements']
	        ]);


			$table = array();
			$cols=array();
			$colids = array();
			//for managing Exceptions
			$exceptions = [];
			//generating table headers
			$excepHeaders[]=["Findings / Exceptions"];

			foreach($assessment->egrc_assessment_risks as $eaRisks){
				$excepHeaders[1][$eaRisks->id] = $eaRisks->risk;
			}
			//generationg table headers ends
			$expConditions = ['Partially Compliant','Non Compliant'];
			//debug($assessment);
			$expControls = [];
			foreach($assessment->egrc_assessment_policies as $aCont){

				if(in_array($aCont->compliance_status,$expConditions)){

					foreach($aCont->egrc_assessment_policy_statements as $acReq){
						if(in_array($acReq->compliance_status,$expConditions)){
							$expControls[$aCont->name][] = $acReq->name;
						}
					}

				}
				$excepHeaders[2][$aCont->id] = $aCont->name;
			}
			//debug($excepHeaders);
			//for managing exceptions ends

			$expTable=[];
			foreach($assessment->egrc_rc_mappings as $k=>$map){
				$table[$map->egrc_assessment_policy->name][$map->egrc_assessment_risk->id]= $map;
				$colids[] = $map->egrc_assessment_risk->id;
				$cols[]=$map->egrc_assessment_risk->risk;

				if(in_array($map->egrc_assessment_policy->compliance_status,$expConditions)){
					$exps="";
					foreach($map->egrc_assessment_policy->egrc_assessment_policy_statements as $acReq){
						if(in_array($acReq->compliance_status,$expConditions)){
							$exps.=$acReq->name."\n";
						}
					}
					$exps = substr($exps,0,-2);
					if(strlen($exps)>0){
						$expTable[$map->egrc_assessment_policy->id."~~".$exps][$map->egrc_assessment_risk->id] = $map->mapping;
					}

				}
			}
			//debug($expTable);

			$colids=array_unique($colids);
			$cols=array_unique($cols);




			$response = [
				'risks'=>$cols,
				'risk_ids'=>$colids,
				'table'=>$table,
				'expTable'=>$expTable,
				'excepHeaders'=>$excepHeaders
			];


    	} else {
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','Users.Companies','AssessmentRisks','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores','AssessmentControls.RcMappings','RcMappings.AssessmentRisks','RcMappings.AssessmentControls.AssessmentControlRequirements']
	        ]);


			$table = array();
			$cols=array();
			$colids = array();
			//for managing Exceptions
			$exceptions = [];
			//generating table headers
			$excepHeaders[]=["Findings / Exceptions"];

			foreach($assessment->assessment_risks as $eaRisks){
				$excepHeaders[1][$eaRisks->id] = $eaRisks->risk;
			}
			//generationg table headers ends
			$expConditions = ['Partially Compliant','Non Compliant'];
			//debug($assessment);
			$expControls = [];
			foreach($assessment->assessment_controls as $aCont){

				if(in_array($aCont->compliance_status,$expConditions)){

					foreach($aCont->assessment_control_requirements as $acReq){
						if(in_array($acReq->compliance_status,$expConditions)){
							$expControls[$aCont->name][] = $acReq->name;
						}
					}

				}
				$excepHeaders[2][$aCont->id] = $aCont->name;
			}
			//debug($excepHeaders);
			//for managing exceptions ends

			$expTable=[];
			foreach($assessment->rc_mappings as $k=>$map){
				$table[$map->assessment_control->name][$map->assessment_risk->id]= $map;
				$colids[] = $map->assessment_risk->id;
				$cols[]=$map->assessment_risk->risk;

				if(in_array($map->assessment_control->compliance_status,$expConditions)){
					$exps="";
					foreach($map->assessment_control->assessment_control_requirements as $acReq){
						if(in_array($acReq->compliance_status,$expConditions)){
							$exps.=$acReq->name."\n";
						}
					}
					$exps = substr($exps,0,-2);
					if(strlen($exps)>0){
						$expTable[$map->assessment_control->id."~~".$exps][$map->assessment_risk->id] = $map->mapping;
					}

				}
			}
			//debug($expTable);

			$colids=array_unique($colids);
			$cols=array_unique($cols);

			//$this->set('risks',$cols);
			//$this->set('risk_ids',$colids);
			//$this->set('table',$table);

			//$this->set(compact('expTable','excepHeaders','excel'));



			$response = [
				'risks'=>$cols,
				'risk_ids'=>$colids,
				'table'=>$table,
				'expTable'=>$expTable,
				'excepHeaders'=>$excepHeaders
			];


    	}

		//debug($assessment);

		$this->loadModel('ComplianceStatuses');
		$this->loadModel('RiskSeverityScales');

		$response['compStatuses']=$this->ComplianceStatuses->find('all')->all();
		$response['riskScales']=$this->RiskSeverityScales->find('all')->all();
		$response['assessment']=$assessment;

		return $response;

    } //end of getting company dashboard data.



	public function getPreviousQuarter(){
		$quarters = [
			['Jan','Feb','Mar'],
			['Apr','May','Jun'],
			['Jul','Aug','Sep'],
			['Oct','Nov','Dec']
		];

		$month = date('M');
		$q=null;
		foreach($quarters as $kk=>$quarter){
			if(in_array($month,$quarter)){
				$q = $kk+1;
				break;
			}
		}

		$year = date('Y');
		if($q==1){
			$year = date('Y',strtotime('-1 year'));
		}

		$prevQuarterDates = [
			'1'=>[
				'start'=>date('Y-m-d',strtotime($year.'-10-01')),
				'end'=>date('Y-m-t',strtotime($year.'-12-31'))
			],
			'2'=>[
				'start'=>date('Y-m-d',strtotime($year.'-01-01')),
				'end'=>date('Y-m-t',strtotime($year.'-03-31'))
			],
			'3'=>[
				'start'=>date('Y-m-d',strtotime($year.'-04-01')),
				'end'=>date('Y-m-t',strtotime($year.'-06-30'))
			],
			'4'=>[
				'start'=>date('Y-m-d',strtotime($year.'-07-01')),
				'end'=>date('Y-m-t',strtotime($year.'-09-30'))
			],
		];


		return $prevQuarterDates[$q];


	}


}
