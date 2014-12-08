<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChatsController
 *
 * @author Anik
 */
class ChatsController extends AppController{
    
    public $layout = 'dashboard';


    public function beforeFilter() {
        parent::beforeFilter();
	
	$this->Auth->allow();
    }
    
    public function index(){
        $this->loadModel('User');
	$user_id = $this->Auth->user('id');
	
	$this->set("user_id", $user_id);
    }
    
    /**
     * Function to return all users details when joining the room
     */
    public function getUserDetails(){
        $this->autoRender = false;
   
        $users = array();
        
        $user_ids = $this->request->query('uuids');
        
        if(!empty($user_ids)){
            $this->loadModel('User');
            
            $users = $this->User->find('all', array(
                    'conditions' => array(
                        'User.id' => $user_ids
                    ),
                    'fields' => array(
                        'User.id', 'User.name', 'User.username'
                    )
                )
            );
        }
        
        if(!empty($users)){
            $res = array('message' => 'Users found', 'data' => $users);
        }else{
            $res = array('message' => 'No users found');
        }
        
        echo json_encode($res);
    }
}

?>
