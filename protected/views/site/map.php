<div class="page-content">
    <div class="news-view centrified">
<?php
Yii::import('ext.EGMap.*');

$gMap = new EGMap();
$gMap->setWidth(800);
$gMap->setHeight(600);
$gMap->zoom = 10;
$mapTypeControlOptions = array(
    'position' => EGMapControlPosition::RIGHT_TOP,
    'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
);

$gMap->mapTypeId = EGMap::TYPE_ROADMAP;
$gMap->mapTypeControlOptions = $mapTypeControlOptions;

$mapTypeControlOptions = array(
    'position'=> EGMapControlPosition::LEFT_BOTTOM,
    'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
);

$gMap->mapTypeControlOptions= $mapTypeControlOptions;

$gMap->setCenter(59.939536, 30.312174);
/*
59.941815, 30.283972
59.946028, 30.363022
59.926291, 30.339333
 */


// Create GMapInfoWindows
$info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
$info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');

$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/home.png");

$icon->setSize(32, 37);
$icon->setAnchor(16, 16.5);
$icon->setOrigin(0, 0);


// Create markers
foreach ($markers as $m)
{
    if ($m['stars'] == 5)
    {
        $marker = new EGMapMarker($m['lng'], $m['lat'], array('title' => 'Marker With Custom Image','icon'=>$icon, 'zIndex'=>5));
    }
    elseif ($m['stars'] == 4)
    {
        $marker = new EGMapMarker($m['lng'], $m['lat'], array('title' => 'Marker With Custom Image','icon'=>$icon, 'zIndex'=>4));
    }
    elseif ($m['stars'] == 3)
    {
        $marker = new EGMapMarker($m['lng'], $m['lat'], array('title' => 'Marker With Custom Image','icon'=>$icon, 'zIndex'=>3));
    }
    $info_window_a = new EGMapInfoWindow('<div>Отель '.$m['name'].'</div>');
    $marker->addHtmlInfoWindow($info_window_a);
    $gMap->addMarker($marker);
}


// enabling marker clusterer just for fun
// to view it zoom-out the map
//$gMap->enableMarkerClusterer(new EGMapMarkerClusterer());

$gMap->renderMap();
?>
        <script>
            $(document).ready(function () {
                function toggleGroup() {
                    var marker = EGMapMarker2;
                    if (marker.isHidden()) {
                        marker.show();
                    } else {
                        marker.hide();
                    }
                }
            });
        </script>
        <div id="panel">
            <input onclick="showOverlays(markers5);" type=button value="5 звезд">
            <input onclick="showOverlays(markers4);" type=button value="4 звезд">
            <input onclick="showOverlays(markers3)" type=button value="3 звезды">
            <input onclick="clearOverlays();" type=button value="Скрыть все">
            <input onclick="showOverlays();" type=button value="Показать все">
        </div>
    </div>
</div>
