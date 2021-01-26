<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];

    $userDownLevelTwoVipList=(new UserServiceImpl)->findDownVipLevelTwo($userId);
    $result = new Result(1,'请求成功',$userDownLevelTwoVipList);

    echo $result->send();