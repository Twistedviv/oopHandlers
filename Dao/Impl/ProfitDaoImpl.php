<?php


namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;


class ProfitDaoImpl
{
    //DB对象实例化
    private $db;
    function __construct(){
        $this->db=new DB();
    }

    /**
     * @param $partnerId
     * @return $vip
     */
    public function findVip($partnerId){
        $sql = "select * from bms_vip_profit where $partnerId=partner_id 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $vip=$this->db->execQuery($sql);
        return $vip;
    }

    /**
     * @param $partnerId
     * @return $vipCurrent
     */
    public function findVipCurrent($partnerId){
        $sql = "select * from bms_vip_profit where $partnerId=partner_id 
                              and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                              and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $vipCurrent=$this->db->execQuery($sql);
        return $vipCurrent;
    }

    /**
     * @param $partnerId
     * @return $user
     */
    public function findUser($partnerId){
        $sql = "select * from ums_user where $partnerId=id";
        $user=$this->db->execQuery($sql);
        return $user;
    }

    /**
     * @param $partnerId
     * @return $levelABC
     */
    public function findlevelABC($partnerId){
        $sql = "select * from bms_code_profit where DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                                and ($partnerId=profited_partner_id_1 or 
                                $partnerId=profited_partner_id_2 or
                                $partnerId=profited_partner_id_3)";
        $levelABC=$this->db->execQuery($sql);
        return $levelABC;
    }

    /**
     * @param $partnerId
     * @return $levelABCCurrent
     */
    public function findlevelABCCurrent($partnerId){
        $sql = "select * from bms_code_profit where DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time) 
                                and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                                and ($partnerId=profited_partner_id_1 or 
                                $partnerId=profited_partner_id_2 or
                                $partnerId=profited_partner_id_3)";
        $levelABCCurrent=$this->db->execQuery($sql);
        return $levelABCCurrent;
    }

    /**
     * @param $partnerId
     * @return $levelA
     */
    public function findlevelA($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_1 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelA=$this->db->execQuery($sql);
        return $levelA;
    }

    /**
     * @param $partnerId
     * @return $levelB
     */
    public function findlevelB($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_2 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelB=$this->db->execQuery($sql);
        return $levelB;
    }

    /**
     * @param $partnerId
     * @return $levelC
     */
    public function findlevelC($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_3 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelC=$this->db->execQuery($sql);
        return $levelC;
    }

    /**
     * @param $partnerId
     * @return $more
     */
    public function findMore($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_top_partner_id 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $more=$this->db->execQuery($sql);
        return $more;
    }

    /**
     * @param $partnerId
     * @return $levelACurrent
     */
    public function findlevelACurrent($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_1 
                                and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m') 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelACurrent=$this->db->execQuery($sql);
        return $levelACurrent;
    }

    /**
     * @param $partnerId
     * @return $levelBCurrent
     */
    public function findlevelBCurrent($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_2 
                                and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelBCurrent=$this->db->execQuery($sql);
        return $levelBCurrent;
    }

    /**
     * @param $partnerId
     * @return $levelCCurrent
     */
    public function findlevelCCurrent($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_3 
                                and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelCCurrent=$this->db->execQuery($sql);
        return $levelCCurrent;
    }

    /**
     * @param $partnerId
     * @return $moreCurrent
     */
    public function findMoreCurrent($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_top_partner_id 
                              and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                              and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $moreCurrent=$this->db->execQuery($sql);
        return $moreCurrent;
    }

    /**
     * @param $partnerId
     * @return $vipUnchecked
     */
    public function findVipUnchecked($partnerId){
        $sql = "select * from bms_vip_profit where $partnerId=partner_id 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and checked=0";
        $vipUnchecked=$this->db->execQuery($sql);
        return $vipUnchecked;
    }

    /**
     * @param $partnerId
     * @return $vipLM
     */
    public function findVipLM($partnerId){
        $sql = "select * from bms_vip_profit where $partnerId=partner_id 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(CURDATE() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $vipLM=$this->db->execQuery($sql);
        return $vipLM;
    }

    /**
     * @param $partnerId
     * @return $codeCheckedABC
     */
    public function findCodeCheckedABC($partnerId){
        $sql = "select * from bms_code_profit where  checked=1
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and ($partnerId=profited_partner_id_1 or $partnerId=profited_partner_id_2
                                    or $partnerId=profited_partner_id_3)";
        $codeCheckedABC=$this->db->execQuery($sql);
        return $codeCheckedABC;
    }

    /**
     * @param $partnerId
     * @return $levelALM
     */
    public function findlevelALM($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_1 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(now() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $levelALM=$this->db->execQuery($sql);

        return $levelALM;
    }

    /**
     * @param $partnerId
     * @return $levelBLM
     */
    public function findlevelBLM($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_2 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(now() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $levelBLM=$this->db->execQuery($sql);
        return $levelBLM;
    }

    /**
     * @param $partnerId
     * @return $levelCLM
     */
    public function findlevelCLM($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_3 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(now() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $levelCLM=$this->db->execQuery($sql);
        return $levelCLM;
    }

    /**
     * @param $partnerId
     * @return $moreChecked
     */
    public function findMoreChecked($partnerId){
        $sql = "select * from bms_code_profit where  checked=1
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and $partnerId=profited_top_partner_id";
        $moreChecked=$this->db->execQuery($sql);
        return $moreChecked;
    }

    /**
     * @param $partnerId
     * @return $moreLM
     */
    public function findmoreLM($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_top_partner_id 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(now() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $moreLM=$this->db->execQuery($sql);
        return $moreLM;
    }
}