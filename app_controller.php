<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	public $components = array(
		'RequestHandler',
        'Session',
		'Acl',
		'Access',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'view'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => '/'
            ),
			'authorize '=>'controller',
			'admin' => true,
			
        ), 
		'Rest.Rest' => array(
			'catchredir' => true,
			'debug' => 1,
			'index' => array(
				'extract' => array('data'),
			),
			'view' => array(
				'extract' => array('data'),
			),
			'version'=>'1.0.0'
		),
    );
	
	
	function beforeFilter() {
		App::Import('Model', 'SystemDefault');
		$this->SystemDefault = new SystemDefault;
		$systemDefault = $this->SystemDefault->find('first');
		
		$this->Session->write('SystemDefault',null);
		$this->Session->write('SystemDefault',$systemDefault);
		$systemDefault = $this->Session->read('SystemDefault');
		$this->set('SystemDefault',$this->Session->read('SystemDefault'));
		$this->set('SystemDefault',$systemDefault['SystemDefault']);
		
		if ($this->params['controller'] == 'pages') {
			$this->Auth->allow('*'); 
			return;
		}
	}
	
	
}
