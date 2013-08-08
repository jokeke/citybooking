<?php

/**
 * This is the model class for table "conference_types".
 *
 * The followings are the available columns in table 'conference_types':
 * @property integer $id
 * @property integer $conference_id
 * @property string $type_name
 * @property integer $max_humans
 * @property integer $active
 * @property integer $created
 * @property integer $updated
 *
 * The followings are the available model relations:
 * @property Conference[] $conferences
 */
class ConferenceTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConferenceTypes the static model class
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
		return 'conference_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('conference_id, max_humans, active, created, updated', 'numerical', 'integerOnly'=>true),
			array('type_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, conference_id, type_name, max_humans, active, created, updated', 'safe', 'on'=>'search'),
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
			'conferences' => array(self::HAS_MANY, 'Conference', 'type'),
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
			'type_name' => 'Type Name',
			'max_humans' => 'Max Humans',
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
		$criteria->compare('type_name',$this->type_name,true);
		$criteria->compare('max_humans',$this->max_humans);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTypesByConferenceId($id)
    {
        $sql = "SELECT conference_types.type_name as name, conference_types.max_humans as humans FROM conference_types WHERE conference_types.active = 1 AND conference_types.conference_id = :id";
        $command = Yii::app()->db->cache(84600)->createCommand($sql);
        $command->bindParam(':id', $id, PDO::PARAM_INT);
        $data=$command->queryAll();

        return $data;
    }
}