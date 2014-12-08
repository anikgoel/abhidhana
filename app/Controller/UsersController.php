<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UsersController
 * @author karan
 */
class UsersController extends AppController {
    
    public $layout = 'dashboard';
    
    public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('register', 'login', 'logout');
    }

    public function register() {
	if($this->request->is('post')){
	    $this->User->create();
	    if(!$this->User->save($this->request->data)){
		$this->Session->setFlash(__("Unable to register your account, please try again later!"));
	    } else {
		$this->Session->setFlash(__("Registered Successfully done!"));
		return $this->redirect(array('controller'=>'users', 'action'=>'login'));
	    }
	}
    }
    
    public function login() {
	if ($this->request->is('post')) {
	    if ($this->Auth->login()) {
		 return $this->redirect(array('controller'=>'chats'));
	    } else {
		$this->Session->setFlash(
		    __('Username or password is incorrect'),
		    'default',
		    array(),
		    'auth'
		);
	    }
	}
    }
    
    public function logout(){
	return $this->redirect($this->Auth->logout());
    }

}
