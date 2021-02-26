<?php

namespace app\Service\Impl;

require_once dirname(__FILE__).'/../../Dao/Impl/ProfitDaoImpl.php';
require_once dirname(__FILE__)."/../ProfitService.php";
require_once dirname(__FILE__)."/../../Common/Result.php";

use app\Common\Result;
use app\Service\ProfitService;
use app\Dao\Impl\ProfitDaoImpl;

class ProfitServiceImpl implements ProfitService
{
    //dao层对象实例化
    private $profitDao;
    function __construct(){
        $this->profitDao=new ProfitDaoImpl();
    }

    /**
     * @param  $partnerId
     * @return $profitList
     */
    public function findProfit($partnerId){
        function countMoney($list){
            $sum=0;
            for($i=0;$i<count($list);$i++){
                $sum+=$list[$i]['profit_money'];
            }
            return $sum;
        }

        //总会员费
        $vip=$this->profitDao->findVip($partnerId);
        $vipProfit=countMoney($vip);
        //本月新增会员费
        $vipCurrent=$this->profitDao->findVipCurrent($partnerId);
        $vipProfitCurrent=countMoney($vipCurrent);
        if($vipProfit==0){
            $vipIncrease="0.0%";
        }
        else{
            $format_num = sprintf("%.1f",$vipProfitCurrent/$vipProfit*100);
            $vipIncrease=$format_num."%";
        }
        $vipFee=array('profitNumber'=>$vipProfit,'increase'=>$vipIncrease);

        //判断是否为创始合伙人
        $user=$this->profitDao->findUser($partnerId);
        $isTop=false;
        if($user[0]['is_partner']==3){
            $isTop=true;
        }

        //levelABC收益
        $levelABC=$this->profitDao->findlevelABC($partnerId);
        $codeProfit=countMoney($levelABC);

        if($isTop==true){
            //more收益
            $more=$this->profitDao->findMore($partnerId);
            $moreProfit=countMoney($more);
            $codeProfit+=$moreProfit;
        }

        //本月新增ABC
        $levelABCCurrent=$this->profitDao->findlevelABCCurrent($partnerId);
        $codeProfitCurrent=countMoney($levelABCCurrent);
        //本月新增more
        if($isTop==true){
            //more收益
            $moreCurrent=$this->profitDao->findMoreCurrent($partnerId);
            $moreProfitCurrent=countMoney($moreCurrent);
            $codeProfitCurrent+=$moreProfitCurrent;
        }
        if($codeProfit==0){
            $codeIncrease="0.0%";
        }
        else{
            $format_num = sprintf("%.1f",$codeProfitCurrent/$codeProfit*100);
            $codeIncrease=$format_num."%";
        }
        $partnerFee=array('profitNumber'=>$codeProfit,'increase'=>$codeIncrease);

        //商品佣金暂定两项为0
        $productProfit=0;$productIncrease="0.0%";
        $productFee=array('profitNumber'=>$productProfit,'increase'=>$productIncrease);

        //前三项总和
        $sumFee=$vipProfit+$codeProfit+$productProfit;

        $profitList=array('vipFee'=>$vipFee,'partnerFee'=>$partnerFee,'productFee'=>$productFee,
            'sumFee'=>$sumFee);
        $result = new Result(0,'请求成功',$profitList);
        return $result->send();

    }


    /**
     * @param  $partnerId
     * @return $$vipFeeProfit
     */
    public function findVipFeeProfit($partnerId){
        function countMoney($list){
            $sum=0;
            for($i=0;$i<count($list);$i++){
                $sum+=$list[$i]['profit_money'];
            }
            return $sum;
        }
        //可提现的会员费
        $vipUnchecked=$this->profitDao->findVipUnchecked($partnerId);
        $vipUncheckedMoney=countMoney($vipUnchecked);
        //总会员费
        $vip=$this->profitDao->findVip($partnerId);
        $vipProfit=countMoney($vip);
        //已提现的会员费
        $vipCheckedMoney=$vipProfit-$vipUncheckedMoney;
        $summary=array('sum'=>$vipProfit,'checked'=>$vipCheckedMoney,'unchecked'=>$vipUncheckedMoney);

        //当月会员费
        $vipCurrent=$this->profitDao->findVipCurrent($partnerId);
        $vipProfitCurrent=countMoney($vipCurrent);
        //上月会员费
        $vipLM=$this->profitDao->findVipLM($partnerId);
        $vipProfitLM=countMoney($vipLM);
        $detail=array('currentMonth'=>$vipProfitCurrent,'lastMonth'=>$vipProfitLM,'total'=>$vipProfit);

        $vipFeeProfit=array('summary'=>$summary,'detail'=>$detail);
        $result = new Result(0,'请求成功',$vipFeeProfit);
        return $result->send();
    }

    /**
     * @param $partnerId
     * @return $codeFeeProfit
     */
    public function findCodeFeeProfit($partnerId){
        function countMoney($list){
            $sum=0;
            for($i=0;$i<count($list);$i++){
                $sum+=$list[$i]['profit_money'];
            }
            return $sum;
        }
        //判断是否为创始合伙人
        $user=$this->profitDao->findUser($partnerId);
        $isTop=false;
        if($user[0]['is_partner']==3){
            $isTop=true;
        }
        //总
        //levelA收益
        $levelA=$this->profitDao->findlevelA($partnerId);
        $levelAProfit=countMoney($levelA);
        //levelB收益
        $levelB=$this->profitDao->findlevelB($partnerId);
        $levelBProfit=countMoney($levelB);
        //levelC收益
        $levelC=$this->profitDao->findlevelC($partnerId);
        $levelCProfit=countMoney($levelC);
        //条码总收益
        $codeProfit=$levelAProfit+$levelBProfit+$levelCProfit;

        //已提现
        $codeCheckedABC=$this->profitDao->findCodeCheckedABC($partnerId);
        $codeProfitChecked=countMoney($codeCheckedABC);

        //本月新增
        //本月新增levelA收益
        $levelACurrent=$this->profitDao->findlevelACurrent($partnerId);
        $levelAProfitCurrent=countMoney($levelACurrent);
        //本月新增levelB收益
        $levelBCurrent=$this->profitDao->findlevelBCurrent($partnerId);
        $levelBProfitCurrent=countMoney($levelBCurrent);
        //本月新增levelC收益
        $levelCCurrent=$this->profitDao->findlevelCCurrent($partnerId);
        $levelCProfitCurrent=countMoney($levelCCurrent);

        //上月累计
        //上月新增levelA收益
        $levelALM=$this->profitDao->findlevelALM($partnerId);
        $levelAProfitLM=countMoney($levelALM);
        //上月新增levelB收益
        $levelBLM=$this->profitDao->findlevelBLM($partnerId);
        $levelBProfitLM=countMoney($levelBLM);
        //上月新增levelC收益
        $levelCLM=$this->profitDao->findlevelCLM($partnerId);
        $levelCProfitLM=countMoney($levelCLM);

        $levelA=array('currentMonth'=>$levelAProfitCurrent,
            'lastMonth'=>$levelAProfitLM,
            'sum'=>$levelAProfit);
        $levelB=array('currentMonth'=>$levelBProfitCurrent,
            'lastMonth'=>$levelBProfitLM,
            'sum'=>$levelBProfit);
        $levelC=array('currentMonth'=>$levelCProfitCurrent,
            'lastMonth'=>$levelCProfitLM,
            'sum'=>$levelCProfit);

        if($isTop==false){
            $summary=array('sum'=>$codeProfit,'checked'=>$codeProfitChecked);
            $detail=array('levelA'=>$levelA,'levelB'=>$levelB,'levelC'=>$levelC);
            $codeFeeProfit=array('summary'=>$summary,'detail'=>$detail);
            $result = new Result(0,'请求成功',$codeFeeProfit);
            return $result->send();
        }
        else if($isTop==true){
            //more总收益
            $more=$this->profitDao->findMore($partnerId);
            $moreProfit=countMoney($more);
            $codeProfit+=$moreProfit;
            //more已提现
            $moreChecked=$this->profitDao->findMoreChecked($partnerId);
            $moreProfitChecked=countMoney($moreChecked);
            $codeProfitChecked+=$moreProfitChecked;
            //more本月收益
            $moreCurrent=$this->profitDao->findMoreCurrent($partnerId);
            $moreProfitCurrent=countMoney($moreCurrent);
            //more上月收益
            $moreLM=$this->profitDao->findMoreLM($partnerId);
            $moreProfitLM=countMoney($moreLM);

            $more=array('currentMonth'=>$moreProfitCurrent,
                'lastMonth'=>$moreProfitLM,
                'sum'=>$moreProfit);
            $summary=array('sum'=>$codeProfit,'checked'=>$codeProfitChecked);
            $detail=array('levelA'=>$levelA,'levelB'=>$levelB,'levelC'=>$levelC,'more'=>$more);
            $codeFeeProfit=array('summary'=>$summary,'detail'=>$detail);
            $result = new Result(0,'请求成功',$codeFeeProfit);
            return $result->send();
        }




    }

    /**
     * @param $partnerId
     */
    public function findProductProfit($partnerId){

    }

}