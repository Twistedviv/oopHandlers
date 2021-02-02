<?php
namespace app\Service\Impl;

require_once dirname(__FILE__).'/../../Dao/Impl/UserDaoImpl.php';
use app\Dao\Impl\UserDaoImpl;
require_once dirname(__FILE__)."/../UserService.php";
use app\Service\UserService;




class UserServiceImpl implements UserService
{

    /**
     * @param $idList 'id数组'
     * @return $userList '封装用户id 头像 电话 上传时间 真实用户名'
     */
    public function encapUserList($idList){
        $userList=null;
        for($i=0;$i<count($idList);$i++){
            //取得每一个id
            $id=$idList[$i]['user_id'];
            //获得user(*)
            $user=(new UserDaoImpl())->findUserByUserId($id);
            //获得用户名
            $real=(new UserDaoImpl())->findRealMessage($id);
            if(!empty($real)){
                $realName=$real[0]['name'];
            }
            else{
                $realName=$user[0]['uname'];
            }
            //封装所需数组
            $userModel=array('id'=>$user[0]['id'],'name'=>$realName,'headimage_url'=>$user[0]['headimage_url'],'utel'=>$user[0]['utel'],
                'create_time'=>substr($user[0]['create_time'] , 0 , 10));
            $userList[$i]=$userModel;
        }
        return $userList;
    }

    /**
     * @param $userId
     * @return $userDownLevelOneList '直接邀请的用户数组'
     */
    public function findDownUserLevelOne($userId){
        $userDownLevelOneIdList=(new UserDaoImpl())->findDownUserLevelOneIdByUserId($userId);
        $userDownLevelOneList=(new UserServiceImpl())->encapUserList($userDownLevelOneIdList);
        return $userDownLevelOneList;
    }

    /**
     * @param $userId
     * @return $userDownLevelTwoList '直接邀请的直接邀请的用户数组'
     */
    public function findDownUserLevelTwo($userId){
        $userDownLevelTwoIdList=(new UserDaoImpl())->findDownUserLevelTwoIdByUserId($userId);
        $userDownLevelTwoList=(new UserServiceImpl())->encapUserList($userDownLevelTwoIdList);
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
        $userDownLevelOneVipIdList=(new UserDaoImpl())->findDownVipLevelOneIdByUserId($userId);
        $userDownLevelOneVipList=(new UserServiceImpl())->encapUserList($userDownLevelOneVipIdList);
        return $userDownLevelOneVipList;
    }

    /**
     * @param $userId
     * @return $userDownLevelTwoVipList '直接邀请的直接邀请的vip数组'
     */
    public function findDownVipLevelTwo($userId){
        $userDownLevelTwoVipIdList=(new UserDaoImpl())->findDownVipLevelTwoIdByUserId($userId);
        $userDownLevelTwoVipList=(new UserServiceImpl())->encapUserList($userDownLevelTwoVipIdList);
        return $userDownLevelTwoVipList;
    }

    /**
     * @param $userId
     * @return $myDownPartnerFirstList '自己下方各分支的第一个合伙人数组'
     */
    public function findMyDownPartnerFirst($userId){
        $myDownPartnerFirstIdList=(new UserDaoImpl())->findMyDownPartnerFirstIdList($userId);
        $myDownPartnerFirstList=(new UserServiceImpl())->encapUserList($myDownPartnerFirstIdList);
        return $myDownPartnerFirstList;
    }

    /**
     * @param $userId
     * @return $partnerADownPartnerFirstList '合伙人A下方各分支的第一个合伙人数组'
     */
    public function findPartnerADownPartnerFirst($userId){
        $partnerADownPartnerFirstIdList=(new UserDaoImpl())->findPartnerADownPartnerFirstIdList($userId);
        $partnerADownPartnerFirstList=(new UserServiceImpl())->encapUserList($partnerADownPartnerFirstIdList);
        return $partnerADownPartnerFirstList;
    }

    /**
     * @param $userId
     * @return $partnerADownPartnerFirstList '合伙人B下方各分支的第一个合伙人数组'
     */
    public function findPartnerBDownPartnerFirst($userId){
        $partnerBDownPartnerFirstIdList=(new UserDaoImpl())->findPartnerBDownPartnerFirstIdList($userId);
        $partnerBDownPartnerFirstList=(new UserServiceImpl())->encapUserList($partnerBDownPartnerFirstIdList);
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