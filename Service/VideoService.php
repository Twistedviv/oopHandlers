<?php


namespace app\Service;


interface VideoService
{
    /**
     * @param $userId
     * @return $videoData
     */
    public function findVideoData($userId);

    /**
     * @param $userId
     * @return $videoList
     */
    public function findVideoListByUserId($userId);

    /**
     * @param $videoId
     * @return $videoMessage
     */
    public function findVideoMessage($videoId);

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
                                $videoName, $videotmp, $label, $description, $isPrivate);

    /**
     * @param $videoId
     * @param $coverName
     * @param $desc
     * @param $tag
     * @param $isPrivate
     * @param $covertmp
     */
    public function updateVideoMessage($videoId, $coverName, $desc, $tag, $isPrivate, $covertmp);

    /**
     * @param $videoId
     * @return $res 更改video表delete字段值为1
     */
    public function deleteVideo($videoId);

    /**
     * @param $keyWord
     * @param $userId
     * @return $videoList '通过关键字筛选后的video数组 优先级 1.标签 2.描述'
     */
    public function findVideoListByKeyWord($keyWord, $userId);


}