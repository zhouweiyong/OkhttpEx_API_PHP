<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16-3-17
 * Time: 下午3:59
 */

class Response{
    /**
     * 按json方式输出通信数据
     * @param integer $code 状态码
     * @param string $message 提示信息
     * @param array $data 数据
     * return string
     */
    public static function json($code, $message, $data = array(),$page = 1,$dataCount = "" ) {
        /**
         * 检测状态码是否为数字或者数字字符串
         */
        if(!is_numeric($code)) {
            return '';
        }

        if ($dataCount == "" ){//不需要分页
            /**
             * 把输出的数据封装成数组
             */
            $result = array(
                "flag" => $code,
                "msg" => $message,
                "rs"=>$data
            );
        } else{//分页
            $result = array(
                "flag" => $code,
                "msg" => $message,
                "page" => $page,
                "totalSize"=>$dataCount,
                "rs"=>$data
            );
        }


        return  json_encode($result);//把数组转换成Json格式数据，并输出
    }
}
