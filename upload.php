<?php

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/functions.php';

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        img {
            width: 100px;
            height: auto;
        }
    </style>
    <title>Document</title>
</head>
<body>
<?php
$name = 'myFile';
$uploader = new \Uploader($name);

$num = 1;   //image number
$images = arrFiles(__DIR__ . '/files');
foreach ($images as $image) {
    ?>
    <li>
        <img src="files/<?php echo $image; ?>">
        <a href="deleteImage.php?name=<?php echo $image; ?>">Delete</a>
    </li>
    <?php
}
?>

<form method="post" action="<?php $uploader->upload(); ?>" enctype="multipart/form-data">
    <input type="file" name=<?php echo $name; ?>>
    <input type="submit">
</form>
</body>
</html>
