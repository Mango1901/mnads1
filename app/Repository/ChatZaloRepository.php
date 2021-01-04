<?php

namespace App\Repository;

use App\Api\ChatZaloRepositoryInterface;
use App\ChatZalo;

class ChatZaloRepository implements  ChatZaloRepositoryInterface
{
    protected $_ChatZaloModels;

    /**
     * ChatZaloRepository constructor.
     * @param ChatZalo $chatZalo
     */

    public function __construct(ChatZalo $chatZalo)
    {
        $this->_ChatZaloModels = $chatZalo;
    }

    /**
     * @param int $userId
     * @return \App\ChatZalo
     */
    public function getChatZaloByUserId($userId)
    {
      return $this->_ChatZaloModels->where("user_id",$userId)->where("status",0)->get();
    }

    /**
     * @param int $userId
     * @param string $zaloName
     * @return ChatZalo
     */

    public function CheckZaloNameExist($userId,$zaloName){
        return $this->_ChatZaloModels->where("user_id",$userId)->where("zalo_name",$zaloName)->first();
    }

    /**
     * @param int $userId
     * @param String $zaloName
     * @param String $zaloTitle
     * @return ChatZalo
     */

    public function CreateChatZalo($userId,$zaloName,$zaloTitle){
        return $this->_ChatZaloModels->insert(
            array('user_id'=>$userId,'zalo_name'=>$zaloName,'zalo_title'=>$zaloTitle)
        );
    }

    /**
     * @param int $id
     * @return ChatZalo
     */
    public function getChatZaloId($id){
      return $this->_ChatZaloModels->where('id',$id)->where('status',0)->first();
    }

    /**
     * @param int $userId
     * @param string $zaloName
     * @param int $id
     * @return ChatZalo
     */
    public function CheckZaloNameUpdate($userId,$zaloName,$id){
        return $this->_ChatZaloModels->where('user_id',$userId)->where('zalo_name',$zaloName)->whereNotIn('id',[$id])->first();
    }

    /**
     * @param int $id
     * @param string $zaloName
     * @param string $zaloTitle
     * @return ChatZalo
     */

    public function UpdateChatZalo($id,$zaloName,$zaloTitle){
        return $this->_ChatZaloModels->where("id",$id)->update(
            array('zalo_name'=>$zaloName,'zalo_title'=>$zaloTitle)
        );
    }

    /**
     * @param int $id
     * @return ChatZalo
     */
    public function deleteChatZalo($id){
        return $this->_ChatZaloModels->where("id",$id)->update(["status"=>1]);
    }
}
