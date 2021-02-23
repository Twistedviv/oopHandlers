<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];
    //vip列表
    $vipList=(new UserServiceImpl)->findVipList($userId);
    echo $vipList;
