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

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

	public function initialize(){
		parent::initialize();
		$this->Security->setConfig('unlockedActions', ['home','getActivityRegulations']);
		$this->Auth->allow(['capabilities','cmmclanding','ircw','getActivityRegulations', 'aboutfounder']);
	}

	//website home page (landing page)
	public function home(){
		$this->viewBuilder()->setLayout('website');
	}

	public function ircw(){

		$this->loadModel('Activities');
		$this->viewBuilder()->setLayout('website');
		$activities = $this->Activities->find('all',[
			'order'=>['sort_order'=>'asc']
		])->all();
		$this->set(compact('activities'));
	}

	public function getActivityRegulations(){
		//die('s');
		//$this->request->allowMethod(['post', 'delete']);
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


	public function cisohome(){

		$this->viewBuilder()->setLayout('website');

		if($this->request->is(['post'])){


			/*google recaptcha code
			 * */
			$posted = $this->request->getData();
			$url = 'https://www.google.com/recaptcha/api/siteverify';
			$data = array(
				'secret' => '6LdkmBslAAAAAKMoNAdXdhet9c4PqRbNEJc3D-i0',
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

			/*
			 * recaptcha ends
			 */
			if($captcha_success==false){
				$this->Flash->error(__('Sorry! Captcha not verified. Try again.'));
			} else {
				$email = new Email('Sendgrid');
				$email->setFrom(['info@thecloudciso.com' => 'THE CLOUD CISO'])
				    ->setTo('info@thecloudciso.com')
				    ->setSubject("Contact Us Submission - THE CLOUD CISO ".date('Ymd His',time()))
				    ->setViewVars($posted)
					->setEmailFormat('html');
				$email->viewBuilder()->setTemplate('contactus')
					->setLayout('cisolayout');
					//->template('contactus','cisolayout'); //first param is email template file, second one is layout
			    $resp = $email->send();
				//debug($resp);
				if($resp['message']=='success'){
					$this->Flash->success("Thanks for you submission. we will get back to you soon.");
				} else {
					$this->Flash->error("Sorry! Not successful, try again.");
				}
			}
		}

	}

	public function capabilities(){
		$this->viewBuilder()->setLayout('website');
	}

	public function cmmclanding(){
		$this->viewBuilder()->setLayout('cmmc');
	}
	public function aboutfounder(){
		$this->viewBuilder()->setLayout('website');
	}



	/*
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

	*/
}
