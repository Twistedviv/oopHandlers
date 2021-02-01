<?php


namespace app\Common;


class DB
{
    //服务器地址
    private $serverName = '106.14.206.115';
    //数据库用户名
    private $userName = 'db_qunshang';
    //数据库密码
    private $password = 'Kh@szas6rxwbZjzf';
    //数据库名称
    private $dbName = 'db_qunshang';
    //数据库端口号
    private $port = 9851;
    //数据库字符集
    private $charset = "utf8mb4";
    //数据库资源符
    private $link;



    /**
     * DB constructor.
     * @param $serverName
     * @param $userName
     * @param $password
     * @param $dbName
     * @param $port
     * @param $link
     */
    public function __construct()
    {
        $this->getConnect();
    }

    private function getConnect(){
        $this->link = mysqli_connect($this->serverName,$this->userName,$this->password,$this->dbName,$this->port);
        $this->link->query("set names ".$this->charset);
    }

    public function execQuery($sql){
        $rs = $this->link->query($sql);
        $resultArray = array();
        if ($rs->num_rows > 0) {
            while($row = $rs->fetch_assoc()) {
                array_push($resultArray,$row);
            }
        }
        return $resultArray;
    }

    public function execUpdate($sql){
        $rs = $this->link->query($sql);
        if (!$rs) die('数据库操作失败!') . mysqli_error();
        return $rs;
    }

    public function getLastInsertId(){
        $rs = $this->link->mysqli_inset_id();
        return $rs;
    }

}
