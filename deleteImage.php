<?php
require_once __DIR__ . '/autoload.php';

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $img = new \Data\Image(\Data\Db::getInstance());
    $img->deleteName($name);
    unlink(__DIR__ . '/files/' . $name);
    header("Location: /upload.php");
}

