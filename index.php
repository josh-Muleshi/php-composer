<?php

require_once 'class/Select.php';
require_once 'class/Radio.php';

$radio = new Radio('gender', 'male', true, ['class' => 'radio']);
$radio1 = new Radio(null,'femal', false, ['class' => 'radio']);

$select = new Select('country', ['us' => 'USA', 'ca' => 'Canada', 'cd' => 'Congo'], ['class' =>
'dropdown']);
echo $select->render();
echo $radio->render();
echo $radio1->render();
