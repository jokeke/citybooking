<?php

class ServicesBehavior extends CActiveRecordBehavior
{
    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC

    public $type = 'HotelServices';
    public $type_id = 'hotel_id';


    public function afterSave($event){
        $serviceId = $_POST['serviceId'];
        if (empty($serviceId))
            return false;
        $serviceDescription = $_POST['serviceDescription'];
        $serviceFree = $_POST['serviceFree'];
        $servicePrice = $_POST['servicePrice'];

        $i = 0;
        foreach ( $serviceId as $id)
        {
            if(empty($serviceDescription[$i]))
            {
                continue;
                $i++;
            }
            elseif(empty($id))
            {
                $type_id = $this->type_id;
                $service = new $this->type;
                $service->description = $serviceDescription[$i];
                $service->free = $serviceFree[$i];
                $service->price = $servicePrice[$i];
                $service->$type_id = $this->owner->id;
                $service->save();
                $i++;
            }
            else
            {
                $type = $this->type;
                $type::model()->updateByPk($id, array(
                    'description'=>$serviceDescription[$i],
                    'free'=>$serviceFree[$i],
                    'price'=>$servicePrice[$i],
                ));
                $i++;
            }
            //echo 'asd';
            //die();
        }
        return true;
    }
}
?>