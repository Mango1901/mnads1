<?php

namespace App\Api;

Interface ChatZaloRepositoryInterface
{
    /**
     * @param int $userId
     * @return \App\ChatZalo
     */
    public function getChatZaloByUserId($userId);

    /**
     * @param int $userId
     * @param string $zaloName
     * @return \App\ChatZalo
     */
    public function CheckZaloNameExist($userId,$zaloName);

    /**
     * @param int $userId
     * @param String $zaloName
     * @param String $zaloTitle
     * @return \App\ChatZalo
     */
    public function CreateChatZalo($userId,$zaloName,$zaloTitle);

    /**
     * @param int $id
     * @return \App\ChatZalo
     */
    public function getChatZaloId($id);

    /**
     * @param int $userId
     * @param string $zaloName
     * @param int $id
     * @return \App\ChatZalo
     */
    public function CheckZaloNameUpdate($userId,$zaloName,$id);

    /**
     * @param int $id
     * @param string $zaloName
     * @param string $zaloTitle
     * @return \App\ChatZalo
     */
    public function UpdateChatZalo($id,$zaloName,$zaloTitle);

    /**
     * @param int $id
     * @return \App\ChatZalo
     */
    public function deleteChatZalo($id);
}
