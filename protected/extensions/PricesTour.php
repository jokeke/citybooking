<?php

class PricesRoomBehavior extends CActiveRecordBehavior
{

    public function beforeSave($event){
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
            if(empty($id))
            {
                $price = new TourPrices;
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