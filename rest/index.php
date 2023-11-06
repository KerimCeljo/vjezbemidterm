<?php

require "../vendor/autoload.php";
require "./services/MidtermService.php";
//require 'dao/MidtermDao.php';

Flight::register('midtermService', 'MidtermService');
//Flight::register('midterm_dao',"MidtermDao");

Flight::route('/kerim', function(){
    echo 'hello world!';
});


function funkcija(){

    echo "hello kerim";
};

Flight::route('/', 'funkcija');

require 'routes/MidtermRoutes.php';

Flight::start();
 ?>
