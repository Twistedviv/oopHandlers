<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];

    //levelOneA
    $userDownLevelOneList=(new UserServiceImpl)->findDownUserLevelOne($userId);

    //levelTwoB
    $userDownLevelTwoList=(new UserServiceImpl)->findDownUserLevelTwo($userId);

    //计算userNumbersExceptAB
    //总数
    $total=(new UserServiceImpl)->findUserNumbers($userId);
    //粉丝A数
    $userDownLevelOneList=(new UserServiceImpl)->findDownUserLevelOne($userId);
    $A_total=count($userDownLevelOneList);
    //粉丝B数
    $userDownLevelTwoList=(new UserServiceImpl)->findDownUserLevelTwo($userId);
    $B_tatal=count($userDownLevelTwoList);
    //总数-粉丝A数-粉丝B数
    $userNumbersExceptAB=$total-$A_total-$B_tatal;

    $userDownList=array('levelA'=>$userDownLevelOneList,'levelB'=>$userDownLevelTwoList,'more'=>$userNumbersExceptAB);
    $result = new Result(1,'请求成功',$userDownList);
    echo $result->send();