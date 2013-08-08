<?php

class TimeTableBehavior extends CActiveRecordBehavior
{


    public function afterSave($event){

        $timetableId = $_POST['timetableId'];
        if (empty($timetableId))
            return false;

        $i = 0;
        foreach ( $timetableId as $id)
        {
            if(empty($_POST['from'.$i]))
            {
                continue;
                $i++;
            }
            elseif(empty($id))
            {
                $timetable = new TourTimetable;
                $timetable->from =  strtotime($_POST['from'.$i]);
                $timetable->to =  strtotime($_POST['to'.$i]);
                $timetable->time = serialize($_POST['time'.$i]);
                $timetable->week = serialize($_POST['week'.$i]);
                $timetable->optiondata = serialize($this->optionData($_POST['from'.$i],$_POST['to'.$i],$_POST['week'.$i]));
                $timetable->tour_id = $this->owner->id;
                $timetable->save();
                $i++;
            }
            else
            {
                $time1 = strtotime($_POST['from0']);
                $time2 = strtotime($_POST['to0']);
                $week = $_POST['week0'];
                TourTimetable::model()->updateByPk($id, array(
                    'from'=>strtotime($_POST['from'.$i]),
                    'to'=>strtotime($_POST['to'.$i]),
                    'time'=>serialize($_POST['time'.$i]),
                    'week'=>serialize($_POST['week'.$i]),
                    'optiondata'=>serialize($this->optionData(strtotime($_POST['from'.$i]),strtotime($_POST['to'.$i]),$_POST['week'.$i])),
                ));
                $i++;
            }
        }
        return true;
    }

    private function optionData($time1, $time2, $week)
    {
        //$time1 = strtotime($_POST['from0']);
        //$time2 = strtotime($_POST['to0']);
        $optiondata = array();
        for($i=$time1; $i<=$time2; $i=$i+24*60*60 )
        {
            $weekday = date("w",$i);
            if (in_array($weekday, $week))
            {
                /*
                echo $k.'</br>';
                echo $i.'</br>';
                echo date("d.m.Y",$i).'</br>';
                echo date("w",$i).'</br></br>';
                */
                $optiondata[] = date("d.m.Y",$i);
            }
        }
        return $optiondata;
    }
}
?>