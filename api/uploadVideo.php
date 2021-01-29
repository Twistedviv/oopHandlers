<?php
    require_once dirname(__FILE__)."/../Service/Impl/VideoServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\VideoServiceImpl;

    $userId=$_POST['uid'];                          //uid
    $coverName=$_FILES['coverFile']['name'];        //封面
    $covertmp=$_FILES['coverFile']['tmp_name'];
    $videoName = $_FILES['videoFile']['name'];      //视频
    $videotmp = $_FILES['videoFile']['tmp_name'];
    $label=$_POST['label'];                         //标签
    $description=$_POST['description'];             //视频描述
    $isPrivate=$_POST['is_private'];                //可见性

    //将上传文件移至目标文件夹中
    /**  $_FILES['coverFile']['error'] 错误信息
    * 0:文件上传成功<br/>
    * 1：超过了文件大小，在php.ini文件中设置<br/>
    * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
    * 3：文件只有部分被上传<br/>
    * 4：没有文件被上传<br/>
    * 5：上传文件大小为0
    */
    $error=0;               //定义错误变量

    //上传封面
    if(move_uploaded_file($covertmp,dirname(__FILE__).'/../../video/'.$coverName)){
        $cover='http://api.equnshang.com/video/'.$coverName; //封面最后所在位置
    }
    else{
        $data_cover="错误信息: ".$_FILES['coverFile']['error'];
        $result = new Result(1,'封面上传失败',$data_cover);
        echo $result->send();
        $error=1;
    }

    //上传视频
    if(move_uploaded_file($videotmp,dirname(__FILE__).'/../../video/'.$videoName)){
        $video='http://api.equnshang.com/video/'.$videoName; //视频最后所在位置
    }
    else{
        $data_video="错误信息: ".$_FILES['videoFile']['error'];
        $result = new Result(1,'视频上传失败',$data_video);
        echo $result->send();
        $error=1;
    }
    if($error==0){
        $userNameAndHeadimage=(new VideoServiceImpl)->findUserNameAndHeadimage($userId);
        $res=(new VideoServiceImpl)->insertVideo($userId, $userNameAndHeadimage, $cover, $video, $label, $description, $isPrivate);
        $result = new Result(1,'上传成功',"1");
        echo $result->send();
    }
