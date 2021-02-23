<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";

    use app\Service\Impl\VideoServiceImpl;

    $videoId=$_GET['videoId'];
    $videoMessage=(new VideoServiceImpl)->findVideoMessageByVideoId($videoId);
    echo $videoMessage;