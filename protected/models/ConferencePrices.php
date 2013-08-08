<?php

/**
 * This is the model class for table "conference_prices".
 *
 * The followings are the available columns in table 'conference_prices':
 * @property integer $id
 * @property integer $conference_id
 * @property integer $price
 * @property integer $hours
 * @property integer $active
 * @property integer $created
 * @property integer $updated
 *
 * The followings are the available model relations:
 * @property Conference $conference
 */
class ConferencePrices extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConferencePrices the static model class
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
		return 'conference_prices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('conference_id, price, hours, active, created, updated', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, conference_id, price, hours, active, created, updated', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors(){
        return array(
            // наше поведение для работы с изображением
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
			'conference' => array(self::BELONGS_TO, 'Conference', 'conference_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'conference_id' => 'Conference',
			'price' => 'Price',
			'hours' => 'Hours',
			'active' => 'Active',
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
		$criteria->compare('conference_id',$this->conference_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('hours',$this->hours);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getPricesByConferenceId($id)
    {
        $sql = "SELECT conference_prices.price, conference_prices.hours FROM conference_prices WHERE conference_prices.active = 1 AND conference_prices.conference_id = 1";
        $command = Yii::app()->db->cache(84600)->createCommand($sql);
        $command->bindParam(':id', $id, PDO::PARAM_INT);
        $data=$command->queryAll();

        return $data;
    }
}