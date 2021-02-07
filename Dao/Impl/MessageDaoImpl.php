<?php


namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;


class MessageDaoImpl
{
    /**
     * @param $userId
     * @return $notice 信息
     */
    public function findNoticeByUserId($userId){
        $sql="select * from mms_notice where receive_id=$userId";
        $db = new DB();
        $notice=$db ->execQuery($sql);
        return $notice;
    }

    /**
     * @param $noticeId
     * @return $content 内容
     */
    public function findContentByNoticeId($noticeId){
        $sql="select * from mms_notice_content where id=$noticeId";
        $db = new DB();
        $content=$db ->execQuery($sql);
        return $content;
    }

    /**
     * @param $Id
     * @return $res 编辑查看状态为已读
     */
    public function updateCheckedStatusById($Id){
        $sql="UPDATE mms_notice SET checked_status = 1 where $Id=id";
        $db = new DB();
        $res=$db ->execUpdate($sql);
        return $res;
    }
}