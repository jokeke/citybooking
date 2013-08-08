<?php

class ConferenceController extends Controller
{
	public function actionSearch()
	{
        $hotels = Hotels::model()->getAll();
        $stars = $_GET['stars'];
        if(!is_array($_GET['stars'])) {
            $stars = json_decode($stars);
        };
        $conference = Conference::model()->getSearchList(array(
            'stars'=>$stars,
            'hotelId'=>$_GET['hotelId'],
        ));
        foreach( $conference as &$row ) {
            $row['metro_name'] = Metro::model()->getMetroNameById($row['metro1']);
            $row['roomsCount'] = count(Rooms::model()->getRoomsByHotelId($row['hotelId']));
            $row['minPrice'] = Conference::model()->getConferenceMinPrice($row['hotelId']);
        }
		$this->render('search', array(
            'conference'=>$conference,
            'hotels'=>$hotels,
        ));
	}

    public function actionAjaxSearch()
    {
        $conference = Conference::model()->getSearchList(array(
            'hotelId'=>$_GET['hotelId'],
            'stars'=>json_decode($_GET['stars'])
            //'stars'=>$_GET['stars'],
        ));
        foreach( $conference as &$row ) {
            $row['metro_name'] = Metro::model()->getMetroNameById($row['metro1']);
            $row['roomsCount'] = count(Rooms::model()->getRoomsByHotelId($row['hotelId']));
            $row['minPrice'] = Conference::model()->getConferenceMinPrice($row['hotelId']);
        }

        $this->renderPartial('_ajaxsearch', array(
            'conference'=>$conference,
        ));
    }

	public function actionView()
	{
        $hotel = Hotels::model()->getHotelByUrl($_GET['url']);
        $conference = Conference::model()->getConferenceByHotelUrl($_GET['url']);

		$this->render('view', array(
            'hotel'=>$hotel,
            'conference'=>$conference,
        ));
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