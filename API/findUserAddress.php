<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];
    $userReceiveAddressList=(new UserServiceImpl)->findUserReceiveAddress($userId);
    echo $userReceiveAddressList;