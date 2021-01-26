<?php
namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;

class UserDaoImpl
{

    /**
     * @param $userId
     * @return $userDownLevelOneList '直接邀请的用户数组'
     */
    public function findDownUserLevelOne($userId){
        $sql="select uname,headimage_url,utel,create_time from ums_user where id in (
            select user_id from ums_invite where ums_invite.up_user_id_1 = $userId)";
        $db = new DB();
        $userDownLevelOneList=$db ->execQuery($sql);
        return $userDownLevelOneList;
    }

    /**
     * @param $userId
     * @return $userDownLevelTwoList '直接邀请的直接邀请的用户数组'
     */
    public function findDownUserLevelTwo($userId){
        $sql="select uname,headimage_url,utel,create_time from ums_user where id in (
            select user_id from ums_invite where ums_invite.up_user_id_2 = $userId)";
        $db = new DB();
        $userDownLevelTwoList=$db ->execQuery($sql);
        return $userDownLevelTwoList;
    }

    /**
     * @param $userId
     * @return $userNumbers '以自己为根的总数数组'
     */
    public function findUserNumbers($userId){
        $sql="select invite_num from ums_user where $userId=ums_user.id";
        $db = new DB();
        $userNumbers=$db ->execQuery($sql);
        return $userNumbers;
    }

    /**
     * @param $userId
     * @return $userDownLevelOneVipList '以自己为根的总数 数组'
     */
    public function findDownVipLevelOne($userId){
        $sql="select uname,headimage_url,utel,create_time from ums_user where is_vip <> 0 and id in (
            select user_id from ums_invite where ums_invite.up_user_id_1 = $userId)";
        $db = new DB();
        $userDownLevelOneVipList=$db ->execQuery($sql);
        return $userDownLevelOneVipList;
    }

    /**
     * @param $userId
     * @return $userDownLevelTwoVipList '以自己为根的总数 数组'
     */
    public function findDownVipLevelTwo($userId){
        $sql="select uname,headimage_url,utel,create_time from ums_user where is_vip <> 0 and id in (
            select user_id from ums_invite where ums_invite.up_user_id_2 = $userId)";
        $db = new DB();
        $userDownLevelTwoVipList=$db ->execQuery($sql);
        return $userDownLevelTwoVipList;
    }

    /**
     * @param $userId
     * @return $myDownPartnerFirstList '自己下方各分支的第一个合伙人数组'
     */
    public function findMyDownPartnerFirst($userId){
        $sql="select uname,headimage_url,utel,create_time from ums_user where id in (
            select user_id from ums_partner where uppartner_id_1 = $userId)";
        $db = new DB();
        $myDownPartnerFirstList=$db ->execQuery($sql);
        return $myDownPartnerFirstList;
    }

    /**
     * @param $userId
     * @return $partnerADownPartnerFirstList '合伙人A下方各分支的第一个合伙人数组'
     */
    public function findPartnerADownPartnerFirst($userId){
        $sql="select uname,headimage_url,utel,create_time from ums_user where id in (
            select user_id from ums_partner where uppartner_id_2 = $userId)";
        $db = new DB();
        $partnerADownPartnerFirstList=$db ->execQuery($sql);
        return $partnerADownPartnerFirstList;
    }

    /**
     * @param $userId
     * @return $partnerBDownPartnerFirstList '合伙人B下方各分支的第一个合伙人数组'
     */
    public function findPartnerBDownPartnerFirst($userId){
        $sql="select uname,headimage_url,utel,create_time from ums_user where id in (
            select user_id from ums_partner where uppartner_id_3 = $userId)";
        $db = new DB();
        $partnerBDownPartnerFirstList=$db ->execQuery($sql);
        return $partnerBDownPartnerFirstList;
    }

    /**
     * @param $userId
     * @return $topPartnerDownNumbersList '创始合伙人下各分支合伙人数组'
     */
    public function findTopPartnerDownNumbersList($userId){
        $sql="select * from ums_partner where top_partner_id=$userId";
        $db = new DB();
        $topPartnerDownNumbersList=$db ->execQuery($sql);
        return $topPartnerDownNumbersList;
    }

}
