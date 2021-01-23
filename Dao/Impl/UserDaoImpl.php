<?php
namespace app\Dao\Impl;

require_once dirname(__FILE__).'/../../Common/DB.php';
use app\Common\DB;

class UserDaoImpl
{

    /**
     * @param $userId
     * @return $userList '直接邀请的用户数组'
     */
    public function findDownUserLevelOne($userId){
        $sql="select uname,headimage_url,utel,create_time from ums_user where id in (
select user_id from ums_invite where ums_invite.up_user_id_1 = $userId)";
        $db = new DB();
        $res=$db ->execQuery($sql);
        return $res;
    }

}
