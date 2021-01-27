<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\VideoServiceImpl;

    $userId=$_GET['userId'];
    $videoList=(new VideoServiceImpl)->getVideoList($userId);
    $result = new Result(1,'请求成功',$videoList);
    echo $result->send();