<?php
    require_once "../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Dao\Impl\UserDaoImpl;

    $userId=$_GET['userId'];

    $userList=(new UserDaoImpl)->findDownUserLevelOne($userId);
    $result = new Result(1,'请求成功',$userList);

    echo $result->send();
