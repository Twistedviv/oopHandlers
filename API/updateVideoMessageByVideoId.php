<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";
    require_once "../Common/Result.php";
    require_once("../Common/Common.php");

    use app\Common\Result;
    use app\Service\Impl\VideoServiceImpl;
    use app\Common\Common;

    //获得视频id，封面，描述，标签，公开性
    $videoId=$_POST['videoId'];                     //视频id
    $coverName=$_FILES['coverFile']['name'];        //封面
    $covertmp=$_FILES['coverFile']['tmp_name'];
    $desc=$_POST['video_desc'];                     //描述
    $tag=$_POST['video_tag'];                       //标签
    $isPrivate=$_POST['video_isPrivate'];           //公开性

    //查找userId
    $video=(new VideoServiceImpl)->findVideoByVideoId($videoId);
    $userId=$video[0]['user_id'];
    //上传封面
    if(move_uploaded_file($covertmp,dirname(__FILE__).'/../../video/'.$userId.'_'.$coverName)){
        $cover=Common::API_URL.'/video/'.$userId.'_'.$coverName; //封面最后所在位置
        $videoList=(new VideoServiceImpl)->updateVideoMessageByVideoId($videoId,$cover,$desc,$tag,$isPrivate);
        $result = new Result(1,'编辑成功',1);
        echo $result->send();
    }
    else{
        $data_cover="错误信息: ".$_FILES['coverFile']['error'];
        $result = new Result(1,'封面上传失败',$data_cover);
        echo $result->send();
        $error=1;
    }


