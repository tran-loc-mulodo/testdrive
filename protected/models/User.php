<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $url
 * @property string $lastname
 * @property string $firstname
 * @property string $profile
 * @property integer $status
 * @property string $last_login_time
 * @property string $created_date
 * @property string $modified_date
 * @property integer $role_id
 * @property string  $salt
 *
 * The followings are the available model relations:
 * @property TblRole $role
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}
        
        protected function beforeSave() {
            if(parent::beforeSave())
            {
                $this->password = $this->hashPassword($this->password, $this->salt);
                if($this->isNewRecord)
                {
                    $this->created_date = new CDbExpression("Now()");
                }else  $this->modified_date = new CDbExpression('Now()');
                return true;
            }else
                return false;
        }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, lastname, firstname, status, role_id', 'required'),
			array('status, role_id', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>128),
			array('url, lastname, firstname', 'length', 'max'=>255),
			array('profile', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, lastname, firstname, profile, status, role_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'role' => array(self::BELONGS_TO, 'TblRole', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'url' => 'Url',
			'lastname' => 'Lastname',
			'firstname' => 'Firstname',
			'profile' => 'Profile',
			'status' => 'Status',
			'last_login_time' => 'Last Login Time',
			'created_date' => 'Create Date',
                        'modified_date' => 'Modified Date',
			'role_id' => 'Role',
                        'salt'  => 'Salt',
		);
	}
        public function getRoleOptions()
        {
            $roles = Role::model()->findAll();
            $data = array(null => "Select Parent Role");
            foreach ($roles as $model)
            {
                $data[$model->id] = $model->name;
            }
            return $data;
        }
        
        //hash password
        public function hashPassword($password , $salt) {
            return md5($salt.$password);
        }

        //password validation 
        public function validatePassword($password) {
            return $this->hashPassword($password, $this->salt) === $this->password;    
        }
        
        //generate salt
        public function generateSalt() {
            return uniqid('' , true);
        }
        
        public function beforeValidate() {
            $this->salt = $this->generateSalt();
            return parent::beforeValidate();
        }
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
