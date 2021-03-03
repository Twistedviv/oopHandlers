<?php


namespace app\Service;


interface MessageService
{
    /**
     * @param $userId
     * @return $contentList 站内信 消息列表
     */
    public function findNoticeList($userId);

    /**
     * @param $Id
     * @return $res 编辑成功
     */
    public function updateCheckedStatus($Id);
}