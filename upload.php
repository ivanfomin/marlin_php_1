<?php

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/functions.php';

if (isset($_FILES['myFile'])) {
    if (0 == $_FILES['myFile']['error']) {
        move_uploaded_file($_FILES['myFile']['tmp_name'],
            __DIR__ . '/files/' . $_FILES['myFile']['name']
        );
        
        $image = new \Data\Image(\Data\Db::getInstance());
        
        $image->setName($_FILES['myFile']['name']);
        
        $image->save();
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);