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
    //dao层对象实例化
    private $userDao;
    function __construct(){
        $this->userDao=new UserDaoImpl();
    }

    /**
     * @param $userId
     * @return $fanList '粉丝列表'
     */
    public function findFanList($userId){
        function encap($fan){
            $fanlist=array();
            for($i=0;$i<count($fan);$i++){
                if($fan[$i]['name']==null){
                    $name=$fan[$i]['uname'];
                }
                else{
                    $name=$fan[$i]['name'];
                }
                //封装所需数组
                $userModel=array('id'=>$fan[$i]['user_id'],'uname'=>$name,'headimage_url'=>$fan[$i]['headimage_url'],'utel'=>$fan[$i]['utel'],
                    'create_time'=>substr($fan[$i]['create_time'] , 0 , 10));
                $fanlist[$i]=$userModel;
            }
            return $fanlist;
        }
        //A层粉丝表
        $fanListLevelA=$this->userDao->findFanListLevelA($userId);
        $fanListLevelA=encap($fanListLevelA);
        //B层粉丝表
        $fanListLevelB=$this->userDao->findFanListLevelB($userId);
        $fanListLevelB=encap($fanListLevelB);
        //总数
        $userNumbers=$this->userDao->findUserNumbers($userId);
        $total=$userNumbers[0]['invite_num'];
        //粉丝A数
        $ANum=count($fanListLevelA);
        //粉丝B数
        $BNum=count($fanListLevelB);
        //总数-粉丝A数-粉丝B数
        $fanMoreNum=$total-$ANum-$BNum;

        $userDownList=array('levelA'=>$fanListLevelA,'levelB'=>$fanListLevelB,'more'=>$fanMoreNum);
        $result = new Result(1,'请求成功',$userDownList);
        return $result->send();
    }

    /**
     * @param $userId
     * @return $vipList 'vip列表'
     */
    public function findVipList($userId){
        function encap($vip){
            $viplist=array();
            for($i=0;$i<count($vip);$i++){
                if($vip[$i]['name']==null){
                    $name=$vip[$i]['uname'];
                }
                else{
                    $name=$vip[$i]['name'];
                }
                //封装所需数组
                $userModel=array('id'=>$vip[$i]['user_id'],'uname'=>$name,'headimage_url'=>$vip[$i]['headimage_url'],'utel'=>$vip[$i]['utel'],
                    'create_time'=>substr($vip[$i]['create_time'] , 0 , 10));
                $viplist[$i]=$userModel;
            }
            return $viplist;
        }
        //vipA表
        $vipListLevelA=$this->userDao->findVipListLevelA($userId);
        $vipListLevelA=encap($vipListLevelA);
        //vipB表
        $vipListLevelB=$this->userDao->findVipListLevelB($userId);
        $vipListLevelB=encap($vipListLevelB);

        $userDownList=array('levelA'=>$vipListLevelA,'levelB'=>$vipListLevelB);
        $result = new Result(1,'请求成功',$userDownList);
        return $result->send();
    }

    /**
     * @param $userId
     * @return $partnerList 'partner列表'
     */
    public function findPartnerList($userId){
        function encap($partner){
            $partnerlist=array();
            for($i=0;$i<count($partner);$i++){
                if($partner[$i]['name']==null){
                    $name=$partner[$i]['uname'];
                }
                else{
                    $name=$partner[$i]['name'];
                }
                //封装所需数组
                $userModel=array('id'=>$partner[$i]['user_id'],'uname'=>$name,'headimage_url'=>$partner[$i]['headimage_url'],'utel'=>$partner[$i]['utel'],
                    'create_time'=>substr($partner[$i]['create_time'] , 0 , 10));
                $partnerlist[$i]=$userModel;
            }
            return $partnerlist;
        }
        //partnerA表
        $partnerListLevelA=$this->userDao->findPartnerListLevelA($userId);
        $partnerListLevelA=encap($partnerListLevelA);
        //partnerB表
        $partnerListLevelB=$this->userDao->findPartnerListLevelB($userId);
        $partnerListLevelB=encap($partnerListLevelB);
        //partnerC表
        $partnerListLevelC=$this->userDao->findPartnerListLevelC($userId);
        $partnerListLevelC=encap($partnerListLevelC);
        //总数
        $topList=$this->userDao->findTopPartnerList($userId);
        $total=count($topList);
        //partnerA数
        $ANum=count($partnerListLevelA);
        //partnerB数
        $BNum=count($partnerListLevelB);
        //partnerC数
        $CNum=count($partnerListLevelC);
        $partnerMoreNum=$total-$ANum-$BNum-$CNum;

        $partner=array('levelA'=>$partnerListLevelA,'levelB'=>$partnerListLevelB,
            'levelC'=>$partnerListLevelC,'more'=>$partnerMoreNum);
        $result = new Result(1,'请求成功',$partner);
        return $result->send();
    }

    /**
     * @return $newVipList ‘JSON化’
     */
    public function findNewVipList(){
        $userList=array();
        $vipIdAndTime=$this->userDao->findNewVip();
        $count = 30;
        for($i=0;$i<$count;$i++){
            $id=$vipIdAndTime[$i]['user_id'];
            $create_time=$vipIdAndTime[$i]['create_time'];
            $user=$this->userDao->findUserByUserId($id);
            $real=$this->userDao->findRealMessage($id);
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
        $partnerIdAndTime=$this->userDao->findNewPartner();
//        $count = count($partnerIdAndTime);
        $count = 30;
        for($i=0;$i<$count;$i++){
            $id=$partnerIdAndTime[$i]['user_id'];
            $create_time=$partnerIdAndTime[$i]['create_time'];
            $user=$this->userDao->findUserByUserId($id);
            $real=$this->userDao->findRealMessage($id);
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
     * @return $Lucky ‘JSON化’
     */
    public function findNewLuckyList(){
        $lucky=array();
        $luckyList=$this->userDao->findNewLuckyData();
        for($i=0;$i<count($luckyList);$i++){
            $levelName = ['一等奖','二等奖'];
            //整理内容
            $content = "恭喜".$luckyList[$i]['uname']."获得".$levelName[($luckyList[$i]['level']-1)];
            //封装所需数组
            $userModel=array('id'=>$luckyList[$i]['uid'],'uname'=>$luckyList[$i]['uname'],'headimage'=>$luckyList[$i]['headimage_url'],
                'level'=>$luckyList[$i]['level'],'content'=>$content,'regtime'=>substr($luckyList[$i]['result_time'], 0 , 16));
            $lucky[$i]=$userModel;
        }
        $result = new Result(1,'请求成功',$lucky);
        return $result->send();
    }

    /**
     * @param $userId
     * @param $name
     * @param $phone
     * @param $site
     * @param $isDefault
     * @return $result '实现数据插入反馈操作结果'
     */
    public function addUserReceiveAddress($userId, $name, $phone, $site, $isDefault){
        //定义错误变量
        $error=0;
        $result=0;
        if($name==""){
            $result = new Result(2,'收获人姓名不能为空',"");
            $error=1;
        }
        if($error==0&&mb_strlen($name)>10){
            $result = new Result(2,'收获人姓名长度不能大于10',"");
            $error=1;
        }
        if($error==0&&$phone==""){
            $result = new Result(2,'收获人电话不能为空',"");
            $error=1;
        }
        if($error==0&&strlen($phone)<>11){
            $result = new Result(2,'收获人电话必须为11位',"");
            $error=1;
        }
        if($error==0&&$site==""){
            $result = new Result(2,'收获人地址不能为空',"");
            $error=1;
        }
        if($error==0&&mb_strlen($site)>63){
            $result = new Result(2,'收获人地址长度过长',"");
            $error=1;
        }
        if($error==0){
            //实现插入数据
            $re=$this->userDao->addUserReceiveAddress($userId, $name, $phone, $site, $isDefault);
            //更新user表中默认收获地址
            if($isDefault==1){
                $addressId=$re['id'];
                $this->userDao->UpdateAddressIdByUserId($userId,$addressId);
            }
            if($re){
                $result = new Result(0,'数据插入成功','数据插入成功');
            }
            else{
                $result = new Result(0,'数据插入失败','数据插入失败');
            }
        }
        return $result->send();
    }

    /**
     * @param $userId
     * @return $userReceiveAddressList '收货地址列表'
     */
    public function findUserReceiveAddress($userId){
        $userReceiveAddressList=array();
        $userReceiveAddress=$this->userDao->findUserReceiveAddress($userId);
        for($i=0;$i<count($userReceiveAddress);$i++){
            $userReceiveAddressList[$i]=array(
                'id'=> $userReceiveAddress[$i]['id'],
                'userId'=> $userReceiveAddress[$i]['user_id'],
                'name'=> $userReceiveAddress[$i]['name'],
                'phone'=> $userReceiveAddress[$i]['phone'],
                'site'=> $userReceiveAddress[$i]['site'],
                'isDefault'=> $userReceiveAddress[$i]['is_default'],
            );
        }
        $result = new Result(0,'请求成功',$userReceiveAddressList);
        return $result->send();
    }

    /**
     * @param $addressId
     * @return $res
     */
    public function deleteUserReceiveAddressByAddressId($addressId){
        $res=$this->userDao->deleteUserReceiveAddressByAddressId($addressId);
        $result = new Result(0,'删除成功',$res);
        return $result->send();
    }

    /**
     * @param $addressId
     * @param $name
     * @param $phone
     * @param $site
     * @param $userId
     * @param $isDefault
     * @return $res
     */
    public function updateUserReceiveAddressByAddressId($addressId,$userId, $name, $phone, $site, $isDefault){
        //定义错误变量
        $error=0;
        $result=0;
        if($name==""){
            $result = new Result(2,'收获人姓名不能为空',"");
            $error=1;
        }
        if($error==0&&mb_strlen($name)>10){
            $result = new Result(2,'收获人姓名长度不能大于10',"");
            $error=1;
        }
        if($error==0&&$phone==""){
            $result = new Result(2,'收获人电话不能为空',"");
            $error=1;
        }
        if($error==0&&strlen($phone)<>11){
            $result = new Result(2,'收获人电话必须为11位',"");
            $error=1;
        }
        if($error==0&&$site==""){
            $result = new Result(2,'收获人地址不能为空',"");
            $error=1;
        }
        if($error==0&&mb_strlen($site)>63){
            $result = new Result(2,'收获人地址长度过长',"");
            $error=1;
        }
        if($error==0){
            $res=$this->userDao->updateUserReceiveAddressByAddressId
            ($addressId,$name,$phone,$site,$isDefault);
            //更新user表中默认收获地址
            if($isDefault==1){
                $this->userDao->UpdateAddressIdByUserId($userId,$addressId);
            }
            $result = new Result(0,'编辑成功',$res);

        }
        return $result->send();
    }
}