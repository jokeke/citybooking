<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $content
 * @property string $image
 * @property string $description
 * @property integer $level
 * @property integer $active
 * @property string $title
 * @property integer $news_date
 * @property integer $position
 * @property string $metakeywords
 * @property string $metadescription
 * @property integer $created
 * @property integer $updated
 */
class Pages extends CActiveRecord
{
    public $image_upl;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pages the static model class
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
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level, active, position, created, updated', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('url, title', 'length', 'max'=>255),
			array('content, image, description, description_short, metakeywords, metadescription, news_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, content, image, description, level, active, title, news_date, position, metakeywords, metadescription, created, updated', 'safe', 'on'=>'search'),

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
			'content' => 'Content',
			'image' => 'Image',
			'description' => 'Description',
			'level' => 'Level',
			'active' => 'Active',
			'title' => 'Title',
			'news_date' => 'News Date',
			'position' => 'Position',
			'metakeywords' => 'Metakeywords',
			'metadescription' => 'Metadescription',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('active',$this->active);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('news_date',$this->news_date);
		$criteria->compare('position',$this->position);
		$criteria->compare('metakeywords',$this->metakeywords,true);
		$criteria->compare('metadescription',$this->metadescription,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'position ASC',
            ),
		));
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

    public function getRdate($param, $time=0) {
        if(intval($time)==0)$time=time();
        $MonthNames=array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
        if(strpos($param,'M')===false) return date($param, $time);
        else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
    }

    public function getNewsList($limit = 10)
    {
        $sql = "SELECT * FROM pages WHERE pages.active = 1 AND pages.level = 1 ORDER BY pages.news_date DESC LIMIT :limit";
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $command->bindParam(":limit", $limit, PDO::PARAM_INT);
        $data=$command->queryAll();
        foreach( $data as &$row ) {
            $row['news_date'] = $this->getRdate('d M Y',$row['news_date']);
        }
        return $data;
    }

    /* Получаем новость по её Url */
    public function getNewsByUrl($url)
    {
        $sql = "SELECT * FROM pages WHERE pages.active = 1 AND pages.level = 1 AND pages.url = :url";
        $command = Yii::app()->db->cache(86400)->createCommand($sql);
        $command->bindParam(":url", $url, PDO::PARAM_STR);
        $data=$command->queryRow();
        return $data;
    }
}