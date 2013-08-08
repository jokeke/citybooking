<?php

/**
 * This is the model class for table "conference".
 *
 * The followings are the available columns in table 'conference':
 * @property integer $id
 * @property string $name
 * @property integer $hotel_id
 * @property string $description
 * @property integer $type
 * @property integer $area
 * @property string $food
 * @property string $url
 * @property integer $active
 * @property integer $position
 * @property integer $created
 * @property integer $updated
 * @property string $images
 * @property string $title
 * @property string $metakeywords
 * @property string $metadescription
 *
 * The followings are the available model relations:
 * @property ConferenceTypes $type0
 * @property Hotels $hotel
 * @property ConferencePrices[] $conferencePrices
 */
class Conference extends CActiveRecord
{
    public $image_upl;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Conference the static model class
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
		return 'conference';
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
			array('hotel_id, type, area, active, position, created, updated', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('url, title', 'length', 'max'=>255),
			array('description, food, images, metakeywords, metadescription', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, hotel_id, description, type, area, food, url, active, position, created, updated, images, title, metakeywords, metadescription', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors(){
        return array(
            // наше поведение для работы с изображением
            'ImageUploadBehavior'=>array(
                'class'=>'ext.ImageUploadBehavior',
                'attributeName'=>'image_upl',
            ),
            'PricesConferenceBehavior'=>array(
                'class'=>'ext.PricesConferenceBehavior',
            ),
            'TypeConferenceBehavior'=>array(
                'class'=>'ext.TypeConferenceBehavior',
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
			'type0' => array(self::BELONGS_TO, 'ConferenceTypes', 'type'),
			'hotel' => array(self::BELONGS_TO, 'Hotels', 'hotel_id'),
			'conferencePrices' => array(self::HAS_MANY, 'ConferencePrices', 'conference_id'),
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
			'hotel_id' => 'Hotel',
			'description' => 'Description',
			'type' => 'Type',
			'area' => 'Area',
			'food' => 'Food',
			'url' => 'Url',
			'active' => 'Active',
			'position' => 'Position',
			'created' => 'Created',
			'updated' => 'Updated',
			'images' => 'Images',
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
		$criteria->compare('hotel_id',$this->hotel_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('area',$this->area);
		$criteria->compare('food',$this->food,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('position',$this->position);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('metakeywords',$this->metakeywords,true);
		$criteria->compare('metadescription',$this->metadescription,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'position ASC',),
		));
	}

    public function afterFind()
    {
        $this->images = unserialize($this->images);

        return parent::afterFind();
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

    public function getHtmlListHotels()
    {
        $data = array();
        $data[0] = '--Выберите--';
        $hotels = Hotels::model()->findAll();
        foreach( $hotels as $h ) {
            $data[$h->id] = $h->name;
        }
        return $data;
    }

    public function getSearchList($arr = array(
        'hotelId'=>false,
        'stars'=>false,
        'order'=>false,
    ))
    {
        $sql = "SELECT hotels.id AS hotelId, hotels.name, hotels.stars, hotels.address, hotels.description_short, hotels.lat, hotels.lng, hotels.metro1,  MAX(conference.area) AS maxArea, MIN(conference.area) AS minArea, hotels.url, MAX(conference_types.max_humans) AS maxHumans, MIN(conference_types.max_humans) AS minHumans, COUNT(DISTINCT conference.id) AS conferenceCount" . PHP_EOL;
        $sql .= "FROM hotels" . PHP_EOL;
        $sql .= "LEFT OUTER JOIN conference ON conference.hotel_id = hotels.id" . PHP_EOL;
        $sql .= "LEFT OUTER JOIN conference_types ON conference_types.conference_id = conference.id" . PHP_EOL;
        $sql .= "WHERE conference.active = 1" . PHP_EOL;
        if ($arr['stars'])
        {
            $sql .= "AND hotels.stars IN (" . addslashes(implode(', ', $arr['stars'])) . ")" . PHP_EOL;
        }
        if ($arr['hotelId'])
        {
            $sql .= " AND hotels.id = " . addslashes($arr['hotelId']) . PHP_EOL;
        }
        $sql .= "GROUP BY hotels.id" . PHP_EOL;

        print_r($sql);
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $data=$command->queryAll();
        return $data;
    }

    public function getConferenceMinPrice($id)
    {
        $sql = "SELECT MIN(conference_prices.price) as price FROM conference LEFT OUTER JOIN conference_prices ON conference_prices.conference_id = conference.id WHERE conference.active = 1 AND conference.hotel_id = :id";
        $command = Yii::app()->db->cache(84600)->createCommand($sql);
        $command->bindParam(':id',$id, PDO::PARAM_INT);
        $data=$command->queryScalar();

        return $data;
    }

    public function getConferenceByHotelUrl($url)
    {
        $sql = "SELECT conference.* FROM conference RIGHT OUTER JOIN hotels ON conference.hotel_id = hotels.id AND hotels.url = :url WHERE conference.active = 1";
        $command = Yii::app()->db->cache(84600)->createCommand($sql);
        $command->bindParam(':url',$url, PDO::PARAM_STR);

        $data=$command->queryAll();

        foreach( $data as &$row ) {
            $row['prices'] = ConferencePrices::model()->getPricesByConferenceId($row['id']);
            $row['types'] = ConferenceTypes::model()->getTypesByConferenceId($row['id']);
            $row['images'] = unserialize($row['images']);
            foreach ($row['images'] as $img)
            {
                $row['thumb_images'][] = str_replace('images/','images/thumb_',$img);
            }
        }

        return $data;
    }

}