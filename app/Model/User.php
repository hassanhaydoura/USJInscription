<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
            'Check Username'=>array(
            'rule'=>'checkUsername',
            'message'=>'Ce compte existe déjà, Veuillez choisir un autre'
        )),
    'password'=>array(
        'Not empty'=>array(
            'rule'=>'notEmpty',
            'message'=>'Please enter your password!'
        ),
        'Match password'=>array(
            'rule'=>'matchPasswords',
            'message'=>'Your passwords do not match!'
        )
    ),
    'passwordconfirm'=>array(
        'Not empty'=>array(
            'rule'=>'notEmpty',
            'message'=>'Please confirm your password!',
        )
    ),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Ce champ est obligatoire.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Ce champ est obligatoire.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'firstname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Ce champ est obligatoire.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lastname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Ce champ est obligatoire.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'photoid' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'activationcode' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'activated' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
			'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
 public $belongsTo = array('Group');
public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }
public function matchPasswords($data){
    if(!isset($data['password']) || !isset($this->data['User']['passwordconfirm']))
    		return true;
    if ($data['password'] == $this->data['User']['passwordconfirm']){
        return true;
    } else {
     $this->invalidate('passwordconfirm', 'Your passwords do not match!');
        return false;
    }
}


public function checkUsername($data){
    
      if($this->find('first',array('conditions'=>array('User.username'=>$data['username']))))
      {
   //  $this->invalidate('username', 'Ce compte existe déjà, Veuillez choisir un autre');
        return false;
      }
      else
      {
        return true;
      }
}

   public function bindNode($user) {
    return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
}
	
public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password']))
    {
        $passwordHasher = new SimplePasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
    }
   $this->data[$this->alias]['activationcode'] = md5(uniqid(rand(), true));

    return true;
}

}
