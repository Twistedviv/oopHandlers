<?php

namespace app\Service\Impl;

require_once dirname(__FILE__).'/../../Dao/Impl/VideoDaoImpl.php';
use app\Dao\Impl\VideoDaoImpl;
require_once dirname(__FILE__)."/../VideoService.php";
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
     * @return $videoList 视频列表
     */
    public function getVideoListByUserId($userId){
        $videoList=(new VideoDaoImpl())->getVideoListByUserId($userId);
        return $videoList;
    }

    /**
     * @param $videoId '视频id'
     * @return $videoMessage '视频信息'
     */
    public function getVideoMessageByVideoId($videoId){
        $videoMessage=(new VideoDaoImpl())->getVideoMessageByVideoId($videoId);
        return $videoMessage;
    }

    /**
     * @param $userId
     * @return $videoIdAndDescAndCreatetime 视频id和描述
     */
    public function getVideoIdAndDescAndCreatetime($userId){
        $videoIdAndDescAndCreatetime=(new VideoDaoImpl())->getVideoIdAndDescAndCreatetime($userId);
        return $videoIdAndDescAndCreatetime;
    }

    /**
     * @param $userId
     * @return $videoUpNumbers 视频点赞数
     */
    public function getVideoUpNumbers($videoId){
        $videoUp=(new VideoDaoImpl())->getVideoUpList($videoId);
        $videoUpNumbers=count($videoUp);
        return $videoUpNumbers;
    }

    /**
     * @param $userId
     * @return $videoLikeNumbers 视频收藏数
     */
    public function getVideoLikeNumbers($videoId){
        $videoLike=(new VideoDaoImpl())->getVideoLikeList($videoId);
        $videoLikeNumbers=count($videoLike);
        return $videoLikeNumbers;
    }

    /**
     * @param $userId
     * @return $videoReplyNumbers 视频评论数
     */
    public function getVideoReplyNumbers($videoId){
        $videoReply=(new VideoDaoImpl())->getVideoReplyList($videoId);
        $videoReplyNumbers=count($videoReply);
        return $videoReplyNumbers;
    }

    /**
     * @param $videoId
     * @return $videoShareNumbers 视频分享数
     */
    public function getVideoShareNumbers($videoId){
        $videoShare=(new VideoDaoImpl())->getVideoShareList($videoId);
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
     * @param $videoId,$poster,$desc,$tag,$isPrivate
     * @return $res 编辑视频信息 封面 描述 标签 公开性
     */
    public function updateVideoMessageByVideoId($videoId,$poster,$desc,$tag,$isPrivate){
        $res=(new VideoDaoImpl())->updateVideoMessageByVideoId($videoId,$poster,$desc,$tag,$isPrivate);
        return $res;
    }

}