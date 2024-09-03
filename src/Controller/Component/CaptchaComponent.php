<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class CaptchaComponent extends Component
{
	public $controller = null;
    public $session = null;
	
	public function initialize(array $config){
        parent::initialize($config);
       
        $this->controller = $this->_registry->getController();

        $this->session = $this->controller->request->getSession();

        // You can then use $this->session in any other methods        
        // If debug = true else use print_r() to test
        //debug($this->session->read('Auth.User.id')); 
    }
	
    public function generateCaptcha(){
        $string = str_shuffle('abcdefghijklmnopqrstuvwxABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
		$n1 = rand(1,20);
		$n2 = rand(20,40);
		
		$equation = $n1." + ".$n2;
		$result = $n1+$n2;
		
		$this->session->write('captcha.equation',$equation);
		$this->session->write('captcha.result',$result);
		
    }
	
	public function validate($input){
		$status = 'invalid';
		if($this->session->read('captcha.result')==$input){
			$status = 'valid';
		}
		return $status;
	}
	
}