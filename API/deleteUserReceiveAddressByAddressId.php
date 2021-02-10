<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

    use app\Service\Impl\UserServiceImpl;

    $addressId=$_POST['addressId'];
    $result=(new UserServiceImpl)->deleteUserReceiveAddressByAddressId($addressId);
    echo $result;