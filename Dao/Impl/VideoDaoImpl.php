<?php

namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;

class VideoDaoImpl
{
    //DB对象实例化
    private $db;
    function __construct(){
        $this->db=new DB();
    }
    
    /**
     * @param $userId
     * @retrun $userNameAndHeadimage 包含用户名及头像的数组
     */
    public function findUserNameAndHeadimage($userId){
        $sql="select uname,headimage_url from ums_user where $userId=id";
        $userNameAndHeadimage=$this->db ->execQuery($sql);
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
        $sql="insert into cms_video(video_url,video_poster_url,video_desc,user_id,user_uname,user_headimage_url,
              product_id,video_spec,video_tag,is_private) values ('$video','$cover','$description','$userId','$userName',
              '$Headimage','0','2','$label','$isPrivate')";
        $res=$this->db ->execUpdate($sql);
        return $res;
    }

    /**
     * @param $userId
     * @return $videoList 视频列表
     */
    public function findVideoByUserId($userId){
        $sql="select * from cms_video where $userId=user_id and delete_status=0";
        $video=$this->db ->execQuery($sql);
        return $video;
    }

    /**
     * @param $videoId '视频id'
     * @return $videoMessage '视频信息'
     */
    public function findVideoByVideoId($videoId){
        $sql="select * from cms_video where $videoId=id and delete_status=0";
        $videoMessage=$this->db ->execQuery($sql);
        return $videoMessage;
    }

    /**
     * @param $userId
     * @return $videoIdAndDescAndCreatetime 视频id和描述和上传时间
     */
    public function findVideoIdAndDescAndCreatetime($userId){
        $sql="select id,video_desc,SUBSTRING(create_time,1,10) create_time from cms_video where $userId=user_id and delete_status = 0";
        $videoList=$this->db ->execQuery($sql);
        return $videoList;
    }

    /**
     * @param $videoId
     * @return $videoLikeList 视频收藏数组
     */
    public function findVideoLikeList($videoId){
        $sql="select * from cms_video_like where $videoId=video_id";
        $videoLikeList=$this->db ->execQuery($sql);
        return $videoLikeList;
    }

    /**
     * @param $videoId
     * @return $videoReplyList 视频评论数组
     */
    public function findVideoReplyList($videoId){
        $sql="select * from cms_video_reply where $videoId=video_id";
        $videoReplyList=$this->db ->execQuery($sql);
        return $videoReplyList;
    }

    /**
     * @param $videoId
     * @return $videoShareList 视频分享数组
     */
    public function findVideoShareList($videoId){
        $sql="select * from cms_video_share where $videoId=video_id";
        $videoShareList=$this->db ->execQuery($sql);
        return $videoShareList;
    }

    /**
     * @param $videoId
     * @return $res 更改video表delete字段值为1 updateVideoMessageByVideoId
     */
    public function deleteVideoByVideoId($videoId){
        $sql="UPDATE cms_video SET delete_status=1 where $videoId=id";
        $res=$this->db ->execUpdate($sql);
        return $res;
    }

    /**
     * @param $videoId,$poster,$desc,$tag,$isPrivate
     * @return $res 编辑视频信息 封面 描述 标签 公开性
     */
    public function updateVideoMessageByVideoId($videoId,$poster,$desc,$tag,$isPrivate){
        $sql="UPDATE cms_video SET video_poster_url= '$poster',video_desc= '$desc',video_tag= '$tag',is_private= '$isPrivate' where $videoId=id";
        $res=$this->db ->execUpdate($sql);
        return $res;
    }

    /**
     * @param $keyWord
     * @retun $videoIdListByTag
     */
    public function findVideoIdByTag($keyWord){
        $sql="select id from cms_video where video_tag like '%$keyWord%' and delete_status = 0";
        $res=$this->db ->execQuery($sql);
        return $res;
    }

    /**
     * @param $keyWord
     * @retun $videoIdListByDesc
     */
    public function findVideoIdByDescExceptTag($keyWord){
        $sql="select id from cms_video where delete_status = 0 and video_desc like '%$keyWord%' and
            id not in (select id from cms_video where video_tag like '%$keyWord%')";
        $res=$this->db ->execQuery($sql);
        return $res;
    }

    /**
     * @return $allVideoId
     */
    public function findAllVideoId(){
        $sql="select id from cms_video where delete_status = 0";
        $res=$this->db ->execQuery($sql);
        return $res;
    }

    /**
     * @param $upId
     * @param $userId
     * @return $focusList 关注表中的对应数据
     */
    public function findFocusList($upId, $userId){
        $sql="select * from ums_video_focus where focused_user_id=$upId and focus_user_id=$userId";
        $res=$this->db ->execQuery($sql);
        return $res;
    }

    /**
     * @param $video
     * @param $userId
     * @return $likeList 收藏表中的对应数据
     */
    public function findLikeList($videoId, $userId){
        $sql="select * from cms_video_like where video_id=$videoId and user_id=$userId";
        $res=$this->db ->execQuery($sql);
        return $res;
    }

    /**
     * @param $video
     * @param $userId
     * @return $upList 点赞表中的对应数据
     */
    public function findUpList($videoId, $userId){
        $sql="select * from cms_video_up where video_id=$videoId and user_id=$userId";
        $res=$this->db ->execQuery($sql);
        return $res;
    }

}