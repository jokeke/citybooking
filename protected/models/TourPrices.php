<?php

/**
 * This is the model class for table "tour_prices".
 *
 * The followings are the available columns in table 'tour_prices':
 * @property integer $id
 * @property integer $tour_id
 * @property integer $type
 * @property integer $min
 * @property integer $max
 * @property integer $men
 * @property integer $kid
 * @property integer $stud
 * @property integer $old
 * @property integer $foreigner
 * @property integer $active
 * @property integer $position
 * @property integer $created
 * @property integer $updated
 *
 * The followings are the available model relations:
 * @property Tours $tour
 */
class TourPrices extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TourPrices the static model class
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
		return 'tour_prices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tour_id, type, min, max, men, kid, stud, old, foreigner, to, active, position, created, updated', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tour_id, type, min, max, men, kid, stud, old, foreigner, active, position, created, updated', 'safe', 'on'=>'search'),
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
			'tour' => array(self::BELONGS_TO, 'Tours', 'tour_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tour_id' => 'Tour',
			'type' => 'Type',
			'min' => 'Min',
			'max' => 'Max',
			'men' => 'Men',
			'kid' => 'Kid',
			'stud' => 'Stud',
			'old' => 'Old',
			'foreigner' => 'Foreigner',
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
		$criteria->compare('tour_id',$this->tour_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('min',$this->min);
		$criteria->compare('max',$this->max);
		$criteria->compare('men',$this->men);
		$criteria->compare('kid',$this->kid);
		$criteria->compare('stud',$this->stud);
		$criteria->compare('old',$this->old);
		$criteria->compare('foreigner',$this->foreigner);
		$criteria->compare('active',$this->active);
		$criteria->compare('position',$this->position);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function afterFind()
    {
        $this->to = date("d.m.Y",$this->to);

        return parent::afterFind();
    }
}