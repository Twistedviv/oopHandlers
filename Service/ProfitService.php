<?php


namespace app\Service;


interface ProfitService
{

    /**
     * @param $partnerId  合伙人id
     * @return $profitList {
            vipFee: {
     *          profitNumber,
     *          increase(当月新增\总额)
     *      },
     *      partnerFee: {
     *
     *      }
     *      productFee: {
     *
     *      },
     *      sumFee: 上三项之和
     * }
     */
    public function findProfit($partnerId);



    /**
     * @param $partnerId  合伙人id
     * @return $vipFeeProfit {
            summary: {
     *          sum,
     *          checked，
     *          unchecked
     *      },
     *      detail: {
     *          currentMonth,
     *          lastMonth,
     *          total
     *      }
     * }
     */
    public function findVipFeeProfit($partnerId);

    public function findCodeFeeProfit($partnerId);

    public function findProductProfit($partnerId);

}