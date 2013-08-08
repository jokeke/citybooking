<?php

class ToursController extends Controller
{
	public function actionSearch()
	{
        $type = $_GET['type'];
        $tours = Tours::model()->getSearchList($type);
		$this->render('search', array('tours'=>$tours,));
	}

    public function actionAjaxSearch()
    {
        $type = $_GET['type'];
        $tours = Tours::model()->getSearchList($type);
        $this->renderPartial('_ajaxsearch', array('tours'=>$tours,));
    }

    public function actionView()
    {
        if (isset($_GET['url']))
        {
            $tour = Tours::model()->getTourByUrl($_GET['url']);

            $this->render('view',array(
                'tour'=>$tour,
            ));
        }
        else
        {
            $this->redirect('index');
        }
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}