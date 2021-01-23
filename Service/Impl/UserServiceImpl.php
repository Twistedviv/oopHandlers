<?php
namespace app\Service\Impl;

require_once dirname(__FILE__).'/../../Dao/Impl/UserDaoImpl.php';
use app\Dao\Impl\UserDaoImpl;
require_once dirname(__FILE__)."/../UserService.php";
use app\Service\UserService;




class UserServiceImpl implements UserService
{
    /**
     * @param $userId
     * @return $userList '直接邀请的用户数组'
     */
    public function findDownUserLevelOne($userId){
        $userList=(new UserDaoImpl())->findDownUserLevelOne($userId);
        return $userList;
    }
}