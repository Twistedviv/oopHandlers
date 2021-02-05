<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

    use app\Service\Impl\UserServiceImpl;

    $keyWord=$_GET('keyWord');
    $userId=$_GET('userId');
    $newLuckyList=(new UserServiceImpl)->findVideoListByKeyWord();
    echo $newLuckyList;