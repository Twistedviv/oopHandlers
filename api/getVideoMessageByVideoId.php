<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\VideoServiceImpl;

    $videoId=$_GET['videoId'];
    $videoList=(new VideoServiceImpl)->getVideoMessageByVideoId($videoId);
    $result = new Result(1,'请求成功',$videoList);
    echo $result->send();