<?php

use Illuminate\Database\Seeder;
use App\User;
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
        return [
            [
                'username' => 'Shirley',
                'email'=> 'congtyphuongdong@gmail.com',
                'password'=> bcrypt('congtyphuongdong'),
                'fullname' => 'Từ Hải Hiếu',
                'website'=>'mnads.com',
                'token'=>'kIviHWBTCIPUGkT1U70JwHNmC7yP9RAsYGjHQbavlP0ah1K9OpR45acMyQMd',
                'active'=>'1',
            ],

        ];
    }
}
