<?php

namespace App\Api;

interface CallRepositoryInterface
{
    /**
     * @param int $userId
     * @return \App\Call
     */
    public function getCallUserId($userId);

    /**
     * @param int  $userId
     * @param int  $phone_number
     * @return \App\Call
     */

    public function checkPhoneNumber($userId,$phone_number);


    /**
     * @param $userId
     * @param $name
     * @param $phoneNumber
     * @param $description
     * @return \App\Call
     */

    public function CreateCall($userId,$name,$phoneNumber,$description);

    /**
     * @param int $callId
     * @return \App\Call
     */

    public function EditCall($callId);

    /**
     * @param int $userId
     * @param int $phone_number
     * @param int $callId
     * @return \App\Call
     */

    public function checkPhoneNumberUpdate($userId,$phone_number,$callId);

    /**
     * @param int $callId
     * @return \App\Call
     */

    public function getCallId($callId);

    /**
     * @param int $callId
     * @return \App\Call
     */

    public function deleteCall($callId);

    /**
     * @param $callId
     * @param $name
     * @param $phone
     * @param $description
     * @return \App\Call
     */

    public function updateCall($callId,$name,$phone,$description);
}
