<?php

namespace app\Service;


interface UserService
{
    /**
     * @param $userId
     * @return $userList '直接邀请的用户数组'
     */
    public function findDownUserLevelOne($userId);
}