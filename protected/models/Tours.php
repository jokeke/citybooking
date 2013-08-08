<?php

/**
 * This is the model class for table "tours".
 *
 * The followings are the available columns in table 'tours':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property string $visiting_time
 * @property integer $type
 * @property integer $type2
 * @property string $images
 * @property integer $active
 * @property integer $created
 * @property integer $updated
 * @property string $address
 * @property double $lat
 * @property double $lng
 * @property string $lat_lng
 * @property string $metro1
 * @property integer $metro_dis1
 * @property string $metro2
 * @property integer $metro_dis2
 * @property string $metro3
 * @property integer $metro_dis3
 * @property string $food
 * @property string $starttime
 * @property integer $position
 * @property string $title
 * @property string $metakeywords
 * @property string $metadescription
 *
 * The followings are the available model relations:
 * @property Objects[] $objects
 * @property ToursBooking[] $toursBookings
 * @property ToursPrices[] $toursPrices
 */
class Tours extends CActiveRecord
{
    public $image_upl;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tours the static model class
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
		return 'tours';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, type2, active, created, updated, metro_dis1, metro_dis2, metro_dis3, position', 'numerical', 'integerOnly'=>true),
			array('lat, lng', 'numerical'),
			array('name, metro1, metro2', 'length', 'max'=>128),
			array('url, address, lat_lng, metro3, title', 'length', 'max'=>255),
			array('description, food, starttime, duration, visiting_time, images, metakeywords, metadescription', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, description, visiting_time, type, type2, images, active, created, updated, address, lat, lng, lat_lng, metro1, metro_dis1, metro2, metro_dis2, metro3, metro_dis3, food, starttime, position, title, metakeywords, metadescription', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors(){
        return array(
            // наше поведение для работы с изображением
            'ImageUploadBehavior'=>array(
                'class'=>'ext.ImageUploadBehavior',
                'attributeName'=>'image_upl',
            ),
            'TimeTableBehavior'=>array(
                'class'=>'ext.TimeTableBehavior',
            ),
            'PricesTourBehavior'=>array(
                'class'=>'ext.PricesTourBehavior',
            ),
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
			'objects' => array(self::HAS_MANY, 'Objects', 'tour_id'),
			'toursBookings' => array(self::HAS_MANY, 'ToursBooking', 'tour_id'),
			'toursPrices' => array(self::HAS_MANY, 'ToursPrices', 'tour_id'),
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
			'url' => 'Url',
			'description' => 'Description',
			'visiting_time' => 'Visiting Time',
			'type' => 'Type',
			'type2' => 'Type2',
			'images' => 'Images',
			'active' => 'Active',
			'created' => 'Created',
			'updated' => 'Updated',
			'address' => 'address',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'lat_lng' => 'Lat Lng',
			'metro1' => 'Metro1',
			'metro_dis1' => 'Metro Dis1',
			'metro2' => 'Metro2',
			'metro_dis2' => 'Metro Dis2',
			'metro3' => 'Metro3',
			'metro_dis3' => 'Metro Dis3',
			'food' => 'food',
			'starttime' => 'Starttime',
			'position' => 'Position',
			'title' => 'Title',
			'metakeywords' => 'Metakeywords',
			'metadescription' => 'Metadescription',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('visiting_time',$this->visiting_time,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('type2',$this->type2);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('lng',$this->lng);
		$criteria->compare('lat_lng',$this->lat_lng,true);
		$criteria->compare('metro1',$this->metro1,true);
		$criteria->compare('metro_dis1',$this->metro_dis1);
		$criteria->compare('metro2',$this->metro2,true);
		$criteria->compare('metro_dis2',$this->metro_dis2);
		$criteria->compare('metro3',$this->metro3,true);
		$criteria->compare('metro_dis3',$this->metro_dis3);
		$criteria->compare('food',$this->food,true);
		$criteria->compare('starttime',$this->starttime,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('metakeywords',$this->metakeywords,true);
		$criteria->compare('metadescription',$this->metadescription,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'position ASC',
            ),
		));
	}

    public function afterFind()
    {
        $this->images = unserialize($this->images);

        return parent::afterFind();
    }

    public function getSearchList($type = false)
    {
        $sql = "SELECT tours.id, tours.name, tours.url, tours.duration, tours.images, tours.food, tour_prices.men, tour_prices.kid, tour_prices.old, tour_prices.foreigner, tour_prices.stud, tour_prices.type, tour_prices.to" . PHP_EOL;
        $sql .= "FROM tours, tour_prices" . PHP_EOL;
        $sql .= "WHERE tour_prices.tour_id = tours.id" . PHP_EOL;
        if ($type)
        {
            $sql .= " AND tours.type =" . addslashes($type) . PHP_EOL;
        }

        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $data=$command->queryAll();
        print_r($sql);

        foreach( $data as &$row ) {
            $row['to'] = date("d.m.Y",$row['to']);
            $row['images'] = unserialize($row['images']);
            foreach ($row['images'] as $img)
            {
                $row['thumb_images'][] = str_replace('images/','images/thumb_',$img);
            }
        }

        return $data;
    }

    public function getTourByUrl($url)
    {
        $sql = "SELECT * FROM tours WHERE tours.active = 1 AND tours.url = :url";
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $command->bindParam(":url", $url, PDO::PARAM_STR);
        $data=$command->queryRow();
        $data['images'] = unserialize($data['images']);
        foreach ($data['images'] as $img)
        {
            $data['thumb_images'][] = str_replace('images/','images/thumb_',$img);
        }
        $data['metro_name1'] = Metro::model()->getMetroNameById($data['metro1']);
        $data['metro_name2'] = Metro::model()->getMetroNameById($data['metro2']);
        $data['metro_name3'] = Metro::model()->getMetroNameById($data['metro3']);

        return $data;
    }
}