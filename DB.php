<?php


namespace DB;


class DB
{
    const CONFIG = [
        'host' => '39.105.58.2',
        'user' => 'db_qunshang',
        'password' => 'root',
        'charset' => 'utf8mb4',
        'dbname' => 'db_qunshang',
        'port' => 3306
    ];

    private function getConect(){
        //数据库默认连接信息

        $link = @mysqli_connect($this->CONFIG['host'] . ':' . $this->CONFIG['port'], $this->CONFIG['user'], $this->CONFIG['password']);
        if (!$link) {
            die('数据库连接失败!') . mysqli_error();
        }
        //设置字符集，选择数据库
        mysqli_query('set names ' . $this->CONFIG['charset']);
        mysqli_query('use `' . $this->CONFIG['dbname'] . '`');
        return $link;
    }

    public static function execQuery($strQuery){
        $link = getConect();
        $res = @mysqli_query($strQuery, $link);
        if (!$res) die(mysqli_error());
        //定义结果数组，用以保存结果信息
        $results = array();
        //遍历结果集，获取每条记录的详细数据
        while ($row = mysqli_fetch_assoc($res)) {
            //把从结果集中取出的每一行数据赋值给$emp_info数组
            $results[] = $row;
        }
        mysqli_free_result($res);//释放记录集
        mysqli_close();//关闭数据库连接
        return $results;
    }

    public static function execUpdate($strUpdate){
        $link = getConect();
        $res = @mysqli_query($strUpdate, $link);
        if (!$res) die('数据库操作失败!') . mysqli_error();
        mysqli_close();
        return $res;
    }

    //额外返回新增记录id
    public static function execUpdateWithId($strUpdate){
        $link = getConect();
        $res = @mysqli_query($strUpdate, $link);
        if (!$res) die('数据库操作失败!') . mysqli_error();
        $id = mysqli_insert_id($link);
        $resWithId = array(
            'res' => $res,
            'id' => $id
        );
        return $res;
    }
}
