<?php
    require_once dirname(__FILE__)."/../Service/Impl/MessageServiceImpl.php";

    use app\Service\Impl\MessageServiceImpl;

    $Id=$_POST['noticeId'];

    $res=(new MessageServiceImpl)->updateCheckedStatusById($Id);
    echo $res;