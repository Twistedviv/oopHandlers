<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];

    $userDownLevelOneVipList=(new UserServiceImpl)->findDownVipLevelOne($userId);
    $result = new Result(1,'请求成功',$userDownLevelOneVipList);

    echo $result->send();