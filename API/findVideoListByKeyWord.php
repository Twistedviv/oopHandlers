<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";

    use app\Service\Impl\VideoServiceImpl;

    $userId=$_GET['userId'];
    $keyWord=$_GET['keyWord'];

    $videoList=(new VideoServiceImpl)->findVideoListByKeyWord($keyWord,$userId);
    echo $videoList;