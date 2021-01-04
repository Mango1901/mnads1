<?php
namespace App\Repository;

use App\Api\ChatFaceBookRepositoryInterface;
use App\ChatFaceBook;

class ChatFaceBookRepository implements ChatFaceBookRepositoryInterface
{
    protected $_ChatFaceBookModels;

    public function __construct(ChatFaceBook $chatFaceBook)
    {
        $this->_ChatFaceBookModels = $chatFaceBook;
    }

    /**
     * @param int $UserId
     * @return \App\ChatFaceBook
     */
    public function getFaceBookByUserId($UserId){
        return $this->_ChatFaceBookModels->where("user_id",$UserId)->where("status",0)->get();
    }

    /**
     * @param int $UserId
     * @param string $FaceBookId
     * @return ChatFaceBook
     */
    public function CheckFaceBookIdName($UserId,$FaceBookId){
        return $this->_ChatFaceBookModels->where('user_id', $UserId)->where('facebook_id', $FaceBookId)->first();
    }

    public function createChatFaceBook($UserId,$facebookId,$facebookTitle){
        return $this->_ChatFaceBookModels->insert(
            array('user_id' => $UserId, 'facebook_id' => $facebookId,'facebook_title'=>$facebookTitle)
        );
    }

    /**
     * @param int $id
     * @return ChatFaceBook
     */

    public function getChatFaceBookId($id){
        return $this->_ChatFaceBookModels->where("id",$id)->where("status",0)->first();
    }

    /**
     * @param int $UserId
     * @param string $FaceBookId
     * @param int $id
     * @return ChatFaceBook
     */
    public function CheckFaceBookIdNameUpdate($UserId,$FaceBookId,$id){
        return $this->_ChatFaceBookModels->where('user_id',$UserId)->where('facebook_id',$FaceBookId)->whereNotIn('id',[$id])->first();
    }

    /**
     * @param int $id
     * @param string $facebookId
     * @param string $facebookTitle
     * @return ChatFaceBook
     */

    public function ChatFaceBookUpdate($id,$facebookId,$facebookTitle){
        return $this->_ChatFaceBookModels->where('id', $id)->update(
                array('facebook_id' => $facebookId,'facebook_title'=>$facebookTitle
                ));
    }

    /**
     * @param int $id
     * @return ChatFaceBook
     */
    public function DeleteChatFaceBook($id)
    {
       return $this->_ChatFaceBookModels->where('id', $id)->update(['status'=>1]);
    }

}
