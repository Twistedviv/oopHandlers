<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";

    use app\Service\Impl\VideoServiceImpl;

    $userId=$_POST['uid'];                          //uid
    $coverName=$_FILES['coverFile']['name'];        //封面
    $covertmp=$_FILES['coverFile']['tmp_name'];
    $videoName = $_FILES['videoFile']['name'];      //视频
    $videotmp = $_FILES['videoFile']['tmp_name'];
    $label=$_POST['label'];                         //标签
    $description=$_POST['description'];             //视频描述
    $isPrivate=$_POST['is_private'];                //可见性

    $result=(new VideoServiceImpl)->uploadVideo($userId,$coverName,$covertmp,$videoName,$videotmp,$label,$description,$isPrivate);
    echo $result;


