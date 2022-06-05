<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class CheckRegisterEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $user = User::where("email_verified_at", "<" ,now()->addMinutes(-3)->toDateTimeString())->where('status', '1')->where('token', '<>', '0')->get();
        foreach($user as $item) {
            $item->token = rand(1000, 9999);
            $item->status = 0;
            $item->save();
        }
      
        return 0;
    }
}
