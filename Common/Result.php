<?php


namespace app\Common;


class Result
{
    /**
     * @var
     */
    private $statusCode ;
    /**
     * @var
     */
    private $message ;
    /**
     * @var
     */
    private $data ;

    /**
     * Result constructor.
     * @param $statusCode   '0 => Success, 1 => Warning , 2 => Error'
     * @param $message      'statusCode为2时必须清楚描述,其余时可直接为0'
     * @param $data         '返回数据'
     */
    public function __construct($statusCode, $message, $data)
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->data = $data;

    }


    /**
     * @return $res 'Response的json字符串'
     */
    public function send(){
        $res = array(
            'statusCode' => $this-> statusCode,
            'message' => $this-> message,
            'data' => $this-> data
        );

        $res = json_encode($res);

        return $res;
    }



}