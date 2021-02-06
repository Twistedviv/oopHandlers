<?php
namespace app\Service\Impl;

require_once dirname(__FILE__).'/../../Dao/Impl/UserDaoImpl.php';
require_once dirname(__FILE__)."/../UserService.php";
require_once dirname(__FILE__)."/../../Common/Result.php";

use app\Common\Result;
use app\Service\UserService;
use app\Dao\Impl\UserDaoImpl;

class UserServiceImpl implements UserService
{

    /**
     * @param $idList 'id数组'
     * @return $userList '封装用户id 头像 电话 上传时间 真实用户名'
     */
    public function encapUserList($idList){
        $userList=array();
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
            $userModel=array('id'=>$user[0]['id'],'uname'=>$realName,'headimage_url'=>$user[0]['headimage_url'],'utel'=>$user[0]['utel'],
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

        $userDownLevelOneList=(new UserServiceImpl())->encapUserList($userDownLevelOneIdList);;
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

    /**
     * @return $newVipList ‘JSON化’
     */
    public function findNewVipList(){
        $userList=array();
        $vipIdAndTime=(new UserDaoImpl())->findNewVip();
//        $count = count($vipIdAndTime);
        $count = 30;
        for($i=0;$i<$count;$i++){
            $id=$vipIdAndTime[$i]['user_id'];
            $create_time=$vipIdAndTime[$i]['create_time'];
            $user=(new UserDaoImpl())->findUserByUserId($id);
            $real=(new UserDaoImpl())->findRealMessage($id);
            if(!empty($real)){
                $realName=$real[0]['name'];
            }
            else{
                $realName=$user[0]['uname'];
            }
            $content = "恭喜".$realName."成为会员";
            //封装所需数组
            $userModel=array('id'=>$user[0]['id'],'realName'=>$realName,'uname'=>$user[0]['uname'],'headimage'=>$user[0]['headimage_url'],'content'=>$content,
                'regtime'=>substr($create_time, 0 , 16));
            $userList[$i]=$userModel;
        }
        $result = new Result(1,'请求成功',$userList);
        return $result->send();
    }

    /**
     * @return $newPartnerList ‘JSON化’
     */
    public function findNewPartnerList(){
        $userList=array();
        $partnerIdAndTime=(new UserDaoImpl())->findNewPartner();
//        $count = count($partnerIdAndTime);
        $count = 30;
        for($i=0;$i<$count;$i++){
            $id=$partnerIdAndTime[$i]['user_id'];
            $create_time=$partnerIdAndTime[$i]['create_time'];
            $user=(new UserDaoImpl())->findUserByUserId($id);
            $real=(new UserDaoImpl())->findRealMessage($id);
            if(!empty($real)){
                $realName=$real[0]['name'];
            }
            else{
                $realName=$user[0]['uname'];
            }
            $content = "恭喜".$realName."成为合伙人";
            //封装所需数组
            $userModel=array('id'=>$user[0]['id'],'realName'=>$realName,'uname'=>$user[0]['uname'],'headimage'=>$user[0]['headimage_url'],'content'=>$content,
                'regtime'=>substr($create_time, 0 , 16));
            $userList[$i]=$userModel;

        }
        $result = new Result(1,'请求成功',$userList);
        return $result->send();
    }

    /**
     * @return $newLuckyList ‘JSON化’
     */
    public function findNewLuckyList(){
        $luckyList=array();
        $luckyIdAndTime=(new UserDaoImpl())->findNewLucky();
//        $count = count($luckyIdAndTime);
        $count = 30;
        for($i=0;$i<$count;$i++){
            $id=$luckyIdAndTime[$i]['uid'];
            $drawtime=$luckyIdAndTime[$i]['drawtime'];
            $user=(new UserDaoImpl())->findUserByUserId($id);
            $luckyUserData=(new UserDaoImpl())->findLuckyUserDataByUserId($id);
            $levelName = ['一等奖','二等奖'];
            //整理内容
            $content = "恭喜".$user[0]['uname']."获得".$levelName[$luckyUserData[0]['level']-1];
            //封装所需数组
            $userModel=array('id'=>$user[0]['id'],'uname'=>$user[0]['uname'],'headimage'=>$user[0]['headimage_url'],
                'level'=>$luckyUserData[0]['level'],'content'=>$content,'regtime'=>substr($drawtime, 0 , 16));
            $luckyList[$i]=$userModel;
        }
        $result = new Result(1,'请求成功',$luckyList);
        return $result->send();
    }
}