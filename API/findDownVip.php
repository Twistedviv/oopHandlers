<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];

    //userDownLevelOneVipList
    $userDownLevelOneVipList=(new UserServiceImpl)->findDownVipLevelOne($userId);

    //userDownLevelTwoVipList
    $userDownLevelTwoVipList=(new UserServiceImpl)->findDownVipLevelTwo($userId);

    $userDownVipList=array('levelA'=>$userDownLevelOneVipList,'levelB'=>$userDownLevelTwoVipList);
    $result = new Result(1,'请求成功',$userDownVipList);
    echo $result->send();
