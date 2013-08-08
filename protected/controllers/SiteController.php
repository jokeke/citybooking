<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */


	public function actionIndex()
	{
        $markers = Hotels::model()->getSearchList();
        $news = Pages::model()->getNewsList(3);
		$this->render('index', array(
            'news'=>$news,
            'markers'=>$markers,
        ));
	}

    public function actionNews()
    {
        if (isset($_GET['url']))
        {
            $news = Pages::model()->getNewsByUrl($_GET['url']);
            $this->render('news',array('news'=>$news));
        }
        else
        {
            $this->redirect('index');
        }
    }

    public function actionMap()
    {
        $markers = Hotels::model()->getSearchList();
        $this->render('map', array('markers'=>$markers));
    }


    /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
    {
        $username = $_POST['email'];
        $password = $_POST['password'];
        $identity=new UserIdentity($username,$password);
        if($identity->authenticate())
            Yii::app()->user->login($identity);
        else
            echo $identity->errorMessage;
        $this->redirect('/');
    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionRegistration()
    {
        $record = Users::model()->find('LOWER(email)=?',array(strtolower($_POST['email'])));
        if ($record === null)
        {
            $user = new Users;
            $user->email = $_POST['email'];
            $user->password = crypt($_POST['password']);
            $user->firstname = $_POST['name'];
            $user->phone = $_POST['phone'];
            $user->city = $_POST['city'];
            $user->save();
            echo 'Поздравляю, вы успешно зарегистрированы';
        }
        else
        {
            echo 'Пользоваель с таким email уже существует';
        }
    }

    public function actionFavorites()
    {
        $this->render('favorites');
    }
}