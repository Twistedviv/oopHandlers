<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";

    use app\Service\Impl\VideoServiceImpl;

    $videoId=$_POST['videoId'];
    $result=(new VideoServiceImpl)->deleteVideoByVideoId($videoId);
    echo $result->send();