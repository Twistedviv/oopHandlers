<?php
namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;

class UserDaoImpl
{

    /**
     * @param $userId
     * @return $realList 用户真实信息
     */
    public function findRealMessage($userId){
        $sql="select * from ums_real_name where user_id=$userId";
        $db = new DB();
        $realList=$db ->execQuery($sql);
        return $realList;
    }

    public function findUserByUserId($userId){
        $sql="select * from ums_user where id=$userId";
        $db = new DB();
        $userList=$db ->execQuery($sql);
        return $userList;
    }


    /**SUBSTRING(create_time, 3)
     * @param $userId
     * @return $userDownLevelOneList '直接邀请的用户数组'
     */
    public function findDownUserLevelOneIdByUserId($userId){
        $sql="select user_id from ums_invite where ums_invite.up_user_id_1 = $userId";
        $db = new DB();
        $userIdList=($db ->execQuery($sql));
        return $userIdList;
    }

    /**
     * @param $userId
     * @return $userDownLevelTwoList '直接邀请的直接邀请的用户数组'
     */
    public function findDownUserLevelTwoIdByUserId($userId){
        $sql="select user_id from ums_invite where ums_invite.up_user_id_2 = $userId";
        $db = new DB();
        $userIdList=$db ->execQuery($sql);
        return $userIdList;
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
     * @return $userDownLevelOneVipList
     */
    public function findDownVipLevelOneIdByUserId($userId){
        $sql="select id from ums_user where is_vip <> 0 and id in (
            select user_id from ums_invite where ums_invite.up_user_id_1 = $userId)";
        $db = new DB();
        $userIdList=$db ->execQuery($sql);
        return $userIdList;
    }

    /**
     * @param $userId
     * @return $userDownLevelTwoVipList
     */
    public function findDownVipLevelTwoIdByUserId($userId){
        $sql="select id from ums_user where is_vip <> 0 and id in (
            select user_id from ums_invite where ums_invite.up_user_id_2 = $userId)";
        $db = new DB();
        $userIdList=$db ->execQuery($sql);
        return $userIdList;
    }

    /**
     * @param $userId
     * @return $myDownPartnerFirstList '自己下方各分支的第一个合伙人数组'
     */
    public function findMyDownPartnerFirstIdList($userId){
        $sql="select user_id from ums_partner where uppartner_id_1 = $userId";
        $db = new DB();
        $userIdList=$db ->execQuery($sql);
        return $userIdList;
    }

    /**
     * @param $userId
     * @return $partnerADownPartnerFirstList '合伙人A下方各分支的第一个合伙人数组'
     */
    public function findPartnerADownPartnerFirstIdList($userId){
        $sql="select user_id from ums_partner where uppartner_id_2 = $userId";
        $db = new DB();
        $userIdList=$db ->execQuery($sql);
        return $userIdList;
    }

    /**
     * @param $userId
     * @return $partnerBDownPartnerFirstList '合伙人B下方各分支的第一个合伙人数组'
     */
    public function findPartnerBDownPartnerFirstIdList($userId){
        $sql="select user_id from ums_partner where uppartner_id_3 = $userId";
        $db = new DB();
        $userIdList=$db ->execQuery($sql);
        return $userIdList;
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
