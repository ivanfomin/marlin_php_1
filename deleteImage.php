<?php
require_once __DIR__ . '/autoload.php';

if (isset($_GET['name'])) {
    \Data\Uploader::delete($_GET['name']);
}

