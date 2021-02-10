<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

    use app\Service\Impl\UserServiceImpl;

    $addressId=$_POST['addressId'];
    $userId = $_POST['userId'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $site=$_POST['site'];
    $isDefault=$_POST['isDefault'];
    $result=(new UserServiceImpl)->updateUserReceiveAddressByAddressId($addressId,$userId,
    $name,$phone,$site,$isDefault);
    echo $result;