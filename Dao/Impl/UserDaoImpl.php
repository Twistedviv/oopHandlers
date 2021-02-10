<?php
namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;

class UserDaoImpl
{

    /**
     * @param $userId
     * @return $real 用户真实信息
     */
    public function findRealMessage($userId){
        $sql="select * from ums_real_name where user_id=$userId";
        $db = new DB();
        $real=$db ->execQuery($sql);
        return $real;
    }

    /**
     * @param $userId
     * @return $user 用户信息
     */
    public function findUserByUserId($userId){
        $sql="select * from ums_user where id=$userId";
        $db = new DB();
        $user=$db ->execQuery($sql);
        return $user;
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
        $sql="select id 'user_id' from ums_user where is_vip <> 0 and id in (
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
        $sql="select id 'user_id' from ums_user where is_vip <> 0 and id in (
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

    /**
     *return $newVip
     */
    public function findNewVip(){
        $sql="select user_id,create_time from ums_vip where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(create_time)";
        $db = new DB();
        $newVip=$db ->execQuery($sql);
        return $newVip;
    }

    /**
     *return $newPartner
     */
    public function findNewPartner(){
        $sql="select user_id,create_time from ums_partner where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(create_time)";
        $db = new DB();
        $newPartner=$db ->execQuery($sql);
        return $newPartner;
    }

    /**
     *return $newLucky
     */
    public function findNewLucky(){
        $sql="select uid,drawtime from tbl_lottery where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(drawtime)";
        $db = new DB();
        $newLucky=$db ->execQuery($sql);
        return $newLucky;
    }

    /**
     * @param $userId
     * return $luckyUserData
     */
    public function findLuckyUserDataByUserId($userId){
        $sql="select * from tbl_drawlottery where uid=$userId";
        $db = new DB();
        $luckyUserData=$db ->execQuery($sql);
        return $luckyUserData;
    }

    /**
     * @param $userId
     * @param $name
     * @param $phone
     * @param $site
     * @param $isDefault
     * @return $res '实现插入用户收获地址'
     */
    public function addUserReceiveAddress($userId, $name, $phone, $site, $isDefault){
        $sql="insert into ums_address(user_id,name,phone,site,is_default,delete_status) values (
              '$userId','$name','$phone','$site','$isDefault','0')";
        $db = new DB();
        $res=$db ->execUpdateWithLastId($sql);
        return $res;
    }

    /**
     * @param $userId
     * @param $addressId
     * @return $res ‘更新user表中addressId’
     */
    public function UpdateAddressIdByUserId($userId,$addressId){
        //获取addressId
        $db = new DB();
        $sql="UPDATE ums_user SET address_id=$addressId where $userId=id";
        $db ->execUpdate($sql);
        $sql="UPDATE ums_address SET is_default=0 where $userId=user_id and id <> $addressId";
        $db ->execUpdate($sql);
    }

    /**
     * @param $userId
     * return $userReceiveAddress
     */
    public function findUserReceiveAddress($userId){
        $sql="select * from ums_address where user_id=$userId and delete_status = 0";
        $db = new DB();
        $userReceiveAddress=$db ->execQuery($sql);
        return $userReceiveAddress;
    }

    /**
     * @param $addressId
     * @return $result
     */
    public function deleteUserReceiveAddressByAddressId($addressId){
        $sql="UPDATE ums_address SET delete_status=1 where $addressId=id";
        $db = new DB();
        $res=$db ->execUpdate($sql);
        return $res;
    }

    /**
     * @param $addressId
     * @param $name
     * @param $phone
     * @param $site
     * @param $isDefault
     * @return $res
     */
    public function updateUserReceiveAddressByAddressId
        ($addressId,$name,$phone,$site,$isDefault){
        $sql="UPDATE ums_address SET name='$name' , phone='$phone',site='$site',is_default='$isDefault'  where $addressId=id";
        $db = new DB();
        $res=$db ->execUpdate($sql);
        return $res;
    }
}
