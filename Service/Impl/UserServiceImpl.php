<?php
namespace app\Service\Impl;

require_once dirname(__FILE__).'/../../Dao/Impl/UserDaoImpl.php';
use app\Dao\Impl\UserDaoImpl;
require_once dirname(__FILE__)."/../UserService.php";
use app\Service\UserService;




class UserServiceImpl implements UserService
{

//    /**
//     * @param $userPartArrayList '部分用户属性'
//     * return $userPartArrayList '更新时间后的数据'
//     */
//    public function updateTimeUser($userPartArrayList){
//        print_r($userPartArrayList);
//        $numbers=count($userPartArrayList);
//        return $userPartArrayList;
//    }
    /**
     * @param $userId
     * @return $userDownLevelOneList '直接邀请的用户数组'
     */
    public function findDownUserLevelOne($userId){
        $userDownLevelOneList=(new UserDaoImpl())->findDownUserLevelOne($userId);
        //$userDownLevelOneList=(new UserServiceImpl())->updateTimeUser($userDownLevelOneList);
        return $userDownLevelOneList;
    }

    /**
     * @param $userId
     * @return $userDownLevelTwoList '直接邀请的直接邀请的用户数组'
     */
    public function findDownUserLevelTwo($userId){
        $userDownLevelTwoList=(new UserDaoImpl())->findDownUserLevelTwo($userId);
        return $userDownLevelTwoList;
    }

    /**
     * @param $userId
     * @return $userNumbers '以自己为根的总数'
     */
    public function findUserNumbers($userId){
        $userNumbers=(new UserDaoImpl())->findUserNumbers($userId);
        $total=$userNumbers[0]['invite_num'];
        return $total;
    }

    /**
     * @param $userId
     * @return $userDownLevelOneVipList '以自己为根的总数 数组'
     */
    public function findDownVipLevelOne($userId){
        $userDownLevelOneVipList=(new UserDaoImpl())->findDownVipLevelOne($userId);
        return $userDownLevelOneVipList;
    }

    /**
     * @param $userId
     * @return $userDownLevelTwoVipList '直接邀请的直接邀请的vip数组'
     */
    public function findDownVipLevelTwo($userId){
        $userDownLevelTwoVipList=(new UserDaoImpl())->findDownVipLevelTwo($userId);
        return $userDownLevelTwoVipList;
    }

    /**
     * @param $userId
     * @return $myDownPartnerFirstList '自己下方各分支的第一个合伙人数组'
     */
    public function findMyDownPartnerFirst($userId){
        $myDownPartnerFirstList=(new UserDaoImpl())->findMyDownPartnerFirst($userId);
        return $myDownPartnerFirstList;
    }

    /**
     * @param $userId
     * @return $partnerADownPartnerFirstList '合伙人A下方各分支的第一个合伙人数组'
     */
    public function findPartnerADownPartnerFirst($userId){
        $partnerADownPartnerFirstList=(new UserDaoImpl())->findPartnerADownPartnerFirst($userId);
        return $partnerADownPartnerFirstList;
    }

    /**
     * @param $userId
     * @return $partnerADownPartnerFirstList '合伙人B下方各分支的第一个合伙人数组'
     */
    public function findPartnerBDownPartnerFirst($userId){
        $partnerBDownPartnerFirstList=(new UserDaoImpl())->findPartnerBDownPartnerFirst($userId);
        return $partnerBDownPartnerFirstList;
    }

    /**
     * @param $userId
     * @return $topPartnerDownNumbers '创始合伙人下各分支总数'
     */
    public function findTopPartnerDownNumbers($userId){
        $topPartnerDownNumbersList=(new UserDaoImpl())->findTopPartnerDownNumbersList($userId);
        $topPartnerDownNumbers=count($topPartnerDownNumbersList);
        return $topPartnerDownNumbers;
    }


}