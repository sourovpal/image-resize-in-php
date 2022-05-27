<?php

function imageResize($tmp, $w, $h)
{
    $getImageSize = getimagesize($tmp);
    list($width, $height) = $getImageSize;
    $extExplodeArray = explode('/', $getImageSize['mime']);
    $getExtention = end($extExplodeArray);
    if($getExtention == 'jpg' || $getExtention == 'jpeg')
    {
        $original = imagecreatefromjpeg($tmp);
    }
    else if($getExtention == 'png')
    {
        $original = imagecreatefrompng($tmp);
    }
    else if($getExtention == 'webp')
    {
        $original = imagecreatefromwebp($tmp);
    }
    else
    {
        return false;
    }
    $resized = imagecreatetruecolor($w, $h);
    imagecopyresampled($resized, $original, 0, 0, 0, 0, $w, $h, $width , $height);
    return $resized;
}


$img = imageResize($_FILES['image']['tmp_name'], 180, 100);
$imgName = 'test.webp';
$uploadPath = '/gallery/product/'.$imgName;
imagewebp($img, $uploadPath, 100);