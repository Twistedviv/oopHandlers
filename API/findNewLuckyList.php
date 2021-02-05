<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

    use app\Service\Impl\UserServiceImpl;

    $newLuckyList=(new UserServiceImpl)->findNewLuckyList();
    echo $newLuckyList;