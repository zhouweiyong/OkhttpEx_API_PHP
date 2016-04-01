<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-3-17
 * Time: 下午4:02
 */

error_reporting(0);
include_once '../utils/db.php';
include_once '../utils/response.php';

$parameter=json_decode(file_get_contents( "php://input"),true );//把接收到的 json变成数组。
$page = $parameter["page"];
$pageSize = $parameter["pageSize"];

try {
    //连接数据库
    $conn = Db:: getInstance()->connect();
} catch (Exception $e) { //如果数据库连接失败，返回以下信息
    echo Response::json( "0","请求失败" );
    exit();
}


//获取数据总条数
$sql = "SELECT COUNT(*) AS count FROM zw_new";
$rs = mysql_fetch_array(mysql_query($sql,$conn));
$dataCount =$rs["count"];

//从数据库获取信息，并转成Json格式返回给客户端
$sql = "SELECT * FROM vst_new limit ".($page -1)*$pageSize."," .$pageSize;
$rs = mysql_query($sql,$conn);
$data = array();
while ($row = mysql_fetch_array($rs)) {//把从数据库获取的数据封装成数组
    $data[] = $row;
}

//sleep(30);
echo Response::json( "1","请求成功" ,$data,$page,$dataCount);

