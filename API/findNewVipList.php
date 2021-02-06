<?php
//真正的寻找会员接口
// require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

// use app\Service\Impl\UserServiceImpl;

// $newVipList=(new UserServiceImpl)->findNewVipList();
// echo $newVipList;

//暂时用获奖用户替代
require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";

use app\Service\Impl\UserServiceImpl;

$newLuckyList=(new UserServiceImpl)->findNewLuckyList();
echo $newLuckyList;
