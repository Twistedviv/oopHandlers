<?php

namespace app\Service;


interface UserService
{
    /**
     * @param $userId
     * @return $userDownLevelOneList '直接邀请的用户数组'
     */
    public function findDownUserLevelOne($userId);

    /**
     * @param $userId
     * @return $userDownLevelTwoList '直接邀请的直接邀请的用户数组'
     */
    public function findDownUserLevelTwo($userId);

    /**
     * @param $userId
     * @return $userNumbers '以自己为根的总数'
     */
    public function findUserNumbers($userId);

    /**
     * @param $userId
     * @return $userDownVipLevelOneList '直接邀请的vip数组'
     */
    public function findDownVipLevelOne($userId);

    /**
     * @param $userId
     * @return $userDownVipLevelTwoList '直接邀请的直接邀请的vip数组'
     */
    public function findDownVipLevelTwo($userId);
}