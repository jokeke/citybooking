<?php

class AjaxController extends Controller
{
	public function actionDeleteImage()
    {
        $filePath = Yii::app()->basePath . '/..' . $_POST['path'];
        $thumbPath = str_replace('images/','images/thumb_', $filePath);
        if (@is_file($filePath))
        {
            @unlink($filePath);
            @unlink($thumbPath);
        }
    }

    public function actionDeleteService()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $type::model()->deleteByPk($id);
    }

    public function actionDeletePrice()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $type::model()->deleteByPk($id);
    }

    public function actionDeleteTimeTable()
    {
        $id = $_POST['id'];
        TourTimetable::model()->deleteByPk($id);
    }

    public function actionAddTimetableTour()
    {
        $i = $_GET['i'];
        $this->renderPartial('_timetabletour', array('i'=>$i),false,true);
    }

    public function actionAddTypeConference()
    {
        $i = $_GET['i'];
        $this->renderPartial('_typeconference', array('i'=>$i),false,true);
    }

    public function actionDeleteTypeConference()
    {
        $id = $_POST['id'];
        ConferenceTypes::model()->deleteByPk($id);
    }
}
