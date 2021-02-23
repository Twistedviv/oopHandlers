<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];
    //粉丝列表
    $fanList=(new UserServiceImpl)->findFanList($userId);
    echo $fanList;



