<?php

    namespace app\Service\Impl;

    require_once dirname(__FILE__)."/../VideoService.php";
    require_once dirname(__FILE__).'/../../Dao/Impl/VideoDaoImpl.php';
    require_once dirname(__FILE__)."/../../Common/Result.php";

    use app\Common\Result;
    use app\Dao\Impl\VideoDaoImpl;
    use app\Service\VideoService;

class VideoServiceImpl implements VideoService
{
    /**
     * @param $userId
     * @retrun $userNameAndHeadimage 包含用户名及头像的数组
     */
    public function findUserNameAndHeadimage($userId){
        $userNameAndHeadimage=(new VideoDaoImpl())->findUserNameAndHeadimage($userId);
        return $userNameAndHeadimage;
    }

    /**
     * @param $userId
     * @param $userNameAndHeadimage
     * @param $cover
     * @param $video
     * @param $label
     * @param $description
     * @param $isPrivate
     * @return $res 实现插入
     */
    public function insertVideo($userId, $userNameAndHeadimage, $cover, $video, $label, $description, $isPrivate){
        $res=(new VideoDaoImpl())->insertVideo($userId, $userNameAndHeadimage, $cover, $video, $label, $description, $isPrivate);
        return $res;
    }

    /**
     * @param $userId
     * @return $videoList 视频
     */
    public function findVideoByUserId($userId){
        $videoList=(new VideoDaoImpl())->findVideoByUserId($userId);
        return $videoList;
    }

    /**
     * @param $videoId '视频id'
     * @return $videoMessage '视频信息'
     */
    public function findVideoByVideoId($videoId){
        $videoMessage=(new VideoDaoImpl())->findVideoByVideoId($videoId);
        return $videoMessage;
    }

    /**
     * @param $userId
     * @return $videoIdAndDescAndCreatetime 视频id和描述
     */
    public function findVideoIdAndDescAndCreatetime($userId){
        $videoIdAndDescAndCreatetime=(new VideoDaoImpl())->findVideoIdAndDescAndCreatetime($userId);
        return $videoIdAndDescAndCreatetime;
    }

    /**
     * @param $videoId
     * @return $videoLikeNumbers 视频收藏数
     */
    public function findVideoLikeNumbers($videoId){
        $videoLike=(new VideoDaoImpl())->findVideoLikeList($videoId);
        $videoLikeNumbers=count($videoLike);
        return $videoLikeNumbers;
    }

    /**
     * @param $videoId
     * @return $videoReplyNumbers 视频评论数
     */
    public function findVideoReplyNumbers($videoId){
        $videoReply=(new VideoDaoImpl())->findVideoReplyList($videoId);
        $videoReplyNumbers=count($videoReply);
        return $videoReplyNumbers;
    }

    /**
     * @param $videoId
     * @return $videoShareNumbers 视频分享数
     */
    public function findVideoShareNumbers($videoId){
        $videoShare=(new VideoDaoImpl())->findVideoShareList($videoId);
        $videoShareNumbers=count($videoShare);
        return $videoShareNumbers;
    }

    /**
     * @param $videoId
     * @return $res 更改video表delete字段值为1
     */
    public function deleteVideoByVideoId($videoId){
        $res=(new VideoDaoImpl())->deleteVideoByVideoId($videoId);
        return $res;
    }

    /**
     * @param $videoId
     * @param $poster
     * @param $desc
     * @param $tag
     * @param $isPrivate
     * @return $res 编辑视频信息 封面 描述 标签 公开性
     */
    public function updateVideoMessageByVideoId($videoId,$poster,$desc,$tag,$isPrivate){
        $res=(new VideoDaoImpl())->updateVideoMessageByVideoId($videoId,$poster,$desc,$tag,$isPrivate);
        return $res;
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
            $idList=(new VideoDaoImpl())->findAllVideoId();
        }
        else{
            $videoIdByTag=(new VideoDaoImpl())->findVideoIdByTag($keyWord);
            $videoIdByDesc=(new VideoDaoImpl())->findVideoIdByDescExceptTag($keyWord);
            $idList=array_merge($videoIdByTag,$videoIdByDesc);
        }
        //判断idList是否为空
        if(!empty($idList)){
            //封装videoList
            for($i=0;$i<count($idList);$i++){
                $videoId=$idList[$i]['id'];
                $video=(new VideoDaoImpl())->findVideoByVideoId($videoId);
                $likecount=(new VideoServiceImpl())->findVideoLikeNumbers($videoId);
                $replycount=(new VideoServiceImpl())->findVideoReplyNumbers($videoId);
                //视频的上传者 $upId
                $upId=$video[0]['user_id'];
                //查找userId是否关注up
                $focus=(new VideoDaoImpl())->findFocusList($upId, $userId);
                $isfocus=false;
                if(!empty($focus)) $isfocus=true;
                //查找userId是否收藏该userId
                $like=(new VideoDaoImpl())->findLikeList($videoId, $userId);
                $islike=false;
                if(!empty($like)) $islike=true;
                //查找userId是否点赞该userId
                $up=(new VideoDaoImpl())->findUpList($videoId, $userId);
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