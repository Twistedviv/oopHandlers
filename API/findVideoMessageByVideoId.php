<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\VideoServiceImpl;

    $videoId=$_GET['videoId'];
    $video=(new VideoServiceImpl)->findVideoByVideoId($videoId);
    $videoMessage=array('video_tag'=>$video[0]['video_tag'],'video_desc'=>$video[0]['video_desc'],'video_poster_url'=>$video[0]['video_poster_url'],
        'is_private'=>$video[0]['is_private']);
    $result = new Result(1,'请求成功',$videoMessage);
    echo $result->send();