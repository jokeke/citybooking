<?php

/**
 * This is the model class for table "tour_timetable".
 *
 * The followings are the available columns in table 'tour_timetable':
 * @property integer $id
 * @property integer $tour_id
 * @property integer $from
 * @property integer $to
 * @property string $time
 * @property string $week
 * @property string $optiondata
 * @property integer $active
 */
class TourTimetable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TourTimetable the static model class
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
		return 'tour_timetable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tour_id, from, to, active', 'numerical', 'integerOnly'=>true),
			array('time, week, optiondata', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tour_id, from, to, time, week, optiondata, active', 'safe', 'on'=>'search'),
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
			'tour_id' => 'Tour',
			'from' => 'From',
			'to' => 'To',
			'time' => 'Time',
			'week' => 'Week',
			'optiondata' => 'Optiondata',
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
		$criteria->compare('tour_id',$this->tour_id);
		$criteria->compare('from',$this->from);
		$criteria->compare('to',$this->to);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('week',$this->week,true);
		$criteria->compare('optiondata',$this->optiondata,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getHtmlListTime()
    {
        $data = array();
        for ($h=0; $h<=23; $h++)
        {
            if ($h<10)
                $hour = '0'.$h;
            else
                $hour = $h;
            for ($m=0; $m<=55; $m=$m+5)
            {
                if ($m<10)
                    $minute = '0'.$m;
                else
                    $minute = $m;

                $data[$hour.':'.$minute] = $hour.':'.$minute;
            }
        }
        return $data;
    }

    public function afterFind()
    {
        $this->from = date("d.m.Y",$this->from);
        $this->to = date("d.m.Y",$this->to);
        $this->time = unserialize($this->time);
        $this->week = unserialize($this->week);
        $this->optiondata = unserialize($this->optiondata);

        return parent::afterFind();
    }

}