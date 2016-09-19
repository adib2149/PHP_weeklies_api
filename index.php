<?php
header("Access-Control-Allow-Origin: *");

$response = array();

// helper function
// get data from url
function getAndProcessData($url, $color) {

    global $response;

    $xml = simplexml_load_file($url);

    $title = (string) $xml->channel->item[0]->title;
    $link = (string) $xml->channel->item[0]->link;
    $pubDate = (string) $xml->channel->item[0]->pubDate;
    $allWeeklies = str_replace("feed","home",$url);

    $data['title'] = $title;
    $data['link'] = $link;
    $data['pubDate'] = date("d M, Y", strtotime($pubDate));
    $data['allWeeklies'] = $allWeeklies;
    $data['color'] = $color;

    array_push($response, $data);
}


// get ANDROID WEEKLIES data
$androidWeeklyUrl = "http://us2.campaign-archive1.com/feed?u=887caf4f48db76fd91e20a06d&id=4eb677ad19";
getAndProcessData($androidWeeklyUrl, 'green');

// get KOTLIN WEEKLIES data
$kotlinWeeklyUrl = "http://us12.campaign-archive1.com/feed?u=f39692e245b94f7fb693b6d82&id=93b2272cb6";
getAndProcessData($kotlinWeeklyUrl, 'light-blue');


echo json_encode($response);
