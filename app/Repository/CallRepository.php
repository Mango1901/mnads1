<?php

namespace App\Repository;

use App\Api\CallRepositoryInterface;
use App\Call;

class CallRepository implements CallRepositoryInterface
{
    protected $_CallModel;

    /**
     * CallRepository constructor.
     * @param Call $call
     */

    public function __construct(Call $call)
    {
        $this->_CallModel = $call;
    }

    /**
     * @param int $userId
     * @return Call
     */

    public function getCallUserId($userId)
    {
        return $this->_CallModel->where('user_id',$userId)->where('status',0)->get();
    }

    /**
     * @param int $userId
     * @param int $phone_number
     * @return Call
     */

    public function checkPhoneNumber($userId,$phone_number)
    {
        return $this->_CallModel->where('user_id',$userId)->where('phone_number',$phone_number)->first();
    }

    /**
     * @param $userId
     * @param $name
     * @param $phoneNumber
     * @param $description
     * @return Call
     */

    public function CreateCall($userId,$name,$phoneNumber,$description)
    {
        return $this->_CallModel->create(
            array('user_id'=>$userId,'name'=>$name,'phone_number'=>$phoneNumber,'description'=>$description)
        );
    }

    /**
     * @param int $callId
     * @return Call
     */

    public function EditCall($callId)
    {
        return $this->_CallModel->where('id',$callId)->where('status',0)->first();
    }

    public function checkPhoneNumberUpdate($userId,$phone_number,$callId)
    {
        return $this->_CallModel->where('user_id',$userId)->where('phone_number',$phone_number)->whereNotIn('id',[$callId])->first();
    }

    /**
     * @param int $callId
     * @return Call
     */

    public function getCallId($callId)
    {
        return $this->_CallModel->where("id",$callId)->where("status",0)->first();
    }

    /**
     * @param int $callId
     * @return Call
     */

    public function deleteCall($callId)
    {
        return $this->_CallModel->where("id",$callId)->update(['status'=>1]);
    }

    /**
     * @param $callId
     * @param $name
     * @param $phone
     * @param $description
     * @return Call
     */

    public function updateCall($callId,$name,$phone,$description)
    {
        return $this->_CallModel->where("id",$callId)->update(
            array('name'=>$name,'phone_number'=>$phone,'description'=>$description
            ));
    }

}
