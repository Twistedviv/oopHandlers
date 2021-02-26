<?php
    require_once dirname(__FILE__)."/../Service/Impl/ProfitServiceImpl.php";

    use app\Service\Impl\ProfitServiceImpl;

    $partnerId=$_GET['partnerId'];
    //粉丝列表
    $PartnerFee=(new ProfitServiceImpl)->findCodeFeeProfit($partnerId);
    echo $PartnerFee;