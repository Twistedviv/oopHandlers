<?php

namespace app\Service;


interface UserService
{
    /**
     * @param $userId
     * @return $fanList '粉丝列表'
     */
    public function findFanList($userId);

    /**
     * @param $userId
     * @return $vipList 'vip列表'
     */
    public function findVipList($userId);

    /**
     * @param $userId
     * @return $partnerList 'partner列表'
     */
    public function findPartnerList($userId);

    /**
     * @return $newVipList ‘JSON化’
     */
    public function findNewVipList();

    /**
     * @return $newPartnerList ‘JSON化’
     */
    public function findNewPartnerList();

    /**
     * @return $Lucky ‘JSON化’
     */
    public function findNewLuckyList();

    /**
     * @param $userId
     * @param $name
     * @param $phone
     * @param $site
     * @param $isDefault
     * @return $result '实现数据插入反馈操作结果'
     */
    public function addUserReceiveAddress($userId, $name, $phone, $site, $isDefault);

    /**
     * @param $userId
     * @return $userReceiveAddressList '收货地址列表'
     */
    public function findUserReceiveAddress($userId);

    /**
     * @param $addressId
     * @return $res
     */
    public function deleteUserReceiveAddressByAddressId($addressId);

    /**
     * @param $addressId
     * @param $name
     * @param $phone
     * @param $site
     * @param $userId
     * @param $isDefault
     * @return $res
     */
    public function updateUserReceiveAddressByAddressId($addressId,$userId, $name, $phone, $site, $isDefault);





}