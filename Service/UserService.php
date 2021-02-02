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

    /**
     * @param $userId
     * @return $myDownPartnerFirstList '自己下方各分支的第一个合伙人数组'
     */
    public function findMyDownPartnerFirst($userId);

    /**
     * @param $userId
     * @return $partnerADownPartnerFirstList '合伙人A下方各分支的第一个合伙人数组'
     */
    public function findPartnerADownPartnerFirst($userId);

    /**
     * @param $userId
     * @return $partnerBDownPartnerFirstList '合伙人B下方各分支的第一个合伙人数组'
     */
    public function findPartnerBDownPartnerFirst($userId);

    /**
     * @param $userId
     * @return $topPartnerDownNumbers '创始合伙人下各分支总数'
     */
    public function findTopPartnerDownNumbers($userId);

    /**
     * @param $idList 'id数组'
     * @return $userList '封装用户id 头像 电话 上传时间 真实用户名'
     */
    public function encapUserList($idList);

}