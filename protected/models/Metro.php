<?php

/**
 * This is the model class for table "metro".
 *
 * The followings are the available columns in table 'metro':
 * @property integer $id
 * @property string $name
 * @property string $line
 * @property integer $active
 * @property integer $created
 * @property integer $updated
 */
class Metro extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Metro the static model class
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
		return 'metro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, created, updated', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('line', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, line, active, created, updated', 'safe', 'on'=>'search'),
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
			'line' => 'Line',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('line',$this->line,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getAllName()
    {
        $sql = "SELECT metro.name FROM metro";
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $data=$command->queryAll();
        return $data;
    }

    public function getMetroNameById($id)
    {
        $sql = "SELECT metro.name FROM metro WHERE metro.id = :id";
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $command->bindParam(':id', $id, PDO::PARAM_INT);
        $data=$command->queryRow();
        return $data['name'];
    }
}