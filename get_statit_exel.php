<?php 
require 'class/db.php';
var_dump($_POST);
var_dump($connection->sesson_static2($_POST['date_start'],$_POST['date_end']));