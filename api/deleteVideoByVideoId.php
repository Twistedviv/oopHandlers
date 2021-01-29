<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\VideoServiceImpl;

    $videoId=$_GET['videoId'];
    $videoList=(new VideoServiceImpl)->deleteVideoByVideoId($videoId);
    $result = new Result(1,'删除成功',1);
    echo $result->send();