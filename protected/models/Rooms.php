<?php

/**
 * This is the model class for table "rooms".
 *
 * The followings are the available columns in table 'rooms':
 * @property integer $id
 * @property integer $hotel_id
 * @property string $name
 * @property string $url
 * @property integer $active
 * @property integer $payform
 * @property string $category
 * @property string $category_standart
 * @property integer $num
 * @property integer $sleeper
 * @property string $description
 * @property string $images
 * @property integer $position
 * @property integer $created
 * @property integer $updated
 * @property string $title
 * @property string $metakeywords
 * @property string $metadescription
 *
 * The followings are the available model relations:
 * @property HotelBooking[] $hotelBookings
 * @property HotelsPrices[] $hotelsPrices
 * @property Images[] $images0
 * @property RoomServices[] $roomServices
 * @property Hotels $hotel
 */
class Rooms extends CActiveRecord
{

    public $image_upl;
    public $hotel_search;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Rooms the static model class
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
        return 'rooms';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('url', 'required'),
            array('hotel_id, active, payform, num, sleeper, position, created, updated', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>50),
            array('url, category, category_standart', 'length', 'max'=>128),
            array('title', 'length', 'max'=>255),
            array('description, images, metakeywords, metadescription', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, hotel_id, name, url, active, payform, category, category_standart, num, sleeper, description, images, position, created, updated, title, metakeywords, metadescription, hotel_search', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */

    public function behaviors(){
        return array(
            // наше поведение для работы с изображением
            'ImageUploadBehavior'=>array(
                'class'=>'ext.ImageUploadBehavior',
                'attributeName'=>'image_upl',
            ),
            'ServicesBehavior'=>array(
                'class'=>'ext.ServicesBehavior',
                'type'=>'RoomServices',
                'type_id'=>'room_id',
            ),
            'PricesRoomBehavior'=>array(
                'class'=>'ext.PricesRoomBehavior',
            ),
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'updated',
            ),
        );
    }

    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(

            'hotelBookings' => array(self::HAS_MANY, 'HotelBooking', 'room_id'),
            'hotelsPrices' => array(self::HAS_MANY, 'HotelsPrices', 'roomid'),
            'roomServices' => array(self::HAS_MANY, 'RoomServices', 'room_id'),
            'hotel' => array(self::BELONGS_TO, 'Hotels', 'hotel_id'),
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
            'url' => 'Url',
            'active' => 'Active',
            'payform' => 'Payform',
            'category' => 'Category',
            'category_standart' => 'Category Standart',
            'num' => 'Num',
            'sleeper' => 'Sleeper',
            'description' => 'Description',
            'images' => 'Images',
            'position' => 'Position',
            'created' => 'Created',
            'updated' => 'Updated',
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
        $criteria->with = array( 'hotel' );

        $criteria->compare( 'hotel.name', $this->hotel_search, true );
        $criteria->compare('id',$this->id);
        $criteria->compare('hotel_id',$this->hotel_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('url',$this->url,true);
        $criteria->compare('active',$this->active);
        $criteria->compare('payform',$this->payform);
        $criteria->compare('category',$this->category,true);
        $criteria->compare('category_standart',$this->category_standart,true);
        $criteria->compare('num',$this->num);
        $criteria->compare('sleeper',$this->sleeper);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('images',$this->images,true);
        $criteria->compare('position',$this->position);
        $criteria->compare('created',$this->created);
        $criteria->compare('updated',$this->updated);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('metakeywords',$this->metakeywords,true);
        $criteria->compare('metadescription',$this->metadescription,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'attributes'=>array(
                    'hotel_search'=>array(
                        'asc'=>'hotel.name',
                        'desc'=>'hotel.name DESC',
                    ),
                    '*',
                ),
                'defaultOrder' => 't.position ASC',
            ),
        ));
    }

    public function afterFind()
    {
        $this->images = unserialize($this->images);

        return parent::afterFind();
    }

    /** Каскадное удаление записей **/
    public function beforeDelete()
    {
        foreach ($this->images as $i)
        {
            $filePath = Yii::app()->basePath . '/..' . $i;
            $thumbPath = str_replace('images/','images/thumb_', $filePath);
            if (@is_file($filePath))
            {
                @unlink($filePath);
                @unlink($thumbPath);
            }
        }

        HotelPrices::model()->deleteAllByAttributes(array('room_id'=>$this->id));
        RoomServices::model()->deleteAllByAttributes(array('room_id'=>$this->id));
        return parent::beforeDelete();
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

    public function getRoomsByHotelId($id, $date = false)
    {
        $sql = "SELECT rooms.*, hotel_prices.price FROM rooms LEFT OUTER JOIN hotel_prices ON hotel_prices.room_id = rooms.id WHERE rooms.active = 1 AND rooms.hotel_id = :id" . PHP_EOL;
        if ($date)
        {
            $sql .= "AND " . addslashes($date) . " BETWEEN hotel_prices.from AND hotel_prices.to" . PHP_EOL;
        }

        $command = Yii::app()->db->cache(84600)->createCommand($sql);
        $command->bindParam(':id',$id, PDO::PARAM_INT);
        $data=$command->queryAll();

        //Снимаем сериализацию изображений
        foreach( $data as &$row ) {
            $row['images'] = unserialize($row['images']);
        }

        return $data;
    }

    public function getRoomById($id, $date = false)
    {
        $sql = "SELECT rooms.*,hotel_prices.price FROM rooms LEFT OUTER JOIN hotel_prices ON hotel_prices.room_id = rooms.id WHERE rooms.active = 1 AND rooms.id = :id" . PHP_EOL;
        if ($date)
        {
            $sql .= "AND " . addslashes($date) . " BETWEEN hotel_prices.from AND hotel_prices.to" . PHP_EOL;
        }
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $command->bindParam(':id',$id, PDO::PARAM_INT);
        $data=$command->queryRow();

        //Снимаем сериализацию изображений
            $data['images'] = unserialize($row['images']);
        //print_r($data);

        return $data;
    }
}