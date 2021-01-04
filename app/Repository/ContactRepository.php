<?php

namespace App\Repository;

use App\Api\ContactRepositoryInterface;
use App\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    protected $_ContactModels;

    /**
     * ContactRepository constructor.
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->_ContactModels = $contact;
    }

    /**
     * @param $userId
     * @return Contact
     */
    public function GetContactByUserId($userId)
    {
      return $this->_ContactModels->where("user_id",$userId)->where("status",0)->get();
    }

    /**
     * @param $userId
     * @param $phoneNumber
     * @return Contact
     */

    public function CheckContactPhoneNumberExist($userId,$phoneNumber){
        return $this->_ContactModels->where("user_id",$userId)->where("number",$phoneNumber)->first();
    }

    /**
     * @param $userId
     * @param $title
     * @param $number
     * @param $description
     * @return Contact
     */
    public function CreateContact($userId,$title,$number,$description){
        return $this->_ContactModels->create(
            array('user_id'=>$userId,'title'=>$title, 'number'=>$number,'description'=>$description)
        );
    }

    /**
     * @param int $id
     * @return Contact
     */
    public function getContactById($id){
        return $this->_ContactModels->where("id",$id)->where("status",0)->first();
    }

    /**
     * @param int $userId
     * @param int $phoneNumber
     * @param int $id
     * @return Contact
     */
    public function CheckContactPhoneNumberUpdateExist($userId, $phoneNumber,$id)
    {
       return $this->_ContactModels->where('user_id',$userId)->where('number',$phoneNumber)->whereNotIn('id',[$id])->first();
    }

    /**
     * @param int $id
     * @param string $title
     * @param int $number
     * @param string $description
     * @return Contact
     */
    public function UpdateContact($id, $title, $number,$description)
    {
        return $this->_ContactModels->where("id",$id)->update(
            array('title'=>$title,'number'=>$number, 'description'=>$description
        ));
    }

    /**
     * @param int $id
     * @return Contact
     */
    public function DeleteContact($id)
    {
       return $this->_ContactModels->where("id",$id)->update(["status"=>1]);
    }
}
