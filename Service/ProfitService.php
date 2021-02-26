<?php


namespace app\Service;


interface ProfitService
{

    /**
     * @param $partnerId
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
     * @param $partnerId
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

    /**
     * @param $partnerId
     * @return $codeFeeProfit
     */
    public function findCodeFeeProfit($partnerId);

    public function findProductProfit($partnerId);

}