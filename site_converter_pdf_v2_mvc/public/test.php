<?php

require '../vendor/autoload.php';

use models\MySQLDatabase;
use models\Session;
use models\Document;
use models\Image;

$database = new MySQLDatabase();
$session = new Session();
$message = $session->message();
$errors = $session->errors();

$document = Document::findById(175);
$document->destroy();

if (isset($database)) {
    $database->closeConnection();
}
