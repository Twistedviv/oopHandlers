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
     * @param $videoId
     * @param $poster
     * @param $desc
     * @param $tag
     * @param $isPrivate
     * @return $res 编辑视频信息 封面 描述 标签 公开性
     */
    public function updateVideoMessageByVideoId($videoId,$poster,$desc,$tag,$isPrivate);

    /**
     * @param $keyWord
     * @param $userId
     * @return $videoList '通过关键字筛选后的video数组 优先级 1.标签 2.描述'
     */
    public function findVideoListByKeyWord($keyWord, $userId);
}