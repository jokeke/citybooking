<?php

/**
 * This is the model class for table "hotel_booking".
 *
 * The followings are the available columns in table 'hotel_booking':
 * @property integer $id
 * @property integer $user_id
 * @property integer $hotel_id
 * @property string $surname
 * @property string $firstname
 * @property string $contact_name
 * @property integer $phone
 * @property string $email
 * @property string $wishes
 * @property string $services
 * @property integer $price
 * @property integer $created
 * @property integer $updated
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property HotelBookingRooms[] $hotelBookingRooms
 */
class HotelBooking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HotelBooking the static model class
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
		return 'hotel_booking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, hotel_id, phone, price, created, updated, active', 'numerical', 'integerOnly'=>true),
			array('surname, firstname, email', 'length', 'max'=>50),
			array('contact_name', 'length', 'max'=>255),
			array('wishes, services', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, hotel_id, surname, firstname, contact_name, phone, email, wishes, services, price, created, updated, active', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'updated',
            ),
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
			'hotelBookingRooms' => array(self::HAS_MANY, 'HotelBookingRooms', 'booking_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'hotel_id' => 'Hotel',
			'surname' => 'Surname',
			'firstname' => 'Firstname',
			'contact_name' => 'Contact Name',
			'phone' => 'Phone',
			'email' => 'Email',
			'wishes' => 'Wishes',
			'services' => 'Services',
			'price' => 'Price',
			'created' => 'Created',
			'updated' => 'Updated',
			'active' => 'Active',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('hotel_id',$this->hotel_id);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('wishes',$this->wishes,true);
		$criteria->compare('services',$this->services,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}