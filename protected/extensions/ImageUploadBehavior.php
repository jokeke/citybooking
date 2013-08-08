<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 */
class ImageUploadBehavior extends CActiveRecordBehavior
{
    // Имя файла
    public $attributeName='qwe';

    //путь, куда будем сохранять файлы
    public $savePathAlias='webroot.media.images';

    /**
     * @var array сценарии валидации к которым будут добавлены правила валидации
     * загрузки файлов
     */
    public $scenarios=array('insert','update');
    /**
     * @var string типы файлов, которые можно загружать (нужно для валидации)
     */
    public $fileTypes='jpg,png';

    //Возвращает путь к директории, в которой будут сохраняться файлы.
    public function getSavePath(){
        return Yii::getPathOfAlias($this->savePathAlias).DIRECTORY_SEPARATOR;
    }

    public function attach($owner){
        parent::attach($owner);

        if(in_array($owner->scenario,$this->scenarios)){
            // добавляем валидатор файла
            $fileValidator=CValidator::createValidator('file',$owner,$this->attributeName,
                array('types'=>$this->fileTypes,'allowEmpty'=>true));
            $owner->validatorList->add($fileValidator);
        }
    }

    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeSave($event){
        $i = 0;
        foreach ($this->owner->images as $img)
        {
            if ($file = CUploadedFile::getInstance($this->owner, 'image_upl[' . $i . ']'))
            {
                $this->deleteFile($img); // старый файл удалим, потому что загружаем новый
                $filename = $this->owner->url . '_' . md5(time() . $i) . '.' . $file->extensionName;
                $images[] = '/media/images/' . $filename;
                $file->saveAs($this->savePath . $filename);

                //Делаем ресайз
                Yii::import("ext.EPhpThumb.EPhpThumb");
                $thumb = new EPhpThumb();
                $thumb->init(); //this is needed
                $thumb->create(Yii::app()->basePath . '/../media/images/' . $filename)
                    ->resize(200, 200)->save(Yii::app()
                    ->basePath . '/../media/images/thumb_' . $filename);
            }
            elseif(empty($img))
            {
                continue;
            }
            else
            {
                $images[] = $img;
            }
            $i++;
        }
        if (empty($images))
        {
            $this->owner->images = serialize(array());
        }
        else
            $this->owner->images = serialize($images);

        //}
        return true;
    }

    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC

    public function deleteFile($filename){
        $filePath = Yii::app()->basePath . '/..' . $filename;
        $thumb = explode('/', $filename);
        $thumbPath = Yii::app()->basePath . '/../' . $thumb[0] . '/' . $thumb[1] . '/' . $thumb[2] . '/thumb_' . $thumb[3];
        if (@is_file($filePath))
        {
            @unlink($filePath);
            @unlink($thumbPath);
        }
    }

}
?>