<?php

/**
 * This is the model class for table "hotels".
 *
 * The followings are the available columns in table 'hotels':
 * @property integer $id
 * @property string $name
 * @property integer $position
 * @property integer $active
 * @property string $address
 * @property double $lng
 * @property double $lat
 * @property string $lat_lng
 * @property integer $metro1
 * @property integer $metro_dis1
 * @property integer $metro2
 * @property integer $metro_dis2
 * @property integer $metro3
 * @property integer $metro_dis3
 * @property integer $district
 * @property integer $stars
 * @property integer $rating
 * @property string $description
 * @property string $description_short
 * @property string $images
 * @property integer $room_num
 * @property integer $created
 * @property integer $updated
 * @property string $title
 * @property string $metakeywords
 * @property string $metadescription
 * @property string $url
 *
 * The followings are the available model relations:
 * @property Conference[] $conferences
 * @property HotelBooking[] $hotelBookings
 * @property HotelServices[] $hotelServices
 * @property Images[] $images0
 * @property Objects[] $objects
 * @property Rooms[] $rooms
 */
class HotelsTest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HotelsTest the static model class
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
		return 'hotels';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, position, created, updated, url', 'required'),
			array('position, active, metro1, metro_dis1, metro2, metro_dis2, metro3, metro_dis3, district, stars, rating, room_num, created, updated', 'numerical', 'integerOnly'=>true),
			array('lng, lat', 'numerical'),
			array('name, url', 'length', 'max'=>128),
			array('address, lat_lng, title', 'length', 'max'=>255),
			array('description, description_short, images, metakeywords, metadescription', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, position, active, address, lng, lat, lat_lng, metro1, metro_dis1, metro2, metro_dis2, metro3, metro_dis3, district, stars, rating, description, description_short, images, room_num, created, updated, title, metakeywords, metadescription, url', 'safe', 'on'=>'search'),
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
			'conferences' => array(self::HAS_MANY, 'Conference', 'hotel_id'),
			'hotelBookings' => array(self::HAS_MANY, 'HotelBooking', 'hotel_id'),
			'hotelServices' => array(self::HAS_MANY, 'HotelServices', 'hotel_id'),
			'images0' => array(self::HAS_MANY, 'Images', 'hotelid'),
			'objects' => array(self::HAS_MANY, 'Objects', 'hotel_id'),
			'rooms' => array(self::HAS_MANY, 'Rooms', 'hotel_id'),
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
			'position' => 'Position',
			'active' => 'Active',
			'address' => 'Address',
			'lng' => 'Lng',
			'lat' => 'Lat',
			'lat_lng' => 'Lat Lng',
			'metro1' => 'Metro1',
			'metro_dis1' => 'Metro Dis1',
			'metro2' => 'Metro2',
			'metro_dis2' => 'Metro Dis2',
			'metro3' => 'Metro3',
			'metro_dis3' => 'Metro Dis3',
			'district' => 'District',
			'stars' => 'Stars',
			'rating' => 'Rating',
			'description' => 'Description',
			'description_short' => 'Description Short',
			'images' => 'Images',
			'room_num' => 'Room Num',
			'created' => 'Created',
			'updated' => 'Updated',
			'title' => 'Title',
			'metakeywords' => 'Metakeywords',
			'metadescription' => 'Metadescription',
			'url' => 'Url',
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
		$criteria->compare('position',$this->position);
		$criteria->compare('active',$this->active);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('lng',$this->lng);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('lat_lng',$this->lat_lng,true);
		$criteria->compare('metro1',$this->metro1);
		$criteria->compare('metro_dis1',$this->metro_dis1);
		$criteria->compare('metro2',$this->metro2);
		$criteria->compare('metro_dis2',$this->metro_dis2);
		$criteria->compare('metro3',$this->metro3);
		$criteria->compare('metro_dis3',$this->metro_dis3);
		$criteria->compare('district',$this->district);
		$criteria->compare('stars',$this->stars);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('description_short',$this->description_short,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('room_num',$this->room_num);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('metakeywords',$this->metakeywords,true);
		$criteria->compare('metadescription',$this->metadescription,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}