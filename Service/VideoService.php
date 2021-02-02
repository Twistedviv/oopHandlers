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
     * @return $videoList 视频
     */
    public function findVideoByUserId($userId);

    /**
     * @param $videoId '视频id'
     * @return $videoMessage '视频信息'
     */
    public function findVideoByVideoId($videoId);

    /**
     * @param $userId
     * @return $videoIdAndDescAndCreatetime 视频id和描述和上传时间
     */
    public function findVideoIdAndDescAndCreatetime($userId);

    /**
     * @param $videoId
     * @return $videoUpNumbers 视频点赞数
     */
    public function findVideoUpNumbers($videoId);

    /**
     * @param $videoId
     * @return $videoLikeNumbers 视频收藏数
     */
    public function findVideoLikeNumbers($videoId);

    /**
     * @param $videoId
     * @return $videoReplyNumbers 视频评论数
     */
    public function findVideoReplyNumbers($videoId);

    /**
     * @param $videoId
     * @return $videoShareNumbers 视频分享数
     */
    public function findVideoShareNumbers($videoId);


    /**
     * @param $videoId
     * @return $res 更改video表delete字段值为1
     */
    public function deleteVideoByVideoId($videoId);

    /**
     * @param $videoId,$poster,$desc,$tag,$isPrivate
     * @return $res 编辑视频信息:封面 描述 标签 公开性
     */
    public function updateVideoMessageByVideoId($videoId,$poster,$desc,$tag,$isPrivate);
}