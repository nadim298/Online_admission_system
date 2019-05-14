<?php

require "FaceDetector.php";


use svay\FaceDetector;


$faceDetect = new FaceDetector();
$faceDetect->faceDetect($_FILES['image']['tmp_name']);
$faceDetect->toJpeg();