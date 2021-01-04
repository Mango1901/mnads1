<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CheckTokenExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckTokenExpired:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Làm mới token khi đã hết hạn sử dụng';

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
        $expired_time = User::whereDate("active_expired","<=",date("Y-m_d"))->get();
        foreach($expired_time as $key => $value){
            if(isset($value->active_expired)) {
                $value->token = Str::random(60);
                $value->save();
            }
        }
    }
}
