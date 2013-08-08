<?php

class TypeConferenceBehavior extends CActiveRecordBehavior
{


    public function afterSave($event){

        $typeId = $_POST['typeId'];
        if (empty($typeId))
            return false;

        $i = 0;
        foreach ( $typeId as $id)
        {
            if(empty($_POST['conferenceType'.$i]))
            {
                continue;
                $i++;
            }
            elseif(empty($id))
            {
                $type = new ConferenceTypes;
                $type->type_name =  $_POST['conferenceType'.$i];
                $type->max_humans =  $_POST['maxHumans'.$i];
                $type->conference_id =  $this->owner->id;
                $type->save();
                $i++;
            }
            else
            {
                ConferenceTypes::model()->updateByPk($id, array(
                    'type_name' => $_POST['conferenceType'.$i],
                    'max_humans' => $_POST['maxHumans'.$i],
                ));
                $i++;
            }
        }
        return true;
    }

}
?>