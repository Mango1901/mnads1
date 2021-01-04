<?php
namespace App\Repository;


use App\Api\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Null_;

class UserRepository implements UserRepositoryInterface
{
    protected $_userModels;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->_userModels = $user;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getById($userId){
        return $this->_userModels->where("id",$userId)->where("status",0)->first();
    }

    /**
     * @param string $information
     * @return User
     */
    public function getUserInformation($information)
    {
        return $this->_userModels->where('username','like',"%$information%")->orwhere('email','like',"%$information%")->where('status',0)->get();
    }

    /**
     * @return User
     */
    public function getAllUser()
    {
        return $this->_userModels->where("status",0)->where("roles","!=","2")->get();
    }


    /**
     * @param $Id
     * @param $username
     * @param $email
     * @param $fullName
     * @param $website
     * @param $active
     * @return User
     */

    public function updateUser($Id, $username, $email, $fullName, $website, $active)
    {

        return $this->_userModels->where("id",$Id)->update(
            array('email'=>$email,'fullname'=>$fullName ,'website'=>$website,'active'=>$active,'username'=>$username
            ));
    }

    /**
     * @param int $userId
     * @return User
     */

    public function deleteUser($userId)
    {
        return $this->_userModels->where('id', $userId)->update(['status'=>1]);
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @param $fullName
     * @param $website
     * @return User
     */

    public function createUser($username,$password,$email,$fullName,$website)
    {
        return $this->_userModels->create(
            array(
                'username' => $username,
                'password' => bcrypt($password),
                'email' => $email,
                'fullname' => $fullName,
                'website' =>$website,
                'token' => Str::random(60),
                'token_expired' => date("Y-m-d H:i:s", strtotime("+30 day")),
                'active_expired' => date("Y-m-d", strtotime("+30 day"))
            ));
    }

    /**
     * @param $active
     * @param $username
     * @param $password
     * @param $email
     * @param $fullName
     * @param $website
     * @return User
     */

    public function CreateUserAdmin($username,$password,$email,$fullName,$website,$active){
        return $this->_userModels->create(
            array(
                'username' => $username,
                'password' => bcrypt($password),
                'email' => $email,
                'fullname' => $fullName,
                'website' =>$website,
                'token' => Str::random(60),
                'email_verified_at'=>date("Y-m-d H:i:s"),
                'active'=>$active,
                'token_expired' => date("Y-m-d H:i:s", strtotime("+30 day")),
                'active_expired' => date("Y-m-d", strtotime("+30 day"))
            ));
    }

    /**
     * @param $userId
     * @param $fullName
     * @param $website
     * @param $companyName
     * @param $description
     * @param $avatar
     * @return User
     */

    public function updateProfileWithAvatar($userId,$fullName,$website,$companyName,$description,$avatar)
    {
        return $this->_userModels->where("id",$userId)->update(
            array('fullname'=>$fullName,'website'=>$website, 'company_name'=>$companyName,'description'=>$description,'avatar' => $avatar)
        );
    }

    /**
     * @param $userId
     * @param $fullName
     * @param $website
     * @param $companyName
     * @param $description
     * @return User
     */

    public function updateProfileWithoutAvatar($userId,$fullName,$website,$companyName,$description)
    {
        return $this->_userModels->where("id",$userId)->update(
            array('fullname'=>$fullName,'website'=>$website, 'company_name'=>$companyName,'description'=>$description)
        );
    }

    /**
     * @param $userId
     * @param $password
     * @return User
     */

    public function ChangePassword($userId,$password)
    {
        return $this->_userModels->where("id",$userId)->update(
            array('password'=> bcrypt($password)
            ));
    }

    /**
     * @param $email
     * @return User
     */

    public function CheckEmail($email){
        return $this->_userModels->where("email",$email)->first();
    }

    public function CheckUserName($username)
    {
        return $this->_userModels->where("username",$username)->first();
    }

    /**
     * @param $email
     * @param $RefreshToken
     * @return User
     */
    public function CheckEmailAndRefreshToken($email,$RefreshToken){
        return $this->_userModels->where('email', $email)->where('token_reset_password', $RefreshToken)
            ->where('token_reset_password_expired','>=',date("Y-m-d H:i:s"))->first();
    }

    /**
     * @param $email
     * @param $password
     * @param $RefreshToken
     * @return User
     */
    public function UpdateRefreshPassword($email,$password,$RefreshToken){
        return $this->_userModels->where("email",$email)->where("token_reset_password",$RefreshToken)->update(
            array('password'=>$password,'token_reset_password'=>str::random(60),'token_reset_password_expired'=>date("Y-m-d H:i:s", strtotime("+1 hour")))
        );
    }

    /**
     * @param $email
     * @param $token_reset_password_expired
     * @param $token_reset_password
     * @return User
     */
    public function UpdateRefreshToken($email,$token_reset_password_expired,$token_reset_password){
        return $this->_userModels->where("email",$email)->update(
         array('token_reset_password_expired'=>$token_reset_password_expired,'token_reset_password'=>$token_reset_password)
        );
    }

    /**
     * @param $email
     * @return User
     */
    public function CheckEmailVerifiedAt($email){
        return $this->_userModels->where("email",$email)->where("email_verified_at","!=",NULL);
    }

    /**
     * @param int $id
     * @param string $email
     * @return User
     */
    public function CheckEmailUpdate($id, $email)
    {
      return $this->_userModels->where("email",$email)->whereNotIn("id",[$id])->first();
    }

    /**
     * @param int $id
     * @param string $username
     * @return User
     */
    public function CheckUsernameUpdate($id, $username)
    {
        return $this->_userModels->where("username",$username)->whereNotIn("id",[$id])->first();
    }

}
