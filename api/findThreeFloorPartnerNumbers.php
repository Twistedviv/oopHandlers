<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];
    //总数
    $findTopPartnerDownNumbers=(new UserServiceImpl)->findTopPartnerDownNumbers($userId);

    //my down numbers
    $myDownPartnerFirstList=(new UserServiceImpl)->findMyDownPartnerFirst($userId);
    $mydownnumbers=count($myDownPartnerFirstList);
    //echo $mydownnumbers." ";

    //partnerA down numbers
    $partnerADownPartnerFirstList=(new UserServiceImpl)->findPartnerADownPartnerFirst($userId);
    $partnerAdownnumbers=count($partnerADownPartnerFirstList);
    //echo $partnerAdownnumbers." ";
    //partnerB down numbers
    $partnerBDownPartnerFirstList=(new UserServiceImpl)->findPartnerBDownPartnerFirst($userId);
    $partnerBdownnumbers=count($partnerBDownPartnerFirstList);
    //echo $partnerBdownnumbers." ";

    $threeFloorPartnerNumbers=$findTopPartnerDownNumbers-$mydownnumbers-$partnerAdownnumbers-$partnerBdownnumbers;
    $result = new Result(1,'请求成功',$threeFloorPartnerNumbers);
    echo $result->send();
