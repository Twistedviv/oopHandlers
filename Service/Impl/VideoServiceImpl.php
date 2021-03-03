<?php

    namespace app\Service\Impl;

    require_once dirname(__FILE__)."/../VideoService.php";
    require_once dirname(__FILE__).'/../../Dao/Impl/VideoDaoImpl.php';
    require_once dirname(__FILE__)."/../../Common/Result.php";
    require_once dirname(__FILE__)."/../../Common/Common.php";

    use app\Common\Result;
    use app\Dao\Impl\VideoDaoImpl;
    use app\Service\VideoService;
    use app\Common\Common;

class VideoServiceImpl implements VideoService
{
    //dao层对象实例化
    private $videoDao;
    function __construct(){
        $this->videoDao=new VideoDaoImpl();
    }
    
    /**
     * @param $userId
     * @return $videoData
     */
    public function findVideoData($userId){
        //通过userId获取每个视频的id和描述
        $videoIdAndDesc=$this->videoDao->findVideoIdAndDescAndCreatetime($userId);
        $videoNumbers=count($videoIdAndDesc);
        //封装每条视频数据组合为数组
        $videoData=array();
        for($i=0;$i<$videoNumbers;$i++){
            $videoDesc=$videoIdAndDesc[$i]['video_desc'];
            $videoId=$videoIdAndDesc[$i]['id'];
            $create_time=$videoIdAndDesc[$i]['create_time'];
            $video=$this->videoDao->findVideoByVideoId($videoId);
            $videoUpNumbers=$video[0]['up_count'];
            //获取收藏数
            $videoLike=$this->videoDao->findVideoLikeList($videoId);
            $videoLikeNumbers=count($videoLike);
            //获取评论数
            $videoReply=$this->videoDao->findVideoReplyList($videoId);
            $videoReplyNumbers=count($videoReply);
            //获取分享数
            $videoShare=$this->videoDao->findVideoShareList($videoId);
            $videoShareNumbers=count($videoShare);

            $videoData[$i]=array('video_desc'=>$videoDesc,'create_time'=>$create_time,'upCount'=>$videoUpNumbers,'likeCount'=>$videoLikeNumbers,'replyCount'=>$videoReplyNumbers,'shareCount'=>$videoShareNumbers);
        }
        $result = new Result(1,'请求成功',$videoData);
        return $result->send();
    }

    /**
     * @param $userId
     * @return $videoList
     */
    public function findVideoListByUserId($userId){
        $video=$this->videoDao->findVideoByUserId($userId);
        $videoList=array();
        for($i=0;$i<count($video);$i++){
            $videoList[$i]=array('id'=>$video[$i]['id'],'video_desc'=>$video[$i]['video_desc'],'create_time'=>substr($video[$i]['create_time'],0,10),
                'video_poster_url'=>$video[$i]['video_poster_url'],'is_private'=>$video[$i]['is_private']);
        }
        $result = new Result(1,'请求成功',$videoList);
        return $result->send();
    }

    /**
     * @param $videoId
     * @return $videoMessage
     */
    public function findVideoMessage($videoId){
        $video=$this->videoDao->findVideoByVideoId($videoId);
        $videoMessage=array('video_tag'=>$video[0]['video_tag'],'video_desc'=>$video[0]['video_desc'],'video_poster_url'=>$video[0]['video_poster_url'],
            'is_private'=>$video[0]['is_private']);
        $result = new Result(1,'请求成功',$videoMessage);
        return $result->send();
    }



    /**
     * @param $userId
     * @param $coverName
     * @param $covertmp
     * @param $videoName
     * @param $videotmp
     * @param $label
     * @param $description
     * @param $isPrivate
     */
    public function uploadVideo($userId, $coverName, $covertmp,
                                $videoName, $videotmp, $label, $description, $isPrivate){
        //将上传文件移至目标文件夹中
        /**  $_FILES['coverFile']['error'] 错误信息
         * 0:文件上传成功<br/>
         * 1：超过了文件大小，在php.ini文件中设置<br/>
         * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
         * 3：文件只有部分被上传<br/>
         * 4：没有文件被上传<br/>
         * 5：上传文件大小为0
         */

        //上传封面
        if(move_uploaded_file($covertmp,dirname(__FILE__).'/../../../video/'.$userId.'_'.$coverName)){
            $cover=Common::API_URL.'/video/'.$userId.'_'.$coverName; //封面最后所在位置
        }
        else{
            $data_cover="错误信息: ".$_FILES['coverFile']['error'];
            $result = new Result(1,'封面上传失败',$data_cover);
            return $result->send();
        }

        //上传视频
        if(move_uploaded_file($videotmp,dirname(__FILE__).'/../../../video/'.$userId.'_'.$videoName)){
            $video=Common::API_URL.'/video/'.$userId.'_'.$videoName; //视频最后所在位置
        }
        else{
            $data_video="错误信息: ".$_FILES['videoFile']['error'];
            $result = new Result(1,'视频上传失败',$data_video);
            return $result->send();
        }

        //上传封面和视频无错误信息时上传成功
        $userNameAndHeadimage=$this->videoDao->findUserNameAndHeadimage($userId);
        $this->videoDao->insertVideo($userId, $userNameAndHeadimage, $cover, $video, $label, $description, $isPrivate);
        $result = new Result(1,'上传成功',"1");
        return $result->send();
    }

    /**
     * @param $videoId
     * @param $coverName
     * @param $desc
     * @param $tag
     * @param $isPrivate
     * @param $covertmp
     */
    public function updateVideoMessage($videoId, $coverName, $desc, $tag, $isPrivate, $covertmp){
        //查找userId
        $video=$this->videoDao->findVideoByVideoId($videoId);
        $userId=$video[0]['user_id'];
        //上传封面
        if(move_uploaded_file($covertmp,dirname(__FILE__).'/../../../video/'.$userId.'_'.$coverName)){
            $cover=Common::API_URL.'/video/'.$userId.'_'.$coverName; //封面最后所在位置
            $this->videoDao->updateVideoMessageByVideoId($videoId,$cover,$desc,$tag,$isPrivate);
            $result = new Result(1,'编辑成功',1);
            return $result->send();
        }
        else{
            $data_cover="错误信息: ".$_FILES['coverFile']['error'];
            $result = new Result(1,'封面上传失败',$data_cover);
            return $result->send();
        }
    }

    /**
     * @param $videoId
     * @return $res 更改video表delete字段值为1
     */
    public function deleteVideo($videoId){
        $res=$this->videoDao->deleteVideoByVideoId($videoId);
        $result = new Result(1,'删除成功',$res);
        return $result;
    }


    /**
     * @param $keyWord
     * @param $userId
     * @return $videoList '通过关键字筛选后的video数组 优先级 1.标签 2.描述'
     */
    public function findVideoListByKeyWord($keyWord, $userId){
        $videoList=array();
        //$idList=array();
        //查找符合条件的idList
        if($keyWord==""){
            $idList=$this->videoDao->findAllVideoId();
        }
        else{
            $videoIdByTag=$this->videoDao->findVideoIdByTag($keyWord);
            $videoIdByDesc=$this->videoDao->findVideoIdByDescExceptTag($keyWord);
            $idList=array_merge($videoIdByTag,$videoIdByDesc);
        }
        //判断idList是否为空
        if(!empty($idList)){
            //封装videoList
            for($i=0;$i<count($idList);$i++){
                $videoId=$idList[$i]['id'];
                $video=$this->videoDao->findVideoByVideoId($videoId);
                //获取收藏数
                $videoLike=$this->videoDao->findVideoLikeList($videoId);
                $likecount=count($videoLike);
                //获取评论数
                $videoReply=$this->videoDao->findVideoReplyList($videoId);
                $replycount=count($videoReply);
                //视频的上传者 $upId
                $upId=$video[0]['user_id'];
                //查找userId是否关注up
                $focus=$this->videoDao->findFocusList($upId, $userId);
                $isfocus=false;
                if(!empty($focus)) $isfocus=true;
                //查找userId是否收藏该userId
                $like=$this->videoDao->findLikeList($videoId, $userId);
                $islike=false;
                if(!empty($like)) $islike=true;
                //查找userId是否点赞该userId
                $up=$this->videoDao->findUpList($videoId, $userId);
                $isup=false;
                if(!empty($up)) $isup=true;
                $videoList[$i]=array('videoid'=>$videoId,'url'=>$video[0]['video_url'],'posterurl'=>$video[0]['video_poster_url'],
                    'videodesc'=>$video[0]['video_desc'],'uid'=>$upId,'uname'=>$video[0]['user_uname'],
                    'headimage'=>$video[0]['user_headimage_url'],'productid'=>$video[0]['product_id'],'publishtime'=>$video[0]['publishtime'],
                    'zancount'=>$video[0]['up_count'],'likecount'=>$likecount,'replycount'=>$replycount,
                    'isfocus'=>$isfocus,'islike'=>$islike,'iszan'=>$isup);
            }
        }

        $result = new Result(1,'请求成功',$videoList);
        return $result->send();
    }
}