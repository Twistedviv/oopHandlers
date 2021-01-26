<?php
    require_once "../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
use app\Dao\Impl\UserDaoImpl;

    $userId=$_GET['userId'];

    //总数
    $userNumbers=(new UserDaoImpl)->findUserNumbers($userId);
    $total=$userNumbers[0]['invite_num'];
    //echo $userNumbers[0]['invite_num']."  ";

    //粉丝A数
    $userDownLevelOneList=(new UserDaoImpl)->findDownUserLevelOne($userId);
    $A_total=count($userDownLevelOneList);
    //echo count($userDownLevelOneList)." ";

    //粉丝B数
    $userDownLevelTwoList=(new UserDaoImpl)->findDownUserLevelTwo($userId);
    $B_tatal=count($userDownLevelTwoList);
    //echo count($userDownLevelTwoList);

    //总数-粉丝A数-粉丝B数
    $userNumbersExceptAB=$total-$A_total-$B_tatal;
    //echo $userNumbersExceptAB;

    $result = new Result(1,'请求成功', $userNumbersExceptAB);
    echo $result->send();