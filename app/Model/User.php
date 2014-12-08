<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP User
 * @author Atul Tagra <atul.tagra.89@gmail.com>
 */
class User extends AppModel {
    public function beforeSave($options = array()) {
	$this->data['User']['password'] = AuthComponent::password(
	  $this->data['User']['password']
	);
	$this->data['User']['is_active'] = 1;
	return true;
    }
}
