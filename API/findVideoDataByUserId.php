<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";

    use app\Service\Impl\VideoServiceImpl;

    $userId=$_GET['userId'];
    $videoData=(new VideoServiceImpl)->findVideoDataByUserId($userId);
    echo $videoData;
