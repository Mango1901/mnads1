<?php

namespace App\Api;

Interface ContactRepositoryInterface
{
    /**
     * @param int  $userId
     * @return \App\Contact
     */
    public function GetContactByUserId($userId);

    /**
     * @param int $userId
     * @param int $phoneNumber
     * @return \App\Contact
     */
    public function CheckContactPhoneNumberExist($userId,$phoneNumber);

    /**
     * @param int $userId
     * @param string $title
     * @param int $number
     * @param string $description
     * @return \App\Contact
     */
    public function CreateContact($userId,$title,$number,$description);

    /**
     * @param int $id
     * @return \App\Contact
     */
    public function getContactById($id);

    /**
     * @param int $userId
     * @param int $phoneNumber
     * @param int $id
     * @return \App\Contact
     */
    public function CheckContactPhoneNumberUpdateExist($userId, $phoneNumber,$id);

    /**
     * @param int $id
     * @param string $title
     * @param int $number
     * @param string $description
     * @return \App\Contact
     */
    public function UpdateContact($id,$title,$number,$description);

    /**
     * @param int $id
     * @return \App\Contact
     */
    public function DeleteContact($id);
}
