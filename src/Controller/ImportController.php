<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Query;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;

class ImportController extends AppController
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

		$this->Security->setConfig('unlockedActions', ['import']);
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


	public function import()
	{
		$connection = ConnectionManager::get('default');
		$this->loadModel('Companies');
		$this->loadModel('EgrcRemediationsCopy');

	    // Check if a file was uploaded
	    $file = $this->request->getData('import_file');

        // Check if a file was uploaded
	    if (!empty($file['tmp_name']))
	    {
			$allowedExtensions = ['xls', 'xlsx'];
			$allowedMimeTypes = [
				'application/vnd.ms-excel',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			];

			$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			$fileMimeType = mime_content_type($file['tmp_name']);

			if (!in_array($fileExtension, $allowedExtensions) || !in_array($fileMimeType, $allowedMimeTypes)) {
				$response = ['status' => 0 , 'message' => 'Invalid file format. Only Excel files are allowed.'];
				return $this->response->withType('application/json')->withStringBody(json_encode($response));
			}

			$reader = PHPExcel_IOFactory::createReaderForFile($file['tmp_name']);
			$reader->setReadDataOnly(true);
			$spreadsheet = $reader->load($file['tmp_name']);
			$worksheet = $spreadsheet->getActiveSheet();
			$rows = $worksheet->toArray();

			array_shift($rows);

			// Process each row
			foreach ($rows as $row)
			{
				// Assuming your database table has fields 'field1' and 'field2'

				$rowData = [
					'company_id' => $this->companyId,
					'issue_id' => $row[0],
					'affected_policy' => $row[1],
					'summary' => $row[2],
					'detailed_description' => $row[3],
					'risk_ranking' => $row[4],
					'remediation_plan' => $row[5],
					'compensating_controls' => $row[6],
					'owner_name' => $row[7],
					'owner_department' => $row[8],
					'entity_name' => $row[9],
					'remediation_date' => $this->convertExcelDate($row[10]),
					'status' => $row[11],
				];

				// Save the data to the database
				$entity = $this->EgrcRemediationsCopy->newEntity($rowData);
				$this->EgrcRemediationsCopy->save($entity);
			}

			$this->Flash->success('Data imported successfully.');
			$response = ['status' => 1 , 'message' => 'File uploaded and data saved successfully.'];
			return $this->response->withType('application/json')->withStringBody(json_encode($response));
		}
		else
		{
			$response = ['status' => 0 , 'message' => 'Invalid file format. Only Excel files are allowed.'];
			return $this->response->withType('application/json')->withStringBody(json_encode($response));
		}
	}

	private function convertExcelDate($excelDate)
	{
		// Convert Excel date to Unix timestamp
		$timestamp = PHPExcel_Shared_Date::ExcelToPHP($excelDate);
		// Format the date as desired (e.g., 'Y-m-d')
		return date('Y-m-d', $timestamp);
	}

}
