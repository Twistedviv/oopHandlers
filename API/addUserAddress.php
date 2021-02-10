<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

    use app\Service\Impl\UserServiceImpl;

    $userId=$_POST['userId'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $site=$_POST['site'];
    $isDefault=$_POST['isDefault'];
    $feedback=(new UserServiceImpl)->addUserReceiveAddress($userId,$name,$phone,$site,$isDefault);
    echo $feedback;