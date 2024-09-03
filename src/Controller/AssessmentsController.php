<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Query;
/**
 * Assessments Controller
 *
 * @property \App\Model\Table\AssessmentsTable $Assessments
 *
 * @method \App\Model\Entity\Assessment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssessmentsController extends AppController
{
	public $companyId = null;
	public $compActions=['assessmentRepeat','egrcRcmapping','updateResidual','policyMaturityRating','delete','deleteArtifactFfiec','deleteArtifactFromAdmin','ffiecRcmapping','uploadArtifactForFfiec','domainMaturityRating','saveInstantFactor','selfAssessments','saveInstantUpdate','uploadArtifactFromAdmin','exportResultReport','rcmapping','controlMaturityRating','toggleStatus','view','viewResult'];

	public function isAuthorized($user){
		$empActions = ['assessmentRepeat','assessmentRequestCmmc','cmmcCapabilityMaturity','updateFfiecControlFactor','getRiskScaleByScore2','egrcRcmapping','policyMaturityRating','assessmentRequestEgrc','getRisksAndControlsReassess','deleteArtifactEgrc','deleteArtifactCmmc','updateResidulal','deleteArtifactFfiec','deleteArtifactFromAdmin','ffiecRcmapping','uploadArtifactForFfiec','domainMaturityRating','uploadArtifactForCmmc','uploadArtifactForEgrc','saveInstantFactor','uploadArtifact','view','saveInstantUpdate','uploadArtifactFromAdmin','exportResultReport','viewResult','completeAssessmentRequest','rcmapping','controlMaturityRating','toggleStatus','completeRegulatedAssessmentRequest','assessmentRequest','getRisksAndControls','getRisksAndControlsRegulated','tracking'];
		//$this->compActions = ['selfAssessments','rcmapping','controlMaturityRating','toggleStatus','view','viewResult'];
		if($user['role']=="Employee" && (in_array($this->getRequest()->getParam('action'),$empActions))){
			return true;
		} elseif($user['role']=="Company" && (in_array($this->getRequest()->getParam('action'),$this->compActions))){
			return true;
		} elseif($user['role']=='Super Admin') {
			return true;
		}
		elseif($user['role']=='Analysts') {
			return true;
		}
		 else {
			return false;
		}

	}
	public function initialize(){
		parent::initialize();
		//debug($this->compActions);
		$this->set('pageHeading','Assessments');

		if($this->Auth->user('role')=='Employee'){
			$this->viewBuilder()->setLayout('lab');
		}

		$this->Security->setConfig('unlockedActions', ['updateFfiecControlFactor','cmmcCapabilityMaturity','getRiskScaleByScore2','assessmentRepeat','tracking','deleteArtifactFfiec','deleteArtifactEgrc','deleteArtifactCmmc', 'deleteArtifactFromAdmin','uploadArtifactFromAdmin','domainMaturityRating','policyMaturityRating','uploadArtifactForFfiec','uploadArtifactForCmmc','uploadArtifactForEgrc','saveInstantFactor','saveInstantUpdate','uploadArtifact','rcmapping','egrcRcmapping','assessmentRequest','completeAssessmentRequest','completeRegulatedAssessmentRequest','controlMaturityRating']);

		$thisUser = $this->Auth->user();
		if($thisUser['role']=='Company'){
			$this->companyId = $thisUser['id'];
		} else if($thisUser['role']=='Employee'){
			$this->companyId = $thisUser['company_id'];
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
            'contain' => [ 'Requesters']
        ];
        $assessments = $this->paginate($this->Assessments);

        $this->set(compact('assessments'));
    }


	//list assessments to super admin
	public function listAssessments(){
    	$this->paginate = [
            'contain' => ['Users.Companies'],
            //'conditions'=>['Assessments.status !='=>'Submitting']
            'conditions'=>["Assessments.status!='Submitting'","Assessments.atype!='Self'"]
        ];
		$assessments = $this->paginate($this->Assessments);
		//debug($assessments);

		$this->set(compact('assessments'));
    }

	//list assessments to Company
	public function selfAssessments(){

		$ast = $this->Assessments->find()
			->where(['Assessments.atype'=>'Self'])
			->contain(['Users.Companies'])
			->matching('Users', function ($q) {
			    return $q->where(['Users.company_id' => $this->Auth->user('id')]);
			});


		$assessments = $this->paginate($ast);


		$this->set(compact('assessments'));
		$this->render('list_assessments');
    }

	public function ffiecRcmapping($aid){
		if($this->Auth->user('role')=='Company'){
			if($this->isCompanyAssessment($aid)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
				return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
			}
		}

		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($aid)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in user.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			}
		}

		$this->loadModel('FfiecRcMappings');
		//if mapping base data exists in the table then load from table
		$rcmappings = $this->FfiecRcMappings->find('all',[
			'conditions'=>['FfiecRcMappings.assessment_id'=>$aid],
			'contain'=>['FfiecAssessmentRisks','FfiecAssessmentDomains']
		])->all();
		//debug($rcmappings);
		$table = array();
		$cols=array();
		$colids = array();

		foreach($rcmappings as $k=>$map){
			$table[$map->ffiec_assessment_domain->name][$map->ffiec_assessment_risk->id]= $map;
			$colids[] = $map->ffiec_assessment_risk->id;
			$cols[]=$map->ffiec_assessment_risk->name;

		}
		//debug($cols);
		$colids=array_unique($colids);
		$cols=array_unique($cols);
		//debug($colids);
		$assessment = $this->Assessments->get($aid,[
			'contain'=>[
				'Users.Companies'
			]
		]);

		$this->set('assessment',$assessment);
		$this->set('table',$table);
		$this->set('risks',$cols);
		$this->set('risk_ids',$colids);



	}

	public function egrcRcmapping($aid,$sub_type){
		if($this->Auth->user('role')=='Company'){
			if($this->isCompanyAssessment($aid)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
				return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
			}
		}

		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($aid)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in user.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			}
		}

		if($this->request->is(['put','post'])){


			$data = $this->request->getData();

			$fdata = array();
			foreach($data as $map=>$value){
				$mid = explode('~',$map);
				$mid = end($mid);
				$fdata[] = [
					'id'=>$mid,
					'mapping'=>$value,
					'egrc_assessment_policies'=>[
						'mapping_status'=>'Completed'
					]
				];
			}
			if(empty($fdata)){
				$connection = ConnectionManager::get('default');
				$results = $connection->execute("update egrc_assessment_policies set mapping_status='Completed' where assessment_id='$aid'");
				if($results){
					$this->Flash->success("Successfully Updated.");
				} else {
					$this->Flash->error("Sorry! Not Successful. Try again.");
				}

			} else {
				$rcMapping = TableRegistry::get('EgrcRcMappings');
				$rcentities = $rcMapping->patchEntities($fdata,$fdata);
				//debug($rcentities);
				//for updating status of mapping for controls
				$cids = [];
				foreach($rcentities as $cEntity){
					$cids[]=$cEntity->egrc_assessment_policy_id;
				}
				$cids = implode("','", array_unique($cids));

				$cids = $this->Assessments->EgrcAssessmentPolicies->find('all',[
					'conditions'=>[
						"EgrcAssessmentPolicies.id in ('".$cids."')"
					]
				])->all();

				$controlsWithMappingStatus = [];
				foreach($cids as $cid){
					$controlsWithMappingStatus[]=[
						'id'=>$cid->id,
						'mapping_status'=>"Completed"
					];
				}
				$mappedControls = $this->Assessments->EgrcAssessmentPolicies->patchEntities($cids,$controlsWithMappingStatus);
				//entity creation for mapping status update ends here.
				//debug($mappedControls);
				$result4 = $rcMapping->saveMany($rcentities);
				if($result4){
					if($this->Assessments->EgrcAssessmentPolicies->saveMany($mappedControls)){
						$this->Flash->success("Successfully Updated. ");
					} else {
						$this->Flash->success("Mapping Successfully Updated but status not updated for Control Areas. Kindly re-update mapping.");
					}

				} else {
					$this->Flash->error("Sorry! Not Successful. Try again.");
				}

			}

			return $this->redirect(['controller'=>'assessments','action'=>'view',$aid, $sub_type]);

		}




		$this->loadModel('EgrcRcMappings');
		//if mapping base data exists in the table then load from table
		$rcmappings = $this->EgrcRcMappings->find('all',[
			'conditions'=>['EgrcRcMappings.assessment_id'=>$aid],
			'contain'=>['EgrcAssessmentRisks','EgrcAssessmentPolicies']
		])->all();
		//debug($rcmappings);
		$table = array();
		$cols=array();
		$colids = array();

		foreach($rcmappings as $k=>$map){
			$table[$map->egrc_assessment_policy->name][$map->egrc_assessment_risk->id]= $map;
			$colids[] = $map->egrc_assessment_risk->id;
			$cols[]=$map->egrc_assessment_risk->name;

		}
		//debug($cols);
		$colids=array_unique($colids);
		$cols=array_unique($cols);
		//debug($colids);
		$assessment = $this->Assessments->get($aid,[
			'contain'=>[
				'Users.Companies'
			]
		]);

		$this->set('assessment',$assessment);
		$this->set('table',$table);
		$this->set('risks',$cols);
		$this->set('risk_ids',$colids);



	}



	//risk control mapping action
	public function rcmapping($aid, $sub_type, $rbid=null){

		if($this->Auth->user('role')=='Company'){
			if($this->isCompanyAssessment($aid)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
				return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
			}
		}

		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($aid)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in user.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			}
		}


		if($this->request->is(['put','post'])){


			$data = $this->request->getData();

			$fdata = array();
			foreach($data as $map=>$value){
				$mid = explode('~',$map);
				$mid = end($mid);
				$fdata[] = [
					'id'=>$mid,
					'mapping'=>$value,
					'assessment_controls'=>[
						'mapping_status'=>'Completed'
					]
				];
			}
			if(empty($fdata)){
				$connection = ConnectionManager::get('default');
				if($rbid==null){
					$results = $connection->execute("update assessment_controls set mapping_status='Completed' where assessment_id='$aid'");
						//->fetchAll('assoc');
				} else {
					$results = $connection->execute("update assessment_controls set mapping_status='Completed' where arb_id='$rbid'");
						//->fetchAll('assoc');
				}

				if($results){
					$this->Flash->success("Successfully Updated.");
				} else {
					$this->Flash->error("Sorry! Not Successful. Try again.");
				}

			} else {
				$rcMapping = TableRegistry::get('RcMappings');
				$rcentities = $rcMapping->patchEntities($fdata,$fdata);

				//for updating status of mapping for controls
				$cids = [];
				foreach($rcentities as $cEntity){
					$cids[]=$cEntity->assessment_control_id;
				}
				$cids = implode("','", array_unique($cids));

				$cids = $this->Assessments->AssessmentControls->find('all',[
					'conditions'=>[
						"AssessmentControls.id in ('".$cids."')"
					]
				])->all();

				$controlsWithMappingStatus = [];
				foreach($cids as $cid){
					$controlsWithMappingStatus[]=[
						'id'=>$cid->id,
						'mapping_status'=>"Completed"
					];
				}
				$mappedControls = $this->Assessments->AssessmentControls->patchEntities($cids,$controlsWithMappingStatus);
				//entity creation for mapping status update ends here.

				$result4 = $rcMapping->saveMany($rcentities);
				if($result4){
					if($this->Assessments->AssessmentControls->saveMany($mappedControls)){
						$this->Flash->success("Successfully Updated. ");
					} else {
						$this->Flash->success("Mapping Successfully Updated but status not updated for Control Areas. Kindly re-update mapping.");
					}

				} else {
					$this->Flash->error("Sorry! Not Successful. Try again.");
				}
			}

			return $this->redirect(['controller'=>'assessments','action'=>'view',$aid, $sub_type]);

		}


		$this->loadModel('AssessmentRisks');
		$this->loadModel('AssessmentControls');
		$this->loadModel('RcMappings');
		if($sub_type=='Regulated'){
			//checking if mapping base data exists or not
			$rcs = $this->RcMappings->find()->where(['arb_id'=>$rbid])->count();
			if($rcs>0){
				//if mapping base data exists in the table then load from table
				$rcmappings = $this->RcMappings->find('all',[
					'conditions'=>['RcMappings.arb_id'=>$rbid],
					'contain'=>['AssessmentRisks','AssessmentControls','AssessmentRisks.AssessmentsRegulatoryBodies','AssessmentRisks.AssessmentsRegulatoryBodies.Assessments']
				])->all();

				$table = array();
				$cols=array();
				$colids = array();

				foreach($rcmappings as $k=>$map){
					$table[$map->assessment_control->name][$map->assessment_risk->id]= $map;
					$colids[] = $map->assessment_risk->id;
					$cols[]=$map->assessment_risk->risk;


				}

				$colids=array_unique($colids);
				$cols=array_unique($cols);


			} else {
				//else load from seperate tables to insert to rcmappings
				$controls = $this->AssessmentControls->find('all',[
					'conditions'=>['AssessmentControls.arb_id'=>$rbid]
				])->all();
				$risks = $this->AssessmentRisks->find('all',[
					'conditions'=>['AssessmentRisks.arb_id'=>$rbid]
				])->all();

				//loading model for fetching rcmapping from mapping masters (table: gen_rc_mappings)
				$this->loadModel('RbRcMappings');

				$rcmap = [];
				foreach($risks as $risk){
					foreach($controls as $control){
						//fetching mappings from masters
						$mapingMaster = $this->RbRcMappings->find('all',[
							'conditions'=>[
								'RbRcMappings.risk_id'=>$risk->risk_id,
								'RbRcMappings.control_id'=>$control->control_id
							]
						])->first();

						if($mapingMaster){
							$rcmap[]=[
								'arb_id'=>$rbid,
								'assessment_risk_id'=>$risk->id,
								'assessment_control_id'=>$control->id,
								'mapping'=>$mapingMaster->mapping,
								'status'=>$mapingMaster->status
							];
						} else {
							$rcmap[]=[
								'arb_id'=>$rbid,
								'assessment_risk_id'=>$risk->id,
								'assessment_control_id'=>$control->id,
							];
						}
					}
				}

				$rcmapping = $this->RcMappings->newEntities($rcmap);
				$this->RcMappings->saveMany($rcmapping);
				return $this->redirect(['controller'=>'assessments','action'=>'rcmapping',$aid,$sub_type,$rbid]);
			}

			//for display of the regulatory body
			$rbody = $this->Assessments->AssessmentsRegulatoryBodies->get($rbid,[
				'contain'=>['RegulatoryBodies']
			]);
			$this->set(compact('rbody'));
		} else {
			//checking if mapping base data exists or not
			$rcs = $this->RcMappings->find()->where(['assessment_id'=>$aid])->count();
			if($rcs>0){
				//if mapping base data exists in the table then load from table
				$rcmappings = $this->RcMappings->find('all',[
					'conditions'=>['RcMappings.assessment_id'=>$aid],
					'contain'=>['AssessmentRisks','AssessmentControls','AssessmentRisks.Assessments']
				])->all();

				$table = array();
				$cols=array();
				$colids = array();

				foreach($rcmappings as $k=>$map){
					$table[$map->assessment_control->name][$map->assessment_risk->id]= $map;
					$colids[] = $map->assessment_risk->id;
					$cols[]=$map->assessment_risk->risk;

				}
				//debug($table);
				$colids=array_unique($colids);
				$cols=array_unique($cols);


			} else {
				//else load from seperate tables to insert to rcmappings
				$controls = $this->AssessmentControls->find('all',[
					'conditions'=>['AssessmentControls.assessment_id'=>$aid]
				])->all();
				$risks = $this->AssessmentRisks->find('all',[
					'conditions'=>['AssessmentRisks.assessment_id'=>$aid]
				])->all();

				//loading model for fetching rcmapping from mapping masters (table: gen_rc_mappings)
				$this->loadModel('GenRcMappings');

				$rcmap = [];
				foreach($risks as $risk){
					foreach($controls as $control){
						//fetching mappings from masters
						$mapingMaster = $this->GenRcMappings->find('all',[
							'conditions'=>[
								'GenRcMappings.risk_id'=>$risk->risk_id,
								'GenRcMappings.control_id'=>$control->control_id
							]
						])->first();
						if($mapingMaster){
							$rcmap[]=[
								'assessment_id'=>$aid,
								'assessment_risk_id'=>$risk->id,
								'assessment_control_id'=>$control->id,
								'mapping'=>$mapingMaster->mapping,
								'status'=>$mapingMaster->status
							];
						} else {
							$rcmap[]=[
								'assessment_id'=>$aid,
								'assessment_risk_id'=>$risk->id,
								'assessment_control_id'=>$control->id,
							];
						}

					}
				}

				$rcmapping = $this->RcMappings->newEntities($rcmap);
				//debug($controls);
				//debug($rcmapping);
				$this->RcMappings->saveMany($rcmapping);
				return $this->redirect(['controller'=>'assessments','action'=>'rcmapping',$aid,$sub_type,$rbid]);
			}
		}




		$assessment = $this->Assessments->get($aid,[
			'contain'=>[
				'Users','AssessmentsRegulatoryBodies'
			]
		]);

		$this->set('assessment',$assessment);
		$this->set('table',$table);
		$this->set('risks',$cols);
		$this->set('risk_ids',$colids);


	} //rc mapping action ends


	public function domainMaturityRating($id=null,$asub_type=null){



		try { //checking if the assessment control area exists or not
			$this->loadModel('FfiecAssessmentDomains');
			$aControl = $this->FfiecAssessmentDomains->get($id,[
				'contain'=> ['Assessments','FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements','FfiecAssessmentMaturityScores']
			]);
			//debug($aControl);
			$this->loadModel('MaturityAttributes');
			$this->loadModel('MaturityAttributeOptions');
			$mAttributes = $this->MaturityAttributes->find('all')->all();
			$mAttributeOptions = $this->MaturityAttributeOptions->find('all')->all();

			$this->loadModel('ComplianceStatuses');
			$compStatuses = $this->ComplianceStatuses->find('all')->all();

			if($asub_type=='Regulated'){
				$thisAssessment = $aControl->assessments_regulatory_body->assessment;
			} else {
				$thisAssessment = $aControl->assessment;
			}

			if($this->Auth->user('role')=='Company'){
				if($this->isCompanyAssessment($thisAssessment->id)==false){
					$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
					return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
				}
			}

			if($this->Auth->user('role')=='Employee'){
				if($this->isEmployeeAssessment($thisAssessment->id)==false){
					$this->Flash->error("Sorry! The Assessment does not belongs to logged in Employee.");
					return $this->redirect($this->referer());
				}
			}

		} catch (\Exception $e) {
		    $this->Flash->error("Sorry! Assessment Control Area details not found.");
			return $this->redirect($this->referer());
		} //checking and getting assessment control area details ends here


		//checking of assessment belongs to curren employee user
		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($thisAssessment->id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in user.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			}
		}

		/*
		//restricting the maturity ratings update before updating R-C Mapping
		if($aControl->mapping_status=='Pending'){
			$this->Flash->error("Sorry! Risk Control Mapping is not updated for this Control Area. Kindly make sure to update first.");
			return $this->redirect($this->referer());
		}
		*/
		if($this->request->is(['post','put'])){
			$posted = $this->request->getData();
			//debug($posted);

			$contScoring=[]; //for score against each maturity attribute
			$mRating = []; //for maturity rating of the control
			foreach($posted['mOptions'] as $key=>$mOption){
				if(!empty($mOption)){
					$mop = explode('~',$mOption);
					$mRating[]=$mop[1];
					$contScoring[]=[
						'id'=>$key,
						'maturity_option'=>$mop[0],
						'score'=>$mop[1]
					];
				}

			}
			$aFactors = [];

			foreach($posted['rCompliance'] as $akey=>$aFactor){
				$contReqs = []; //for control requirements updated values
				foreach($aFactor  as $key=>$rComp){
					if(!empty($rComp)){
						$rcm = explode('~',$rComp);

						$contReqs[]=[
							'id'=>$key,
							'compliance_status'=>$rcm[0],
							'compliance_score'=>$rcm[1],
						];
					}
				}
				$aFactors[]=[
					'id'=>$akey,
					'ffiec_assessment_domain_requirements'=>$contReqs
				];
			}
			if($posted['submitType']=='update'){
				//control values updated
				$comStatus = explode('~',$posted['cStatus']);
				$mRating = round(array_sum($mRating)/count($mRating),2);

				//below ratio is predifined constant in whole system.
				$ccCompliance = 0.7;
				$ccMaturity = 0.3;

				$subTotal = round(($ccCompliance*$comStatus[1])+($ccMaturity*$mRating),2);
				$control = [
					'compliance_status'=>$comStatus[0],
					'compliance_score'=>$comStatus[1],
					//'status'=>$posted['aStatus'],
					'maturity_rating' => $mRating,
					'sub_total'=>$subTotal,
					'ffiec_assessment_domain_a_factors'=>$aFactors,
					'ffiec_assessment_maturity_scores'=>$contScoring
				];

				$draft="";
			} else {
				$draft="Draft";
				$control = [
					'ffiec_assessment_domain_a_factors'=>$aFactors,
					'ffiec_assessment_maturity_scores'=>$contScoring
				];
			}
			$updatedControl = $this->FfiecAssessmentDomains->patchEntity($aControl,$control,[
				'associated'=> ['FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements','FfiecAssessmentMaturityScores']
			]);

			//debug($updatedControl);


			if($this->FfiecAssessmentDomains->save($updatedControl)){

				$this->Flash->success("Maturity Ratings ".$draft." updated successfully.");
			} else {
				$this->Flash->error("Sorry! Not successful. Try again.");
			}
			$this->redirect(['controller'=>'assessments','action'=>'view',$thisAssessment->id,$asub_type]);

		}


		$this->set(compact('thisAssessment','aControl','mAttributes','mAttributeOptions','compStatuses','asub_type'));

	}


	public function controlMaturityRating($id=null,$asub_type=null){



		try { //checking if the assessment control area exists or not
			$this->loadModel('AssessmentControls');
			$aControl = $this->AssessmentControls->get($id,[
				'contain'=> ['Assessments','AssessmentControlRequirements','AssessmentMaturityScores','AssessmentsRegulatoryBodies.Assessments']
			]);

			$this->loadModel('MaturityAttributes');
			$this->loadModel('MaturityAttributeOptions');
			$mAttributes = $this->MaturityAttributes->find('all')->all();
			$mAttributeOptions = $this->MaturityAttributeOptions->find('all')->all();

			$this->loadModel('ComplianceStatuses');
			$compStatuses = $this->ComplianceStatuses->find('all')->all();

			if($asub_type=='Regulated'){
				$thisAssessment = $aControl->assessments_regulatory_body->assessment;
			} else {
				$thisAssessment = $aControl->assessment;
			}

			if($this->Auth->user('role')=='Company'){
				if($this->isCompanyAssessment($thisAssessment->id)==false){
					$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
					return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
				}
			}

			if($this->Auth->user('role')=='Employee'){
				if($this->isEmployeeAssessment($thisAssessment->id)==false){
					$this->Flash->error("Sorry! The Assessment does not belongs to logged in Employee.");
					return $this->redirect($this->referer());
				}
			}

		} catch (\Exception $e) {
		    $this->Flash->error("Sorry! Assessment Control Area details not found.");
			return $this->redirect($this->referer());
		} //checking and getting assessment control area details ends here


		//checking of assessment belongs to curren employee user
		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($thisAssessment->id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in user.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			}
		}


		//restricting the maturity ratings update before updating R-C Mapping
		if($aControl->mapping_status=='Pending'){
			$this->Flash->error("Sorry! Risk Control Mapping is not updated for this Control Area. Kindly make sure to update first.");
			return $this->redirect($this->referer());
		}



		if($this->request->is(['post','put'])){
			$posted = $this->request->getData();
			//debug($posted);

			$contScoring=[]; //for score against each maturity attribute
			$mRating = []; //for maturity rating of the control
			foreach($posted['mOptions'] as $key=>$mOption){
				if(!empty($mOption)){
					$mop = explode('~',$mOption);
					$mRating[]=$mop[1];
					$contScoring[]=[
						'id'=>$key,
						'maturity_option'=>$mop[0],
						'score'=>$mop[1]
					];
				}

			}

			$contReqs = []; //for control requirements updated values
			foreach($posted['rCompliance'] as $key=>$rComp){
				if(!empty($rComp)){
					$rcm = explode('~',$rComp);

					$contReqs[]=[
						'id'=>$key,
						'compliance_status'=>$rcm[0],
						'compliance_score'=>$rcm[1],
					];
				}

			}

			//control values updated
			$comStatus = explode('~',$posted['cStatus']);
			$mRating = round(array_sum($mRating)/count($mRating),2);

			//below ratio is predifined constant in whole system.
			$ccCompliance = 0.7;
			$ccMaturity = 0.3;

			$subTotal = round(($ccCompliance*$comStatus[1])+($ccMaturity*$mRating),2);
			$control = [
				'compliance_status'=>$comStatus[0],
				'compliance_score'=>$comStatus[1],
				//'status'=>$posted['aStatus'],
				'maturity_rating' => $mRating,
				'sub_total'=>$subTotal,
				'assessment_control_requirements'=>$contReqs,
				'assessment_maturity_scores'=>$contScoring
			];

			$updatedControl = $this->AssessmentControls->patchEntity($aControl,$control,[
				'associated'=> ['AssessmentControlRequirements','AssessmentMaturityScores']
			]);



			if($this->AssessmentControls->save($updatedControl)){

				$this->Flash->success("Maturity Ratings updated successfully.");
			} else {
				$this->Flash->error("Sorry! Not successful. Try again.");
			}
			$this->redirect(['controller'=>'assessments','action'=>'view',$thisAssessment->id,$asub_type]);
		}




		$this->set(compact('thisAssessment','aControl','mAttributes','mAttributeOptions','compStatuses','asub_type'));

	}

	public function policyMaturityRating($id=null,$asub_type=null){

		try { //checking if the assessment control area exists or not
			$this->loadModel('EgrcAssessmentPolicies');
			$aControl = $this->EgrcAssessmentPolicies->get($id,[
				'contain'=> ['Assessments','EgrcAssessmentPolicyStatements','EgrcAssessmentMaturityScores']
			]);

			$this->loadModel('MaturityAttributes');
			$this->loadModel('MaturityAttributeOptions');
			$mAttributes = $this->MaturityAttributes->find('all')->all();
			$mAttributeOptions = $this->MaturityAttributeOptions->find('all')->all();

			$this->loadModel('ComplianceStatuses');
			$compStatuses = $this->ComplianceStatuses->find('all')->all();

			$thisAssessment = $aControl->assessment;

			if($this->Auth->user('role')=='Company'){
				if($this->isCompanyAssessment($thisAssessment->id)==false){
					$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
					return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
				}
			}

			if($this->Auth->user('role')=='Employee'){
				if($this->isEmployeeAssessment($thisAssessment->id)==false){
					$this->Flash->error("Sorry! The Assessment does not belongs to logged in Employee.");
					return $this->redirect($this->referer());
				}
			}

		} catch (\Exception $e) {
		    $this->Flash->error("Sorry! Assessment Control Area details not found.");
			return $this->redirect($this->referer());
		} //checking and getting assessment control area details ends here


		//checking of assessment belongs to curren employee user
		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($thisAssessment->id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in user.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			}
		}


		//restricting the maturity ratings update before updating R-C Mapping
		if($aControl->mapping_status=='Pending'){
			$this->Flash->error("Sorry! Risk Control Mapping is not updated for this Control Area. Kindly make sure to update first.");
			return $this->redirect($this->referer());
		}



		if($this->request->is(['post','put'])){
			$posted = $this->request->getData();
			//debug($posted);

			$contScoring=[]; //for score against each maturity attribute
			$mRating = []; //for maturity rating of the control
			foreach($posted['mOptions'] as $key=>$mOption){
				if(!empty($mOption)){
					$mop = explode('~',$mOption);
					$mRating[]=$mop[1];
					$contScoring[]=[
						'id'=>$key,
						'maturity_option'=>$mop[0],
						'score'=>$mop[1]
					];
				}

			}

			$contReqs = []; //for control requirements updated values
			foreach($posted['rCompliance'] as $key=>$rComp){
				if(!empty($rComp)){
					$rcm = explode('~',$rComp);

					$contReqs[]=[
						'id'=>$key,
						'compliance_status'=>$rcm[0],
						'compliance_score'=>$rcm[1],
					];
				}

			}

			//control values updated
			$comStatus = explode('~',$posted['cStatus']);
			$mRating = round(array_sum($mRating)/count($mRating),2);

			//below ratio is predifined constant in whole system.
			$ccCompliance = 0.7;
			$ccMaturity = 0.3;

			$subTotal = round(($ccCompliance*$comStatus[1])+($ccMaturity*$mRating),2);
			$control = [
				'compliance_status'=>$comStatus[0],
				'compliance_score'=>$comStatus[1],
				//'status'=>$posted['aStatus'],
				'maturity_rating' => $mRating,
				'sub_total'=>$subTotal,
				'egrc_assessment_policy_statements'=>$contReqs,
				'egrc_assessment_maturity_scores'=>$contScoring
			];

			$updatedControl = $this->EgrcAssessmentPolicies->patchEntity($aControl,$control,[
				'associated'=> ['EgrcAssessmentPolicyStatements','EgrcAssessmentMaturityScores']
			]);



			if($this->EgrcAssessmentPolicies->save($updatedControl)){

				$this->Flash->success("Maturity Ratings updated successfully.");
			} else {
				$this->Flash->error("Sorry! Not successful. Try again.");
			}
			$this->redirect(['controller'=>'assessments','action'=>'view',$thisAssessment->id,$asub_type]);
		}


		$this->set(compact('thisAssessment','aControl','mAttributes','mAttributeOptions','compStatuses','asub_type'));

	}

	public function cmmcCapabilityMaturity($id=null,$asub_type=null){


		try { //checking if the assessment control area exists or not
			$this->loadModel('CmmcAssessmentLevels');
			$aLevel = $this->CmmcAssessmentLevels->get($id,[
				'contain'=> ['CmmcAssessmentDomains.Assessments','CmmcAssessmentCapabilities.CmmcAssessmentPractices','CmmcAssessmentMaturityScores']
			]);
			//debug($aLevel);
			//dd('a');
			$this->loadModel('CmmcMaturityAttributes');
			$this->loadModel('CmmcMaturityAttributeOptions');
			$mAttributes = $this->CmmcMaturityAttributes->find('all')->all();
			$mAttributeOptions = $this->CmmcMaturityAttributeOptions->find('all')->all();


			//getting all levels for current domain
			$allLvls = $this->CmmcAssessmentLevels->find('all',[
				'conditions'=>[
					'CmmcAssessmentLevels.cmmc_assessment_domain_id'=>$aLevel->cmmc_assessment_domain->id
				],
				//'fields'=>['name','code']
			])->all();
			$thisLevelPosition=0;
			foreach($allLvls as $pos=>$alvl){
				if($aLevel->code==$alvl->code){
					$thisLevelPosition = $pos;
				}
			}
			$allLvls = $allLvls->toArray();

			if($thisLevelPosition>0 && $allLvls[$thisLevelPosition-1]['status']=='Pending'){
				$this->Flash->error("Sorry! ".$allLvls[$thisLevelPosition-1]['name']." is not completed yet for ".$aLevel->cmmc_assessment_domain->name);
				return $this->redirect($this->referer());
			}



			//dd($aLevel);
			$thisAssessment = $aLevel->cmmc_assessment_domain->assessment;

			if($this->Auth->user('role')=='Company'){
				if($this->isCompanyAssessment($thisAssessment->id)==false){
					$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
					return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
				}
			}

			if($this->Auth->user('role')=='Employee'){
				if($this->isEmployeeAssessment($thisAssessment->id)==false){
					$this->Flash->error("Sorry! The Assessment does not belongs to logged in Employee.");
					return $this->redirect($this->referer());
				}
			}

		} catch (\Exception $e) {
		    $this->Flash->error("Sorry! Level details not found.");
			//dd($e);
			return $this->redirect($this->referer());
		} //checking and getting assessment control area details ends here


		//checking of assessment belongs to current employee user
		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($thisAssessment->id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in user.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			}
		}


		if($this->request->is(['post','put'])){
			$posted = $this->request->getData();

			//dd($posted);

			$this->loadModel('CmmcAssessmentPractices');

			$conn = ConnectionManager::get('default');
			$conn->begin();
			try {

				$lvlScoring=[]; //for score against each maturity attribute
				$mRating = []; //for maturity rating of the Level
				foreach($posted['mOptions'] as $key=>$mOption){
					if(!empty($mOption)){
						$mop = explode('~',$mOption);
						$mRating[]=$mop[1];
						$lvlScoring[]=[
							'id'=>$key,
							'maturity_option'=>$mop[0],
							'score'=>$mop[1]
						];
					}
				}

				$capabilities = [];

				foreach($posted['rCompliance'] as $cid=>$cpractices){
					$cscore = [];
					$practices = [];
					foreach($cpractices as $pid=>$score){
						$practices[] = [
							'id'=>$pid,
							'cmmc_assessment_capability_id'=>$cid,
							'score'=>$score
						];
						$cscore[]=$score;
					}

					$capabilities[] = [
						'id'=>$cid,
						'score'=>round(array_sum($cscore)/count($cscore),0),
						'cmmc_assessment_practices' => $practices,
						'status'=>'Completed'
					];
				}

				//level scores
				$lscores = [];
				foreach($capabilities as $cap){
					$lscores[] = $cap['score'];
				}

				$mRating = round(array_sum($mRating)/count($mRating),2);

				//getting CmmcMaturityAttributeOptions to calculate Process Maturity level
				$this->loadModel('CmmcMaturityAttributeOptions');
				$rs = $this->CmmcMaturityAttributeOptions->find('all',[
					'order'=>[
						'CmmcMaturityAttributeOptions.score'=>'desc'
					]
				])->toArray();

				$scales =[];
				$i=count($rs);
				foreach($rs as $k=>$rscale){
					if($i==0){
						$scales[$rscale['name']]=[
							//'min'=>0,
							'max'=>$rscale['score'],
							'result'=>$rscale['code']
						];
					} else {
						$scales[$rscale['name']]=[
							//'min'=>$rs[$k-1]['score'],
							'max'=>$rscale['score'],
							'result'=>$rscale['code']
						];
					}
					$i--;
				}

				$lMaturityLevel = '';

				foreach($scales as $scale){
					if(round($mRating,0)>=$scale['max']){
						$lMaturityLevel = $scale['result'];
						break;
					} else if(round($mRating,0)<0){
						$lMaturityLevel = $rs[count($rs)-1]['code'];
						break;
					} else if(round($mRating,0)<1 && round($mRating,0)>=0) {
						$lMaturityLevel = $rs[count($rs)-1]['code'];
						break;
					}
				}




				$thisLevel = [
					'id'=>$aLevel->id,
					'status'=>'Completed',
					'score'=>round(array_sum($lscores)/count($lscores),0),
					'cmmc_assessment_capabilities' => $capabilities,
					'cmmc_assessment_maturity_scores'=>$lvlScoring,
					'maturity_rating'=>$mRating,
					'maturity_level'=>$lMaturityLevel
				];

				$alevel = $this->CmmcAssessmentLevels->patchEntity($aLevel,$thisLevel,[
					'associated'=> ['CmmcAssessmentCapabilities.CmmcAssessmentPractices','CmmcAssessmentMaturityScores']
				]);
				//debug($alevel);
				//dd('a');
				//saving the Level data with scores
				$this->CmmcAssessmentLevels->save($alevel);

				//updating CMMC Domain's status and scores if all levels are completed.
				$allLvls = $this->CmmcAssessmentLevels->find('all',[
					'conditions'=>[
						'CmmcAssessmentLevels.cmmc_assessment_domain_id'=>$aLevel->cmmc_assessment_domain->id
					],
				])->all();
				$completedLevels = 0;
				$dscores=[];
				$mscores = [];
				foreach($allLvls as $alvl){
					if($alvl->status=='Completed'){
						$completedLevels++;
						$dscores[]=$alvl->score;
						$mscores[]=$alvl->maturity_rating;
					}
				}
				if(count($allLvls)==$completedLevels){
					$this->loadModel('CmmcAssessmentDomains');
					$domain = $this->CmmcAssessmentDomains->get($aLevel->cmmc_assessment_domain->id);
					$domain->status = 'Completed';
					$domain->score = round(array_sum($dscores)/count($dscores),0);
					$domain->maturity_rating = round(array_sum($mscores)/count($mscores),2);

					$dMaturityLevel = '';

					foreach($scales as $scale){
						if(round($domain->maturity_rating,0)>=$scale['max']){
							$dMaturityLevel = $scale['result'];
							break;
						} else if(round($domain->maturity_rating,0)<0){
							$dMaturityLevel = $rs[count($rs)-1]['code'];
							break;
						} else if(round($domain->maturity_rating,0)<1 && round($domain->maturity_rating,0)>=0) {
							$dMaturityLevel = $rs[count($rs)-1]['code'];
							break;
						}
					}

					$domain->maturity_level = $dMaturityLevel;

					$this->CmmcAssessmentDomains->save($domain);
				}

				$conn->commit();
				$this->Flash->success("Capability maturity successfully updated for ".$aLevel->name." of ".$aLevel->cmmc_assessment_domain->name);
				return $this->redirect(['action'=>'view',$thisAssessment->id,$thisAssessment->sub_type]);
			}  catch(\Exception $e){
				$conn->rollback();
				dd($e);
				$this->Flash->error("Sorry! Something went wrong. Try again.");
				return $this->redirect($this->referer());
			}



		}




		$asub_type = $thisAssessment->sub_type;
		$this->set(compact('thisAssessment','aLevel','asub_type','mAttributes','mAttributeOptions'));

	}



	public function toggleStatus(){
		$this->viewBuilder()->setLayout(false);
		$this->autoRender = false;

		$this->request->allowMethod(['post']);
		$posted = $this->request->getData();
		$id = $posted['id'];
		$status = $posted['status'];

		if($this->Auth->user('role')=='Company'){
			if($this->isCompanyAssessment($id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
				return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
			}
		}
		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in employee.");
				return $this->redirect(['controller'=>'lab','action'=>'dashboard']);
			}
		}

		$assessment = $this->Assessments->get($id,[
			'contain'=>['AssessmentStatuses']
		]);
		$data = ['id'=>$id,'status'=>$status];
		$data['assessment_statuses'][] = [
			'assessment_id'=>$id,
			'status'=>$status,
			'user_id'=>$this->Auth->user('id'),
			'status_log'=>$this->Auth->user('first_name')." ".$this->Auth->user('last_name')." updated assessment status as '".$status."' on ".date('d-M-Y H:i:s')
		];

		if($status=='Completed' || $status=='Review or Draft'){
			//validating if all the RC Mappings and Control Maturity Scoring updated
			$this->loadModel('AssessmentControls');
			if($assessment->sub_type=='Regulated'){
				$this->loadModel('AssessmentsRegulatoryBodies');
				$arBodies = $this->AssessmentsRegulatoryBodies->find('all',[
					'conditions'=>[
						'assessment_id'=>$id
					],
					//'fields'=>['id']
				])->toArray();
				$arbIds = [];
				foreach($arBodies as $arBody){
					$arbIds[]=$arBody['id'];
				}
				$arbIds = implode("','",$arbIds);

				$pendingControlAreas = $this->AssessmentControls->find('all',[
					'conditions'=>[
						"AssessmentControls.arb_id in ('{$arbIds}')",
						'AssessmentControls.status'=>'Pending',
						'AssessmentControls.mapping_status'=>'Pending'
					]
				])->toArray();

				$pendingControlAreas = count($pendingControlAreas);

				$this->loadModel('AssessmentRisks');
				$pendingRiskAreas = $this->AssessmentRisks->find('all',[
					'conditions'=>[
						'and'=>[
							"AssessmentRisks.arb_id in ('{$arbIds}')",
						],
						'or'=>[
							'AssessmentRisks.inherent_scale'=>'',
							'AssessmentRisks.inherent_scale is NULL'
						]
					]
				])->toArray();
				$pendingRiskAreas = count($pendingRiskAreas);

				$pendingControlAreas =  $pendingControlAreas+$pendingRiskAreas;
			} elseif($assessment->sub_type=='FFIEC Regulated'){
				$this->loadModel('FfiecAssessmentDomains');
				$pendingControlAreas = $this->FfiecAssessmentDomains->find('all',[
					'conditions'=>[
						'and'=>[
							"FfiecAssessmentDomains.assessment_id"=>$id,
						],
						'or'=>[
							'FfiecAssessmentDomains.compliance_status'=>'',
							'FfiecAssessmentDomains.compliance_status is NULL'
						]
					]
				])->toArray();

				$pendingControlAreas = count($pendingControlAreas);

				$this->loadModel('FfiecAssessmentRisks');
				$pendingRiskAreas = $this->FfiecAssessmentRisks->find('all',[
					'conditions'=>[
						'and'=>[
							"FfiecAssessmentRisks.assessment_id"=>$id,
						],
						'or'=>[
							'FfiecAssessmentRisks.inherent_scale'=>'',
							'FfiecAssessmentRisks.inherent_scale is NULL'
						]
					]
				])->toArray();
				$pendingRiskAreas = count($pendingRiskAreas);


				$pendingControlAreas =  $pendingControlAreas+$pendingRiskAreas;
			} elseif($assessment->sub_type=='eGRC') {
				$this->loadModel('EgrcAssessmentPolicies');
				$pendingControlAreas = $this->EgrcAssessmentPolicies->find('all',[
					'conditions'=>[
						"EgrcAssessmentPolicies.assessment_id"=>$id,
						'EgrcAssessmentPolicies.status'=>'Pending',
						'EgrcAssessmentPolicies.mapping_status'=>'Pending'
					]
				])->toArray();

				$pendingControlAreas = count($pendingControlAreas);

				$this->loadModel('EgrcAssessmentRisks');
				$pendingRiskAreas = $this->EgrcAssessmentRisks->find('all',[
					'conditions'=>[
						'and'=>[
							"EgrcAssessmentRisks.assessment_id"=>$id,
						],
						'or'=>[
							'EgrcAssessmentRisks.inherent_scale'=>'',
							'EgrcAssessmentRisks.inherent_scale is NULL'
						]
					]
				])->toArray();
				$pendingRiskAreas = count($pendingRiskAreas);

				$pendingControlAreas =  $pendingControlAreas+$pendingRiskAreas;
			} elseif($assessment->sub_type=='CMMC') {
				$this->loadModel('CmmcAssessmentDomains');
				$pendingControlAreas = $this->CmmcAssessmentDomains->find('all',[
					'conditions'=>[
						"CmmcAssessmentDomains.assessment_id"=>$id,
						'CmmcAssessmentDomains.status'=>'Pending',
					]
				])->toArray();

				$pendingControlAreas = count($pendingControlAreas);
			} else {
				$pendingControlAreas = $this->AssessmentControls->find('all',[
					'conditions'=>[
						"AssessmentControls.assessment_id"=>$id,
						'AssessmentControls.status'=>'Pending',
						'AssessmentControls.mapping_status'=>'Pending'
					]
				])->toArray();

				$pendingControlAreas = count($pendingControlAreas);

				$this->loadModel('AssessmentRisks');
				$pendingRiskAreas = $this->AssessmentRisks->find('all',[
					'conditions'=>[
						'and'=>[
							"AssessmentRisks.assessment_id"=>$id,
						],
						'or'=>[
							'AssessmentRisks.inherent_scale'=>'',
							'AssessmentRisks.inherent_scale is NULL'
						]
					]
				])->toArray();
				$pendingRiskAreas = count($pendingRiskAreas);

				$pendingControlAreas =  $pendingControlAreas+$pendingRiskAreas;
			}

			if($pendingControlAreas>0){
				if($assessment->sub_type=='CMMC'){
					$this->Flash->error("Sorry! Capability Maturity and Process Maturity is not completed yet for all CMMC domains. Kindly update first to publish the result.");
				} else {
					$this->Flash->error("Sorry! Inherent Risk calculations, Risk Control Mapping or Control Maturity Scoring not completed. Kindly update first to publish the result.");
				}
				return $this->redirect($this->referer());
			}
			//debug($pendingControlAreas);
		}
		$assessment = $this->Assessments->patchEntity($assessment,$data,[
			'associated'=>['AssessmentStatuses']
		]);
		//debug($assessment);

		if($this->Assessments->save($assessment)){
			///update results begins
			$resultFlag = "";
			if($status=="Completed" || $status='Review or Draft'){
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
				//debug($scales);
				//creating instance of db connection
				$connection = ConnectionManager::get('default');
				//for Regulated Assessments there would be loop thru each regulatory body
				//to update the residual scores.
				if($assessment->sub_type=='Regulated'){
					$this->loadModel('AssessmentsRegulatoryBodies');
					$arBodies = $this->AssessmentsRegulatoryBodies->find('all',[
						'conditions'=>[
							'assessment_id'=>$id
						],
						//'fields'=>['id']
					])->toArray();
					$arbIds = [];
					foreach($arBodies as $arBody){
						$arbIds[]=$arBody['id'];
					}
					$arbIds = implode("','",$arbIds);
					/*
					$results = $connection->execute("SELECT ar.id AS id, t.residual_score, ar.inherent_scale FROM assessment_risks ar,
								(SELECT rcm.arb_id,rcm.assessment_risk_id,ROUND((SUM(ac.sub_total)/COUNT(rcm.mapping)),2)  AS residual_score
								FROM rc_mappings rcm
								INNER JOIN  assessment_controls ac
								ON rcm.arb_id=ac.arb_id
								WHERE
								rcm.arb_id in ('{$arbIds}') AND rcm.mapping='P' AND rcm.assessment_control_id=ac.id
								GROUP BY rcm.assessment_risk_id ORDER BY rcm.assessment_risk_id DESC ) t
								WHERE ar.arb_id=t.arb_id AND ar.id=t.assessment_risk_id")
							->fetchAll('assoc');
					*/
					$results = $connection->execute("SELECT ar.id AS id, sum(t.residual_score) as residual_score, ar.inherent_scale FROM assessment_risks ar,
								(SELECT rcm.arb_id,rcm.assessment_risk_id,rcm.mapping,
								CASE
								   WHEN rcm.mapping='P' THEN ROUND((SUM(ac.sub_total)/COUNT(rcm.mapping)),2)
								   ELSE 0
								END AS residual_score
								FROM rc_mappings rcm
								INNER JOIN  assessment_controls ac
								ON rcm.arb_id=ac.arb_id
								WHERE
								rcm.arb_id in ('{$arbIds}') AND rcm.assessment_control_id=ac.id
								GROUP BY rcm.assessment_risk_id,rcm.mapping ORDER BY rcm.assessment_risk_id DESC ) t
								WHERE ar.arb_id=t.arb_id AND ar.id=t.assessment_risk_id
								group by assessment_risk_id")
							->fetchAll('assoc');
				} else if($assessment->sub_type=='FFIEC Regulated'){
					/*
					$results = $connection->execute("SELECT ar.id AS id, t.residual_score,ar.inherent_scale,ar.inherent_score FROM ffiec_assessment_risks ar,
								(SELECT rcm.assessment_id,rcm.frisk_id,ROUND((SUM(ac.sub_total)/COUNT(rcm.mapping)),2)  AS residual_score
								FROM ffiec_rc_mappings rcm
								INNER JOIN  ffiec_assessment_domains ac
								ON rcm.assessment_id=ac.assessment_id
								WHERE
								rcm.assessment_id='{$id}' AND rcm.mapping='P' AND rcm.fdomain_id=ac.id
								GROUP BY rcm.frisk_id ORDER BY rcm.frisk_id DESC ) t
								WHERE ar.assessment_id=t.assessment_id AND ar.id=t.frisk_id")
							->fetchAll('assoc');
					*/
					$results = $connection->execute("SELECT ar.id AS id, sum(t.residual_score) as residual_score,ar.inherent_scale,ar.inherent_score FROM ffiec_assessment_risks ar,
								(SELECT rcm.assessment_id,rcm.frisk_id, rcm.mapping,
								CASE
								   WHEN rcm.mapping='P' THEN ROUND((SUM(ac.sub_total)/COUNT(rcm.mapping)),2)
								   ELSE 0
								END AS residual_score
								FROM ffiec_rc_mappings rcm
								INNER JOIN  ffiec_assessment_domains ac
								ON rcm.assessment_id=ac.assessment_id
								WHERE
								rcm.assessment_id='{$id}' AND rcm.fdomain_id=ac.id
								GROUP BY rcm.frisk_id, rcm.mapping ORDER BY rcm.frisk_id DESC ) t
								WHERE ar.assessment_id=t.assessment_id AND ar.id=t.frisk_id
								group by frisk_id")
							->fetchAll('assoc');

				} elseif($assessment->sub_type=='eGRC') {
					/*
					$results = $connection->execute("SELECT ar.id AS id, t.residual_score,ar.inherent_scale FROM egrc_assessment_risks ar,
								(SELECT rcm.assessment_id,rcm.egrc_assessment_risk_id,ROUND((SUM(ac.sub_total)/COUNT(rcm.mapping)),2)  AS residual_score
								FROM egrc_arc_mappings rcm
								INNER JOIN  egrc_assessment_policies ac
								ON rcm.assessment_id=ac.assessment_id
								WHERE
								rcm.assessment_id='{$id}' AND rcm.mapping='P' AND rcm.egrc_assessment_policy_id=ac.id
								GROUP BY rcm.egrc_assessment_risk_id ORDER BY rcm.egrc_assessment_risk_id DESC ) t
								WHERE ar.assessment_id=t.assessment_id AND ar.id=t.egrc_assessment_risk_id")
							->fetchAll('assoc');
							*/
					$results = $connection->execute("SELECT ar.id AS id, SUM(t.residual_score) AS residual_score,ar.inherent_scale FROM egrc_assessment_risks ar,
							(SELECT rcm.assessment_id,rcm.egrc_assessment_risk_id,rcm.mapping,
							CASE
							   WHEN rcm.mapping='P' THEN ROUND((SUM(ac.sub_total)/COUNT(rcm.mapping)),2)
							   ELSE 0
							END AS residual_score
							FROM egrc_arc_mappings rcm
							INNER JOIN  egrc_assessment_policies ac
							ON rcm.assessment_id=ac.assessment_id
							WHERE
							rcm.assessment_id='{$id}' AND rcm.egrc_assessment_policy_id=ac.id
							GROUP BY rcm.egrc_assessment_risk_id, rcm.mapping ORDER BY rcm.egrc_assessment_risk_id DESC ) t
							WHERE ar.assessment_id=t.assessment_id AND ar.id=t.egrc_assessment_risk_id
							GROUP BY egrc_assessment_risk_id")
							->fetchAll('assoc');


				} elseif($assessment->sub_type=='CMMC') {
					$results = [];
				} else {
					/*
					$results = $connection->execute("SELECT ar.id AS id, t.residual_score,ar.inherent_scale FROM assessment_risks ar,
								(SELECT rcm.assessment_id,rcm.assessment_risk_id,ROUND((SUM(ac.sub_total)/COUNT(rcm.mapping)),2)  AS residual_score
								FROM rc_mappings rcm
								INNER JOIN  assessment_controls ac
								ON rcm.assessment_id=ac.assessment_id
								WHERE
								rcm.assessment_id='{$id}' AND rcm.mapping='P' AND rcm.assessment_control_id=ac.id
								GROUP BY rcm.assessment_risk_id ORDER BY rcm.assessment_risk_id DESC ) t
								WHERE ar.assessment_id=t.assessment_id AND ar.id=t.assessment_risk_id")
							->fetchAll('assoc');
					*/
					$results = $connection->execute("SELECT ar.id AS id, sum(t.residual_score) as residual_score,ar.inherent_scale FROM assessment_risks ar,
								(SELECT rcm.assessment_id,rcm.assessment_risk_id, rcm.mapping,
								case when rcm.mapping='P' then ROUND((SUM(ac.sub_total)/COUNT(rcm.mapping)),2)
								else 0 end AS residual_score
								FROM rc_mappings rcm
								INNER JOIN  assessment_controls ac
								ON rcm.assessment_id=ac.assessment_id
								WHERE
								rcm.assessment_id='{$id}' AND rcm.assessment_control_id=ac.id
								GROUP BY rcm.assessment_risk_id ORDER BY rcm.assessment_risk_id DESC ) t
								WHERE ar.assessment_id=t.assessment_id AND ar.id=t.assessment_risk_id
								group by assessment_risk_id")
							->fetchAll('assoc');
				}
				//debug($results);
				//updating entity with scores and scales to save the result
				$flag = 0;
				foreach($results as $k=>$result){
					if($assessment->sub_type=='FFIEC Regulated'){
						$inherentScore = $result['inherent_score'];
					} else {
						$inherentScore = $scales[$result['inherent_scale']]['max'];
						$results[$k]['inherent_score']=$inherentScore;
					}

					$results[$k]['inherent_variant']=$inherentScore-$result['residual_score'];

					foreach($scales as $scale){
						if(round($results[$k]['inherent_variant'],0)>=$scale['max']){
							$results[$k]['residual_scale'] = $scale['result'];
							break;
						} else if(round($results[$k]['inherent_variant'],0)<0){
							$results[$k]['residual_scale'] = "Minor";
							break;
						} else if(round($results[$k]['inherent_variant'],0)<1 && round($results[$k]['inherent_variant'],0)>=0) {
							$results[$k]['residual_scale'] = "Minor";
							break;
						}
					}


					$flag++;
				}
				//debug($results);
				//saving the results.
				if($assessment->sub_type=='FFIEC Regulated'){
					$aResults = TableRegistry::get('FfiecAssessmentRisks');
					$arEntities = $aResults->patchEntities($results,$results);
				} elseif($assessment->sub_type=='eGRC') {
					$aResults = TableRegistry::get('EgrcAssessmentRisks');
					$arEntities = $aResults->patchEntities($results,$results);
				} elseif($assessment->sub_type=='CMMC') {
					//no code required here.
				} else {
					$aResults = TableRegistry::get('AssessmentRisks');
					$arEntities = $aResults->patchEntities($results,$results);
				}

				//debug($arEntities);

				if($assessment->sub_type!='CMMC' && $aResults->saveMany($arEntities)){
					$resultFlag.="";
					//debug($assessment);
					if($assessment->status=='Completed' && $assessment->sub_type=='eGRC'){
						//creating entries for remediation management
						$this->loadModel('EgrcRemediations');
						$pstatements = $connection->execute("SELECT p.document_number AS issue_id,
							eps.id AS eapsid,eps.name AS summary,ep.egrc_policy_id AS affected_policy_id,
							ep.name AS affected_policy ,p.company_id  FROM
							assessments a,
							egrc_assessment_policies ep,
							egrc_assessment_policy_statements eps,
							egrc_policies p
							WHERE
							ep.assessment_id=a.id AND
							ep.id=eps.egrc_assessment_policy_id AND
							p.id=ep.egrc_policy_id AND
							(eps.compliance_status='Partially Compliant' OR eps.compliance_status='Non Compliant')
							AND a.id='".$id."'")->fetchAll('assoc');

						$remediations=[];
						foreach($pstatements as $k=>$ps){
							//generating issue id
							$pol = $this->EgrcRemediations->find('all',[
								'conditions'=>[
									"EgrcRemediations.issue_id like "=>$ps['issue_id']."%"
								]
							])->count();
							$pstatements[$k]['count']=$pol;

							$remediations[]=[
								'issue_id'=>$ps['issue_id']."-i".str_pad(($pol+1),5,0,STR_PAD_LEFT),
								'company_id'=>$ps['company_id'],
								'egrc_assessment_policy_statement_id'=>$ps['eapsid'],
								'summary'=>$ps['summary'],
								'affected_policy_id'=>$ps['affected_policy_id'],
								'affected_policy'=>$ps['affected_policy'],
								'created'=>date('Y-m-d H:i:s'),
								'modified'=>date('Y-m-d H:i:s')
							];
						}

						$eResults = TableRegistry::get('EgrcRemediations');
						$erEntities = $eResults->patchEntities($remediations,$remediations);
						//debug($erEntities);
						if($eResults->saveMany($erEntities)){
							$resultFlag.=" New entries updated in remediation management.";
						}
					}

				} else {
					$resultFlag.="";
				}

			} //*update result ends

			$this->Flash->success("Assessment Status Successfully Changed. ".$resultFlag);

		} else {
			$this->Flash->error("Sorry! Not Updated.".$resultFlag);

		}

		return $this->redirect($this->referer());

	}




	public function viewResult($id = null,$subType=null,$excel=null)
    {
    	if($this->Auth->user('role')=='Company'){
			if($this->isCompanyAssessment($id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
				return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
			}
		}

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

			$this->set(compact('rcmappings','excel'));



    	} else if($subType=='FFIEC Regulated'){
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','Users.Companies','FfiecAssessmentRisks.FfiecAssessmentRiskFactors','FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements','FfiecAssessmentDomains.FfiecAssessmentMaturityScores','FfiecAssessmentDomains.FfiecRcMappings','FfiecRcMappings.FfiecAssessmentRisks','FfiecRcMappings.FfiecAssessmentDomains.FfiecAssessmentDomainAfactors.FfiecAssessmentDomainRequirements']
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
					foreach($aCont->ffiec_assessment_domain_a_factors as $aFactor){
						foreach($aFactor->ffiec_assessment_domain_requirements as $acReq){
							if(in_array($acReq->compliance_status,$expConditions)){
								$expControls[$aCont->name][$aFactor->name][] = $acReq->name;
							}
						}
					}
				}
				$excepHeaders[2][$aCont->id] = $aCont->name;
			}
			//debug($excepHeaders);
			//for managing exceptions ends
			//debug($assessment->ffiec_rc_mappings);
			$expTable=[];
			foreach($assessment->ffiec_rc_mappings as $k=>$map){
				$table[$map->ffiec_assessment_domain->name][$map->ffiec_assessment_risk->id]= $map;
				$colids[] = $map->ffiec_assessment_risk->id;
				$cols[]=$map->ffiec_assessment_risk->name;

				if(in_array($map->ffiec_assessment_domain->compliance_status,$expConditions)){
					$exps="";
					foreach($map->ffiec_assessment_domain->ffiec_assessment_domain_a_factors as $dafactor){
						foreach($dafactor->ffiec_assessment_domain_requirements as $acReq){
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

			$this->set('risks',$cols);
			$this->set('risk_ids',$colids);
			$this->set('table',$table);

			$this->set(compact('expTable','excepHeaders','excel'));





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
				$cols[]=$map->egrc_assessment_risk->name;

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

			$this->set('risks',$cols);
			$this->set('risk_ids',$colids);
			$this->set('table',$table);

			$this->set(compact('expTable','excepHeaders','excel'));
		} elseif($subType=='CMMC') {
			$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','Users.Companies','CmmcAssessmentDomains.CmmcAssessmentLevels.CmmcAssessmentCapabilities.CmmcAssessmentPractices','CmmcAssessmentDomains.CmmcAssessmentLevels.CmmcAssessmentMaturityScores',]
	        ]);
			$this->set(compact('excel'));
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

			$this->set('risks',$cols);
			$this->set('risk_ids',$colids);
			$this->set('table',$table);

			$this->set(compact('expTable','excepHeaders','excel'));



		}

		//debug($assessment);

		$this->loadModel('ComplianceStatuses');
		$this->loadModel('RiskSeverityScales');

		$this->set('compStatuses',$this->ComplianceStatuses->find('all')->all());
		$this->set('riskScales',$this->RiskSeverityScales->find('all')->all());

		$this->set('pageHeading','Assessment Results');
        $this->set('assessment', $assessment);

		$this->viewBuilder()->setLayout('result');

		if($subType=='CMMC') {
			$this->render('view_result_cmmc');
		}

    }



	public function exportResultReport($id = null,$subType=null,$docType=null)
    {
    	if($this->Auth->user('role')=='Company'){
			if($this->isCompanyAssessment($id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
				return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
			}
		}

		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in employee.");
				return $this->redirect(['controller'=>'lab','action'=>'dashboard']);
			}
		}

    	if($subType=='Regulated'){
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','Users.Companies','AssessmentStatuses.Users','AssessmentsRegulatoryBodies.RegulatoryBodies','AssessmentsRegulatoryBodies.AssessmentSeverityScales','AssessmentsRegulatoryBodies.AssessmentRisks','AssessmentsRegulatoryBodies.AssessmentControls','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores','AssessmentsRegulatoryBodies.AssessmentControls.RcMappings','AssessmentsRegulatoryBodies.RcMappings.AssessmentRisks','AssessmentsRegulatoryBodies.RcMappings.AssessmentControls','AssessmentsRegulatoryBodies.RcMappings.AssessmentControls.AssessmentControlRequirements']
	        ]);

			$rcmappings = [];

			foreach($assessment->assessments_regulatory_bodies as $ke=>$rbody){
				$table = array();
				$cols=array();
				$colids = array();

				//for managing Exceptions
				$exceptions = [];
				//generating table headers
				$excepHeaders[]=["Findings / Exceptions"];

				foreach($rbody->assessment_risks as $eaRisks){
					$excepHeaders[1][$eaRisks->id] = $eaRisks->risk;
				}
				//generationg table headers ends
				$expConditions = ['Partially Compliant','Non Compliant'];
				//debug($assessment);
				$expControls = [];
				foreach($rbody->assessment_controls as $aCont){

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
				$expRisks=[];

				foreach($rbody->rc_mappings as $k=>$map){
					$table[$map->assessment_control->name][$map->assessment_risk->id]= $map;
					$colids[] = $map->assessment_risk->id;
					$cols[]=$map->assessment_risk->risk;

					if(in_array($map->assessment_control->compliance_status,$expConditions)){
						$exps="";
						foreach($map->assessment_control->assessment_control_requirements as $acReq){
							if(in_array($acReq->compliance_status,$expConditions)){
								$exps.=$acReq->name."\n";
								if($map->mapping=="P"){
									$expRisks[$map->assessment_risk->id][]=$acReq->name;
								}

							}
						}
						$exps = substr($exps,0,-2);
						if(strlen($exps)>0){
							$expTable[$map->assessment_control->id."~~".$exps][$map->assessment_risk->id] = $map->mapping;

						}

					}


				}
				$colids=array_unique($colids);
				$cols=array_unique($cols);

				$rcmappings[$ke] = $rbody->regulatory_body;
				$rcmappings[$ke]['mappings'] = [
					'table'=>$table,
					'risk_ids'=>$colids,
					'risks'=>$cols,
				];
				$rcmappings[$ke]['exceptions'] = [
					'expTable'=>$expTable,
					'excepHeaders'=>$excepHeaders,
					'expRisks'=>$expRisks,
					'aRisks'=>$rbody->assessment_risks,
					'aConts'=>$rbody->assessment_controls
				];


			}

			$this->set(compact('rcmappings'));



    	} else if($subType=='FFIEC Regulated'){
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','Users.Companies','AssessmentStatuses.Users','FfiecAssessmentRisks.FfiecAssessmentRiskFactors','FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements','FfiecAssessmentDomains.FfiecAssessmentMaturityScores','FfiecAssessmentDomains.FfiecRcMappings','FfiecRcMappings.FfiecAssessmentRisks','FfiecRcMappings.FfiecAssessmentDomains.FfiecAssessmentDomainAfactors.FfiecAssessmentDomainRequirements']
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
			$expRisks=[];
			foreach($assessment->ffiec_rc_mappings as $k=>$map){
				$table[$map->ffiec_assessment_domain->name][$map->ffiec_assessment_risk->id]= $map;
				$colids[] = $map->ffiec_assessment_risk->id;
				$cols[]=$map->ffiec_assessment_risk->name;

				if(in_array($map->ffiec_assessment_domain->compliance_status,$expConditions)){
					$exps="";
					foreach($map->ffiec_assessment_domain->ffiec_assessment_domain_a_factors as $facReq){
						foreach($facReq->ffiec_assessment_domain_requirements as $acReq){
							if(in_array($acReq->compliance_status,$expConditions)){
								$exps.=$acReq->name."\n";
								if($map->mapping=="P"){
									$expRisks[$map->ffiec_assessment_risk->id][]=$acReq->name;
								}

							}
						}
					}
					$exps = substr($exps,0,-2);
					if(strlen($exps)>0){
						$expTable[$map->ffiec_assessment_domain->id."~~".$exps][$map->ffiec_assessment_risk->id] = $map->mapping;

					}

				}

			}

			$colids=array_unique($colids);
			$cols=array_unique($cols);

			$this->set('risks',$cols);
			$this->set('risk_ids',$colids);
			$this->set('table',$table);
			$this->set(compact('expTable','excepHeaders','expRisks'));





    	} elseif($subType=='eGRC'){

			$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','EgrcAssessmentRisks','AssessmentStatuses.Users','AssessmentSeverityScales','EgrcAssessmentPolicies.EgrcAssessmentPolicyStatements','EgrcAssessmentPolicies.EgrcAssessmentMaturityScores','EgrcAssessmentPolicies.EgrcRcMappings','EgrcRcMappings.EgrcAssessmentRisks','EgrcRcMappings.EgrcAssessmentPolicies.EgrcAssessmentPolicyStatements']
	        ]);


			$table = array();
			$cols=array();
			$colids = array();

			//for managing Exceptions
			$exceptions = [];
			//generating table headers
			$excepHeaders[]=["Findings / Exceptions"];

			foreach($assessment->egrc_assessment_risks as $eaRisks){
				$excepHeaders[1][$eaRisks->id] = $eaRisks->name;
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
			$expRisks=[];
			foreach($assessment->egrc_rc_mappings as $k=>$map){
				$table[$map->egrc_assessment_policy->name][$map->egrc_assessment_risk->id]= $map;
				$colids[] = $map->egrc_assessment_risk->id;
				$cols[]=$map->egrc_assessment_risk->name;

				if(in_array($map->egrc_assessment_policy->compliance_status,$expConditions)){
					$exps="";
					foreach($map->egrc_assessment_policy->egrc_assessment_policy_statements as $acReq){
						if(in_array($acReq->compliance_status,$expConditions)){
							$exps.=$acReq->name."\n";
							if($map->mapping=="P"){
								$expRisks[$map->egrc_assessment_risk->id][]=$acReq->name;
							}

						}
					}
					$exps = substr($exps,0,-2);
					if(strlen($exps)>0){
						$expTable[$map->egrc_assessment_policy->id."~~".$exps][$map->egrc_assessment_risk->id] = $map->mapping;

					}

				}

			}

			$colids=array_unique($colids);
			$cols=array_unique($cols);

			$this->set('risks',$cols);
			$this->set('risk_ids',$colids);
			$this->set('table',$table);
			$this->set(compact('expTable','excepHeaders','expRisks'));

    	} else {

			$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','AssessmentRisks','AssessmentStatuses.Users','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores','AssessmentControls.RcMappings','RcMappings.AssessmentRisks','RcMappings.AssessmentControls.AssessmentControlRequirements']
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
			$expRisks=[];
			foreach($assessment->rc_mappings as $k=>$map){
				$table[$map->assessment_control->name][$map->assessment_risk->id]= $map;
				$colids[] = $map->assessment_risk->id;
				$cols[]=$map->assessment_risk->risk;

				if(in_array($map->assessment_control->compliance_status,$expConditions)){
					$exps="";
					foreach($map->assessment_control->assessment_control_requirements as $acReq){
						if(in_array($acReq->compliance_status,$expConditions)){
							$exps.=$acReq->name."\n";
							if($map->mapping=="P"){
								$expRisks[$map->assessment_risk->id][]=$acReq->name;
							}

						}
					}
					$exps = substr($exps,0,-2);
					if(strlen($exps)>0){
						$expTable[$map->assessment_control->id."~~".$exps][$map->assessment_risk->id] = $map->mapping;

					}

				}

			}

			$colids=array_unique($colids);
			$cols=array_unique($cols);

			$this->set('risks',$cols);
			$this->set('risk_ids',$colids);
			$this->set('table',$table);
			$this->set(compact('expTable','excepHeaders','expRisks'));

    	}



		$this->loadModel('ComplianceStatuses');
		$this->loadModel('RiskSeverityScales');
		$this->loadModel('Companies');
		$this->loadModel('MaturityAttributes');
		$this->loadModel('MaturityDescriptions');

		$riskScales = $this->RiskSeverityScales->find('all')->all();
		$modifiedRiskScales = [];
		foreach($riskScales as $rs){
			$modifiedRiskScales[$rs->severity_scale]=$rs;
		}
		$compStatuses = $this->ComplianceStatuses->find('all')->all();
		$modifiedComplianceStatuses=[];
		foreach($compStatuses as $cs){
			$modifiedComplianceStatuses[$cs->name]=$cs;
		}

		$mDescriptions = $this->MaturityDescriptions->find('all',[
			'contain'=>['MaturityAttributes','MaturityAttributeOptions']
		])->all();

		$mDescs = [];
		foreach($mDescriptions as $mdesc){
			$mDescs[$mdesc->maturity_attribute->name][$mdesc->maturity_attribute_option->score]=$mdesc->description;
		}
		//debug($mDescs);



		$this->set('mDescriptions',$mDescs);
		$this->set('compStatuses',$modifiedComplianceStatuses);
		//$this->set('riskScales',$this->RiskSeverityScales->find('all')->all());
		$this->set('riskScales',$modifiedRiskScales);
		$this->set('company',$this->Companies->findById($assessment->user->company_id)->first());
		$this->set('mAttributes',$this->MaturityAttributes->find('all')->all());

		$this->set('pageHeading','Assessment Results');

		$this->set('assessmentStatuses',$assessment->assessment_statuses);

		//sorting assessment statuses to descending order by updated date
		$myStatuses =  array_column($assessment->assessment_statuses,"created");
		array_multisort($myStatuses,SORT_DESC,$assessment->assessment_statuses);
        $this->set('assessment', $assessment);

		$this->set('docType',$docType);
		if($docType=='pdocument'){
			 $this->viewBuilder()
	            ->className('Dompdf.Pdf')
	            ->setLayout('Dompdf.default')
	            ->options(['config' => [
	                'filename' => $assessment->case_number."_".$assessment->name,
	                'render' => 'download',
	                'isPhpEnabled'=>true,

            ]]);
		}



		$this->viewBuilder()->setLayout('ajax');
		if($subType=="Regulated"){
			//debug($assessment);
			$this->render('export_result_report_regulated');
		} else if($subType=="FFIEC Regulated"){
			$this->render('export_result_report_ffiec');
		} else if($subType=="eGRC"){
			$this->render('export_result_report_egrc');
		}

    }


    /**
     * View method
     *
     * @param string|null $id Assessment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null,$subType=null)
    {

    	if($this->Auth->user('role')=='Company'){
			if($this->isCompanyAssessment($id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in company.");
				return $this->redirect(['controller'=>'companies','action'=>'dashboard']);
			}
		}

		if($this->Auth->user('role')=='Employee'){
			if($this->isEmployeeAssessment($id)==false){
				$this->Flash->error("Sorry! The Assessment does not belongs to logged in user.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			}
		}

    	if($subType=='Regulated'){
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','Users.Companies','AssessmentStatuses.Users','AssessmentsRegulatoryBodies.RegulatoryBodies','AssessmentsRegulatoryBodies.AssessmentSeverityScales','AssessmentsRegulatoryBodies.AssessmentRisks','AssessmentsRegulatoryBodies.AssessmentControls','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores']
	        ]);
    	} else if($subType=='FFIEC Regulated'){
    		$assessment = $this->Assessments->get($id,[
    			'contain' => ['Users','Users.Companies','AssessmentStatuses.Users','FfiecAssessmentRisks.FfiecAssessmentRiskFactors','FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements']
    		]);

			$this->loadModel('FfiecRisks');
			$fRisks = $this->FfiecRisks->find('all',[
				'contain'=>['FfiecRiskFactors']
			])->all();
			$this->set(compact('fRisks'));
			//debug($fRisks);
    	} else if($subType=='eGRC'){
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','AssessmentRisks','AssessmentStatuses.Users','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores','EgrcAssessmentRisks','EgrcAssessmentPolicies.EgrcAssessmentPolicyStatements','EgrcAssessmentPolicies.EgrcAssessmentMaturityScores']
	        ]);
    	} else if($subType=='CMMC'){
    		$this->loadModel('CmmcMaturityAttributeOptions');
			$amoptions = $this->CmmcMaturityAttributeOptions->find('all',['order'=>['CmmcMaturityAttributeOptions.score'=>'asc']])->all();

    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','CmmcAssessmentDomains.CmmcAssessmentLevels.CmmcAssessmentCapabilities.CmmcAssessmentPractices','AssessmentStatuses.Users']
	        ]);
			$this->set(compact('amoptions'));
    	} elseif($subType=='Generalized') {
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','AssessmentRisks','AssessmentStatuses.Users','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores']
	        ]);
    	} elseif($subType=='Other') {
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['Users','AssessmentRisks','AssessmentStatuses.Users','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores']
	        ]);
    	}



		//debug($assessment);
		//die;
		$assessment->atype = $assessment->atype=="Independent"?"Independent":$assessment->atype;

		//debug($assessment);

		//getting risk severity scales
		$this->loadModel('RiskSeverityScales');
		$scales = $this->RiskSeverityScales->find('all')->all();

		$this->set('pageHeading','Assessment Details');
        $this->set('assessment', $assessment);
		$this->set('scales',$scales);



    }


	public function getFfiecAssessmentDomains($id){
		//$id is Assessment's primary key
		$this->loadModel('FfiecAssessmentDomains');
		$fdmns = $this->FfiecAssessmentDomains->find();
		$fdomans = $fdmns->select(['id','assessment_id','name','maturity_level','comp_score','comp_status','cmaturity_rating','sub_total'])->where(['assessment_id'=>$id])->distinct(['name'])->all();
		$fdomains = [];
		foreach($fdomans as $key=>$fdm){
			$fdmns = $this->FfiecAssessmentDomains->find();
			$aFactrs=$fdmns->select(['id','assessment_factor'])
						->distinct(['assessment_factor'])
						->where(['name'=>$fdm->name,'assessment_id'=>$id])->all();
			$fdomains[$key]=[
				'id'=>$fdm->id,
				'assessment_id'=>$fdm->assessment_id,
				'name'=>$fdm->name,
				'maturity_level'=>$fdm->maturity_level,
				'compliance_score'=>$fdm->comp_score,
				'compliance_status'=>$fdm->comp_status,
				'maturity_rating'=>$fdm->cmaturity_rating,
				//'maturity_score'=>$fdm->maturity_score,
				'sub_total'=>$fdm->sub_total
			];

			foreach($aFactrs as $k=>$afct){

				$dStatements = $this->FfiecAssessmentDomains->find('all',[
					'conditions'=>[
						'FfiecAssessmentDomains.assessment_id'=>$id,
						'FfiecAssessmentDomains.name'=>$fdm->name,
						'FfiecAssessmentDomains.assessment_factor'=>$afct->assessment_factor
					]
				])->all()->toArray();
				$fdomains[$key]['assessment_factors'][$k]['name']=$afct->assessment_factor;
				$fdomains[$key]['assessment_factors'][$k]['id']=$afct->id;
				$fdomains[$key]['assessment_factors'][$k]['declarative_statements']=$dStatements;


			}


			//$aFactors = json_encode($aFactors);
			//$fdomains[$key]['name="asdf";
		}
		return json_decode(json_encode($fdomains));
	}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

     /*
    public function add()
    {
        $assessment = $this->Assessments->newEntity();
        if ($this->request->is('post')) {
            $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());
            if ($this->Assessments->save($assessment)) {
                $this->Flash->success(__('The assessment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment could not be saved. Please, try again.'));
        }
        $owners = $this->Assessments->Owners->find('list', ['limit' => 200]);
        $requesters = $this->Assessments->Requesters->find('list', ['limit' => 200]);
        $regulatoryBodies = $this->Assessments->RegulatoryBodies->find('list', ['limit' => 200]);
        $this->set(compact('assessment', 'owners', 'requesters', 'regulatoryBodies'));
    }
	*/

	//listing of assessment requests submitted by employee
	public function tracking(){
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
		            	'Assessments.owner_id'=>$this->Auth->user('id'),
		            	"date(Assessments.created) between '".date('Y-m-d',strtotime($value))."' and '".date('Y-m-d',strtotime($posted['stext2']))."'"
		            ],
		            'maxLimit'=>'250',
		            'limit'=>'250',
		            'order'=>[
		            	'Assessments.modified'=>'desc'
		            ]
		        ];
				$date = $posted['stext2'];
			} else {
				$this->paginate = [
		            'conditions' => [
		            	'Assessments.owner_id'=>$this->Auth->user('id'),
		            	"Assessments.".$field." like '%".$value."%'"
		            ],
		            'maxLimit'=>'250',
		            'limit'=>'=250',
		            'order'=>[
		            	'Assessments.modified'=>'desc'
		            ]
		        ];
				$date = "";
			}

		} else {
			$this->paginate = [
            'conditions' => [
            	'Assessments.owner_id'=>$this->Auth->user('id'),

            ],'order'=>[
		            	'Assessments.modified'=>'desc'
		            ]];
		}

        $assessments = $this->paginate($this->Assessments);



		$this->set(compact('assessments','search','date'));
		$this->viewBuilder()->setLayout('lab');
	}

	public function array_unset_recursive(&$array,$remove) {
	   if (!is_array($remove)) $remove = array($remove);
	    foreach ($array as $key => &$value) {
	        if (in_array($key, $remove)){
	        	unset($array[$key]);
	        } else if (is_array($value)) {
	            $this->array_unset_recursive($value, $remove);
	        }
	    }
	}

	//creating new assessment when hitting re-assessment
	public function assessmentRepeat_Demo($id=null,$subType=null){

		//only allow post request

		$this->request->allowMethod(['post']);
		//fetching existing assessment and related records
       if($subType=='Regulated'){
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['AssessmentStatuses','AssessmentsRegulatoryBodies.RegulatoryBodies','AssessmentsRegulatoryBodies.AssessmentSeverityScales','AssessmentsRegulatoryBodies.AssessmentRisks','AssessmentsRegulatoryBodies.AssessmentControls','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores']
	        ]);
			$associated = ['AssessmentStatuses','AssessmentsRegulatoryBodies','AssessmentsRegulatoryBodies.AssessmentSeverityScales','AssessmentsRegulatoryBodies.AssessmentRisks','AssessmentsRegulatoryBodies.AssessmentControls','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores'];

    	} else if($subType=='FFIEC Regulated'){
    		$assessment = $this->Assessments->get($id,[
    			'contain' => ['AssessmentStatuses','FfiecAssessmentRisks.FfiecAssessmentRiskFactors','FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements']
    		]);
			$associated = ['AssessmentStatuses','FfiecAssessmentRisks.FfiecAssessmentRiskFactors','FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements'];
    	} else {
    		$assessment = $this->Assessments->get($id, [
	            'contain' => ['AssessmentRisks','AssessmentStatuses','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores']
	        ]);
			$associated = ['AssessmentRisks','AssessmentStatuses','AssessmentSeverityScales','AssessmentControls','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores'];
    	}






		$ma = json_decode(json_encode($assessment),true);
		//debug($ma);
		$this->array_unset_recursive($ma,['id','assessment_id','assessment_control_id','afactor_id','frisk_id','maturity_option','score','mapping_status','sub_total','maturity_rating','compliance_score','compliance_status','status','artifact','reference','created','modified','inherent_scale','residual_score','inherent_variant','residual_scale']);

		//updating case number
		$query = $this->Assessments->find('all', [
		    'conditions' => ['Assessments.case_number LIKE' => $ma['case_number']."%"]
		]);
		$number = $query->count();
		$ma['case_number'] = $ma['case_number']."-".$number;
		//updating case number ends

		$ma = $this->Assessments->newEntity($ma,[
			'associated'=>$associated
		]);

		//debug($ma);

		$result = $this->Assessments->save($ma,['associated'=>$associated]);

		debug($result);
		//debug(json_decode(json_encode($assessment),true));
		//debug($a);

	}

	public function assessmentRepeat($aid=null,$sType=null){

		 if($sType=='Regulated'){
    		$rassessment = $this->Assessments->get($aid, [
	            'contain' => ['AssessmentStatuses','AssessmentsRegulatoryBodies.RegulatoryBodies','AssessmentsRegulatoryBodies.AssessmentSeverityScales','AssessmentsRegulatoryBodies.AssessmentRisks','AssessmentsRegulatoryBodies.AssessmentControls','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores']
	        ]);

    	} else if($sType=='FFIEC Regulated'){
    		$rassessment = $this->Assessments->get($aid,[
    			'contain' => ['AssessmentStatuses','FfiecAssessmentRisks.FfiecAssessmentRiskFactors','FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements']
    		]);
			$this->loadModel('FfiecRisks');
			$rfRisks = $this->FfiecRisks->find('all',[
				'contain'=>['FfiecRiskFactors']
			])->all();
			$this->set(compact('rfRisks'));
		} else if($sType=='Generalized') {
    		$rassessment = $this->Assessments->get($aid, [
	            'contain' => ['AssessmentRisks','AssessmentStatuses','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores']
	        ]);
		} else {
    		$rassessment = $this->Assessments->get($aid, [
	            'contain' => ['AssessmentRisks','AssessmentStatuses','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores']
	        ]);
		}
		//debug($rassessment);
		$query = $this->Assessments->find('all', [
		    'conditions' => ['Assessments.case_number LIKE' => $rassessment->case_number."%"]
		]);
		$number = $query->count();
		$rassessment->name = $rassessment->name."-".$number;

		$this->loadModel('RiskSeverityScales');
		$rScales = $this->RiskSeverityScales->find('all');
		$mLevels = [
				'Baseline'=>'Baseline',
				'Evolving'=>'Evolving',
				'Intermediate'=>'Intermediate',
				'Advanced'=>'Advanced',
				'Innovative'=>'Innovative'
			];
		$this->set(compact('rassessment','aid','sType','rScales','mLevels'));
		//debug($rassessment);
		//$data = $this->request->getData();
		//debug($data);
		if($this->request->is(['post','put'])){
			$data = $this->request->getData();
			//debug($data);
			//assessment to be saved
			$assessment = [
				'owner_id'=>$this->Auth->user('id'),
				'requester_id'=>$this->Auth->user('id'),
				'name'=>$data['name'],
				'atype'=>$data['atype'],
				'sub_type'=>$data['sub_type'],
				//'status'=>"Submitted",//$data['status'],
				'signature'=>$data['signature']
			];

			//updating assessment name
			$query = $this->Assessments->find('all', [
			    'conditions' => ['Assessments.case_number LIKE' => $rassessment->case_number."%"]
			]);
			$number = $query->count();
			$assessment['case_number'] = $rassessment->case_number."-".$number;
			//updating assessment name




			if($data['sub_type']=="FFIEC Regulated"){

				//generating maturity attributes for each controls
				//used when generating controls
				$this->loadModel('MaturityAttributes');
				$mAttrs = $this->MaturityAttributes->find('all')->all();
				$mAttributes = [];
				foreach($mAttrs as $mAttr){
					$mAttributes[]=[
						'maturity_attribute'=>$mAttr->name
					];
				}

				//generating risks data
				$assessment['ffiec_assessment_risks']=$data['risks']['ffiec_assessment_risks'];
				//end of risks data building

				//generating ffiec domains / controls data
				$assessment['ffiec_assessment_domains']=$data['domains']['ffiec_assessment_domains'];
				//debug($assessment);


			} else {
				//generating maturity attributes for each controls
				//used when generating controls
				$this->loadModel('MaturityAttributes');
				$mAttrs = $this->MaturityAttributes->find('all')->all();
				$mAttributes = [];
				foreach($mAttrs as $mAttr){
					$mAttributes[]=[
						'maturity_attribute'=>$mAttr->name
					];
				}
				//generating maturity attribute ends

				//generating Risks Template
				$this->loadModel('Risks');
				$riskMaster=[];
				$rsks=$this->Risks->find('all')->all();
				foreach($rsks as $rsk){
					$riskMaster[$rsk->name]=$rsk;
				}
				//generating risks template ends
			}


			if($data['sub_type']=="Regulated"){
				//start of data formatting for regulated assessments

				//debug($data);

				//assessment_regulatory_bodies
				$arbodies = [];
				foreach($data['GenRisk'] as $rbid=>$rbody){
					$arbodies[$rbid]=[
						'regulatory_body_id'=>$rbid
					];
				}//assessment_regulatory_bodies ends

				//default predefined risk severity scales
				$this->loadModel('RiskSeverityScales');
				$rsScales = $this->RiskSeverityScales->find('all')->all();
				$defaultScales=[];
				foreach($rsScales as $rss){
					$defaultScales[]=[
						'severity_scale'=>$rss->severity_scale,
						'score'=>$rss->score
					];
				}
				//


				foreach($data['GenRisk'] as $rbid=>$inherent){
					//inherent risk scores formatting
					$inherentRisks=[];
					foreach($inherent['inherent']['name'] as $k=>$iRisk){
						$inherentRisks[]=[
							'risk_id'=>empty($inherent['inherent']['id'][$k])?"":$inherent['inherent']['id'][$k],
							'risk'=>$iRisk,
							'inherent_scale'=>$inherent['inherent']['inhrent_scale'][$k],
							'risk_description'=>$inherent['inherent']['description'][$k]//strip_tags($riskMaster[$iRisk]->description)
						];
					} //end of inherent risk scores formatting

					//serverity scales formatting begins
					if(!empty($data['GenRisk'][$rbid]['rScales'])){
						foreach($data['GenRisk'][$rbid]['rScales']['name'] as $k=>$rScale){
							$scales[]=[
								'severity_scale'=>$rScale,
								'score'=>$data['GenRisk'][$rbid]['rScales']['score'][$k]
							];
						}
					} else {
						$scales=$defaultScales;
					}//severity scales formatting ends


					$arbodies[$rbid]['assessment_risks']=$inherentRisks;
					$arbodies[$rbid]['assessment_severity_scales']=$scales;
				}

				//generating controls and control requirements to be saved
				//for this assessment
				$controls = [];
				$postedControls = $data['GenControl'];

				foreach($postedControls as $rbid=>$pC){
					$i=0;
					foreach($pC['control'] as $pControl){
						$controls[$i]=[
							'control_id'=>empty($pControl['id'][0])?"":$pControl['id'][0],
							'name'=>$pControl['name'][0],
							'description'=>$pControl['description'][0],
							'assessment_maturity_scores'=>$mAttributes
						];
						foreach($pControl['req']['name'] as $k=>$pCReq){
							$controls[$i]['assessment_control_requirements'][]=[
								'name'=>$pCReq,
								'artifact'=>empty($pControl['req']['artifact'][$k])?"":$pControl['req']['artifact'][$k],
								'reference'=>empty($pControl['req']['reference'][$k])?"":$pControl['req']['reference'][$k]
							];
						}
						$i++;
					}
					$arbodies[$rbid]['assessment_controls']=$controls;
				}//generationg controls ends here

				//debug($arbodies);
				$assessment['assessments_regulatory_bodies']=[];
				foreach($arbodies as $arBody){
					$assessment['assessments_regulatory_bodies'][]=$arBody;
				}
				//$assessment['assessments_regulatory_bodies']=$arbodies;

				//debug($assessment);
				//debug($data);

				$assessment['assessment_statuses'][]=[
					'status'=>"In Progress",
					'user_id'=>$this->Auth->user('id'),
					'status_log'=>$this->Auth->user('first_name')." ".$this->Auth->user('last_name')." Submitted assessment request on ".date('d-M-Y H:i:s')
				];


				$assessments = TableRegistry::getTableLocator()->get('Assessments');
				$assessment = $assessments->newEntity($assessment, [
				    'associated' => ['AssessmentsRegulatoryBodies.AssessmentSeverityScales','AssessmentStatuses','AssessmentsRegulatoryBodies.AssessmentRisks','AssessmentsRegulatoryBodies.AssessmentControls','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores']
				]);


			//end of data formatting for regulated assessments
			} else if($data['sub_type']=="FFIEC Regulated"){

				$assessment['assessment_statuses'][]=[
					'status'=>"In Progress",
					'user_id'=>$this->Auth->user('id'),
					'status_log'=>$this->Auth->user('first_name')." ".$this->Auth->user('last_name')." Submitted assessment request on ".date('d-M-Y H:i:s')
				];

				//data building for ffiec regulated assessment
				//creating entity for ffiec regulated assessment
				$assessments = TableRegistry::getTableLocator()->get('Assessments');
				$assessment = $assessments->newEntity($assessment, [
				    'associated' => ['AssessmentStatuses','FfiecAssessmentRisks.FfiecAssessmentRiskFactors','FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements','FfiecAssessmentDomains.FfiecAssessmentMaturityScores']
				]);
				//debug($assessment);
			} else {
				//begining of data formatting for generalized and other assessments

				//getting inherent scores for custom/defined risk profiles
				$inherentRisks = [];
				foreach($data['GenRisk']['inherent']['name'] as $k=>$iRisk){
					$inherentRisks[]=[
						'risk_id'=>empty($data['GenRisk']['inherent']['id'][$k])?"":$data['GenRisk']['inherent']['id'][$k],
						'risk'=>$iRisk,
						'inherent_scale'=>$data['GenRisk']['inherent']['inhrent_scale'][$k],
						'risk_description'=>$data['GenRisk']['inherent']['description'][$k]//strip_tags($riskMaster[$iRisk]->description)
					];
				} //getting inherent scores ends

				//Risk Severity Scales to be used for result generation
				$scales = [];
				if(!empty($data['GenRisk']['rScales'])){
					foreach($data['GenRisk']['rScales']['name'] as $k=>$rScale){
						$scales[]=[
							'severity_scale'=>$rScale,
							'score'=>$data['GenRisk']['rScales']['score'][$k]
						];
					}
				} else {
					$this->loadModel('RiskSeverityScales');
					$rsScales = $this->RiskSeverityScales->find('all')->all();
					foreach($rsScales as $rss){
						$scales[]=[
							'severity_scale'=>$rss->severity_scale,
							'score'=>$rss->score
						];
					}
				} //Risk Severity Scales generation ends




				//generating controls and control requirements to be saved
				//for this assessment
				$controls = [];
				$postedControls = $data['GenControl']['control'];
				$i=0;
				foreach($postedControls as $pControl){
					$controls[$i]=[
						'control_id'=>empty($pControl['id'][0])?"":$pControl['id'][0],
						'name'=>$pControl['name'][0],
						'description'=>$pControl['description'][0],
						'assessment_maturity_scores'=>$mAttributes
					];
					foreach($pControl['req']['name'] as $k=>$pCReq){
						$controls[$i]['assessment_control_requirements'][]=[
							'name'=>$pCReq,
							'artifact'=>empty($pControl['req']['artifact'][$k])?"":$pControl['req']['artifact'][$k],
							'reference'=>''//$pControl['req']['reference'][$k]
						];
					}
					$i++;
				}//generationg controls ends here



				//updating assessment array in the needed format
				//to save in single call with associated tables data
				$assessment['assessment_risks']=$inherentRisks;
				$assessment['assessment_controls']=$controls;
				$assessment['assessment_severity_scales']=$scales;
				//updating assessment array ends

				$assessment['assessment_statuses'][]=[
					'status'=>"In Progress",
					'user_id'=>$this->Auth->user('id'),
					'status_log'=>$this->Auth->user('first_name')." ".$this->Auth->user('last_name')." Submitted assessment request on ".date('d-M-Y H:i:s')
				];

				$assessments = TableRegistry::getTableLocator()->get('Assessments');
				$assessment = $assessments->newEntity($assessment, [
				    'associated' => ['AssessmentRisks','AssessmentStatuses','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores']
				]);
			}



			//debug($assessment);


			$result = $assessments->save($assessment);

			//$error = $assessment->errors();
			//debug($result);
			//debug($error);



			if($result){

				if($data['sub_type']=="FFIEC Regulated") {
					$this->loadModel('FfiecAssessmentDomains');
					$this->loadModel('FfiecAssessmentRisks');
					//updating mappings from masters
					$controls = $this->FfiecAssessmentDomains->find('all',[
						'conditions'=>['FfiecAssessmentDomains.assessment_id'=>$assessment->id]
					])->all();
					$risks = $this->FfiecAssessmentRisks->find('all',[
						'conditions'=>['FfiecAssessmentRisks.assessment_id'=>$assessment->id]
					])->all();

					//loading model for fetching rcmapping from mapping masters (table: gen_rc_mappings)
					$this->loadModel('FfiecMasterRcMappings');

					$rcmap = [];
					foreach($risks as $risk){
						foreach($controls as $control){
							//fetching mappings from masters
							$mapingMaster = $this->FfiecMasterRcMappings->find('all',[
								'conditions'=>[
									'FfiecMasterRcMappings.frisk_id'=>$risk->ffiec_risk_id,
									'FfiecMasterRcMappings.fdomain_id'=>$control->ffiec_domain_id
								]
							])->first();

							if($mapingMaster){
								$rcmap[]=[
									'assessment_id'=>$assessment->id,
									'frisk_id'=>$risk->id,
									'fdomain_id'=>$control->id,
									'mapping'=>$mapingMaster->mapping,
									'status'=>$mapingMaster->status
								];
							} else {
								$rcmap[]=[
									'assessment_id'=>$assessment->id,
									'frisk_id'=>$risk->id,
									'fdomain_id'=>$control->id,
								];
							}

						}
					}
					$this->loadModel('FfiecRcMappings');
					$rcmapping = $this->FfiecRcMappings->newEntities($rcmap);

					$mappingStatus = $this->FfiecRcMappings->saveMany($rcmapping);
					if($mappingStatus){
						$this->Flash->success("Successfully Saved.");
					} else {
						$this->Flash->error("Successfully Saved but Mapping not updated.");
					}
				} else {
					$this->Flash->success("Successfully Saved.");
				}
				if($assessment->atype=='Self'){
					$this->redirect(array('action'=>'view',$assessment->id,$assessment->sub_type));
				} else {
					$this->redirect(array('action'=>'tracking'));
				}

			} else {
				$this->Flash->error("Sorry! Not saved. Try again or contact Administrator.");
			}



		}

		//debug($rassessment);
		//$this->loadModel('Risks');
		//$riskMaster = $this->Risks->find('all')->all();
		//$this->set(compact('riskMaster'));

		$this->viewBuilder()->setLayout('lab');
	}
	//Assessment Repeat Method ends heere.


	//submission of Assessment by employee
	public function assessmentRequest($reguBodyId=null){


		if($this->request->is(['post'])){
			$data = $this->request->getData();

			//assessment to be saved
			$assessment = [
				'owner_id'=>$this->Auth->user('id'),
				'requester_id'=>$this->Auth->user('id'),
				'name'=>$data['name'],
				'atype'=>$data['atype'],
				'sub_type'=>$data['sub_type'],
				//'status'=>"Submitted",//$data['status'],
				'signature'=>$data['signature']
			];

			//generating case number
			$cdata = $this->Assessments->find('all',array(
				'fields'=>array(
					'case_number'=>'(MAX(Assessments.id)+10000+1)'
				)
			))->first();
			$assessment['case_number'] = "CN".$cdata->case_number;



			if($data['sub_type']=="FFIEC Regulated"){

				//generating maturity attributes for each controls
				//used when generating controls
				$this->loadModel('MaturityAttributes');
				$mAttrs = $this->MaturityAttributes->find('all')->all();
				$mAttributes = [];
				foreach($mAttrs as $mAttr){
					$mAttributes[]=[
						'maturity_attribute'=>$mAttr->name
					];
				}


				$frisks = $data['risks'];
				$afrisks=[];
				foreach($frisks as $key=>$frisk){
					$riskInherents = explode('~',$data['riskinherent'][$key]) ;

					$afrisks[$key]['ffiec_risk_id']=$data['risksIds'][$key];
					$afrisks[$key]['name']=$frisk;
					$afrisks[$key]['inherent_score']=$riskInherents[0];
					$afrisks[$key]['inherent_scale']=$riskInherents[1];

					foreach($data['riskfactors'][$key] as $kk=>$friskFactor){
						$scoreAndScale = explode('~',$friskFactor['scale']);
						$afrisks[$key]['ffiec_assessment_risk_factors'][$kk]['name']=$friskFactor['name'];
						$afrisks[$key]['ffiec_assessment_risk_factors'][$kk]['score']=$scoreAndScale[0];
						$afrisks[$key]['ffiec_assessment_risk_factors'][$kk]['scale']=$scoreAndScale[1];
					}
				}
				$assessment['ffiec_assessment_risks']=$afrisks;
				/*
				//generating risks data
				$this->loadModel('FfiecRisks');
				$frisks = $this->FfiecRisks->find('all',[
					'contain'=>[
						'FfiecRiskFactors'
					]
				])->all();
				//debug($frisks);


				$afrisks=[];
				foreach($frisks as $key=>$frisk){
					$afrisks[$key]['ffiec_risk_id']=$frisk->id;
					$afrisks[$key]['name']=$frisk->name;
					foreach($frisk->ffiec_risk_factors as $friskFactor){
						$afrisks[$key]['ffiec_assessment_risk_factors'][]['name']=$friskFactor->name;
					}
				}
				$assessment['ffiec_assessment_risks']=$afrisks;
				//end of risks data building
				*/

				//generating ffiec domains / controls data
				//debug($data);
				$fdomains=[];
				$this->loadModel('FfiecDomains');

				foreach($data['domains'] as $key=>$domain_id){
					$maturityLevel = $data['mlevels'][$key];
					$fdom = $this->FfiecDomains->get($domain_id,[
						'contain'=>[
							'FfiecDomainAssessmentFactors.FfiecDomainRequirements'=>function(Query $q) use ($maturityLevel){
								//global $maturityLevel;
								return $q->where(['FfiecDomainRequirements.maturity_level'=>$maturityLevel]);
							}
						]
					]);

					//debug($fdom);
					$fdafactors = [];
					foreach($fdom->ffiec_domain_assessment_factors as $kf=>$fdaf){
						$fdafactors[$kf]=[
							'name'=>$fdaf->name
						];
						//debug($fdaf);
						foreach($fdaf->ffiec_domain_requirements as $fadar){
							$fdafactors[$kf]['ffiec_assessment_domain_requirements'][]=[
								'component'=>$fadar->component,
								'maturity_level'=>$fadar->maturity_level,
								'name'=>$fadar->name
							];
						}

					}
					$fdomains[$key]=[
						'name'=>$fdom->name,
						'description'=>$fdom->description,
						'ffiec_domain_id'=>$fdom->id,
						'm_level'=>$data['mlevels'][$key],
						'ffiec_assessment_domain_a_factors'=>$fdafactors,
						'ffiec_assessment_maturity_scores'=>$mAttributes,
					];


				}
				//debug($fdomains);
				$assessment['ffiec_assessment_domains']=$fdomains;
				//debug($assessment);


			} else {
				//generating maturity attributes for each controls
				//used when generating controls
				$this->loadModel('MaturityAttributes');
				$mAttrs = $this->MaturityAttributes->find('all')->all();
				$mAttributes = [];
				foreach($mAttrs as $mAttr){
					$mAttributes[]=[
						'maturity_attribute'=>$mAttr->name
					];
				}
				//generating maturity attribute ends

				//generating Risks Template
				$this->loadModel('Risks');
				$riskMaster=[];
				$rsks=$this->Risks->find('all')->all();
				foreach($rsks as $rsk){
					$riskMaster[$rsk->name]=$rsk;
				}
				//generating risks template ends
			}


			if($data['sub_type']=="Regulated"){
				//start of data formatting for regulated assessments



				//assessment_regulatory_bodies
				$arbodies = [];
				foreach($data['regulatoryBody'] as $rbid=>$rbody){
					$arbodies[$rbid]=[
						'regulatory_body_id'=>$rbid
					];
				}//assessment_regulatory_bodies ends

				//default predefined risk severity scales
				$this->loadModel('RiskSeverityScales');
				$rsScales = $this->RiskSeverityScales->find('all')->all();
				$defaultScales=[];
				foreach($rsScales as $rss){
					$defaultScales[]=[
						'severity_scale'=>$rss->severity_scale,
						'score'=>$rss->score
					];
				}
				//


				foreach($data['GenRisk'] as $rbid=>$inherent){
					//inherent risk scores formatting
					$inherentRisks=[];
					foreach($inherent['inherent']['name'] as $k=>$iRisk){
						$inherentRisks[]=[
							'risk_id'=>empty($inherent['inherent']['id'][$k])?"":$inherent['inherent']['id'][$k],
							'risk'=>$iRisk,
							'inherent_scale'=>'',//$inherent['inherent']['scale'][$k],
							'risk_description'=>$inherent['inherent']['description'][$k]//strip_tags($riskMaster[$iRisk]->description)
						];
					} //end of inherent risk scores formatting

					//serverity scales formatting begins
					if(!empty($data['GenRisk'][$rbid]['rScales'])){
						foreach($data['GenRisk'][$rbid]['rScales']['name'] as $k=>$rScale){
							$scales[]=[
								'severity_scale'=>$rScale,
								'score'=>$data['GenRisk'][$rbid]['rScales']['score'][$k]
							];
						}
					} else {
						$scales=$defaultScales;
					}//severity scales formatting ends


					$arbodies[$rbid]['assessment_risks']=$inherentRisks;
					$arbodies[$rbid]['assessment_severity_scales']=$scales;
				}

				//generating controls and control requirements to be saved
				//for this assessment
				$controls = [];
				$postedControls = $data['GenControl'];

				foreach($postedControls as $rbid=>$pC){
					$i=0;
					foreach($pC['control'] as $pControl){
						$controls[$i]=[
							'control_id'=>empty($pControl['id'][0])?"":$pControl['id'][0],
							'name'=>$pControl['name'][0],
							'description'=>$pControl['description'][0],
							'assessment_maturity_scores'=>$mAttributes
						];
						foreach($pControl['req']['name'] as $k=>$pCReq){
							$controls[$i]['assessment_control_requirements'][]=[
								'name'=>$pCReq,
								'artifact'=>empty($pControl['req']['artifact'][$k])?"":$pControl['req']['artifact'][$k],
								'reference'=>empty($pControl['req']['reference'][$k])?"":$pControl['req']['reference'][$k]
							];
						}
						$i++;
					}
					$arbodies[$rbid]['assessment_controls']=$controls;
				}//generationg controls ends here

				$assessment['assessments_regulatory_bodies']=[];
				foreach($arbodies as $arBody){
					$assessment['assessments_regulatory_bodies'][]=$arBody;
				}
				//$assessment['assessments_regulatory_bodies']=$arbodies;

				//debug($assessment);
				//debug($data);

				$assessment['assessment_statuses'][]=[
					'status'=>"In Progress",
					'user_id'=>$this->Auth->user('id'),
					'status_log'=>$this->Auth->user('first_name')." ".$this->Auth->user('last_name')." Submitted assessment request on ".date('d-M-Y H:i:s')
				];


				$assessments = TableRegistry::getTableLocator()->get('Assessments');
				$assessment = $assessments->newEntity($assessment, [
				    'associated' => ['AssessmentsRegulatoryBodies.AssessmentSeverityScales','AssessmentStatuses','AssessmentsRegulatoryBodies.AssessmentRisks','AssessmentsRegulatoryBodies.AssessmentControls','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores']
				]);


			//end of data formatting for regulated assessments
			} else if($data['sub_type']=="FFIEC Regulated"){

				$assessment['assessment_statuses'][]=[
					'status'=>"In Progress",
					'user_id'=>$this->Auth->user('id'),
					'status_log'=>$this->Auth->user('first_name')." ".$this->Auth->user('last_name')." Submitted assessment request on ".date('d-M-Y H:i:s')
				];

				//data building for ffiec regulated assessment
				//creating entity for ffiec regulated assessment
				$assessments = TableRegistry::getTableLocator()->get('Assessments');
				$assessment = $assessments->newEntity($assessment, [
				    'associated' => ['AssessmentStatuses','FfiecAssessmentRisks.FfiecAssessmentRiskFactors','FfiecAssessmentDomains.FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements','FfiecAssessmentDomains.FfiecAssessmentMaturityScores']
				]);
				//debug($assessment);
			} else if($data['sub_type']=="CMMC"){
				$this->loadModel('CmmcDomains');
				$this->loadModel('CmmcLevels');
				$cdomainsData = $this->CmmcDomains->find('all',[
					'contain'=>[
						'CmmcPractices'=>[
							'CmmcCapabilities','CmmcLevels'
						]
					]
				])->all();

				$cdomains = [];
				foreach($cdomainsData as $k=>$cdomain){
					$cdomains[$k]=[
						'name'=>$cdomain->name,
						'code'=>$cdomain->code
					];

					foreach($cdomain->cmmc_practices as $l=>$practice){
						$thisPractice=[
							'name'=>$practice->name,
							'code'=>$practice->code
						];
						if(empty($cdomains[$k]['levels'][$practice->cmmc_level->name]['capabilities'][$practice->cmmc_capability->code])){
							$cdomains[$k]['levels'][$practice->cmmc_level->name]['capabilities'][$practice->cmmc_capability->code] = [
								'name'=>$practice->cmmc_capability->name,
								'code'=>$practice->cmmc_capability->code,
								//'practices' => []
							];
						}


						$cdomains[$k]['levels'][$practice->cmmc_level->name]['capabilities'][$practice->cmmc_capability->code]['practices'][] = $thisPractice;
					}
				}

				$cmmcAssessmentDomains = [];
				foreach($cdomains as $cdomain){

					$levels = [];
					foreach($cdomain['levels'] as $lname=>$level){
						$capabilities = [];
						foreach($level['capabilities'] as $cap){
							$practices = [];

							foreach($cap['practices'] as $practice){
								$practices[] = [
									'name'=>$practice['name'],
									'code'=>$practice['code']
								];
							}
							$capabilities[]= [
								'name'=>$cap['name'],
								'code'=>$cap['code'],
								'cmmc_assessment_practices'=>$practices
							];
						}

						$levels[]=[
							'name'=>$lname,
							'code'=>substr($lname,0,1).substr($lname,-1,1),
							'cmmc_assessment_capabilities'=>$capabilities
						];
					}
					$cmmcAssessmentDomains[] = [
						'name'=>$cdomain['name'],
						'code'=>$cdomain['code'],
						'cmmc_assessment_levels'=>$levels
					];

				}
				$assessment['cmmc_assessment_domains'] = $cmmcAssessmentDomains;


				$assessments = TableRegistry::getTableLocator()->get('Assessments');
				$assessment = $assessments->newEntity($assessment, [
				    'associated' => [
				    	'CmmcAssessmentDomains.CmmcAssessmentLevels.CmmcAssessmentCapabilities.CmmcAssessmentPractices'
				    ]
				]);





			} else {
				//begining of data formatting for generalized and other assessments

				//getting inherent scores for custom/defined risk profiles
				$inherentRisks = [];
				foreach($data['GenRisk']['inherent']['name'] as $k=>$iRisk){
					$inherentRisks[]=[
						'risk_id'=>empty($data['GenRisk']['inherent']['id'][$k])?"":$data['GenRisk']['inherent']['id'][$k],
						'risk'=>$iRisk,
						'inherent_scale'=>'',//$data['GenRisk']['inherent']['scale'][$k],
						'risk_description'=>$data['GenRisk']['inherent']['description'][$k]//strip_tags($riskMaster[$iRisk]->description)
					];
				} //getting inherent scores ends

				//Risk Severity Scales to be used for result generation
				$scales = [];
				if(!empty($data['GenRisk']['rScales'])){
					foreach($data['GenRisk']['rScales']['name'] as $k=>$rScale){
						$scales[]=[
							'severity_scale'=>$rScale,
							'score'=>$data['GenRisk']['rScales']['score'][$k]
						];
					}
				} else {
					$this->loadModel('RiskSeverityScales');
					$rsScales = $this->RiskSeverityScales->find('all')->all();
					foreach($rsScales as $rss){
						$scales[]=[
							'severity_scale'=>$rss->severity_scale,
							'score'=>$rss->score
						];
					}
				} //Risk Severity Scales generation ends




				//generating controls and control requirements to be saved
				//for this assessment
				$controls = [];
				$postedControls = $data['GenControl']['control'];
				$i=0;
				foreach($postedControls as $pControl){
					$controls[$i]=[
						'control_id'=>empty($pControl['id'][0])?"":$pControl['id'][0],
						'name'=>$pControl['name'][0],
						'description'=>$pControl['description'][0],
						'assessment_maturity_scores'=>$mAttributes
					];
					foreach($pControl['req']['name'] as $k=>$pCReq){
						$controls[$i]['assessment_control_requirements'][]=[
							'name'=>$pCReq,
							'artifact'=>empty($pControl['req']['artifact'][$k])?"":$pControl['req']['artifact'][$k],
							'reference'=>''//$pControl['req']['reference'][$k]
						];
					}
					$i++;
				}//generationg controls ends here



				//updating assessment array in the needed format
				//to save in single call with associated tables data
				$assessment['assessment_risks']=$inherentRisks;
				$assessment['assessment_controls']=$controls;
				$assessment['assessment_severity_scales']=$scales;
				//updating assessment array ends

				$assessment['assessment_statuses'][]=[
					'status'=>"In Progress",
					'user_id'=>$this->Auth->user('id'),
					'status_log'=>$this->Auth->user('first_name')." ".$this->Auth->user('last_name')." Submitted assessment request on ".date('d-M-Y H:i:s')
				];

				$assessments = TableRegistry::getTableLocator()->get('Assessments');
				$assessment = $assessments->newEntity($assessment, [
				    'associated' => ['AssessmentRisks','AssessmentStatuses','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores']
				]);
			}



			//debug($assessment);
			//die;


			$result = $assessments->save($assessment);
			//$error = $assessment->errors();
			//debug($result);
			//debug($error);
			//debug($result);


			if($result){

				if($data['sub_type']=="FFIEC Regulated") {
					$this->loadModel('FfiecAssessmentDomains');
					$this->loadModel('FfiecAssessmentRisks');
					//updating mappings from masters
					$controls = $this->FfiecAssessmentDomains->find('all',[
						'conditions'=>['FfiecAssessmentDomains.assessment_id'=>$assessment->id]
					])->all();
					$risks = $this->FfiecAssessmentRisks->find('all',[
						'conditions'=>['FfiecAssessmentRisks.assessment_id'=>$assessment->id]
					])->all();

					//loading model for fetching rcmapping from mapping masters (table: gen_rc_mappings)
					$this->loadModel('FfiecMasterRcMappings');

					$rcmap = [];
					foreach($risks as $risk){
						foreach($controls as $control){
							//fetching mappings from masters
							$mapingMaster = $this->FfiecMasterRcMappings->find('all',[
								'conditions'=>[
									'FfiecMasterRcMappings.frisk_id'=>$risk->ffiec_risk_id,
									'FfiecMasterRcMappings.fdomain_id'=>$control->ffiec_domain_id
								]
							])->first();

							if($mapingMaster){
								$rcmap[]=[
									'assessment_id'=>$assessment->id,
									'frisk_id'=>$risk->id,
									'fdomain_id'=>$control->id,
									'mapping'=>$mapingMaster->mapping,
									'status'=>$mapingMaster->status
								];
							} else {
								$rcmap[]=[
									'assessment_id'=>$assessment->id,
									'frisk_id'=>$risk->id,
									'fdomain_id'=>$control->id,
								];
							}

						}
					}
					$this->loadModel('FfiecRcMappings');
					$rcmapping = $this->FfiecRcMappings->newEntities($rcmap);

					$mappingStatus = $this->FfiecRcMappings->saveMany($rcmapping);
					if($mappingStatus){
						$this->Flash->success("Successfully Saved.");
					} else {
						$this->Flash->error("Successfully Saved but Mapping not updated.");
					}
				} else {
					$this->Flash->success("Successfully Saved.");
				}
				if($assessment->atype=='Self'){
					$this->redirect(array('action'=>'view',$assessment->id,$assessment->sub_type));
				} else {
					$this->redirect(array('action'=>'tracking'));
				}

			} else {
				$this->Flash->error("Sorry! Not saved. Try again or contact Administrator.");
			}



		}

		$this->loadModel('FfiecRisks');
		$fRisks = $this->FfiecRisks->find('all',[
			'contain'=>['FfiecRiskFactors']
		])->all();
		$this->set(compact('fRisks'));

		$this->set('reguBodyId',$reguBodyId);
		$this->viewBuilder()->setLayout('lab');
	}

	//submission of Assessment by employee
	public function assessmentRequestCmmc(){

		$this->loadModel('CmmcDomains');
		$cdomainsData = $this->CmmcDomains->find('all',[
			'contain'=>[
				'CmmcPractices'=>[
					'CmmcCapabilities','CmmcLevels'
				]
			]
		])->all();

		//generating maturity attributes for each controls' levels
		//used when generating controls
		$this->loadModel('CmmcMaturityAttributes');
		$mAttrs = $this->CmmcMaturityAttributes->find('all')->all();
		$mAttributes = [];
		foreach($mAttrs as $mAttr){
			$mAttributes[]=[
				'maturity_attribute'=>$mAttr->name
			];

		}//generating maturity attribute ends


		$cdomains = [];
		foreach($cdomainsData as $k=>$cdomain){
			$cdomains[$k] = [
				'id'=>$cdomain->id,
				'name'=>$cdomain->name,
				'code'=>$cdomain->code
			];
			foreach($cdomain->cmmc_practices as $practice){
				$cdomains[$k]['levels'][$practice->cmmc_level->name][] = $practice;
			}
		}



		//form submission handeling
		if($this->request->is(['post'])){
			$data = $this->request->getData();

			//assessment to be saved
			$assessment = [
				'owner_id'=>$this->Auth->user('id'),
				'requester_id'=>$this->Auth->user('id'),
				'name'=>$data['name'],
				'atype'=>$data['atype'],
				'sub_type'=>'CMMC',
				//'status'=>"Submitted",//$data['status'],
				'signature'=>$data['signature']
			];

			//generating case number
			$cdata = $this->Assessments->find('all',array(
				'fields'=>array(
					'case_number'=>'(MAX(Assessments.id)+10000+1)'
				)
			))->first();
			$assessment['case_number'] = "CN".$cdata->case_number;

			//$this->loadModel('CmmcDomains');
			$this->loadModel('CmmcLevels');
			$cdomainsData = $this->CmmcDomains->find('all',[
				'contain'=>[
					'CmmcPractices'=>[
						'CmmcCapabilities','CmmcLevels'
					]
				]
			])->all();

			$cdomains = [];
			foreach($cdomainsData as $k=>$cdomain){
				$cdomains[$k]=[
					'name'=>$cdomain->name,
					'code'=>$cdomain->code
				];

				foreach($cdomain->cmmc_practices as $l=>$practice){
					$thisPractice=[
						'name'=>$practice->name,
						'code'=>$practice->code
					];
					if(empty($cdomains[$k]['levels'][$practice->cmmc_level->name]['capabilities'][$practice->cmmc_capability->code])){
						$cdomains[$k]['levels'][$practice->cmmc_level->name]['capabilities'][$practice->cmmc_capability->code] = [
							'name'=>$practice->cmmc_capability->name,
							'code'=>$practice->cmmc_capability->code,
							//'practices' => []
						];
					}


					$cdomains[$k]['levels'][$practice->cmmc_level->name]['capabilities'][$practice->cmmc_capability->code]['practices'][] = $thisPractice;
				}
			}

			$cmmcAssessmentDomains = [];
			foreach($cdomains as $cdomain){

				$levels = [];
				foreach($cdomain['levels'] as $lname=>$level){
					$capabilities = [];
					foreach($level['capabilities'] as $cap){
						$practices = [];

						foreach($cap['practices'] as $practice){
							$practices[] = [
								'name'=>$practice['name'],
								'code'=>$practice['code']
							];
						}
						$capabilities[]= [
							'name'=>$cap['name'],
							'code'=>$cap['code'],
							'cmmc_assessment_practices'=>$practices
						];
					}

					$levels[]=[
						'name'=>$lname,
						'code'=>substr($lname,0,1).substr($lname,-1,1),
						'cmmc_assessment_capabilities'=>$capabilities,
						'cmmc_assessment_maturity_scores'=>$mAttributes
					];
				}
				$cmmcAssessmentDomains[] = [
					'name'=>$cdomain['name'],
					'code'=>$cdomain['code'],
					'cmmc_assessment_levels'=>$levels
				];

			}
			$assessment['cmmc_assessment_domains'] = $cmmcAssessmentDomains;


			$assessments = TableRegistry::getTableLocator()->get('Assessments');
			$assessment = $assessments->newEntity($assessment, [
			    'associated' => [
			    	'CmmcAssessmentDomains.CmmcAssessmentLevels.CmmcAssessmentCapabilities.CmmcAssessmentPractices',
			    	'CmmcAssessmentDomains.CmmcAssessmentLevels.CmmcAssessmentMaturityScores'
			    ]
			]);





			$result = $assessments->save($assessment);


			if($result){

				$this->Flash->success("Successfully Saved.");
				if($assessment->atype=='Self'){
					$this->redirect(array('action'=>'view',$assessment->id,$assessment->sub_type));
				} else {
					$this->redirect(array('action'=>'tracking'));
				}

			} else {
				$this->Flash->error("Sorry! Not saved. Try again or contact Administrator.");
			}

		} //end of form submission handeling

		$this->set(compact('cdomains'));
		$this->viewBuilder()->setLayout('lab');
	}


	public function assessmentRequestEgrc(){

		if($this->request->is(['post'])){
			$data = $this->request->getData();
			//debug($data);

			//begining of data formatting for assessment
			//assessment to be saved
			$assessment = [
				'owner_id'=>$this->Auth->user('id'),
				'requester_id'=>$this->Auth->user('id'),
				'name'=>$data['name'],
				'atype'=>'Self',
				'sub_type'=>'eGRC',
				//'status'=>"Submitted",//$data['status'],
				'signature'=>$data['signature']
			];

			//generating case number
			$cdata = $this->Assessments->find('all',array(
				'fields'=>array(
					'case_number'=>'(MAX(Assessments.id)+10000+1)'
				)
			))->first();
			$assessment['case_number'] = "CN".$cdata->case_number;

			//generating maturity attributes for each controls
			//used when generating controls
			$this->loadModel('MaturityAttributes');
			$mAttrs = $this->MaturityAttributes->find('all')->all();
			$mAttributes = [];
			foreach($mAttrs as $mAttr){
				$mAttributes[]=[
					'maturity_attribute'=>$mAttr->name
				];
			}
			//generating maturity attribute ends

			//generating Risks Template
			$this->loadModel('EgrcRisks');
			$riskMaster=[];
			$rsks=$this->EgrcRisks->find('all',[
					'conditions'=>[
						'OR'=>[
							'EgrcRisks.company_id'=>'',
							'EgrcRisks.company_id IS NULL',
							'EgrcRisks.company_id'=>$this->companyId
						]
					]
				])->all();
			foreach($rsks as $rsk){
				$riskMaster[$rsk->name]=$rsk;
			}
			//generating risks template ends


			//getting inherent scores for custom/defined risk profiles
			$inherentRisks = [];
			foreach($data['GenRisk']['inherent']['name'] as $k=>$iRisk){
				$inherentRisks[]=[
					'egrc_risk_id'=>empty($data['GenRisk']['inherent']['id'][$k])?"":$data['GenRisk']['inherent']['id'][$k],
					'name'=>$iRisk,
					'inherent_scale'=>'',//$data['GenRisk']['inherent']['scale'][$k],
					'description'=>$data['GenRisk']['inherent']['description'][$k]//strip_tags($riskMaster[$iRisk]->description)
				];
			} //getting inherent scores ends

			//Risk Severity Scales to be used for result generation
			$scales = [];
			if(!empty($data['GenRisk']['rScales'])){
				foreach($data['GenRisk']['rScales']['name'] as $k=>$rScale){
					$scales[]=[
						'severity_scale'=>$rScale,
						'score'=>$data['GenRisk']['rScales']['score'][$k]
					];
				}
			} else {
				$this->loadModel('RiskSeverityScales');
				$rsScales = $this->RiskSeverityScales->find('all')->all();
				foreach($rsScales as $rss){
					$scales[]=[
						'severity_scale'=>$rss->severity_scale,
						'score'=>$rss->score
					];
				}
			} //Risk Severity Scales generation ends




			//generating controls and control requirements to be saved
			//for this assessment
			$controls = [];
			$postedControls = $data['GenControl']['control'];
			$i=0;
			foreach($postedControls as $pControl){
				$controls[$i]=[
					'egrc_policy_id'=>empty($pControl['id'][0])?"":$pControl['id'][0],
					'name'=>$pControl['name'][0],
					'description'=>$pControl['description'][0],
					'egrc_assessment_maturity_scores'=>$mAttributes
				];
				foreach($pControl['req']['name'] as $k=>$pCReq){
					$controls[$i]['egrc_assessment_policy_statements'][]=[
						'name'=>$pCReq,
						'artifact'=>empty($pControl['req']['artifact'][$k])?"":$pControl['req']['artifact'][$k],
						'reference'=>''//$pControl['req']['reference'][$k]
					];
				}
				$i++;
			}//generationg controls ends here



			//updating assessment array in the needed format
			//to save in single call with associated tables data
			$assessment['egrc_assessment_risks']=$inherentRisks;
			$assessment['egrc_assessment_policies']=$controls;
			$assessment['assessment_severity_scales']=$scales;
			//updating assessment array ends

			$assessment['assessment_statuses'][]=[
				'status'=>"In Progress",
				'user_id'=>$this->Auth->user('id'),
				'status_log'=>$this->Auth->user('first_name')." ".$this->Auth->user('last_name')." Submitted assessment request on ".date('d-M-Y H:i:s')
			];
			//debug($assessment);

			$assessments = TableRegistry::getTableLocator()->get('Assessments');

			$assessment = $assessments->newEntity($assessment, [
			    'associated' => ['EgrcAssessmentRisks','AssessmentStatuses','AssessmentSeverityScales','EgrcAssessmentPolicies.EgrcAssessmentPolicyStatements','EgrcAssessmentPolicies.EgrcAssessmentMaturityScores']
			]);
			//debug($assessment);


			$result = $assessments->save($assessment);
			//$error = $assessment->errors();
			//debug($result);
			//debug($error);
			//debug($result);


			if($result){


				$this->loadModel('EgrcAssessmentPolicies');
				$this->loadModel('EgrcAssessmentRisks');
				//updating mappings from masters
				$controls = $this->EgrcAssessmentPolicies->find('all',[
					'conditions'=>['EgrcAssessmentPolicies.assessment_id'=>$assessment->id]
				])->all();
				$risks = $this->EgrcAssessmentRisks->find('all',[
					'conditions'=>['EgrcAssessmentRisks.assessment_id'=>$assessment->id]
				])->all();

				//loading model for fetching rcmapping from mapping masters (table: gen_rc_mappings)
				$this->loadModel('EgrcMasterRcMappings');

				$rcmap = [];
				$mappedPolicies = [];
				foreach($risks as $risk){
					foreach($controls as $pk=>$control){
						//fetching mappings from masters
						$mapingMaster = $this->EgrcMasterRcMappings->find('all',[
							'conditions'=>[
								'EgrcMasterRcMappings.egrc_risk_id'=>$risk->egrc_risk_id,
								'EgrcMasterRcMappings.egrc_policy_id'=>$control->egrc_policy_id
							]
						])->first();

						if($mapingMaster){
							$rcmap[]=[
								'assessment_id'=>$assessment->id,
								'egrc_assessment_risk_id'=>$risk->id,
								'egrc_assessment_policy_id'=>$control->id,
								'mapping'=>$mapingMaster->mapping,
								'status'=>$mapingMaster->status
							];

							$mappedPolicies[$control->id]=[
								'id'=>$control->id,
								'mapping_status'=>$mapingMaster->status=='Mapped'?'Completed':$mapingMaster->status
							];

						} else {
							$rcmap[]=[
								'assessment_id'=>$assessment->id,
								'egrc_assessment_risk_id'=>$risk->id,
								'egrc_assessment_policy_id'=>$control->id,
							];
						}

					}
				}

				//debug($mappedPolicies);
				//saving mappings where mapping is updated in masters
				if(!empty($mappedPolicies)){
					$ep = $this->EgrcAssessmentPolicies->patchEntities($mappedPolicies,$mappedPolicies);
					$this->EgrcAssessmentPolicies->saveMany($ep);
				}

				//saving mappings from mapping masters
				$this->loadModel('EgrcRcMappings');
				$rcmapping = $this->EgrcRcMappings->newEntities($rcmap,[
					'associated'=>['EgrcAssessmentPolicies']
				]);

				$mappingStatus = $this->EgrcRcMappings->saveMany($rcmapping);
				if($mappingStatus){
					$this->Flash->success("Successfully Saved.");
				} else {
					$this->Flash->error("Successfully Saved but Mapping not updated.");
				}

				$this->Flash->success("Successfully Saved.");
				$this->redirect(array('action'=>'view',$assessment->id,'eGRC'));

			} else {
				$this->Flash->error("Sorry! Not saved. Try again or contact Administrator.");
			}

		} else {

			$company_id = $this->companyId;
			$this->loadModel('Policies');
			$this->loadModel('EgrcRisks');
			$this->loadModel('RiskSeverityScales');

			$policies = $this->Policies->find('all',[
				'conditions'=>[
					'Policies.approved'=>'Yes',
					'Policies.status'=>'Final',
					'Policies.company_id'=>$this->companyId
				],
				'contain'=>['PolicyStatements']
			])->all();

			$risks = $this->EgrcRisks->find('all',[
				'conditions'=>[
					'OR'=>[
						'EgrcRisks.company_id'=>'',
						'EgrcRisks.company_id IS NULL',
						'EgrcRisks.company_id'=>$this->companyId
					]
				]
			])->all();

			$company = $this->Assessments->Users->get($company_id);
			$aname = "eGRC - ".$company->company_name." - ". date("dMY");
			$rScales = $this->RiskSeverityScales->find('all');
			$this->set(compact('risks','policies','rScales','aname'));


		}

		//$this->loadModel('Risks');
		//$riskMaster = $this->Risks->find('all')->all();
		//$this->set(compact('riskMaster'));

		$this->viewBuilder()->setLayout('lab');
	}


	public function completeRegulatedAssessmentRequest($id=null){
		if($id==null){ //checking if the assessment id is passed or not
			$this->Flash->error("Sorry! Invalid Assessment");
			return $this->redirect(['action'=>'tracking']);
		}


		try { //checking if the assessment exists or not
			  //and getting the assessment
		    $assessment = $this->Assessments->get($id,[
		    	'contain'=>[
		    		'AssessmentsRegulatoryBodies.AssessmentSeverityScales',
		    		'AssessmentsRegulatoryBodies.AssessmentRisks',
		    		'AssessmentsRegulatoryBodies.AssessmentControls',
		    		'AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements',
		    		'AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores',
		    		'AssessmentsRegulatoryBodies.RegulatoryBodies',
		    	]
		    ]);

			//$assessment->owner = $this->Assessments->Users->get($assessment->owner_id);
			//$assessment->requester = $this->Assessments->Users->get($assessment->requester_id);
			//debug($assessment);

			//matiruty attributes for existing controls
			//to be defined for each control if new or old
			$aAttributes = [];
			foreach($assessment->assessments_regulatory_bodies as $asRbody){
				foreach($asRbody->assessment_controls as $asControl){
					foreach($asControl->assessment_maturity_scores as $asScore){
						$aAttributes[$asRbody->id][$asControl->id][$asScore->id]=$asScore->maturity_attribute;
					}
				}
			}

		} catch (\Exception $e) {
		    $this->Flash->error("Sorry! Assessment not found.");
			return $this->redirect(['action'=>'tracking']);
		} //checking and getting assessment ends here

		if($assessment->status!='Submitting'){ //checking if assessment is incomplete
			$this->Flash->error("Sorry! Assessment status is ".$assessment->status." and can not be modified. Kindly check");
			return $this->redirect(['action'=>'tracking']);
		}

		if($this->request->is(['post','put'])){
			$data = $this->request->getData();
			//debug($data);

			//assessment to be saved
			$assessmentUpdated = [
				'name'=>$data['name'],
				'status'=>$data['status']
			];

			if(!empty($data['signature']['name'])){
				/* uploading signature image file*/
				$ext = explode('.',$data['signature']['name']);
				$ext = end($ext);
				if($ext=='jpg' || $ext=='png' || $ext=='jpeg'){
					$awsPath = 'signatures/signatures-'.str_replace(' ','_',microtime())."_".$assessment['case_number'].".".$ext;
					$file = $this->aws->putObject($awsPath,$data['signature']['tmp_name']);
					if($file['status']=='200'){
						$assessmentUpdated['signature']=$file['url'];
					}
				}
				/* uploading signature image file ends*/
			}

			//assessment_regulatory_bodies
			$arbodies = [];
			foreach($data['regulatoryBody'] as $rbid=>$rbody){

				if(isset($rbody[0]) && $rbody[0]!=0){
					$arbodies[$rbid]=[
						'regulatory_body_id'=>$rbid
					];
				} else {
					$arbodies[$rbid]=[
						'id'=>key($rbody),
						'regulatory_body_id'=>$rbid
					];
				}

			}//assessment_regulatory_bodies ends
			//debug($arbodies);
			//default predefined risk severity scales
			$this->loadModel('RiskSeverityScales');
			$rsScales = $this->RiskSeverityScales->find('all')->all();
			$defaultScales=[];
			foreach($rsScales as $rss){
				$defaultScales[]=[
					'severity_scale'=>$rss->severity_scale,
					'score'=>$rss->score
				];
			}
			//


			foreach($data['GenRisk'] as $rbid=>$inherent){
				//inherent risk scores formatting
				$inherentRisks=[];
				foreach($inherent['inherent']['name'] as $k=>$iRisk){
					if(isset($inherent['inherent']['id'][$k])){
						$inherentRisks[]=[
							'id'=>$inherent['inherent']['id'][$k],
							'risk'=>$iRisk,
							'inherent_scale'=>$inherent['inherent']['scale'][$k]
						];
					} else {
						$inherentRisks[]=[
							'risk'=>$iRisk,
							'inherent_scale'=>$inherent['inherent']['scale'][$k]
						];
					}

				} //end of inherent risk scoresdebug($inherent['rScales']);
				//serverity scales formatting begins
				$scales=[];
				if(!empty($inherent['rScales'])){
					foreach($inherent['rScales']['name'] as $k=>$rScale){
						if(!empty($inherent['rScales']['id'])){
							$scales[]=[
								'id'=>$inherent['rScales']['id'][$k],
								'severity_scale'=>$rScale,
								'score'=>$inherent['rScales']['score'][$k]
							];
						} else {
							$scales[]=[
								'severity_scale'=>$rScale,
								'score'=>$inherent['rScales']['score'][$k]
							];
						}

					}

				} else {
					$scales=$defaultScales;
				}//severity scales formatting ends


				$arbodies[$rbid]['assessment_risks']=$inherentRisks;
				$arbodies[$rbid]['assessment_severity_scales']=$scales;
			}

			//generating maturity attributes for each controls
			//used when generating controls
			$this->loadModel('MaturityAttributes');
			$mAttrs = $this->MaturityAttributes->find('all')->all();
			$mAttributes = [];
			foreach($mAttrs as $mAttr){
				$mAttributes[]=[
					'maturity_attribute'=>$mAttr->name
				];

			}//generating maturity attribute ends


			//generating controls and control requirements to be saved
			//for this assessment
			$controls = [];
			$postedControls = $data['GenControl'];

			foreach($postedControls as $rbid=>$pC){
				$i=0;
				foreach($pC['control'] as $pControl){
					if(isset($pControl['id'][0])){
						$controls[$i]=[
							'id'=>$pControl['id'][0],
							'name'=>$pControl['name'][0],
							//'assessment_maturity_scores'=>$mAttributes
						];
					} else {
						$controls[$i]=[
							'name'=>$pControl['name'][0],
							'assessment_maturity_scores'=>$mAttributes
						];
					}


					foreach($pControl['req']['name'] as $k=>$pCReq){
						if(isset($pControl['req']['id'][$k])){
							$controls[$i]['assessment_control_requirements'][]=[
								'id'=>$pControl['req']['id'][$k],
								'name'=>$pCReq,
								'artifact'=>$pControl['req']['artifact'][$k],
								'reference'=>$pControl['req']['reference'][$k]
							];
						} else {
							$controls[$i]['assessment_control_requirements'][]=[
								'name'=>$pCReq,
								'artifact'=>$pControl['req']['artifact'][$k],
								'reference'=>$pControl['req']['reference'][$k]
							];
						}

					}
					$i++;
				}
				$arbodies[$rbid]['assessment_controls']=$controls;
			}//generationg controls ends here

			$assessmentUpdated['assessments_regulatory_bodies']=[];
			foreach($arbodies as $arBody){
				$assessmentUpdated['assessments_regulatory_bodies'][]=$arBody;
			}
			//$assessment['assessments_regulatory_bodies']=$arbodies;

			//debug($assessmentUpdated);
			//debug($data);

			//re-configure the save strategy if any of the associated record is deleted/modified
			$this->Assessments->association('AssessmentsRegulatoryBodies')->saveStrategy('replace');
			$this->Assessments->AssessmentsRegulatoryBodies->association('AssessmentSeverityScales')->saveStrategy('replace');
			$this->Assessments->AssessmentsRegulatoryBodies->association('AssessmentRisks')->saveStrategy('replace');
			$this->Assessments->AssessmentsRegulatoryBodies->association('AssessmentControls')->saveStrategy('replace');
			$this->Assessments->AssessmentsRegulatoryBodies->AssessmentControls->association('AssessmentControlRequirements')->saveStrategy('replace');
			$this->Assessments->AssessmentsRegulatoryBodies->AssessmentControls->association('AssessmentMaturityScores')->saveStrategy('replace');


			$assessment = $this->Assessments->patchEntity($assessment,$assessmentUpdated, [
			    'associated' => ['AssessmentsRegulatoryBodies.AssessmentSeverityScales','AssessmentsRegulatoryBodies.AssessmentRisks','AssessmentsRegulatoryBodies.AssessmentControls','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentControlRequirements','AssessmentsRegulatoryBodies.AssessmentControls.AssessmentMaturityScores']
			]);
			//debug($assessment);
			$result = $this->Assessments->save($assessment);
			if($result){
				$this->Flash->success("Successfully Saved.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			} else {
				$this->Flash->error("Sorry! Not saved. Try agin or contact Administrator.");
				return $this->redirect(['controller'=>'assessments','action'=>'completeRegulatedAssessmentRequest',$id]);
			}

		}

		$this->loadModel('RegulatoryBodies');
		$regulatoryBodies = $this->RegulatoryBodies->find('all')->all();
		$this->set(compact('regulatoryBodies','assessment'));

		$this->viewBuilder()->setLayout('lab');
	}


	//completing incomplete assessment requests
	public function completeAssessmentRequest($id=null){

		if($id==null){ //checking if the assessment id is passed or not
			$this->Flash->error("Sorry! Invalid Assessment");
			return $this->redirect(['action'=>'tracking']);
		}


		try { //checking if the assessment exists or not
			  //and getting the assessment
		    $assessment = $this->Assessments->get($id,[
		    	'contain'=>[
		    		'AssessmentControls.AssessmentControlRequirements',
		    		'AssessmentControls.AssessmentMaturityScores',
		    		'AssessmentRisks.RcMappings',
		    		'AssessmentSeverityScales',
		    		'AssessmentStatuses',
		    		//'RegulatoryBodies'
		    	]
		    ]);

			$assessment->owner = $this->Assessments->Users->get($assessment->owner_id);
			$assessment->requester = $this->Assessments->Users->get($assessment->requester_id);


			//matiruty attributes for existing controls
			//to be defined for each control if new or old
			$aAttributes = [];
			foreach($assessment->assessment_controls as $asControl){
				foreach($asControl->assessment_maturity_scores as $asScore){
					$aAttributes[$asControl->id][$asScore->id]=$asScore->maturity_attribute;
				}
			}

		} catch (\Exception $e) {
		    $this->Flash->error("Sorry! Assessment not found.".$e);
			return $this->redirect(['action'=>'tracking']);
		} //checking and getting assessment ends here

		if($assessment->status!='Submitting'){ //checking if assessment is incomplete
			$this->Flash->error("Sorry! Assessment status is ".$assessment->status." and can not be modified. Kindly check");
			return $this->redirect(['action'=>'tracking']);
		}

		if($this->request->is(['post','put'])){
			$data = $this->request->getData();
			//debug($data);


			//assessment to be saved
			$assessmentUpdated = [
				'name'=>$data['name'],
				'status'=>$data['status']
			];


			if(!empty($data['signature']['name'])){
				/* uploading signature image file*/
				$ext = explode('.',$data['signature']['name']);
				$ext = end($ext);
				if($ext=='jpg' || $ext=='png' || $ext=='jpeg'){
					$awsPath = 'signatures/signatures-'.str_replace(' ','_',microtime())."_".$assessment['case_number'].".".$ext;
					$file = $this->aws->putObject($awsPath,$data['signature']['tmp_name']);
					if($file['status']=='200'){
						$assessmentUpdated['signature']=$file['url'];
					}
				}
				/* uploading signature image file ends*/
			}

			//getting inherent scores for custom/defined risk profiles
			$inherentRisks = [];
			foreach($data['GenRisk']['inherent']['name'] as $k=>$iRisk){
				if(empty($data['GenRisk']['inherent']['id'][$k])){
					$inherentRisks[]=[
						'risk'=>$iRisk,
						'inherent_scale'=>$data['GenRisk']['inherent']['scale'][$k]
					];
				} else {
					$inherentRisks[]=[
						'id'=>$data['GenRisk']['inherent']['id'][$k],
						'risk'=>$iRisk,
						'inherent_scale'=>$data['GenRisk']['inherent']['scale'][$k]
					];
				}

			} //getting inherent scores ends

			//Risk Severity Scales to be used for result generation
			$scales = [];
			if(!empty($data['GenRisk']['rScales'])){
				foreach($data['GenRisk']['rScales']['name'] as $k=>$rScale){
					if($data['GenRisk']['rScales']['id'][$k]=='new'){
						$scales[]=[
							'severity_scale'=>$rScale,
							'score'=>$data['GenRisk']['rScales']['score'][$k]
						];
					} else {
						$scales[]=[
							'id'=>$data['GenRisk']['rScales']['id'][$k],
							'severity_scale'=>$rScale,
							'score'=>$data['GenRisk']['rScales']['score'][$k]
						];
					}

				}
			} else {
				$rsScales = $this->Assessments->AssessmentSeverityScales->find('all',[
					'conditions'=>[
						'AssessmentSeverityScales.assessment_id'=>$assessment->id
					]
				])->all();
				foreach($rsScales as $rss){
					$scales[]=[
						'id'=>$rss->id,
						'severity_scale'=>$rss->severity_scale,
						'score'=>$rss->score
					];
				}
			} //Risk Severity Scales generation ends


			//generating maturity attributes for each controls
			//used when generating controls
			$this->loadModel('MaturityAttributes');
			$mAttrs = $this->MaturityAttributes->find('all')->all();
			$mAttributes = [];
			foreach($mAttrs as $mAttr){
				$mAttributes[]=[
					'maturity_attribute'=>$mAttr->name
				];

			}//generating maturity attribute ends


			//generating controls and control requirements to be saved
			//for this assessment
			$controls = [];
			$postedControls = empty($data['GenControl']['control'])?[]:$data['GenControl']['control'];

			$i=0;
			foreach($postedControls as $pControl){
				if(empty($pControl['id'][0])){
					$controls[$i]=[
						'name'=>$pControl['name'][0],
						'assessment_maturity_scores'=>$mAttributes
					];
				} else {
					$thisCAttributes = $aAttributes[$pControl['id'][0]];
					$thisMAttributes=[];
					foreach($mAttributes as $mk=>$mattri){
						$maid = array_search($mattri['maturity_attribute'],$thisCAttributes);

						if($maid!=FALSE){
							$thisMAttributes[$mk]['id']=$maid;
						}
						$thisMAttributes[$mk]['maturity_attribute']=$mattri['maturity_attribute'];
					}
					$controls[$i]=[
						'id'=>$pControl['id'][0],
						'name'=>$pControl['name'][0],
						'assessment_maturity_scores'=>$thisMAttributes
					];
				}

				foreach($pControl['req']['name'] as $k=>$pCReq){
					if(empty($pControl['req']['id'][$k])){
						$controls[$i]['assessment_control_requirements'][]=[
							'name'=>$pCReq,
							'artifact'=>$pControl['req']['artifact'][$k],
							'reference'=>$pControl['req']['reference'][$k]
						];
					} else {
						$controls[$i]['assessment_control_requirements'][]=[
							'id'=>$pControl['req']['id'][$k],
							'name'=>$pCReq,
							'artifact'=>$pControl['req']['artifact'][$k],
							'reference'=>$pControl['req']['reference'][$k]
						];
					}

				}
				$i++;
			}//generationg controls ends here



			//updating assessment array in the needed format
			//to save in single call with associated tables data
			$assessmentUpdated['assessment_risks']=$inherentRisks;
			$assessmentUpdated['assessment_controls']=$controls;
			$assessmentUpdated['assessment_severity_scales']=$scales;
			//updating assessment array ends

			//re-configure the save strategy if any of the associated record is deleted/modified
			$this->Assessments->association('AssessmentRisks')->saveStrategy('replace');
			$this->Assessments->association('AssessmentSeverityScales')->saveStrategy('replace');
			$this->Assessments->association('AssessmentControls')->saveStrategy('replace');
			$this->Assessments->AssessmentControls->association('AssessmentControlRequirements')->saveStrategy('replace');
			$this->Assessments->AssessmentControls->association('AssessmentMaturityScores')->saveStrategy('replace');


			//$assessments = TableRegistry::getTableLocator()->get('Assessments');
			$assessment = $this->Assessments->patchEntity($assessment,$assessmentUpdated, [
			    'associated' => ['AssessmentRisks','AssessmentSeverityScales','AssessmentControls.AssessmentControlRequirements','AssessmentControls.AssessmentMaturityScores']
			]);
			//debug($assessment);



			$result = $this->Assessments->save($assessment);
			if($result){
				$this->Flash->success("Successfully Saved.");
				return $this->redirect(['controller'=>'assessments','action'=>'tracking']);
			} else {
				$this->Flash->error("Sorry! Not saved. Try agin or contact Administrator.");
				return $this->redirect(['controller'=>'assessments','action'=>'completeAssessmentRequest',$id]);
			}

		}
		//debug($assessment);
		$this->set(compact('assessment'));
		$this->set('subType',$assessment->sub_type);
		$this->viewBuilder()->setLayout('lab');
	}

	//loading related risks and controls while submitting the assessment request
	public function getRisksAndControls($subtype,$atype){

		$this->viewBuilder()->setLayout(false);
		if($subtype=='Generalized'){
			$this->loadModel('GenControls');
			$this->loadModel('Risks');
			$this->loadModel('RiskSeverityScales');

			$risks = $this->Risks->find('all')->all();
			$controls = $this->GenControls->find('all',['contain'=>'GenControlRequirements'])->all();
			$rScales = $this->RiskSeverityScales->find('all');
			$this->set(compact('risks','controls','rScales'));
		} elseif($subtype=='Regulated'){
			$this->loadModel('RegulatoryBodies');
			$regulatoryBodies = $this->RegulatoryBodies->find('all')->all();
			$this->set(compact('regulatoryBodies'));
			//debug($regulatoryBodies);
		} elseif($subtype=='FFIEC Regulated'){
			$this->loadModel('FfiecRisks');
			$this->loadModel('FfiecDomains');
			$this->loadModel('RiskSeverityScales');


			$domains = $this->FfiecDomains->find('all')->all();
			//$domains = $domains->select(['name'])->distinct(['name'])->all();

			$risks = $this->FfiecRisks->find('all',[
				'contain'=>[
					'FfiecRiskFactors'
				]
			])->all();
			$mLevels = [
				'Baseline'=>'Baseline',
				'Evolving'=>'Evolving',
				'Intermediate'=>'Intermediate',
				'Advanced'=>'Advanced',
				'Innovative'=>'Innovative'
			];

			$rScales = $this->RiskSeverityScales->find('all');

			$this->set(compact('domains','risks','mLevels','rScales'));
		} elseif($subtype=='CMMC'){
			$this->loadModel('CmmcDomains');
			$cdomainsData = $this->CmmcDomains->find('all',[
				'contain'=>[
					'CmmcPractices'=>[
						'CmmcCapabilities','CmmcLevels'
					]
				]
			])->all();


			$cdomains = [];
			foreach($cdomainsData as $k=>$cdomain){
				$cdomains[$k] = [
					'id'=>$cdomain->id,
					'name'=>$cdomain->name,
					'code'=>$cdomain->code
				];
				foreach($cdomain->cmmc_practices as $practice){
					$cdomains[$k]['levels'][$practice->cmmc_level->name][] = $practice;
				}
			}

			//debug($cdomains);

			$this->set(compact('cdomains'));
		} else {
			$this->loadModel('RiskSeverityScales');
			$rScales = $this->RiskSeverityScales->find('all');
			$this->set(compact('rScales'));
		}

		$this->set('subtype',$subtype);
		$this->set('readonly',$atype=="Self"?'':'disabled');
		if($atype=='Self'){
			$this->set('required','No');
		} else {
			$this->set('required','No');//temporarily puting as allow
		}

	}

	public function getRisksAndControlsReassess($subtype,$atype){

		$this->viewBuilder()->setLayout(false);
		if($subtype=='Generalized'){
			$this->loadModel('GenControls');
			$this->loadModel('Risks');
			$this->loadModel('RiskSeverityScales');

			$risks = $this->Risks->find('all')->all();
			$controls = $this->GenControls->find('all',['contain'=>'GenControlRequirements'])->all();
			$rScales = $this->RiskSeverityScales->find('all');
			$this->set(compact('risks','controls','rScales'));
		} elseif($subtype=='Regulated'){
			$this->loadModel('RegulatoryBodies');
			$regulatoryBodies = $this->RegulatoryBodies->find('all')->all();
			$this->set(compact('regulatoryBodies'));
			//debug($regulatoryBodies);
		} elseif($subtype=='FFIEC Regulated'){
			$this->loadModel('FfiecRisks');
			$this->loadModel('FfiecDomains');

			$domains = $this->FfiecDomains->find('all')->all();
			//$domains = $domains->select(['name'])->distinct(['name'])->all();

			$risks = $this->FfiecRisks->find('all',[
				'contain'=>[
					'FfiecRiskFactors'
				]
			])->all();
			$mLevels = [
				'Baseline'=>'Baseline',
				'Evolving'=>'Evolving',
				'Intermediate'=>'Intermediate',
				'Advanced'=>'Advanced',
				'Innovative'=>'Innovative'
			];

			$this->set(compact('domains','risks','mLevels'));
		} else {
			$this->loadModel('RiskSeverityScales');
			$rScales = $this->RiskSeverityScales->find('all');
			$this->set(compact('rScales'));
		}

		$this->set('subtype',$subtype);
		$this->set('readonly',$atype=="Self"?'':'disabled');
		if($atype=='Self'){
			$this->set('required','No');
		} else {
			$this->set('required','No');//temporarily puting as allow
		}

	}

	public function getRisksAndControlsRegulated($rbid=null,$atype=null){
		$this->viewBuilder()->setLayout(false);
		$this->loadModel('Risks');
		$this->loadModel('RiskSeverityScales');
		$this->loadModel('RegulatoryBodies');

		$risks = $this->Risks->find('all')->all();
		$controls = $this->RegulatoryBodies->RbControls->find('all',[
			'contain'=>['RbControlRequirements'],
			'conditions'=>[
				'RbControls.regulatory_body_id'=>$rbid
			]
		])->all();
		$rBody = $this->RegulatoryBodies->get($rbid);
		$rScales = $this->RiskSeverityScales->find('all');
		$this->set(compact('risks','controls','rScales','rBody'));
		$this->set('readonly',$atype=="Self"?'':'disabled');
	}



    /**
     * Edit method
     *
     * @param string|null $id Assessment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assessment = $this->Assessments->get($id, [
            'contain' => ['RegulatoryBodies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());
            if ($this->Assessments->save($assessment)) {
                $this->Flash->success(__('The assessment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment could not be saved. Please, try again.'));
        }
        $owners = $this->Assessments->Owners->find('list', ['limit' => 200]);
        $requesters = $this->Assessments->Requesters->find('list', ['limit' => 200]);
        $regulatoryBodies = $this->Assessments->RegulatoryBodies->find('list', ['limit' => 200]);
        $this->set(compact('assessment', 'owners', 'requesters', 'regulatoryBodies'));
    }



	/*
	 * uploading artifact file
	 * */
	public function uploadArtifact(){
		$this->autoRender = false;
		$this->request->allowMethod(['post']);
		$data = $this->request->getData();

		if(!empty($data['afile']['name'])){
			$ext = explode('.',$data['afile']['name']);
			$ext = end($ext);
			if($ext=='pdf' || $ext=='PDF'){
				$awsPath = 'artifacts/artifact-'.str_replace(' ','_',microtime()).$this->Auth->user('id').".".$ext;
				$file = $this->aws->putObject($awsPath,$data['afile']['tmp_name']);
				if($file['status']=='200'){
					echo $file['url'];
				} else {
					echo 0;
				}

			} else {
				echo 3; //only pdf files are supported
			}

		} else {
			echo 4;
		}

	}

	public function deleteArtifactFromAdmin(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->request->allowMethod(['post']);
		$data = $this->request->getData();
		$acr = $data['id'];
		//$acr = 2;
		$this->loadModel('AssessmentControlRequirements');
		$areq = $this->AssessmentControlRequirements->get($acr);
		//$areq->artifact = "";
		$areq = $this->AssessmentControlRequirements->patchEntity($areq,['artifact'=>'']);

		$result = $this->AssessmentControlRequirements->save($areq);

		if($result){
			echo 1;
		} else {
			echo 0;
		}


	}
	public function deleteArtifactFfiec(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->request->allowMethod(['post']);
		$data = $this->request->getData();
		$acr = $data['id'];
		//$acr = 2;
		$this->loadModel('FfiecAssessmentDomainRequirements');
		$areq = $this->FfiecAssessmentDomainRequirements->get($acr);
		//$areq->artifact = "";
		$areq = $this->FfiecAssessmentDomainRequirements->patchEntity($areq,['artifact'=>'']);

		$result = $this->FfiecAssessmentDomainRequirements->save($areq);

		if($result){
			echo 1;
		} else {
			echo 0;
		}


	}

	public function deleteArtifactEgrc(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->request->allowMethod(['post']);
		$data = $this->request->getData();
		$acr = $data['id'];
		//$acr = 2;
		$this->loadModel('EgrcAssessmentPolicyStatements');
		$areq = $this->EgrcAssessmentPolicyStatements->get($acr);
		//$areq->artifact = "";
		$areq = $this->EgrcAssessmentPolicyStatements->patchEntity($areq,['artifact'=>'']);

		$result = $this->EgrcAssessmentPolicyStatements->save($areq);

		if($result){
			echo 1;
		} else {
			echo 0;
		}


	}

	public function deleteArtifactCmmc(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->request->allowMethod(['post']);
		$data = $this->request->getData();
		$acr = $data['id'];

		$this->loadModel('CmmcAssessmentPractices');
		$areq = $this->CmmcAssessmentPractices->get($acr);

		$areq = $this->CmmcAssessmentPractices->patchEntity($areq,['artifact'=>'']);

		$result = $this->CmmcAssessmentPractices->save($areq);

		if($result){
			echo 1;
		} else {
			echo 0;
		}


	}


	public function uploadArtifactFromAdmin(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->request->allowMethod(['post']);
		$data = $this->request->getData();
		$aid = $data['id'];

		if(!empty($data['afile']['name'])){
			$ext = explode('.',$data['afile']['name']);
			$ext = end($ext);
			if($ext=='pdf' || $ext=='PDF'){
				$awsPath = 'artifacts/artifact-'.str_replace(' ','_',microtime()).$this->Auth->user('id').$aid.".".$ext;
				$file = $this->aws->putObject($awsPath,$data['afile']['tmp_name']);
				//debug($file['url']);
				//return;
				if($file['status']=='200'){


					$this->loadModel('AssessmentControlRequirements');
					$acReq = $this->AssessmentControlRequirements->findById($aid)->first();
					$acReq->artifact = $file['url'];
					//print_r($acReq);
					if($this->AssessmentControlRequirements->save($acReq)){
						echo $file['url'];
					} else {
						echo 0;
					}

				} else {
					echo 0;
				}

			} else {
				echo 3; //only pdf files are supported
			}

		} else {
			echo 4;
		}

	}

	public function uploadArtifactForFfiec(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->request->allowMethod(['post']);
		$data = $this->request->getData();
		$aid = $data['id'];

		if(!empty($data['afile']['name'])){
			$ext = explode('.',$data['afile']['name']);
			$ext = end($ext);
			if($ext=='pdf' || $ext=='PDF'){
				$awsPath = 'artifacts/artifact-'.str_replace(' ','_',microtime()).$this->Auth->user('id').$aid.".".$ext;
				$file = $this->aws->putObject($awsPath,$data['afile']['tmp_name']);
				//debug($file['url']);
				//return;
				if($file['status']=='200'){


					$this->loadModel('FfiecAssessmentDomainRequirements');
					$acReq = $this->FfiecAssessmentDomainRequirements->findById($aid)->first();
					$acReq->artifact = $file['url'];
					//print_r($acReq);
					if($this->FfiecAssessmentDomainRequirements->save($acReq)){
						echo $file['url'];
					} else {
						echo 0;
					}

				} else {
					echo 0;
				}

			} else {
				echo 3; //only pdf files are supported
			}

		} else {
			echo 4;
		}

	}

	public function uploadArtifactForEgrc(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->request->allowMethod(['post']);
		$data = $this->request->getData();
		$aid = $data['id'];

		if(!empty($data['afile']['name'])){
			$ext = explode('.',$data['afile']['name']);
			$ext = end($ext);
			if($ext=='pdf' || $ext=='PDF'){
				$awsPath = 'artifacts/artifact-'.str_replace(' ','_',microtime()).$this->Auth->user('id').$aid.".".$ext;
				$file = $this->aws->putObject($awsPath,$data['afile']['tmp_name']);
				//debug($file['url']);
				//return;
				if($file['status']=='200'){


					$this->loadModel('EgrcAssessmentPolicyStatements');
					$acReq = $this->EgrcAssessmentPolicyStatements->findById($aid)->first();
					$acReq->artifact = $file['url'];
					//print_r($acReq);
					if($this->EgrcAssessmentPolicyStatements->save($acReq)){
						echo $file['url'];
					} else {
						echo 0;
					}

				} else {
					echo 0;
				}

			} else {
				echo 3; //only pdf files are supported
			}

		} else {
			echo 4;
		}

	}

	public function uploadArtifactForCmmc(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		$this->request->allowMethod(['post']);
		$data = $this->request->getData();
		$aid = $data['id'];

		if(!empty($data['afile']['name'])){
			$ext = explode('.',$data['afile']['name']);
			$ext = end($ext);
			if($ext=='pdf' || $ext=='PDF'){
				$awsPath = 'artifacts/ccmc_artifact-'.str_replace(' ','_',microtime()).$this->Auth->user('id').$aid.".".$ext;
				$file = $this->aws->putObject($awsPath,$data['afile']['tmp_name']);
				//debug($file['url']);
				//return;
				if($file['status']=='200'){


					$this->loadModel('CmmcAssessmentPractices');
					$acReq = $this->CmmcAssessmentPractices->findById($aid)->first();
					$acReq->artifact = $file['url'];
					//print_r($acReq);
					if($this->CmmcAssessmentPractices->save($acReq)){
						echo $file['url'];
					} else {
						echo 0;
					}

				} else {
					echo 0;
				}

			} else {
				echo 3; //only pdf files are supported
			}

		} else {
			echo 4;
		}

	}

	public function isCompanyAssessment($aid){
		$assessment = $this->Assessments->findByIdAndAtype($aid,'Self')
			->matching('Users', function ($q) {
			    return $q->where(['Users.company_id' => $this->Auth->user('id')]);
		})->all();

		if(count($assessment)>0){
			return true;
		} else {
			return false;
		}
	}

	public function isEmployeeAssessment($aid){
		$assessment = $this->Assessments->findByIdAndAtype($aid,'Self')
			->matching('Users', function ($q) {
			    return $q->where(['Users.id' => $this->Auth->user('id')]);
		})->all();

		if(count($assessment)>0){
			return true;
		} else {
			return false;
		}
	}

	//for using in this class only
	public function generateResidualData($id,$inherentScale,$rScore){
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

		$inherentScore = $scales[$inherentScale]['max'];
		$variant = $inherentScore-$rScore;

		foreach($scales as $scale){
			if($variant>=$scale['max']){
				$rScale = $scale['result'];
				break;
			} if($variant<0){
				$rScale = "Minor";
				break;
			} else if($variant<1 && $variant>=0) {
				$rScale = 'Minor';
				break;
			}
		}

		return ['variant'=>$variant,'scale'=>$rScale];

	}

	public function saveInstantFactor(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		if($this->request->is('post')){
			$flag = 0;
			$posted = $this->request->getData();
			$this->loadModel('FfiecAssessmentRiskFactors');

			$rfd = $this->FfiecAssessmentRiskFactors->get($posted['id']);
			$scaleScore = explode('~',$posted['value']);

			$rFactor = [
				'score'=>$scaleScore[0],
				'scale'=>$scaleScore[1]
			];
			$rFactor = $this->FfiecAssessmentRiskFactors->patchEntity($rfd,$rFactor);

			if($this->FfiecAssessmentRiskFactors->save($rFactor)){
				//checking if All Risk Factors updated
				$allRiskFactors = $this->FfiecAssessmentRiskFactors->find('all',[
					'conditions'=>[
						'or'=>[
							"FfiecAssessmentRiskFactors.score =''",
							"FfiecAssessmentRiskFactors.score is null"
						],
						'and'=>[
							'FfiecAssessmentRiskFactors.frisk_id'=>$rfd->frisk_id
						]

					]
				])->count();


				$this->loadModel('FfiecAssessmentRisks');
				$fRisk = $this->FfiecAssessmentRisks->get($rfd->frisk_id);
				if($allRiskFactors==0){
					$iScore = $this->FfiecAssessmentRiskFactors->find();
					$iScore = $iScore->select(['avgScore'=>$iScore->func()->avg('score')])
									->where(['frisk_id'=>$rfd->frisk_id])
									->first();
					$iScore = round($iScore->avgScore,2);

					$iScale = $this->getRiskScaleByScore($iScore);



					$fRiskData = [
						'inherent_score'=>$iScore,
						'inherent_scale'=>$iScale
					];

					$fRisk =  $this->FfiecAssessmentRisks->patchEntity($fRisk,$fRiskData);
					if($this->FfiecAssessmentRisks->save($fRisk)){
						$flag = "2~".$iScale;
					} else {
						$flag = 3;
					}


				} else {
					$flag = 1;
				}


			}
			echo $flag;
		}
	}

	public function getRiskScaleByScore($score){
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
		$scale = null;
		foreach($scales as $scale){
			if($score>=$scale['max']){
				$scale = $scale['result'];
				break;
			} else if($score<0){
				$scale = "Minor";
				break;
			} else if($score<1 && $score>=0) {
				$scale = 'Minor';
				break;
			}
		}
		return $scale;
	}

	public function getRiskScaleByScore2($score){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);
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
		$scale = null;
		foreach($scales as $scale){
			if($score>=$scale['max']){
				$scale = $scale['result'];
				break;
			} else if($score<0){
				$scale = "Minor";
				break;
			} else if($score<1 && $score>=0) {
				$scale = 'Minor';
				break;
			}
		}
		echo $scale;
	}

	public function saveInstantUpdate(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		if($this->request->is('post')){
			$posted = $this->request->getData();
			if($posted['table']=="assessment_risks"){

				$this->loadModel('AssessmentRisks');
				$assessmentRisk = $this->AssessmentRisks->get($posted['id'],[
					'contain'=>[
						'Assessments','AssessmentsRegulatoryBodies.Assessments'
					]
				]);
				$assessmentRisk->inherent_scale = $posted['value'];

				//checking assessment status
				$aStatus = ($assessmentRisk->assessment==null)?$assessmentRisk->assessments_regulatory_body->assessment->status:$assessmentRisk->assessment->status;

				if($aStatus=='Review or Draft'){
					//for auto updating residual risk scale if
					//assessment status is "Review or Draft"
					$residual = $this->generateResidualData($posted['id'],$posted['value'],$assessmentRisk->residual_score);
					$assessmentRisk->inherent_variant = $residual['variant'];
					$assessmentRisk->residual_scale = $residual['scale'];
				}




				if($this->AssessmentRisks->save($assessmentRisk)){
					if($aStatus=='Review or Draft'){
						echo "1~".$assessmentRisk->residual_scale;
					} else {
						echo 1;
					}

				} else {
					echo 0;
				}

			} else if($posted['table']=="assessment_control_requirements"){
				$this->loadModel('AssessmentControlRequirements');
				$assessmentRisk = $this->AssessmentControlRequirements->get($posted['id']);
				$assessmentRisk->reference = $posted['value'];

				if($this->AssessmentControlRequirements->save($assessmentRisk)){
					echo 1;
				} else {
					echo 0;
				}
			} else if($posted['table']=="ffiec_assessment_domain_requirements"){
				$this->loadModel('FfiecAssessmentDomainRequirements');
				$assessmentRisk = $this->FfiecAssessmentDomainRequirements->get($posted['id']);
				$assessmentRisk->reference = $posted['value'];

				if($this->FfiecAssessmentDomainRequirements->save($assessmentRisk)){
					echo 1;
				} else {
					echo 0;
				}
			} else if($posted['table']=="egrc_assessment_risks"){

				$this->loadModel('EgrcAssessmentRisks');
				$assessmentRisk = $this->EgrcAssessmentRisks->get($posted['id'],[
					'contain'=>[
						'Assessments'
					]
				]);
				$assessmentRisk->inherent_scale = $posted['value'];

				//checking assessment status
				$aStatus = $assessmentRisk->assessment->status;

				if($aStatus=='Review or Draft'){
					//for auto updating residual risk scale if
					//assessment status is "Review or Draft"
					$residual = $this->generateResidualData($posted['id'],$posted['value'],$assessmentRisk->residual_score);
					$assessmentRisk->inherent_variant = $residual['variant'];
					$assessmentRisk->residual_scale = $residual['scale'];
				}




				if($this->EgrcAssessmentRisks->save($assessmentRisk)){
					if($aStatus=='Review or Draft'){
						echo "1~".$assessmentRisk->residual_scale;
					} else {
						echo 1;
					}

				} else {
					echo 0;
				}

			} else if($posted['table']=="egrc_assessment_policy_statements"){
				$this->loadModel('EgrcAssessmentPolicyStatements');
				$assessmentRisk = $this->EgrcAssessmentPolicyStatements->get($posted['id']);
				$assessmentRisk->reference = $posted['value'];

				if($this->EgrcAssessmentPolicyStatements->save($assessmentRisk)){
					echo 1;
				} else {
					echo 0;
				}
			} else if($posted['table']=="ccmc_assessment_practices"){
				$this->loadModel('CmmcAssessmentPractices');
				$practice = $this->CmmcAssessmentPractices->get($posted['id']);
				$practice->reference = $posted['value'];

				if($this->CmmcAssessmentPractices->save($practice)){
					echo 1;
				} else {
					echo 0;
				}
			}

		}
	}


	public function updateFfiecControlFactor(){

		$this->viewBuilder()->setLayout(false);

		if($this->request->is('post')){
			$posted = $this->request->getData();
			$mlevel = $posted['mlevel'];
			$control_id = $posted['controlId'];



			try{

				$this->loadModel('FfiecAssessmentDomainAFactors');
				$delStatus = $this->FfiecAssessmentDomainAFactors->deleteAll([
					'ffiec_domain_id'=>$control_id
				]);

				$this->loadModel('FfiecAssessmentDomains');
				$fadomain = $this->FfiecAssessmentDomains->get($control_id);



				$this->loadModel('FfiecDomainAssessmentFactors');

				$maturityLevel = $mlevel;
				$fdom = $this->FfiecDomainAssessmentFactors->find('all',[
					'conditions'=>[
						'ffiec_domain_id'=>$fadomain->ffiec_domain_id
					],
					'contain'=>[
						'FfiecDomainRequirements'=>function(Query $q) use ($maturityLevel){
							//global $maturityLevel;
							return $q->where(['FfiecDomainRequirements.maturity_level'=>$maturityLevel]);
						}
					]
				]);





				$fdafactors = [];
				foreach($fdom as $kf=>$fdaf){
					$fdafactors[$kf]=[
						'name'=>$fdaf->name
					];
					//debug($fdaf);
					foreach($fdaf->ffiec_domain_requirements as $fadar){
						$fdafactors[$kf]['ffiec_assessment_domain_requirements'][]=[
							'component'=>$fadar->component,
							'maturity_level'=>$fadar->maturity_level,
							'name'=>$fadar->name
						];
					}

				}

				//$fadomain->m_level = $maturityLevel;
				//$fadomain->ffiec_assessment_domain_a_factors = $fdafactors;

				$finalDomain = [
					'id'=>$fadomain->id,
					'm_level'=>$maturityLevel,
					'ffiec_assessment_domain_a_factors'=>$fdafactors
				];


				$updatedControl = $this->FfiecAssessmentDomains->patchEntity($fadomain,$finalDomain,[
					'associated'=> ['FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements']
				]);

				if($this->FfiecAssessmentDomains->save($updatedControl)){
					$fdomain = $this->FfiecAssessmentDomains->get($control_id,[
						'contain'=> ['FfiecAssessmentDomainAFactors.FfiecAssessmentDomainRequirements']
					]);
					$this->set(compact('fdomain'));
				} else {
					echo 0;
				}


			} catch (Exception $e){

				$this->autoRender = false;

				echo 0;
			}


		} else {
			$this->autoRender = false;

			echo 0;
		}
	}


	/*
	public function saveInstantUpdate(){
		$this->autoRender = false;
		$this->viewBuilder()->setLayout(false);

		if($this->request->is('post')){
			$posted = $this->request->getData();
			if($posted['table']=="assessment_risks"){
				$this->loadModel('AssessmentRisks');
				$assessmentRisk = $this->AssessmentRisks->get($posted['id']);
				$assessmentRisk->inherent_scale = $posted['value'];

				if($this->AssessmentRisks->save($assessmentRisk)){
					echo 1;
				} else {
					echo 0;
				}
			} else if($posted['table']=="assessment_control_requirements"){
				$this->loadModel('AssessmentControlRequirements');
				$assessmentRisk = $this->AssessmentControlRequirements->get($posted['id']);
				$assessmentRisk->reference = $posted['value'];

				if($this->AssessmentControlRequirements->save($assessmentRisk)){
					echo 1;
				} else {
					echo 0;
				}
			}

		}



	}
	*/








    /**
     * Delete method
     *
     * @param string|null $id Assessment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assessment = $this->Assessments->get($id);
        if ($this->Assessments->delete($assessment)) {
            $this->Flash->success(__('The assessment has been deleted.'));
        } else {
            $this->Flash->error(__('The assessment could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
