<?php
namespace app\Dao\Impl;

require_once '../../Common/DB.php';
use app\Common\DB;

class UserDaoImpl
{

    /**
     * @param $userId
     * @return $userList '直接邀请的用户数组'
     */
    public function findDownUserLevelOne($userId){
        $sql="select `uname`,`headimage_url`,`utel`,`create_time` from ums_invite,ums_user where ums_invite.up_user_id_1 = ums_user.id";
        $db = new DB();
        $res=$db ->execQuery($sql);
        return $res;
    }

}
