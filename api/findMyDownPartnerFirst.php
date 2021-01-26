<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];

    $myDownPartnerFirstList=(new UserServiceImpl)->findMyDownPartnerFirst($userId);
    $result = new Result(1,'请求成功',$myDownPartnerFirstList);

    echo $result->send();