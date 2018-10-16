<?php
require_once __DIR__ . '/autoload.php';

if (isset($_GET['name'])) {
    \Data\Uploader::deleteImg($_GET['name']);
}

