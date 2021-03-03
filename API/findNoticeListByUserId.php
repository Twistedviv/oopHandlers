<?php
    require_once dirname(__FILE__)."/../Service/Impl/MessageServiceImpl.php";

    use app\Service\Impl\MessageServiceImpl;

    $userId=$_GET['userId'];
    $contentList=(new MessageServiceImpl)->findNoticeList($userId);
    echo $contentList;