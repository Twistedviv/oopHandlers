<?php
    require_once dirname(__FILE__)."/../Service/Impl/UserServiceImpl.php";
    require_once "../Common/Result.php";

    use app\Common\Result;
    use app\Service\Impl\UserServiceImpl;

    $userId=$_GET['userId'];

    //myDownPartnerFirstList
    $myDownPartnerFirstList=(new UserServiceImpl)->findMyDownPartnerFirst($userId);

    //partnerADownPartnerFirstList
    $partnerADownPartnerFirstList=(new UserServiceImpl)->findPartnerADownPartnerFirst($userId);

    //partnerBDownPartnerFirstList
    $partnerBDownPartnerFirstList=(new UserServiceImpl)->findPartnerBDownPartnerFirst($userId);

    //threeFloorPartnerNumbers
    //总数
    $findTopPartnerDownNumbers=(new UserServiceImpl)->findTopPartnerDownNumbers($userId);
    //my down numbers
    $myDownPartnerFirstList=(new UserServiceImpl)->findMyDownPartnerFirst($userId);
    $mydownnumbers=count($myDownPartnerFirstList);
    //partnerA down numbers
    $partnerADownPartnerFirstList=(new UserServiceImpl)->findPartnerADownPartnerFirst($userId);
    $partnerAdownnumbers=count($partnerADownPartnerFirstList);
    //partnerB down numbers
    $partnerBDownPartnerFirstList=(new UserServiceImpl)->findPartnerBDownPartnerFirst($userId);
    $partnerBdownnumbers=count($partnerBDownPartnerFirstList);

    $partner=array('levelA'=>$myDownPartnerFirstList,'levelB'=>$partnerADownPartnerFirstList,
                'levelC'=>$partnerBDownPartnerFirstList,'more'=>$partnerBdownnumbers);
    $result = new Result(1,'请求成功',$partner);
    echo $result->send();