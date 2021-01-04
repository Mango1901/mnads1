<?php
namespace App\Api;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return \App\User
     */
    public function getById($userId);

    /**
     * @param string $information
     * @return \App\User
     */
    public function getUserInformation($information);

    /**
     * @return \App\User
     */

    public function getAllUser();


    /**
     * @param $Id
     * @param $username
     * @param $email
     * @param $fullName
     * @param $website
     * @param $active
     * @return \App\User
     */

    public function updateUser($Id,$username, $email, $fullName, $website, $active);

    /**
     * @param  int $userId
     * @return \App\User
     */

    public function deleteUser($userId);

    /**
     * @param $username
     * @param $password
     * @param $email
     * @param $fullName
     * @param $website
     * @return \App\User
     */

    public function createUser($username,$password,$email,$fullName,$website);

    /**
     * @param $userId
     * @param $fullName
     * @param $website
     * @param $companyName
     * @param $description
     * @param $avatar
     * @return \App\User
     */

    public function updateProfileWithAvatar($userId,$fullName,$website,$companyName,$description,$avatar);

    /**
     * @param $userId
     * @param $fullName
     * @param $website
     * @param $companyName
     * @param $description
     * @return \App\User
     */

    public function updateProfileWithoutAvatar($userId,$fullName,$website,$companyName,$description);

    /**
     * @param $userId
     * @param $password
     * @return \App\User
     */

    public function ChangePassword($userId,$password);

    /**
     * @param $email
     * @return \App\User
     */

    public function CheckEmail($email);

    /**
     * @param $username
     * @return \App\User
     */
    public function CheckUserName($username);

    /**
     * @param $email
     * @param $RefreshToken
     * @return \App\User
     */
    public function CheckEmailAndRefreshToken($email,$RefreshToken);

    /**
     * @param $email
     * @param $password
     * @param $RefreshToken
     * @return \App\User
     */
    public function UpdateRefreshPassword($email,$password,$RefreshToken);

    /**
     * @param $email
     * @param $token_reset_password_expired
     * @param $token_reset_password
     * @return \App\User
     */
    public function UpdateRefreshToken($email,$token_reset_password_expired,$token_reset_password);

    /**
     * @param $email
     * @return \App\User
     */
    public function CheckEmailVerifiedAt($email);

    /**
     * @param $active
     * @param $username
     * @param $password
     * @param $email
     * @param $fullName
     * @param $website
     * @return \App\User
     */

    public function CreateUserAdmin($username,$password,$email,$fullName,$website,$active);

    /**
     * @param int $id
     * @param string $email
     * @return \App\User
     */
    public function CheckEmailUpdate($id,$email);

    /**
     * @param int $id
     * @param string $username
     * @return \App\User
     */
    public function CheckUsernameUpdate($id,$username);

}
