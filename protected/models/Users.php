<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $firstname
 * @property string $surname
 * @property string $familyname
 * @property integer $phone
 * @property string $email
 * @property string $password
 * @property integer $role
 * @property integer $regdata
 * @property integer $lastdata
 * @property string $note
 * @property string $city
 *
 * The followings are the available model relations:
 * @property Favorites[] $favorites
 * @property HotelBooking[] $hotelBookings
 * @property TourBooking[] $tourBookings
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phone, role, regdata, lastdata', 'numerical', 'integerOnly'=>true),
			array('firstname, surname, familyname', 'length', 'max'=>50),
			array('email', 'length', 'max'=>128),
			array('password, city', 'length', 'max'=>255),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstname, surname, familyname, phone, email, password, role, regdata, lastdata, note, city', 'safe', 'on'=>'search'),
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
			'favorites' => array(self::HAS_MANY, 'Favorites', 'user_id'),
			'hotelBookings' => array(self::HAS_MANY, 'HotelBooking', 'user_id'),
			'tourBookings' => array(self::HAS_MANY, 'TourBooking', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstname' => 'Firstname',
			'surname' => 'Surname',
			'familyname' => 'Familyname',
			'phone' => 'Phone',
			'email' => 'Email',
			'password' => 'Password',
			'role' => 'Role',
			'regdata' => 'Regdata',
			'lastdata' => 'Lastdata',
			'note' => 'Note',
			'city' => 'City',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('regdata',$this->regdata);
		$criteria->compare('lastdata',$this->lastdata);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('city',$this->city,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function validatePassword($password)
    {
        return crypt($password,$this->password)===$this->password;
    }

    public function hashPassword($password)
    {
        return crypt($password);
    }
}