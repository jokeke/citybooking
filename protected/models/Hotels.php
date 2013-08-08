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
 * @property string $description
 * @property string $images
 * @property integer $room_num
 * @property integer $created
 * @property integer $updated
 * @property string $title
 * @property string $metakeywords
 * @property string $metadescription
 * @property string $url
 */
class Hotels extends CActiveRecord
{

    public $image_upl;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Hotels the static model class
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
            //array('picture', 'length', 'max' => 255, 'tooLong' => '{attribute} is too long (max {max} chars).', 'on' => 'upload'),
            //array('picture', 'file', 'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!', 'on' => 'upload'),
            array('name, position, url', 'required'),
            array('position, active, metro1, metro_dis1, metro2, metro_dis2, metro3, metro_dis3, district, stars, room_num, created, updated', 'numerical', 'integerOnly'=>true),
            array('lng, lat', 'numerical', 'integerOnly'=>false),
            array('name, url', 'length', 'max'=>128),
            array('address, lat_lng, title', 'length', 'max'=>255),
            array('description, description_short, images, metakeywords, metadescription', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, position, active, address, lng, lat, lat_lng, metro1, metro_dis1, metro2, metro_dis2, metro3, metro_dis3, district, stars, description, images, room_num, created, updated, title, metakeywords, metadescription, url', 'safe', 'on'=>'search'),
        );
    }

    public function behaviors(){
        return array(
            // наше поведение для работы с изображением
            'ImageUploadBehavior'=>array(
                'class'=>'ext.ImageUploadBehavior',
                'attributeName'=>'image_upl',
            ),
            'ServicesBehavior'=>array(
                'class'=>'ext.ServicesBehavior',
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
            'address' => 'address',
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
            'description' => 'Description',
            'images' => 'Images',
            'room_num' => 'Room Num',
            'created' => 'Created',
            'updated' => 'updated',
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
        $criteria->compare('description',$this->description,true);
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
            'sort' => array(
                'defaultOrder' => 'position ASC',),
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

        foreach (Rooms::model()->findAllByAttributes(array('hotel_id'=>$this->id)) as $room)
        {
            $room->delete();
        }
        HotelServices::model()->deleteAllByAttributes(array('hotel_id'=>$this->id));
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

    /**  Админка **/
    public function getHtmlListMetro()
    {
        $data = array();
        $data[0] = '--Выберите--';
        $metro = Metro::model()->findAll();
        foreach( $metro as $m ) {
            $data[$m->id] = $m->name;
        }
        return $data;
    }

    public function getHtmlListDistricts()
    {
        $data = array();
        $data[0] = '--Выберите--';
        $districts = Districts::model()->findAll();
        foreach( $districts as $d ) {
            $data[$d->id] = $d->name;
        }
        return $data;
    }
    /**  Админка - END **/

    /**  Поиск **/
    public function getSearchList($arr = array(
        'price_from'=>false,
        'price_to'=>false,
        'checkin'=>false,
        'checkout'=>false,
        'title'=>false,
        'stars'=>false,
        'order'=>false,
        'start_row'=>0,
        'per_page'=>false,
    ))
    {

        $sql = "SELECT hotels.*, metro.name AS metro_name, COUNT(hotels.id) as total, MIN(hotel_prices.price) as price, ROUND(AVG(review.total),1) AS rating, COUNT(review.total) AS reviews FROM metro, rooms RIGHT OUTER JOIN hotels ON rooms.hotel_id = hotels.id" . PHP_EOL;

        $sql .= "RIGHT OUTER JOIN hotel_prices ON hotel_prices.room_id = rooms.id" . PHP_EOL;
        if ($arr['price_from'])
        {
            $sql .= "AND hotel_prices.price >=" . addslashes($arr['price_from']) . PHP_EOL;
        }
        if ($arr['price_to'])
        {
            $sql .= "AND hotel_prices.price <= " . addslashes($arr['price_to']) . PHP_EOL;
        }

        $sql .= "LEFT OUTER JOIN review ON review.hotel_id = hotels.id" . PHP_EOL;
        $sql .= "WHERE metro.id =hotels.metro1" . PHP_EOL;
        if ($arr['checkin'])
        {
            $sql .= "AND " . addslashes(strtotime($arr['checkin'])) . " BETWEEN hotel_prices.from AND hotel_prices.to" . PHP_EOL;
        }
        if ($arr['title'])
        {
            $sql .= "AND hotels.name LIKE '%" . addslashes($arr['title']) . "%'" . PHP_EOL;
        }
        if ($arr['stars'])
        {
            $sql .= "AND hotels.stars IN (" . addslashes(implode(', ', $arr['stars'])) . ")" . PHP_EOL;
        }

        $sql .= "GROUP BY hotels.id" . PHP_EOL;
        if ($arr['order'])
        {
            $sql .= "ORDER BY " . addslashes($arr['order']) . PHP_EOL;
        }
        else
        {
            $sql .= "ORDER BY price" . PHP_EOL;
        }
        if ($arr['per_page'])
        {
            $sql .= "LIMIT " . addslashes($arr['start_row']) . ", " . addslashes($arr['per_page']) . "" . PHP_EOL;
        }
        print_r($sql);
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $data=$command->queryAll();
        foreach( $data as &$row ) {
            $row['images'] = unserialize($row['images']);
            foreach ($row['images'] as $img)
            {
                $row['thumb_images'][] = str_replace('images/','images/thumb_',$img);
            }

        }

        return $data;
    }

    public function getCountSearchList($arr = array(
        'price_from'=>false,
        'price_to'=>false,
        'checkin'=>false,
        'checkout'=>false,
        'title'=>false,
        'stars'=>false,
        'order'=>false,
    ))
    {

        $sql = "SELECT hotels.*, metro.name AS metro_name, COUNT(hotels.id) as total, MIN(hotel_prices.price) as price, ROUND(AVG(review.total),1) AS rating, COUNT(review.total) AS reviews FROM metro, rooms RIGHT OUTER JOIN hotels ON rooms.hotel_id = hotels.id" . PHP_EOL;

        $sql .= "RIGHT OUTER JOIN hotel_prices ON hotel_prices.room_id = rooms.id" . PHP_EOL;
        if ($arr['price_from'])
        {
            $sql .= "AND hotel_prices.price >=" . addslashes($arr['price_from']) . PHP_EOL;
        }
        if ($arr['price_to'])
        {
            $sql .= "AND hotel_prices.price <= " . addslashes($arr['price_to']) . PHP_EOL;
        }

        $sql .= "LEFT OUTER JOIN review ON review.hotel_id = hotels.id" . PHP_EOL;
        $sql .= "WHERE metro.id =hotels.metro1" . PHP_EOL;
        if ($arr['checkin'])
        {
            $sql .= "AND " . addslashes(strtotime($arr['checkin'])) . " BETWEEN hotel_prices.from AND hotel_prices.to" . PHP_EOL;
        }
        if ($arr['title'])
        {
            $sql .= "AND hotels.name LIKE '%" . addslashes($arr['title']) . "%'" . PHP_EOL;
        }
        if ($arr['stars'])
        {
            $sql .= "AND hotels.stars IN (" . addslashes(implode(', ', $arr['stars'])) . ")" . PHP_EOL;
        }

        $sql .= "GROUP BY hotels.id" . PHP_EOL;
        if ($arr['order'])
        {
            $sql .= "ORDER BY " . addslashes($arr['order']) . PHP_EOL;
        }
        else
        {
            $sql .= "ORDER BY price" . PHP_EOL;
        }
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $data=$command->queryAll();

        return count($data);
    }

    public function getHotelByUrl($url)
    {
        $sql = "SELECT * FROM hotels WHERE  hotels.active = 1 AND hotels.url = :url";
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $command->bindParam(":url", $url, PDO::PARAM_STR);
        $data=$command->queryRow();
        $data['images'] = unserialize($data['images']);
        foreach ($data['images'] as $img)
        {
            $data['thumb_images'][] = str_replace('images/','images/thumb_',$img);
        }
        $data['roomsCount'] = count(Rooms::model()->getRoomsByHotelId($data['id']));
        $data['metro_name1'] = Metro::model()->getMetroNameById($data['metro1']);
        $data['metro_name2'] = Metro::model()->getMetroNameById($data['metro2']);
        $data['metro_name3'] = Metro::model()->getMetroNameById($data['metro3']);

        return $data;
    }

    public function getHotelMinPrice($id)
    {
        //$sql = "SELECT rooms.* FROM rooms WHERE rooms.active = 1 AND rooms.hotel_id = :id";
        $sql = "SELECT MIN(hotel_prices.price) as price FROM rooms LEFT OUTER JOIN hotel_prices ON hotel_prices.room_id = rooms.id WHERE rooms.active = 1 AND rooms.hotel_id = :id";
        $command = Yii::app()->db->cache(84600)->createCommand($sql);
        $command->bindParam(':id',$id, PDO::PARAM_INT);
        $data=$command->queryScalar();

        return $data;
    }

    public function getAll()
    {
        $sql = "SELECT hotels.id, hotels.name FROM hotels WHERE  hotels.active = 1";
        $command = Yii::app()->db->cache(84600)->createCommand($sql);
        $data=$command->queryAll();

        return $data;
    }


}