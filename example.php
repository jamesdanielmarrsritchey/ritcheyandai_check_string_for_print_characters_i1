<?php
$location = realpath(dirname(__FILE__));
require_once $location . '/function.php';
$str = "This is @ test!";
$return = analyzeStringContentWithBasicPunctuation($str);
var_dump($return);