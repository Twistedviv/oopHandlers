<?php
namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;

class UserDaoImpl
{
    //DB对象实例化
    private $db;
    function __construct(){
        $this->db=new DB();
    }

    /**
     * @param $userId
     * @return $fanListLevelA
     */
    public function findFanListLevelA($userId){
        $sql = "select ums_invite.*,uu.uname,uu.utel,uu.headimage_url,uu.create_time ,urn.name from ums_invite
            left join ums_user uu on ums_invite.user_id = uu.id
            left join ums_real_name urn on ums_invite.user_id = urn.user_id
            where ums_invite.up_user_id_1 = $userId";
        $fanListLevelA=$this->db->execQuery($sql);
        return $fanListLevelA;
    }

    /**
     * @param $userId
     * @return $fanListLevelB
     */
    public function findFanListLevelB($userId){
        $sql = "select ums_invite.*,uu.uname,uu.utel,uu.headimage_url,uu.create_time ,urn.name from ums_invite
            left join ums_user uu on ums_invite.user_id = uu.id
            left join ums_real_name urn on ums_invite.user_id = urn.user_id
            where ums_invite.up_user_id_2 = $userId";
        $fanListLevelB=$this->db->execQuery($sql);
        return $fanListLevelB;
    }

    /**
     * @param $userId
     * @return $vipListLevelA
     */
    public function findVipListLevelA($userId){
        $sql = "select ums_invite.*,uu.uname,uu.utel,uu.headimage_url,uu.create_time ,urn.name from ums_invite
            left join ums_user uu on ums_invite.user_id = uu.id
            left join ums_real_name urn on ums_invite.user_id = urn.user_id
            where ums_invite.up_user_id_1 = $userId and uu.is_vip <> 0";
        $vipListLevelA=$this->db->execQuery($sql);
        return $vipListLevelA;
    }

    /**
     * @param $userId
     * @return $vipListLevelB
     */
    public function findVipListLevelB($userId){
        $sql = "select ums_invite.*,uu.uname,uu.utel,uu.headimage_url,uu.create_time ,urn.name from ums_invite
            left join ums_user uu on ums_invite.user_id = uu.id
            left join ums_real_name urn on ums_invite.user_id = urn.user_id
            where ums_invite.up_user_id_2 = $userId and uu.is_vip <> 0";
        $vipListLevelB=$this->db ->execQuery($sql);
        return $vipListLevelB;
    }

    /**
     * @param $userId
     * @return $partnerListLevelA
     */
    public function findPartnerListLevelA($userId){
        $sql = "select ums_partner.*,uu.uname,uu.utel,uu.headimage_url,uu.create_time ,urn.name from ums_partner
            left join ums_user uu on ums_partner.user_id = uu.id
            left join ums_real_name urn on ums_partner.user_id = urn.user_id
            where ums_partner.uppartner_id_1 = $userId";
        $partnerListLevelA=$this->db ->execQuery($sql);
        return $partnerListLevelA;
    }

    /**
     * @param $userId
     * @return $partnerListLevelB
     */
    public function findPartnerListLevelB($userId){
        $sql = "select ums_partner.*,uu.uname,uu.utel,uu.headimage_url,uu.create_time ,urn.name from ums_partner
            left join ums_user uu on ums_partner.user_id = uu.id
            left join ums_real_name urn on ums_partner.user_id = urn.user_id
            where ums_partner.uppartner_id_2 = $userId";
        $partnerListLevelB=$this->db ->execQuery($sql);
        return $partnerListLevelB;
    }

    /**
     * @param $userId
     * @return $partnerListLevelB
     */
    public function findPartnerListLevelC($userId){
        $sql = "select ums_partner.*,uu.uname,uu.utel,uu.headimage_url,uu.create_time ,urn.name from ums_partner
            left join ums_user uu on ums_partner.user_id = uu.id
            left join ums_real_name urn on ums_partner.user_id = urn.user_id
            where ums_partner.uppartner_id_3 = $userId";
        $partnerListLevelC=$this->db ->execQuery($sql);
        return $partnerListLevelC;
    }

    /**
     * @param $userId
     * @return $real 用户真实信息
     */
    public function findRealMessage($userId){
        $sql="select * from ums_real_name where user_id=$userId";
        $real=$this->db ->execQuery($sql);
        return $real;
    }

    /**
     * @param $userId
     * @return $user 用户信息
     */
    public function findUserByUserId($userId){
        $sql="select * from ums_user where id=$userId";
        $user=$this->db ->execQuery($sql);
        return $user;
    }

    /**
     * @param $userId
     * @return $userNumbers '以自己为根的总数数组'
     */
    public function findUserNumbers($userId){
        $sql="select invite_num from ums_user where $userId=ums_user.id";
        $userNumbers=$this->db ->execQuery($sql);
        return $userNumbers;
    }

    /**
     * @param $userId
     * @return $topPartnerDownNumbersList '创始合伙人下各分支合伙人数组'
     */
    public function findTopPartnerList($userId){
        $sql="select * from ums_partner where top_partner_id=$userId";
        $topPartner=$this->db ->execQuery($sql);
        return $topPartner;
    }

    /**
     *return $newVip
     */
    public function findNewVip(){
        $sql="select user_id,create_time from ums_vip where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(create_time)";
        $newVip=$this->db ->execQuery($sql);
        return $newVip;
    }

    /**
     *return $newPartner
     */
    public function findNewPartner(){
        $sql="select user_id,create_time from ums_partner where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(create_time)";
        $newPartner=$this->db ->execQuery($sql);
        return $newPartner;
    }

    /**
     * @return $newLuckyData
     */
    public function findNewLuckyData(){
        $sql="SELECT tbl_drawlottery.uid,tbl_drawlottery.level,uu.uname,uu.headimage_url,lla.result_time
                from tbl_drawlottery 
                left join lms_lottery_activity lla on tbl_drawlottery.period=lla.id
                left join ums_user uu on tbl_drawlottery.uid=uu.id
                order by tbl_drawlottery.period desc limit 0,30";
        $newLuckyData=$this->db ->execQuery($sql);
        return $newLuckyData;
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
        $res=$this->db ->execUpdateWithLastId($sql);
        return $res;
    }

    /**
     * @param $userId
     * @param $addressId
     * @return $res ‘更新user表中addressId’
     */
    public function UpdateAddressIdByUserId($userId,$addressId){
        //获取addressId
        $sql="UPDATE ums_user SET address_id=$addressId where $userId=id";
        $this->db ->execUpdate($sql);
        $sql="UPDATE ums_address SET is_default=0 where $userId=user_id and id <> $addressId";
        $this->db ->execUpdate($sql);
    }

    /**
     * @param $userId
     * return $userReceiveAddress
     */
    public function findUserReceiveAddress($userId){
        $sql="select * from ums_address where user_id=$userId and delete_status = 0";
        $userReceiveAddress=$this->db ->execQuery($sql);
        return $userReceiveAddress;
    }

    /**
     * @param $addressId
     * @return $result
     */
    public function deleteUserAddressByAddressId($addressId){
        $sql="UPDATE ums_address SET delete_status=1 where $addressId=id";
        $res=$this->db ->execUpdate($sql);
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
        $res=$this->db ->execUpdate($sql);
        return $res;
    }
}
