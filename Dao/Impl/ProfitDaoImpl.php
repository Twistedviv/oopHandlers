<?php


namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;


class ProfitDaoImpl
{

    /**
     * 注解
     * 'CM':Current Month 本月
     * 'LM':Last Month  上月
     * 'Three':levelABC  合伙人ABC三个层级总和
     * 'More':创始合伙人下的受益
     */

    //DB对象实例化
    private $db;
    function __construct(){
        $this->db=new DB();
    }
    /**
     * @param $partnerId
     * @return $vipProfit ‘vip总收益model’
     */
    public function findVipProfit($partnerId){
        $sql = "select * from bms_vip_profit where $partnerId=partner_id 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $vipProfit=$this->db->execQuery($sql);
        return $vipProfit;
    }

    /**
     * @param $partnerId
     * @return $vipCMProfit ‘vip本月收益model’
     */
    public function findVipCMProfit($partnerId){
        $sql = "select * from bms_vip_profit where $partnerId=partner_id 
                              and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                              and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $vipCMProfit=$this->db->execQuery($sql);
        return $vipCMProfit;
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
     * @return $threeProfit '合伙人ABC三层级下的总收益model'
     */
    public function findThreeProfit($partnerId){
        $sql = "select * from bms_code_profit where DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                                and ($partnerId=profited_partner_id_1 or 
                                $partnerId=profited_partner_id_2 or
                                $partnerId=profited_partner_id_3)";
        $threeProfit=$this->db->execQuery($sql);
        return $threeProfit;
    }

    /**
     * @param $partnerId
     * @return $threeCMProfit ‘合伙人ABC三层级下的本月收益model’
     */
    public function findThreeCMProfit($partnerId){
        $sql = "select * from bms_code_profit where DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time) 
                                and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                                and ($partnerId=profited_partner_id_1 or 
                                $partnerId=profited_partner_id_2 or
                                $partnerId=profited_partner_id_3)";
        $threeCMProfit=$this->db->execQuery($sql);
        return $threeCMProfit;
    }

    /**
     * @param $partnerId
     * @return $levelAProfit ‘合伙人A层级下总收益model’
     */
    public function findlevelAProfit($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_1 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelAProfit=$this->db->execQuery($sql);
        return $levelAProfit;
    }

    /**
     * @param $partnerId
     * @return $levelBProfit
     */
    public function findlevelBProfit($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_2 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelBProfit=$this->db->execQuery($sql);
        return $levelBProfit;
    }

    /**
     * @param $partnerId
     * @return $levelCProfit
     */
    public function findlevelCProfit($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_3 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelCProfit=$this->db->execQuery($sql);
        return $levelCProfit;
    }

    /**
     * @param $partnerId
     * @return $more ‘创始合伙人+层级下的总收益model’
     */
    public function findMore($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_top_partner_id 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $more=$this->db->execQuery($sql);
        return $more;
    }

    /**
     * @param $partnerId
     * @return $levelACMProfit ‘合伙人A层级下本月收益model’
     */
    public function findlevelACMProfit($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_1 
                                and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m') 
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelACMProfit=$this->db->execQuery($sql);
        return $levelACMProfit;
    }

    /**
     * @param $partnerId
     * @return $levelBCMProfit
     */
    public function findlevelBCMProfit($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_2 
                                and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelBCMProfit=$this->db->execQuery($sql);
        return $levelBCMProfit;
    }

    /**
     * @param $partnerId
     * @return $levelCCMProfit
     */
    public function findlevelCCMProfit($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_3 
                                and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                                and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $levelCCMProfit=$this->db->execQuery($sql);
        return $levelCCMProfit;
    }

    /**
     * @param $partnerId
     * @return $moreCM '创始合伙人+层级下本月收益model'
     */
    public function findMoreCM($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_top_partner_id 
                              and DATE_FORMAT(create_time,'%Y%m')=DATE_FORMAT(CURDATE( ),'%Y%m')
                              and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)";
        $moreCM=$this->db->execQuery($sql);
        return $moreCM;
    }

    /**
     * @param $partnerId
     * @return $vipUncheckedProfit ‘vip未结算的收益model’
     */
    public function findVipUncheckedProfit($partnerId){
        $sql = "select * from bms_vip_profit where $partnerId=partner_id 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and checked=0";
        $vipUncheckedProfit=$this->db->execQuery($sql);
        return $vipUncheckedProfit;
    }

    /**
     * @param $partnerId
     * @return $vipLMProfit ‘vip上月收益model’
     */
    public function findVipLMProfit($partnerId){
        $sql = "select * from bms_vip_profit where $partnerId=partner_id 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(CURDATE() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $vipLMProfit=$this->db->execQuery($sql);
        return $vipLMProfit;
    }

    /**
     * @param $partnerId
     * @return $codeCheckedThreeProfit ‘合伙人ABC三层级下已结算的收益model’
     */
    public function findCodeCheckedThreeProfit($partnerId){
        $sql = "select * from bms_code_profit where  checked=1
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and ($partnerId=profited_partner_id_1 or $partnerId=profited_partner_id_2
                                    or $partnerId=profited_partner_id_3)";
        $codeCheckedThreeProfit=$this->db->execQuery($sql);
        return $codeCheckedThreeProfit;
    }

    /**
     * @param $partnerId
     * @return $levelALMProfit ‘合伙人A层级下上月收益model’
     */
    public function findlevelALMProfit($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_1 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(now() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $levelALMProfit=$this->db->execQuery($sql);

        return $levelALMProfit;
    }

    /**
     * @param $partnerId
     * @return $levelBLMProfit
     */
    public function findlevelBLMProfit($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_2 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(now() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $levelBLMProfit=$this->db->execQuery($sql);
        return $levelBLMProfit;
    }

    /**
     * @param $partnerId
     * @return $levelCLMProfit
     */
    public function findlevelCLMProfit($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_partner_id_3 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(now() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $levelCLMProfit=$this->db->execQuery($sql);
        return $levelCLMProfit;
    }

    /**
     * @param $partnerId
     * @return $moreChecked ‘创始合伙人+层几下已结算的收益model’
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
     * @return $moreLM ‘创始合伙人下上月的收益model’
     */
    public function findmoreLM($partnerId){
        $sql = "select * from bms_code_profit where $partnerId=profited_top_partner_id 
                               and DATE_SUB(CURDATE(), INTERVAL 7 DAY) > date(create_time)
                               and PERIOD_DIFF(date_format(now() ,'%Y%m'),date_format(create_time,'%Y%m'))=1";
        $moreLM=$this->db->execQuery($sql);
        return $moreLM;
    }
}