<?php
    require_once dirname(__FILE__).'/../Common/DB.php';
    use app\Common\DB;

    //将invite_num清零
//    $sql="UPDATE ums_user SET invite_num=0";
//    $db = new DB();
//    $rs=$db ->execUpdate($sql);

    $sql1="select * from ums_user";
    $db = new DB();
    $res=$db ->execQuery($sql1);
    //print_r($res);
    for($i=0;$i<count($res);$i++) {
        $id=$res[$i]['invite_id'];
        while($id!=0){
            $sql2="UPDATE ums_user SET invite_num=invite_num+1 where id=$id";
            $rs=$db ->execUpdate($sql2);
            $sql3="select invite_id from ums_user where id=$id";
            $m_id=$db ->execQuery($sql3);
            $id=$m_id[0]['invite_id'];
        }
    }


