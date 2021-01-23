<?php
    require_once "../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";
    use Common\Result;
    use app\Service\Impl\UserServiceImpl;

    $userList=(new UserServiceImpl)->findDownUserLevelOne(1);
    $result = new Result(0,0,$userList);
    echo $result->send();
