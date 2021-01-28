<?php


namespace app\Service;


interface VideoService
{
    /**
     * @param $userId
     * @retrun $userNameAndHeadimage 包含用户名及头像的数组
     */
    public function findUserNameAndHeadimage($userId);

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
    public function insertVideo($userId, $userNameAndHeadimage, $cover, $video, $label, $description, $isPrivate);

    /**
     * @param $userId
     * @return $videoList 视频列表
     */
    public function getVideoList($userId);

    /**
     * @param $userId
     * @return $videoIdAndDescAndCreatetime 视频id和描述和上传时间
     */
    public function getVideoIdAndDescAndCreatetime($userId);

    /**
     * @param $userId
     * @return $videoUpNumbers 视频点赞数
     */
    public function getVideoUpNumbers($videoId);

    /**
     * @param $userId
     * @return $videoLikeNumbers 视频收藏数
     */
    public function getVideoLikeNumbers($videoId);

    /**
     * @param $userId
     * @return $videoReplyNumbers 视频评论数
     */
    public function getVideoReplyNumbers($videoId);

    /**
     * @param $userId
     * @return $videoShareNumbers 视频分享数
     */
    public function getVideoShareNumbers($videoId);
}