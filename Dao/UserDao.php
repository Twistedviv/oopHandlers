<?php


namespace Dao;


interface UserDao
{

    /**
     * @param $utel '新用户手机号'
     * @param $invitePeopleId '邀请用户ID'
     * @return $new_user_id '新用户ID'
     */
    public function addUser($utel, $invitePeopleId);


    /**
     * @param $uid  '用户id'
     * @param $situation  '筛选情况，0->不对身份筛选，1->筛选会员身份，2->筛选合伙人身份'
     * @return $invitePeopleList   '邀请的人的列表'
     */
    public function getInvitePeoPleListByUid($uid,$situation);




}