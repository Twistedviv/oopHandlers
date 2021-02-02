<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\VideoServiceImpl;

    $userId=$_GET['userId'];
    $video=(new VideoServiceImpl)->findVideoByUserId($userId);
    $videoList=null;
    for($i=0;$i<count($video);$i++){
        $videoList[$i]=array('id'=>$video[$i]['id'],'video_desc'=>$video[$i]['video_desc'],'create_time'=>substr($video[$i]['create_time'],0,10),
            'video_poster_url'=>$video[$i]['video_poster_url'],'is_private'=>$video[$i]['is_private']);
    }
    $result = new Result(1,'请求成功',$videoList);
    echo $result->send();