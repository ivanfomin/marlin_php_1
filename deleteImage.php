<?php
require_once __DIR__ . '/autoload.php';

if (isset($_GET['name'])) {
    \Uploader::delete($_GET['name']);
}

