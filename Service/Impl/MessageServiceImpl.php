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
    //dao层对象实例化
    private $messageDao;
    function __construct(){
        $this->messageDao=new MessageDaoImpl();
    }

    /**
     * @param $userId
     * @return $contentList 站内信 消息列表
     */
    public function findNoticeList($userId){
        $noticeList=array();
        $notice=$this->messageDao->findNoticeByUserId($userId);
        for($i=0;$i<count($notice);$i++){
            $noticeId=$notice[$i]['notice_content_id'];
            $content=$this->messageDao->findContentByNoticeId($noticeId);

            $noticeList[$i]=array(
                'id'=>$notice[$i]['id'],
                'createTime'=>substr($notice[$i]['create_time'],5,5),
                'title'=>$content[0]['title'],
                'text'=>$content[0]['text'],
                'checkedStatus'=>$notice[$i]['checked_status'],
                'imageUrl'=>$content[0]['image_url'],
                'navigateUrl'=>$content[0]['navigate_url']);
        }
        $result = new Result(1,'请求成功',$noticeList);
        return $result->send();
    }

    /**
     * @param $Id
     * @return $res 编辑成功
     */
    public function updateCheckedStatus($Id){
        $res=$this->messageDao->updateCheckedStatusById($Id);
        $result = new Result(1,'编辑成功',$res);
        return $result->send();
    }

}