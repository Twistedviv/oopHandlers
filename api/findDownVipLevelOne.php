<?php
    require_once "../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
use app\Dao\Impl\UserDaoImpl;

    $userId=$_GET['userId'];

    $userDownLevelOneVipList=(new UserDaoImpl)->findDownVipLevelOne($userId);
    $result = new Result(1,'请求成功',$userDownLevelOneVipList);

    echo $result->send();