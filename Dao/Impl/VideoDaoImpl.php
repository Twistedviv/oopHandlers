<?php

namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;

class VideoDaoImpl
{
    /**
     * @param $userId
     * @retrun $userNameAndHeadimage 包含用户名及头像的数组
     */
    public function findUserNameAndHeadimage($userId){
        $sql="select uname,headimage_url from ums_user where $userId=id";
        $db = new DB();
        $userNameAndHeadimage=$db ->execQuery($sql);
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
        $userName=$userNameAndHeadimage[0]['uname'];
        $Headimage=$userNameAndHeadimage[0]['headimage_url'];
        //echo "\r\n".$userName.$Headimage."\r\n";
        $sql="insert into cms_video(video_url,video_poster_url,video_desc,user_id,user_uname,user_headimage_url,
              product_id,video_spec,video_tag,is_private) values ('$video','$cover','$description','$userId','$userName',
              '$Headimage','0','2','$label','$isPrivate')";
        $db = new DB();
        $res=$db ->execUpdate($sql);
        return $res;
    }

    /**
     * @param $userId
     * @return $videoList 视频列表
     */
    public function getVideoListByUserId($userId){
        $sql="select id,video_desc,SUBSTRING(create_time,1,10) create_time,video_poster_url,is_private from cms_video where $userId=user_id and delete_status=0";
        $db = new DB();
        $videoList=$db ->execQuery($sql);
        return $videoList;
    }

    /**
     * @param $videoId '视频id'
     * @return $videoMessage '视频信息'
     */
    public function getVideoMessageByVideoId($videoId){
        $sql="select video_tag,video_desc,video_poster_url,is_private from cms_video where $videoId=id and delete_status=0";
        $db = new DB();
        $videoMessage=$db ->execQuery($sql);
        return $videoMessage;
    }

    /**
     * @param $userId
     * @return $videoIdAndDescAndCreatetime 视频id和描述和上传时间
     */
    public function getVideoIdAndDescAndCreatetime($userId){
        $sql="select id,video_desc,SUBSTRING(create_time,1,10) create_time from cms_video where $userId=user_id and delete_status = 0";
        $db = new DB();
        $videoList=$db ->execQuery($sql);
        return $videoList;
    }

    /**
     * @param $videoId
     * @return $videoUpList 视频点赞数组
     */
    public function getVideoUpList($videoId){
        $sql="select * from cms_video_up where $videoId=video_id";
        $db = new DB();
        $videoUpList=$db ->execQuery($sql);
        return $videoUpList;
    }

    /**
     * @param $videoId
     * @return $videoLikeList 视频收藏数组
     */
    public function getVideoLikeList($videoId){
        $sql="select * from cms_video_like where $videoId=video_id";
        $db = new DB();
        $videoLikeList=$db ->execQuery($sql);
        return $videoLikeList;
    }

    /**
     * @param $videoId
     * @return $videoReplyList 视频评论数组
     */
    public function getVideoReplyList($videoId){
        $sql="select * from cms_video_reply where $videoId=video_id";
        $db = new DB();
        $videoReplyList=$db ->execQuery($sql);
        return $videoReplyList;
    }

    /**
     * @param $videoId
     * @return $videoShareList 视频分享数组
     */
    public function getVideoShareList($videoId){
        $sql="select * from cms_video_share where $videoId=video_id";
        $db = new DB();
        $videoShareList=$db ->execQuery($sql);
        return $videoShareList;
    }

    /**
     * @param $videoId
     * @return $res 更改video表delete字段值为1 updateVideoMessageByVideoId
     */
    public function deleteVideoByVideoId($videoId){
        $sql="UPDATE cms_video SET delete_status=1 where $videoId=id";
        $db = new DB();
        $res=$db ->execUpdate($sql);
        return $res;
    }

    /**
     * @param $videoId,$poster,$desc,$tag,$isPrivate
     * @return $res 编辑视频信息 封面 描述 标签 公开性
     */
    public function updateVideoMessageByVideoId($videoId,$poster,$desc,$tag,$isPrivate){
        $sql="UPDATE cms_video SET video_poster_url= '$poster',video_desc= '$desc',video_tag= '$tag',is_private= '$isPrivate' where $videoId=id";
        $db = new DB();
        $res=$db ->execUpdate($sql);
        return $res;
    }
}