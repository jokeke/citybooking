<?php

class PricesRoomBehavior extends CActiveRecordBehavior
{
    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC



    public $type = 'HotelPrices';
    public $type_id = 'room_id';


    public function afterSave($event){
        $priceId = $_POST['priceId'];
        if (empty($priceId))
            return false;
        $priceSeason = $_POST['priceSeason'];
        $priceFrom = $_POST['from'];
        $priceTo = $_POST['to'];
        $pricePrice = $_POST['pricePrice'];

        $i = 0;
        foreach ( $priceId as $id)
        {
            if(empty($priceFrom[$i]) or empty($priceTo[$i]))
            {
                continue;
                $i++;
            }
            elseif(empty($id))
            {
                $type_id = $this->type_id; // room_id
                $price = new $this->type; // HotelPrices
                $price->from =  strtotime($priceFrom[$i]);
                $price->to =  strtotime($priceTo[$i]);
                $price->price = $pricePrice[$i];
                $price->season_name = $priceSeason[$i];
                $price->$type_id = $this->owner->id;
                $price->save();
                $i++;
            }
            else
            {
                $type = $this->type;
                $type::model()->updateByPk($id, array(
                    'from'=>strtotime($priceFrom[$i]),
                    'to'=>strtotime($priceTo[$i]),
                    'season_name'=>$priceSeason[$i],
                    'price'=>$pricePrice[$i],
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