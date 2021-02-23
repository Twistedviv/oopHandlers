<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];
    //partner列表
    $partnerList=(new UserServiceImpl)->findPartnerList($userId);
    echo $partnerList;