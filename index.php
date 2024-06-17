<?php

require_once 'vendor/autoload.php';
use App\{
    Radio,
    Select
};

$radio = new Radio('gender', 'male', true, ['class' => 'radio']);
$radio1 = new Radio(null,'femal', false, ['class' => 'radio']);

$select = new Select('country', ['us' => 'USA', 'ca' => 'Canada', 'cd' => 'Congo'], ['class' =>
'dropdown']);
echo $select->render();
echo $radio->render();
echo $radio1->render();
