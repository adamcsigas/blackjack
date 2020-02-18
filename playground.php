<?php

$suits = ["C","D","H","S"];
$ranks = ["A","2","3","4","5","6","7","8","9","10","J","Q","K"];


$card = array("suit" => "C", "rank" => "7", "value" => 7);

//print_r($card["suit"] . $card["rank"]);

// echo count($testDeck->cards,COUNT_RECURSIVE); count how many elements of object


//drawing cards idea
$listOfNum = [1,2,3,4,5,6,7,8];

$sam = [];
$dealer = [];

while(count($sam) <= 2 && count($dealer) < 2)
{
    //dealing cards
    if(count($sam) <= count($dealer))
    {
        array_push($sam,end($listOfNum));
    }else {
        array_push($dealer,end($listOfNum));
    }
    array_pop($listOfNum);

    if(array_sum($sam) >= 17){
        break;
    }
}

//print_r($sam);
//print_r($dealer);

$a = array(
    "one" => 1,
    "two" => 2,
    "three" => 3,
    "seventeen" => 17
);

    $sum = 0;
foreach ($a as $k => $v) {
    $sum += $v;
}
    echo $sum;
