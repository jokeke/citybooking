<?php

class HotelsController extends ControllerModule
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'sort', 'toggle', 'relational'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

    public function actions() {
        return array(
            'sort' => array(
                'class' => 'bootstrap.actions.TbSortableAction',
                'modelName' => 'Hotels'
            ),
            'toggle' => array(
                'class'=>'bootstrap.actions.TbToggleAction',
                'modelName' => 'Hotels',
            )
        );
    }

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Hotels;
        if ( empty($model->images))
            $model->images = array();
        $services = array();				

        // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Hotels']))
		{
			$model->attributes=$_POST['Hotels'];
            //print_r($model->attributes);
            //die();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));

		}

		$this->render('create',array(
			'model'=>$model,
            'services'=>$services,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $services = HotelServices::model()->findAllByAttributes(array('hotel_id'=>$id));

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Hotels']))
		{
			$model->attributes=$_POST['Hotels'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'services'=>$services,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Hotels');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Hotels('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Hotels']))
			$model->attributes=$_GET['Hotels'];

        $gridColumns = array(
            array('name'=>'position', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
            array('name'=>'name', 'header'=>'name'),
            array('name'=>'active', 'header'=>'active'),
            array('name'=>'address', 'header'=>'address'),
            array('name'=>'lat', 'header'=>'Hours lat'),
        );

		$this->render('admin',array(
			'model'=>$model,
			'gridColumns'=>$gridColumns,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Hotels the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Hotels::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Hotels $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='hotels-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionRelational()
    {
        $id = Hotels::model()->findByPk(Yii::app()->getRequest()->getParam('id'));
        $dataProvider=new CActiveDataProvider('Rooms', array(
            'criteria'=>array(
                'condition'=>'hotel_id=:id',
                'params'=>array(':id'=>$_GET['id']),)
        ));
        // partially rendering "_relational" view
       $this->renderPartial('_relational', array(
            'name' => $id->name,
            'gridDataProvider' => $dataProvider,
        ));
    }
}
