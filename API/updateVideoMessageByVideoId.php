<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";

    use app\Service\Impl\VideoServiceImpl;

    //获得视频id，封面，描述，标签，公开性
    $videoId=$_POST['videoId'];                     //视频id
    $coverName=$_FILES['coverFile']['name'];        //封面
    $covertmp=$_FILES['coverFile']['tmp_name'];
    $desc=$_POST['video_desc'];                     //描述
    $tag=$_POST['video_tag'];                       //标签
    $isPrivate=$_POST['video_isPrivate'];           //公开性

    $result=(new VideoServiceImpl)->updateVideoMessage($videoId,$coverName,$desc,$tag,$isPrivate,$covertmp);
    echo $result;


