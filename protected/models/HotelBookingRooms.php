<?php

/**
 * This is the model class for table "hotel_booking_rooms".
 *
 * The followings are the available columns in table 'hotel_booking_rooms':
 * @property integer $id
 * @property integer $booking_id
 * @property integer $room_id
 * @property integer $man
 * @property integer $kid
 * @property integer $date_checkin
 * @property integer $date_checkout
 * @property string $time_checkin
 * @property string $time_checkout
 * @property string $bed
 * @property integer $smoke
 * @property string $pay_type
 * @property integer $price
 * @property string $guest
 * @property integer $created
 * @property integer $updated
 *
 * The followings are the available model relations:
 * @property HotelBooking $booking
 */
class HotelBookingRooms extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HotelBookingRooms the static model class
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
		return 'hotel_booking_rooms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('booking_id, room_id, man, kid, date_checkin, date_checkout, smoke, price, created, updated', 'numerical', 'integerOnly'=>true),
			array('time_checkin, time_checkout', 'length', 'max'=>50),
			array('bed, pay_type', 'length', 'max'=>255),
			array('guest', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, booking_id, room_id, man, kid, date_checkin, date_checkout, time_checkin, time_checkout, bed, smoke, pay_type, price, guest, created, updated', 'safe', 'on'=>'search'),
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
			'booking' => array(self::BELONGS_TO, 'HotelBooking', 'booking_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'booking_id' => 'Booking',
			'room_id' => 'Room',
			'man' => 'Man',
			'kid' => 'Kid',
			'date_checkin' => 'Date Checkin',
			'date_checkout' => 'Date Checkout',
			'time_checkin' => 'Time Checkin',
			'time_checkout' => 'Time Checkout',
			'bed' => 'Bed',
			'smoke' => 'Smoke',
			'pay_type' => 'Pay Type',
			'price' => 'Price',
			'guest' => 'Guest',
			'created' => 'Created',
			'updated' => 'Updated',
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
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('room_id',$this->room_id);
		$criteria->compare('man',$this->man);
		$criteria->compare('kid',$this->kid);
		$criteria->compare('date_checkin',$this->date_checkin);
		$criteria->compare('date_checkout',$this->date_checkout);
		$criteria->compare('time_checkin',$this->time_checkin,true);
		$criteria->compare('time_checkout',$this->time_checkout,true);
		$criteria->compare('bed',$this->bed,true);
		$criteria->compare('smoke',$this->smoke);
		$criteria->compare('pay_type',$this->pay_type,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('guest',$this->guest,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}