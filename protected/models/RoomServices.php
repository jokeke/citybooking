<?php

/**
 * This is the model class for table "room_services".
 *
 * The followings are the available columns in table 'room_services':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $room_id
 * @property integer $free
 * @property integer $price
 * @property integer $active
 * @property integer $position
 * @property integer $created
 * @property integer $updated
 */
class RoomServices extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RoomServices the static model class
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
		return 'room_services';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position', 'required'),
			array('room_id, free, price, active, position, created, updated', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, room_id, free, price, active, position, created, updated', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'room_id' => 'Room',
			'free' => 'Free',
			'price' => 'Price',
			'active' => 'Active',
			'position' => 'Position',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('room_id',$this->room_id);
		$criteria->compare('free',$this->free);
		$criteria->compare('price',$this->price);
		$criteria->compare('active',$this->active);
		$criteria->compare('position',$this->position);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function beforeValidate()
    {
        if($this->getIsNewRecord())
        {

            $lastId = $this::model()->find(array('order'=>'id DESC'));
            $this->position = $lastId->id + 1;
        }
        return parent::beforeValidate();
    }
}