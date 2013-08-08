<?php

class PricesTourBehavior extends CActiveRecordBehavior
{

    public function afterSave($event){
        $priceId = $_POST['priceId'];
        $priceMin = $_POST['priceMin'];
        $priceMax = $_POST['priceMax'];
        $priceMen = $_POST['priceMen'];
        $priceKid = $_POST['priceKid'];
        $priceStud = $_POST['priceStud'];
        $priceOld = $_POST['priceOld'];
        $priceTo = strtotime($_POST['priceTo']);
        $priceForeigner = $_POST['priceForeigner'];
        $priceType = $_POST['priceType'];

            if(empty($priceId))
            {
                $price = new TourPrices;
                $price->min =  $priceMin;
                $price->max =  $priceMax;
                $price->men =  $priceMen;
                $price->kid =  $priceKid;
                $price->stud =  $priceStud;
                $price->old =  $priceOld;
                $price->foreigner =  $priceForeigner;
                $price->type =  $priceType;
                $price->to =  $priceTo;
                $price->tour_id =  $this->owner->id;
                $price->save();
            }
            else
            {
                TourPrices::model()->updateByPk($priceId, array(
                    'min'=>$priceMin,
                    'max'=>$priceMax,
                    'men'=>$priceMen,
                    'kid'=>$priceKid,
                    'stud'=>$priceStud,
                    'old'=>$priceOld,
                    'foreigner'=>$priceForeigner,
                    'type'=>$priceType,
                    'to'=>$priceTo,
                ));
            }
            //echo 'asd';
            //die();
        return true;
    }
}
?>