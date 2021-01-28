<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\VideoServiceImpl;

    $userId=$_GET['userId'];
    //通过userId获取每个视频的id和描述
    $videoIdAndDesc=(new VideoServiceImpl)->getVideoIdAndDescAndCreatetime($userId);
    $videoNumbers=count($videoIdAndDesc);
    //封装每条视频数据组合为数组
    for($i=0;$i<$videoNumbers;$i++){
        $videoDesc=$videoIdAndDesc[$i]['video_desc'];
        $videoId=$videoIdAndDesc[$i]['id'];
        $create_time=$videoIdAndDesc[$i]['create_time'];
        $videoUpNumbers=(new VideoServiceImpl)->getVideoUpNumbers($videoId);
        $videoLikeNumbers=(new VideoServiceImpl)->getVideoLikeNumbers($videoId);
        $videoReplyNumbers=(new VideoServiceImpl)->getVideoReplyNumbers($videoId);
        $videoShareNumbers=(new VideoServiceImpl)->getVideoShareNumbers($videoId);
        $videoData[$i]=array('video_desc'=>$videoDesc,'create_time'=>$create_time,'upCount'=>$videoUpNumbers,'likeCount'=>$videoLikeNumbers,'replyCount'=>$videoReplyNumbers,'shareCount'=>$videoShareNumbers);
    }
    $result = new Result(1,'请求成功',$videoData);
    echo $result->send();