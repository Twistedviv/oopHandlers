<?php

namespace app\Service\Impl;

require_once dirname(__FILE__).'/../../Dao/Impl/MessageDaoImpl.php';
require_once dirname(__FILE__)."/../MessageService.php";
require_once dirname(__FILE__)."/../../Common/Result.php";

use app\Common\Result;
use app\Service\MessageService;
use app\Dao\Impl\MessageDaoImpl;

class MessageServiceImpl implements MessageService
{
    /**
     * @param $userId
     * @return $contentList 站内信 消息列表
     */
    public function findNoticeListByUserId($userId){
        $noticeList=array();
        $notice=(new MessageDaoImpl())->findNoticeByUserId($userId);
        for($i=0;$i<count($notice);$i++){
            $noticeId=$notice[$i]['notice_content_id'];
            $content=(new MessageDaoImpl())->findContentByNoticeId($noticeId);

            $noticeList[$i]=array('id'=>$notice[$i]['id'],'createTime'=>$notice[$i]['create_time'],
                                'title'=>$content[0]['title'],'text'=>$content[0]['text'],
                                'imageUrl'=>$content[0]['image_url'],'navigateUrl'=>$content[0]['navigate_url']);
        }
        $result = new Result(1,'请求成功',$noticeList);
        return $result->send();
    }

    /**
     * @param $Id
     * @return $res 编辑成功
     */
    public function updateCheckedStatusById($Id){
        $res=(new MessageDaoImpl())->updateCheckedStatusById($Id);
        $result = new Result(1,'编辑成功',$res);
        return $result->send();
    }

}