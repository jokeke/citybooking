<?php

/**
 * This is the model class for table "review".
 *
 * The followings are the available columns in table 'review':
 * @property integer $id
 * @property integer $hotel_id
 * @property string $name
 * @property integer $from
 * @property integer $to
 * @property string $email
 * @property string $booking_number
 * @property string $review
 * @property integer $service
 * @property integer $clear
 * @property integer $price_quality
 * @property integer $location
 * @property integer $breakfast
 * @property double $total
 * @property integer $active
 * @property integer $created
 */
class Review extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Review the static model class
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
		return 'review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hotel_id, from, to, service, clear, price_quality, location, breakfast, active, created', 'numerical', 'integerOnly'=>true),
			array('total', 'numerical'),
			array('name, booking_number', 'length', 'max'=>255),
			array('email', 'length', 'max'=>50),
			array('review', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hotel_id, name, from, to, email, booking_number, review, service, clear, price_quality, location, breakfast, total, active, created', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hotel_id' => 'Hotel',
			'name' => 'Name',
			'from' => 'From',
			'to' => 'To',
			'email' => 'Email',
			'booking_number' => 'Booking Number',
			'review' => 'Review',
			'service' => 'Service',
			'clear' => 'Clear',
			'price_quality' => 'Price Quality',
			'location' => 'Location',
			'breakfast' => 'Breakfast',
			'total' => 'Total',
			'active' => 'Active',
			'created' => 'Created',
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
		$criteria->compare('hotel_id',$this->hotel_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('from',$this->from);
		$criteria->compare('to',$this->to);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('booking_number',$this->booking_number,true);
		$criteria->compare('review',$this->review,true);
		$criteria->compare('service',$this->service);
		$criteria->compare('clear',$this->clear);
		$criteria->compare('price_quality',$this->price_quality);
		$criteria->compare('location',$this->location);
		$criteria->compare('breakfast',$this->breakfast);
		$criteria->compare('total',$this->total);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getReviewByHotelId($id)
    {
        $sql = "SELECT review.* FROM review WHERE review.active = 1 AND review.hotel_id = :id ORDER BY review.created DESC";
        $command = Yii::app()->db->cache(84600)->createCommand($sql);
        $command->bindParam(':id',$id, PDO::PARAM_INT);
        $data=$command->queryAll();
        foreach ($data as &$row) {
            $row['from'] = date("d.m.Y",$row['from']);
            $row['to'] = date('d.m.Y', $row['to']);
        };

        return $data;
    }
}