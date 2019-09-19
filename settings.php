<?php

$fileName = 'users.json';
$jsonFile = file_get_contents($fileName);
$userArray = json_decode($jsonFile, true);

$appTitle = "Trailblazers App";
?>