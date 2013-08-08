<?php

class DefaultController extends ControllerModule
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), array(
            'DLiveLayoutBehavior'=>array('class'=>'ext.DLiveLayoutBehavior'),
        ));
    }



    public function actionIndex()
	{
		$this->render('index');
	}
}