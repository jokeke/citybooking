<?php

class PricesConferenceBehavior extends CActiveRecordBehavior
{
    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC

    public $type = 'ConferencePrices';
    public $type_id = 'conference_id';


    public function beforeSave($event){
        $priceId = $_POST['priceId'];
        if (empty($priceId))
            return false;
        $hours = $_POST['hours'];
        $pricePrice = $_POST['price'];

        $i = 0;
        foreach ( $priceId as $id)
        {
            if(empty($hours[$i]) or empty($pricePrice[$i]))
            {
                continue;
                $i++;
            }
            elseif(empty($id))
            {
                $type_id = $this->type_id;
                $price = new $this->type;
                $price->price = $pricePrice[$i];
                $price->hours = $hours[$i];
                $price->$type_id = $this->owner->id;
                $price->save();
                $i++;
            }
            else
            {
                $type = $this->type;
                $type::model()->updateByPk($id, array(
                    'hours'=>$hours[$i],
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