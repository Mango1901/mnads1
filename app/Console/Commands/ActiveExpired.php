<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ActiveExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ActiveExpired:call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hết hạn đăng nhập';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        for($i=1;$i<=15;$i++){
            $expired_date = date("Y-m-d", strtotime($i. " day"));
            $user = User::whereDate("active_expired","=",$expired_date)->get();
            foreach($user as $value){
                if($value->active_expired){
                    $to_name = $value->name;
                    $to_email= $value->email;
                    $data = array("name"=>$to_email,"body"=>$i." days until expired");
                    Mail::send('mail.ActiveExpired',$data,function($message) use ($to_name,$to_email){
                        $message->to($to_email)->subject('Thông báo ngày hết hạn truy cập website');
                        $message->from($to_email,$to_name);
                    });
                }
            }
        }
        $expired_time = User::whereDate("active_expired","=",date("Y-m_d"))->get();
        foreach($expired_time as $value1){
            if($value1->active_expired){
                $to_name = $value1->name;
                $to_email= $value1->email;
                $data = array("name"=>$to_email,"body"=>"Your account is running out of time");
                Mail::send('mail.ActiveExpired',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('Thông báo ngày hết hạn truy cập website');
                    $message->from($to_email,$to_name);
                });
            }
        }
    }
}
