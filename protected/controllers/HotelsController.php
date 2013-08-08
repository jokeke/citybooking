<?php

class HotelsController extends Controller
{
    public function actionSearch()
    {
        /*$getTest = array();
        foreach (explode('&',$_SERVER['QUERY_STRING']) as $get_str)
        {
             explode('=',$get_str);
            $getTest[]
        }
*/
        $metro = Metro::model()->getAllName();
        $districts = Districts::model()->getAllName();

        /** Если это не массив то превращаем в массив в переопределяем гет парпметр **/
        $get = $_GET;
        $stars = $_GET['stars'];
        if(!is_array($_GET['stars'])) {
            $stars = json_decode($stars);
        };
        $get['stars'] = $stars;

        if( !isset($_GET['page']) )
        {
            $start_row = 0;
            $get['page'] = 1;
            $get['start_row'] = $start_row;
        }
        else
        {
            $start_row = ($_GET['page'] - 1) * $_GET['per_page'];
            $get['start_row'] = $start_row;
        }

        $hotels = Hotels::model()->getSearchList(array(
            'price_from'=>$_GET['price_from'],
            'price_to'=>$_GET['price_to'],
            'title'=>$_GET['title'],
            'stars'=>$stars,
            'checkin'=>$_GET['date_checkin'],
            'order'=>$_GET['order'],
            'start_row'=>$start_row,
            'per_page'=>$_GET['per_page'],
        ));
        // Колличество отелей удовлетворяющих условию (необходимо для пагинации)

        $countHotels = Hotels::model()->getCountSearchList(array(
            'price_from'=>$_GET['price_from'],
            'price_to'=>$_GET['price_to'],
            'title'=>$_GET['title'],
            'stars'=>$stars,
            'checkin'=>$_GET['date_checkin'],
            'order'=>$_GET['order'],
        ));
        $pages = ceil($countHotels / $_GET['per_page']);

        $this->render('search', array(
            'hotels'=>$hotels,
            'get'=>$get,
            'metro'=>$metro,
            'districts'=>$districts,
            'pages'=>$pages,
            'max_rows'=>$countHotels,
        ));
    }

    public function actionAjaxSearch()
    {
        $hotels = Hotels::model()->getSearchList(array(
            'price_from'=>$_GET['price_from'],
            'price_to'=>$_GET['price_to'],
            'title'=>$_GET['title'],
            'stars'=>json_decode($_GET['stars']),
            'checkin'=>$_GET['date_checkin'],
            'order'=>$_GET['order'],
            'start_row'=>$_GET['start_row'],
            'per_page'=>$_GET['per_page'],
        ));


        $this->renderPartial('_ajaxsearch', array(
            'hotels'=>$hotels,
        ));
    }

    public function actionAjaxPagination()
    {

    }

    public function actionView()
    {
        if (isset($_GET['url']))
        {
            $hotel = Hotels::model()->getHotelByUrl($_GET['url']);
            $hotel['min_price'] = Hotels::model()->getHotelMinPrice($hotel['id']);
            $rooms = Rooms::model()->getRoomsByHotelId($hotel['id'], strtotime($_GET['date_checkin']));
            $services = HotelServices::model()->getServicesByHotelId($hotel['id']);
            $review = Review::model()->getReviewByHotelId($hotel['id']);
            $this->render('view',array(
                'hotel'=>$hotel,
                'rooms'=>$rooms,
                'services'=>$services,
                'review'=>$review,
                'date_checkin'=>$_GET['date_checkin'],
            ));
        }
        else
        {
            $this->redirect('index');
        }
    }

    public function actionAjaxRooms()
    {
        if ($_POST['type'] == 'next')
        {
            $timestamp = $_POST['timestamp'] + 86400;
        }
        elseif ($_POST['type'] == 'prev')
        {
            $timestamp = $_POST['timestamp'] - 86400;
        }
        else {return false;}
        $rooms = Rooms::model()->getRoomById($_POST['id'], $timestamp);

        $this->renderPartial('_ajaxrooms', array(
            'r'=>$rooms,
        ));
    }

    public function actionReview()
    {
        $review = new Review;
        $review->name = $_POST['name'];
        $review->email = $_POST['email'];
        $review->from = strtotime($_POST['from']);
        $review->to = strtotime($_POST['to']);
        $review->service = $_POST['service'];
        $review->clear = $_POST['clear'];
        $review->location = $_POST['location'];
        $review->breakfast = $_POST['breakfast'];
        $review->review = $_POST['review'];
        $review->total = $_POST['total'];
        $review->hotel_id = $_POST['hotel_id'];
        $review->save();

        $review = Review::model()->getReviewByHotelId($_POST['hotel_id']);

        $this->renderPartial('_review',array(
            'review'=>$review,
        ));

    }

    public function actionFavorites()
    {
        if (isset(Yii::app()->session['hotelFavoriteId'])){


            if(isset($_POST['id']) && !in_array($_POST['id'], Yii::app()->session['hotelFavoriteId']) )
            {
                $hotel_id = Yii::app()->session['hotelFavoriteId'];
                $hotel_id[] = $_POST['id'];
                Yii::app()->session['hotelFavoriteId'] = $hotel_id;
                if (!empty(Yii::app()->session['hotelFavoriteId']))
                    echo 'Записалось';
                else
                    echo "не получилось, ищи ошибку";
            }
            elseif(isset($_POST['key']))
            {
                $a = Yii::app()->session['hotelFavoriteId'];
                unset($a[$_POST['key']]);
                Yii::app()->session['hotelFavoriteId'] = $a;
                if (!empty(Yii::app()->session['hotelFavoriteId']))
                {echo 'Удалили';}
                else
                {echo 'Все плохо, удаление не прошло :(';}
            }
            else
                echo 'Этот отель уже добавлен в избранное';
        }
        else
        {
            $hotel_id = Yii::app()->session['hotelFavoriteId'];
            $hotel_id[] = $_POST['id'];
            Yii::app()->session['hotelFavoriteId'] = $hotel_id;
            if (!empty(Yii::app()->session['hotelFavoriteId']))
                echo 'Записалось';
            else
                echo "не получилось, ищи ошибку";
        }

    }

    public function actionAddToBooking()
    {
        $room = Rooms::model()->getRoomById($_POST['id'], $_POST['timestamp']);
        $i = $_POST['i'];
        $this->renderPartial('_addtobooking',array(
            'room'=>$room,
            'i'=>$i,
        ));
    }

    public function actionBooking()
    {
        $data = array();
        parse_str($_POST['data'], $data);
        //print_r($data);

        $booking = new HotelBooking;
        if (!Yii::app()->user->isGuest)
        {
            $booking->user_id = Yii::app()->user->id;
        }
        $booking->hotel_id = $data['hotel_id'];
        $booking->surname = $data['booking_surname'];
        $booking->firstname = $data['booking_firstname'];
        $booking->wishes = $data['special_wishes'];
        $booking->phone = $data['booking_phone'];
        $booking->email = $data['booking_email'];
        $booking->contact_name = $data['booking_contact_name'];
        $booking->services = serialize($data['booking_services']);
        $booking->price = $data['total_price'];
        if(!$booking->save())
            print_r($booking->getErrors());

        for($i=0; $i < $_POST['i']; $i++)
        {
            $room = new HotelBookingRooms;
            $room->booking_id = $booking->id;
            $room->room_id = $data['room_id'.$i];
            $room->man = $data['man_num'.$i];
            $room->kid = $data['kid_num'.$i];
            $room->date_checkin = strtotime($data['date_checkin'.$i]);
            $room->date_checkout = strtotime($data['date_checkout'.$i]);
            $room->time_checkin = $data['time_checkin'.$i];
            $room->time_checkout = $data['time_checkout'.$i];
            $room->bed = $data['bed_type'.$i];
            $room->pay_type = $data['pay_type'.$i];
            $room->price = $data['room_price'.$i];
            $data['guest'] = array();
            for($k=0; $k<=count($data['guest_surname'.$i])-1; $k++)
            {
                $data['guest'][] = array(
                    0 => $data['guest_surname'.$i][$k],
                    1 => $data['guest_firstname'.$i][$k],
                    2 => $data['guest_familyname'.$i][$k],
                );
            }
            $room->guest = serialize($data['guest']);
            if(!$room->save())
                print_r($room->getErrors());
        }


        //print_r($data);

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