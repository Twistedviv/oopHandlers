<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\VideoServiceImpl;
    //获得视频id，封面，描述，标签，公开性
    $videoId=$_GET['videoId'];
    $poster=$_GET['video_poster'];
    $desc=$_GET['video_desc'];
    $tag=$_GET['video_tag'];
    $isPrivate=$_GET['video_isPrivate'];

    $videoList=(new VideoServiceImpl)->updateVideoMessageByVideoId($videoId,$poster,$desc,$tag,$isPrivate);
    $result = new Result(1,'编辑成功',1);
    echo $result->send();