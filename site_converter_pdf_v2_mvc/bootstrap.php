<?php

require('vendor/autoload.php');

use core\Route;
use core\MySQLDatabase;

$database = new MySQLDatabase();

Route::start();
