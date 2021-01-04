<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getUserData();
        foreach($data as $key => $value){
            User::create($value);
        }
    }
    private function getUserData(){
        $carbon = Carbon::now("Asia/Ho_Chi_Minh");
        $token_expired = $carbon->addHour();
        $token_expired_date = $token_expired->toDateTimeString();
        return [
            [
                'username' => 'Shirley',
                'email'=> 'congtyphuongdong@gmail.com',
//                'email'=> 'ctyphuongdongvn1@gmail.com',
                'password'=> bcrypt('congtyphuongdong'),
                'fullname' => 'Từ Hải Hiếu',
                'website'=>'mnads.com',
                'email_verified_at'=>date("Y-m-d H:i:s"),
                'token'=>Str::random(60),
                'token_expired'=>$token_expired_date,
                'roles'=>'2',
                'active_expired'=>date("Y-m-d", strtotime("+3665 day"))
            ],
        ];
    }
}
