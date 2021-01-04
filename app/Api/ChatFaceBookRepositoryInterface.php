<?php

namespace App\Api;

Interface ChatFaceBookRepositoryInterface
{
    /**
     * @param int $UserId
     * @return \App\ChatFaceBook
     */
    public function getFaceBookByUserId($UserId);

    /**
     * @param int $UserId
     * @param string $FaceBookId
     * @return \App\ChatFaceBook
     */

    public function CheckFaceBookIdName($UserId,$FaceBookId);

    /**
     * @param int $UserId
     * @param string $facebookId
     * @param string $facebookTitle
     * @return \App\ChatFaceBook
     */

    public function createChatFaceBook($UserId,$facebookId,$facebookTitle);

    /**
     * @param int $id
     * @return \App\ChatFaceBook
     */
    public function getChatFaceBookId($id);

    /**
     * @param int $UserId
     * @param string $FaceBookId
     * @param int $id
     * @return \App\ChatFaceBook
     */
    public function CheckFaceBookIdNameUpdate($UserId,$FaceBookId,$id);

    /**
     * @param int $id
     * @param string $facebookId
     * @param string $facebookTitle
     * @return \App\ChatFaceBook
     */
    public function ChatFaceBookUpdate($id,$facebookId,$facebookTitle);

    /**
     * @param int $id
     * @return \App\ChatFaceBook
     */
    public function DeleteChatFaceBook($id);
}
